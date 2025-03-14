<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function register(array $data)
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            return ResponseHelper::response(201, 'Register successfully.', $user);
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }
    
    public function authenticate(array $data){
        try {
            if (Auth::attempt($data)) {
                request()->session()->regenerate();
                return ResponseHelper::response(200, 'Login successfully.', Auth::user());
            }
            return ResponseHelper::response(400, 'Email or password do not match with our records.');
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }

    public function logout()
    {
        try {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
            return ResponseHelper::response(200, 'Logout successfully.');
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }
}