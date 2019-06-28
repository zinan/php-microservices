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

/**
 * Class User
 * @package UserManagement\Models
 */
class User extends BaseModel
{

    /**
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'realname',
        'last_login_date',
        'last_login_ip'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'id',
        'level'
    ];

    /**
     * @return bool
     */
    public function isAdmin() {
        return (int)$this->level > 0;
    }

}