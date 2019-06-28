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

namespace UserManagement\Transformers;

use UserManagement\Models\User;
use League\Fractal\TransformerAbstract;

/**
 * Class LoginTransformer
 * @package UserManagement\Transformers
 */
class LoginTransformer extends  TransformerAbstract
{
    /**
     * @param User $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'        => $user->id,
            'username'     => $user->username,
            'last_login' => $user->last_login_date,
            'token' => $user->token,
            'is_admin' => $user->isAdmin()
        ];
    }

}