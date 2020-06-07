# PHP benchmarks
It is a collection of PHP benchmarks

It is tested under PHP 7.4 + 64bits + Windows 64 bits but you could download it and test it by yourself (it is the idea)

[TOC]



## Benchmark 1, Reference vs No Reference

Is it fast to use a reference argument or return a value?

[reference_vs_no_reference.php](reference_vs_no_reference.php)

```
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
```

### Result (smaller is better)

| Reference        | No Reference     | Speed of Reference % |
| :--------------- | :--------------- | :------------------- |
| 0.06107497215271 | 0.10248017311096 | 40.403133309913      |



## Bechmark 2 Hash speed

We test the benchmark of the generation of hash.

[benchmark_hash.php](benchmark_hash.php)

HEX means that the result is resulted in HEXADECIMAL.  

RAW means the result is binary. Sometimes HEX=RAW.  



### Result (short time is better)



| format | algo        | length | time            |
| :----- | :---------- | :----- | :-------------- |
| HEX    | adler32     | 8      | 4.6730041503906 |
| RAW    | adler32     | 4      | 4.7018527984619 |
| RAW    | fnv164      | 8      | 6.2000751495361 |
| HEX    | fnv1a32     | 8      | 6.2048435211182 |
| HEX    | fnv132      | 8      | 6.2098503112793 |
| RAW    | fnv132      | 4      | 6.2119960784912 |
| HEX    | fnv164      | 16     | 6.2189102172852 |
| HEX    | fnv1a64     | 16     | 6.2229633331299 |
| RAW    | fnv1a32     | 4      | 6.227970123291  |
| RAW    | tiger192,3  | 24     | 8.040189743042  |
| RAW    | tiger160,3  | 20     | 8.0409049987793 |
| HEX    | tiger160,3  | 40     | 8.0428123474121 |
| HEX    | tiger192,3  | 48     | 8.0468654632568 |
| HEX    | tiger128,3  | 32     | 8.0511569976807 |
| RAW    | tiger128,3  | 16     | 8.2709789276123 |
| RAW    | md4         | 16     | 8.6510181427002 |
| HEX    | md4         | 32     | 8.6619853973389 |
| RAW    | joaat       | 4      | 9.3100070953369 |
| HEX    | joaat       | 8      | 9.3538761138916 |
| RAW    | md5         | 16     | 10.200977325439 |
| HEX    | md5         | 32     | 10.215997695923 |
| RAW    | tiger128,4  | 16     | 10.791063308716 |
| HEX    | tiger160,4  | 40     | 10.793924331665 |
| RAW    | tiger160,4  | 20     | 10.806083679199 |
| RAW    | tiger192,4  | 24     | 10.81109046936  |
| HEX    | tiger128,4  | 32     | 10.812044143677 |
| HEX    | tiger192,4  | 48     | 10.833978652954 |
| HEX    | sha1        | 40     | 11.46388053894  |
| RAW    | sha1        | 20     | 11.497020721436 |
| HEX    | crc32c      | 8      | 16.038179397583 |
| RAW    | crc32c      | 4      | 16.067028045654 |
| HEX    | sha3-224    | 56     | 16.110181808472 |
| RAW    | sha3-224    | 28     | 16.110897064209 |
| HEX    | crc32b      | 8      | 16.125917434692 |
| RAW    | crc32b      | 4      | 16.162872314453 |
| HEX    | sha512/224  | 56     | 17.075777053833 |
| HEX    | sha512      | 128    | 17.086982727051 |
| RAW    | sha512/224  | 28     | 17.08984375     |
| HEX    | sha3-256    | 64     | 17.097949981689 |
| RAW    | sha384      | 48     | 17.104864120483 |
| RAW    | sha512      | 64     | 17.114877700806 |
| RAW    | crc32       | 4      | 17.119884490967 |
| HEX    | sha512/256  | 64     | 17.130136489868 |
| RAW    | sha512/256  | 32     | 17.167806625366 |
| HEX    | crc32       | 8      | 17.171859741211 |
| HEX    | sha384      | 96     | 17.177820205688 |
| HEX    | haval160,3  | 40     | 17.213106155396 |
| RAW    | haval160,3  | 20     | 17.232179641724 |
| HEX    | haval128,3  | 32     | 17.246961593628 |
| HEX    | haval192,3  | 48     | 17.338037490845 |
| RAW    | haval128,3  | 16     | 17.502069473267 |
| RAW    | haval256,3  | 32     | 17.529964447021 |
| RAW    | haval224,3  | 28     | 17.548799514771 |
| RAW    | haval192,3  | 24     | 17.639875411987 |
| HEX    | haval224,3  | 56     | 17.678022384644 |
| HEX    | haval256,3  | 64     | 17.735958099365 |
| HEX    | ripemd256   | 64     | 20.03002166748  |
| RAW    | ripemd256   | 32     | 20.137071609497 |
| RAW    | ripemd128   | 16     | 20.437002182007 |
| HEX    | ripemd128   | 32     | 20.43890953064  |
| HEX    | sha3-384    | 96     | 22.219181060791 |
| RAW    | sha3-384    | 48     | 22.259950637817 |
| RAW    | haval256,4  | 32     | 24.071931838989 |
| HEX    | haval256,4  | 64     | 24.100065231323 |
| RAW    | haval224,4  | 28     | 24.12486076355  |
| HEX    | haval224,4  | 56     | 24.132966995239 |
| RAW    | haval192,4  | 24     | 24.198055267334 |
| HEX    | haval160,4  | 40     | 24.597883224487 |
| HEX    | haval192,4  | 48     | 24.653911590576 |
| RAW    | haval160,4  | 20     | 24.665832519531 |
| HEX    | haval128,4  | 32     | 24.919033050537 |
| RAW    | haval128,4  | 16     | 25.200128555298 |
| RAW    | sha224      | 28     | 25.952100753784 |
| RAW    | sha256      | 32     | 25.97713470459  |
| HEX    | sha224      | 56     | 26.051044464111 |
| HEX    | sha256      | 64     | 26.114940643311 |
| HEX    | ripemd320   | 80     | 28.150081634521 |
| HEX    | ripemd160   | 40     | 28.232097625732 |
| RAW    | ripemd160   | 20     | 28.304100036621 |
| RAW    | ripemd320   | 40     | 28.388977050781 |
| HEX    | haval224,5  | 56     | 29.100894927979 |
| RAW    | haval256,5  | 32     | 29.104948043823 |
| HEX    | haval160,5  | 40     | 29.134035110474 |
| HEX    | haval256,5  | 64     | 29.13498878479  |
| RAW    | haval224,5  | 28     | 29.138088226318 |
| RAW    | haval160,5  | 20     | 29.186964035034 |
| RAW    | haval192,5  | 24     | 29.205083847046 |
| RAW    | haval128,5  | 16     | 29.221057891846 |
| HEX    | haval128,5  | 32     | 29.263973236084 |
| HEX    | haval192,5  | 48     | 29.27303314209  |
| HEX    | sha3-512    | 128    | 32.00101852417  |
| RAW    | sha3-512    | 64     | 32.001972198486 |
| RAW    | whirlpool   | 64     | 50.601005554199 |
| HEX    | whirlpool   | 128    | 50.703048706055 |
| HEX    | gost        | 64     | 95.890998840332 |
| RAW    | gost        | 32     | 95.905780792236 |
| RAW    | gost-crypto | 32     | 95.912933349609 |
| HEX    | gost-crypto | 64     | 95.93391418457  |
| HEX    | snefru      | 64     | 195.09100914001 |
| HEX    | snefru256   | 64     | 195.57094573975 |
| RAW    | snefru256   | 32     | 195.965051651   |
| RAW    | snefru      | 32     | 197.18909263611 |
| RAW    | md2         | 16     | 830.39283752441 |
| HEX    | md2         | 32     | 838.06991577148 |



## JSON vs Serialize

It benchmark to serialize and de-serialize variables

[json_vs_serialize.php](json_vs_serialize.php)

array

```php
$data=['field1'=>"hello",'field2'=>450,'field3'=>['field4'=>'hello','field5'=>450]];
```

object StdClass

```php
$data=new stdClass();
$data->field1="hello";
$data->field2=450;
$data->field3=new stdClass();
$data->field3->field4="hello";
$data->field3->field5=450;
```

object (defined by a class)

```php
$data=new MyClass();
$data->field1="hello";
$data->field2=450;
$data->field3=new MyClass2();
$data->field3->field4="hello";
$data->field3->field5=450;
```



### Result (less is better)

| type                        | time                         |
| :-------------------------- | :--------------------------- |
| json_encode array           | 23.508071899414              |
| serialize array             | **20.003318786621** (better) |
| json_decode array           | 120.9020614624               |
| unserialize array           | 39.196014404297              |
| json_encode object stdclass | 24.199485778809              |
| serialize object stdclass   | 32.901763916016              |
| json_decode object stdclass | 127.10094451904              |
| unserialize object stdclass | 102.61535644531              |
| json_encode object          | 24.39022064209               |
| serialize object            | 32.877922058105              |
| json_decode object          | 126.21879577637              |
| unserialize object          | **129.1036605835** (worst)   |



## DEFINE / CONST / ENV

We test the performance between to read an environment variable or to use a constant.



### Result (less is better)

| DEFINE CONST        | CONST               | getEnv()          | function            |
| :------------------ | :------------------ | :---------------- | ------------------- |
| 0.00066995620727539 | 0.00067687034606934 | 0.056761026382446 | 0.00053286552429199 |

Conclusion, **define()** and **const** have practically the same performance (at least in PHP 7.4), while **getEnv()** is considerably bad.  However,getEnv() is acceptable even when it is 10000% slower (50000 getEnv() took 50ms.).

We also tested to call a function and it is way fast than getEnv()

> Conclusion: getEnv() is not cached neither it is loaded into PHP. Instead, it is calculated each time when it is called.



## array_map vs foreach

[benchmark_arraymap_foreach.php](benchmark_arraymap_foreach.php)

The test the performance between **foreach** and **array_map**

### Result (less is better)

| foreach                       | array_map        | array_map (static) | array_map (calling a function) |
| :---------------------------- | :--------------- | :----------------- | :----------------------------- |
| **0.10213899612427** (better) | 0.18259811401367 | 0.18230390548706   | 0.17731499671936               |

Conclusion: Foreach is still faster.   Between array_map and array_map (static), there is not a big difference. And using array_map with a function is slightly fast.

