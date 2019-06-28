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

use UserManagement\Transformers\LoginTransformer;
use UserManagement\Models\User;
use Interop\Container\ContainerInterface;
use League\Fractal\Resource\Item;
use Slim\Http\Request;
use Slim\Http\Response;
use Respect\Validation\Validator as v;

/**
 * Class LoginController
 * @package UserManagement\Controllers
 */
class LoginController extends BaseController
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
     * LoginController constructor.
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
    public function checkToken(Request $request, Response $response)
    {
        return $response->withJson(
            ['user' => $this->fractal->createData(
                new Item(
                    $this->auth->requestUser($request), new LoginTransformer()
                )
            )->toArray()
            ]
        );
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function login(Request $request, Response $response)
    {
        $validation = $this->validateLoginRequest($userParams = $request->getParam('user'));

        if ($validation->failed()) {
            return $response->withJson(['error' => ['login error' => ['username and/or password is invalid']]], 422);
        }

        if ($user = $this->auth->attemptLogin($userParams['username'], $userParams['password'])) {

            $user->token = $this->auth->generateToken($user);
            $data = $this->fractal->createData(new Item($user, new LoginTransformer()))->toArray();

            $user->last_login_date = date('Y-m-d H:i:s');
            $user->last_login_ip = $request->getAttribute('ip_address');
            $user->save();

            return $response->withJson(['user' => $data]);
        };

        return $response->withJson(['error' => ['login error' => ['username and/or password is invalid']]], 422);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function logout(Request$request, Response $response)
    {
        $user = $this->auth->requestUser($request);
        $rec = User::query()->where('id', $user->id)->firstOrFail();
        $rec->save();
        return $response->withJson(['user' => ['status' => ['success']]]);
    }


    /**
     * @param $values
     * @return mixed
     */
    protected function validateLoginRequest($values)
    {
        return $this->validator->validateArray(
            $values,
            [
                'username'    => v::noWhitespace()->notEmpty(),
                'password' => v::noWhitespace()->notEmpty(),
            ]
        );
    }
}
