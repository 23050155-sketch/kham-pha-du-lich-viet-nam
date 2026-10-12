<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Biển', 'slug' => 'bien'],
            ['name' => 'Núi', 'slug' => 'nui'],
            ['name' => 'Văn hóa', 'slug' => 'van-hoa'],
            ['name' => 'Tâm linh', 'slug' => 'tam-linh'],
            ['name' => 'Vui chơi', 'slug' => 'vui-choi'],
            ['name' => 'Thiên nhiên', 'slug' => 'thien-nhien'],
            ['name' => 'Lịch sử', 'slug' => 'lich-su'],
            ['name' => 'Ẩm thực', 'slug' => 'am-thuc'],
        ];

        foreach ($categories as $category) {

            Category::updateOrCreate(
                ['slug' => $category['slug']],
                ['name' => $category['name']]
            );

        }
    }
}