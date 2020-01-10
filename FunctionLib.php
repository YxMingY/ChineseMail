<?php
namespace{
  function f_echo($context)
  {
    echo $context;
  }
}
namespace yxmingy\chinesemail
{
  class FunctionLib
  {
    private static $funcs = 
    [
      "输出" => "f_echo",
    ];
    public static function exists(string $fn):bool
    {
      return isset(self::$funcs[$fn]);
    }
    public static function run(string $fn,array $para)
    {
      self::$funcs[$fn](...$para);
    }
  }
}