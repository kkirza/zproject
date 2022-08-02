<?php

abstract class Tag{
	protected string $name; 
	protected array $attrs = []; 

	public function __construct(string $name){
		$this->name = $name;
	}

	public function attr(string $name, string $value) : static{
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
	
	public function appendChild(Tag $child){
		$this->children[] = $child;
		return $this;
	}

	public function render() : string{
		$attrsStr = $this->attrsToString();

		$childrenHTML = array_map(function(Tag $tag){
			return $tag->render();
		}, $this->children);

		$innerHTML = implode('', $childrenHTML);
		return "<{$this->name} $attrsStr>$innerHTML</{$this->name}>";
	}
}

/* $img = (new SingleTag('img'))->attr('src', 'f1.jpg')->attr('alt', 'f1 not found');
$label = (new PairTag('label'))->appendChild($img);

$html = $label->render();
echo $html;
echo '<hr>' . htmlspecialchars($html); */

$html = forTest()->render();
echo $html;
echo '<hr>' . htmlspecialchars($html);

function forTest(): PairTag{
	return (new PairTag('form'))
        ->appendChild(
            (new PairTag('label'))
                ->appendChild((new SingleTag('img'))->attr('src', 'f1.jpg')->attr('alt', 'f1 not found'))
                ->appendChild((new SingleTag('input'))->attr('type', 'text')->attr('name', 'f1'))
        )
        ->appendChild(
            (new PairTag('label'))
                ->appendChild((new SingleTag('img'))->attr('src', 'f2.jpg')->attr('alt', 'f2 not found'))
                ->appendChild((new SingleTag('input'))->attr('type', 'password')->attr('name', 'f2'))
        )
        ->appendChild(
			  (new SingleTag('input'))->attr('type', 'submit')->attr('value', 'Send')
			);
}