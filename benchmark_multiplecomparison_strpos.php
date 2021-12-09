<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */




include "Collection.php";

$instances=2000000;
$variable = 'f';
for($s=0;$s<=10;$s++) {
// **********************************************************************************
    $t1 = microtime(true);


    for ($i = 0; $i < $instances; $i++) {
        if ($variable === 'a' || $variable==='b' || $variable==='c') {
            echo "it is not possible";
        }
    }
    $t2 = microtime(true);

    $table[$s]['multipleif'] = $t2 - $t1;

// **********************************************************************************

    $t1 = microtime(true);

    $str = '';
    for ($i = 0; $i < $instances; $i++) {
        if (strpos('abc',$variable)!==false) {
            echo "it is not possible";
        }
    }
    echo $str;
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
    $t2 = microtime(true);
    $table[$s]['strpos'] = $t2 - $t1;
    $table[$s]['percentage']=$table[$s]['multipleif']*100/$table[$s]['strpos'];

}
echo \mapache_commons\Collection::generateTable($table);