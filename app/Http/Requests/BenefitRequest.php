<?php

namespace App\Http\Requests;

use App\Models\Benefit;
use App\Rules\UniqueValidation;
use Illuminate\Foundation\Http\FormRequest;

class BenefitRequest extends FormRequest
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
            'title_en'        => [
                'required', 'string', 'max:190',
                new UniqueValidation( Benefit::class, 'title', 'en')
            ],
            'title_ar'        => [
                'required', 'string', 'max:190',
                new UniqueValidation( Benefit::class, 'title', 'ar')
            ],
            'description_en' => [
                'required', 'string', 'max:900',
                new UniqueValidation( Benefit::class, 'description', 'en')
            ],
            'description_ar' => [
                'required', 'string', 'max:900',
                new UniqueValidation( Benefit::class, 'description', 'ar')
            ],
            'icon'  => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'status' => ['required', 'numeric', 'in:5,10', 'max:24'],
        ];
    }

    protected function updateRule(): array
    {
        return [
            'title_en'        => [
                'required', 'string', 'max:190',
                new UniqueValidation( Benefit::class, 'title', 'en', request('benefit.id'))
            ],
            'title_ar'        => [
                'required', 'string', 'max:190',
                new UniqueValidation( Benefit::class, 'title', 'ar', request('benefit.id'))
            ],
            'description_en' => [
                'required', 'string', 'max:900',
                new UniqueValidation( Benefit::class, 'description', 'en', request('benefit.id'))
            ],
            'description_ar' => [
                'required', 'string', 'max:900',
                new UniqueValidation( Benefit::class, 'description', 'ar', request('benefit.id'))
            ],
            'icon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            'status' => ['required', 'numeric', 'in:5,10', 'max:24'],
        ];
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return ($this->route('benefit.id')) ? $this->updateRule() : $this->createRule();
    }
}
