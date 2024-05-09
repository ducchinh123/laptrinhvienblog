<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Client\AboutController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PostController as ClientPostController;
use App\Http\Controllers\Client\VideoController as ClientVideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DecentralizationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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
Route::get('/', [HomeController::class, 'index'])->name('client-home');
Route::get('/bai-viet.html', [ClientPostController::class, 'HomePost'])->name('c-post-index');
Route::get('/bai-viet-theo-danh-muc_{id}.html', [ClientPostController::class, 'BindPostById'])->name('c-post-category');
Route::get('/video-tren-song.html', [ClientVideoController::class, 'HomeVideo'])->name('c-video');
Route::get('/chi-tiet/{slug}_{id}.html', [ClientPostController::class, 'DetailPost'])->name('c-post-detail');
Route::get('/ve-toi.html', [AboutController::class, 'HomeAbout'])->name('c-about');
Route::get('/lien-lac.html', [ContactController::class, 'HomeContact'])->name('c-contact');
Route::post('/send-contact', [ContactController::class, 'SendMail'])->name('send-contact');

Route::get('/dang-nhap.html', function () {
    $title = 'Đăng nhập | DevC Blog';
    return view('client.login', compact('title'));
})->name('c-login');

Route::get('/dang-ky.html', function () {
    $title = 'Đăng ký | DevC Blog';
    return view('client.register', compact('title'));
})->name('c-register');


// Client Post
Route::get('/get-view-current/{id}', [PostController::class, 'get_view_current']);
Route::put('/update-view-post/{id}', [PostController::class, 'update_view_post']);


// Route::get('/dashboard', function () {
//     return view('admin.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

// ====================== ADMIN =================================== //



Route::prefix('/devC/wp-admin')->middleware(['auth', 'verified', 'checkAdmin'])->group(function () {
    // ==================== ROUTE DASHBOARD ====================
    Route::get('/', [DashboardController::class, 'IndexDashboard'])->name('devC-admin');
    Route::get('/post-view-tallest/{option}', [DashboardController::class, 'PostViewTallest'])->name('devC-post-view-tallest');

    // ==================== ROUTE POST ====================
    Route::get('/post-index', [PostController::class, 'IndexPost'])->name('devC-post-index')->middleware(['permission:admin|add post|edit post|delete post']);
    Route::delete('/post-delete/{id}', [PostController::class, 'DeletePost'])->name('devC-post-delete')->middleware(['permission:admin|delete post']);
    Route::get('/post-trash', [PostController::class, 'TrashPost'])->name('devC-post-trash')->middleware(['permission:admin|delete post']);
    Route::get('/post-restore/{id}', [PostController::class, 'RestorePost'])->name('devC-post-restore')->middleware(['permission:admin|delete post']);
    Route::get('/post-add', [PostController::class, 'CreatePost'])->name('devC-post-add')->middleware(['permission:admin|add post']);
    Route::POST('/post-add-start', [PostController::class, 'CreatePostStart'])->name('devC-post-add-start')->middleware(['permission:admin|add post']);

    Route::get('/post-update/{id}', [PostController::class, 'EditPost'])->name('devC-post-update')->middleware(['permission:admin|edit post']);
    Route::post('/post-update-start/{id}', [PostController::class, 'UpdatePostStart'])->name('devC-post-update-start')->middleware(['permission:admin|edit post']);

    // ==================== ROUTE CATEGORY ====================

    Route::get('/category-index', [CategoryController::class, 'IndexCategory'])->name('devC-cate-index')->middleware(['permission:admin|add category|edit category|delete category']);
    Route::get('/category-trash', [CategoryController::class, 'TrashCategory'])->name('devC-cate-trash')->middleware(['permission:admin|delete category']);
    Route::get('/category-restore/{id}', [CategoryController::class, 'RestoreCategory'])->name('devC-cate-restore')->middleware(['permission:admin|delete category']);
    Route::delete('/category-delete/{id}', [CategoryController::class, 'DeleteCategory'])->name('devC-cate-delete')->middleware(['permission:admin|delete category']);
    Route::POST('/category-add-start', [CategoryController::class, 'CreateCategory'])->name('devC-cate-add-start')->middleware(['permission:admin|add category']);
    Route::GET('/category-add', function () {
        return view('admin.category.add');
    })->name('devC-cate-add')->middleware(['permission:admin|add category']);
    Route::GET('/category-update/{id}', [CategoryController::class, 'EditCategory'])->name('devC-cate-update')->middleware(['permission:admin|edit category']);
    Route::POST('/category-update-start/{id}', [CategoryController::class, 'UpdateCategory'])->name('devC-cate-update-start')->middleware(['permission:admin|edit category']);
    // ==================== ROUTE VIDEO ====================

    Route::get('/video-index', [VideoController::class, 'IndexVideo'])->name('devC-video-index')->middleware(['permission:admin|add video|edit video|delete video']);
    Route::get('/video-add', [VideoController::class, 'CreateVideo'])->name('devC-video-add')->middleware(['permission:admin|add video']);
    Route::post('/video-add-start', [VideoController::class, 'CreateVideoStart'])->name('devC-video-add-start')->middleware(['permission:admin|add video']);
    Route::get('/video-update/{id}', [VideoController::class, 'UpdateVideo'])->name('devC-video-update')->middleware(['permission:admin|edit video']);
    Route::post('/video-update-start/{id}', [VideoController::class, 'UpdateVideoStart'])->name('devC-video-update-start')->middleware(['permission:admin|edit video']);
    Route::delete('/video-delete/{id}', [VideoController::class, 'DeleteVideo'])->name('devc-video-delete')->middleware(['permission:admin|delete video']);
    Route::get('/video-trash', [VideoController::class, 'TrashVideo'])->name('devc-video-trash')->middleware(['permission:admin|delete video']);
    Route::get('/video-restore/{id}', [VideoController::class, 'RestoreVideo'])->name('devc-video-restore')->middleware(['permission:admin|delete video']);

    // ==================== ROUTE PHÂN QUYỀN ỨNG DỤNG ====================
    //
    Route::get('/decentralization-index', [DecentralizationController::class, 'IndexDecentralization'])->name('decentralization-index')->middleware(['permission:admin']);
    //
    // =============== Roles / Vai trò ==========//
    Route::get('/role-index', [DecentralizationController::class, 'IndexRole'])->name('role-index')->middleware(['permission:admin']);
    Route::get('/role-add', [DecentralizationController::class, 'CreateRole'])->name('role-add')->middleware(['permission:admin']);
    Route::post('/role-add-start', [DecentralizationController::class, 'CreateRoleStart'])->name('role-add-start')->middleware(['permission:admin']);
    Route::get('/role-update/{id}', [DecentralizationController::class, 'UpdateRole'])->name('role-update')->middleware(['permission:admin']);
    Route::post('/role-update-start/{id}', [DecentralizationController::class, 'UpdateRoleStart'])->name('role-update-start')->middleware(['permission:admin']);
    Route::delete('/role-delete/{id}', [DecentralizationController::class, 'DeleteRole'])->name('role-delete')->middleware(['permission:admin']);
    // =============== Allocation / Phân bổ ==========//
    Route::get('/allocation-add', [DecentralizationController::class, 'CreateAllocation'])->name('allocation-add')->middleware(['permission:admin']);
    Route::post('/allocation-add-start', [DecentralizationController::class, 'CreateAllocationStart'])->name('allocation-add-start')->middleware(['permission:admin']);
    Route::get('/allocation-update/{id}', [DecentralizationController::class, 'UpdateAllocation'])->name('allocation-update')->middleware(['permission:admin']);
    Route::post('/allocatiom-update-start/{id}', [DecentralizationController::class, 'UpdateAllocationStart'])->name('allocation-update-start')->middleware(['permission:admin']);
    Route::delete('allocation-delete/{id}', [DecentralizationController::class, 'DeleteAllocation'])->middleware(['permission:admin']);

    // ==================== ROUTE COMMENT ====================

    Route::get('/comment-index', [CommentController::class, 'IndexComment'])->name('devc-comment-index');
    Route::post('/comment-index-search', [CommentController::class, 'SearchComment'])->name('devc-comment-search');
    Route::delete('/comment-delete/{id}', [CommentController::class, 'DeleteComment'])->name('devc-comment-delete');
    // ==================== ROUTE SETTING ====================

    Route::get('/setting-user', [UserController::class, 'management_user'])->name('devC-user');
    Route::delete('/setting-user-delete/{id}', [UserController::class, 'DeleteAccount'])->name('devC-user-delete')->middleware(['permission:admin']);

    Route::get('/setting-boot', [UserController::class, 'boot_account'])->name('devC-boot');
    Route::post('/setting-boot-update/{id}', [UserController::class, 'boot_account_update'])->name('devC-boot-update');

    Route::get('/setting-overview', [SettingController::class, 'IndexSetting'])->name('devC-overview')->middleware(['permission:admin']);
    Route::post('/setting-overview-change', [SettingController::class, 'ChangeSystem'])->name('devC-change-system')->middleware(['permission:admin']);
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
