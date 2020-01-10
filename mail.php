<?php
require_once("Interpreter.php");
require_once("FunctionLib.php");
require_once("codeblock/CodeBlock.php");
$file = $argv[1];
$code = trim(file_get_contents($file));
$main = new \yxmingy\chinesemail\codeblock\CodeBlock($code);
$main->run();