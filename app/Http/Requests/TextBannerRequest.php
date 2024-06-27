<?php

namespace App\Http\Requests;

use App\Models\TextBanner;
use App\Rules\UniqueValidation;
use Illuminate\Foundation\Http\FormRequest;

class TextBannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function createRule(): array
    {
        return [
            'name_en' => [
                'required',
                'string',
                'max:190',
                new UniqueValidation(TextBanner::class, 'name', 'en')
            ],
            'name_ar' => [
                'required',
                'string',
                'max:190',
                new UniqueValidation(TextBanner::class, 'name', 'ar')
            ],
            'status' => ['required', 'numeric', 'in:5,10', 'max:24']
        ];
    }

    public function updateRule(): array
    {
        return [
            'name_en' => [
                'required',
                'string',
                'max:190',
                new UniqueValidation(TextBanner::class, 'name', 'en', request('textBanner.id'))
            ],
            'name_ar' => [
                'required',
                'string',
                'max:190',
                new UniqueValidation(TextBanner::class, 'name', 'ar', request('textBanner.id'))
            ],
            'status' => ['required', 'numeric', 'in:5,10', 'max:24']
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return ($this->route('textBanner.id')) ? $this->updateRule() : $this->createRule();
    }
}
