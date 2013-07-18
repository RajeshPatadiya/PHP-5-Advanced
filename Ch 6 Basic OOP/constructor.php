<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/9/13
 * Time: 5:03 PM
 * To change this template use File | Settings | File Templates.
 */

class Rectangle {
  public $width = 0;
  public $height = 0;

  function __construct($w = 0, $h = 0) {
    $this->width = $w;
    $this->height = $h;
  }
}