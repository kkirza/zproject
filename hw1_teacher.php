<?php
class Tag {
	protected string $name;
	protected array $attrs = [];

	public function __construct (string $name){
		$this->name = $name;
	}

	public function attr(string $name , string $value){
		$this->attrs[$name] = $value;
	}

	public function render() : string{
		return '';
	}
	protected function attrsToString() : string{
		$pairs = [];

		foreach ($this->attrs as $name => $value){
			$pairs[] = "$name = \"$value\"";
		}

		return implode(' ', $pairs);
	}
}
class SingleTag extends Tag{
	public function render() : string{
		return "< {$this->name} {$this->attrsToString()} >";
	}
} 

class PairTag extends Tag{
	protected array $children = [];

	public function appendChild(Tag $child){
		$this->children[] = $child;

	}

	public function render() : string{
		$innerHTML = implode('',array_map(function(Tag $tag){
			return $tag->render();
		}, $this->children));

		return "< {$this->name} {$this->attrsToString()} > $innerHTML</{$this->name}>";
		
	}

}
