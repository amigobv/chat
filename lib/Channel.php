<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 18.08.2015
 * Time: 21:06
 */
class Channel extends Entity {
    private $name;

    public function __construct($id, $name) {
        parent::__construct($id);
        $this->name = $name;
    }

    public function getID() {
        return parent::getID();
    }
    public function getName() {
        return $this->name;
    }
}