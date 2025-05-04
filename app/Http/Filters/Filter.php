<?php

namespace App\Http\Filters;

abstract class Filter
{
    protected $field;
    protected $value;
    protected $operator;

    public function __construct($field, $value, $operator)
    {
        $this->field = $field;
        $this->value = $value;
        $this->operator = $operator;
    }

    abstract public function apply($query);

    protected function isString()
    {
        return is_string($this->value);
    }

    protected function isDate()
    {
        return preg_match('/^\d{4}-\d{2}-\d{2}$/', $this->value);
    }

    protected function isNumeric()
    {
        return is_numeric($this->value);
    }
}
