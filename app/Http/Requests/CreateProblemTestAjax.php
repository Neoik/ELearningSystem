<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProblemTestAjax extends FormRequest
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
        $input_rule = Rule::unique('problem_i_o_tests')->where(function ($query) {
            $problem_id = $this->route()->parameters['prob']['id'];
            return $query->where('problem_id', $problem_id);
        });
        return [
            'input' => ['required', 'max:256', $input_rule],
            'output' => 'required|max:256',
        ];
    }

    public function messages()
    {
        return [
            'input.unique' => 'You already have test with same input',
        ];
    }
}
