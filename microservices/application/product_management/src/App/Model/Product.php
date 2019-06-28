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

namespace App\Model;

use Exception;
use App\Core;

/**
 * Class Product
 * @package App\Model
 */
class Product extends Core\Model
{
    /**
     * @return |null
     */
    public static function getInstance()
    {
        $Rec = new Product();
        return null;
    }

    /**
     * @param int $start
     * @return Product
     */
    public function listProducts($start = 0)
    {
        return($this->query("select p.*,u.user_name from posts p join users u on p.user_id=u.id order by p.post_date_created desc"));
    }


    /**
     * @param $productName
     * @param $productCategory
     * @param $productSummary
     * @param $productPrice
     * @return Product
     */
    public function addProduct($productName, $productCategory, $productSummary, $productPrice)
    {
        return $this->query("INSERT INTO post_titles(post_id,post_title,post_slug)".
            " values (".$this->clearSQLParam($id).",'".$this->clearSQLParam($title)."','".$this->clearSQLParam($slug)."')");
    }

}