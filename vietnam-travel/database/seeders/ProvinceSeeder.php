<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        $provinces = [
            ['name' => 'Hà Nội', 'slug' => 'ha-noi', 'administrative_type' => 'Thành phố'],
            ['name' => 'Cao Bằng', 'slug' => 'cao-bang', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Tuyên Quang', 'slug' => 'tuyen-quang', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Điện Biên', 'slug' => 'dien-bien', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Lai Châu', 'slug' => 'lai-chau', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Sơn La', 'slug' => 'son-la', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Lào Cai', 'slug' => 'lao-cai', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Thái Nguyên', 'slug' => 'thai-nguyen', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Lạng Sơn', 'slug' => 'lang-son', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Quảng Ninh', 'slug' => 'quang-ninh', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Bắc Ninh', 'slug' => 'bac-ninh', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Phú Thọ', 'slug' => 'phu-tho', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Hưng Yên', 'slug' => 'hung-yen', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Hải Phòng', 'slug' => 'hai-phong', 'administrative_type' => 'Thành phố'],
            ['name' => 'Ninh Bình', 'slug' => 'ninh-binh', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Thanh Hóa', 'slug' => 'thanh-hoa', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Nghệ An', 'slug' => 'nghe-an', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Hà Tĩnh', 'slug' => 'ha-tinh', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Quảng Trị', 'slug' => 'quang-tri', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Huế', 'slug' => 'hue', 'administrative_type' => 'Thành phố'],
            ['name' => 'Đà Nẵng', 'slug' => 'da-nang', 'administrative_type' => 'Thành phố'],
            ['name' => 'Quảng Ngãi', 'slug' => 'quang-ngai', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Gia Lai', 'slug' => 'gia-lai', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Khánh Hòa', 'slug' => 'khanh-hoa', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Đắk Lắk', 'slug' => 'dak-lak', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Lâm Đồng', 'slug' => 'lam-dong', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Đồng Nai', 'slug' => 'dong-nai', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Tây Ninh', 'slug' => 'tay-ninh', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Thành phố Hồ Chí Minh', 'slug' => 'thanh-pho-ho-chi-minh', 'administrative_type' => 'Thành phố'],
            ['name' => 'Cần Thơ', 'slug' => 'can-tho', 'administrative_type' => 'Thành phố'],
            ['name' => 'Vĩnh Long', 'slug' => 'vinh-long', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Đồng Tháp', 'slug' => 'dong-thap', 'administrative_type' => 'Tỉnh'],
            ['name' => 'An Giang', 'slug' => 'an-giang', 'administrative_type' => 'Tỉnh'],
            ['name' => 'Cà Mau', 'slug' => 'ca-mau', 'administrative_type' => 'Tỉnh'],
        ];

        foreach ($provinces as $province) {
            Province::updateOrCreate(
                [
                    'slug' => $province['slug'],
                ],
                [
                    'name' => $province['name'],
                    'administrative_type' => $province['administrative_type'],
                ]
            );
        }
    }
}