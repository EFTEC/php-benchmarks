<?php
include "Collection.php";

ini_set('memory_limit', -1);
// nested
$input = array();
for ($i = 0; $i < 1000; $i++) {
    $input["k-$i"] = [$i];
    $input["k-$i"]['k1'] =['a','b','c'];
    $input["k-$i"]['k1']['k2'] =['a','b',10,20,30,true];
}
// simple
/*$input = array();
for ($i = 0; $i < 1000; $i++) {
    $input["k-$i"] = ["k-$i",20];
}
*/

$instances=1000;
// php
$t1 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $ser=serialize($input);
}
$t2 = microtime(true);
$t3 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $b=unserialize($ser);
}
$t4 = microtime(true);
$table['serialize'] = $t2 - $t1;
$tableunser['unserialize'] = $t4 - $t3;
$tablesize['serialize'] = strlen($ser);
$tablecomp['unserialize'] = ($b===$input)?'yes':'no';

// igbinary
$t1 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $ser=igbinary_serialize($input);
}
$t2 = microtime(true);
$t3 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $b=igbinary_unserialize($ser);
}
$t4 = microtime(true);
$table['igbinary_serialize'] = $t2 - $t1;
$tableunser['igbinary_unserialize'] = $t4 - $t3;
$tablesize['igbinary_serialize'] = strlen($ser);
$tablecomp['igbinary_unserialize'] = ($b===$input)?'yes':'no';


$t1 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $ser=json_encode($input);
}
$t2 = microtime(true);
$t3 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $b=json_decode($ser,true);
}
$t4 = microtime(true);
$table['json_encode'] = $t2 - $t1;
$tableunser['json_decode'] = $t4 - $t3;
$tablesize['json_encode'] = strlen($ser);
$tablecomp['json_decode'] = ($b===$input)?'yes':'no';

// msgpack
$packer = new \MessagePack(false);
$t1 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $ser=$packer->pack($input);
}
$t2 = microtime(true);
$t3 = microtime(true);
for ($i = 0; $i < $instances; $i++) {
    $b=$packer->unpack($ser);
}
$t4 = microtime(true);
$table['packer->pack (msgpack)'] = $t2 - $t1;
$tableunser['packer->unpack (msgpack)'] = $t4 - $t3;
$tablesize['packer->pack (msgpack)'] = strlen($ser);
$tablecomp['packer->pack (msgpack)'] = ($b===$input)?'yes':'no';


echo "<h3>Serialize: (in seconds less is better)</h3>";
echo \mapache_commons\Collection::generateTable($table,true,true);
echo "<h3>De-serialize: (in seconds less is better)</h3>";
echo \mapache_commons\Collection::generateTable($tableunser,true,true);
echo "<h3>Size: (in bytes less is better)</h3>";
echo \mapache_commons\Collection::generateTable($tablesize,true,true);
echo "<h3>Input is equals to output: (no means error)</h3>";
echo \mapache_commons\Collection::generateTable($tablecomp,true);
echo "<br>";
echo "<br>";
