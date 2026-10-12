<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Place;
use App\Models\Category;

class TayNinhPlaceSeeder extends Seeder
{
    public function run(): void
    {
        $province = Province::where('slug', 'tay-ninh')
            ->firstOrFail();

        $places = [

            // =========================================
            // 1. NÚI BÀ ĐEN
            // =========================================
            [
                'data' => [
                    'province_id' => $province->id,

                    'name' => 'Núi Bà Đen',
                    'slug' => 'nui-ba-den',

                    'short_description' =>
                        'Ngọn núi nổi tiếng của Tây Ninh, thu hút du khách bởi cảnh quan thiên nhiên, hệ thống cáp treo và các công trình tâm linh.',

                    'description' =>
                        'Núi Bà Đen là một trong những địa điểm du lịch nổi bật của Tây Ninh. Khu vực này kết hợp cảnh quan núi non, không gian tâm linh và các điểm ngắm cảnh trên cao, phù hợp với cả tham quan, hành hương và trải nghiệm thiên nhiên.',

                    'cover_image' =>
                        'images/places/nui-ba-den/cover.jpg',

                    'address' =>
                        'Khu vực Núi Bà Đen, Tây Ninh',

                    'ticket_price' => 300000,

                    'open_time' => '06:00:00',
                    'close_time' => '22:00:00',

                    'visit_duration_min' => 240,

                    'best_time' => 'morning',

                    'activities' =>
                        'Đi cáp treo, tham quan các công trình tâm linh, ngắm cảnh từ trên cao, chụp ảnh và khám phá không gian núi.',

                    'notes' =>
                        'Nên đi từ buổi sáng, mang giày dễ di chuyển và kiểm tra thời tiết trước chuyến đi.',

                    'latitude' => null,
                    'longitude' => null,

                    'view_count' => 0,
                    'is_featured' => true,
                    'status' => 'active',
                ],

                'categories' => [
                    'Núi',
                    'Thiên nhiên',
                    'Tâm linh',
                ],
            ],


            // =========================================
            // 2. TÒA THÁNH CAO ĐÀI TÂY NINH
            // =========================================
            [
                'data' => [
                    'province_id' => $province->id,

                    'name' => 'Tòa Thánh Cao Đài Tây Ninh',
                    'slug' => 'toa-thanh-cao-dai-tay-ninh',

                    'short_description' =>
                        'Công trình tôn giáo nổi bật với kiến trúc đặc sắc và là một trong những biểu tượng văn hóa của Tây Ninh.',

                    'description' =>
                        'Tòa Thánh Cao Đài Tây Ninh là công trình kiến trúc tôn giáo nổi tiếng, gây ấn tượng bởi màu sắc, họa tiết trang trí và không gian rộng lớn. Đây là địa điểm phù hợp để tìm hiểu văn hóa, kiến trúc và đời sống tín ngưỡng tại Tây Ninh.',

                    'cover_image' =>
                        'images/places/toa-thanh-cao-dai-tay-ninh/cover.jpg',

                    'address' =>
                        'Tây Ninh',

                    'ticket_price' => 0,

                    'open_time' => '06:00:00',
                    'close_time' => '18:00:00',

                    'visit_duration_min' => 120,

                    'best_time' => 'morning',

                    'activities' =>
                        'Tham quan kiến trúc, tìm hiểu văn hóa Cao Đài, chụp ảnh và tham quan khuôn viên.',

                    'notes' =>
                        'Đây là địa điểm tôn giáo nên cần mặc trang phục lịch sự và tuân thủ quy định khi tham quan.',

                    'latitude' => null,
                    'longitude' => null,

                    'view_count' => 0,
                    'is_featured' => true,
                    'status' => 'active',
                ],

                'categories' => [
                    'Văn hóa',
                    'Tâm linh',
                ],
            ],


            // =========================================
            // 3. HỒ DẦU TIẾNG
            // =========================================
            [
                'data' => [
                    'province_id' => $province->id,

                    'name' => 'Hồ Dầu Tiếng',
                    'slug' => 'ho-dau-tieng',

                    'short_description' =>
                        'Không gian hồ rộng lớn với phong cảnh yên bình, thích hợp ngắm cảnh, cắm trại và chụp ảnh.',

                    'description' =>
                        'Hồ Dầu Tiếng hấp dẫn du khách nhờ mặt hồ rộng, phong cảnh thoáng đãng và không khí yên bình. Đây là điểm đến phù hợp cho những chuyến đi thư giãn, ngắm cảnh và trải nghiệm hoạt động ngoài trời.',

                    'cover_image' =>
                        'images/places/ho-dau-tieng/cover.jpg',

                    'address' =>
                        'Khu vực Hồ Dầu Tiếng, Tây Ninh',

                    'ticket_price' => 0,

                    'open_time' => '05:00:00',
                    'close_time' => '19:00:00',

                    'visit_duration_min' => 180,

                    'best_time' => 'afternoon',

                    'activities' =>
                        'Ngắm cảnh, chụp ảnh, dã ngoại, cắm trại và thư giãn bên hồ.',

                    'notes' =>
                        'Nếu cắm trại nên chuẩn bị đầy đủ nước uống, đồ dùng cá nhân và giữ vệ sinh khu vực.',

                    'latitude' => null,
                    'longitude' => null,

                    'view_count' => 0,
                    'is_featured' => true,
                    'status' => 'active',
                ],

                'categories' => [
                    'Thiên nhiên',
                ],
            ],


            // =========================================
            // 4. MA THIÊN LÃNH
            // =========================================
            [
                'data' => [
                    'province_id' => $province->id,

                    'name' => 'Ma Thiên Lãnh',
                    'slug' => 'ma-thien-lanh',

                    'short_description' =>
                        'Khu vực thiên nhiên xanh mát nằm giữa các ngọn núi, phù hợp với hoạt động khám phá và trekking.',

                    'description' =>
                        'Ma Thiên Lãnh là điểm đến dành cho du khách yêu thích thiên nhiên và những cung đường khám phá. Khu vực mang vẻ đẹp hoang sơ với địa hình núi, cây xanh và nhiều góc cảnh quan phù hợp cho các chuyến đi trải nghiệm.',

                    'cover_image' =>
                        'images/places/ma-thien-lanh/cover.jpg',

                    'address' =>
                        'Khu vực Ma Thiên Lãnh, Tây Ninh',

                    'ticket_price' => 0,

                    'open_time' => '06:00:00',
                    'close_time' => '17:30:00',

                    'visit_duration_min' => 240,

                    'best_time' => 'morning',

                    'activities' =>
                        'Trekking, khám phá thiên nhiên, chụp ảnh và trải nghiệm không gian núi rừng.',

                    'notes' =>
                        'Nên đi theo nhóm, mang giày phù hợp, nước uống và tránh trekking khi thời tiết xấu.',

                    'latitude' => null,
                    'longitude' => null,

                    'view_count' => 0,
                    'is_featured' => false,
                    'status' => 'active',
                ],

                'categories' => [
                    'Núi',
                    'Thiên nhiên',
                ],
            ],


            // =========================================
            // 5. VƯỜN QUỐC GIA LÒ GÒ - XA MÁT
            // =========================================
            [
                'data' => [
                    'province_id' => $province->id,

                    'name' => 'Vườn quốc gia Lò Gò - Xa Mát',
                    'slug' => 'vuon-quoc-gia-lo-go-xa-mat',

                    'short_description' =>
                        'Khu bảo tồn thiên nhiên với hệ sinh thái đa dạng, phù hợp cho hoạt động khám phá và du lịch sinh thái.',

                    'description' =>
                        'Vườn quốc gia Lò Gò - Xa Mát là điểm đến dành cho du khách quan tâm đến thiên nhiên và hệ sinh thái. Không gian rừng tạo điều kiện cho các hoạt động tham quan, tìm hiểu môi trường và trải nghiệm du lịch sinh thái.',

                    'cover_image' =>
                        'images/places/vuon-quoc-gia-lo-go-xa-mat/cover.jpg',

                    'address' =>
                        'Tây Ninh',

                    'ticket_price' => 50000,

                    'open_time' => '07:00:00',
                    'close_time' => '17:00:00',

                    'visit_duration_min' => 180,

                    'best_time' => 'morning',

                    'activities' =>
                        'Khám phá hệ sinh thái rừng, quan sát thiên nhiên, chụp ảnh và trải nghiệm du lịch sinh thái.',

                    'notes' =>
                        'Nên chuẩn bị trang phục dài, thuốc chống côn trùng, nước uống và tuân thủ quy định bảo vệ môi trường.',

                    'latitude' => null,
                    'longitude' => null,

                    'view_count' => 0,
                    'is_featured' => false,
                    'status' => 'active',
                ],

                'categories' => [
                    'Thiên nhiên',
                ],
            ],
        ];


        foreach ($places as $placeData) {

            $place = Place::updateOrCreate(
                [
                    'slug' => $placeData['data']['slug'],
                ],
                $placeData['data']
            );


            $categoryIds = Category::whereIn(
                'name',
                $placeData['categories']
            )
                ->pluck('id');


            $place->categories()->sync($categoryIds);
        }
    }
}