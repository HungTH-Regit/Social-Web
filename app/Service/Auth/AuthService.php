<?php

namespace App\Service\Auth;

use App\Mail\ForgotPassword;
use App\Mail\SendPassword;
use App\Mail\VerifyAccount;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    public function login(array $data): bool
    {
        return Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => User::STATUS_ACTIVE
        ]);
    }

    public function register(array $data): bool
    {
        $token = Str::random(64);
        $user = User::create([
            'user_name' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => User::ROLE_USER,
            'avatar' => User::FILENAME_AVATAR_DEFAULT,
            'token_verify_email' => $token,
        ]);
        if ($user) {
            $dataSendMail = ['title' => 'Hi ' . $user['user_name'] . ' !', 'token' => $token];
            Mail::to($user['email'])->send(new VerifyAccount($dataSendMail));

            return true;
        }

        return false;
    }

    public function verifyEmail(string $token): string|bool
    {
        $user = User::where('token_verify_email', $token)->first();
        if (!$user) {
            return __('auth.email_unregistered');
        }
        if ($user->status === User::STATUS_INACTIVE) {
            $user->update([
                'email_verified_at' => now(),
                'status' => User::STATUS_ACTIVE
            ]);

            return true;
        }

        return __('auth.verified');
    }

    public function forgotPassword(string $email): bool
    {
        $user = User::where(['email' => $email, 'status' => User::STATUS_ACTIVE])->first();
        if ($user) {
            $tokenResetPassword = $user->createToken('auth_token')->plainTextToken;
            $passwordReset = PasswordResetToken::create(['user_id' => $user->id, 'token' => $tokenResetPassword]);
            if ($passwordReset) {
                $dataSendMail = ['token' => $tokenResetPassword];
                Mail::to($email)->send(new ForgotPassword($dataSendMail));

                return true;
            }
        }

        return false;
    }

    public function createPasswordNew(string $token): bool
    {
        $itemPasswordReset = PasswordResetToken::where(['token' => $token])->first();
        if ($itemPasswordReset) {
            $user = User::where('id', $itemPasswordReset->user_id)->first();
            $passwordNew = Str::random(6);
            $user->update(['password' => Hash::make($passwordNew)]);
            $dataSendMail = ['password' => $passwordNew];
            Mail::to($user->email)->send(new SendPassword($dataSendMail));
            $itemPasswordReset->delete();

            return true;
        }

        return false;
    }
}
