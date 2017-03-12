<?php
require_once "Color.class.php";

class Vertex
{
	private $_x;
	private $_y;
	private $_z;
	private $_w = 1;
	private $_color;
	static $verbose = false;

	public static function doc()
	{
		$fd = fopen("Vertex.doc.txt", "r");
		while ($fd && !feof($fd))
			echo fgets($fd);
	}

	function __construct(array $vrt)
	{
		$this->_x = $vrt["x"];
		$this->_y = $vrt["y"];
		$this->_z = $vrt["z"];
		if (isset($vrt["w"]))
			$this->_w = $vrt["w"];
		if (isset($vrt["color"]) && $vrt["color"] instanceof Color)
			$this->_color = $vrt["color"];
		else
			$this->_color = new Color(array("rgb" => 0xffffff));
		if (Self::$verbose)
			printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) constructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	function __destruct()
	{
		if (Self::$verbose)
			printf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) ) destructed\n",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue);
	}

	function __toString()
	{
		if (Self::$verbose)
			return (sprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f, Color( red: %3d, green: %3d, blue: %3d ) )",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color->red, $this->_color->green, $this->_color->blue));
		return (sprintf("Vertex( x: %0.2f, y: %0.2f, z:%0.2f, w:%0.2f )", $this->_x, $this->_y, $this->_z, $this->_w));
	}

	public function getX()
	{
		return ($this->_x);
	}

	public function setX($x)
	{
		$this->_x = $x;
	}

	public function getY()
	{
		return ($this->_y);
	}

	public function setY($y)
	{
		$this->_y = $y;
	}

	public function getZ()
	{
		return ($this->_z);
	}

	public function setZ($z)
	{
		$this->_z = $z;
	}

	public function getW()
	{
		return ($this->_w);
	}

	public function setW($w)
	{
		$this->_w = $w;
	}

	public function getColor()
	{
		return ($this->_color);
	}

	public function setColor($color)
	{
		$this->_color = $color;
	}
}
?>
