<?php
namespace yxmingy\chinesemail\codeblock;
use yxmingy\chinesemail\
  {Interpreter,FunctionLib};
function black(string $line):int{
  $chars = str_split(rtrim($line));
  for ($i=0;$i<count($chars);$i++){
    if($chars[$i] != " ") return $i; 
  } 
  return 0;
}
class CodeBlock implements Interpreter
{
  /* 待完成:
     依靠缩进区分代码块，以及cmd 
     解析字符串
   */
  protected $vars = [];
  protected $cmds = [];
  protected $derived_cbs = [];
  public function __construct(string $code)
  {
    if($code=="") return;
    $lines = explode("\n",$code);
    $black = black($lines[0]);
    foreach($lines as $line){
      if(black($line)===$black)
        $this->cmds[] = ltrim($line);
        //缺少处理块中块
    }
  }
  public function run()
  {
    foreach($this->cmds as $cmd)
    {
      $type = substr($cmd,0,$i=strpos($cmd," "));
      $cmd = substr($cmd,$i+1);
      switch($type)
      {
        case "请"://调用函数/语言结构
          $func = substr($cmd,0,$i=strpos($cmd,":"));    
          $paras = explode("，",substr($cmd,$i+1,strrpos($cmd,"。")-$i-1));
          var_dump($paras);
          //首先寻找内置函数库，其次寻找代码块函数库
          if(FunctionLib::exists($func)){
            FunctionLib::run($func,$paras);
          }
      }
    }
  }
}