<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();


        /*
        |--------------------------------------------------------------------------
        | TÌM KIẾM
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'email',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'phone',
                    'like',
                    '%' . $search . '%'
                );

            });
        }


        /*
        |--------------------------------------------------------------------------
        | LỌC THEO QUYỀN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('role')) {

            $query->where(
                'role',
                $request->role
            );
        }


        /*
        |--------------------------------------------------------------------------
        | DANH SÁCH
        |--------------------------------------------------------------------------
        */

        $users = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.users.index',
            compact('users')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | LOAD THỐNG KÊ HOẠT ĐỘNG
        |--------------------------------------------------------------------------
        */

        $user->loadCount([
            'ratings',
            'comments',
            'favorites',
            'itineraries',
        ]);


        return view(
            'admin.users.show',
            compact('user')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view(
            'admin.users.edit',
            compact('user')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:255',
                    Rule::unique('users', 'email')->ignore($user->id),
                ],

                'phone' => [
                    'nullable',
                    'string',
                    'regex:/^0[0-9]{9}$/',
                    Rule::unique('users', 'phone')->ignore($user->id),
                ],

                'role' => [
                    'required',
                    'in:user,admin',
                ],
            ],
            [
                'phone.regex' =>
                    'Số điện thoại phải gồm 10 chữ số và bắt đầu bằng số 0.',

                'phone.unique' =>
                    'Số điện thoại này đã được sử dụng.',
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | KHÔNG CHO ADMIN TỰ HẠ QUYỀN
        |--------------------------------------------------------------------------
        */

        if (
            auth()->id() === $user->id &&
            $validated['role'] !== 'admin'
        ) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Bạn không thể tự hạ quyền tài khoản Admin đang đăng nhập.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | CẬP NHẬT
        |--------------------------------------------------------------------------
        */

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'role' => $validated['role'],
        ]);


        return redirect()
            ->route('admin.users.show', $user)
            ->with(
                'success',
                'Cập nhật người dùng thành công!'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | KHÔNG CHO ADMIN TỰ XÓA CHÍNH MÌNH
        |--------------------------------------------------------------------------
        */

        if (auth()->id() === $user->id) {
            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Bạn không thể xóa tài khoản đang đăng nhập.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA DỮ LIỆU LIÊN QUAN
        |--------------------------------------------------------------------------
        */

        $ratingCount = $user->ratings()->count();
        $commentCount = $user->comments()->count();
        $favoriteCount = $user->favorites()->count();
        $itineraryCount = $user->itineraries()->count();

        $totalRelated =
            $ratingCount +
            $commentCount +
            $favoriteCount +
            $itineraryCount;


        /*
        |--------------------------------------------------------------------------
        | NẾU CÒN DỮ LIỆU -> KHÔNG CHO XÓA
        |--------------------------------------------------------------------------
        */

        if ($totalRelated > 0) {

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Không thể xóa tài khoản "' .
                    $user->name .
                    '" vì tài khoản này đang có dữ liệu hoạt động trên hệ thống.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | XÓA TÀI KHOẢN
        |--------------------------------------------------------------------------
        */

        try {

            /*
            * Lưu đường dẫn avatar trước khi xóa user.
            */
            $avatar = $user->avatar;

            $user->delete();


            /*
            * Xóa file avatar nếu có.
            */
            if ($avatar) {

                $avatarPath = public_path($avatar);

                if (file_exists($avatarPath)) {
                    unlink($avatarPath);
                }
            }


            return redirect()
                ->route('admin.users.index')
                ->with(
                    'success',
                    'Xóa tài khoản thành công!'
                );

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('admin.users.index')
                ->with(
                    'error',
                    'Không thể xóa tài khoản vì đang có dữ liệu liên quan.'
                );
        }
    }
}
