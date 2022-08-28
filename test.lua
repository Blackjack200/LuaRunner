function fibonacci(n)
    local function inner(m)
        if m < 2 then
            return m
        end
        return inner(m - 1) + inner(m - 2)
    end
    return inner(n)
end

local n = rand_int(1, 20)
print("Fibonacci(" .. tostring(n) .. ")="..tostring(fibonacci(rand_int(1, 10))))
