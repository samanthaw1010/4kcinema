<?php
// Khi ta dùng route (có name là gì đó) ở view, route này sẽ đi đến 1 function xác định ở 1 controller
// Sau khi xử lý data ở function xong, sẽ trả về 1 view để hiển thị lên trình duyệt

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| Login - Logout Routes
|--------------------------------------------------------------------------
| 
*/
Auth::routes(['verify' => true]);
Route::get('/register', [UserController::class, 'register_get'])->name('register_get');
Route::post('/register', [UserController::class, 'register_post'])->name('register_post');
Route::get('/log-in', [LoginController::class, 'log_in'])->name('log_in');
Route::post('/log-in', [LoginController::class, 'log_in_post'])->name('log_in');
Route::get('/log-out', [UserController::class, 'log_out'])->name('log_out');
Route::post('/password-reset', [RegisterController::class, 'password_reset'])->name('password_reset');
// Ajax kiểm tra trùng email:
Route::post('/check-email', [AdminController::class, 'check_email'])->name('check_email');

/*
|--------------------------------------------------------------------------
| Landing Page Routes
|--------------------------------------------------------------------------
| 
*/
Route::get('/', [IndexController::class, 'home'])->name('homepage');
//Phân tích: sử dụng phương thức get, kế đến là nội dung sẽ hiển thị trên thanh tiêu đề (đường dẫn của Route), tiếp theo: controller là IndexController, dùng hàm (function) là home() bên trong controller này, mình đặt tên cho route này 1 cái name là homepage, để qua bên các file .blade.php mình gọi route bằng name cho khỏe, không cần viết URL::to dài dòng
//Sau này nhìn vào route bên các file .blade.php mà không biết nó được gọi ra từ đâu, thì vào file web.php này mà xem là sẽ biết nha
//Hoặc từ Terminal gõ php artisan route:list thì cũng xem được luôn nha

//Xem thông báo:
Route::get('/view-notification', [IndexController::class, 'view_notification'])->name('view_notification');

//Tìm kiếm phim
Route::get('/tim-kiem', [IndexController::class, 'searchMovie'])->name('tim-kiem');
//Đánh giá phim
Route::post('/add-rating', [IndexController::class, 'add_rating'])->name('add-rating');
//Bookmark phim
Route::post('/add-bookmark', [BookmarkController::class, 'add_bookmark'])->name('add_bookmark');
Route::get('/show-bookmark', [BookmarkController::class, 'show_bookmark'])->name('show_bookmark');
Route::post('/delete-bookmark/{id}', [BookmarkController::class, 'delete_bookmark'])->name('delete_bookmark');


Route::get('/danh-muc/{slug}', [IndexController::class, 'category'])->name('category');
//Phân tích: {slug} là 1 tham số động, giá trị của nó sẽ được thay đôi và truyền vào đường dân
Route::get('/the-loai/{slug}', [IndexController::class, 'genre'])->name('genre');
Route::get('/quoc-gia/{slug}', [IndexController::class, 'country'])->name('country');
Route::get('/phim/{slug}', [IndexController::class, 'movie'])->name('movie');
Route::get('/xem-phim/{slug}/{tap}', [IndexController::class, 'watch']);
Route::get('/so-tap', [IndexController::class, 'episode'])->name('so-tap');
Route::get('/nam/{year}', [IndexController::class, 'year']);
Route::get('/tag/{tag}', [IndexController::class, 'tag']);

// Giỏ hàng
Route::get('/package', [PackageController::class, 'index'])->name('package');
Route::post('/check-out/{id}', [PackageController::class, 'check_out'])->name('check_out');

// VN-PAY:
Route::post('/vnpay-payment', [PackageController::class, 'vnpay_payment'])->name('vnpay_payment');

// PayPal:
Route::get('create-transaction', [PayPalController::class, 'createTransaction'])->name('createTransaction');
Route::post('process-transaction', [PayPalController::class, 'processTransaction'])->name('processTransaction');
Route::get('success-transaction', [PayPalController::class, 'successTransaction'])->name('successTransaction');
Route::get('cancel-transaction', [PayPalController::class, 'cancelTransaction'])->name('cancelTransaction');

// Quản lý tài khoản
Route::get('/setting-info', [UserController::class, 'setting_info'])->name('setting_info');
Route::get('/back', [UserController::class, 'back'])->name('back');
Route::get('/edit-information/{id}', [UserController::class, 'edit_information'])->name('edit_information');
Route::post('/update-information/{id}', [UserController::class, 'update_information'])->name('update_information');

// Người dùng tự hủy gói
Route::post('/cancel-package/{id}', [UserController::class, 'cancel_package'])->name('cancel-package');

// Chính sách và điều khoản sử dụng
Route::get('/policy', [IndexController::class, 'policy_page'])->name('policy');
Route::get('/term', [IndexController::class, 'term_page'])->name('term');

/*
|--------------------------------------------------------------------------
| Admin Page Routes
|--------------------------------------------------------------------------
| 
*/
Route::middleware(['checkUserRole:1'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    // Lượt view trang Home:
    Route::get('/view-data', [AdminController::class, 'getViewData'])->name('view-data');
    Route::get('/view-chart', function () {
        return view('dashboard');
    });

    Route::resource('manageUser', ManageUserController::class);
    Route::post('/active-user/{id}', [ManageUserController::class, 'active_user'])->name('active_user');
    Route::post('/inactive-user/{id}', [ManageUserController::class, 'inactive_user'])->name('inactive_user');

    Route::resource('genre', GenreController::class); //trong resource có chứa các phương thức get, post, put để gửi và lấy data
    Route::post('/show-genre/{id}', [GenreController::class, 'show_genre'])->name('show_genre');
    Route::post('/hide-genre/{id}', [GenreController::class, 'hide_genre'])->name('hide_genre');

    Route::resource('country', CountryController::class);
    Route::post('/show-country/{id}', [CountryController::class, 'show_country'])->name('show_country');
    Route::post('/hide-country/{id}', [CountryController::class, 'hide_country'])->name('hide_country');

    Route::resource('movies', MovieController::class);
    //Thêm tập phim:
    Route::resource('episode', EpisodeController::class);

    Route::resource('packageVIP', PackageController::class);
    Route::post('/show-package/{id}', [PackageController::class, 'show_package'])->name('show_package');
    Route::post('/hide-package/{id}', [PackageController::class, 'hide_package'])->name('hide_package');

    Route::resource('notification', NotificationController::class);

    Route::get('/add-episode/{id}', [EpisodeController::class, 'add_episode'])->name('add-episode');
    //Chọn tên phim để cập nhật tập phim mới:
    Route::get('select-movie', [EpisodeController::class, 'select_movie'])->name('select-movie');
    //Update năm phát hành
    Route::get('/update-year-phim', [MovieController::class, 'update_year']);
    //Update season phim
    Route::get('/update-season-phim', [MovieController::class, 'update_season']);
    //Update top view phim
    Route::get('/update-topview-phim', [MovieController::class, 'update_topview']);
    Route::post('/filter-topview-phim', [MovieController::class, 'filter_topview']);
    Route::get('/filter-topview-default', [MovieController::class, 'filter_default']);
    // Thay đổi danh mục/quốc gia ajax:
    Route::get('/update-category', [MovieController::class, 'update_category_ajax'])->name('update_category_ajax');
    Route::get('/update-country', [MovieController::class, 'update_country_ajax'])->name('update_country_ajax');

    // Báo cáo
    Route::post('/filter-by-date', [AdminController::class, 'filter_by_date']);

    // Bookmark
    Route::get('/crud-bookmark', [BookmarkController::class, 'crud_bookmark'])->name('crud_bookmark');
});