<?php
abstract class Node{
	abstract public function render() : string;
}
abstract class Tag extends Node{
	protected string $name; 
	protected array $attrs = []; 

	public function __construct(string $name){
		$this->name = $name;
	}

	public function attr(string $name, string $value){
		$this->attrs[$name] = $value;
		return $this;
	}

	

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
	
	public function appendChild(Node $child){
		$this->children[] = $child;
		return $this;
	}

	public function render() : string{
		$attrsStr = $this->attrsToString();

		$childrenHTML = array_map(function(Node $tag){
			return $tag->render();
		}, $this->children);

		$innerHTML = implode('', $childrenHTML);
		return "<{$this->name} $attrsStr>$innerHTML</{$this->name}>";
	}
}
class TextNode() extends Node{
	protected string $text;

	public function __construct(string $text){
		$this->text = $text;
	}
	public function render() : string{
		return $this->text;
	}

}

  $img = (new SingleTag('img'))->attr('src', 'f1.jpg')->attr('alt', 'f1 not found');
$label = (new PairTag('label'))->appendChild($img);

$html = $label->render();
echo $html;
echo '<hr>' . htmlspecialchars($html); 

$html = forTest()->render();
echo $html;
echo '<hr>' . htmlspecialchars($html);

$a = (new PairTag('a'))->attr('href','#')->appendChild('go home');