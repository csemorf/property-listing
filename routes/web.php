<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [UserController::class, 'Index']);
// Route::get('/', function (Request $request) {
//     return view("welcome");
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'EditProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'AdminUpdatePassword'])->name('admin.update.password');

});


Route::middleware(['auth', 'role:agent'])->group(function () {
    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/type', 'AllType')->name("all.type");
        Route::get('/add/type', 'AddType')->name("add.type");
        Route::post('/store/type', 'StoreType')->name("store.type");
        Route::get('/edit/type/{id}', 'EditType')->name("edit.type");
        Route::post('/update/type', 'UpdateType')->name("update.type");
        Route::get('/delete/type/{id}', 'DeleteType')->name("delete.type");
    });
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('/all/amenities', 'AllAmenities')->name("all.amenities");
        Route::get('/add/amenities', 'AddAmenities')->name("add.amenities");
        Route::get('/edit/amenities/{id}', 'EditAmenity')->name("edit.amenities");
        Route::post('/store/amenities', 'StoreAmenity')->name("store.amenities");
        Route::post('/update/amenities', 'UpdateAmenity')->name("update.amenities");
        Route::get('/delete/amenities/{id}', 'DeleteType')->name("delete.amenities");
    });

});