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
  protected $fork_cbs = [];
  public function __construct(string $code)
  {
    if($code=="") return;
    $lines = explode("\n",$code);
    $black = black($lines[0]);
    $i = 0;
    foreach($lines as $line){
      if(black($line)===$black){
        if(isset($forkblack)){
          $this->cmds[] = ltrim($line);
          //判断当前行是否在循环里
          if(substr($cmd,0,strpos($cmd=end($this->cmds)," "))=="否则"){
            $forkcode[] = $line;
            continue;
          }
          //判断循环类型
          switch(substr($lines[$forklnum],0,strpos($lines[$forklnum]," "))){
          case "如果":
            $this->fork_cbs[] = new IfBlock($forkcode);
          break;
          case "只要":
            $this->fork_cbs[] = new WhileBlock($forkcode);
          break;
          default:
            die("缩进错误");
          }
          unset($forkblack,$forklnum,$forkcode);
        }
      }else{
        if(!isset($forkblack)){
          $forklnum = $i;
          $forkcode = [$line,];
          $forkblack = black($line);
        }elseif($forkblack<=black($line)){
          $forkcode[] = $line;
        }else{
          die("缩进错误\n");
        }
      }
      $i++;
        //缺少处理块中块
    }
  }
  public function run()
  {
    foreach($this->cmds as $cmd)
    {
      $type = substr($cmd,0,$i=strpos($cmd," "));
      $cmd = substr($cmd,$i+1);
      switch($type){
        case "请"://调用函数/语言结构
        $func = substr($cmd,0,$i=strpos($cmd,":"));    
        $paras = explode("，",substr($cmd,$i+1,strrpos($cmd,"。")-$i-1));
        //var_dump($paras);
       //首先寻找内置函数库，其次寻找代码块函数库
        if(FunctionLib::exists($func)){
         FunctionLib::run($func,$paras);
        }
      }
    }
  }
}