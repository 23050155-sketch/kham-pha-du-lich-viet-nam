<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\Itinerary;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\ItineraryItem;
use Carbon\Carbon;

class ItineraryController extends Controller
{
    public function index()
    {
        $itineraries = Itinerary::with('province')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view(
            'itineraries.index',
            compact('itineraries')
        );
    }


    public function create()
    {
        $provinces = Province::orderBy('name')->get();

        return view(
            'itineraries.create',
            compact('provinces')
        );
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'province_id' => [
                'required',
                'exists:provinces,id',
            ],

            'total_days' => [
                'required',
                'integer',
                'min:1',
                'max:30',
            ],

            'budget' => [
                'nullable',
                'numeric',
                'min:0',
            ],
        ]);

        $province = Province::findOrFail(
            $validated['province_id']
        );

        $totalDays = $validated['total_days'];

        $totalNights = max(0, $totalDays - 1);

        $title = $province->name
            . ' '
            . $totalDays
            . ' ngày '
            . $totalNights
            . ' đêm';

        $itinerary = Itinerary::create([
            'user_id' => auth()->id(),

            'province_id' => $province->id,

            'title' => $title,

            'total_days' => $totalDays,

            'total_nights' => $totalNights,

            'budget' => $validated['budget'] ?? null,
        ]);


        $places = Place::where('province_id', $province->id)
            ->where('status', 'active')
            ->withAvg('ratings', 'rating')
            ->orderByDesc('ratings_avg_rating')
            ->get();

        // Tối đa 4 địa điểm mỗi ngày
        $placesPerDay = 4;

        // Số địa điểm tối đa cần có trong lịch trình
        $maxPlaces = $totalDays * $placesPerDay;

        // Không take() ngay.
        // Giữ toàn bộ địa điểm làm danh sách ứng viên,
        // nếu một địa điểm không phù hợp thì còn địa điểm khác thay thế.
        $selectedPlaces = $places;


        // Sắp xếp địa điểm theo thời điểm tham quan phù hợp
        $selectedPlaces = $selectedPlaces
            ->sortBy(function ($place) {

                return match ($place->best_time) {
                    'morning' => 1,
                    'any' => 2,
                    'afternoon' => 3,
                    'evening' => 4,
                    default => 2,
                };

            })
            ->values();


        // ==========================================
        // THÔNG TIN CHUNG
        // ==========================================

        // Ngân sách người dùng nhập
        $budget = $validated['budget'] ?? null;

        // Tổng tiền vé đã sử dụng
        $totalTicketCost = 0;

        // Tổng số địa điểm đã thêm
        $totalPlacesAdded = 0;

        // Danh sách ID địa điểm đã sử dụng
        $usedPlaceIds = [];


        // ==========================================
        // DUYỆT TỪNG NGÀY
        // ==========================================

        for ($day = 1; $day <= $totalDays; $day++) {

            // Mỗi ngày bắt đầu lúc 08:00
            $currentTime = Carbon::createFromTime(8, 0);

            // Số địa điểm của ngày hiện tại
            $placeCountInDay = 0;

            // Thứ tự địa điểm trong ngày
            $sortOrder = 1;


            // ======================================
            // THỬ CÁC ĐỊA ĐIỂM CHƯA ĐƯỢC SỬ DỤNG
            // ======================================

            foreach ($selectedPlaces as $place) {

                // Đủ 4 địa điểm trong ngày thì dừng ngày này
                if ($placeCountInDay >= $placesPerDay) {
                    break;
                }

                // Đã đủ tổng số địa điểm cần thiết
                if ($totalPlacesAdded >= $maxPlaces) {
                    break;
                }

                // Địa điểm đã được dùng ở ngày trước
                if (in_array($place->id, $usedPlaceIds)) {
                    continue;
                }


                // ==================================
                // 1. KIỂM TRA NGÂN SÁCH
                // ==================================

                $ticketPrice = $place->ticket_price ?? 0;

                if ($budget !== null) {

                    if (($totalTicketCost + $ticketPrice) > $budget) {
                        continue;
                    }
                }


                // ==================================
                // 2. THỜI LƯỢNG THAM QUAN
                // ==================================

                $duration = $place->visit_duration_min ?? 120;


                // ==================================
                // 3. XÁC ĐỊNH GIỜ THEO BEST_TIME
                // ==================================

                if ($place->best_time === 'morning') {

                    $preferredTime = Carbon::createFromTime(8, 0);

                } elseif ($place->best_time === 'afternoon') {

                    $preferredTime = Carbon::createFromTime(13, 30);

                } elseif ($place->best_time === 'evening') {

                    $preferredTime = Carbon::createFromTime(18, 0);

                } else {

                    // best_time = any
                    $preferredTime = $currentTime->copy();
                }


                // Không quay ngược thời gian
                if ($preferredTime->greaterThan($currentTime)) {
                    $startTime = $preferredTime->copy();
                } else {
                    $startTime = $currentTime->copy();
                }


                // ==================================
                // 4. KIỂM TRA GIỜ MỞ CỬA
                // ==================================

                if ($place->open_time) {

                    $openTime = Carbon::createFromFormat(
                        'H:i:s',
                        $place->open_time
                    );

                    if ($openTime->greaterThan($startTime)) {
                        $startTime = $openTime->copy();
                    }
                }


                // ==================================
                // 5. TÍNH GIỜ KẾT THÚC
                // ==================================

                $endTime = $startTime
                    ->copy()
                    ->addMinutes($duration);


                // ==================================
                // 6. KIỂM TRA GIỜ ĐÓNG CỬA
                // ==================================

                if ($place->close_time) {

                    $closeTime = Carbon::createFromFormat(
                        'H:i:s',
                        $place->close_time
                    );

                    /*
                    * Không đủ thời gian trong ngày này
                    * → bỏ qua tạm thời.
                    *
                    * KHÔNG đánh dấu đã sử dụng,
                    * nên ngày tiếp theo sẽ thử lại.
                    */
                    if ($endTime->greaterThan($closeTime)) {
                        continue;
                    }
                }


                // ==================================
                // 7. ĐỊA ĐIỂM PHÙ HỢP → LƯU
                // ==================================

                ItineraryItem::create([
                    'itinerary_id' => $itinerary->id,

                    'place_id' => $place->id,

                    'day_number' => $day,

                    'start_time' => $startTime->format('H:i:s'),

                    'end_time' => $endTime->format('H:i:s'),

                    'sort_order' => $sortOrder,
                ]);


                // ==================================
                // 8. ĐÁNH DẤU ĐÃ SỬ DỤNG
                // ==================================

                $usedPlaceIds[] = $place->id;

                $totalPlacesAdded++;

                $totalTicketCost += $ticketPrice;

                $placeCountInDay++;

                $sortOrder++;


                // ==================================
                // 9. NGHỈ / DI CHUYỂN 30 PHÚT
                // ==================================

                $currentTime = $endTime
                    ->copy()
                    ->addMinutes(30);
            }


            // Không còn địa điểm nào để xếp
            if ($totalPlacesAdded >= $selectedPlaces->count()) {
                break;
            }

            // Đã đạt số lượng tối đa
            if ($totalPlacesAdded >= $maxPlaces) {
                break;
            }
        }


        return redirect()
            ->route('itineraries.show', $itinerary)
            ->with(
                'itinerary_success',
                'Lịch trình đã được tạo thành công.'
            );
    }



    public function show(Itinerary $itinerary)
    {
        // Chỉ chủ sở hữu mới được xem lịch trình
        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }

        $itinerary->load([
            'province',
            'items.place',
        ]);

        // Tính tổng tiền vé của các địa điểm
        // thực sự có trong lịch trình
        $totalTicketCost = $itinerary->items->sum(function ($item) {
            return $item->place->ticket_price ?? 0;
        });

        return view(
            'itineraries.show',
            compact(
                'itinerary',
                'totalTicketCost'
            )
        );
    }


    public function destroy(Itinerary $itinerary)
    {
        // Chỉ chủ sở hữu mới được xóa
        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }

        $itinerary->delete();

        return redirect()
            ->route('itineraries.index')
            ->with(
                'itinerary_success',
                'Lịch trình đã được xóa thành công.'
            );
    }


    public function edit(Itinerary $itinerary)
    {
        // Chỉ chủ sở hữu được chỉnh sửa
        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }

        $itinerary->load([
            'province',
            'items.place',
        ]);


        // ==========================================
        // LẤY CÁC ĐỊA ĐIỂM CHƯA CÓ TRONG LỊCH TRÌNH
        // ==========================================

        $usedPlaceIds = $itinerary->items
            ->pluck('place_id');


        $availablePlaces = Place::where(
                'province_id',
                $itinerary->province_id
            )
            ->where('status', 'active')
            ->whereNotIn(
                'id',
                $usedPlaceIds
            )
            ->orderBy('name')
            ->get();


        return view(
            'itineraries.edit',
            compact(
                'itinerary',
                'availablePlaces'
            )
        );
    }


    public function update(
        Request $request,
        Itinerary $itinerary
    ) {
        // Chỉ chủ sở hữu được chỉnh sửa
        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $itinerary->update([
            'title' => $validated['title'],
        ]);

        return redirect()
            ->route(
                'itineraries.edit',
                $itinerary
            )
            ->with(
                'itinerary_success',
                'Cập nhật lịch trình thành công.'
            );
    }


    public function updateItem(
        Request $request,
        ItineraryItem $item
    ) {
        // Lấy itinerary chứa địa điểm này
        $itinerary = $item->itinerary;

        // Chỉ chủ sở hữu lịch trình được chỉnh sửa
        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }


        // ==========================================
        // VALIDATE
        // ==========================================
        $validated = $request->validate([
            'day_number' => [
                'required',
                'integer',
                'min:1',
                'max:' . $itinerary->total_days,
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],
        ]);



        // ==========================================
        // KIỂM TRA GIỜ MỞ CỬA / ĐÓNG CỬA
        // ==========================================

        $place = $item->place;

        $startTime = Carbon::createFromFormat(
            'H:i',
            $validated['start_time']
        );

        $endTime = Carbon::createFromFormat(
            'H:i',
            $validated['end_time']
        );


        // Kiểm tra giờ mở cửa
        if ($place->open_time) {

            $openTime = Carbon::createFromFormat(
                'H:i:s',
                $place->open_time
            );

            if ($startTime->lessThan($openTime)) {

                return back()
                    ->withErrors([
                        'start_time' =>
                            $place->name
                            . ' mở cửa từ '
                            . $openTime->format('H:i')
                            . '.',
                    ])
                    ->withInput();
            }
        }


        // Kiểm tra giờ đóng cửa
        if ($place->close_time) {

            $closeTime = Carbon::createFromFormat(
                'H:i:s',
                $place->close_time
            );

            if ($endTime->greaterThan($closeTime)) {

                return back()
                    ->withErrors([
                        'end_time' =>
                            $place->name
                            . ' đóng cửa lúc '
                            . $closeTime->format('H:i')
                            . '.',
                    ])
                    ->withInput();
            }
        }



        // ==========================================
        // KIỂM TRA TRÙNG THỜI GIAN
        // ==========================================

        $hasConflict = ItineraryItem::where(
                'itinerary_id',
                $itinerary->id
            )
            // Chỉ kiểm tra trong ngày user đang chọn
            ->where(
                'day_number',
                $validated['day_number']
            )

            // Không so sánh với chính địa điểm đang sửa
            ->where(
                'id',
                '!=',
                $item->id
            )

            // Hai khoảng thời gian bị trùng khi:
            //
            // giờ bắt đầu mới < giờ kết thúc cũ
            // VÀ
            // giờ kết thúc mới > giờ bắt đầu cũ
            ->where(
                'start_time',
                '<',
                $validated['end_time']
            )
            ->where(
                'end_time',
                '>',
                $validated['start_time']
            )
            ->exists();


        if ($hasConflict) {

            return back()
                ->withErrors([
                    'time_conflict' =>
                        'Khoảng thời gian này bị trùng với một địa điểm khác trong Ngày '
                        . $validated['day_number']
                        . '.',
                ])
                ->withInput();
        }
    

        // ==========================================
        // CẬP NHẬT
        // ==========================================
        $item->update([
            'day_number' => $validated['day_number'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        
        $item->update([
            'day_number' => $validated['day_number'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
        ]);

        // Sắp xếp lại thứ tự theo giờ
        $this->reorderItineraryItems($itinerary);


        return redirect()
            ->route(
                'itineraries.edit',
                $itinerary
            )
            ->with(
                'itinerary_success',
                'Đã cập nhật địa điểm trong lịch trình.'
            );
    }


    public function destroyItem(ItineraryItem $item)
    {
        // Lấy lịch trình chứa địa điểm
        $itinerary = $item->itinerary;

        // Chỉ chủ sở hữu lịch trình mới được xóa
        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }

        // Xóa địa điểm khỏi lịch trình
        $item->delete();


        // Sắp xếp lại thứ tự
        $this->reorderItineraryItems($itinerary);


        return redirect()
            ->route(
                'itineraries.edit',
                $itinerary
            )
            ->with(
                'itinerary_success',
                'Đã xóa địa điểm khỏi lịch trình.'
            );
    }


    public function storeItem(
        Request $request,
        Itinerary $itinerary
    ) {
        // ==========================================
        // 1. KIỂM TRA CHỦ SỞ HỮU
        // ==========================================

        if ($itinerary->user_id !== auth()->id()) {
            abort(403);
        }


        // ==========================================
        // 2. VALIDATE
        // ==========================================

        $validated = $request->validate([
            'place_id' => [
                'required',
                'integer',
                'exists:places,id',
            ],

            'day_number' => [
                'required',
                'integer',
                'min:1',
                'max:' . $itinerary->total_days,
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],
        ]);


        // ==========================================
        // 3. KIỂM TRA ĐỊA ĐIỂM
        // ==========================================

        $place = Place::where(
                'id',
                $validated['place_id']
            )
            ->where(
                'province_id',
                $itinerary->province_id
            )
            ->where(
                'status',
                'active'
            )
            ->firstOrFail();

        
        // ==========================================
        // KIỂM TRA GIỜ MỞ CỬA / ĐÓNG CỬA
        // ==========================================

        $startTime = Carbon::createFromFormat(
            'H:i',
            $validated['start_time']
        );

        $endTime = Carbon::createFromFormat(
            'H:i',
            $validated['end_time']
        );


        // Kiểm tra giờ mở cửa
        if ($place->open_time) {

            $openTime = Carbon::createFromFormat(
                'H:i:s',
                $place->open_time
            );

            if ($startTime->lessThan($openTime)) {

                return back()
                    ->withErrors([
                        'start_time' =>
                            'Địa điểm này mở cửa từ '
                            . $openTime->format('H:i')
                            . '.',
                    ])
                    ->withInput();
            }
        }


        // Kiểm tra giờ đóng cửa
        if ($place->close_time) {

            $closeTime = Carbon::createFromFormat(
                'H:i:s',
                $place->close_time
            );

            if ($endTime->greaterThan($closeTime)) {

                return back()
                    ->withErrors([
                        'end_time' =>
                            'Địa điểm này đóng cửa lúc '
                            . $closeTime->format('H:i')
                            . '.',
                    ])
                    ->withInput();
            }
        }


        // ==========================================
        // 4. KIỂM TRA ĐÃ CÓ TRONG LỊCH TRÌNH CHƯA
        // ==========================================

        $alreadyExists = ItineraryItem::where(
                'itinerary_id',
                $itinerary->id
            )
            ->where(
                'place_id',
                $place->id
            )
            ->exists();


        if ($alreadyExists) {

            return back()
                ->withErrors([
                    'place_id' =>
                        'Địa điểm này đã có trong lịch trình.',
                ])
                ->withInput();
        }


        // ==========================================
        // 5. KIỂM TRA TRÙNG THỜI GIAN
        // ==========================================

        $hasConflict = ItineraryItem::where(
                'itinerary_id',
                $itinerary->id
            )
            ->where(
                'day_number',
                $validated['day_number']
            )
            ->where(
                'start_time',
                '<',
                $validated['end_time']
            )
            ->where(
                'end_time',
                '>',
                $validated['start_time']
            )
            ->exists();


        if ($hasConflict) {

            return back()
                ->withErrors([
                    'time_conflict' =>
                        'Khoảng thời gian này bị trùng với một địa điểm khác trong Ngày '
                        . $validated['day_number']
                        . '.',
                ])
                ->withInput();
        }


        // ==========================================
        // 6. TÍNH SORT ORDER
        // ==========================================

        $sortOrder = ItineraryItem::where(
                'itinerary_id',
                $itinerary->id
            )
            ->where(
                'day_number',
                $validated['day_number']
            )
            ->max('sort_order');

        $sortOrder = ($sortOrder ?? 0) + 1;


        // ==========================================
        // 7. THÊM ĐỊA ĐIỂM
        // ==========================================

        ItineraryItem::create([
            'itinerary_id' => $itinerary->id,
            'place_id' => $place->id,
            'day_number' => $validated['day_number'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'sort_order' => $sortOrder,
        ]);


        ItineraryItem::create([
            'itinerary_id' => $itinerary->id,
            'place_id' => $place->id,
            'day_number' => $validated['day_number'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'sort_order' => $sortOrder,
        ]);

        // Sắp xếp lại thứ tự theo giờ
        $this->reorderItineraryItems($itinerary);


        return redirect()
            ->route(
                'itineraries.edit',
                $itinerary
            )
            ->with(
                'itinerary_success',
                'Đã thêm địa điểm vào lịch trình.'
            );
    }


    private function reorderItineraryItems(
        Itinerary $itinerary
    ): void {
        // Lấy tất cả địa điểm
        // sắp xếp theo ngày rồi theo giờ bắt đầu
        $items = ItineraryItem::where(
                'itinerary_id',
                $itinerary->id
            )
            ->orderBy('day_number')
            ->orderBy('start_time')
            ->get();

        // Nhóm theo từng ngày
        $itemsByDay = $items->groupBy('day_number');

        foreach ($itemsByDay as $dayItems) {

            $sortOrder = 1;

            foreach ($dayItems as $item) {

                $item->update([
                    'sort_order' => $sortOrder,
                ]);

                $sortOrder++;
            }
        }
    }
}