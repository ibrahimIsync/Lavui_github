<?php

namespace App\Http\Requests;

use App\Models\ProductCategory;
use App\Rules\UniqueValidation;
use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function createRule(): array
    {
        return [
            'name_en' => [
                'required', 'string', 'max:190',
                new UniqueValidation(ProductCategory::class,'name', 'en')
            ],
            'name_ar' => [
                'required', 'string', 'max:190',
                new UniqueValidation(ProductCategory::class,'name', 'ar')
            ],
            'description_en' => [
                'required', 'string', 'max:900'
            ],
            'description_ar' => [
                'required', 'string', 'max:900'
            ],
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'status' => ['required', 'numeric', 'in:5,10'],
        ];
    }

    protected function updateRule(): array
    {
        return [
            'name_en' => [
                'required', 'string', 'max:190',
                new UniqueValidation(ProductCategory::class,'name', 'en', request('productCategory.id'))
            ],
            'name_ar' => [
                'required', 'string', 'max:190',
                new UniqueValidation(ProductCategory::class,'name', 'ar', request('productCategory.id'))
            ],
            'description_en' => [
                'required', 'string', 'max:900'
            ],
            'description_ar' => [
                'required', 'string', 'max:900'
            ],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'status' => ['required', 'numeric', 'in:5,10']
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ($this->route('productCategory.id')) ? $this->updateRule() : $this->createRule();
    }
}
