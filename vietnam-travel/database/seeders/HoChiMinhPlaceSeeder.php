<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Place;

class HoChiMinhPlaceSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tìm TP. Hồ Chí Minh
        |--------------------------------------------------------------------------
        */

        $province = Province::where(
                'name',
                'like',
                '%Hồ Chí Minh%'
            )
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Danh sách địa điểm
        |--------------------------------------------------------------------------
        */

        $places = [

            // ==========================================
            // 1. ĐỊA ĐẠO CỦ CHI
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Địa đạo Củ Chi',
                'slug' => 'dia-dao-cu-chi',

                'short_description' =>
                    'Khu di tích lịch sử nổi tiếng với hệ thống đường hầm ngầm độc đáo, gắn với các cuộc kháng chiến của Việt Nam.',

                'description' =>
                    'Địa đạo Củ Chi là một trong những di tích lịch sử nổi tiếng nhất của TP. Hồ Chí Minh. Hệ thống địa đạo được xây dựng dưới lòng đất với nhiều đường hầm, phòng ở, kho chứa, bếp và công trình phục vụ chiến đấu, giúp du khách hiểu thêm về cuộc sống và hoạt động của quân dân Củ Chi trong thời chiến.',

                'cover_image' =>
                    'images/places/dia-dao-cu-chi/cover.jpg',

                'address' =>
                    'Khu vực Củ Chi, TP. Hồ Chí Minh',

                'ticket_price' => 35000,

                'open_time' => '07:00:00',
                'close_time' => '17:00:00',

                'visit_duration_min' => 180,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 12 - Tháng 4',

                'notes' =>
                    'Một số đoạn địa đạo hẹp và tối, người có vấn đề về hô hấp hoặc sợ không gian kín nên cân nhắc trước khi xuống hầm.',

                'activities' =>
                    'Khám phá địa đạo, tìm hiểu lịch sử, tham quan khu tái hiện chiến tranh, xem hiện vật, nghe thuyết minh.',

                'latitude' => 11.1414,
                'longitude' => 106.4620,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 2. DINH ĐỘC LẬP
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Dinh Độc Lập',
                'slug' => 'dinh-doc-lap',

                'short_description' =>
                    'Công trình lịch sử nổi tiếng giữa trung tâm TP. Hồ Chí Minh, gắn với nhiều sự kiện quan trọng của lịch sử Việt Nam hiện đại.',

                'description' =>
                    'Dinh Độc Lập là một trong những công trình lịch sử tiêu biểu của TP. Hồ Chí Minh. Công trình có kiến trúc đặc sắc, từng là nơi làm việc của chính quyền Việt Nam Cộng hòa và gắn với sự kiện ngày 30 tháng 4 năm 1975.',

                'cover_image' =>
                    'images/places/dinh-doc-lap/cover.jpg',

                'address' =>
                    '135 Nam Kỳ Khởi Nghĩa, TP. Hồ Chí Minh',

                'ticket_price' => 40000,

                'open_time' => '08:00:00',
                'close_time' => '16:30:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Quanh năm',

                'notes' =>
                    'Nên dành khoảng 1–2 giờ để tham quan các phòng làm việc, hầm chỉ huy và khu trưng bày.',

                'activities' =>
                    'Tham quan kiến trúc, tìm hiểu lịch sử, xem hiện vật, tham quan hầm chỉ huy, chụp ảnh.',

                'latitude' => 10.7770,
                'longitude' => 106.6953,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 3. CHỢ BẾN THÀNH
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Chợ Bến Thành',
                'slug' => 'cho-ben-thanh',

                'short_description' =>
                    'Khu chợ lâu đời và là một trong những biểu tượng quen thuộc nhất của trung tâm TP. Hồ Chí Minh.',

                'description' =>
                    'Chợ Bến Thành là một trong những địa điểm nổi tiếng và dễ nhận diện nhất của TP. Hồ Chí Minh. Chợ tập trung nhiều gian hàng bán đặc sản, thực phẩm, quần áo, đồ thủ công mỹ nghệ và quà lưu niệm, đồng thời là nơi du khách có thể trải nghiệm nhịp sống và ẩm thực đặc trưng của thành phố.',

                'cover_image' =>
                    'images/places/cho-ben-thanh/cover.jpg',

                'address' =>
                    'Phường Bến Thành, TP. Hồ Chí Minh',

                'ticket_price' => 0,

                'open_time' => '06:00:00',
                'close_time' => '19:00:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Quanh năm',

                'notes' =>
                    'Nên hỏi giá trước khi mua hàng và chú ý bảo quản tư trang tại khu vực đông người.',

                'activities' =>
                    'Mua sắm, thưởng thức ẩm thực, mua quà lưu niệm, chụp ảnh, khám phá văn hóa địa phương.',

                'latitude' => 10.7725,
                'longitude' => 106.6980,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 4. BIỂN VŨNG TÀU
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Biển Vũng Tàu',
                'slug' => 'bien-vung-tau',

                'short_description' =>
                    'Khu du lịch biển nổi tiếng với nhiều bãi tắm đẹp như Bãi Trước, Bãi Sau và cảnh quan ven biển đặc trưng.',

                'description' =>
                    'Biển Vũng Tàu là một trong những điểm nghỉ dưỡng biển nổi tiếng của TP. Hồ Chí Minh mới. Khu vực có nhiều bãi biển như Bãi Trước, Bãi Sau, Bãi Dứa và Bãi Dâu, phù hợp cho tắm biển, nghỉ dưỡng, vui chơi và thưởng thức hải sản.',

                'cover_image' =>
                    'images/places/bien-vung-tau/cover.jpg',

                'address' =>
                    'Phường Vũng Tàu, TP. Hồ Chí Minh',

                'ticket_price' => 0,

                'open_time' => '05:00:00',
                'close_time' => '22:00:00',

                'visit_duration_min' => 300,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 12 - Tháng 4',

                'notes' =>
                    'Nên kiểm tra thời tiết và tình trạng sóng trước khi tắm. Không bơi xa bờ hoặc tại khu vực có cảnh báo nguy hiểm.',

                'activities' =>
                    'Tắm biển, đi dạo, ngắm bình minh, chụp ảnh, thưởng thức hải sản, tham gia thể thao biển.',

                'latitude' => 10.3459,
                'longitude' => 107.0843,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // ==========================================
            // 5. CÔN ĐẢO
            // ==========================================
            [
                'province_id' => $province->id,

                'name' => 'Côn Đảo',
                'slug' => 'con-dao',

                'short_description' =>
                    'Quần đảo nổi tiếng với các di tích lịch sử, bãi biển hoang sơ, rừng nguyên sinh và hệ sinh thái biển phong phú.',

                'description' =>
                    'Côn Đảo là một trong những điểm du lịch biển đảo nổi bật của TP. Hồ Chí Minh mới. Nơi đây vừa có giá trị lịch sử với hệ thống nhà tù, Nghĩa trang Hàng Dương, vừa sở hữu nhiều bãi biển đẹp, rừng nguyên sinh và hệ sinh thái biển đa dạng thuộc Vườn quốc gia Côn Đảo.',

                'cover_image' =>
                    'images/places/con-dao/cover.jpg',

                'address' =>
                    'Đặc khu Côn Đảo, TP. Hồ Chí Minh',

                'ticket_price' => 0,

                'open_time' => '00:00:00',
                'close_time' => null,

                'visit_duration_min' => 1440,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 3 - Tháng 9',

                'notes' =>
                    'Nên dành ít nhất 2–3 ngày để tham quan đầy đủ các điểm lịch sử và sinh thái. Một số tuyến Vườn quốc gia cần đăng ký hoặc mua vé riêng.',

                'activities' =>
                    'Tham quan di tích lịch sử, viếng Nghĩa trang Hàng Dương, tắm biển, lặn ngắm san hô, trekking, xem rùa biển, khám phá đảo.',

                'latitude' => 8.6833,
                'longitude' => 106.6083,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Thêm / cập nhật địa điểm
        |--------------------------------------------------------------------------
        */

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