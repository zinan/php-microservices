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
 * Class Session
 * @package App\Utility
 */
class Session
{

    /**
     * @param $key
     * @return bool
     */
    public static function delete($key)
    {
        if (self::exists($key)) {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }

    /**
     *
     */
    public static function destroy()
    {
        session_destroy();
    }

    /**
     * @param $key
     * @return bool
     */
    public static function exists($key)
    {
        return(isset($_SESSION[$key]));
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        if (self::exists($key)) {
            return($_SESSION[$key]);
        }
    }

    /**
     *
     */
    public static function init()
    {

        if (session_id() == "") {
            session_start();
        }
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function put($key, $value)
    {
        return($_SESSION[$key] = $value);
    }
}

