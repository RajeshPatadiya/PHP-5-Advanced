<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/17/13
 * Time: 10:36 PM
 * To change this template use File | Settings | File Templates.
 */

$file = 'data.txt';
$data = 'This is a line of data.\n';

try {
  if(!$fp = @fopen($file, 'w')){
    throw new Exception('could not write file');
  }
}