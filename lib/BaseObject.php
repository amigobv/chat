<?php

class BaseObject {
	public function __call($name, $args) {
		throw new Exception("Method " . $name . " dows not exist.");
	}
	
	public function __set($name, $function) {
		throw new Exception("Attribute " . $name . "does not exist.");
	}
	
	public function __get($name) {
		throw new Exception("Attribute " . $name . "does not exist.");
	}
	
	public static function __callStatic($name, $args) {
		throw new Exception("Static method " . $name . "dows not exist.");
	}
}
