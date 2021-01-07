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
    $r=is_countable($array1);
    $r=is_countable($noarray);
}
$t2=microtime(true);
$table['is_countable']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=is_array($array1);
    $r=is_array($noarray);
}
$t2=microtime(true);
$table['is_array count']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=gettype($array1);
    $r=gettype($noarray);
}
$t2=microtime(true);
$table['gettytpe']=$t2-$t1;
// **********************************************************************************
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=get_debug_type($array1);
    $r=get_debug_type($noarray);
}
$t2=microtime(true);
$table['get_debug_type']=$t2-$t1;
// **********************************************************************************


echo \mapache_commons\Collection::generateTable($table);