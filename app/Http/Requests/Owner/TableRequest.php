<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class TableRequest extends FormRequest
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
        $restaurant_id = ['required', 'exists:App\Models\Restaurant,id'];
        $index = '';
        if ($this->method() == 'PUT' or $this->method() == 'PATCH')
        {
            $restaurant_id = '';
            $index = ['required', Rule::unique('tables', 'index')->ignore($this->table)];
        }
        return [
            'restaurant_id' => $restaurant_id,
            'set_num' => 'required',
            'price' => 'required',
            'floor' => 'required',
            'index' => $index,
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
