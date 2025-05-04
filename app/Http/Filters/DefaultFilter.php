<?php

namespace App\Http\Filters;

class DefaultFilter extends Filter
{
    public function apply($query)
    {
        if ($this->isString()) {
            $query->where($this->field, 'ilike', "%{$this->value}%");
            $queryCount = $query->count();
            //dd($queryCount);
            return $query->where($this->field, 'ilike', "%{$this->value}%");
        } elseif ($this->isDate()) {
            if ($this->operator == 'to') {
                return $query->whereDate($this->field, '<=', $this->value);
            }
            elseif ($this->operator == 'from'){
                return $query->whereDate($this->field, '>=', $this->value);
            }
            else{
                return $query->whereDate($this->field, '=', $this->value);
            }
        } elseif ($this->isNumeric()) {
            //dd($this->operator);
            if ($this->operator == 'to') {
                return $query->where($this->field, '<=', $this->value);
            }
            elseif ($this->operator == 'from'){
                return $query->where($this->field, '>=', $this->value);
            }
            else{
                return $query->where($this->field, '=', $this->value);
            }

        }

        return $query;
    }
}
