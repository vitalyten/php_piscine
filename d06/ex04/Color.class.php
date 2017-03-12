<?php
class Color
{
	public $red;
	public $green;
	public $blue;
	static $verbose = false;

	public static function doc()
	{
		$fd = fopen("Color.doc.txt", "r");
		while ($fd && !feof($fd))
			echo fgets($fd);
	}

	function __construct(array $clr)
	{
		if (isset($clr["red"]) && isset($clr["green"]) && isset($clr["blue"]))
		{
			$this->red = intval($clr["red"]);
			$this->green = intval($clr["green"]);
			$this->blue = intval($clr["blue"]);
		}
		else if (isset($clr["rgb"]))
		{
			$rgb = intval($clr["rgb"]);
			$this->red = ($rgb & 0xff0000) >> 16;
			$this->green = ($rgb & 0x00ff00) >> 8;
			$this->blue = $rgb & 0x0000ff;
		}
		if (Self::$verbose)
			printf("Color( red: %3d, green: %3d, blue: %3d ) constructed.\n", $this->red, $this->green, $this->blue);
	}

	function __destruct()
	{
		if (Self::$verbose)
			printf("Color( red: %3d, green: %3d, blue: %3d ) destructed.\n", $this->red, $this->green, $this->blue);
	}

	function __toString()
	{
		return (sprintf("Color( red: %3d, green: %3d, blue: %3d )", $this->red, $this->green, $this->blue));
	}

	public function add($Color)
	{
		return (new Color(array("red" => $this->red + $Color->red, "green" => $this->green + $Color->green, "blue" => $this->blue + $Color->blue)));
	}

	public function sub($Color)
	{
		return (new Color(array("red" => $this->red - $Color->red, "green" => $this->green - $Color->green, "blue" => $this->blue - $Color->blue)));
	}

	public function mult($f)
	{
		return (new Color(array("red" => $this->red * $f, "green" => $this->green * $f, "blue" => $this->blue * $f)));
	}
}
?>
