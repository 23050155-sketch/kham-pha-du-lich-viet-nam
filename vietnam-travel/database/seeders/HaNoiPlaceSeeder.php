<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;
use App\Models\Place;

class HaNoiPlaceSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Tìm tỉnh/thành Hà Nội
        |--------------------------------------------------------------------------
        */

        $province = Province::where('name', 'Hà Nội')
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Danh sách địa điểm Hà Nội
        |--------------------------------------------------------------------------
        */

        $places = [

            // =====================================================
            // 1. LĂNG CHỦ TỊCH HỒ CHÍ MINH
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Lăng Chủ tịch Hồ Chí Minh',
                'slug' => 'lang-chu-tich-ho-chi-minh',

                'short_description' =>
                    'Công trình lịch sử quan trọng tại Quảng trường Ba Đình, nơi gìn giữ thi hài Chủ tịch Hồ Chí Minh.',

                'description' =>
                    'Lăng Chủ tịch Hồ Chí Minh là một trong những địa điểm lịch sử và văn hóa quan trọng nhất của Hà Nội. Công trình nằm tại Quảng trường Ba Đình và là nơi nhiều du khách đến viếng Chủ tịch Hồ Chí Minh, đồng thời tham quan khu di tích lịch sử xung quanh.',

                'cover_image' =>
                    'images/places/lang-chu-tich-ho-chi-minh/cover.jpg',

                'address' =>
                    'Quảng trường Ba Đình, Hà Nội',

                'ticket_price' => 0,

                'open_time' => '07:30:00',
                'close_time' => '11:00:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 10 - Tháng 4',

                'notes' =>
                    'Giờ viếng thay đổi theo mùa và từng thời điểm. Nên mặc trang phục lịch sự và tuân thủ hướng dẫn tại khu vực Lăng.',

                'activities' =>
                    'Viếng Lăng Bác, tham quan Quảng trường Ba Đình, tham quan khu di tích Chủ tịch Hồ Chí Minh, chụp ảnh bên ngoài.',

                'latitude' => 21.0368,
                'longitude' => 105.8346,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // =====================================================
            // 2. HỒ HOÀN KIẾM
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Hồ Hoàn Kiếm',
                'slug' => 'ho-hoan-kiem',

                'short_description' =>
                    'Hồ nước nổi tiếng nằm giữa trung tâm Hà Nội, gắn với Tháp Rùa, cầu Thê Húc và đền Ngọc Sơn.',

                'description' =>
                    'Hồ Hoàn Kiếm là một trong những biểu tượng đặc trưng của Thủ đô Hà Nội. Không gian quanh hồ kết hợp giữa cảnh quan thiên nhiên, công trình lịch sử và khu phố trung tâm, thu hút đông người dân và du khách đến tham quan, đi bộ và khám phá văn hóa Hà Nội.',

                'cover_image' =>
                    'images/places/ho-hoan-kiem/cover.jpg',

                'address' =>
                    'Khu vực Hồ Hoàn Kiếm, phường Hoàn Kiếm, Hà Nội',

                'ticket_price' => 0,

                'open_time' => '00:00:00',
                'close_time' => null,

                'visit_duration_min' => 120,

                'best_time' => 'evening',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Cuối tuần một số tuyến đường quanh hồ tổ chức không gian đi bộ.',

                'activities' =>
                    'Đi bộ, ngắm cảnh, chụp ảnh, tham quan cầu Thê Húc, đền Ngọc Sơn, khám phá khu phố cổ.',

                'latitude' => 21.0287,
                'longitude' => 105.8524,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // =====================================================
            // 3. VĂN MIẾU - QUỐC TỬ GIÁM
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Văn Miếu – Quốc Tử Giám',
                'slug' => 'van-mieu-quoc-tu-giam',

                'short_description' =>
                    'Quần thể di tích lịch sử nổi tiếng, biểu tượng của truyền thống hiếu học và giáo dục Việt Nam.',

                'description' =>
                    'Văn Miếu – Quốc Tử Giám là quần thể di tích văn hóa và giáo dục đặc biệt của Hà Nội. Nơi đây gắn liền với lịch sử khoa cử và truyền thống hiếu học của dân tộc, nổi bật với Khuê Văn Các, bia tiến sĩ và không gian kiến trúc cổ.',

                'cover_image' =>
                    'images/places/van-mieu-quoc-tu-giam/cover.jpg',

                'address' =>
                    '58 Quốc Tử Giám, Hà Nội',

                'ticket_price' => 70000,

                'open_time' => '08:00:00',
                'close_time' => '17:00:00',

                'visit_duration_min' => 120,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Giá vé và giờ mở cửa nên cập nhật từ đơn vị quản lý trước khi sử dụng trong hệ thống chính thức.',

                'activities' =>
                    'Tham quan kiến trúc, tìm hiểu lịch sử giáo dục, xem bia tiến sĩ, chụp ảnh.',

                'latitude' => 21.0276,
                'longitude' => 105.8355,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // =====================================================
            // 4. HOÀNG THÀNH THĂNG LONG
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Hoàng thành Thăng Long',
                'slug' => 'hoang-thanh-thang-long',

                'short_description' =>
                    'Quần thể di sản lịch sử đặc biệt gắn với hơn một nghìn năm hình thành và phát triển của Thăng Long – Hà Nội.',

                'description' =>
                    'Hoàng thành Thăng Long là trung tâm quyền lực quan trọng của nhiều triều đại trong lịch sử Việt Nam. Khu di tích lưu giữ nhiều dấu tích kiến trúc, khảo cổ và lịch sử, phản ánh quá trình phát triển lâu dài của kinh đô Thăng Long.',

                'cover_image' =>
                    'images/places/hoang-thanh-thang-long/cover.jpg',

                'address' =>
                    '19C Hoàng Diệu, Hà Nội',

                'ticket_price' => 70000,

                'open_time' => '08:00:00',
                'close_time' => '17:00:00',

                'visit_duration_min' => 180,

                'best_time' => 'morning',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Có thể dành nhiều thời gian hơn nếu tham quan cả khu khảo cổ 18 Hoàng Diệu. Một số chương trình tham quan ban đêm có lịch riêng.',

                'activities' =>
                    'Tham quan di tích, tìm hiểu lịch sử, khảo cổ, chụp ảnh, tham gia tour đêm.',

                'latitude' => 21.0353,
                'longitude' => 105.8402,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // =====================================================
            // 5. CHÙA TRẤN QUỐC
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Chùa Trấn Quốc',
                'slug' => 'chua-tran-quoc',

                'short_description' =>
                    'Một trong những ngôi chùa cổ nổi tiếng nhất Hà Nội, nằm trên một đảo nhỏ bên Hồ Tây.',

                'description' =>
                    'Chùa Trấn Quốc là ngôi chùa cổ có lịch sử lâu đời tại Hà Nội. Chùa tọa lạc bên Hồ Tây, nổi bật với kiến trúc Phật giáo, bảo tháp và không gian yên tĩnh giữa khu vực hồ rộng lớn.',

                'cover_image' =>
                    'images/places/chua-tran-quoc/cover.jpg',

                'address' =>
                    'Đường Thanh Niên, Hà Nội',

                'ticket_price' => 0,

                'open_time' => '07:30:00',
                'close_time' => '17:30:00',

                'visit_duration_min' => 60,

                'best_time' => 'morning',

                'best_months' =>
                    'Quanh năm',

                'notes' =>
                    'Nên mặc trang phục lịch sự, giữ trật tự khi tham quan khu vực thờ tự.',

                'activities' =>
                    'Tham quan chùa, tìm hiểu kiến trúc Phật giáo, ngắm Hồ Tây, chụp ảnh.',

                'latitude' => 21.0479,
                'longitude' => 105.8368,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // =====================================================
            // 6. PHỐ CỔ HÀ NỘI
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Phố cổ Hà Nội',
                'slug' => 'pho-co-ha-noi',

                'short_description' =>
                    'Khu phố lịch sử nổi tiếng với những con phố nghề, kiến trúc cổ, ẩm thực và nhịp sống đặc trưng của Hà Nội.',

                'description' =>
                    'Phố cổ Hà Nội là khu vực tập trung nhiều tuyến phố có lịch sử lâu đời, gắn với các nghề thủ công và hoạt động thương mại truyền thống. Đây là nơi phù hợp để khám phá kiến trúc, ẩm thực, văn hóa và đời sống đô thị đặc trưng của Hà Nội.',

                'cover_image' =>
                    'images/places/pho-co-ha-noi/cover.jpg',

                'address' =>
                    'Khu phố cổ, phường Hoàn Kiếm, Hà Nội',

                'ticket_price' => 0,

                'open_time' => '00:00:00',
                'close_time' => null,

                'visit_duration_min' => 240,

                'best_time' => 'evening',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Một số tuyến phố rất đông vào buổi tối và cuối tuần. Nên đi bộ để trải nghiệm thuận tiện hơn.',

                'activities' =>
                    'Đi bộ, ăn uống, mua sắm, chụp ảnh, khám phá kiến trúc và văn hóa phố cổ.',

                'latitude' => 21.0340,
                'longitude' => 105.8500,

                'view_count' => 0,

                'is_featured' => true,

                'status' => 'active',
            ],


            // =====================================================
            // 7. HỒ TÂY
            // =====================================================
            [
                'province_id' => $province->id,

                'name' => 'Hồ Tây',
                'slug' => 'ho-tay',

                'short_description' =>
                    'Hồ nước lớn nổi tiếng của Hà Nội, thích hợp để ngắm cảnh, đạp xe và ngắm hoàng hôn.',

                'description' =>
                    'Hồ Tây là một trong những không gian cảnh quan nổi bật của Hà Nội. Khu vực quanh hồ có nhiều di tích, chùa cổ, nhà hàng và địa điểm vui chơi, đặc biệt được yêu thích vào buổi chiều và tối.',

                'cover_image' =>
                    'images/places/ho-tay/cover.jpg',

                'address' =>
                    'Khu vực Hồ Tây, Hà Nội',

                'ticket_price' => 0,

                'open_time' => '00:00:00',
                'close_time' => null,

                'visit_duration_min' => 180,

                'best_time' => 'evening',

                'best_months' =>
                    'Tháng 9 - Tháng 4',

                'notes' =>
                    'Khu vực quanh hồ khá rộng nên có thể di chuyển bằng xe đạp hoặc xe máy.',

                'activities' =>
                    'Đi bộ, đạp xe, ngắm hoàng hôn, chụp ảnh, tham quan các di tích quanh hồ.',

                'latitude' => 21.0583,
                'longitude' => 105.8182,

                'view_count' => 0,

                'is_featured' => false,

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