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

namespace App\Core;

use Exception;
use ReflectionClass;
use ReflectionMethod;
use App\Utility\Input;
use App\Utility\Redirect;

/**
 * Class App
 * @package App\Core
 */
class App
{

    /**
     * @var string
     */
    private $_class = INDEX_CONTROLLER;
    /**
     * @var string
     */
    private $_method = INDEX_ACTION;
    /**
     * @var array
     */
    private $_params = [];
    /**
     * @var string
     */
    private $_pnf='pageNotFound';

    /**
     * App constructor.
     */
    public function __construct()
    {
        $this->parseURL();
        try {
            $this->getClass();
            $this->getMethod();
            $this->getParams();
        } catch (Exception $ex) {
           Redirect::to(404, $this->_pnf, Input::get("url"));
        }
    }

    /**
     *
     */
    private function getClass()
    {

        if (isset($this->_params[0]) && ! empty($this->_params[0])) {
            $this->_class = CONTROLLER_PATH  . $this->_params[0];
            unset($this->_params[0]);
        }

        if (!class_exists($this->_class)) {
            Redirect::to(404, $this->_pnf, Input::get("url"));
        }
        $this->_class = new $this->_class;
    }

    /**
     * @throws \ReflectionException
     */
    private function getMethod()
    {
        if (isset($this->_params[1]) && ! empty($this->_params[1])) {
            $this->_method = $this->_params[1];
            unset($this->_params[1]);
        }
        if (!(new ReflectionClass($this->_class))->hasMethod($this->_method)) {
            Redirect::to(404, $this->_pnf, Input::get("url"));
        }
        if (!(new ReflectionMethod($this->_class, $this->_method))->isPublic()) {
            Redirect::to(404, $this->_pnf, Input::get("url"));
        }
    }

    /**
     *
     */
    private function getParams()
    {
        $this->_params = $this->_params ? array_values($this->_params) : [];
    }

    /**
     *
     */
    private function parseURL()
    {
        if ($url = Input::get("url")) {
            $this->_params = explode("/", filter_var(rtrim($url, "/"), FILTER_SANITIZE_URL));
            $this->_params=array_slice($this->_params, 1);

        }
    }

    /**
     *
     */
    public function run()
    {
        call_user_func_array([$this->_class, $this->_method], $this->_params);
    }
}

