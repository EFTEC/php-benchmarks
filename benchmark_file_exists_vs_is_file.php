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
    $r=file_exists(__FILE__);
    $r1=file_exists('none.none');
}
$t2=microtime(true);
$table['file_exists']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=is_file(__FILE__);
    $r1=is_file('none.none');

}
$t2=microtime(true);
$table['is_file']=$t2-$t1;
echo \mapache_commons\Collection::generateTable($table);