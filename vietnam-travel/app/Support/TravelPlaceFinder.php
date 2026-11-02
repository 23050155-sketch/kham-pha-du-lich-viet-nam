<?php

namespace App\Support;

use App\Models\Place;
use Illuminate\Support\Collection;

class TravelPlaceFinder
{
    public static function search(
        ?int $month = null,
        array $categorySlugs = [],
        ?float $maxTicketPrice = null,
        ?int $provinceId = null,
        int $limit = 10,
        array $excludedCategorySlugs = []
    ): Collection {
        $query = Place::query()
            ->with([
                'province:id,name',
                'categories:id,name,slug',
            ])
            ->where('status', 'active');

        // Lọc theo tỉnh/thành nếu có.
        if ($provinceId !== null) {
            $query->where('province_id', $provinceId);
        }

        // Lọc theo danh mục sở thích.
        if (!empty($categorySlugs)) {
            $query->whereHas('categories', function ($categoryQuery) use ($categorySlugs) {
                $categoryQuery->whereIn('slug', $categorySlugs);
            });
        }


        // Loại bỏ địa điểm thuộc các danh mục người dùng không muốn.
        if (!empty($excludedCategorySlugs)) {
            $query->whereDoesntHave(
                'categories',
                function ($categoryQuery) use ($excludedCategorySlugs) {
                    $categoryQuery->whereIn('slug', $excludedCategorySlugs);
                }
            );
        }


        // Lọc theo giá vé tham quan.
        if ($maxTicketPrice !== null) {
            $query->whereNotNull('ticket_price')
                ->where('ticket_price', '<=', $maxTicketPrice);
        }

        // Lấy dữ liệu phù hợp từ MySQL.
        $places = $query->get();

        // best_months đang lưu dạng văn bản nên lọc bằng parser.
        if ($month !== null) {
            $places = $places->filter(function ($place) use ($month) {
                return TravelMonthParser::matches(
                    $place->best_months,
                    $month
                );
            });
        }

        // Ưu tiên giá vé thấp.
        return $places
            ->sortBy(function ($place) {
                return $place->ticket_price === null
                    ? PHP_FLOAT_MAX
                    : (float) $place->ticket_price;
            })
            ->take(max(1, min($limit, 30)))
            ->values();
    }
}