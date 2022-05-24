<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateProductRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required|alpha_num|min:6|max:6',
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|max:255',
            'image' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png',
                'dimensions:min_width=100,max_width=500,min_height=100,max_height=500',
                'max:250'
            ],
            'image_delete' => 'nullable|boolean'
        ];
    }
}
