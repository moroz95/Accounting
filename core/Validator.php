<?php

/**
 * Class Validator
 *
 * TODO implement getter
 *
 */


class Validator
{
    /**
     * @var bool|array
     */
    public static $post_data = false;

    /**
     * @var bool|array
     */
    public static $get_data = false;


    /**
     *
     */
    static public function setPost()
    {
        if(!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                self::$post_data[$key] = iconv("utf-8", "cp1251", $value);
            }
        }
    }

    /**
     *
     */
    static public function setGet()
    {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                self::$get_data[$key] = iconv("utf-8", "cp1251", $value);
            }
        }
    }

    /**
     * @param $id
     * @return bool
     */
    static public function validateId($id)
    {
       return (self::$post_data && self::isNumber($id));
    }

    /**
     * @param $var
     * @return int
     */
    static public function isNumber($var)
    {
        return preg_match("|^[\d]+$|", $var);
    }

}