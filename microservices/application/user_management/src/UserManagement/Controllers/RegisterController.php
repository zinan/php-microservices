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
namespace UserManagement\Controllers;

use UserManagement\Models\User;
use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

/**
 * Class RegisterController
 * @package UserManagement\Controllers
 */
class RegisterController extends BaseController
{
    /**
     * @var mixed
     */
    protected $validator;
    /**
     * @var mixed
     */
    protected $fractal;
    /**
     * @var mixed
     */
    private $auth;

    /**
     * RegisterController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->auth = $container->get('auth');
        $this->validator = $container->get('validator');
        $this->fractal = $container->get('fractal');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function register(Request $request, Response $response)
    {
        $userParams = $request->getParam('user');

        $validation = $this->validateRegisterRequest($userParams);

        if ($validation->failed()) {
            return $response->withJson(['error' => ['register error' => ['please check input params']]], 422);
        }

        $user = new User();
        $user->username = strtolower($userParams['username']);
        $user->realname = $userParams['realname'];
        $user->password = password_hash($userParams['password'], PASSWORD_DEFAULT);
        $user->level = 0;
        $user->save();


        return $response->withJson(
            [
                'status' => 'ok'
            ]
        );
    }

    /**
     * @param $values
     * @return mixed
     */
    protected function validateRegisterRequest($values)
    {
        return $this->validator->validateArray(
            $values,
            [
                'username' => v::noWhitespace()->notEmpty()->existsInTable($this->db->table('users'), 'username'),
                'password' => v::noWhitespace()->notEmpty(),
            ]
        );
    }
}
