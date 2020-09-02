<?php
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

namespace lesson2;

require_once 'lesson2/User.php';
require_once 'lesson2/Product.php';

$user1 = new User('Vasia', 100);
$user2 = new User('Olga', 100);

$o1 = new Processor(['name' => 'proc', 'frequency' => 2000, 'price' => '1200', 'owner' => $user2]);
$o2 = new Processor(['name' => 'proc', 'frequency' => 2000, 'price' => '1200', 'owner' => $user2]);
$o3 = $o1;//два одинаковых оббъекта (обе переменные ссылаются на 1 объект)
$o4 = new Ram(['name'=>'ram', 'price'=>'3000','owner' => $user2,'type'=>'DDR', 'memory'=> '8GB']);
$o5 = new Ram(['name'=>'ram', 'price'=>'3000','owner' => $user1,'type'=>'DDR', 'memory'=> '8GB']);
$o6 = $o5;//два одинаковых оббъекта (обе переменные ссылаются на 1 объект)
$it = Product::getIterator();
foreach ($it as  $value) {
    print "$value";
    
}