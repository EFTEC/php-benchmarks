# PHP benchmarks
It is a collection of PHP benchmarks.   Those benchmarks are aimed to be executed in most machines without any special installation or configuration. It only requires a single library (to draw the table) and nothing else much.  It doesn't require composer or any other extra component. Just download (or copy and paste) and run.



## Awards

[PHP Benchmarks: Evaluate the speed of PHP running different tasks - PHP Classes](https://www.phpclasses.org/package/11893-PHP-Evaluate-the-speed-of-PHP-running-different-tasks.html)



It is tested under PHP 7.4 / PHP 8.0 + 64bits + Windows 64 bits but you could download it and test it by yourself (it is the idea).  

## Table of contents

- [PHP benchmarks](#php-benchmarks)
  - [Table of contents](#table-of-contents)
  - [Benchmark 1, Reference vs No Reference](#benchmark-1-reference-vs-no-reference)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Bechmark 2 Hash speed](#bechmark-2-hash-speed)
    - [Result (short time is better)](#result-short-time-is-better)
  - [JSON vs Serialize](#json-vs-serialize)
    - [Result (less is better)](#result-less-is-better)
  - [DEFINE / CONST / ENV](#define--const--env)
    - [Result (less is better)](#result-less-is-better)
  - [array_map vs foreach](#array_map-vs-foreach)
    - [Result 7.x (less is better)](#result-7x-less-is-better)
    - [Result 8.x (less is better)](#result-8x-less-is-better)
  - [isset vs @ at](#isset-vs--at)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Type hinting](#type-hinting)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark eval](#benchmark-eval)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark count vs is_array and count](#benchmark-count-vs-is_array-and-count)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark is_array vs is_countable](#benchmark-is_array-vs-is_countable)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark array_key_exists vs isset](#benchmark-array_key_exists-vs-isset)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark str_contains vs str_pos](#benchmark-str_contains-vs-str_pos)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark file_exists vs is_file](#benchmark-file_exists-vs-is_file)
    - [Result (smaller is better)](#result-smaller-is-better)
  - [Benchmark array_merge vs others](#benchmark-array_merge-vs-others)
    - [Result (smaller is better)](#result-smaller-is-better)

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

| Reference                     | No Reference     | Speed of Reference % |
| :---------------------------- | :--------------- | :------------------- |
| **0.06107497215271** (faster) | 0.10248017311096 | 40.403133309913      |

Conclusion: Using a reference argument is faster than using an argument by value

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

It tests the performance between **foreach** and **array_map**

### Result 7.x (less is better) 

| foreach                       | array_map        | array_map (static) | array_map (calling a function) |
| :---------------------------- | :--------------- | :----------------- | :----------------------------- |
| **0.10213899612427** (better) | 0.18259811401367 | 0.18230390548706   | 0.17731499671936               |

### Result 8.x (less is better)

| foreach                      | array_map           | array_map (static)  | array_map (calling a function) |
| :--------------------------- | :------------------ | :------------------ | :----------------------------- |
| 0.12356901168823242 (better) | 0.19595623016357422 | 0.19472408294677734 | 0.19141697883605957            |


Conclusion: Foreach is still faster.   Between array_map and array_map (static), there is not a big difference. And using array_map with a function is slightly fast.

## isset vs @ at

[benchmark_isset_vs_at.php](benchmark_isset_vs_at.php)

This test could be a bit misleading but the goal is to benchmark the speed even when both ways returns different values.

```php
$r=isset($var); // isset (it returns true if the variable exists)
$r=@$var // at
$r= $var ?? null; // nullcol php >7.0
$r= @$var ? $exist : null; // ternary
$r=isset($var) ?? $var; // issetnull7 php>7.0
$r=isset($var) ? $var : null; // issetnull5 php>7.0
!isset($var) and $var=null; // hacky but it works (however it doesn't assigns value if the value does not exists)
```

### Result (smaller is better)

| isset               | at                 | nullcol            | ternary             | issetnull7           | issetnull5          | hacky                |
| :------------------ | :----------------- | :----------------- | :------------------ | :------------------- | :------------------ | :------------------- |
| 0.01783585548400879 | 0.3733489513397217 | 0.0551450252532959 | 0.38265109062194824 | 0.024428129196166992 | 0.02412700653076172 | 0.014414072036743164 |

Smaller is better.

Conclusion: @ is between 1 and 2 order of magnitude slower.

## Type hinting

How type hinting affects the performance?

[benchmark_types_arguments.php](benchmark_types_arguments.php)

Let's say the next code

```php
/**
 * @param DummyClass $arg1
 * @param DummyClass $arg2
 *
 * @return DummyClass
 */
function php5($arg1,$arg2){
    return new DummyClass();
}
function php7(DummyClass $arg1,DummyClass $arg2): DummyClass {
    return new DummyClass();
}
```

### Result (smaller is better)

| php5                  | php7                  |
| :-------------------- | :-------------------- |
| 0.0006339550018310547 | 0.0007991790771484375 |

Smaller is better.

**Conclusion**: In general, type hinting is around 10% slower but both methods are enough fast to made any difference.

While it could be useful but if you are using a proper IDE, then you could rely on PHPDoc, it's verbose but it is more complete and without affecting the performance.


## Benchmark eval

[benchmark_eval.php](benchmark_eval.php)

```php
$r=ping("pong"); // no eval
eval('$r=ping("pong");'); // eval 
$r=eval('return ping("pong");'); // eval 2

$fnname='ping';
$r=$fnname("pong"); // dynamic_function (calling a function using a variable)
```

### Result (smaller is better)

| no_eval              | eval                | eval2           | dynamic_function    |
| :------------------- | :------------------ | :-------------- | :------------------ |
| 0.003139972686767578 | 0.14499497413635254 | 0.1302490234375 | 0.00487518310546875 |

**Conclusion**: **Eval** is considerably slow and it should be avoided if possible

## Benchmark count vs is_array and count

[benchmark_count_isarray](benchmark_count_isarray.php)

```php
$r=@count($array1);
$r=is_array($array1)? count($array1) : null;
is_array($noarray) and $r=count($noarray);
```

### Result (smaller is better)

| count               | is_array count       | is_array count 2                   |
| :------------------ | :------------------- | :--------------------------------- |
| 0.05631399154663086 | 0.003616809844970703 | **0.0020818710327148438** (better) |

**Conclusion**: @ is consistently bad in an order of magnitude. We could gain a bit of performance using a logic operator (it only assigns the value if the value is an array)

>  Note: @count($array) crashes in PHP 8 when $array is not an object



## Benchmark is_array vs is_countable

[benchmark_is_array_countable.php](benchmark_is_array_countable.php)

```
$r=is_countable($array1);
$r=is_array($array1);
$r=gettype($noarray);
$r=get_debug_type($noarray);
```

### Result (smaller is better)

| is_countable (PHP 7.x) | is_array count        | gettype              | get_debug_type (PHP 8) |
| :--------------------- | :-------------------- | :------------------- | :--------------------- |
| 0.0044329166412353516  | 0.0022399425506591797 | 0.002468109130859375 | 0.004589080810546875   |

**Conclusion**: is_countable is surprisingly bad.  Also, get_debug_type() is slower than gettype()



## Benchmark array_key_exists vs isset

```php
$r=array_key_exists('repeated',$array1);
$r=isset($array1['repeated']);
```

[benchmark_array_key_exists_vs_isset.php]([benchmark_array_key_exists_vs_isset.php)

Note: if the key exists **$array1['repeated']** but the value is null, then isset() returns false while array_key_exists 
returns true. So they are not exactly the same.

### Result (smaller is better)

| array_key_exists    | isset                 |
| :------------------ | :-------------------- |
| 0.00333404541015625 | 0.0028688907623291016 |

**Conclusion**: isset() is the fastest by usually an 40-80%.

## Benchmark str_contains vs str_pos

[benchmark_str_contains_vs_strpos.php](benchmark_str_contains_vs_strpos.php)

```php
$r=str_contains($text,'mary');
$r=strpos($text,'mary');
```

### Result (smaller is better)

| str_contains        | strpos              |
| :------------------ | :------------------ |
| 0.09099698066711426 | 0.09030508995056152 |

They give the same performance but conceptually (if you want to see if a string exists inside other) **str_contains** is better because it always returns a boolean while **strpos** returns an **int** or a **false**.

## Benchmark file_exists vs is_file

[benchmark_file_exists_vs_is_file.php](benchmark_file_exists_vs_is_file.php)

This benchmark measures the speed of both functions where the file exists and where the file does not exist.

### Result (smaller is better)

Windows:

| file_exists       | is_file            |
| :---------------- | :----------------- |
| 3.451578140258789 | 2.0834150314331055 |

Linux:

| file_exists     | is_file           |
| :-------------- | :---------------- |
| 0.1745491027832 | 0.062805891036987 |

Conclusion: is_file() is faster in almost the double of speed and Linux is faster than Windows.

## Benchmark array_merge vs others

[benchmark_array_merge_vs_plus.php](benchmark_array_merge_vs_plus.php)

We compare array_merge() versus the rest.   We should notice that they could return different results considering if we have duplicates or if the value stored is not indexed. So, they are not always interchangeable.

```php
  $r=array_merge($array1,$array2); // array merge
  $r=array_replace($array1,$array2); // array_replay
  $r= $array1 + $array2; // plus
  $r= foreachMerge($array1,$array2); // foreach concatenates the two values using a foreach loop
```

### Result (smaller is better)

| array_merge               | array_replace            | plus                     | foreach                 |
| :------------------------ | :----------------------- | :----------------------- | :---------------------- |
| 0.015676021575927734 (12) | 0.019279003143310547 (9) | 0.014889001846313477 (9) | 0.05200004577636719 (9) |

> note: the number between parenthesis indicates the number of elements returned.
>
> array_merge(['a'=>'1','b'=>'2',1,2],['a'=>'1','b'=>'2',1,2])  returns the values ['a'=>'1','b'=>'2',1,2,1,2].  **Array_replace**, **plus** and **foreach** does not duplicates the values without indexes.

Conclusion: plus is better than array_replace and it does a similar job.  array_merge generates an acceptable performance (even the arrays has duplicates).  Also, you don't want to create your own merge using **foreach**.

## Benchmark array versus object

This benchmark tests the next functionalities:

* Create a variable.
* Then, it reads a simple value
* And it adds to the list (the list is created every round)

```php
$array_numeric=[$hello,$second,$third];

$array_not_numeric=['hello'=>$hello,'second'=>$second,'third'=>$third];

$object_constructor=DummyClass('world',0,20.3);

$object_no_constructor=new DummyClass2();
$object_no_constructor->hello='world';
$object_no_constructor->second=0;
$object_no_constructor->third=20.3;
```

What is a factory?  A factory is a function used for creating an entity (in this case, an array).

what is a constructor? A constructor is part of a class and is used to initialize the instance of the object.

### Result (smaller is better)

It is the result of the benchmarks in seconds

| array numeric no factory | array no factory    | array numeric factory | array factory       | object constructor  | object no constructor | object no constructor setter/getter | object no constructor setter/getter (magic) | object no constructor stdClass |
| :----------------------- | :------------------ | :-------------------- | :------------------ | :------------------ | :-------------------- | :---------------------------------- | :------------------------------------------ | :----------------------------- |
| 0.038275957107543945     | 0.04024696350097656 | 0.12892484664916992   | 0.15126800537109375 | 0.12696218490600586 | 0.08770990371704102   | 0.21163702011108398                 | 0.3990211486816406                          | 0.13244986534118652            |

### Result in percentage compared with the smaller result.

| array numeric no factory | array no factory | array numeric factory | array factory | object constructor | object no constructor | object no constructor setter/getter | object no constructor setter/getter (magic) | object no constructor stdClass |
| :----------------------- | :--------------- | :-------------------- | :------------ | :----------------- | :-------------------- | :---------------------------------- | :------------------------------------------ | :----------------------------- |
| 0%                       | 5.15%            | 236.83%               | 295.2%        | 231.7%             | 129.15%               | 452.92%                             | 942.49%                                     | 246.04%                        |

Conclusion:

* The difference between an array numeric and an associative array is a mere 5%, so you can say that they are the same.
* The use of an object is +100% slower but it is still acceptable in most conditions (aka it uses the double of time).
* The call to a method or the use of a constructor increases the value considerably. **Also, it's better to use an object/constructor than an array/factory.**  Why? I don't know.
* The use of setter/getters impacts the performance considerably.  If you can then you should avoid that.
* The use of magic setters and getters is horrible (almost 10 times slower).   Is it the reason why Laravel is slow?
  * Also, the setters and getters are vanilla, they don't validate if the field exists of any other validation.
* And the use of a **stdClass** (anonymous class) is also bad but not as bad as to use setter and getters.

ps: The test ran 1 million times and the difference is smaller than 0.3 seconds, so is it important?

Let's say we have 100 concurrent users (not a small number but not impossible), and we are processing and returning a list with 1000 values. It is 100x1000 = 100'000 objects.  So, if we consider 100'000 objects, then the difference is less than 0.03 seconds in the worst case. However, our systems process more than a single operation, so if we are showing a list of objects, then we also validating, showing other values, validating, reading from the database and storing into the memory and returning to the customer via a web or serialized, so this value could considerable and the use of the CPU is on-top of other processes.   It is not a big deal for a small project, but it is important for a big project.

tl/dr

```php
$customer[0]='john'; // faster but it is hard to understand
$customer['name']='john'; // almost as fast as the first one but it is clear to understand (it also uses more memory)
$customer->name='john'; // (where $customer is an object of the class Customer) slower but it still acceptable.
$customer->name='john'; // (where $customer is an object of the class stdClass) the double of slower than to use a class. 
$customer=new Customer('john'); // (constructor) even slower but is still acceptable;
$customer=factory('john'); // (where factory is an array that returns an array). Slower than the use of constructor.
$customer->setName('john'); // bad performance
$customer->name='john'; // (where the class uses a magic method) awful performance, avoid this one.
```

https://github.com/EFTEC/php-benchmarks/blob/master/benchmark_array_vs_object.php

## Echo vs Concat vs Implode

Which is faster for multiples concatenation?

| echo                | concat              | implode             |
| :------------------ | :------------------ | :------------------ |
| 0.00058293342590332 | 0.00057601928710938 | 0.00058507919311523 |

In conclusion, all of them are pretty similar.



https://github.com/EFTEC/php-benchmarks/blob/master/benchmark_echo_vs_strings.php

## Constant vs variable vs  literal

We compare the use of a constant versus a variable and a literal. All of them stores a string.

The literal is defined for each cycle.

```php
const HELLO = 'HELLO WORLD';
$variable = 'HELL WORLD';
'HELLO WORLD'
```



| constant          | variable          | literal           |
| :---------------- | :---------------- | :---------------- |
| 0.047255992889404 | 0.041103839874268 | 0.041267156600952 |
| 0.047415971755981 | 0.040828943252563 | 0.041354894638062 |
| 0.047232151031494 | 0.041209936141968 | 0.041146993637085 |
| 0.047588109970093 | 0.040886878967285 | 0.041790962219238 |
| 0.047214031219482 | 0.041198968887329 | 0.042134046554565 |
| 0.04762601852417  | 0.041079998016357 | 0.041344881057739 |
| 0.047240018844604 | 0.04153299331665  | 0.041368007659912 |
| 0.04719614982605  | 0.042517900466919 | 0.041674137115479 |
| 0.072301149368286 | 0.070401906967163 | 0.050674915313721 |
| 0.049120903015137 | 0.041906118392944 | 0.041185140609741 |

Conclusion: the constant is a bit slow in practically every case.  The use of a variable or a literal is the same, even when the literal is apparently created many times.

## Serializations

https://github.com/EFTEC/php-benchmarks/blob/master/benchmark_serialization.php

We benchmark the serialization using different methods.

* serialize (PHP serialization function)
* igbinary (pecl)
* json
* msgpack (pecl)

It is the data that was serialized

```php
$input = array();
for ($i = 0; $i < 1000; $i++) {
    $input["k-$i"] = [$i];
    $input["k-$i"]['k1'] =['a','b','c'];
    $input["k-$i"]['k1']['k2'] =['a','b',10,20,30,true];
}
```

It is complex but not really complex. It's not a huge array, just 1000 arrays with multiples dimensions (the equivalent to show a table with 1000 data and some relations)



### Serialize: (in seconds less is better)

| serialize            | igbinary_serialize | json_encode          | packer->pack (msgpack) |
| :------------------- | :----------------- | :------------------- | :--------------------- |
| 0.3174231052 154.67% | 0.2052299976 100%  | 0.2650880814 129.17% | 0.2757101059 134.34%   |

Conclusion: **igbinary** is a bit faster to serialize but the different is not as big.

### De-serialize: (in seconds less is better)

| unserialize          | igbinary_unserialize | json_decode      | packer->unpack (msgpack) |
| :------------------- | :------------------- | :--------------- | :----------------------- |
| 0.6460649967 228.28% | 0.2830090523 100%    | 1.816905975 642% | 0.6301090717 222.65%     |

Conclusion: **igbinary** is a bit faster to unserialize

### Size: (in bytes less is better)

| serialize      | igbinary_serialize | json_encode   | packer->pack (msgpack) |
| :------------- | :----------------- | :------------ | :--------------------- |
| 144789 430.05% | 33668 100%         | 72781 216.17% | 34509 102.5%           |

**Conclusion: igbinary hands down (at least in my test machine)**

Iwill try it again but with a different input value (without nested values)

```php
$input = array();
for ($i = 0; $i < 1000; $i++) {
    $input["k-$i"] = ["k-$i"];
}
```



### Serialize: (in seconds less is better)

| serialize            | igbinary_serialize   | json_encode          | packer->pack (msgpack) |
| :------------------- | :------------------- | :------------------- | :--------------------- |
| 0.05781698227 102.6% | 0.1744749546 309.63% | 0.05888605118 104.5% | 0.05634999275 100%     |

### De-serialize: (in seconds less is better)

| unserialize         | igbinary_unserialize | json_decode          | packer->unpack (msgpack) |
| :------------------ | :------------------- | :------------------- | :----------------------- |
| 0.1529650688 165.5% | 0.09242415428 100%   | 0.2922010422 316.15% | 0.1266789436 137.06%     |

### Size: (in bytes less is better)

| serialize     | igbinary_serialize | json_encode  | packer->pack (msgpack) |
| :------------ | :----------------- | :----------- | :--------------------- |
| 33789 264.33% | 13641 106.71%      | 17781 139.1% | 12783 100%             |

### Input is equals to output: (no means error)

| unserialize | igbinary_unserialize | json_decode | packer->pack (msgpack) |
| :---------- | :------------------- | :---------- | :--------------------- |
| yes         | yes                  | yes         | yes                    |

**Conclusion: msgpacker is faster serializing and in size, while igbinary is faster unserializing.**







