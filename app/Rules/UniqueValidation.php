<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueValidation implements ValidationRule
{
    private $id;
    private $model;
    private $field;
    private $language;
    public function __construct($model, $field, $language, $id = null)
    {
        $this->model = $model;
        $this->id = $id;
        $this->field = $field;
        $this->language = $language;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = ($this->id) ?
            $this->model::select($this->field)->where('id', '<>', $this->id)->where("$this->field->{$this->language}", $value)->doesntExist()
            : $this->model::select($this->field)->where("$this->field->{$this->language}", $value)->doesntExist();
        if (!$exists) {
            $fail('Must be unique.');
        }
    }
}
