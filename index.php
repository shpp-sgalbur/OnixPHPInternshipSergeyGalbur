<?php
namespace lesson1;


require_once 'lesson1/User.php';
$user1 = new User('Vasia', 100);
$user2 = new User('Olga', 100);
;
$user1->printStatus();
$user2->printStatus();

echo '<br>';
echo $user1->getProp('name')." дал ".$user2->getProp('name')." 50 грн.<br><br>";
$user1->giveMoney(50,$user2);
$user1->printStatus();
$user2->printStatus();

echo '<br>';
echo $user1->getProp('name')." должен ".$user2->getProp('name')." еще 100грн. грн.<br><br>";
$user1->giveMoney(100,$user2);
$user1->printStatus();
$user2->printStatus();

namespace lesson2;


require_once 'lesson2/User.php';
$user1 = new User('Vasia', 100);
$user2 = new User('Olga', 100);
;
$user1->printStatus();
$user2->printStatus();

echo '<br>';
echo $user1->getProp('name')." дал ".$user2->getProp('name')." 50 грн.<br><br>";
$user1->giveMoney(50,$user2);
$user1->printStatus();
$user2->printStatus();

echo '<br>';
echo $user1->getProp('name')." должен ".$user2->getProp('name')." еще 100грн. грн.<br><br>";
$user1->giveMoney(100,$user2);
$user1->printStatus();
$user2->printStatus();
