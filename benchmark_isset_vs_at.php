<?php
$dummy=30;


//!isset($dummy) && $dummy='ok';
//var_dump($dummy);
//die(1);

$numbers = range(0, 1000);

include "Collection.php";

$instances=1000000;

$exist=true;

// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=isset($exist);
    $r2=isset($noexist);
}
$t2=microtime(true);
$table['isset']=$t2-$t1;

// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r=@$exist;
    $r2=@$noexist;
}
$t2=microtime(true);
$table['at']=$t2-$t1;

// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r= $exist ?? null;
    $r2= $noexist ?? null;
}
$t2=microtime(true);
$table['nullcol']=$t2-$t1;

// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r= @$exist ? $exist : null;
    $r2= @$noexist ? $noexist : null;
}
$t2=microtime(true);
$table['ternary']=$t2-$t1;


// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r= isset($exist) ?? null;
    $r2= isset($noexist) ?? null;
}
$t2=microtime(true);
$table['issetnull7']=$t2-$t1;

// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $r= isset($exist) ? $exist : null;
    $r2= isset($noexist) ? $noexist : null;
}
$t2=microtime(true);
$table['issetnull5']=$t2-$t1;

// **********************************************************************************
unset($noexist);
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    !isset($exist) and $exist=null;
    !isset($noexist) and $noexist=null;
}
$t2=microtime(true);
$table['hacky']=$t2-$t1;

echo \mapache_commons\Collection::generateTable($table);