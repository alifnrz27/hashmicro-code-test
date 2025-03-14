<?php
namespace App\Validation;

use App\Helpers\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacterMatchValidation
{
    public static function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input1' => 'required|string|max:255',
            'input2' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ResponseHelper::response(422, 'Validation failed.', $validator->errors());
        }
        
        return ResponseHelper::response(200, 'Validation success.', $validator->validated());
    }
}
