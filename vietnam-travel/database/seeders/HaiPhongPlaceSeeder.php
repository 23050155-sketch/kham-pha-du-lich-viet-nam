<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Place;

class HaiPhongPlaceSeeder extends Seeder
{
    public function run(): void
    {
        $province = Province::where('name', 'Hải Phòng')
            ->firstOrFail();

        $places = [

            // ==========================================
            // 1. QUẦN ĐẢO CÁT BÀ
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Quần đảo Cát Bà',
                'slug' => 'quan-dao-cat-ba',

                'short_description' =>
                    'Quần đảo du lịch nổi tiếng của Hải Phòng với núi đá vôi, rừng nguyên sinh, bãi biển và hệ sinh thái biển phong phú.',

                'description' =>
                    'Quần đảo Cát Bà là một trong những biểu tượng du lịch nổi bật nhất của Hải Phòng. Khu vực có hàng trăm đảo lớn nhỏ, núi đá vôi, rừng nguyên sinh, bãi biển và nhiều vịnh kín, thích hợp cho nghỉ dưỡng và khám phá thiên nhiên.',

                'cover_image' =>
                    'images/places/cat-ba/cover.jpg',

                'address' =>
                    'Đặc khu Cát Hải, TP Hải Phòng',

                'ticket_price' => 0,

                'open_time' => '00:00:00',
                'close_time' => null,

                'visit_duration_min' => 1440,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 4 - Tháng 10',

                'notes' =>
                    'Nên kiểm tra thời tiết và lịch tàu, phà trước khi đi. Các bãi tắm, tàu tham quan và dịch vụ trong khu vực có thể thu phí riêng.',

                'activities' =>
                    'Tắm biển, đi tàu, trekking, chèo kayak, tham quan vườn quốc gia, chụp ảnh, nghỉ dưỡng.',

                'latitude' => 20.7270,
                'longitude' => 107.0480,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 2. VỊNH LAN HẠ
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Vịnh Lan Hạ',
                'slug' => 'vinh-lan-ha',

                'short_description' =>
                    'Vịnh biển nổi tiếng với hàng trăm đảo đá vôi, nước biển xanh và nhiều bãi tắm nhỏ giữa quần đảo Cát Bà.',

                'description' =>
                    'Vịnh Lan Hạ nằm ở phía đông quần đảo Cát Bà và là một trong những cảnh quan biển nổi bật nhất của Hải Phòng. Vịnh có nhiều đảo đá vôi, bãi cát nhỏ và vùng nước xanh, thích hợp cho tham quan bằng tàu, chèo kayak và khám phá các làng chài.',

                'cover_image' =>
                    'images/places/vinh-lan-ha/cover.jpg',

                'address' =>
                    'Đặc khu Cát Hải, TP Hải Phòng',

                'ticket_price' => 0,

                'open_time' => '06:00:00',
                'close_time' => '18:00:00',

                'visit_duration_min' => 300,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 4 - Tháng 10',

                'notes' =>
                    'Giá tàu và kayak thay đổi tùy tuyến. Nên kiểm tra dự báo thời tiết trước khi tham gia các hoạt động trên biển.',

                'activities' =>
                    'Đi tàu, chèo kayak, tắm biển, tham quan làng chài, ngắm cảnh, chụp ảnh.',

                'latitude' => 20.7160,
                'longitude' => 107.0730,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 3. KHU DU LỊCH ĐỒ SƠN
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Khu du lịch Đồ Sơn',
                'slug' => 'do-son',

                'short_description' =>
                    'Khu du lịch biển lâu đời của Hải Phòng, nổi tiếng với bãi biển, cảnh quan ven biển và Lễ hội Chọi trâu Đồ Sơn.',

                'description' =>
                    'Đồ Sơn là một trong những khu du lịch biển nổi tiếng nhất của Hải Phòng. Khu vực có nhiều bãi tắm, đồi thông, các công trình tâm linh và nghỉ dưỡng, đồng thời gắn với Lễ hội Chọi trâu truyền thống nổi tiếng.',

                'cover_image' =>
                    'images/places/do-son/cover.jpg',

                'address' =>
                    'Phường Đồ Sơn, TP Hải Phòng',

                'ticket_price' => 0,

                'open_time' => '05:00:00',
                'close_time' => '22:00:00',

                'visit_duration_min' => 300,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 4 - Tháng 9',

                'notes' =>
                    'Mùa hè và dịp lễ thường rất đông khách. Nên kiểm tra tình trạng biển trước khi tắm.',

                'activities' =>
                    'Tắm biển, nghỉ dưỡng, đi dạo ven biển, thưởng thức hải sản, tham quan di tích, chụp ảnh.',

                'latitude' => 20.7130,
                'longitude' => 106.7880,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 4. KHU DI TÍCH CÔN SƠN – KIẾP BẠC
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Khu di tích Côn Sơn – Kiếp Bạc',
                'slug' => 'con-son-kiep-bac',

                'short_description' =>
                    'Quần thể di tích lịch sử và tâm linh nổi tiếng gắn với Trần Hưng Đạo, Nguyễn Trãi và Thiền phái Trúc Lâm.',

                'description' =>
                    'Côn Sơn – Kiếp Bạc là một trong những khu di sản văn hóa và lịch sử đặc biệt của Hải Phòng mới. Quần thể gắn với nhiều danh nhân như Trần Hưng Đạo, Nguyễn Trãi, Huyền Quang và các dấu tích của Thiền phái Trúc Lâm.',

                'cover_image' =>
                    'images/places/con-son-kiep-bac/cover.jpg',

                'address' =>
                    'Khu vực Chí Linh, TP Hải Phòng',

                'ticket_price' => 0,

                'open_time' => '07:00:00',
                'close_time' => '18:00:00',

                'visit_duration_min' => 240,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 1 - Tháng 3, Tháng 8 - Tháng 10',

                'notes' =>
                    'Mùa lễ hội thường rất đông khách. Nên mặc trang phục lịch sự và dành thời gian tham quan cả khu Côn Sơn lẫn Kiếp Bạc.',

                'activities' =>
                    'Dâng hương, tham quan chùa và đền, tìm hiểu lịch sử, leo núi, chụp ảnh, tham gia lễ hội.',

                'latitude' => 21.1540,
                'longitude' => 106.3850,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 5. ĐẢO HÒN DẤU
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Đảo Hòn Dấu',
                'slug' => 'dao-hon-dau',

                'short_description' =>
                    'Hòn đảo nhỏ nổi tiếng gần Đồ Sơn với rừng cây cổ thụ, ngọn hải đăng và không gian thiên nhiên yên bình.',

                'description' =>
                    'Đảo Hòn Dấu là điểm tham quan nổi tiếng ở khu vực Đồ Sơn. Hòn đảo được bao phủ bởi rừng cây xanh, có nhiều cây cổ thụ và ngọn hải đăng lâu đời, tạo nên không gian vừa mang giá trị tự nhiên vừa có nét lịch sử đặc trưng.',

                'cover_image' =>
                    'images/places/dao-hon-dau/cover.jpg',

                'address' =>
                    'Phường Đồ Sơn, TP Hải Phòng',

                'ticket_price' => 0,

                'open_time' => '07:00:00',
                'close_time' => '17:30:00',

                'visit_duration_min' => 150,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 3 - Tháng 10',

                'notes' =>
                    'Cần di chuyển bằng tàu hoặc phương tiện đường thủy ra đảo. Nên kiểm tra thời tiết và lịch tàu trước khi đi.',

                'activities' =>
                    'Đi tàu, tham quan hải đăng, đi bộ dưới rừng, ngắm biển, chụp ảnh, tham quan đền Nam Hải Thần Vương.',

                'latitude' => 20.6680,
                'longitude' => 106.8130,

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