<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */


$numbers = range(0, 1000);

include "Collection.php";

$instances=100000;

$exist=true;

$array1=['repeated'=>'abc','b'=>'bcd','c'=>'def',20,30,40];



// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=array_key_exists('repeated',$array1);
    $r=array_key_exists('repeatedxxx',$array1);
}
$t2=microtime(true);
$table['array_key_exists']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=isset($array1['repeated']);
    $r=isset($array1['repeatedxxx']);
}
$t2=microtime(true);
$table['isset']=$t2-$t1;
echo \mapache_commons\Collection::generateTable($table);