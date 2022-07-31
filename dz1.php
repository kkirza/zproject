<?php

class Tag{
	public $nameTag;
	public $attrs = [];
	protected $bodyAttr = 0;

	public function __construct(string $nameTag){
		$this->nameTag = $nameTag;
	}

	public function attr(string $nameAttr, string $valueAttr){
		$this->attrs[$this->bodyAttr]['nameAttr'] = $nameAttr;
		$this->attrs[$this->bodyAttr]['valueAttr'] = $valueAttr;
		$this->bodyAttr++;
	}

	public function render(){
		$string = '<'.$this->nameTag .' ';
		foreach ($this->attrs as $value) {
			$string .=  $value['nameAttr'].' = '.$value['valueAttr'] . ' ';
			
		}
		$string .= '>';
   
		return $string;
	}
}

class SingleTag extends Tag {

}

class PairTag extends Tag {
	public $childs = [];
	public function appendChild( $child){
		$this->childs[] = $child;
	}

	public function addBodytag($childs){
		$string = '';
		foreach ($childs  as $child) {
			$string .= render($child);
		}
		return $string;

	}

	public function render(){
		$string = '<'.$this->nameTag .' ';
		foreach ($this->attrs as $value) {
			$string .=  $value['nameAttr'].' = '.$value['valueAttr'] . ' ';
			
		}
		$string .= '> ';
		foreach($this->childs as $child){
			$string .= $child->render(); 
		}
		$string .='</'.$this->nameTag .'>'; 
   
		return $string;

	}
}
function forTest() : PairTag{
	return new PairTag('');
}


$img = new SingleTag('img');
$img->attr('src','f1.jpg');
$img->attr('alt','f1 not found');

$input = new SingleTag('input');
$input->attr('type','password');
$input->attr('name','f2');

$label = new PairTag('label');
$label->appendChild($img);
$label->appendChild($input);

$submit  = new SingleTag('input');
$submit->attr('type','submit');
$submit->attr('value','Send');

$form = new PairTag('form');
$form->appendChild($label);
$form->appendChild($submit);

echo $form->render();

