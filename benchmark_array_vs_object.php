<?php

//phpinfo();

include "Collection.php";

$instances=1000000;



class DummyClass {
    public $hello;
    public $second;
    public $third;

    /**
     * DummyClass constructor.
     * @param $hello
     * @param $second
     * @param $third
     */
    public function __construct($hello, $second,$third)
    {
        $this->hello = $hello;
        $this->second = $second;
        $this->third = $third;
    }
}
class DummyClass2 {
    public $hello;
    public $second;
    public $third;
}

class DummyClass3 {
    protected $hello;
    protected $second;
    protected $third;

    /**
     * @return mixed
     */
    public function getHello()
    {
        return $this->hello;
    }

    /**
     * @param mixed $hello
     */
    public function setHello($hello): void
    {
        $this->hello = $hello;
    }

    /**
     * @return mixed
     */
    public function getSecond()
    {
        return $this->second;
    }

    /**
     * @param mixed $second
     */
    public function setSecond($second): void
    {
        $this->second = $second;
    }

    /**
     * @return mixed
     */
    public function getThird()
    {
        return $this->third;
    }

    /**
     * @param mixed $third
     */
    public function setThird($third): void
    {
        $this->third = $third;
    }


}

class DummyClass3Magic {
    protected $hello;
    protected $second;
    protected $third;

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }


}

//#[ArrayShape(['hello' => "", 'second' => ""])]
function factory($hello, $second,$third) {
    return ['hello'=>$hello,'second'=>$second,'third'=>$third];
}
function factoryNumeric($hello, $second,$third) {
    return [$hello,$second,$third];
}
// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummy=['world',0,20.3];
    $nothing=$dummy[1];
    $list[]=$dummy;
}
$t2=microtime(true);
$table['array numeric no factory']=$t2-$t1;

// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummy=['hello'=>'world','second'=>0,'third'=>20.3];
    $nothing=$dummy['second'];
    $list[]=$dummy;
}
$t2=microtime(true);
$table['array no factory']=$t2-$t1;
// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummy=factoryNumeric('world',0,20.3);
    $nothing=$dummy[1];
    $list[]=$dummy;
}
$t2=microtime(true);
$table['array numeric factory']=$t2-$t1;
// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummy=factory('world',0,20.3);
    $nothing=$dummy['second'];
    $list[]=$dummy;
}
$t2=microtime(true);
$table['array factory']=$t2-$t1;
// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummyObj=new DummyClass('world',0,20.3);
    $nothing=$dummyObj->second;
    $list[]=$dummyObj;
}
$t2=microtime(true);
$table['object constructor']=$t2-$t1;

// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummyObj=new DummyClass2();
    $dummyObj->hello='world';
    $dummyObj->second=0;
    $dummyObj->third=20.3;
    $nothing=$dummyObj->second;
    $list[]=$dummyObj;
}
$t2=microtime(true);
$table['object no constructor']=$t2-$t1;
// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummyObj=new DummyClass3();
    $dummyObj->setHello('world');
    $dummyObj->setSecond(0);
    $dummyObj->setThird(20.3);
    $nothing=$dummyObj->getSecond();
    $list[]=$dummyObj;
}
$t2=microtime(true);
$table['object no constructor setter/getter']=$t2-$t1;

// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummyObj=new DummyClass3Magic();
    $dummyObj->hello='world';
    $dummyObj->second=0;
    $dummyObj->third=20.3;
    $nothing=$dummyObj->second;
    $list[]=$dummyObj;
}
$t2=microtime(true);
$table['object no constructor setter/getter (magic)']=$t2-$t1;


// **********************************************************************************
$list=[];
$t1=microtime(true);
for($i=0;$i<$instances;$i++) {
    $dummyObj=new stdClass();
    $dummyObj->hello='world';
    $dummyObj->second=0;
    $dummyObj->third=20.3;
    $nothing=$dummyObj->second;
    $list[]=$dummyObj;
}
$t2=microtime(true);
$table['object no constructor stdClass']=$t2-$t1;

$min=min($table);

echo \mapache_commons\Collection::generateTable($table);

$tablePercent=[];
foreach($table as $k=>$v) {
    $tablePercent[$k]=round($v/$min*100 - 100,2).'%';
}

echo \mapache_commons\Collection::generateTable($tablePercent);