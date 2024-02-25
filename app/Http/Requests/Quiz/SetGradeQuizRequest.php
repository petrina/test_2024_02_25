<?php

namespace App\Http\Requests\Quiz;

use App\Http\Requests\BaseRequest;

class SetGradeQuizRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grade' => 'required|integer|min:0|max:100',
        ];
    }
}
