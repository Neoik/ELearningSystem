<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProblemAjax extends FormRequest
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
        return [
            'name' => 'required|max:32',
            'description' => 'required',
            'input_description' => 'required',
            'output_description' => 'required',
            'max_mem' => 'required|integer|min:1',
            'max_time' => 'required|integer|min:1',
        ];
    }
}
