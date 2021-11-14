<?php
class Cart
{

    public function __construct()
    {   // Start second stage (cart)
        echo "Adds an item in the current shopping cart: \n";
        echo "Add item sku:";
        $sku = trim(fgets(STDIN, 1024));
        $this->checksku($sku);
        echo "Add quantity:";
        $quantity = trim(fgets(STDIN, 1024));
        $this->checkquantity($quantity);
    }
    //static function for adding a new item
    public static function add($sku, $quantity)
    {
        //if session is empty we add data to the first array key
        if (empty($_SESSION['Cart'])) {
            $_SESSION['Cart'] = [
                'sku' => trim($sku[1]),
                'quantity' => trim($quantity[4]),
            ];
            
        }
    }
    //Ckecks all input
    //checks if sku is valid
    public function checksku($sku)
    {
        if (!is_numeric($sku)) {
            echo "input must be numeric";
            exit();
        }
        $this->sku[1] = $sku;
    }
    //checks if quantity is valid
    public function checkquantity($quantity)
    {
        if (!is_numeric($quantity)) {
            echo "input must be numeric";
            exit();
        }
        $this->quantity[3] = $quantity;
    }
    
    
}
