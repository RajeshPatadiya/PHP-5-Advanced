<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/14/13
 * Time: 5:39 PM
 * To change this template use File | Settings | File Templates.
 */

class Pet {
  public $name;
  
  function __construct($pet_name) {
    $this->name = $pet_name;
    self::go_to_sleep();
  }

  function eat() {
    echo "<p>$this->name is eating.</p>";
  }

  function go_to_sleep() {
    echo "<p>$this->name is sleeping.</p>";
  }

  function play() {
    echo "<p>$this->name is playing.</p>";
  }
}

class Cat extends Pet {
  function play(){
    parent::play();
    echo "<p>$this->name is climbing.</p>";
  }
}

$cat = new Cat('Bucky');
$pet = new Pet('Rob');

$cat->eat();
$pet->eat();

$cat->go_to_sleep();
$pet->go_to_sleep();

$cat->play();
$pet->play();

unset($cat, $pet);
?>