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
 * Class Text
 * @package App\Utility
 */
class Text
{

    /**
     * @var array
     */
    private static $_texts = [];

    /**
     * @param $key
     * @param array $data
     * @return mixed|string
     */
    public static function getText($key, array $data = [])
    {

        $stringsJson = json_decode(file_get_contents(VDIR.'/strings_'.APP_LANG.'.json'), true);

        if (empty(self::$_texts)) {
            $texts=$stringsJson['TEXTS'];
            self::$_texts = is_array($texts) ? $texts : [];
        }
        if (array_key_exists($key, self::$_texts)) {
            $text = self::$_texts[$key];

            foreach ($data as $search => $replace) {
                $text = str_replace($search, $replace, $text);
            }
            return $text;
        }
        return "";
    }

}

