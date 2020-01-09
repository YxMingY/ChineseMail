<?php
namespace yxmingy\chinesemail;
class FunctionLib
{
  private static $funcs = 
  [
    "输出" => "echo",
  ];
  public static function isset(string $fn):bool
  {
    return isset(self::$funcs[$fn]);
  }
  public static function run(string $fn,array $para)
  {
    self::$funcs[$fn](...$para);
  }
}