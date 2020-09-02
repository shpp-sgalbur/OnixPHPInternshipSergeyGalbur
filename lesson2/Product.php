<?php

namespace lesson2;

/**
 * Description of Product
 *
 * @author gal_s
 */
abstract class Product{
    private $name;
    private $price;
    private User $owner;
    private static $products;
    
    //$param is array ('name' => $name, 'price' => $price, 'owner' => $owner)
    public function __construct($param){
        $this->name = $param['name'];
        $this->price = $param['price'];
        $this->owner = $param['owner'];
    }
 
    public static function registerProduct($obj){
        
        $key = spl_object_hash($obj);
        self::$products[$key] = $obj;
        
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
            
}

class Processor extends Product{
    private $frequency;
    //$param is array ('name' => $name, 'price' => $price, 'owner' => $owner)
    public function __construct($param){
        parent::__construct($param);
        $this->frequency = $param['frequency'];
        parent::registerProduct($this);
        
        

        
    }


}

class Ram extends Product{
    private  $type;
    private $memory;
    
    //$param is array ('name' => $name, 'price' => $price, 'owner' => $owner)
    public function __construct($param){
        parent::__construct($param);
        $this->type = $param['type'];
        $this->memory = $param['memory'];
        parent::registerProduct($this);
    }
}