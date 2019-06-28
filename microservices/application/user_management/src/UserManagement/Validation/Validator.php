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

namespace UserManagement\Validation;

use Psr\Http\Message\ServerRequestInterface;
use Respect\Validation\Exceptions\NestedValidationException;

/**
 * Class Validator
 * @package UserManagement\Validation
 */
class Validator
{

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param ServerRequestInterface $request
     * @param array $rules
     * @return $this
     */
    public function validate(ServerRequestInterface $request, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($field)->assert($request->getParam($field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }
        $_SESSION['errors'] = $this->errors;
        return $this;
    }

    /**
     * @param array $values
     * @param array $rules
     * @return $this
     */
    public function validateArray(array $values, array $rules)
    {
        foreach ($rules as $field => $rule) {
            try {
                $rule->setName($field)->assert($this->getValue($values, $field));
            } catch (NestedValidationException $e) {
                $this->errors[$field] = $e->getMessages();
            }
        }
        $_SESSION['errors'] = $this->errors;


        return $this;
    }

    /**
     * @return bool
     */
    public function failed()
    {
        return ! empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param $values
     * @param $field
     * @return null
     */
    private function getValue($values, $field)
    {
        return isset($values[$field]) ? $values[$field] : null;
    }

}