<?php

$numbers = range(0, 1000);

include "Collection.php";

$instances=5000;

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $result = array();
    foreach ($numbers as $number) {
        $result[] = $number * 10;
    }
}
$t2=microtime(true);
$table['foreach']=$t2-$t1;

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $result = array_map(function ($number) {
        return $number * 10;
    }, $numbers);
}
$t2=microtime(true);
$table['array_map']=$t2-$t1;

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $result = array_map(static function ($number) {
        return $number * 10;
    }, $numbers);
}
$t2=microtime(true);
$table['array_map (static)']=$t2-$t1;

// **********************************************************************************
$t1=microtime(true);
function tenTimes($number)
{
    return $number * 10;
}
for($i=0;$i<$instances;$i++) {
    $result = array_map('tenTimes', $numbers);
}
$t2=microtime(true);
$table['array_map (calling a function)']=$t2-$t1;


echo \mapache_commons\Collection::generateTable($table);