<?php
class Camera
{
	static $verbose = false;
	private $_origin;
	private $_width;
	private $_height;
	private $_ratio;
	private $_tT;
	private $_tR;
	private $_projection;

	public static function doc()
	{
		$fd = fopen("Camera.doc.txt", "r");
		while ($fd && !feof($fd))
			echo fgets($fd);
	}

	function __construct(array $cam)
	{
		$this->_origin = $cam["origin"];

		$this->_tT = new Matrix(array("preset" => Matrix::TRANSLATION, "vtc" => new Vector(array("dest" => new Vertex(array("x" => ($this->_origin->getX() * -1), "y" => ($this->_origin->getY() * -1), "z" => ($this->_origin->getZ() * -1)))))));

		$this->_tR = $this->_diagSym($cam["orientation"]);
		$this->_width = $cam["width"];
		$this->_height = $cam["height"];
		$this->_ratio = $this->_width / $this->_height;
		$this->_projection = new Matrix(array("preset" => "PROJECTION", "fov" => $cam["fov"],
			"ratio" => $this->_ratio, "near" => $cam["near"], "far" => $cam["far"]));
		if (self::$verbose)
			echo "Camera instance constructed\n";
	}

	function __destruct()
	{
		if (self::$verbose)
			echo "Camera instance destructed\n";
	}

	function __toString()
	{
		return ("Camera( \n+ Origine: ".$this->_origin."\n+ tT:\n".$this->_tT."\n+ tR:\n".
			$this->_tR."\n+ tR->mult( tT ):\n".$this->_tR->mult($this->_tT)."\n+ Proj:\n".$this->_projection."\n)");
	}

	private function _diagSym(Matrix $m)
	{
		$m->_matrix = array(
			array($m->_matrix[0][0], $m->_matrix[1][0], $m->_matrix[2][0], $m->_matrix[3][0]),
			array($m->_matrix[0][1], $m->_matrix[1][1], $m->_matrix[2][1], $m->_matrix[3][1]),
			array($m->_matrix[0][2], $m->_matrix[1][2], $m->_matrix[2][2], $m->_matrix[3][2]),
			array($m->_matrix[0][3], $m->_matrix[1][3], $m->_matrix[2][3], $m->_matrix[3][3]));
		return ($m);
	}

	public function watchVertex(Vertex $worldVertex)
	{
		$vrt = $this->_projection->transformVertex($this->_tR->transformVertex($worldVertex));
		$vrt->setX($vrt->getX() * $_this->_ratio);
		$vrt->setY($vrt->getY());
		$vrt->setColor($worldVertex->getColor());
		return ($vrt);
	}
}
?>
