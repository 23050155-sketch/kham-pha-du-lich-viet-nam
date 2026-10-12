<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Province::query()
            ->withCount('places');

        // Tìm theo tên tỉnh/thành
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Lọc theo loại hành chính
        if ($request->filled('type')) {
            $query->where(
                'administrative_type',
                $request->type
            );
        }

        $provinces = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view(
            'admin.provinces.index',
            compact('provinces')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.provinces.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name',

            'administrative_type' =>
                'required|in:Tỉnh,Thành phố',

            'description' =>
                'nullable|string',

            'cover_image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);


        /*
        |--------------------------------------------------------------------------
        | TẠO SLUG
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug($validated['name']);

        $slug = $baseSlug;

        $number = 1;

        while (
            Province::where('slug', $slug)->exists()
        ) {

            $slug = $baseSlug . '-' . $number;

            $number++;
        }


        /*
        |--------------------------------------------------------------------------
        | ẢNH BÌA
        |--------------------------------------------------------------------------
        */

        $coverImage = null;

        if ($request->hasFile('cover_image')) {

            $file = $request->file('cover_image');

            $fileName =
                time() . '-' .
                Str::random(6) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('images/provinces'),
                $fileName
            );

            $coverImage =
                'images/provinces/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | TẠO TỈNH / THÀNH PHỐ
        |--------------------------------------------------------------------------
        */

        Province::create([

            'name' =>
                $validated['name'],

            'slug' =>
                $slug,

            'administrative_type' =>
                $validated['administrative_type'],

            'description' =>
                $validated['description'] ?? null,

            'cover_image' =>
                $coverImage,

        ]);


        return redirect()
            ->route('admin.provinces.index')
            ->with(
                'success',
                'Thêm tỉnh/thành phố thành công!'
            );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        return view(
            'admin.provinces.edit',
            compact('province')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:provinces,name,' . $province->id,
            ],

            'administrative_type' =>
                'required|in:Tỉnh,Thành phố',

            'description' =>
                'nullable|string',

            'cover_image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);


        /*
        |--------------------------------------------------------------------------
        | TẠO LẠI SLUG
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug($validated['name']);

        $slug = $baseSlug;

        $number = 1;

        while (
            Province::where('slug', $slug)
                ->where('id', '!=', $province->id)
                ->exists()
        ) {

            $slug = $baseSlug . '-' . $number;

            $number++;
        }


        /*
        |--------------------------------------------------------------------------
        | ẢNH BÌA
        |--------------------------------------------------------------------------
        */

        $coverImage = $province->cover_image;

        if ($request->hasFile('cover_image')) {

            // Xóa ảnh cũ
            if (
                $province->cover_image &&
                file_exists(public_path($province->cover_image))
            ) {
                unlink(public_path($province->cover_image));
            }


            // Upload ảnh mới
            $file = $request->file('cover_image');

            $fileName =
                time() . '-' .
                Str::random(6) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('images/provinces'),
                $fileName
            );

            $coverImage =
                'images/provinces/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $province->update([

            'name' =>
                $validated['name'],

            'slug' =>
                $slug,

            'administrative_type' =>
                $validated['administrative_type'],

            'description' =>
                $validated['description'] ?? null,

            'cover_image' =>
                $coverImage,

        ]);


        return redirect()
            ->route('admin.provinces.index')
            ->with(
                'success',
                'Cập nhật tỉnh/thành phố thành công!'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA ĐỊA ĐIỂM
        |--------------------------------------------------------------------------
        |
        | Nếu tỉnh/thành phố vẫn còn địa điểm thì không cho phép xóa.
        |
        */

        $placeCount = $province->places()->count();

        if ($placeCount > 0) {

            return redirect()
                ->route('admin.provinces.index')
                ->with(
                    'error',
                    'Không thể xóa ' .
                    $province->name .
                    ' vì đang có ' .
                    $placeCount .
                    ' địa điểm.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | LƯU ĐƯỜNG DẪN ẢNH
        |--------------------------------------------------------------------------
        */

        $coverImage = $province->cover_image;


        /*
        |--------------------------------------------------------------------------
        | XÓA TỈNH / THÀNH PHỐ
        |--------------------------------------------------------------------------
        */

        try {

            $province->delete();


            /*
            |--------------------------------------------------------------------------
            | XÓA FILE ẢNH SAU KHI XÓA DATABASE THÀNH CÔNG
            |--------------------------------------------------------------------------
            */

            if ($coverImage) {

                $imagePath = public_path($coverImage);

                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }


            return redirect()
                ->route('admin.provinces.index')
                ->with(
                    'success',
                    'Xóa tỉnh/thành phố thành công!'
                );

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('admin.provinces.index')
                ->with(
                    'error',
                    'Không thể xóa tỉnh/thành phố vì đang có dữ liệu liên quan.'
                );
        }
    }
}
