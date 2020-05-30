<?php

/**
 * @copyright Jorge Castro Castillo MIT License https://www.eftec.cl
 * @version 1.1           
 */

include 'Collection.php';

echo "<h1>Reference vs No Reference</h1>";
echo "<p>It tests the performance between a function that returns a value by reference versus the use of return</p>";

$result=[];

$t1=microtime(true);

$array=['a1'=>1,'a2'=>'aaaa','a3'=>50.56];

for($i=0;$i<1000000;$i++) {
    reference($array);
}



$t2=microtime(true);
$result['Reference']=$t2-$t1;


$t1=microtime(true);

$array=['a1'=>1,'a2'=>'aaaa','a3'=>50.56];

for($i=0;$i<1000000;$i++) {
    $array=noReference($array);
}
$t2=microtime(true);
$result['No Reference']=$t2-$t1;

$result['Speed of Reference %']= 100-( $result['Reference']*100 / $result['No Reference']);

echo \mapache_commons\Collection::generateTable($result);

function reference(&$array) {
    $array['a1']=2;
    $array['a2']='bbbb';
    $array['a4']=55555;
}
function noReference($array) {
    $array['a1']=2;
    $array['a2']='bbbb';
    $array['a4']=55555;
    return $array;
}