<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'image_en' => ['required_if:video,null|required_if:position,2,3,4,5,6', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp,gif'],
            'image_ar' => ['required_if:video,null|required_if:position,2,3,4,5,6', 'image', 'max:2048', 'mimes:png,jpg,jpeg,webp,gif'],
            'text_en' => ['required_if:position,1', 'string', 'max:255'],
            'text_ar' => ['required_if:position,1', 'string', 'max:255'],
            'video' => ['required_if:image_en,null|required_if:position,2,3,4,5,6', 'file', 'max:2048', 'mimes:mp4,webm,ogg,wav'],
            'position' => ['required', 'numeric', 'in:1,2,3,4,5,6'],
            'z_index' => ['nullable', 'numeric'],
            'type' => ['nullable', 'required_if:position,2,3,4,5,6', 'numeric', 'in:5,10'],
            'status' => ['required', 'numeric', 'in:5,10'],
        ];
    }
}
