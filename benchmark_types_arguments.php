<?php
/** @noinspection AutoloadingIssuesInspection */


$numbers = range(0, 1000);

include "Collection.php";

$instances=5000;

$exist=true;

class DummyClass {
}

/**
 * @param DummyClass $arg1
 * @param DummyClass $arg2
 *
 * @return DummyClass
 */
function php5($arg1,$arg2){
    return new DummyClass();
}
function php7(DummyClass $arg1,DummyClass $arg2): DummyClass {
    return new DummyClass();
}


// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=php5(new DummyClass(),new DummyClass());
}
$t2=microtime(true);
$table['php5']=$t2-$t1;

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=php7(new DummyClass(),new DummyClass());
}
$t2=microtime(true);
$table['php7']=$t2-$t1;


echo \mapache_commons\Collection::generateTable($table);