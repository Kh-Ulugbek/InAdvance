<?php

namespace App\Http\Requests\Owner;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RestaurantRequest extends FormRequest
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
        $logo = 'required|mimes:jpg,jpeg,png';
        if ($this->method() == 'PUT' or $this->method() == 'PATCH')
        {
            $image = 'mimes:jpg,jpeg,png';
            $logo = 'mimes:jpg,jpeg,png';
        }
        return [
            'image_path' => $image,
            'logo_path' => $logo,
            'name' => 'required|min:3|max:200',
            'phone' => 'required|numeric',
            'open_time' => 'required',
            'close_time' => 'required',
            'bank_number' => 'numeric',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => true
        ], 422));
    }
}
