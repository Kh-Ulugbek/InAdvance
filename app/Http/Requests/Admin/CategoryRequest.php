<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        if ($this->method() == 'PUT' or $this->method() == 'PATCH')
        {
            $image_path = '';
        }
        return [
            'name_uz' => 'required',
            'name_ru' => 'required',
            'name_en' => 'required'
        ];
    }
}
