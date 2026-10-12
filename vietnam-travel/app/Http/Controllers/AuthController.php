<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'email',
                    'unique:users,email',
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
                'name.required' =>
                    'Vui lòng nhập họ và tên.',

                'email.required' =>
                    'Vui lòng nhập email.',

                'email.email' =>
                    'Email không đúng định dạng.',

                'email.unique' =>
                    'Email này đã được sử dụng.',

                'password.required' =>
                    'Vui lòng nhập mật khẩu.',

                'password.min' =>
                    'Mật khẩu phải có ít nhất 8 ký tự.',

                'password.regex' =>
                    'Mật khẩu phải có chữ hoa, chữ thường, số và ký tự đặc biệt.',

                'password.confirmed' =>
                    'Xác nhận mật khẩu không khớp.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/');
    }



    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => [
                    'required',
                    'email',
                ],

                'password' => [
                    'required',
                    'string',
                ],
            ],
            [
                'email.required' =>
                    'Vui lòng nhập email.',

                'email.email' =>
                    'Email không đúng định dạng.',

                'password.required' =>
                    'Vui lòng nhập mật khẩu.',
            ]
        );

        // Kiểm tra email và mật khẩu
        if (Auth::attempt($credentials)) {

            // Tạo lại session sau khi đăng nhập thành công
            $request->session()->regenerate();

            // Nếu là Admin thì chuyển đến trang quản lý địa điểm
            if (auth()->user()->role === 'admin') {
                return redirect('/admin/places');
            }

            // User thường quay về trang chủ
            return redirect('/');
        }

        // Sai email hoặc mật khẩu
        return back()
            ->withErrors([
                'email' =>
                    'Email hoặc mật khẩu không đúng.',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}