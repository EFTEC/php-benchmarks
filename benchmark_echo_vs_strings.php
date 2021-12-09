<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */




include "Collection.php";

$instances=2000;

echo "<br>echo:<hr>";
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    echo 'hello world 123456789012345678901234567890';
}
$t2=microtime(true);

$table['echo']=$t2-$t1;
echo "<br>concat:<hr>";
// **********************************************************************************
$t1=microtime(true);
$str='';
for($i=0;$i<$instances;$i++) {
    $str.='hello world 123456789012345678901234567890';
}
echo $str;
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
$t2=microtime(true);
$table['concat']=$t2-$t1;
echo "<br>implode:<hr>";
// **********************************************************************************
$t1=microtime(true);
$str=[];
for($i=0;$i<$instances;$i++) {
    $str[]='hello world 123456789012345678901234567890';
}
echo implode('',$str);
// note: $r=eval('ping("pong");'); return null
// note: $r=eval('return ping("pong");'); return 'pong'
$t2=microtime(true);
$table['implode']=$t2-$t1;
echo \mapache_commons\Collection::generateTable($table);