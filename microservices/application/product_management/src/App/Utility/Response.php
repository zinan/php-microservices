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
 * Class Response
 * @package App\Utility
 */
class Response
{
    /**
     * Response constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param $succes
     * @param $data
     * @param int $httpCode
     */
    public static function write($succes, $data, $httpCode = 200)
    {
        http_response_code($httpCode);

        if ($succes) {
            $outPut=array('success'=>'true', 'data'=>$data);

        } else {

            $outPut=array('success'=>'false', 'error'=>$data);
        }

        echo json_encode($outPut, JSON_UNESCAPED_UNICODE);
        exit;
    }

}