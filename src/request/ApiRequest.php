<?php

namespace laililmahfud\starterkit\request;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Http\FormRequest;
use laililmahfud\starterkit\helpers\JwtToken;
use laililmahfud\starterkit\helpers\JsonResponse;
use laililmahfud\starterkit\middleware\ErrorType;

class ApiRequest extends FormRequest
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
            //
        ];
    }
    public function users(){
        $token = Request::header('authorization');
        $user = null;
        try {
            $decoded = JwtToken::decode($token);
            $user = $decoded->data;
        } catch (\Exception $e) {
        }
        if($user==null || !isset($user->code)){
            JsonResponse::Unauthorized('token not found',ErrorType::$UNAUTHORIZED)->send();
            exit();
        }
        return $user;
    }

    public function validation($data)
    {
        $validator = Validator::make($this->all(), $data);
        if ($validator->fails()) {
            JsonResponse::BadRequest($validator->messages())->send();
            exit();
        }
    }
}
