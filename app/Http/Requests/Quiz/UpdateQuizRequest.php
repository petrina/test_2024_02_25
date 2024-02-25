<?php

namespace App\Http\Requests\Quiz;

use App\Http\Requests\BaseRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|string|max:50|min:5',
            'quiz_date' => 'date',
            'location' => 'string|max:255',
            'user_id' => 'required|integer',
        ];
    }
}
