<?php
include 'ScannedList.php';
include 'InventoryClass.php';
include 'GetFreeFirstStrategy.php';
include 'VolumeSaleFirstStrategy.php';
class Terminal {
    private $product_scanned;
    private $product_Inventory;
    private $getFreeFirstStrategy;
    private $volumeSaleFirstStrategy;
    private $_instance;


    public function __construct($product_Inventory) {
        $this->product_scanned = new ScannedList($product_Inventory);
        $this->product_Inventory = $product_Inventory;
        $this->getFreeFirstStrategy = new GetFreeFirstStrategy();
        $this->volumeSaleFirstStrategy = new VolumeSaleFirstStrategy();
    }


    public function scan($product_name) {
        if ($this->product_Inventory->isInInventory($product_name)) {
            $stock = $this->product_Inventory->get($product_name)->getStock();
            if((int)$stock >= 1){
                $cur = (int)$stock - 1;
                $this->product_Inventory->get($product_name)->setStock($cur);
                $this->product_scanned->add($product_name);
                return True;
            }
        } 
        return False;
    }


    public function getResult() {

        $price1 = $this->getFreeFirstStrategy->getResult($this->product_scanned, $this->product_Inventory);
        $price2 = $this->volumeSaleFirstStrategy->getResult($this->product_scanned, $this->product_Inventory);
        $this->product_scanned->clear();
        if($price1 <= $price2){
            return $price1;
        }else{
            return $price2;
        }
    }

    public function setPricing($product_name, $price) {
        $this->product_Inventory->setPrice($product_name, $price);
    }

    public function setVolumePricing($product_name, $volume_prices) {
        $this->product_Inventory->setVolumePrices($product_name, $volume_prices);
    }

    public function setVolumeSize($product_name, $stock) {
        $this->product_Inventory->setVolumeSize($product_name, $stock);
    }

    public function setStock($product_name, $volume_prices) {
        $this->product_Inventory->setStock($product_name, $volume_prices);
    }

    public function toString(){
        return $this->product_Inventory->get("A")->toString();
    }

    public function getInventory(){
        return $this->product_Inventory;
    }
 }
?>
