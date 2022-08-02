<?php

interface Multiplyable {
	public function multiple();
}

interface Transportable{
	public function moveTo();  
}

interface Destroyable{
	public function destroy();  
}

interface Unit{
	public function makeAction(); 
}

class Animal implements LiveUnit, Transportable, Destroyable{
	public function moveTo(){} 

	public function destroy(){} 

	public function moveTo(){} 
}

class Wall implements Destroyable {
	public function destroy(){} 

} 

class Stone implements Transportable, Destroyable {
	public function destroy(){} 

	public function moveTo(){} 

}

class Seaweed implaments Transportable, Destroyable, Multiolyable{
	public function destroy(){} 

	public function moveTo(){} 

	public function multiple();
}

