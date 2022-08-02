<?php

class Math{
	public static function rangeArea(float $r) : float{
		return $r * $r * M_PI;
	}

	public static function rangeLength(float $r) : float{
		return 2 * $r * M_PI;
	}
}

$m = new Math();
 
echo "{$m->rangeArea(5)} <br> ";

echo "{$m->rangeLength(5)} <br>";

echo Math::rangeArea(5);

// parent::

// self::

// static

