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

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Class Index
 *
 * @package App\Controller
 */
class Index extends Core\Controller
{

    /**
     * @return string html
     */
    public function main()
    {
        $html = <<<EOT
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Product Management</title>
    <style>
    body {
        padding: 0;
        text-align: center;
        }
    </style>
</head>
<body>
<h1>Product Management Service</h1>
</body>
</html>
EOT;
        die($html);

    }

    /**
     * @return string
     */
    public function ping()
    {

        echo "pong";
    }
}
