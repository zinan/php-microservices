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

namespace App\Utility;

use PDO;
use PDOException;

/**
 * Class Database
 * @package App\Utility
 */
class Database
{
    /**
     * @var null
     */
    private static $_Database = null;

    /**
     * @var PDO|null
     */
    private $_PDO = null;

    /**
     * @var null
     */
    private $_query = null;

    /**
     * @var bool
     */
    private $_error = false;

    /**
     * @var array
     */
    private $_results = [];


    /**
     * @var int
     */
    private $_count = 0;

    /**
     * Database constructor.
     */
    private function __construct()
    {
        try {
            $host = DATABASE_HOST;
            $name = DATABASE_NAME;
            $username = DATABASE_USERNAME;
            $password = DATABASE_PASSWORD;
            $this->_PDO = new PDO("mysql:host={$host};dbname={$name};charset=utf8", "{$username}", "{$password}");

        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $action
     * @param $table
     * @param array $where
     * @return $this|bool
     */
    public function action($action, $table, array $where = [])
    {
        if (count($where) === 3) {
            $operator = $where[1];
            $operators = ["=", ">", "<", ">=", "<="];
            if (in_array($operator, $operators)) {
                $field = $where[0];
                $value = $where[2];
                $params = [":value" => $value];
                if (!$this->query("{$action} FROM {$table}  WHERE  {$field}  {$operator} :value", $params)->error()) {
                    return $this;
                }
            }
        } else {
            if (!$this->query("{$action} FROM {$table}")->error()) {
                return $this;
            }
        }
        return false;
    }

    /**
     * @return int
     */
    public function count()
    {
        return($this->_count);
    }

    /**
     * @param $table
     * @param array $where
     * @return Database|bool
     */
    public function delete($table, array $where = [])
    {
        return($this->action('DELETE', $table, $where));
    }

    /**
     * @return bool
     */
    public function error()
    {
        return($this->_error);
    }


    /**
     * @return array|mixed
     */
    public function first()
    {
        return($this->results(0));
    }

    /**
     * @return Database|null
     */
    public static function getInstance()
    {
        if (!isset(self::$_Database)) {
            self::$_Database = new Database();
        }
        return(self::$_Database);
    }

    /**
     * @param $table
     * @param array $fields
     * @return bool|string
     */
    public function insert($table, array $fields)
    {
        if (count($fields)) {
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":{$key}"] = $value;
            }
            $columns = implode(",", array_keys($fields));
            $values = implode(",", array_keys($params));

            if (!$this->query("INSERT INTO {$table} ({$columns}) VALUES ({$values})", $params)->error()) {
                return($this->_PDO->lastInsertId());
            }
        }
        return false;
    }

    /**
     * @param $sql
     * @param array $params
     * @return $this
     */
    public function query($sql, array $params = [])
    {
        $this->_count = 0;
        $this->_error = false;
        $this->_results = [];
        if ($this->_query = $this->_PDO->prepare($sql)) {
            foreach ($params as $key => $value) {
                $this->_query->bindValue($key, $value);
            }
            if ($this->_query->execute()) {

                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);

                $this->_count = $this->_query->rowCount();
            } else {
                $this->_error = true;
                die(print_r($this->_query->errorInfo()));
            }
        }
        return $this;
    }

    /**
     * @param null $key
     * @return array|mixed
     */
    public function results($key = null)
    {
        return($key !== null ? $this->_results[$key] : $this->_results);
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->_PDO->lastInsertId();
    }

    /**
     * @param $table
     * @param array $where
     * @return Database|bool
     */
    public function select($table, array $where = [])
    {
        return($this->action('SELECT *', $table, $where));
    }

    /**
     * @param $table
     * @param $recordID
     * @param array $fields
     * @param $where
     * @return bool
     */
    public function update($table, $recordID, array $fields, $where)
    {
        if (count($fields)) {
            $x = 1;
            $set = "";
            $params = [];
            foreach ($fields as $key => $value) {
                $params[":{$key}"] = $value;
                $set .= "{$key} = :$key";
                if ($x < count($fields)) {
                    $set .= ", ";
                }
                $x ++;
            }
            if (!$this->query("UPDATE {$table} SET {$set} WHERE $where = {$recordID}", $params)->error()) {
                return true;
            }
        }
        return false;
    }
}

