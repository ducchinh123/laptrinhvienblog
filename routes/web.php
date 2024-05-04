<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// ====================== CLIENT =================================== //
Route::get('/', [HomeController::class, 'index']);
Route::get('/bai-viet.html', function () {
    return view('client.post');
})->name('c-post-index');
Route::get('/video-tren-song', function () {
    return view('client.video');
})->name('c-video');
Route::get('/chi-tiet/{slug}', function () {
    return view('client.detail_post');
})->name('c-post-detail');
Route::get('/ve-toi.html', function () {
    return view('client.about');
})->name('c-about');
Route::get('/lien-lac.html', function () {
    return view('client.contact');
})->name('c-contact');


Route::get('/dang-nhap.html', function () {
    return view('client.login');
})->name('c-login');

Route::get('/dang-ky.html', function () {
    return view('client.register');
})->name('c-register');



// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

// ====================== ADMIN =================================== //



Route::prefix('/devC/wp-admin')->middleware(['auth', 'verified', 'checkAdmin'])->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    })->name('devC-admin');

    // ==================== ROUTE POST ====================
    Route::get('/post-index', [PostController::class, 'IndexPost'])->name('devC-post-index');
    Route::delete('/post-delete/{id}', [PostController::class, 'DeletePost'])->name('devC-post-delete');
    Route::get('/post-trash', [PostController::class, 'TrashPost'])->name('devC-post-trash');
    Route::get('/post-restore/{id}', [PostController::class, 'RestorePost'])->name('devC-post-restore');
    Route::get('/post-add', [PostController::class, 'CreatePost'])->name('devC-post-add');
    Route::POST('/post-add-start', [PostController::class, 'CreatePostStart'])->name('devC-post-add-start');

    Route::get('/post-update/{id}',[PostController::class, 'EditPost'])->name('devC-post-update');
    Route::post('/post-update-start/{id}', [PostController::class, 'UpdatePostStart'])->name('devC-post-update-start');

    // ==================== ROUTE CATEGORY ====================

    Route::get('/category-index', [CategoryController::class, 'IndexCategory'])->name('devC-cate-index');
    Route::get('/category-trash', [CategoryController::class, 'TrashCategory'])->name('devC-cate-trash');
    Route::get('/category-restore/{id}', [CategoryController::class, 'RestoreCategory'])->name('devC-cate-restore');
    Route::delete('/category-delete/{id}', [CategoryController::class, 'DeleteCategory'])->name('devC-cate-delete');
    Route::POST('/category-add-start', [CategoryController::class, 'CreateCategory'])->name('devC-cate-add-start');
    Route::GET('/category-add', function () {
        return view('admin.category.add');
    })->name('devC-cate-add');
    Route::GET('/category-update/{id}', [CategoryController::class, 'EditCategory'])->name('devC-cate-update');
    Route::POST('/category-update-start/{id}', [CategoryController::class, 'UpdateCategory'])->name('devC-cate-update-start');
    // ==================== ROUTE VIDEO ====================

    Route::get('/video-index',[VideoController::class, 'IndexVideo'])->name('devC-video-index');
    Route::get('/video-add', [VideoController::class, 'CreateVideo'])->name('devC-video-add');
    Route::post('/video-add-start', [VideoController::class, 'CreateVideoStart'])->name('devC-video-add-start');
    Route::get('/video-update/{id}', [VideoController::class, 'UpdateVideo'])->name('devC-video-update');
    Route::post('/video-update-start/{id}', [VideoController::class, 'UpdateVideoStart'])->name('devC-video-update-start');
    Route::delete('/video-delete/{id}', [VideoController::class, 'DeleteVideo'])->name('devc-video-delete');
    Route::get('/video-trash', [VideoController::class, 'TrashVideo'])->name('devc-video-trash');
    Route::get('/video-restore/{id}', [VideoController::class, 'RestoreVideo'])->name('devc-video-restore');
    // ==================== ROUTE SETTING ====================

    Route::get('/setting-user', function () {
        return view('admin.setting.users');
    })->name('devC-user');

    Route::get('/setting-boot', function () {
        return view('admin.setting.boot');
    })->name('devC-boot');

    Route::get('/setting-overview', [SettingController::class, 'IndexSetting'])->name('devC-overview');
    Route::post('/setting-overview-change', [SettingController::class, 'ChangeSystem'])->name('devC-change-system');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
