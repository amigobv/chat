<?php

class Util extends BaseObject {
	public static function escape($string) {
		return nl2br(htmlentities($string));
	}
	
	public static function action($action, $params = null) {
       // print_r($_SERVER);
        print_r($_REQUEST);

		$page = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page'] : $_SERVER['REQUEST_URI'];
        $ret = 'index.php?action=' . rawurlencode($action) . '&page=' . rawurlencode($page);

        if (is_array($params)) {
            foreach ($params as $name => $value) {
                $ret .= '&' . rawurlencode($name) . '=' . rawurlencode($value);
            }
        }

		return $ret;
	}

    public static function redirect($page = null) {
        if ($page == null) {
            $page = $_REQUEST['page'];
        }

        print_r($page);

        Header('Location: ' . $page);
    }
	
}

?>