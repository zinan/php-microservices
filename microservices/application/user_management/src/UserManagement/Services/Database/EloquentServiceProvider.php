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

namespace UserManagement\Services\Database;

use Illuminate\Database\Capsule\Manager;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

/**
 * Class EloquentServiceProvider
 * @package UserManagement\Services\Database
 */
class EloquentServiceProvider implements ServiceProviderInterface
{

    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $capsule = new Manager();
        $config = $pimple['settings']['database'];

        $capsule->addConnection([
            'driver'    => $config['driver'],
            'host'      => $config['host'],
            'database'  => $config['database'],
            'username'  => $config['username'],
            'password'  => $config['password'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();
        $pimple['db'] = function ($c) use ($capsule) {
            return $capsule;
        };
    }
}