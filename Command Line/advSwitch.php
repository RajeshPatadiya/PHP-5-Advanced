<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 8/12/13
 * Time: 11:13 PM
 * To change this template use File | Settings | File Templates.
 */

echo "\nEnter a letter and see a random word that starts with that letter: ";

if (fscanf(STDIN, "%s", $char) == 1){

  switch($char){

    case 'a':
    case 'A':
      // Could create an array and do something with random numbers here
      echo "Airship";
      break;

    case 'b':
    case 'B':
      echo "Bavaria";
      break;

    case 'c':
    case 'C':
      echo "Clandestine";
      break;

    default:
      echo "There was an error!";
      break;

  } // End switch
} // End if fscanf/

?>