<?php
include_once 'cart.php';
$_SESSION['Inventory'] = [];
class Inventory
{
    public function __construct()
    {   //Open input in command line
        echo "Add items in inventory \n";
        echo "To start type ADD:";
        $input = trim(fgets(STDIN, 1024));
        $this->checkstart($input);
        //Add sku
        echo "Add item sku:";
        $sku = trim(fgets(STDIN, 1024));
        $this->checksku($sku);
        //ADD quantity
        echo "Add quantity:";
        $quantity = trim(fgets(STDIN, 1024));
        $this->checkquantity($quantity);
        //ADD name
        echo "Add item name:";
        $name = trim(fgets(STDIN, 1024));
        $this->checkname($name);
        //ADD price
        echo "Add item price:";
        $price = trim(fgets(STDIN, 1024));
        $this->checkprice($price);
        //END or ADD to inventory
        echo "Type END to stop or ADD to add more:";
        $end = trim(fgets(STDIN, 1024));
        $this->checkend($end, $sku, $quantity, $name, $price);
        $this->add($sku, $quantity, $name, $price);
    }
    //Check all input
    //Check sku
    public function checksku($sku)
    {
        if (!is_numeric($sku)) {
            echo "SKU must be a numeric.";
            exit();
        }
         return true;    
        $this->sku[] = $sku;
    }
    //Check quantity
    public function checkquantity($quantity)
    {
        if (!is_numeric($quantity)) {
            echo "quantity must be a numeric.";
            exit();
        }
        
        $this->quantity[] = $quantity;
    }
    //Check name
    public function checkname($name)
    {
        if (is_numeric($name)) {
            echo "input must be string";
            exit();
        }
        if (empty($name)) {
            echo "Name must not be empty.";
            exit();
        }
        $this->name[] = $name;
    }
    //Check price
    public function checkprice($price)
    {
        if (!is_numeric($price)) {
            echo "input must be numeric";
            exit();
        }
        $this->price[] = $price;
    }
    //Check start
    public function checkstart($input)
    {
        if ($input == "ADD" || $input == "add") {
            $this->input[] = $input;
        
        } else {
            echo "input must be ADD";
            exit();
        }
    }
    //Check end
    public function checkend($end, $add)
    {
        if ($end == "END" || $end == "end") {
            $this->end[] = $end;
            new Cart();
        } else {
            if ($add == "ADD" || $add == "add") {
                $this->add[] = $add;
            } else {

                new Inventory();
            }
        }
    }
       //static function for adding a new item
       public static function add($sku, $quantity, $name, $price)
       {
           //if session is empty we add data to the first array key
           if(empty($_SESSION['inventory'])){
               $_SESSION['inventory'][0]=[
                  'sku'=> trim($sku[0]),
                  'name'=>trim($name[0]),
                  'quantity'=>trim($quantity[0]),
                  'price'=>trim($price[0])
              ];
              echo "Item added. You currently have 1 item in the inventory. \n";
              new Inventory();
             }
             //if session isn't empty we add new item after the last added item
             else
               {
              $count = count($_SESSION['inventory']);
              $_SESSION['inventory'][$count]=[
                  'sku'=> trim($sku[0]),
                  'name'=>trim($name[0]),
                  'quantity'=>trim($quantity[0]),
                  'price'=>trim($price[0])
              ];
              echo "You added another item. You currently have " . $count+1 ." items in the inventory. \n";
              new Inventory();
             }
          }
         
}
