<?php

class ScannedList {
	private $list;
	private $inventory;

	public function __construct($inventory) {
		$this->list = array();
		$this->inventory = $inventory;
	}

	public function add($code) {
		if(!$this->inventory->isInInventory($code)){
			throw new Exception("product <b>" . $code . "</b> has not exist\n");
		}


		if (!$this->isInList($code)) {
        	$this->list[$code] = 1;

   		} else {
        	$this->list[$code]++;
    	}
	}

	public function getList(){
		return $this->list;
	}

	public function getInventory(){
    	return $this->inventory;
    }
	public function get($code) {
		if ($this->isInInventory($code))
			return $this->list[$code]; 
	}

	public function clear() {
		$this->list = array();
	}


	public function remove($code) {
		unset($this->list[$code]);
	}


	public function isInInventory($code) {
		return $this->inventory->isInInventory($code);
	}

	public function isInList($code){
		return array_key_exists($code, $this->list);
	}

	public function getResult() {
        foreach($this->list as $key=>$value) {
            echo $key. "  ". $value;
        }
    }
}
?>
