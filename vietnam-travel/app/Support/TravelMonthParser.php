<?php

namespace App\Support;

class TravelMonthParser
{
    public static function parse(?string $bestMonths): array
    {
        if ($bestMonths === null || trim($bestMonths) === '') {
            return [];
        }

        $value = mb_strtolower(trim($bestMonths), 'UTF-8');

        if (str_contains($value, 'quanh năm')) {
            return range(1, 12);
        }

        $months = [];

        // Ví dụ: "Tháng 5 - Tháng 6, Tháng 9 - Tháng 10"
        preg_match_all(
            '/tháng\s*(\d{1,2})\s*[-–—]\s*tháng\s*(\d{1,2})/iu',
            $value,
            $ranges,
            PREG_SET_ORDER
        );

        foreach ($ranges as $range) {
            $start = (int) $range[1];
            $end = (int) $range[2];

            if ($start < 1 || $start > 12 || $end < 1 || $end > 12) {
                continue;
            }

            $month = $start;

            while (true) {
                $months[] = $month;

                if ($month === $end) {
                    break;
                }

                $month = $month === 12 ? 1 : $month + 1;
            }
        }

        // Xử lý các tháng riêng lẻ, ví dụ "Tháng 3, Tháng 6".
        preg_match_all('/tháng\s*(\d{1,2})/iu', $value, $matches);

        foreach ($matches[1] as $number) {
            $month = (int) $number;

            if ($month >= 1 && $month <= 12) {
                $months[] = $month;
            }
        }

        $months = array_values(array_unique($months));
        sort($months);

        return $months;
    }

    public static function matches(?string $bestMonths, int $month): bool
    {
        if ($month < 1 || $month > 12) {
            return false;
        }

        return in_array($month, self::parse($bestMonths), true);
    }
}