<?php

include "Collection.php";

set_time_limit(5000);

$instances=100;

echo "<h1>Hash speed ($instances instances)</h1>";
echo "<p>It tests the performance of hash</p>";


$data = "";
for($i = 0; $i < 1500; $i++) {
    $data .= sha1("H:k - $i - k:H");
}

$res = [];


foreach (hash_algos() as $algo) {
    $time = microtime(1);
    
    for($i=0;$i<$instances;$i++) {
        $hash = hash($algo, $data);
    }
    $time = (microtime(1) - $time) * 1000;
    $length = strlen($hash);

    $res[(string)$time][] = [
        'format'   => 'HEX',
        "algo"   => $algo,
        "length" => $length,
        "time"   =>  $time
    ];

    $time = microtime(1);
    for($i=0;$i<$instances;$i++) {
        $hash=hash($algo, $data, 1);
    }
    $length = strlen($hash);
    $time = (microtime(1) - $time) * 1000;

    $res[(string)$time][] = [
        'format'   => 'RAW',
        'algo'   => $algo,
        "length" => $length,
        "time"   =>  $time
    ];
}

ksort($res);
$i = 0;


$final=[];

foreach($res as $time=>$data) {

    $final[]=$data[0];
}

echo \mapache_commons\Collection::generateTable($final);
?>