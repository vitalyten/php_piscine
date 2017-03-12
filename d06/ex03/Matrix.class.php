<?php
class Matrix
{
	const IDENTITY = "IDENTITY";
	const SCALE = "SCALE";
	const RX = "Ox ROTATION";
	const RY = "Oy ROTATION";
	const RZ = "Oz ROTATION";
	const TRANSLATION = "TRANSLATION";
	const PROJECTION = "PROJECTION";

	public $_matrix;
	private $_preset;
	private $_scale;
	private $_angle;
	private $_vtc;
	private $_fov;
	private $_ratio;
	private $_near;
	private $_far;

	static $verbose = false;

	public static function doc()
	{
		$fd = fopen("Matrix.doc.txt", "r");
		while ($fd && !feof($fd))
			echo fgets($fd);
	}

	public function __construct(array $m = NULL)
	{
		if (isset($m))
		{
			if (isset($m["preset"])) $this->_preset = $m["preset"];
			if (isset($m["scale"])) $this->_scale = $m["scale"];
			if (isset($m["angle"])) $this->_angle = $m["angle"];
			if (isset($m["vtc"])) $this->_vtc = $m["vtc"];
			if (isset($m["fov"])) $this->_fov = $m["fov"];
			if (isset($m["ratio"])) $this->_ratio = $m["ratio"];
			if (isset($m["near"])) $this->_near = $m["near"];
			if (isset($m["far"])) $this->_far = $m["far"];
		}
		$this->_matrix = array(
			array(0, 0, 0, 0),
			array(0, 0, 0, 0),
			array(0, 0, 0, 0),
			array(0, 0, 0, 0));
		if (self::$verbose && $m)
		{
			if ($this->_preset === self::IDENTITY)
				echo "Matrix IDENTITY instance constructed\n";
			else
				echo "Matrix " . $this->_preset . " preset instance constructed\n";
		}
		$this->fillMatrix();
	}


	function __destruct()
	{
		if (Self::$verbose) print("Matrix instance destructed\n");
	}

	function __toString()
	{
		return (sprintf("M | vtcX | vtcY | vtcZ | vtxO\n-----------------------------\nx | %0.2f | %0.2f | %0.2f | %0.2f\ny | %0.2f | %0.2f | %0.2f | %0.2f\nz | %0.2f | %0.2f | %0.2f | %0.2f\nw | %0.2f | %0.2f | %0.2f | %0.2f",
			$this->_matrix[0][0], $this->_matrix[0][1], $this->_matrix[0][2], $this->_matrix[0][3],
			$this->_matrix[1][0], $this->_matrix[1][1], $this->_matrix[1][2], $this->_matrix[1][3],
			$this->_matrix[2][0], $this->_matrix[2][1], $this->_matrix[2][2], $this->_matrix[2][3],
			$this->_matrix[3][0], $this->_matrix[3][1], $this->_matrix[3][2], $this->_matrix[3][3]));
	}

	private function fillMatrix()
	{
		if ($this->_preset === self::IDENTITY) $this->identity();
		if ($this->_preset === self::SCALE) $this->scale();
		if ($this->_preset === self::RX) $this->rot_x();
		if ($this->_preset === self::RY) $this->rot_y();
		if ($this->_preset === self::RZ) $this->rot_z();
		if ($this->_preset === self::TRANSLATION) $this->translation();
		if ($this->_preset === self::PROJECTION) $this->projection();
	}

	private function identity()
	{
		$this->_matrix[0][0] = 1;
		$this->_matrix[1][1] = 1;
		$this->_matrix[2][2] = 1;
		$this->_matrix[3][3] = 1;
	}

	private function scale()
	{
		$this->_matrix[0][0] = $this->_scale;
		$this->_matrix[1][1] = $this->_scale;
		$this->_matrix[2][2] = $this->_scale;
		$this->_matrix[3][3] = 1;
	}

	private function rot_x()
	{
		$this->_matrix[0][0] = 1;
		$this->_matrix[1][1] = cos($this->_angle);
		$this->_matrix[1][2] = -sin($this->_angle);
		$this->_matrix[2][1] = sin($this->_angle);
		$this->_matrix[2][2] = cos($this->_angle);
		$this->_matrix[3][3] = 1;
	}

	private function rot_y()
	{
		$this->_matrix[0][0] = cos($this->_angle);
		$this->_matrix[0][2] = sin($this->_angle);
		$this->_matrix[1][1] = 1;
		$this->_matrix[2][0] = -sin($this->_angle);
		$this->_matrix[2][2] = cos($this->_angle);
		$this->_matrix[3][3] = 1;
	}

	private function rot_z()
	{
		$this->_matrix[0][0] = cos($this->_angle);
		$this->_matrix[0][1] = -sin($this->_angle);
		$this->_matrix[1][0] = sin($this->_angle);
		$this->_matrix[1][1] = cos($this->_angle);
		$this->_matrix[2][2] = 1;
		$this->_matrix[3][3] = 1;
	}

	private function translation()
	{
		$this->_matrix[0][0] = 1;
		$this->_matrix[0][3] = $this->_vtc->getX();
		$this->_matrix[1][1] = 1;
		$this->_matrix[1][3] = $this->_vtc->getY();
		$this->_matrix[2][2] = 1;
		$this->_matrix[2][3] = $this->_vtc->getZ();
		$this->_matrix[3][3] = 1;
	}

	private function projection()
	{
		$this->_matrix[0][0] = 1 / ($this->_ratio * tan(deg2rad($this->_fov) / 2));
		$this->_matrix[1][1] = 1 / tan(deg2rad($this->_fov) / 2);
		$this->_matrix[2][2] = -1 * ($this->_far + $this->_near) / ($this->_far - $this->_near);
		$this->_matrix[2][3] = (-2 * $this->_far * $this->_near) / ($this->_far - $this->_near);
		$this->_matrix[3][2] = -1;
	}

	public function mult(Matrix $rhs)
	{
		$rarr = array(
			array(0, 0, 0, 0),
			array(0, 0, 0, 0),
			array(0, 0, 0, 0),
			array(0, 0, 0, 0));
		for ($x = 0; $x < 4; $x++)
			for ($y = 0; $y < 4; $y++)
				for ($z = 0; $z < 4; $z++)
					$rarr[$x][$y] += $this->_matrix[$x][$z] * $rhs->_matrix[$z][$y];
		$ret = new Matrix();
		$ret->_matrix = $rarr;
		return ($ret);
	}

	public function transformVertex(Vertex $vtx)
	{
		$vrt = array();
		$vrt["x"] = $vtx->getX() * $this->_matrix[0][0] + $vtx->getY() * $this->_matrix[0][1] +
			$vtx->getZ() * $this->_matrix[0][2] + $vtx->getW() * $this->_matrix[0][3];
		$vrt["y"] = $vtx->getX() * $this->_matrix[1][0] + $vtx->getY() * $this->_matrix[1][1] +
			$vtx->getZ() * $this->_matrix[1][2] + $vtx->getW() * $this->_matrix[1][3];
		$vrt["z"] = $vtx->getX() * $this->_matrix[2][0] + $vtx->getY() * $this->_matrix[2][1] +
			$vtx->getZ() * $this->_matrix[2][2] + $vtx->getW() * $this->_matrix[2][3];
		$vrt["w"] = $vtx->getX() * $this->_matrix[3][0] + $vtx->getY() * $this->_matrix[3][1] +
			$vtx->getZ() * $this->_matrix[3][2] + $vtx->getW() * $this->_matrix[3][3];
		$vrt["color"] = $vtx->getColor();
		$vert = new Vertex($vrt);
		return ($vert);
	}
}

?>
