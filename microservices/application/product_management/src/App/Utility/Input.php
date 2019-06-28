<?php
/**
 * This file is part of product_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  ProductManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

namespace App\Utility;


/**
 * Class Input
 * @package App\Utility
 */
class Input
{

    /**
     * @param array $source
     * @param array $inputs
     * @param null $recordID
     * @return bool
     */
    public static function check(array $source, array $inputs, $recordID = null)
    {
        $_return=true;

        if (!Input::exists()) {
            $_return=false;
        }
        if (!isset($source["csrf_token"]) && ! Token::check($source["csrf_token"])) {
            Flash::danger(Text::getText("INPUT_INCORRECT_CSRF_TOKEN"));
            $_return=false;
        }
        $valid = new Validate($source, $recordID);
        $validation = $valid->check($inputs);
        if (!$validation->passed()) {
            Session::put(SESSION_ERRORS, $validation->errors());
            $_return=false;
        }
        return $_return;
    }

    /**
     * @param string $source
     * @return bool
     */
    public static function exists($source = "post")
    {
        switch ($source) {
            case 'post':
                return(!empty($_POST));
            case 'get':
                return(!empty($_GET));
            default:
                break;
        }
        return false;
    }

    /**
     * @param $key
     * @param string $default
     * @return mixed|string
     */
    public static function get($key, $default = "")
    {
        return(isset($_GET[$key]) ? $_GET[$key] : $default);
    }

    /**
     * @param $key
     * @param string $default
     * @return mixed|string
     */
    public static function post($key, $default = "")
    {
        return(isset($_POST[$key]) ? $_POST[$key] : $default);
    }
}

