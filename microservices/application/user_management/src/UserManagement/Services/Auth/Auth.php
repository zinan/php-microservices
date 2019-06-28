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

namespace UserManagement\Services\Auth;

use UserManagement\Models\User;
use DateTime;
use Firebase\JWT\JWT;
use Illuminate\Database\Capsule\Manager;
use Slim\Collection;
use Slim\Http\Request;

/**
 * Class Auth
 * @package UserManagement\Services\Auth
 */
class Auth
{

    /**
     *
     */
    const SUBJECT_IDENTIFIER = 'username';

    /**
     * @var Manager
     */
    private $db;
    /**
     * @var Collection
     */
    private $appConfig;

    /**
     * Auth constructor.
     * @param Manager $db
     * @param Collection $appConfig
     */
    public function __construct(Manager $db, Collection $appConfig)
    {
        $this->db = $db;
        $this->appConfig = $appConfig;
    }

    /**
     * @param User $user
     * @return string
     * @throws \Exception
     */
    public function generateToken(User $user)
    {
        $now = new DateTime();
        $future = new DateTime("now +".$this->appConfig['app']['session_expire']." minutes");

        $payload = [
            "iat" => $now->getTimeStamp(),
            "exp" => $future->getTimeStamp(),
            "jti" => base64_encode(random_bytes(16)),
            'iss' => $this->appConfig['app']['url'],
            "sub" => $user->{self::SUBJECT_IDENTIFIER},
        ];

        $secret = $this->appConfig['jwt']['secret'];
        $token = JWT::encode($payload, $secret, "HS256");

        return $token;
    }

    /**
     * @param $username
     * @param $password
     * @return bool
     */
    public function attemptLogin($username, $password)
    {
        if ( !$user = User::where('username', $username)->first()) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            return $user;
        }

        return false;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function requestUser(Request $request)
    {
        if ($token = $request->getAttribute('token')) {
            return User::where(static::SUBJECT_IDENTIFIER, '=', $token->sub)->first();
        };
    }

}