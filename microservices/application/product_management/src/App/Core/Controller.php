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

use App\Utility;

/**
 * Class Controller
 * @package App\Core
 */
class Controller
{

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        Utility\Session::init();
    }

}
