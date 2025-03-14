<?php
namespace App\Validation;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthValidation
{
    public static function validateRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::response(422, 'Validation failed.', $validator->errors());
        }
        
        return ResponseHelper::response(200, 'Validation success.', $validator->validated());
    }

    public static function validateLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::response(422, 'Validation failed.', $validator->errors());
        }
        
        return ResponseHelper::response(200, 'Validation success.', $validator->validated());
    }
}
