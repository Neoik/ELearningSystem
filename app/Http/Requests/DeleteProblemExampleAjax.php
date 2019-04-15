<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeleteProblemExampleAjax extends FormRequest
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
        $rule = Rule::exists('problem_i_o_examples')->where(function ($query) {
            $problem_id = $this->route()->parameters['prob']['id'];
            return $query->where('problem_id', $problem_id);
        });
        return [
            'id' => ['required', $rule],
        ];

    }
}
