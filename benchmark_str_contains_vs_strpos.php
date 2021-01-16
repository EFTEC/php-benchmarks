<?php
declare(strict_types=1);
/** @noinspection AutoloadingIssuesInspection */


$numbers = range(0, 1000);

include "Collection.php";

$instances=1000000;

$exist=true;

$text="mary had a little lamb whose fleece was white as snow";

// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=str_contains($text,'mary');
    $r=str_contains($text,'black');
}
$t2=microtime(true);
$table['str_contains']=$t2-$t1;
// **********************************************************************************
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=strpos($text,'mary');
    $r=strpos($text,'black');

}
$t2=microtime(true);
$table['strpos']=$t2-$t1;
echo \mapache_commons\Collection::generateTable($table);