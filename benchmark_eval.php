<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */


$numbers = range(0, 1000);

include "Collection.php";

$instances=100000;

$exist=true;

function ping($pong) {
    return $pong;
}

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=ping("pong");
}
$t2=microtime(true);
$table['no_eval']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    eval('$r=ping("pong");');
}
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
$t2=microtime(true);
$table['eval']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=eval('return ping("pong");');
}
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
$t2=microtime(true);
$table['eval2']=$t2-$t1;


// **********************************************************************************
$t1=microtime(true);
$fnname='ping';
for($i=0;$i<$instances;$i++) {
    $r=$fnname("pong");
}
$t2=microtime(true);
$table['dynamic_function']=$t2-$t1;

echo \mapache_commons\Collection::generateTable($table);