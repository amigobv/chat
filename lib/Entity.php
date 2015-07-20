<?php

interface IData {
	public function getID();
}

class Entity extends BaseObject implements IData {
	private $id;
	
	public function __construct($id) {
		$this->id = intval($id);
	}
	
	public function getID() {
		return $this->id;
	}
}
