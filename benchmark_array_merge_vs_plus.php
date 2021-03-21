<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */


$numbers = range(0, 1000);

include "Collection.php";

$instances=100000;

$exist=true;

$array1=['repeated'=>'abc','b'=>'bcd','c'=>'def',20,30,40];
$array2=['repeated'=>'abc','d'=>'abc2','e'=>'bcd2','f'=>'def2',50,60,70];

function foreachMerge(&$array1, &$array2) {
    $tmp=$array1;
    foreach($array2 as $k=>$v) {
        $tmp[$k] = $v;
    }
    return $tmp;
}


// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=array_merge($array1,$array2);
}
$t2=microtime(true);
$table['array_merge']=$t2-$t1.' ('.count($r).')';
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=array_replace($array1,$array2);
}
$t2=microtime(true);
$table['array_replace']=$t2-$t1.' ('.count($r).')';
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r= $array1 + $array2;
}
$t2=microtime(true);
$table['plus']=$t2-$t1.' ('.count($r).')';
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r= foreachMerge($array1,$array2);
}
$t2=microtime(true);
$table['foreach']=$t2-$t1.' ('.count($r).')';

echo \mapache_commons\Collection::generateTable($table);