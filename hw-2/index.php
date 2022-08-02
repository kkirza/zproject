<?php

interface IStorage{
	public function add(string $key, mixed $data) : void;
	public function remove(string $key) : void;
	public function contains(string $key) : bool;
	public function get(string $key) : mixed;
}

class Storage implements Istorage, JsonSerializable{
	protected array $storage;
	public function add(string $key, mixed $data) : void{
		$this->storage[$key] = $data;
	}

	public function remove(string $key) : void{
		unset($this->storage[$key]);
	}

	public function contains(string $key) : bool{
		return array_key_exists($key, $string->storage);
	}

	public function get(string $key) : mixed{
		return $this->storagee[$key];
	} 
	public function jsonSerialize() :mixed{
		return $this;
	}

	public function __toString(){
		return json_encode($this->jsonSerialize(), JSON_UNESCAPED_UNICODE);
	}
}

class Animal implements JsonSerializable{
	public $name;У
	public $health;
	public $alive;
	protected $power;

	public function  jsonSerialize() :mixed{
		return $this;
	}
	
	public function __toString(){УУ
		return json_encode($this->jsonSerialize(), JSON_UNESCAPED_UNICODE);
	}

	public function __construct(string $name, int $health, int $power){
		$this->name = $name;
		$this->health = $health;
		$this->alive = true;
		$this->power = $power;
	}

	public function calcDamage(){
		return $this->power * (mt_rand(100,300) /200);
	}

	public function applyDamage(int $damage){
		$this->health -= $damage;
		if($this->health <= 0){
			$this->health = 0;
			$this->alive = false;
		}
	}
}

class JSONLogger{
	protected array $objects = [];

	public function addObject($obj) : void{
		$this->objects[] = $obj;
	}

	public function log(string $betweenLogs = ',') : string{
		$logs = array_map(function($obj){
			return $obj->jsonSerialize();
		}, $this->objects);

		return implode($betweenLogs, $logs);
	}
}

$a1 = new Animal('Murzik', 20 , 5);
$a2 = new Animal('Bobik', 30, 3);

$gameStorage = new Storage();
$gameStorage->add('test', mt_rand(1,10));

$logger = new JSONLogger();
$logger->addObject($a1);
$logger->addObject($a2);
$logger->addObject($gameStorage);

echo $logger->log('<br>') . '<hr>';

$a2->applyDamage($a1->calcDamage());
$gameStorage->add('other', mt_rand(1, 10));