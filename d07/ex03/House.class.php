<?php
abstract class House
{
	public function introduce()
	{
		echo "House ".$this->getHouseName()." of ".$this->getHouseSeat()." : \"".$this->getHouseMotto()."\"\n";
	}

	abstract function getHouseName();
	abstract function getHouseSeat();
	abstract function getHouseMotto();
}
?>
