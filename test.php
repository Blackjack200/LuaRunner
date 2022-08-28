<?php

use blackjack200\Lua;

require_once __DIR__ . "/vendor/autoload.php";

$lua = new Lua();

$lua->assign("PHP_VAR", "This is from PHP");
$lua->assign("COND", true);
var_dump(json_encode($lua->evalFile('test.lua'), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT));