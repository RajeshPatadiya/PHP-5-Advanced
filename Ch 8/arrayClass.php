<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/21/13
 * Time: 5:46 PM
 * To change this template use File | Settings | File Templates.
 */

class createArray {

  public $lister = array();

  function __construct($items){
    $this->lister[] = $items;
  }

  public function add_to($item){
    array_push($this->lister, $item);
  }

  public function displayArray(){
    echo "Hello World";
    print_r($this->lister);
  }
}

$home = array('cheese', 'eggs', 'bacon');
$home2 = array('cheese2', 'eggs2', 'bacon2');

$test = new createArray($home);
$test->displayArray();
echo "hello";
?>