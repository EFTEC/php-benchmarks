<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */




include "Collection.php";

$instances=200000;

const HELLO = 'HELLO WORLD';
for($s=0;$s<10;$s++) {
// **********************************************************************************
    $t1 = microtime(true);


    for ($i = 0; $i < $instances; $i++) {
        if ($i === HELLO) {
            echo "it is not possible";
        }
    }
    $t2 = microtime(true);

    $table[$s]['constant'] = $t2 - $t1;

// **********************************************************************************

    $t1 = microtime(true);
    $variable = 'HELL WORLD';
    $str = '';
    for ($i = 0; $i < $instances; $i++) {
        if ($i === $variable) {
            echo "it is not possible";
        }
    }
    echo $str;
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
    $t2 = microtime(true);
    $table[$s]['variable'] = $t2 - $t1;
// **********************************************************************************
    $t1 = microtime(true);
    $str = [];
    for ($i = 0; $i < $instances; $i++) {
        if ($i === 'HELLO WORLD') {
            echo "it is not possible";
        }
    }
    echo implode('', $str);
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
    $t2 = microtime(true);
    $table[$s]['literal']= $t2 - $t1;
}
echo \mapache_commons\Collection::generateTable($table);