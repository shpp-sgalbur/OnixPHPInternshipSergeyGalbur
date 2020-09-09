<?php
namespace lesson3;

/**
 * Description of User
 *
 * @author gal_s
 */
class User {
    private $name;
    private $balance;
    private array $products  ;
    
    public function __construct($name = '', $balance = '0') {
        $this->name = $name;
        $this->balance = $balance;
    }
    
    public function listProducts () {
        foreach ($this->products as $key => $product) {
            echo "$key) $product<br>";
            
        }
        
    }
    //вызывается в setOwner класса Product при установлении нового владельца продукта
    public function addProduct(Product $product) {
        $this->products[] = $product;
        //устанавливаем идентификатор продукта в списке продуктов юзера
        end($this->products);
        $product->setIdInOwner(key($this->products));
        
    }
    
    public function sellProduct (Product $prod,User $user) {
        
        if($prod->getOwner()->name == $this->name){
            $price = $prod->getPrice();
            if($user->balance >= $price){
                $user->balance -= $price;
                $this->balance += $price;

                $this->delProduct($prod);
                $prod->setOwner($user);
                $msg = "Пользователь $this->name продал продукт {$prod->getName()} по цене $price пользователю $user->name"."\n";
            }else{
                $msg = "Пользователь $user->name не может перечислить $price пользователю $this->name, так как имеет только $user->balance";
            }
        }else{
            $msg = "Продукт ".  $prod->__toString(). "не принадлежит пользователю $this->name. Сделка новозможна!!!";
        }
        
        return $msg;
    }
    
    private function delProduct($prod) {
        $key = $prod->getIdInOwner();
        unset($this->products[$key]);
    }
            
    
    function getName(){
        return $this->name;
    }
    
    function getBalance(){
        return $this->balance;
    }

    public function __toString() {
        return "У пользователя $this->name  сейчас на счету $this->balance грн.<br>";
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
