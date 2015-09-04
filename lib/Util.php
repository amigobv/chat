<?php

class Util extends BaseObject {
	public static function escape($string) {
		return nl2br(htmlentities($string));
	}
	
	public static function action($action, $params = null) {
        // print_r($_SERVER);
        //print_r($_REQUEST);

		$page = isset($_REQUEST['page']) && $_REQUEST['page'] ? $_REQUEST['page'] : $_SERVER['REQUEST_URI'];
        $page = explode('?', $page)[0];
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

        Header('Location: ' . $page);
    }

    /**
     * source: http://php.net/manual/en/function.uasort.php
     *
     * @param $array
     * @param $cmp_function
     */
    public static function stable_uasort(&$array, $cmp_function) {
        if(count($array) < 2) {
            return;
        }
        $halfway = count($array) / 2;
        $array1 = array_slice($array, 0, $halfway, TRUE);
        $array2 = array_slice($array, $halfway, NULL, TRUE);

        self::stable_uasort($array1, $cmp_function);
        self::stable_uasort($array2, $cmp_function);
        if(call_user_func($cmp_function, end($array1), reset($array2)) < 1) {
            $array = $array1 + $array2;
            return;
        }
        $array = array();
        reset($array1);
        reset($array2);
        while(current($array1) && current($array2)) {
            if(call_user_func($cmp_function, current($array1), current($array2)) < 1) {
                $array[key($array1)] = current($array1);
                next($array1);
            } else {
                $array[key($array2)] = current($array2);
                next($array2);
            }
        }
        while(current($array1)) {
            $array[key($array1)] = current($array1);
            next($array1);
        }
        while(current($array2)) {
            $array[key($array2)] = current($array2);
            next($array2);
        }
        return;
    }

    /*
    public static function MessageCmp($post1, $post2) {
        if ($post1->getStatus() == Status::PRIOR &&
            $post2->getStatus() == Status::PRIOR)
            return 0;

        return ($post2->getStatus() > $post1->getStatus()) ? 1 : -1;
    }
    */
}
?>