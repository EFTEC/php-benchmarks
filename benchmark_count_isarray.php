<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */



$numbers = range(0, 1000);

include "Collection.php";

$instances=100000;

$exist=true;

$array1=['repeated'=>'abc','b'=>'bcd','c'=>'def',20,30,40];
$array2=['repeated'=>'abc','d'=>'abc2','e'=>'bcd2','f'=>'def2',50,60,70];
$noarray=20;

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=@count($array1);
    $r=@count($noarray);
}
$t2=microtime(true);
$table['count']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=is_array($array1)? count($array1) : null;
    $r=is_array($noarray)? count($noarray) : null;
}
$t2=microtime(true);
$table['is_array count']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    is_array($array1) and $r=count($array1);
    is_array($noarray) and $r=count($noarray);
}
$t2=microtime(true);
$table['is_array count 2']=$t2-$t1;
// **********************************************************************************


echo \mapache_commons\Collection::generateTable($table);