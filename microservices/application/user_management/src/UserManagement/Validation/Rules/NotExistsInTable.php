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

namespace UserManagement\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;

/**
 * Class NotExistsInTable
 * @package UserManagement\Validation\Rules
 */
class NotExistsInTable extends AbstractRule
{
    /**
     * @var
     */
    private $columns;
    /**
     * @var
     */
    private $table;

    /**
     * NotExistsInTable constructor.
     * @param $table
     * @param $columns
     */
    public function __construct($table, $columns)
    {
        $this->table = $table;
        $this->columns = $columns;
    }

    /**
     * @param $input
     * @return mixed
     */
    public function validate($input)
    {
        return $this->table->where($this->columns, $input)->exists();
    }
}