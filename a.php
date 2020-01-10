<?php
class A
{
  protected $a;
  public function __construct()
  {
    $this->a = 1;
  }
  public function &getr()
  {
    return $this->a;
  }
  public function print()
  {
    echo $this->a.PHP_EOL;
  }
}
$a = new A();
$a->print();
$aa = &$a->getr();
echo $aa.PHP_EOL;
$aa = 2;
echo $aa.PHP_EOL;
$a->print();
function f_echo($context)
{
  echo $context;
}
$a = "f_echo";
    $a("bb");