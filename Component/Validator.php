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
    {var_dump($array);exit;
        if (!$this->dataValidator($array)) {
            return false;
        }
var_dump($array);exit;
        foreach ($this->rules as $rule) {
            foreach ($rule['fields'] as $field) {
                var_dump($field, $rule, $array);exit;
                $result = call_user_func(
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
            $this->error = $field . $error;
            return false;
        }
    }

    private function notEmptyValidator($field, array $array)
    {
        $error = ' field must not be empty';

        if (!array_key_exists($field, $array) && !empty($field)) {
            $this->error = $field . $error;
            return false;
        }
    }
}