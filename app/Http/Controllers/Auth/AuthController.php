<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Service\Auth\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function viewLogin()
    {
        return view('auth.login');
    }

    public function viewRegister()
    {
        return view('auth.register');
    }

    public function login(LoginRequest $request)
    {
        if ($this->authService->login($request->all())) {
            if (Auth::user()->role === User::ROLE_ADMIN) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('blogs.home');
        }

        return redirect()->route('view.login')->with('message', __('auth.login_error'));
    }

    public function register(RegisterRequest $request)
    {
        if ($this->authService->register($request->all())) {
            return redirect()->route('view.login')->with('success', __('auth.register_success'));
        }

        return redirect()->route('view.register')->with('message', __('auth.register_error'));
    }

    public function verifyEmail(string $token)
    {
        $message = $this->authService->verifyEmail($token);

        if (!$message) {
            return redirect()->route('view.login')->with('message', $message);
        }

        return redirect()->route('view.login')->with('success', __('auth.verify_success'));
    }

    public function formForgotPassword()
    {
        return view('auth.form_forgot_password');
    }

    public function forgotPassword(Request $request)
    {
        if ($this->authService->forgotPassword($request->email)) {
            return redirect()->route('view.login')->with('success', __('auth.forgot_password_check_mail'));
        }

        return redirect()->route('view.login')->with('message', __('auth.forgot_password_error'));
    }

    public function getPassword(string $token)
    {
        if ($this->authService->createPasswordNew($token)) {
            return redirect()->route('view.login')->with('success', __('auth.password_new'));
        }

        return redirect()->route('view.login')->with('message', __('auth.try_again'));
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('view.login');
    }
}
