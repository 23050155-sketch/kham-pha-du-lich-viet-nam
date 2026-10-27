<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function showForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email', ''),
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate(
            [
                'token' => ['required'],

                'email' => [
                    'required',
                    'email',
                ],

                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[a-z]/',
                    'regex:/[A-Z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*?&#]/',
                    'confirmed',
                ],
            ],
            [
                'password.required' =>
                    'Vui lòng nhập mật khẩu mới.',

                'password.min' =>
                    'Mật khẩu phải có ít nhất 8 ký tự.',

                'password.regex' =>
                    'Mật khẩu phải có chữ hoa, chữ thường, số và ký tự đặc biệt.',

                'password.confirmed' =>
                    'Xác nhận mật khẩu không khớp.',
            ]
        );

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with(
                    'status',
                    'Đặt lại mật khẩu thành công. Hãy đăng nhập bằng mật khẩu mới.'
                );
        }

        return back()
            ->withErrors([
                'email' => __($status),
            ])
            ->withInput($request->only('email'));
    }
}