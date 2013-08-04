<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 7/21/13
 * Time: 9:48 PM
 * To change this template use File | Settings | File Templates.
 */

$company = array(
  'info'          => array(
    'name'          => 'Awesome Web Company',
    'location'      => 'Savannah, GA',
    'website'       => 'http://weAreAwesome.com'),
  'staff'         => array(
    array('name'=>'Kermit the Frog','position' => 'CEO'),
    array('name'=>'Hiro Nakamura','position' => 'Art Director'),
    array('name'=>'Willy Wonka','position' => 'Web Developer')
  )
);

$Laurel = array (
  'Members' => array(
    '1' => array(
      'Name' => 'Jack',
      'Labor' => 'Kitchen'),
    '2' => array(
      'Name' => 'John',
      'Labor' => 'Balcony'),
    '3' => array(
      'Name' => 'James',
      'Labor' => 'Game Room'),
  ),

  'Officers' => array(
    'Labor Czar' => 'Ulisses',
    'Memco' => 'Elyssa'
  )
);

print_r($Laurel);
echo '</br>';
echo '</br>';
echo '</br>';
var_dump($Laurel);
echo '</br>';
echo '</br>';
echo '</br>';
foreach ($Laurel['Members'] as $k => $v){
  echo $k . " = " . $v['Name'] . " : " . $v['Labor'];
  echo '</br>';
}
?>