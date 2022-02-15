<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StockRequest extends FormRequest
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
        if ($this->method() == 'PUT' or $this->method() == 'PATCH')
        {
            $image = 'mimes:jpg,jpeg,png';
        }
        return [
            'title_en' => 'required|min:5|max:200',
            'title_ua' => 'required|min:5|max:200',
            'description_en' => 'required|min:5|max:500',
            'description_ua' => 'required|min:5|max:500',
            'text_en' => 'required',
            'text_ua' => 'required',
            'image' => $image,
            'start_date' => 'required|date_format:Y-m-d',
            'end_date' => 'required|date_format:Y-m-d',
            'status' => 'required|boolean',
        ];
    }
}
