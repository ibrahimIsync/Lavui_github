<?php

namespace App\Http\Requests;

use App\Models\ProductBrand;
use App\Rules\UniqueValidation;
use Illuminate\Foundation\Http\FormRequest;

class ProductBrandRequest extends FormRequest
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

    public static function createRule(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255', new UniqueValidation(ProductBrand::class, 'name', 'en')],
            'name_ar' => ['required', 'string', 'max:255', new UniqueValidation(ProductBrand::class, 'name', 'ar')],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'status' => 'required|numeric|in:5,10',
        ];
    }

    public static function updateRule(): array
    {
        return [
            'name_en' => ['required', 'string', 'max:255', new UniqueValidation(ProductBrand::class, 'name', 'en',  request('brand.id'))],
            'name_ar' => ['required', 'string', 'max:255', new UniqueValidation(ProductBrand::class, 'name', 'ar',  request('brand.id'))],
            'description_en' => 'required|string',
            'description_ar' => 'required|string',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'status' => 'required|numeric|in:5,10',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ($this->route('brand.id')) ? ProductBrandRequest::updateRule() : ProductBrandRequest::createRule();
    }
}
