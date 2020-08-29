<?php
namespace lesson1;

/**
 * Description of User
 *
 * @author gal_s
 */
class User {
    private $name;
    private $balance;
    
    public function __construct($name = '', $balance = '0') {
        $this->name = $name;
        $this->balance = $balance;
    }
    
    function getName(){
        return $this->name;
    }
    
    function getBalance(){
        return $this->balance;
    }

    public function printStatus() {
        echo "У пользователя $this->name  сейчас на счету $this->balance грн.<br>";
    }
    
    public function giveMoney($amount, $user) {
        if($this->balance > $amount){
            $this->balance -= $amount;
            $user->takeMoney($amount);
        }else{
            $this->balance = 0;
            $user->takeMoney($this->balance);
            
        }
        
    }
    
    private function takeMoney($amount){
        $this->balance += $amount;
    }
    
    public function getProp($prop) {
        return $this->$prop;
    }
}
