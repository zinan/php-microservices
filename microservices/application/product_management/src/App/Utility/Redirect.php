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
 * Class Redirect
 * @package App\Utility
 */
class Redirect
{


    /**
     * @param string $location
     * @param null $errCode
     * @param null $replaceMessage
     */
    public static function to($location = "", $errCode=null, $replaceMessage=null)
    {
        if ($location) {
            if ($location === 404) {

                http_response_code(404);
                $errorStrings = json_decode(file_get_contents(VDIR.'/errorStrings.json'), true);
                $errorString =  $errorStrings[$errCode];
                $errorString = str_replace('@errMessage', $replaceMessage, $errorString);

                extract($errorString);

                ob_start();

                require VDIR . '/template/404.php';

                echo ob_get_clean();
            } else {
                header("Location: " . $location);
//                header("Location: /index.php?url=login");
            }
            exit;
        }
    }
}

