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

use Interop\Container\ContainerInterface;

/**
 * Class BaseController
 * @package UserManagement\Controllers
 */
class BaseController
{
    /**
     * @var ContainerInterface
     */
    protected $container;
    /**
     * @var mixed
     */
    protected $db;
    /**
     * @var
     */
    protected $generalConfig;

    /**
     * BaseController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->db = $container->get('db');
    }

}