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

use Interop\Container\ContainerInterface;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class AuthServiceProvider
 * @package UserManagement\Services\Auth
 */
class AuthServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['auth'] = function (ContainerInterface $c) {
            return new Auth($c->get('db'), $c->get('settings'));
        };
    }
}