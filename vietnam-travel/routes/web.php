<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\ExploreController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\CompareController;


use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PlaceController as AdminPlaceController;
use App\Http\Controllers\Admin\ProvinceController as AdminProvinceController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\RatingController as AdminRatingController;



Route::get('/', [HomeController::class, 'index']);

Route::post('/search-province', [HomeController::class, 'search'])
    ->name('province.search');

Route::get('/provinces/{slug}', [ProvinceController::class, 'show']);

Route::get('/places/{slug}', [PlaceController::class, 'show'])
    ->name('places.show');

Route::get('/compare', [CompareController::class, 'index'])
    ->name('compare.index');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/profile', function () {
    return view('profile.show');
})->middleware('auth')->name('profile');


Route::middleware('auth')->group(function () {

    Route::get(
        '/profile/edit',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::put(
        '/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::put(
        '/profile/password',
        [ProfileController::class, 'updatePassword']
    )->name('profile.password');


    Route::post(
        '/places/{place}/rating',
        [RatingController::class, 'store']
    )
        ->name('ratings.store');

    Route::delete(
        '/ratings/{rating}',
        [RatingController::class, 'destroy']
    )
        ->name('ratings.destroy');


    Route::get(
        '/history',
        [HistoryController::class, 'index']
    )->name('history.index');


    Route::delete(
        '/history/searches',
        [HistoryController::class, 'clearSearches']
    )
        ->name('history.searches.clear');


    Route::delete(
        '/history/searches/{searchHistory}',
        [HistoryController::class, 'destroySearch']
    )
        ->name('history.searches.destroy');


    Route::delete(
        '/history/{history}',
        [HistoryController::class, 'destroy']
    )
        ->name('history.destroy');


    Route::delete(
        '/history',
        [HistoryController::class, 'clear']
    )
        ->name('history.clear');

});


Route::post(
    '/places/{place}/comments',
    [CommentController::class, 'store']
)
    ->middleware('auth')
    ->name('comments.store');



Route::delete(
    '/comments/{comment}',
    [CommentController::class, 'destroy']
)
    ->middleware('auth')
    ->name('comments.destroy');



Route::put(
    '/comments/{comment}',
    [CommentController::class, 'update']
)
    ->middleware('auth')
    ->name('comments.update');


Route::post(
    '/places/{place}/favorite',
    [FavoriteController::class, 'toggle']
)
    ->middleware('auth')
    ->name('favorites.toggle');


Route::get(
    '/favorites',
    [FavoriteController::class, 'index']
)
    ->middleware('auth')
    ->name('favorites.index');


Route::get(
    '/itineraries/create',
    [ItineraryController::class, 'create']
)
    ->middleware('auth')
    ->name('itineraries.create');


Route::post(
    '/itineraries',
    [ItineraryController::class, 'store']
)
    ->middleware('auth')
    ->name('itineraries.store');


Route::get(
    '/itineraries',
    [ItineraryController::class, 'index']
)
    ->middleware('auth')
    ->name('itineraries.index');


Route::get(
    '/itineraries/{itinerary}',
    [ItineraryController::class, 'show']
)
    ->middleware('auth')
    ->name('itineraries.show');


Route::delete(
    '/itineraries/{itinerary}',
    [ItineraryController::class, 'destroy']
)
    ->middleware('auth')
    ->name('itineraries.destroy');


Route::get(
    '/itineraries/{itinerary}/edit',
    [ItineraryController::class, 'edit']
)
    ->middleware('auth')
    ->name('itineraries.edit');


Route::put(
    '/itineraries/{itinerary}',
    [ItineraryController::class, 'update']
)
    ->middleware('auth')
    ->name('itineraries.update');


Route::put(
    '/itinerary-items/{item}',
    [ItineraryController::class, 'updateItem']
)
    ->middleware('auth')
    ->name('itinerary-items.update');


Route::delete(
    '/itinerary-items/{item}',
    [ItineraryController::class, 'destroyItem']
)
    ->middleware('auth')
    ->name('itinerary-items.destroy');


Route::post(
    '/itineraries/{itinerary}/items',
    [ItineraryController::class, 'storeItem']
)
    ->middleware('auth')
    ->name('itinerary-items.store');


Route::get(
    '/explore',
    [ExploreController::class, 'index']
)->name('explore.index');



Route::get(
    '/search',
    [HomeController::class, 'results']
)->name('search.results');



Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get(
            '/',
            [DashboardController::class, 'index']
        )->name('dashboard');


        // Địa điểm
        Route::patch(
            'places/{place}/toggle-status',
            [AdminPlaceController::class, 'toggleStatus']
        )->name('places.toggle-status');

        Route::delete(
            'places/{place}/images/{image}',
            [AdminPlaceController::class, 'destroyImage']
        )->name('places.images.destroy');

        Route::resource('places', AdminPlaceController::class);


        // Tỉnh/ Thành phố
        Route::resource('provinces', AdminProvinceController::class);


        // Danh mục
        Route::resource(
            'categories',
            AdminCategoryController::class
        );


        // Người dùng
        Route::resource(
            'users',
            AdminUserController::class
        );


        // Bình luận
        Route::get(
            'comments',
            [AdminCommentController::class, 'index']
        )->name('comments.index');

        Route::delete(
            'comments/{comment}',
            [AdminCommentController::class, 'destroy']
        )->name('comments.destroy');

        

        //Đánh giá
        Route::get(
            'ratings',
            [AdminRatingController::class, 'index']
        )->name('ratings.index');

        Route::delete(
            'ratings/{rating}',
            [AdminRatingController::class, 'destroy']
        )->name('ratings.destroy');

    });



