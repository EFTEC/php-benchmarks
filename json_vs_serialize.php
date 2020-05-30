<?php

include "Collection.php";

$instances=1000;

echo "<h1>Json vs Serialize ($instances instances)</h1>";
echo "<p>It tests the performance of hash</p>";
$result=[];


$data=['field1'=>"hello",'field2'=>450,'field3'=>['field4'=>'hello','field5'=>450]];



// *********** json_encode
$t1=microtime(true);
    for($i=0;$i<$instances;$i++) {
        $jsonEnc=json_encode($data);
    }
$t2=microtime(true);
$result[]=['type'=>'json_encode array','time'=> ($t2-$t1)*100000];
// *********** serialize
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $ser=serialize($data);
}
$t2=microtime(true);
$result[]=['type'=>'serialize array','time'=> ($t2-$t1)*100000];

// *********** json_decode
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r1=json_decode($jsonEnc,true);
}
$t2=microtime(true);
$result[]=['type'=>'json_decode array','time'=> ($t2-$t1)*100000];
// *********** serialize
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r1=unserialize($ser);
}
$t2=microtime(true);
$result[]=['type'=>'unserialize array','time'=> ($t2-$t1)*100000];

$data=new stdClass();
$data->field1="hello";
$data->field2=450;
$data->field3=new stdClass();
$data->field3->field4="hello";
$data->field3->field5=450;

// *********** json_encode
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $jsonEnc=json_encode($data);
}
$t2=microtime(true);
$result[]=['type'=>'json_encode object stdclass','time'=> ($t2-$t1)*100000];
// *********** serialize
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $ser=serialize($data);
}
$t2=microtime(true);
$result[]=['type'=>'serialize object stdclass','time'=> ($t2-$t1)*100000];

// *********** json_decode
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r1=json_decode($jsonEnc);
}
$t2=microtime(true);
$result[]=['type'=>'json_decode object stdclass','time'=> ($t2-$t1)*100000];
// *********** serialize
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r1=unserialize($ser);
}
$t2=microtime(true);
$result[]=['type'=>'unserialize object stdclass','time'=> ($t2-$t1)*100000];


$data=new MyClass();
$data->field1="hello";
$data->field2=450;
$data->field3=new MyClass2();
$data->field3->field4="hello";
$data->field3->field5=450;

// *********** json_encode
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $jsonEnc=json_encode($data);
}
$t2=microtime(true);
$result[]=['type'=>'json_encode object','time'=> ($t2-$t1)*100000];
// *********** serialize
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $ser=serialize($data);
}
$t2=microtime(true);
$result[]=['type'=>'serialize object','time'=> ($t2-$t1)*100000];

// *********** json_decode
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r1=json_decode($jsonEnc);
}
$t2=microtime(true);
$result[]=['type'=>'json_decode object','time'=> ($t2-$t1)*100000];
// *********** serialize
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r1=unserialize($ser);
}
$t2=microtime(true);
$result[]=['type'=>'unserialize object','time'=> ($t2-$t1)*100000];




echo \mapache_commons\Collection::generateTable($result);

class MyClass {
    var $field1;
    var $field2;
    var $field3;
}
class MyClass2 {
    var $field4;
    var $field5;
}