<?php

namespace lesson3;

/**
 * Description of Product
 *
 * @author gal_s
 */
abstract class Product{
    
    private $name;
    private $price;
    private User $owner;
    private $idInOwner; //идентификатор продукта в списке продуктов владельца
    private static $products;
    
    
    public function __construct($name, $price, User $owner){
        $this->name = $name;
        $this->price = $price;
        $this->registerProduct($this);
        
        $this->owner = $owner;
        $owner->addProduct($this);
        
        
    }
 
    private static function registerProduct(Product $obj){
        
        $key = spl_object_hash($obj);
        self::$products[$key] = $obj;
        
        
    }
    
    public function setIdInOwner($id){
        $this->idInOwner = $id;
    }
    
    public function getIdInOwner(){
        return $this->idInOwner ;
    }
    
    public function getOwner(){
        return $this->owner;
    }

    public function getName() {
        return $this->name;
    }
             
    function getPrice() {
        return $this->price;
    }
    
    public function setOwner(User $owner) {
        $this->owner = $owner;
        $owner->addProduct($this);
        
    }
    

    
    public function __toString() {
        return $this->name.' Цена : '.$this->price.' Владелец : '.$this->owner->getName()."\n";
    }
    
    public static function getIterator() {
        var_dump(self::$products);
        return new class(self::$products) implements \Iterator{
            private $var = array();

            public function __construct($array)
            {
                if (is_array($array)) {
                    $this->var = $array;
                }
            }

            public function rewind()
            {                
                reset($this->var);
            }

            public function current()
            {
                $var = current($this->var);
                
                return $var;
            }

            public function key() 
            {
                $var = key($this->var);
                
                return $var;
            }

            public function next() 
            {
                $var = next($this->var);
                
                return $var;
            }

            public function valid()
            {
                $key = key($this->var);
                $var = ($key !== NULL && $key !== FALSE);
                //echo "верный: $var\n";
                return $var;
            }
        }
        
        ;
    }
    
    public static function createRandomProduct (User $user){
        
        $type_prod = rand(0,1) ? 'Processor' : 'Ram';
        $price = rand(100,6000);
        $name = uniqid("name_");
        if($type_prod == 'Ram'){
            $type = uniqid("type_");
            $memory = uniqid("memory_"); 
            return new Ram($name, $price, $user, $type, $memory);
        }
        if($type_prod == 'Processor'){
            $frequency = uniqid("frequency_");
            return new Processor($name, $price, $user, $frequency);
        }
        
        

        
    }
            
}

class Processor extends Product{
    private $frequency;
    public function __construct($name, $price, User $owner, $frequency){
        parent::__construct($name, $price, $owner);
        $this->frequency = $frequency;
        //parent::registerProduct($this);
        
        

        
    }


}

class Ram extends Product{
    private  $type;
    private $memory;
        
    public function __construct($name, $price, User $owner, $type, $memory){
        parent::__construct($name, $price, $owner);
        $this->type = $type;
        $this->memory = $memory;
        //parent::registerProduct($this);
        
    }
}