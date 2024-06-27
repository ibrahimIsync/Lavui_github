<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BadgeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public static function createRule(): array
    {
        return [
            'level' => 'required|string|max:255|in:premium,silver,bronze|unique:badges,level',
            'points' => 'required|integer'
        ];
    }

    public static function updateRule(): array
    {
        return [
            'level' => 'required|string|max:255|in:premium,silver,bronze|unique:badges,level,' . request('badge')->id,
            'points' => 'required|integer'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ($this->route('badge.id')) ? BadgeRequest::updateRule() : BadgeRequest::createRule();
    }
}
