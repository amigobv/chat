<?php
/**
 * Created by PhpStorm.
 * User: Blade
 * Date: 18.08.2015
 * Time: 21:06
 */
class Channel extends Entity {
    private $name;
    private $users = array();

    public function __construct($id, $name) {
        parent::__construct($id);
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }
}