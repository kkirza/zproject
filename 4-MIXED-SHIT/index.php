<?php

abstract class Tag{
	protected string $name; 
	protected array $attrs = []; 

	public function __construct(string $name){
		$this->name = $name;
	}

	public function attr(string $name, string $value){
		$this->attrs[$name] = $value;
		return $this;
	}

	abstract public function render() : string;

	protected function attrsToString() : string{ 
		$pairs = [];

		foreach($this->attrs as $name => $value){
			$pairs[] = "$name=\"$value\"";
		}

		return implode(' ', $pairs);
	}
}

class SingleTag extends Tag{
	public function render() : string{
		$attrsStr = $this->attrsToString();
		return "<{$this->name} $attrsStr>";
	}
}

class PairTag extends Tag{
	protected array $children = []; 
	
	public function appendChild(Tag|string $child){
		$this->children[] = $child;
		return $this;
	}

	public function render() : string{
		$attrsStr = $this->attrsToString();

		$childrenHTML = array_map(function(Tag|string $tag){
			return $tag instanceof Tag ? $tag->render() : $tag;

		}, $this->children);

		$innerHTML = implode('', $childrenHTML);
		return "<{$this->name} $attrsStr>$innerHTML</{$this->name}>";
	}
}

  $a = (new PairTag('a'))->attr('href','#')->appendChild('go home');
$label = (new PairTag('label'))->appendChild($a);

$html = $label->render();
echo $html;
echo '<hr>' . htmlspecialchars($html); 

