<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlaceImage;
use App\Models\Place;
use App\Models\Province;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlaceController extends Controller
{
    public function index(Request $request)
    {
        $query = Place::with('province');

        // Tìm kiếm theo tên địa điểm
        if ($request->filled('search')) {
            $query->where(
                'name',
                'like',
                '%' . $request->search . '%'
            );
        }

        // Lọc theo tỉnh/thành
        if ($request->filled('province')) {
            $query->where(
                'province_id',
                $request->province
            );
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        // Danh sách địa điểm
        $places = $query
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();

        // Danh sách tỉnh/thành cho select
        $provinces = Province::orderBy('name')->get();

        return view(
            'admin.places.index',
            compact(
                'places',
                'provinces'
            )
        );
    }

    public function create()
    {
        $provinces = Province::orderBy('name')->get();

        $categories = Category::orderBy('name')->get();

        return view('admin.places.create', compact(
            'provinces',
            'categories'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',

            'ticket_price' => 'nullable|numeric|min:0',

            'open_time' => 'nullable',
            'close_time' => 'nullable',

            'visit_duration_min' => 'required|integer|min:1',

            'best_time' => 'required|in:morning,afternoon,evening,any',

            'best_months' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'activities' => 'nullable|string',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'status' => 'required|in:active,hidden',

            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',

            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'gallery_images' => 'nullable|array|max:10',

            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',

            'gallery_captions' => 'nullable|array',

            'gallery_captions.*' => 'nullable|string|max:255',
        ]);


        // Tạo slug tự động
        $baseSlug = Str::slug($validated['name']);

        $slug = $baseSlug;
        $number = 1;

        while (Place::where('slug', $slug)->exists()) {

            $slug = $baseSlug . '-' . $number;

            $number++;
        }


        // Upload ảnh đại diện
        $coverImage = null;

        if ($request->hasFile('cover_image')) {

            $file = $request->file('cover_image');

            $fileName =
                time() . '-' .
                Str::random(6) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('images/places'),
                $fileName
            );

            $coverImage = 'images/places/' . $fileName;
        }


        // Tạo địa điểm
        $place = Place::create([
            'province_id' => $validated['province_id'],

            'name' => $validated['name'],

            'slug' => $slug,

            'short_description' =>
                $validated['short_description'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'cover_image' => $coverImage,

            'address' =>
                $validated['address'] ?? null,

            'ticket_price' =>
                $validated['ticket_price'] ?? 0,

            'open_time' =>
                $validated['open_time'] ?? null,

            'close_time' =>
                $validated['close_time'] ?? null,

            'visit_duration_min' =>
                $validated['visit_duration_min'],

            'best_time' =>
                $validated['best_time'],

            'best_months' =>
                $validated['best_months'] ?? null,

            'notes' =>
                $validated['notes'] ?? null,

            'activities' =>
                $validated['activities'] ?? null,

            'latitude' =>
                $validated['latitude'] ?? null,

            'longitude' =>
                $validated['longitude'] ?? null,

            'view_count' => 0,

            'is_featured' =>
                $request->boolean('is_featured'),

            'status' =>
                $validated['status'],
        ]);


        // Gắn danh mục
        $place->categories()->sync(
            $validated['categories'] ?? []
        );


        // ==============================
        // LƯU THƯ VIỆN ẢNH
        // ==============================

        if ($request->hasFile('gallery_images')) {

            foreach (
                $request->file('gallery_images')
                as $index => $file
            ) {

                $fileName =
                    time() . '-' .
                    Str::random(8) . '.' .
                    $file->getClientOriginalExtension();

                $file->move(
                    public_path('images/places/gallery'),
                    $fileName
                );

                $place->images()->create([
                    'image_path' =>
                        'images/places/gallery/' . $fileName,

                    'caption' =>
                        $request->input(
                            "gallery_captions.$index"
                        ),

                    'sort_order' =>
                        $index + 1,
                ]);
            }
        }


        return redirect()
            ->route('admin.places.index')
            ->with(
                'success',
                'Thêm địa điểm thành công!'
            );
    }

    public function show(Place $place)
    {
        //
    }

    public function edit(Place $place)
    {
        $provinces = Province::orderBy('name')->get();

        $categories = Category::orderBy('name')->get();

        $place->load([
            'categories',
            'images' => function ($query) {
                $query->orderBy('sort_order');
            },
        ]);

        return view('admin.places.edit', compact(
            'place',
            'provinces',
            'categories'
        ));
    }

    public function update(Request $request, Place $place)
    {
        $validated = $request->validate([
            'province_id' => 'required|exists:provinces,id',

            'name' => 'required|string|max:255',

            'short_description' => 'nullable|string',
            'description' => 'nullable|string',

            'address' => 'nullable|string|max:255',

            'ticket_price' => 'nullable|numeric|min:0',

            'open_time' => 'nullable',
            'close_time' => 'nullable',

            'visit_duration_min' => 'required|integer|min:1',

            'best_time' =>
                'required|in:morning,afternoon,evening,any',

            'best_months' => 'nullable|string|max:255',

            'notes' => 'nullable|string',
            'activities' => 'nullable|string',

            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            'status' => 'required|in:active,hidden',

            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',

            'cover_image' =>
                'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            'gallery_images' => 'nullable|array|max:10',

            'gallery_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:5120',

            'gallery_captions' => 'nullable|array',

            'gallery_captions.*' => 'nullable|string|max:255',

            'existing_captions' => 'nullable|array',

            'existing_captions.*' => 'nullable|string|max:255',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SLUG
        |--------------------------------------------------------------------------
        */

        $baseSlug = Str::slug($validated['name']);

        $slug = $baseSlug;
        $number = 1;

        while (
            Place::where('slug', $slug)
                ->where('id', '!=', $place->id)
                ->exists()
        ) {
            $slug = $baseSlug . '-' . $number;

            $number++;
        }


        /*
        |--------------------------------------------------------------------------
        | ẢNH ĐẠI DIỆN
        |--------------------------------------------------------------------------
        */

        $coverImage = $place->cover_image;

        if ($request->hasFile('cover_image')) {

            // Xóa ảnh cũ
            if (
                $place->cover_image &&
                file_exists(public_path($place->cover_image))
            ) {
                unlink(public_path($place->cover_image));
            }


            // Lưu ảnh mới
            $file = $request->file('cover_image');

            $fileName =
                time() . '-' .
                Str::random(6) . '.' .
                $file->getClientOriginalExtension();

            $file->move(
                public_path('images/places'),
                $fileName
            );

            $coverImage =
                'images/places/' . $fileName;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE PLACE
        |--------------------------------------------------------------------------
        */

        $place->update([

            'province_id' =>
                $validated['province_id'],

            'name' =>
                $validated['name'],

            'slug' =>
                $slug,

            'short_description' =>
                $validated['short_description'] ?? null,

            'description' =>
                $validated['description'] ?? null,

            'cover_image' =>
                $coverImage,

            'address' =>
                $validated['address'] ?? null,

            'ticket_price' =>
                $validated['ticket_price'] ?? 0,

            'open_time' =>
                $validated['open_time'] ?? null,

            'close_time' =>
                $validated['close_time'] ?? null,

            'visit_duration_min' =>
                $validated['visit_duration_min'],

            'best_time' =>
                $validated['best_time'],

            'best_months' =>
                $validated['best_months'] ?? null,

            'notes' =>
                $validated['notes'] ?? null,

            'activities' =>
                $validated['activities'] ?? null,

            'latitude' =>
                $validated['latitude'] ?? null,

            'longitude' =>
                $validated['longitude'] ?? null,

            'is_featured' =>
                $request->boolean('is_featured'),

            'status' =>
                $validated['status'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | UPDATE CATEGORY
        |--------------------------------------------------------------------------
        */

        $place->categories()->sync(
            $validated['categories'] ?? []
        );


        // ==============================
        // CẬP NHẬT CAPTION ẢNH HIỆN TẠI
        // ==============================

        if ($request->filled('existing_captions')) {

            foreach (
                $request->input('existing_captions')
                as $imageId => $caption
            ) {

                $image = $place->images()
                    ->where('id', $imageId)
                    ->first();

                if ($image) {

                    $image->update([
                        'caption' => $caption,
                    ]);

                }
            }
        }


        // ==============================
        // THÊM ẢNH MỚI VÀO THƯ VIỆN
        // ==============================

        if ($request->hasFile('gallery_images')) {

            $currentMaxSort =
                $place->images()->max('sort_order') ?? 0;

            foreach (
                $request->file('gallery_images')
                as $index => $file
            ) {

                $fileName =
                    time() . '-' .
                    Str::random(8) . '.' .
                    $file->getClientOriginalExtension();

                $file->move(
                    public_path('images/places/gallery'),
                    $fileName
                );

                $place->images()->create([

                    'image_path' =>
                        'images/places/gallery/' . $fileName,

                    'caption' =>
                        $request->input(
                            "gallery_captions.$index"
                        ),

                    'sort_order' =>
                        $currentMaxSort + $index + 1,

                ]);
            }
        }


        return redirect()
            ->route('admin.places.index')
            ->with(
                'success',
                'Cập nhật địa điểm thành công!'
            );
    }


    public function destroyImage(
        Place $place,
        PlaceImage $image
    ) {

        // Kiểm tra ảnh có thực sự thuộc địa điểm này không
        if ($image->place_id !== $place->id) {
            abort(404);
        }

        // Xóa file ảnh trong public
        if ($image->image_path) {

            $imagePath =
                public_path($image->image_path);

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Xóa record trong place_images
        $image->delete();

        return back()->with(
            'success',
            'Xóa ảnh khỏi thư viện thành công!'
        );
    }


    public function destroy(Place $place)
    {
        try {

            DB::transaction(function () use ($place) {

                /*
                |--------------------------------------------------------------------------
                | 1. XÓA ẢNH TRONG place_images
                |--------------------------------------------------------------------------
                */

                foreach ($place->images as $image) {

                    if (
                        $image->image_path &&
                        file_exists(public_path($image->image_path))
                    ) {
                        unlink(public_path($image->image_path));
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | 2. XÓA ẢNH ĐẠI DIỆN
                |--------------------------------------------------------------------------
                */

                if (
                    $place->cover_image &&
                    file_exists(public_path($place->cover_image))
                ) {
                    unlink(public_path($place->cover_image));
                }


                /*
                |--------------------------------------------------------------------------
                | 3. XÓA LIÊN KẾT DANH MỤC
                |--------------------------------------------------------------------------
                */

                $place->categories()->detach();


                /*
                |--------------------------------------------------------------------------
                | 4. XÓA ĐỊA ĐIỂM
                |--------------------------------------------------------------------------
                |
                | Các bảng có foreign key cascade sẽ tự xử lý dữ liệu liên quan.
                |
                */

                $place->delete();

            });


            return redirect()
                ->route('admin.places.index')
                ->with(
                    'success',
                    'Xóa địa điểm thành công!'
                );

        } catch (\Exception $e) {

            return redirect()
                ->route('admin.places.index')
                ->with(
                    'error',
                    'Không thể xóa địa điểm vì đang có dữ liệu liên quan.'
                );
        }
    }


    
    public function toggleStatus(Place $place)
    {
        if ($place->status === 'active') {
            $place->status = 'hidden';
        } else {
            $place->status = 'active';
        }

        $place->save();

        $message = $place->status === 'active'
            ? 'Đã hiển thị địa điểm.'
            : 'Đã ẩn địa điểm.';

        return back()->with('success', $message);
    }
}