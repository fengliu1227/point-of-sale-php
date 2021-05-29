<?php
class Product {
    private $price;
    private $stock;
    private $code;
    private $volumeSale;
    private $volumePrice;
    private $volumeSize;
    private $buy1Get1;
    private $withWhich;


    public function __construct($price, $stock, $code, $volumeSale, $volumePrice, $volumeSize, $buy1Get1, $withWhich) {
        $this->price = $price;
        $this->stock = $stock;
        $this->code = $code;
        $this->volumeSale = $volumeSale;
        $this->volumePrice = $volumePrice;
        $this->volumeSize = $volumeSize;
        $this->buy1Get1 = $buy1Get1;
        $this->withWhich = $withWhich;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $stock;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function isVolumeSale() {
        return $this->volumeSale;
    }

    public function setVolumeSale($volumeSale) {
        $this->volumeSale = $volumeSale;
    }

    public function getVolumePrice() {
        return $this->volumePrice;
    }

    public function setVolumePrice($volumePrice) {
        $this->volumePrice = $volumePrice;
    }

    public function getVolumeSize() {
        return $this->volumeSize;
    }

    public function setVolumeSize($volumeSize) {
        $this->volumeSize = $volumeSize;
    }

    public function isBuy1Get1() {
        return $this->buy1Get1;
    }

    public function setBuy1Get1($buy1Get1) {
        $this->buy1Get1 = $buy1Get1;
    }

    public function getWithWhich() {
        return $this->withWhich;
    }

    public function setWithWhich($withWhich) {
        $this->withWhich = $withWhich;
    }

    public function toString(){
        return $this->price . " ". 
    $this->stock ." ". 
    $this->code." ". 
    $this->volumeSale." ". 
    $this->volumePrice." ". 
    $this->volumeSize." ". 
    $this->buy1Get1." ". 
    $this->withWhich. "</br>";
    }
}
?>
