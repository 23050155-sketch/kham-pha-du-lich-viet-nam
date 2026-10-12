<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query()
            ->withCount('places');


        // Tìm kiếm danh mục
        if ($request->filled('search')) {

            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }


        $categories = $query
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();


        return view(
            'admin.categories.index',
            compact('categories')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);


        /*
        |--------------------------------------------------------------------------
        | TẠO SLUG
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug($validated['name']);

        $slug = $baseSlug;

        $number = 1;

        while (Category::where('slug', $slug)->exists()) {

            $slug = $baseSlug . '-' . $number;

            $number++;
        }


        /*
        |--------------------------------------------------------------------------
        | TẠO DANH MỤC
        |--------------------------------------------------------------------------
        */

        Category::create([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Thêm danh mục thành công!'
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
    public function edit(Category $category)
    {
        return view(
            'admin.categories.edit',
            compact('category')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:categories,name,' . $category->id,
            ],
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
            Category::where('slug', $slug)
                ->where('id', '!=', $category->id)
                ->exists()
        ) {

            $slug = $baseSlug . '-' . $number;

            $number++;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        $category->update([
            'name' => $validated['name'],
            'slug' => $slug,
        ]);


        return redirect()
            ->route('admin.categories.index')
            ->with(
                'success',
                'Cập nhật danh mục thành công!'
            );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        /*
        |--------------------------------------------------------------------------
        | KIỂM TRA ĐỊA ĐIỂM ĐANG SỬ DỤNG DANH MỤC
        |--------------------------------------------------------------------------
        */

        $placeCount = $category->places()->count();

        if ($placeCount > 0) {

            return redirect()
                ->route('admin.categories.index')
                ->with(
                    'error',
                    'Không thể xóa danh mục "' .
                    $category->name .
                    '" vì đang có ' .
                    $placeCount .
                    ' địa điểm sử dụng.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | XÓA DANH MỤC
        |--------------------------------------------------------------------------
        */

        try {

            $category->delete();

            return redirect()
                ->route('admin.categories.index')
                ->with(
                    'success',
                    'Xóa danh mục thành công!'
                );

        } catch (\Throwable $e) {

            report($e);

            return redirect()
                ->route('admin.categories.index')
                ->with(
                    'error',
                    'Không thể xóa danh mục vì đang có dữ liệu liên quan.'
                );
        }
    }
}
