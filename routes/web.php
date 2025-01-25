<?php

use App\Http\Controllers\HomeView;
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

Route::get('/welcome', function () {
    return view('welcome');
});

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SignageController;
use App\Http\Controllers\PlayListController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TemplateListController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\PartnerRequestController;
use App\Http\Controllers\RegisterDeviceController;
use App\Http\Controllers\SupportRequestController;
use App\Http\Controllers\LiveDemoRequestController;
use App\Http\Controllers\PermissionGroupController;

Route::get('/', function () {
    return redirect('welcome');
})->middleware('guest');

//landing page
Route::get('/home', [HomeView::class, 'index']);
Route::get('/mdm', [HomeView::class, 'mdm']);
Route::get('/kiosklockdown', [HomeView::class, 'kiosklockdown']);
Route::get('/contact_us', [HomeView::class, 'contact_us']);
Route::get('/digital_signage', [HomeView::class, 'digital_signage']);
Route::get('/support', [HomeView::class, 'support']);
Route::get('/become_our_partner', [HomeView::class, 'become_our_partner']);
Route::get('/request-a-demo', [HomeView::class, 'request_a_demo']);


//Landing page login
// Public routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('loginl');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logoutl', [AuthController::class, 'logoutl'])->name('logoutl');

// Protected routes
Route::middleware(['checkLoggedIn'])->group(function () {
    Route::get('/request-a-demo-data-list', [LiveDemoRequestController::class, 'request_a_demo_data_list'])->name('request-a-demo-data-list');
    Route::get('/get-request-demo-data', [LiveDemoRequestController::class, 'getRequestDemoData'])->name('demo.requests');

    Route::get('/support-data-list', [SupportRequestController::class, 'support_data_list'])->name('support_data_list');
    Route::get('/support-requests', [SupportRequestController::class, 'getSupportData']);
    Route::delete('/support-request/{id}', [SupportRequestController::class, 'delete']);
    Route::put('/support-request/{id}', [SupportRequestController::class, 'update'])->name('support-request.update');
    Route::get('/edit-support-data-list/{id}', [SupportRequestController::class, 'edit'])->name('support.edit');

    Route::get('/contact-us-data-list', [ContactRequestController::class, 'contact_us_data_list']);
    Route::get('/get-contact-us-data', [ContactRequestController::class, 'getContactUsdata'])->name('contact.requests');

    Route::get('/partner-data-list', [PartnerRequestController::class, 'partner_data_list']);
    Route::get('/get-partner-data', [PartnerRequestController::class, 'getPartnerdata'])->name('partner.requests');
});
Route::post('/request-a-demo', [LiveDemoRequestController::class, 'store'])->name('demo.request.store');

Route::post('/support-request', [SupportRequestController::class, 'store'])->name('support-request.store');
Route::get('/support-request/check-ticket', [SupportRequestController::class, 'checkTicket'])->name('support-request.check-ticket');


Route::post('/contact-requests', [ContactRequestController::class, 'store'])->name('contact-requests.store');


Route::post('/partner-requests', [PartnerRequestController::class, 'store'])->name('partner.store');







Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');

Route::get('verify', function () {
    return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
    return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');


// Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
    Route::get('billing', function () {
        return view('pages.billing');
    })->name('billing');
    Route::get('tables', function () {
        return view('pages.tables');
    })->name('tables');
    Route::get('rtl', function () {
        return view('pages.rtl');
    })->name('rtl');
    Route::get('virtual-reality', function () {
        return view('pages.virtual-reality');
    })->name('virtual-reality');
    Route::get('static-sign-in', function () {
        return view('pages.static-sign-in');
    })->name('static-sign-in');
    Route::get('static-sign-up', function () {
        return view('pages.static-sign-up');
    })->name('static-sign-up');
    // Route::get('user-management', function () {
    //     return view('pages.laravel-examples.user-management');
    // })->name('user-management');
    // Route::get('user-profile', function () {
    //     return view('pages.laravel-examples.user-profile');
    // })->name('user-profile');
});

Route::get('/clear', function () {
    // Run Artisan commands
    Artisan::call('optimize:clear');
    return redirect()->back();
});

// Signage
Route::get('/signage', [SignageController::class, 'index'])->middleware('auth')->name('signage');
Route::get('/signage1', [SignageController::class, 'index1'])->middleware('auth');
Route::get('/digital-signage', [SignageController::class, 'view'])->name('digital.signage');

// Registration Device
Route::middleware(['auth'])->group(function () {
    Route::get('/register-device-view', [RegisterDeviceController::class, 'device'])->name('register.content.device.view');
    Route::get('/register-device-list', [RegisterDeviceController::class, 'deviceList'])->name('register.content.device.list');
    Route::get('/register-device-create', [RegisterDeviceController::class, 'create'])->name('register.content.device.create');
    Route::post('/register-device-store', [RegisterDeviceController::class, 'store'])->name('register.content.device.store');
    Route::get('/register-device-store', [RegisterDeviceController::class, 'edit'])->name('register.content.device.edit');
    Route::get('/register-device-template-assign/{id}', [RegisterDeviceController::class, 'template_assign'])->name('register.content.device.template-assign');
    Route::post('/register-device-template-assign/{id}', [RegisterDeviceController::class, 'template_assign_store'])->name('register.content.device.template-assign');
    Route::post('/register-device-update', [RegisterDeviceController::class, 'update'])->name('register.content.device.update');
    Route::delete('/register-device-delete/{id}', [RegisterDeviceController::class, 'destroy'])->name('register.content.device.destroy');
});
// Content Management
Route::get('/content', [ContentController::class, 'content'])->name('content.view')->middleware(['permission:content.view']);
Route::post('/content-upload', [ContentController::class, 'upload'])->name('content.upload')->middleware(['permission:content.create']);
Route::get('/content-audio-list', [ContentController::class, 'showAudioList'])->name('content.audio.list')->middleware(['permission:content.audio.view']);
Route::get('/content-image-list', [ContentController::class, 'showImageList'])->name('content.image.list')->middleware(['permission:content.image.view']);
Route::get('/content-video-list', [ContentController::class, 'showVideoList'])->name('content.video.list')->middleware(['permission:content.video.list.view']);
//link
Route::get('/content-link-list', [ContentController::class, 'showLinkList'])->name('content.link.list');
Route::get('/content-app-list', [ContentController::class, 'showAppList'])->name('content.app.list');
Route::get('/content-banner-list', [ContentController::class, 'showBannerList'])->name('content.banner.list');
Route::post('/submit-banner', [ContentController::class, 'store_banner'])->name('banner.submit');
Route::get('/banner-info/{id}', [ContentController::class, 'bannerInfo'])->name('banner.submit');
Route::get('/content-create-audio', [ContentController::class, 'createContentAudio'])->name('content.create.audio')->middleware(['permission:content.audio.create']);
Route::get('/content-create-image', [ContentController::class, 'createContentImage'])->name('content.create.image')->middleware(['permission:content.image.create']);
Route::get('/content-create-video', [ContentController::class, 'createContentVideo'])->name('content.create.video')->middleware(['permission:content.video.create']);
//link
Route::get('/content-create-link', [ContentController::class, 'createContentLink'])->name('content.create.link');
Route::post('/content-link-store', [ContentController::class, 'storeLinks'])->name('content.store.link');
Route::delete('/content-delete-banner/{id}', [ContentController::class, 'deleteBanner'])->name('content.delete.banner');
Route::delete('/content-delete-audio/{id}', [ContentController::class, 'deleteAudio'])->name('content.delete.audio')->middleware(['permission:content.audio.destroy']);
Route::delete('/content-delete-image/{id}', [ContentController::class, 'deleteImage'])->name('content.delete.image')->middleware(['permission:content.image.destroy']);
Route::delete('/content-delete-video/{id}', [ContentController::class, 'deleteVideo'])->name('content.delete.video')->middleware(['permission:content.video.destroy']);
//Link
Route::delete('/content-delete-link/{id}', [ContentController::class, 'deleteLink'])->name('content.delete.link');


// Playlist Management for Video
Route::get('/video-playlist-view', [PlayListController::class, 'video'])->name('video.playlist.view')->middleware(['permission:video.playlist.view']);
Route::get('/video-playlist-show-content/{id}', [PlayListController::class, 'showVideoContentList'])->name('video.playlist.contentlist')->middleware(['permission:video.playlist.contentlist.view']);
Route::get('/video-playlist-list', [PlayListController::class, 'videoList'])->name('video.playlist.videolist');
Route::get('/video-playlist-create', [PlayListController::class, 'createVideoPlayList'])->name('video.playlist.create')->middleware(['permission:video.playlist.create']);
Route::post('/video-playlist-store', [PlayListController::class, 'storeVideoPlayList'])->name('video.playlist.store');
Route::get('/video-playlist-edit/{name}', [PlayListController::class, 'VideoPlaylistEdit'])->name('video.playlist.edit')->middleware(['permission:video.playlist.edit']);
Route::post('/video-playlist-update', [PlayListController::class, 'VideoPlaylistUpdate'])->name('video.playlist.update');
Route::delete('/video-playlist-delete/{id}', [PlayListController::class, 'destroyVideoPlayList'])->name('video.playlist.delete')->middleware(['permission:video.playlist.destroy']);
Route::get('/video-playlist-choosing', [PlayListController::class, 'addVideoPlayList'])->name('video.playlist.choose');

// Playlist Management for Image
Route::get('/image-playlist-view', [PlayListController::class, 'image'])->name('image.playlist.view')->middleware(['permission:image.playlist.view']);
Route::get('/image-playlist-show-content/{id}', [PlayListController::class, 'showImageContentList'])->name('image.playlist.contentlist')->middleware(['permission:image.playlist.contentlist.view']);
Route::get('/image-playlist-create', [PlayListController::class, 'createImagePlayList'])->name('image.playlist.create')->middleware(['permission:image.playlist.create']);
Route::post('/image-playlist-store', [PlayListController::class, 'storeImagePlayList'])->name('image.playlist.store');
Route::get('/image-playlist-edit/{name}', [PlayListController::class, 'ImagePlaylistEdit'])->name('image.playlist.edit')->middleware(['permission:image.playlist.edit']);
Route::post('/image-playlist-update', [PlayListController::class, 'updateImagePlayList'])->name('image.playlist.update');
Route::delete('/image-playlist-delete/{id}', [PlayListController::class, 'destroyImagePlayList'])->name('image.playlist.delete')->middleware(['permission:image.playlist.destroy']);

// Template Management
Route::get('/template', [TemplateListController::class, 'list'])->name('template.list.view');
Route::post('/template-create', [TemplateListController::class, 'create'])->name('template.create');
// Route::get('/template-contents/{id}', [TemplateListController::class, 'edit'])->name('template.edit');
Route::get('/template-contents/{id}', [TemplateListController::class, 'item'])->name('template.edit');
Route::post('/template-contents', [TemplateListController::class, 'update'])->name('template.update');


// Route::get('/template', [TemplateListController::class, 'index'])->name('template.view')->middleware(['permission:template.view']);
Route::get('/fullscreen-template-list', [TemplateListController::class, 'fullScreenTemplate'])->name('template.fullscreen.view')->middleware(['permission:template.fullscreen.view']);
Route::get('/fullscreen-template-create', [TemplateListController::class, 'fullScreenTemplateCreate'])->name('template.fullscreen.create')->middleware(['permission:template.fullscreen.create']);
Route::get('/fullscreen-template-edit/{id}', [TemplateListController::class, 'fullScreenTemplateEdit'])->name('template.fullscreen.edit')->middleware(['permission:template.fullscreen.edit']);




Route::get('/rsf-template-list', [TemplateListController::class, 'RSFTemplate'])->name('template.rsf.view');

// Profile
Route::get('/profile', [ProfileController::class, 'profileView'])->middleware('auth')->name('profile.view');
Route::post('/profile', [ProfileController::class, 'profileUpdate'])->middleware('auth')->name('profile.update');

// User Profile
Route::get('/user-profile', [ProfileController::class, 'index'])->name('user-profile');
Route::get('/user-profile-edit', [ProfileController::class, 'edit'])->name('user-profile.edit');
Route::post('/user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::get('/user-profile-edit-change-password', [ProfileController::class, 'changePasswordView'])->name('user-profile.edit.change.password');
Route::post('/user-profile-edit-change-password', [ProfileController::class, 'changePassword']);

// User Management
Route::get('/user-management', [UserController::class, 'index'])->middleware('permission:user.view')->name('user-management');
Route::get('/users', [UserController::class, 'loadUsers'])->middleware('auth')->name('users');
Route::post('add-user', [UserController::class, 'addUser'])->middleware('permission:user.create')->name('add.user');
Route::get('/user/{id}', [UserController::class, 'loadUser'])->middleware('auth')->name('user');
Route::post('edit-user', [UserController::class, 'edit'])->middleware('permission:user.edit')->name('edit.user');
Route::post('/delete-user', [UserController::class, 'deleteUser'])->middleware('permission:user.destroy')->name('delete.user');

Route::middleware(['role:Admin'])->group(function () {
    // Permision group
    Route::get('/permission-group-create', [PermissionGroupController::class, 'create'])->name('permission.group.create');
    Route::get('/permission-group-list-data', [PermissionGroupController::class, 'listData'])->name('permission.group.list.data');
    Route::post('/permission-group-add', [PermissionGroupController::class, 'store'])->name('permission.group.store');
    Route::get('/permission-group-edit/{id}', [PermissionGroupController::class, 'edit'])->name('permission.group.edit');
    Route::put('/permission-group-edit/{id}', [PermissionGroupController::class, 'update'])->name('permission.group.update');
    Route::delete('/permission-group-delete/{id}', [PermissionGroupController::class, 'destroy'])->name('permission.group.destroy');

    // Permission
    Route::get('/permission-list', [PermissionController::class, 'index'])->name('permission.list');
    Route::get('/permission-list-data', [PermissionController::class, 'listData'])->name('permission.list.data');
    Route::get('/permission-create', [PermissionController::class, 'create'])->name('permission.create.view');
    Route::post('/permission-create', [PermissionController::class, 'store'])->name('permission.create');
    Route::get('/permission-edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permission-edit/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permission-delete/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    // Role
    Route::get('/role-list', [RoleController::class, 'index'])->name('admin.roles');
    Route::get('/roles-create', [RoleController::class, 'create'])->name('admin.roles.create.view');
    Route::post('/roles-create', [RoleController::class, 'store'])->name('admin.roles.create');
    Route::get('/role-edit/{id}', [RoleController::class, 'edit'])->name('admin.roles.edit.view');
    Route::put('/role-edit/{id}', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('/role-delete/{id}', [RoleController::class, 'destroy'])->name('admin.roles.destroy');
});

Route::get('/template-list-screenwise/{param1}/{param2}/{param3}/{param4}', [TemplateListController::class, 'screenwise'])->name('template.screenwise');
Route::get('/template-list-datalist', [TemplateListController::class, 'dataList'])->name('template.dataList');
// Route::get('/template-list-create', [TemplateListController::class, 'create'])->name('template.create');
Route::get('/template-create-list', [TemplateListController::class, 'createList'])->name('template.createList');
Route::post('/template-list-store', [TemplateListController::class, 'store'])->name('template.store');
// Route::get('/template-list-edit/{id}', [TemplateListController::class, 'edit'])->name('template.edit');
// Route::post('/template-list-update/{id}', [TemplateListController::class, 'update'])->name('template.update');
Route::delete('/template-list-delete/{id}', [TemplateListController::class, 'destroy'])->name('template.delete')->middleware(['permission:template.fullscreen.destroy']);
Route::get('/get-playlist-type', [TemplateListController::class, 'get_playlist_type'])->name('get.playlist.type');



Route::post('/upload', [ContentController::class, 'upload_all'])->name('upload.store');
Route::get('/weather', [AppController::class, 'getWeather']);
Route::get('/digital-clock-1', [AppController::class, 'digital_clock_1']);
Route::get('/digital-clock-2', [AppController::class, 'digital_clock_2']);
Route::get('/digital-clock-3', [AppController::class, 'digital_clock_3']);
Route::get('/weather', [AppController::class, 'weather']);
Route::get('/banner/{app_id}', [AppController::class, 'banner']);

Route::post('assign-device', [TemplateListController::class, 'assign_device']);
