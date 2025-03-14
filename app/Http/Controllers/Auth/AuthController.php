<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use App\Validation\AuthValidation;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function insertNewUser(Request $request)
    {
        $validationResponse = AuthValidation::validateRegister($request);

        if ($validationResponse['code'] !== 200) {
            return redirect()->back()->withErrors($validationResponse['data']);
        }

        $response = $this->authService->register($request->all());

        if ($response['code'] == 201) {
            return redirect(route('login'))->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function authenticate(Request $request)
    {
        $validationResponse = AuthValidation::validateLogin($request);

        if ($validationResponse['code'] !== 200) {
            return redirect()->back()->withErrors($validationResponse['data']);
        }

        $response = $this->authService->authenticate($request->only('email', 'password'));

        if($response['code'] == 200){
            return redirect('/');
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function logout()
    {
        $response = $this->authService->logout();

        if ($response['code'] == 200) {
            return redirect(route('login'))->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
