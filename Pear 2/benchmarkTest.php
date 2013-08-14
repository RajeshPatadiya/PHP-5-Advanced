<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 8/13/13
 * Time: 9:59 PM
 * To change this template use File | Settings | File Templates.
 */

require_once('Benchmark/Timer');

$timer = new Benchmark_Timer();
$timer->start();

$timer->setMarker('echo1');

