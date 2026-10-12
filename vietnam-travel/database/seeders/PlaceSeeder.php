<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Place;
use App\Models\Category;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        $daNang = Province::where('slug', 'da-nang')
            ->firstOrFail();

        $place = Place::updateOrCreate(
            [
                'slug' => 'bien-my-khe'
            ],
            [
                'province_id' => $daNang->id,

                'name' => 'Biển Mỹ Khê',

                'short_description' =>
                    'Bãi biển nổi tiếng tại Đà Nẵng với bờ cát dài và không gian thoáng đẹp.',

                'description' =>
                    'Biển Mỹ Khê là một trong những địa điểm du lịch nổi tiếng tại Đà Nẵng. Bãi biển có bờ cát dài, nước biển trong và không gian thích hợp để tắm biển, đi dạo, ngắm bình minh và tham gia nhiều hoạt động ngoài trời.',

                'cover_image' =>
                    'images/places/bien-my-khe/cover.jpg',

                'address' =>
                    'Đường Võ Nguyên Giáp, quận Sơn Trà, Đà Nẵng',

                'ticket_price' => 0,

                'open_time' => '05:00:00',

                'close_time' => '22:00:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 3 - Tháng 8',

                'notes' =>
                    'Nên mang theo kem chống nắng, mũ hoặc nón. Theo dõi thời tiết trước khi đi và không nên bơi quá xa bờ khi biển động.',

                'activities' =>
                    'Tắm biển, ngắm bình minh, đi dạo, chụp ảnh, tham gia các hoạt động thể thao biển.',

                'latitude' => 16.0544,

                'longitude' => 108.2428,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ]
        );

        $categoryIds = Category::whereIn(
            'slug',
            ['bien', 'thien-nhien']
        )->pluck('id');

        $place->categories()->sync($categoryIds);
    }
} 