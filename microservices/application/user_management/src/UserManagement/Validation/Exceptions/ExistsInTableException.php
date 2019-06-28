<?php
/**
 * This file is part of user_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  UserManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

namespace UserManagement\Validation\Exceptions;

use \Respect\Validation\Exceptions\ValidationException;

/**
 * Class ExistsInTableException
 * @package UserManagement\Validation\Exceptions
 */
class ExistsInTableException extends ValidationException
{

    /**
     * @var array
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT  => [
            self::STANDARD => 'has already been taken',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'This does not exist',
        ],
    ];
}
