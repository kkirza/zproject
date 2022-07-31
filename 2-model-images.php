<?php 

class Images {
	public function upload($file){
		if ($this->check($file['name'])){
			$this->resize($file);
			$this->watemark($file);
		}
	}

	public function get($id, $size){

	}

	private function resize($file){

	}

	private function check($path){

	}

	private function watemark($img, $path){

	}
}
