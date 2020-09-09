<?php
/*
namespace lesson1;


require_once 'lesson1/User.php';

$user1 = new User('Vasia', 100);
$user2 = new User('Olga', 100);
;
echo $user1->printStatus();
echo $user2->printStatus();

echo '<br>';
echo $user1->getProp('name')." дал ".$user2->getProp('name')." 50 грн.<br><br>";
$user1->giveMoney(50,$user2);
echo $user1->printStatus();
echo $user2->printStatus();

echo '<br>';
echo $user1->getProp('name')." должен ".$user2->getProp('name')." еще 100грн. грн.<br><br>";
$user1->giveMoney(100,$user2);
echo $user1->printStatus();
echo $user2->printStatus();
echo "==================== <br>";
*/
namespace lesson3;

require_once 'lesson3/User.php';
require_once 'lesson3/Product.php';

$user1 = new User('Vasia', 10000);
$user2 = new User('Olga', 100);
echo $user1."<br>";
echo $user2."<br>";
$o1 = new Processor('proc', 2000, $user2, 1200);
$o2 = new Processor('proc',  2000,  $user2,  '1200');
$o3 = $o1;//два одинаковых оббъекта (обе переменные ссылаются на 1 объект)
//Product::registerProduct($o3);
$o4 = new Ram('ram', 3000, $user2,'DDR', '8GB');
$o5 = new Ram('ram', 3000, $user1,'DDR', '8GB');
$o6 = $o5;//два одинаковых оббъекта (обе переменные ссылаются на 1 объект)
//Product::registerProduct($o6);

echo '<br>\\\\\\\\\\\\\\<br>';
$user1->listProducts();
echo '<br>\\\\\\\\\\\\\\<br>';
$user2->listProducts();
//echo $user1->sellProduct($o1, $user2);
echo $user2->sellProduct($o1, $user1);
echo '<br>\\\\\\\\\\\\\\<br>';
$user1->listProducts();
echo '<br>\\\\\\\\\\\\\\<br>';
$user2->listProducts();
echo $user1."<br>";
echo $user2."<br>";
echo '||||||||||||||||||||||<br>';
Product::createRandomProduct($user1);
Product::createRandomProduct($user1);
Product::createRandomProduct($user1);
$user1->listProducts();
for($i=0; $i<4;$i++){  
    $obj_name = $user2->getName()."_obj$i";
    echo $obj_name.'<br>';
    $$obj_name = Product::createRandomProduct($user2);
}
$user2->listProducts();
$obj = $user2->getName().'_obj2';
echo $user2->sellProduct( $$obj, $user1);
echo '<br>';
$user1->listProducts();
$user2->listProducts();
echo $user1."<br>";
echo $user2."<br>";