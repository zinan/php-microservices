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

use GuzzleHttp\Client;

/**
 * Class Request
 * @package App\Utility
 */
class Request
{

    /**
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public static function getUser()
    {
        $token = (new self)->getToken();

        if(!$token) {
            return null;
        }

        $client = new Client();
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
        ];
        $res = $client->request('GET', 'http://user_management_nginx_1/user/checkToken',
            [
                'headers' => $headers,
                'exceptions' => false
            ]
        );
        $httpCode = $res->getStatusCode();
        if($httpCode!=200)
        {
            return null;
        }

        return json_decode($res->getBody(),1);
    }

    /**
     * Get Http Header Bearer Token
     *
     * @return string |null
     */
    private function getToken()
    {
        $result = null;
        if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
            list($type, $data) = explode(" ", $_SERVER["HTTP_AUTHORIZATION"], 2);
            if (strcasecmp($type, "Bearer") == 0) {
                $result = $data;
            }
        }

        return $result;
    }

}