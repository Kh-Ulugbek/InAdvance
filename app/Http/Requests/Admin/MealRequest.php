<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $image = 'required|mimes:jpg,jpeg,png';
        $restaurant_id = ['required', 'exists:App\Models\Restaurant,id'];
        $category_id = ['required', 'exists:App\Models\Category,id'];
        if ($this->method() == 'PUT' or $this->method() == 'PATCH')
        {
            $image = 'mimes:jpg,jpeg,png';
            $restaurant_id = '';
            $category_id = '';
        }
        return [
            'restaurant_id' => $restaurant_id,
            'category_id' => $category_id,
            'name_uz' => 'required|min:5|max:500',
            'name_ru' => 'required|min:5|max:500',
            'name_en' => 'min:5|max:500',
            'description_uz' => 'required|min:5|max:500',
            'description_ru' => 'required|min:5|max:500',
            'description_en' => 'min:5|max:500',
            'price' => 'required|numeric',
            'image_path' => $image,
        ];
    }
}
