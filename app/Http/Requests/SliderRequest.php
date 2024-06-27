<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'image_en' => 'required|image|mimes:jpeg,png,jpg,gif',
            'image_ar' => 'required|image|mimes:jpeg,png,jpg,gif',
            'status' => 'required|numeric|in:5,10',
            'mean_slider' => 'required|boolean|in:0,1',
        ];
    }

    public static function updateRule(): array
    {
        return [
            'image_en' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_ar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|numeric|in:5,10',
            'mean_slider' => 'nullable|boolean|in:0,1',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ($this->route('slider.id')) ? SliderRequest::updateRule() : SliderRequest::createRule();
    }
}
