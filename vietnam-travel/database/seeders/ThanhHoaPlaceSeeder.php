<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Place;

class ThanhHoaPlaceSeeder extends Seeder
{
    public function run(): void
    {
        $province = Province::where('name', 'Thanh Hóa')
            ->firstOrFail();

        $places = [

            // ==========================================
            // 1. BIỂN SẦM SƠN
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Biển Sầm Sơn',
                'slug' => 'bien-sam-son',

                'short_description' =>
                    'Bãi biển nổi tiếng của Thanh Hóa với bờ cát dài, sóng biển đẹp và hệ thống dịch vụ du lịch phát triển.',

                'description' =>
                    'Biển Sầm Sơn là một trong những điểm du lịch biển nổi tiếng lâu đời của miền Bắc và Bắc Trung Bộ. Bãi biển có bờ cát dài, không gian rộng và nằm gần nhiều danh thắng như Hòn Trống Mái, đền Độc Cước và núi Trường Lệ.',

                'cover_image' =>
                    'images/places/bien-sam-son/cover.jpg',

                'address' =>
                    'Phường Sầm Sơn, tỉnh Thanh Hóa',

                'ticket_price' => 0,

                'open_time' => '05:00:00',
                'close_time' => '22:00:00',

                'visit_duration_min' => 180,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 4 - Tháng 8',

                'notes' =>
                    'Nên kiểm tra thời tiết và tình trạng biển trước khi tắm; mùa hè và dịp lễ thường rất đông khách.',

                'activities' =>
                    'Tắm biển, đi dạo, ngắm bình minh, chụp ảnh, thưởng thức hải sản, tham quan Hòn Trống Mái.',

                'latitude' => 19.7426,
                'longitude' => 105.9020,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 2. THÀNH NHÀ HỒ
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Thành Nhà Hồ',
                'slug' => 'thanh-nha-ho',

                'short_description' =>
                    'Di sản văn hóa thế giới nổi tiếng với kiến trúc thành đá độc đáo được xây dựng vào cuối thế kỷ XIV.',

                'description' =>
                    'Thành Nhà Hồ là công trình kiến trúc quân sự và kinh đô cổ đặc biệt của Việt Nam. Thành nổi bật với những khối đá lớn được ghép chính xác, hệ thống cổng thành đồ sộ và giá trị lịch sử gắn với triều Hồ.',

                'cover_image' =>
                    'images/places/thanh-nha-ho/cover.jpg',

                'address' =>
                    'Khu vực Vĩnh Lộc, tỉnh Thanh Hóa',

                'ticket_price' => 40000,

                'open_time' => '07:00:00',
                'close_time' => '17:30:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Khu di tích rộng, nên chuẩn bị giày thuận tiện và dành đủ thời gian tham quan các cổng thành và khu trưng bày.',

                'activities' =>
                    'Tham quan thành cổ, tìm hiểu lịch sử, khám phá kiến trúc đá, chụp ảnh.',

                'latitude' => 20.0788,
                'longitude' => 105.6040,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 3. KHU DI TÍCH LAM KINH
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Khu di tích Lam Kinh',
                'slug' => 'khu-di-tich-lam-kinh',

                'short_description' =>
                    'Kinh đô cổ gắn với vua Lê Lợi và triều Hậu Lê, nổi tiếng với các cung điện, lăng mộ và di tích lịch sử.',

                'description' =>
                    'Lam Kinh là khu di tích lịch sử quan trọng gắn với cuộc khởi nghĩa Lam Sơn và vua Lê Thái Tổ. Nơi đây từng là Tây Kinh của triều Hậu Lê, hiện còn hệ thống lăng mộ các vua, bia Vĩnh Lăng, điện miếu và nhiều công trình được phục dựng.',

                'cover_image' =>
                    'images/places/lam-kinh/cover.jpg',

                'address' =>
                    'Khu vực Lam Sơn, tỉnh Thanh Hóa',

                'ticket_price' => 30000,

                'open_time' => '07:00:00',
                'close_time' => '17:30:00',

                'visit_duration_min' => 150,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Nên giữ trật tự tại các khu vực lăng mộ và đền thờ; có thể thuê thuyết minh viên để hiểu rõ hơn về lịch sử triều Lê.',

                'activities' =>
                    'Tham quan di tích, tìm hiểu lịch sử khởi nghĩa Lam Sơn, tham quan lăng vua, chụp ảnh, tìm hiểu kiến trúc cổ.',

                'latitude' => 19.9250,
                'longitude' => 105.4120,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 4. PÙ LUÔNG
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Khu bảo tồn thiên nhiên Pù Luông',
                'slug' => 'pu-luong',

                'short_description' =>
                    'Vùng núi nổi tiếng với ruộng bậc thang, bản làng người Thái và cảnh quan thiên nhiên xanh mát.',

                'description' =>
                    'Pù Luông là một trong những điểm du lịch sinh thái và cộng đồng nổi bật của Thanh Hóa. Khu vực có ruộng bậc thang, rừng núi, thung lũng và các bản làng truyền thống của đồng bào Thái, thích hợp cho nghỉ dưỡng và khám phá thiên nhiên.',

                'cover_image' =>
                    'images/places/pu-luong/cover.jpg',

                'address' =>
                    'Xã Pù Luông, tỉnh Thanh Hóa',

                'ticket_price' => 0,

                'open_time' => '00:00:00',
                'close_time' => null,

                'visit_duration_min' => 1440,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 5 - Tháng 6, Tháng 9 - Tháng 10',

                'notes' =>
                    'Đường vào một số bản có nhiều đoạn đèo dốc; nên kiểm tra thời tiết và đặt chỗ lưu trú trước vào mùa cao điểm.',

                'activities' =>
                    'Trekking, ngắm ruộng bậc thang, khám phá bản làng, nghỉ homestay, thưởng thức ẩm thực địa phương, chụp ảnh.',

                'latitude' => 20.4730,
                'longitude' => 105.1320,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 5. SUỐI CÁ THẦN CẨM LƯƠNG
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Suối cá thần Cẩm Lương',
                'slug' => 'suoi-ca-than-cam-luong',

                'short_description' =>
                    'Dòng suối nổi tiếng với đàn cá tự nhiên đông đúc, gắn với tín ngưỡng và truyền thuyết của người dân địa phương.',

                'description' =>
                    'Suối cá thần Cẩm Lương là một trong những địa điểm du lịch độc đáo của Thanh Hóa. Dòng suối có hàng nghìn con cá sinh sống tự nhiên trong làn nước trong, gắn với nhiều truyền thuyết và tín ngưỡng của cộng đồng địa phương.',

                'cover_image' =>
                    'images/places/suoi-ca-than-cam-luong/cover.jpg',

                'address' =>
                    'Khu vực Cẩm Lương, tỉnh Thanh Hóa',

                'ticket_price' => 20000,

                'open_time' => '07:00:00',
                'close_time' => '18:00:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 2 - Tháng 10',

                'notes' =>
                    'Không bắt cá hoặc gây ảnh hưởng đến môi trường sống của đàn cá; nên tuân thủ các quy định tại khu du lịch.',

                'activities' =>
                    'Ngắm đàn cá, tham quan suối, tìm hiểu truyền thuyết địa phương, chụp ảnh, tham quan cảnh quan núi đá.',

                'latitude' => 20.3530,
                'longitude' => 105.4990,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],
        ];


        foreach ($places as $placeData) {

            Place::updateOrCreate(
                [
                    'slug' => $placeData['slug'],
                ],
                $placeData
            );
        }
    }
}