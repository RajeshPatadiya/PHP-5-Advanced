<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/7/13
 * Time: 10:08 PM
 * To change this template use File | Settings | File Templates.
 */
class HelloWorld {
  function say_hello ($language = 'English') {
    echo '<p>';
    switch ($language) {
      case 'Dutch':
        echo 'Hello, wereld!';
        break;
      case 'French':
        echo 'Bonjour, monde!';
        break;
      case 'German':
        echo 'Hallo, Welt!';
        break;
      case 'Italian':
        echo 'Ciao, mondo!';
        break;
      case 'Spanish':
        echo 'ÁHola, mundo!';
        break;
      case 'English':
      default:
        echo 'Hello, world!';
        break;
    } // End of switch.
   echo '</p>';
  }
}

$obj = new HelloWorld();
$obj->say_hello();
$obj->say_hello('Italian');
$obj->say_hello('Dutch');
unset($obj);
?>

