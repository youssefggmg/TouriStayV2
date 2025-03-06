<?php

use App\Http\Controllers\ProfileController;
use App\Models\announcmentModel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tourist\tourist;
use App\Http\Controllers\owner\owner;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\admin;
use App\Http\Controllers\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\owner\AnnouncmentController;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', "istourist"])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware("istourist")->group(function () {
    Route::get("/tourist/home/{perpage?}", [tourist::class, "index"]);
    Route::get("/search", [tourist::class, "search"]);
    
    Route::get("/tourist/profile", [tourist::class, "profile"]);
    Route::get("/tourist/editform", [tourist::class, "editForm"]);
    Route::patch("/tourist/edit", [tourist::class, "updateUserInfo"]);
    Route::get('/tourist/invoice/{sessionId}', [InvoiceController::class, 'generateInvoice']);
    Route::get("/tourist/reservations",[tourist::class,"myReservations"]);
});
Route::middleware("isOwner")->group(function () {
    Route::get("/owner/home", [owner::class, "index"]);
    Route::get('/announcments/create', [AnnouncmentController::class, 'create']);
    Route::post('/announcments/store', [AnnouncmentController::class, 'store']);
    Route::get('/announcements/edit/{id}', [AnnouncmentController::class, 'edit']);
    Route::put('/announcements/update/{id}', [AnnouncmentController::class, 'update']);
});
Route::get('/announcements/delete/{id}', [AnnouncmentController::class, 'delete']);
Route::middleware("isAdmine")->group(function(){
    Route::get("/admin/home", [admin::class,"index"]);
    Route::get("/admin/deletedaanoucments", [AnnouncmentController::class,"deletedAnnouncements"]);
    Route::get("/admin/owners", [admin::class,"owners"]);
    Route::patch("/admin/disactive/{id}", [admin::class,"badUser"]);
});

Route::post("/reserv",[Reservation::class,"makeReservation"]);
Route::get("/test",function(){
    dd(announcmentModel::find(1)->owner()->first());
});

require __DIR__ . '/auth.php';
