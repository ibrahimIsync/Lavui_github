<?php

namespace App\Rules;

use App\Models\CustomCollection;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Str;

class CustomCollectionSlugValidation implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $customCollection = CustomCollection::where('slug', Str::slug($value))->first();
        if ($customCollection) {
            $fail('Must be unique.');
        }
    }
}
