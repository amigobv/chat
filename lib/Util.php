<?php

class Util extends BaseObject {
	public static function escape($string) {
		return nl2br(htmlentities($string));
	}
	
	public static function action($action, $params = null) {
		
		return "$action";
	}
	
}

?>