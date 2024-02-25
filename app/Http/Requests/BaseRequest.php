<?php

namespace App\Http\Requests;

use App\Exceptions\BadRequestException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;

    public function authorize()
    {
        return true;
    }
    protected function failedValidation(Validator $validator)
    {
        throw new BadRequestException(
            json_encode($validator->getMessageBag()->getMessages())
        );
    }
}
