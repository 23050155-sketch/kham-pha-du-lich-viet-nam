<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;
use App\Models\PlaceImage;

class PlaceImageSeeder extends Seeder
{
    public function run(): void
    {
        $place = Place::where('slug', 'bien-my-khe')
            ->firstOrFail();

        $images = [
            [
                'image_path' => 'images/places/bien-my-khe/1.jpg',
                'caption' => 'Biển Mỹ Khê nhìn từ bờ biển',
                'sort_order' => 1,
            ],

            [
                'image_path' => 'images/places/bien-my-khe/2.jpg',
                'caption' => 'Không gian biển Mỹ Khê',
                'sort_order' => 2,
            ],

            [
                'image_path' => 'images/places/bien-my-khe/3.jpg',
                'caption' => 'Bãi cát tại biển Mỹ Khê',
                'sort_order' => 3,
            ],

            [
                'image_path' => 'images/places/bien-my-khe/4.jpg',
                'caption' => 'Khung cảnh biển Mỹ Khê',
                'sort_order' => 4,
            ],
        ];

        foreach ($images as $image) {

            PlaceImage::updateOrCreate(
                [
                    'place_id' => $place->id,
                    'image_path' => $image['image_path'],
                ],
                [
                    'caption' => $image['caption'],
                    'sort_order' => $image['sort_order'],
                ]
            );
        }
    }
}