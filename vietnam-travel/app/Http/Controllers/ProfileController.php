<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validateWithBag(
            'profile',
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'email',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],

                'phone' => [
                    'nullable',
                    'string',
                    'regex:/^0[0-9]{9}$/',
                    Rule::unique('users', 'phone')->ignore($user->id),
                ],

                'avatar' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048',
                ],
            ],
            [
                'phone.regex' =>
                    'Số điện thoại phải gồm 10 chữ số và bắt đầu bằng số 0.',

                'phone.unique' =>
                    'Số điện thoại này đã được sử dụng.',
            ]
        );

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {

            $file = $request->file('avatar');

            $filename =
                'user-' .
                $user->id .
                '-' .
                time() .
                '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('images/avatars'),
                $filename
            );

            $user->avatar =
                'images/avatars/' . $filename;
        }

        $user->save();

        return back()->with(
            'success',
            'Cập nhật hồ sơ thành công.'
        );
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validateWithBag(
            'password',
            [
                'current_password' => [
                    'required',
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
                'current_password.required' =>
                    'Vui lòng nhập mật khẩu hiện tại.',

                'password.required' =>
                    'Vui lòng nhập mật khẩu mới.',

                'password.min' =>
                    'Mật khẩu mới phải có ít nhất 8 ký tự.',

                'password.regex' =>
                    'Mật khẩu phải có chữ hoa, chữ thường, số và ký tự đặc biệt.',

                'password.confirmed' =>
                    'Xác nhận mật khẩu mới không khớp.',
            ]
        );


        /* Kiểm tra mật khẩu hiện tại */
        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {

            return back()->withErrors([
                'current_password' =>
                    'Mật khẩu hiện tại không đúng.',
            ], 'password');
        }


        /* Cập nhật mật khẩu */
        $user->password =
            Hash::make($request->password);

        $user->save();

        return back()->with(
            'password_success',
            'Đổi mật khẩu thành công.'
        );
    }
}