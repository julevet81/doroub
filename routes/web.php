<?php

use App\Http\Controllers\AssistanceCategoryController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.users.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard.index');

Route::get('/test', [TestController::class, 'index'])->middleware(['auth', 'verified'])->name('test');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    ######################## Projects Routes #########################
    Route::resource('projects', ProjectController::class);

    ######################## Volunteers Routes #########################

    Route::resource('volunteers', VolunteerController::class);

    ######################## Assistance Categories Routes #########################
    Route::resource('assistance_categories', AssistanceCategoryController::class);

    ######################## Assistance Items Routes #########################
    Route::resource('assistance_items', \App\Http\Controllers\AssistanceItemController::class);

    ##################### Donations Routes #########################
    Route::resource('donors', DonorController::class);

    ##################### Project Assistances Routes #########################
    Route::resource('project_assistances', \App\Http\Controllers\ProjectAssistanceController::class);

    ##################### Inventory Transactions Routes #########################
    Route::resource('inventory_transactions', \App\Http\Controllers\InventoryTransactionController::class);

    ##################### Beneficiary Categories Routes #########################
    Route::resource('beneficiary_categories', \App\Http\Controllers\BeneficiaryCategoryController::class);

    
    


    


});

require __DIR__.'/auth.php';
