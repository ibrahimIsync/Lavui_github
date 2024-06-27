<?php

namespace App\Http\Requests;

use App\Models\CustomCollection;
use App\Rules\UniqueValidation;
use Illuminate\Foundation\Http\FormRequest;

class CustomCollectionRequest extends FormRequest
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
            'name_en' => ['required', 'string', 'max:255', new UniqueValidation(CustomCollection::class, 'name', 'en')],
            'name_ar' => ['required', 'string', 'max:255', new UniqueValidation(CustomCollection::class, 'name', 'ar')],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'status' => 'required|numeric|in:5,10',
        ];
    }

    public static function updateRule(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255', new UniqueValidation(CustomCollection::class, 'name', 'en',  request('collection.id'))],
            'name_ar' => ['required', 'string', 'max:255', new UniqueValidation(CustomCollection::class, 'name', 'ar',  request('collection.id'))],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'status' => 'required|numeric|in:5,10',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ($this->route('collection.id')) ? CustomCollectionRequest::updateRule() : CustomCollectionRequest::createRule();
    }
}
