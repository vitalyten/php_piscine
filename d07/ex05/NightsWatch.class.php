<?php
class NightsWatch
{
	private $_army = array();

	public function recruit($person)
	{
		$this->_army[] = $person;
	}

	public function fight()
	{
		foreach ($this->_army as $person)
			if ($person instanceof IFighter)
				$person->fight();
	}
}
?>
