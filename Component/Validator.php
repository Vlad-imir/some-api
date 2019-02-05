<?php

namespace Component;

abstract class Validator
{
    protected $rules = [];

    protected $error = '';

    public function getError()
    {
        return $this->error;
    }

    public function validate($array)
    {
        if ($this->dataValidator($array) === false) {
            return false;
        }

        foreach ($this->rules as $rule) {
            foreach ($rule['fields'] as $field) {
                $result = call_user_func_array(
                    [$this, $rule['validator']],
                    ['field' => $field, 'array' => $array]
                );

                if ($result === false) {
                    return false;
                }
            }
        }

        return true;
    }

    private function dataValidator($array)
    {
        if (!is_array($array)) {
            $this->error = 'Data is not correct';
            return false;
        }
    }

    private function requireValidator($field, array $array)
    {
        $error = ' field is required';

        if (!array_key_exists($field, $array)) {
            $this->error = ucfirst($field) . $error;
            return false;
        }
    }

    private function notEmptyValidator($field, array $array)
    {
        $error = ' field must not be empty';

        if (array_key_exists($field, $array) && empty($array[$field])) {
            $this->error = ucfirst($field) . $error;
            return false;
        }
    }
}