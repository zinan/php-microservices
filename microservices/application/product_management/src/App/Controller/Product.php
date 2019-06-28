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

use App\Utility;

/**
 * Class Product
 *
 * @category Assessment
 * @package  App\Controller
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */
class Product
{
    /**
     * List products
     *
     * @return object
     */
    public function listProducts()
    {
        $db = new \App\Model\Product();
        $products = $db->query("SELECT * FROM products where is_active")->data();
        return Utility\Response::write(true, $products);
    }

    /**
     * Add new product
     *
     * @return string
     */
    public function addProduct()
    {
        // Get user info from user management service
        $user = Utility\Request::getUser();

        // Die if user is not admin
        if(!$user['user']['is_admin']) {
            return Utility\Response::write(true, ['error'=>'authentication error!']);
        }

        $params = json_decode(file_get_contents('php://input'),true);

        $db = new \App\Model\Product();
        $product = $db->query(
            "INSERT INTO products VALUES (NULL, :productName, :category, :summary, :price, 1)",
            [
                "productName" => $params['ProductName'],
                "category"=>$params['Category'],
                "summary"=>$params['Description'],
                "price"=>$params['Price']
            ]
        )->data();
        return Utility\Response::write(true, $params);

    }

}
