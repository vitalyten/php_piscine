<?php
class UnholyFactory
{
	private $_absorbed = array();

	public function absorb($fighter)
	{
		if ($fighter instanceof Fighter)
		{
			foreach ($this->_absorbed as $val)
				if ($val->getType() === $fighter->getType())
				{
					echo "(Factory already absorbed a fighter of type ".$fighter->getType().")\n";
					return;
				}
			echo "(Factory absorbed a fighter of type ".$fighter->getType().")\n";
			$this->_absorbed[] = $fighter;
		}
		else
			echo "(Factory can't absorb this, it's not a fighter)\n";
	}

	public function fabricate($type)
	{
		foreach ($this->_absorbed as $val)
		{
			if ($val->getType() === $type)
			{
				echo "(Factory fabricates a fighter of type ".$val->getType().")\n";
				return (clone $val);
			}
		}
		echo "(Factory hasn't absorbed any fighter of type ".$type.")\n";
		return NULL;
	}
}
?>
