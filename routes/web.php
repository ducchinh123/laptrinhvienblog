<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\PostController;
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

// ====================== ADMIN =================================== //



Route::prefix('/devC/wp-admin')->group(function () {
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

    Route::get('/video-index', function () {
        return view('admin.video.index');
    })->name('devC-video-index');
    Route::get('/video-add', function () {
        return view('admin.video.add');
    })->name('devC-video-add');
    // Route::get('/category-update', function () {
    //     return view('admin.category.update');
    // })->name('devC-cate-update');

    // ==================== ROUTE SETTING ====================

    Route::get('/setting-user', function () {
        return view('admin.setting.users');
    })->name('devC-user');

    Route::get('/setting-boot', function () {
        return view('admin.setting.boot');
    })->name('devC-boot');

    Route::get('/setting-overview', function () {
        return view('admin.setting.overview');
    })->name('devC-overview');
});