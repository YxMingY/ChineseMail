<?php
namespace yxmingy\chinesemail\codeblock;
use yxmingy\chinesemail\
  {Interpreter,FunctionLib};
class CodeBlock implements Interpreter;
{
  /* 待完成: 依靠缩进区分代码块，以及cmd */
  protected $vars = [];
  protected $cmds = [];
  protected $derived_cbs = [];
  public function run()
  {
    foreach($this->cmds as $cmd)
    {
      $type = substr($cmd,0,$i=stripos($cmd," "));
      $cmd = substr($cmd,$i);
      switch($type)
      {
        case "请"://调用函数/语言结构
          $func = substr($cmd,0,$i=stripos($cmd,":"));
          $paras = explode("，",substr($cmd,0,$i,strripos($cmd,"。")));
          //首先寻找内置函数库，其次寻找代码块函数库
          if(FunctionLib::exists($func)){
            FunctionLib::run($func,$paras);
          }
      }
    }
  }
}