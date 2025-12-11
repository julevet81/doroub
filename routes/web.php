<?php

use App\Http\Controllers\AssistanceCategoryController;
use App\Http\Controllers\AssistanceItemController;
use App\Http\Controllers\BeneficeController;
use App\Http\Controllers\BeneficiaryCategoryController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\DemondController;
use App\Http\Controllers\DemondedItemController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\InventoryOutController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\PartnerInfoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectAssistanceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.users.signin');
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
    Route::get('volunteers/statistics', [VolunteerController::class, 'statistics'])->name('volunteers.statistics');
    Route::resource('volunteers', VolunteerController::class);

    ######################## Assistance Categories Routes #########################
    Route::resource('assistance_categories', AssistanceCategoryController::class);

    ######################## Assistance Items Routes #########################
    Route::resource('assistance_items', AssistanceItemController::class);

    ##################### Donations Routes #########################
    Route::resource('donors', DonorController::class);

    ##################### Project Assistances Routes #########################
    Route::resource('project_assistances', ProjectAssistanceController::class);

    ##################### Inventory Transactions Routes #########################
    Route::resource('inventory_transactions', InventoryTransactionController::class);

    Route::resource('inventory_out', InventoryOutController::class);

    ##################### Beneficiary Categories Routes #########################
    Route::resource('beneficiary_categories', BeneficiaryCategoryController::class);

    ##################### Beneficiaries Routes #########################
    Route::get('beneficiaries/statistics', [BeneficiaryController::class, 'statistics'])->name('beneficiaries.statistics');
    Route::get('/get-municipalities/{district_id}', [BeneficiaryController::class, 'getMunicipalities']);
    Route::resource('beneficiaries', BeneficiaryController::class);
    


    ##################### Children Routes #########################
    Route::resource('children', ChildController::class);

    ##################### Financial Transactions Routes #########################
    route::get('financial_transactions/statistics', [FinancialTransactionController::class, 'statistics'])->name('financial.statistics');
    Route::resource('financial_transactions', FinancialTransactionController::class);

    ##################### Expenses Routes #########################
    Route::resource('expenses', ExpenseController::class);

    ##################### Benefices Routes #########################
    Route::resource('benefices', BeneficeController::class);

    ###################### Transaction Items Routes #########################
    Route::resource('transaction_items', TransactionItemController::class);

    ########################## Partner Infos Routes #########################
    Route::resource('partner_infos', PartnerInfoController::class);

    ########################## Demonds Routes #########################
    Route::resource('demonds', DemondController::class);

    ####################### Demonded Items Routes #########################
    Route::resource('demonded_items', DemondedItemController::class);

    ####################### Devices Routes #########################

    Route::get('/devices/loaned', [DeviceController::class, 'loaned'])->name('devices.loaned');
    Route::get('/devices/returned', [DeviceController::class, 'returned'])->name('devices.returned');
    Route::get('/devices/destructed', [DeviceController::class, 'destructed'])
        ->name('devices.destructed');
    Route::put('/devices/{device}/destruct', [DeviceController::class, 'destruct'])
        ->name('devices.destruct');
    Route::get('/devices/{device}/print-form', [DeviceController::class, 'printForm'])
        ->name('devices.printForm');

    Route::post('/devices/{device}/print', [DeviceController::class, 'print'])
        ->name('devices.print');

    Route::resource('devices', DeviceController::class);
    


    ####################### Registrations Routes #########################
    Route::resource('registrations', RegistrationController::class);

    ####################### municipalities Routes #########################

    Route::resource('municipalities', MunicipalityController::class);

    ####################### districts Routes #########################

    Route::resource('districts', DistrictController::class);

    ####################### Users Routes #########################
    Route::resource('users', UserController::class);

    ######################## Roles Routes #########################
    Route::resource('roles', RoleController::class);

    ######################## Loans Routes #########################
    Route::resource('loans', LoanController::class);



});

require __DIR__.'/auth.php';
