<?php
include 'ProductClass.php';
class Inventory {
	private $inventory;

	public function __construct() {
		$this->inventory = array();
	}

	public function add($price, $stock, $code, $volumeSale, $volumePrice, $volumeSize, $buy1Get1, $withWhich) {
		try {
			$this->checkIsValid($price);
			if($volumeSale){
				$this->checkIsValid($volumeSize);
				$this->checkIsValid($volumePrice);
			}

			if (!$this->isInInventory($code))
				$this->inventory[$code] = new Product($price, $stock, $code, $volumeSale, $volumePrice, $volumeSize, $buy1Get1, $withWhich);
		} catch (Exception $e) {
			echo nl2br($e->getMessage() . " for Product <b>" . $code. "</b>\n");
			echo nl2br("Product <b>" . $code . "</b> cannot added into the cart\n");
		}
	}

	private function checkIsValid($price) {
		if (!is_numeric($price)) {
			throw new Exception("some feilds should be numbers");
		}
	}

	public function get($code) {
		if ($this->isInInventory($code))
			return $this->inventory[$code]; 
	}

	public function update($product){
		$this->inventory[$product->getCode()] = $product;
	}
	public function remove($code) {
		unset($this->inventory[$code]);
	}


	public function isInInventory($code) {
		return array_key_exists($code, $this->inventory);
	}

	public function setPrice($code, $price){
		if ($this->isInInventory($code)){
			$product = $this->inventory[$code];
			$product->setPrice($price);
			$this->update($product);
		}		
	}

	public function setVolumePrices($code, $volume_prices){
		if ($this->isInInventory($code)){
			$product = $this->inventory[$code];
			$product->setVolumePrice($volume_prices);
			$product->setVolumeSale(True);
			$this->update($product);
		}

	}

	public function setVolumeSize($code, $volume_size){
		if ($this->isInInventory($code)){
			$product = $this->inventory[$code];
			$product->setVolumeSize($volume_size);
			$product->setVolumeSale(True);
			$this->inventory[$code] = $product;
		}

	}

	public function setStock($code, $stock){
		if ($this->isInInventory($code)){
			$product = $this->inventory[$code];
			$product->setStock($stock);
			$this->inventory[$code] = $product;
		}
	}
}
?>

