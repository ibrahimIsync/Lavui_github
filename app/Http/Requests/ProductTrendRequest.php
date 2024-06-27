<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductTrendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'status' => ['required', 'numeric', 'in:5,10'],
            'image' => ($this->route('trending.id')) ? ['nullable', 'image', 'mimes:gif', 'max:2048'] : ['required', 'image', 'mimes:gif', 'max:2048'],
        ];
    }
}
