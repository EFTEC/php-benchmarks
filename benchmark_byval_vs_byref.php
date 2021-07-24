<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */


$numbers = range(0, 1000);

include "Collection.php";

$instances=10000;

$exist=true;

function fn1($arg) {
    return "aaa".$arg;
}
function fn2(&$arg) {
    return "aaa".$arg;
}

function fn3($arg) {
    return $arg['b'];
}
function fn4(&$arg) {
    return $arg['b'];
}

$tmp=str_pad('a',200);
$tmp2=[];
for($i=0;$i<100;$i++) {
    $tmp2[64+$i]=chr(64+$i);
}
$tmp2['b']='b';

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=fn1($tmp);
}
$t2=microtime(true);
$table['byref string']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=fn2($tmp);
}
$t2=microtime(true);
$table['byval string']=$t2-$t1;

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=fn3($tmp2);
}
$t2=microtime(true);
$table['byref array']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=fn4($tmp2);
}
$t2=microtime(true);
$table['byval array']=$t2-$t1;



echo \mapache_commons\Collection::generateTable($table);