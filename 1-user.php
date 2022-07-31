

<?php

class UserStatuses{
	const CREATED = 0;
	const ACTIVATED = 1;
	const BANED = 2;
}  

class User{
	public $id;
	public $login;
	public $name;
	public $created;
	private $status;
	private $now;
	

	public function __construct(int $id, string  $login, string $name ,string $status, int $created){
		$this->id = $id;
		$this->login = $login;
		$this->name = $name;
		$this->status = $status;
		$this->created = $created;
		$this->now = time();
	}
	 
	public function isActive(){
		return $this->status ==1;
	}

	public function activate(){
		$this->status = UserStatuses::ACTIVATED;
	}

	public function ban(){
		$this->status = UserStatuses::BANED;
	}
}

$user1 = new User(1,'kirza','kirill','active',time());
$user1->activate();

echo '<pre>';
print_r($user1);		