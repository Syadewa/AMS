<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AssetAssignmentController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserAssignmentController;
use App\Http\Controllers\Admin\AssetMutationController;
use App\Http\Controllers\User\UserMutationController;   
use App\Http\Controllers\Manager\ManagerDashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'single.device', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard', [App\Http\Controllers\Admin\AdminDashboardController::class, 'index']);
    

    Route::get('/admin/users/create', [App\Http\Controllers\Admin\UserController::class, 'create']);
    Route::post('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'store']);
    Route::get('/admin/users', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::get('/admin/users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit']);
    Route::put('/admin/users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update']);

    Route::get('/admin/departments/create', [App\Http\Controllers\Admin\DepartmentController::class, 'create']);
    Route::post('/admin/departments', [App\Http\Controllers\Admin\DepartmentController::class, 'store']);
    Route::get('/admin/departments', [App\Http\Controllers\Admin\DepartmentController::class, 'index']);
    Route::get('/admin/departments/{id}/edit', [App\Http\Controllers\Admin\DepartmentController::class, 'edit']);
    Route::put('/admin/departments/{id}', [App\Http\Controllers\Admin\DepartmentController::class, 'update']);
    
    Route::get('/admin/asset-categories/create', [App\Http\Controllers\Admin\AssetCategoryController::class, 'create']);
    Route::post('/admin/asset-categories', [App\Http\Controllers\Admin\AssetCategoryController::class, 'store']);
    Route::get('/admin/asset-categories', [App\Http\Controllers\Admin\AssetCategoryController::class, 'index']);
    Route::get('/admin/asset-categories/{id}/edit', [App\Http\Controllers\Admin\AssetCategoryController::class, 'edit']);
    Route::put('/admin/asset-categories/{id}', [App\Http\Controllers\Admin\AssetCategoryController::class, 'update']);
    Route::delete('/admin/asset-categories/{id}', [App\Http\Controllers\Admin\AssetCategoryController::class, 'destroy']);

    Route::get('/admin/assets/create', [App\Http\Controllers\Admin\AssetController::class, 'create']);
    Route::post('/admin/assets', [App\Http\Controllers\Admin\AssetController::class, 'store']);
    Route::get('/admin/assets', [App\Http\Controllers\Admin\AssetController::class, 'index']);
    Route::get('/admin/assets/{id}', [App\Http\Controllers\Admin\AssetController::class, 'show']);
    Route::get('/admin/assets/{id}/edit', [App\Http\Controllers\Admin\AssetController::class, 'edit']);
    Route::put('/admin/assets/{id}', [App\Http\Controllers\Admin\AssetController::class, 'update']);

    Route::get('admin/assignments', [AssetAssignmentController::class, 'index']);
    Route::get('admin/assignments/create', [AssetAssignmentController::class, 'create']);
    Route::post('admin/assignments', [AssetAssignmentController::class, 'store']);
    Route::put('/admin/assignments/{id}/return', [AssetAssignmentController::class, 'returnAsset']);
    Route::put('/admin/assignments/{id}/accept', [AssetAssignmentController::class, 'accept']);
    Route::put('/admin/assignments/{id}/reject', [AssetAssignmentController::class, 'reject']);

    Route::get('/admin/mutations', [AssetMutationController::class, 'index']);
    Route::get('/admin/mutations/create', [AssetMutationController::class, 'create']);
    Route::post('/admin/mutations', [AssetMutationController::class, 'store']);

    
    Route::get('/admin/maintenances', [App\Http\Controllers\Admin\AssetMaintenanceController::class, 'index']); 
    Route::get('/admin/maintenances/{id}', [App\Http\Controllers\Admin\AssetMaintenanceController::class, 'show']);
    Route::put('/admin/maintenances/{id}/process', [App\Http\Controllers\Admin\AssetMaintenanceController::class, 'process']);
    Route::put('/admin/maintenances/{id}/reject', [App\Http\Controllers\Admin\AssetMaintenanceController::class, 'reject']);
    Route::put('/admin/maintenances/{id}/complete', [App\Http\Controllers\Admin\AssetMaintenanceController::class, 'complete']);

    Route::get('/admin/disposals', [App\Http\Controllers\Admin\AdminAssetDisposalController::class, 'index']);
    Route::get('/admin/disposals/create', [App\Http\Controllers\Admin\AdminAssetDisposalController::class, 'create']);
    Route::post('/admin/disposals', [App\Http\Controllers\Admin\AdminAssetDisposalController::class, 'store']);
    Route::get('/admin/disposals/{id}', [App\Http\Controllers\Admin\AdminAssetDisposalController::class, 'show']);

    Route::get('/admin/reports/', [App\Http\Controllers\Admin\AssetReportController::class, 'index']);
    Route::get('/admin/reports/assets', [App\Http\Controllers\Admin\AssetReportController::class, 'assetReport']);
    Route::get('/admin/reports/maintenances', [App\Http\Controllers\Admin\AssetReportController::class, 'maintenanceReport']);
    Route::get('/admin/reports/disposals', [App\Http\Controllers\Admin\AssetReportController::class, 'disposalReport']
);

});

Route::middleware(['auth', 'single.device', 'role:user'])->group(function(){

    Route::get('/user/dashboard', [UserDashboardController::class, 'index']);

    Route::get('/user/assets',[App\Http\Controllers\User\UserAssetController::class, 'index']);
    Route::get('/user/assets/{id}',[App\Http\Controllers\User\UserAssetController::class, 'show']);

    Route::get('/user/assignments', [UserAssignmentController::class, 'index']);
    Route::put('/user/assignments/{id}/accept', [UserAssignmentController::class, 'accept'])->name('user.assignments.accept');
    Route::put('/user/assignments/{id}/reject', [UserAssignmentController::class, 'reject'])->name('user.assignments.reject');

    Route::get('/user/mutations', [UserMutationController::class, 'index']);
    Route::put('/user/mutations/{id}/accept', [UserMutationController::class, 'accept']);
    Route::put('/user/mutations/{id}/reject', [UserMutationController::class, 'reject']);

    Route::get('/user/maintenances', [App\Http\Controllers\User\UserMaintenanceController::class, 'index']);
    Route::get('/user/maintenances/create', [App\Http\Controllers\User\UserMaintenanceController::class, 'create']);
    Route::post('/user/maintenances', [App\Http\Controllers\User\UserMaintenanceController::class, 'store']);
    Route::get('/user/maintenances/{id}', [App\Http\Controllers\User\UserMaintenanceController::class, 'show']);

    
    

});

Route::middleware(['auth', 'single.device', 'role:manager'])->group(function(){

    Route::get('/manager/dashboard',[ManagerDashboardController::class, 'index']);
   

    Route::get('/manager/disposals', [App\Http\Controllers\Manager\ManagerAssetDisposalController::class, 'index']);
    Route::get('/manager/disposals/{id}', [App\Http\Controllers\Manager\ManagerAssetDisposalController::class, 'show']);
    Route::put('/manager/disposals/{id}/approve', [App\Http\Controllers\Manager\ManagerAssetDisposalController::class, 'approve']);
    Route::put('/manager/disposals/{id}/reject', [App\Http\Controllers\Manager\ManagerAssetDisposalController::class, 'reject']);


});

Route::middleware(['auth', 'single.device'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    /*Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');*/
});

Route::middleware(['auth', 'single.device'])->group(function () {
    
    // Pindahkan route scan ke sini agar semua karyawan yang login bisa akses!
    Route::get('/assets/detail/{id}', [App\Http\Controllers\Admin\AssetController::class, 'showPublic']);
    
    // Route halaman user biasa lainnya...
});

require __DIR__.'/auth.php';
