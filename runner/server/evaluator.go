package server

import (
	"context"
	"github.com/yuin/gopher-lua"
	luajson "layeh.com/gopher-json"
	"lua/proto"
	"math/rand"
	"os"
	"sync"
)

var execMu = &sync.Mutex{}

func mustUnmarshal(l *lua.LState, s string) lua.LValue {
	decode, err := luajson.Decode(l, []byte(s))
	if err != nil {
		return nil
	}
	return decode
}

type Evaluator struct {
	proto.UnimplementedEvaluatorServer
}

func luaRand(L *lua.LState) int {
	L.Push(lua.LNumber(rand.Float64()))
	return 1
}

func luaRandInt(L *lua.LState) int {
	min := int64(L.ToInt(1))
	max := int64(L.ToInt(2))
	L.Push(lua.LNumber(rand.Int63n(max-min+1) + min))
	return 1
}

func (e *Evaluator) Eval(_ context.Context, request *proto.EvaluateRequest) (*proto.EvaluateResponse, error) {
	execMu.Lock()
	defer func() {

		//os.RemoveAll("combine")
		execMu.Unlock()
	}()
	//HACK
	oldStdout := os.Stdout
	oldStdin := os.Stdin
	oldStderr := os.Stderr

	stdout, _ := os.OpenFile("stdout", os.O_RDWR|os.O_CREATE|os.O_TRUNC, 0666)
	stderr, _ := os.OpenFile("stderr", os.O_RDWR|os.O_CREATE|os.O_TRUNC, 0666)
	//combine, _ := os.OpenFile("combine", os.O_WRONLY|os.O_CREATE|os.O_TRUNC, 0666)
	nul, _ := os.OpenFile("/dev/null", os.O_RDWR|os.O_CREATE|os.O_TRUNC, 0666)

	os.Stdin = nul
	os.Stdout = stdout
	os.Stderr = stderr

	l := lua.NewState()
	for name, val := range request.Variables {
		l.SetGlobal(name, mustUnmarshal(l, val))
	}

	//TODO FUNCTIONS
	l.SetGlobal("rand", l.NewFunction(luaRand))
	l.SetGlobal("rand_int", l.NewFunction(luaRandInt))

	err := l.DoString(request.Code)
	var errStr *string
	if err != nil {
		_f := err.Error()
		errStr = &_f
	}

	os.Stdout = oldStdout
	os.Stdin = oldStdin
	os.Stderr = oldStderr

	out, err := os.ReadFile("stdout")
	if err != nil {
		panic(err)
	}
	errAll, err := os.ReadFile("stderr")
	if err != nil {
		panic(err)
	}
	//combineA, _ := io.ReadAll(combine)
	return &proto.EvaluateResponse{
		Stdout:     string(out),
		Stderr:     string(errAll),
		CombineOut: string("not supported"),
		Error:      errStr,
	}, nil
}

var _ proto.EvaluatorServer = &Evaluator{}
