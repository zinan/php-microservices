<?php
/**
 * This file is part of product_management
 * User: Sinan TURGUT <mail@sinanturgut.com.tr>
 * Date: 24.06.2019
 * php version 7.2
 *
 * @category Assessment
 * @package  ProductManagement
 * @author   Sinan TURGUT <mail@sinanturgut.com.tr>
 * @license  See LICENSE file
 * @link     https://dev.sinanturgut.com.tr
 */

namespace App\Core;

use App\Utility;

/**
 * Class Model
 * @package App\Core
 */
class Model
{

    /**
     * @var Utility\Database|null
     */
    protected $Db = null;

    /**
     * @var array
     */
    protected $data = [];


    /**
     * Model constructor.
     */
    public function __construct()
    {
        $this->Db = Utility\Database::getInstance();
    }

    /**
     * @param $table
     * @param array $fields
     * @return bool|string
     */
    protected function create($table, array $fields)
    {
        return($this->Db->insert($table, $fields));
    }

    /**
     * @return array
     */
    public function data()
    {
        return($this->data);
    }

    /**
     * @return bool
     */
    public function exists()
    {
        return(!empty($this->data));
    }

    /**
     * @param $table
     * @param array $where
     * @return $this
     */
    protected function find($table, array $where = [])
    {
        $_data = $this->Db->select($table, $where);
        if ($_data->count()) {
            $this->data = $_data->first();
        }
        return $this;
    }

    /**
     * @param $table
     * @param array $where
     * @return $this
     */
    protected function select($table, array $where = [])
    {
        $_data = $this->Db->select($table, $where);
        if ($_data->count()) {
            $this->data = $_data->results();
        }
        return $this;
    }

    /**
     * @param $sql
     * @param $params
     * @return $this
     */
    public function query($sql, $params = [])
    {
        $_data = $this->Db->query($sql, $params);
        if ($_data->count()) {
            $this->data = $_data->results();
        }
        return $this;
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->Db->lastInsertId();
    }

    /**
     * @param $table
     * @param array $fields
     * @param $recordID
     * @param $where
     * @return bool
     */
    protected function update($table, array $fields, $recordID, $where)
    {
        return(!$this->Db->update($table, $recordID, $fields, $where));
    }

    /**
     * @param $AParam
     * @return mixed
     */
    public function clearSQLParam($AParam)
    {
        $result = str_replace( "'", "", $AParam );
        $result = str_replace( '"', '', $result );
        $result = str_replace( '\\', '', $result );
        $result = str_replace( '/', '', $result );
        $result = str_replace( '&', '', $result );
        $result = str_replace( '$', '', $result );
        $result = str_replace( '@', '', $result );
        $result = str_replace( '-', '', $result );
        return $result;
    }

}

