<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController; // Fixed: Updated from 'DashbordController' to 'DashboardController'
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ArticleController; // Fixed: Updated from 'ArticalContoller' to 'ArticleController'
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CompanyDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\JobAlertController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::resource('/dashboard',DashboardController::class)->middleware('auth');

// Routes for different user types
Route::get('/company/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard')->middleware('auth');
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->middleware('auth');

// Route::get('/dashboard', function () {
//     return view('dashboard-new', [
//         'header' => 'لوحة التحكم',
//     ]);
// })->middleware('auth')
// ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('companies', CompanyController::class)->middleware('auth');
Route::resource('jobs', JobController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('jobs.applications', ApplicationsController::class);
});
Route::patch('/applications/{application}/status/{status}', [ApplicationsController::class, 'updateStatus'])->name('applications.updateStatusRoute');

Route::resource('articles', ArticleController::class)->middleware('auth'); 
Route::resource('saved-jobs', SavedJobController::class)->middleware('auth');
Route::delete('/saved-jobs/by-job/{jobId}', [SavedJobController::class, 'destroyByJob'])->name('saved-jobs.destroy-by-job');
Route::resource('job-alerts', JobAlertController::class)->middleware('auth');
Route::patch('/jobs/{job}/save', [JobController::class, 'saveJob'])->name('jobs.save');
Route::patch('/jobs/{job}/status', [JobController::class, 'toggleStatus'])->name('jobs.toggleStatus');
Route::resource('notifications', NotificationController::class)->middleware('auth');
Route::patch('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
Route::patch('/notifications/{id}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
Route::delete('/notifications/destroy-all', [NotificationController::class, 'destroyAll'])->name('notifications.destroy-all');
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->middleware('auth');
Route::get('/company/dashboard', [CompanyDashboardController::class, 'index'])->name('company.dashboard')->middleware('auth');



require __DIR__.'/auth.php';
