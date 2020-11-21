<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 *  会社のバリデーション
 */
class CompanyRequest extends FormRequest
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
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [

        ];
    }

    protected function failedValidation(Validator $validator)
    {
    }

    public function getValidator()
    {
        return $this->getValidatorInstance();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $datas = [
            "user_name" => ["required", "stringMax:255,半角"],
            "user_name_english" => ["required", "stringMax:255,半角"],
            "login_id" => ["required", "stringMax:20,半角", "unique:users,login_id,".$this->input("id").",id,deleted_at,NULL"],
            "password" => ["required", "stringMax:20,半角", "password"],

        ];

        if ($this->input("id")){
            unset($datas["password"][0]);
        }

        return $datas;
    }
}
