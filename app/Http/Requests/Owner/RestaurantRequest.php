<?php

namespace App\Http\Requests\Owner;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
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
        if ($this->method() == 'PUT' or $this->method() == 'PATCH')
        {
            $image = 'mimes:jpg,jpeg,png';
        }
        return [
            'user_id' => ['required', 'exists:App\Models\User,id'],
            'image' => $image,
            'name' => 'required|min:3|max:200',
            'phone' => 'required|numeric',
            'open_time' => 'required',
            'close_time' => 'required',
            'bank_number' => 'numeric',
        ];
    }
}
