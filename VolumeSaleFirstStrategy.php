<?php
class VolumeSaleFirstStrategy{
    private $TAX = 0.1;

    public function getResult($scannedList, $inventory) {
        $result = 0;
        
		$list = $scannedList->getList();
        foreach($list as $key=>$value) {
			if ($inventory->get($key)->isVolumeSale() && $inventory->get($key)->getVolumeSize() != 0
				&& $value >= $inventory->get($key)->getVolumeSize()){
				$result += $inventory->get($key)->getVolumePrice() * ($value / $inventory->get($key)->getVolumeSize()) + ($value % $inventory->get($key)->getVolumeSize()) * $inventory->get($key)->getPrice();
			} else{
				$result += $value * $inventory->get($key)->getPrice();
			}
				
		

			if($inventory->get($key)->isBuy1Get1() && $scannedList->isInList($inventory->get($key)->getWithWhich())){

				if ($inventory->get($key)->isVolumeSale() && $inventory->get($key)->getVolumeSize() >= $value){
					$nums = $value - $inventory->get($key)->getVolumeSize();
					$result -= $list[$inventory->get($key)->getWithWhich()] * $nums;
				} else{
					$nums = $list[$inventory->get($key)->getWithWhich()];
					if($nums > $value){
						$nums = $value;
					}
					$result -= $nums * $inventory->get($key)->getPrice();
				}
			}
		}

		return $result + $result * $this->TAX;
    }
}
?>
