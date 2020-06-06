<?php

include "Collection.php";

$instances=50000;

// define constant

$t1=microtime(true);

define('COMPUTERNAME','HELLO WORLD');
for($i=0;$i<$instances;$i++) {
    $a1=COMPUTERNAME;
}

$t2=microtime(true);

$result['DEFINE CONST']=$t2-$t1;

// define constant

$t1=microtime(true);

const COMPUTERNAME2='HELLO WORLD';
for($i=0;$i<$instances;$i++) {
    $a1=COMPUTERNAME2;
}
$t2=microtime(true);

$result['CONST']=$t2-$t1;


// env

$t1=microtime(true);

for($i=0;$i<$instances;$i++) {
    $a1=getenv('computername');
}

$t2=microtime(true);

$result['env']=$t2-$t1;


// function

$t1=microtime(true);

function returnValue() {
    return 'HELLO WORLD';
}

for($i=0;$i<$instances;$i++) {
    $a1=returnValue();
}

$t2=microtime(true);

$result['function']=$t2-$t1;


echo \mapache_commons\Collection::generateTable($result);