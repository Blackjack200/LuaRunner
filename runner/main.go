package main

import (
	"fmt"
	"google.golang.org/grpc"
	"log"
	"lua/proto"
	"lua/server"
	"net"
)

func main() {
	lis, err := net.Listen("tcp", fmt.Sprintf("localhost:%d", 6666))
	if err != nil {
		log.Fatalf("failed to listen: %v", err)
	}
	s := grpc.NewServer()
	t := &server.Evaluator{}
	proto.RegisterEvaluatorServer(s, t)
	if err := s.Serve(lis); err != nil {
		panic(err)
	}
	s.Stop()
}
