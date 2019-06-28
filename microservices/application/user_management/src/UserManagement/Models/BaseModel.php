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
namespace UserManagement\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package UserManagement\Models
 */
class BaseModel extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;
}