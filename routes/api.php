<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminTypeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\EmployeeTypeController;
use App\Http\Controllers\Api\FinanceItemController;
use App\Http\Controllers\Api\InnerTransactionController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\API\InvoiceItemController;
use App\Http\Controllers\Api\LogicPaysController;
use App\Http\Controllers\Api\LogisticTeamController;
use App\Http\Controllers\Api\MoneyTransfareController;
use App\Http\Controllers\Api\NoteController;
use App\Http\Controllers\Api\OuterTransactionController;
use App\Http\Controllers\Api\PhoneController;
use App\Http\Controllers\Api\ReportsController;
use App\Http\Controllers\Api\SocialmediaTypeController;
use App\Http\Controllers\Api\TechnicalTeamController;
use App\Http\Controllers\Api\TechPaysController;
use App\Http\Controllers\Api\TresureController;
use App\Http\Controllers\Api\TresureFundController;
use App\Http\Controllers\Api\WorkshopController;
use App\Http\Controllers\Api\WorkshopEmployeeController;
use App\Http\Controllers\Api\WorkshopLogisticController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

Route::get('/user', function (Request $request) {
  return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/data/admin', AdminController::class);
Route::apiResource('/data/admintype', AdminTypeController::class);
Route::apiResource('/data/employee', EmployeeController::class);
Route::apiResource('/data/employeetype', EmployeeTypeController::class);
Route::apiResource('/data/customer', CustomerController::class);
Route::apiResource('/data/financeitem', FinanceItemController::class);
Route::apiResource('/data/department', DepartmentController::class);
Route::apiResource('/data/socialmediatype', SocialmediaTypeController::class);
Route::apiResource('/data/phone', PhoneController::class);
Route::get('/data/phones', [PhoneController::class, 'getphonetypes']);
Route::apiResource('/data/note', NoteController::class);
Route::apiResource('/data/inventory', InventoryController::class);

Route::get('/data/tresure', [DataController::class, 'gettresureselector']);
Route::apiResource('/data/workshop', WorkshopController::class);
Route::apiResource('/data/moneytransfare', MoneyTransfareController::class);


Route::apiResource('/data/innertrans', InnerTransactionController::class);
Route::apiResource('/data/outertrans', OuterTransactionController::class);
Route::apiResource('/data/workshopre/employee', WorkshopEmployeeController::class);
Route::get('/data/workshopre/getemployee/{id}', [WorkshopEmployeeController::class, 'showbefore']);
Route::apiResource('/data/workshopre/logistic', WorkshopLogisticController::class);
Route::get('/data/workshopre/getlogistic/{id}', [WorkshopLogisticController::class, 'showbefore']);

// tresures
Route::get('/data/admin/tresure/{id}', [TresureController::class, 'getadmintresure']);
Route::get('/data/workshop/tresure/{id}', [TresureController::class, 'getworkshoptresure']);
Route::get('/data/customer/tresure/{id}', [TresureController::class, 'getcustomertresure']);
Route::get('/data/employee/tresure/{id}', [TresureController::class, 'getemployeetresure']);
Route::get('/data/office/tresure/{id}', [TresureController::class, 'getOfficetresure']);
Route::get('/data/deposit/tresure/{id}', [TresureController::class, 'getDeposittresure']);
Route::get('/data/tresurefund/{id}', [DataController::class, 'getTresureFunds']);

Route::get('/data/tresures-type', [TresureController::class, 'getTresureByType']);
// get users by type
Route::get('/data/users/by-type/{type}', [TresureController::class, 'getUsersByType']);
//get tresures by user
Route::get('/data/tresures/by-user/{user_id}/{type}', [TresureController::class, 'getTresuresByUser']);
//get tresures funds by tresure
Route::get('/data/tresure-funds/{tresure_id}', [TresureFundController::class, 'getTresureFundsByTresureId']);

Route::post('/data/tresure', [TresureController::class, 'store']);
Route::get('/data/tresure/{tresure}', [TresureController::class, 'show']);
Route::put('/data/tresure/{tresure}', [TresureController::class, 'update']);
Route::delete('/data/tresure/{tresure}', [TresureController::class, 'destroy']);


// tresureFunds
Route::get('/data/tresure_funds', [TresureFundController::class, 'index']);
Route::post('/data/tresure_funds', [TresureFundController::class, 'store']);
Route::get('/data/tresure_funds/{tresureFund}', [TresureFundController::class, 'show']);
Route::put('/data/tresure_funds/{tresureFund}', [TresureFundController::class, 'update']);
Route::delete('/data/tresure_funds/{tresureFund}', [TresureFundController::class, 'delete']);


// Invoices
Route::apiResource('/data/invoices', InvoiceController::class);

Route::post('/data/invoices-image/{invoice}', [InvoiceController::class, 'storeInvoiceImage']);
Route::get('/data/invoices-images/{type}', [InvoiceController::class, 'getAllInvoicesImages']);
Route::delete('/data/invoices-image/{image}', [InvoiceController::class, 'deleteInvoiceImage']);
Route::get('/data/invoices-image/{image}', [InvoiceController::class, 'showInvoiceImage']);
Route::get('/data/invoices-images/download/{image}', [InvoiceController::class, 'downloadInvoiceImage']);
// TechPays
Route::apiResource('/data/tech-pays', TechPaysController::class);
// LogicPays
Route::apiResource('/data/logic-pays', LogicPaysController::class);
// InvoiceItems
Route::apiResource('/data/invoice-items', InvoiceItemController::class);


// Reports
Route::get('/data/report/workshop/itemreport', [ReportsController::class, 'getItemsReport']);


// TechnicalTeam
Route::get('/data/technical-teams', [TechnicalTeamController::class, 'index']);
// LogisticTeam
Route::get('/data/logic-teams', [LogisticTeamController::class, 'index']);




Route::get('/data/socialmedia', [DataController::class, 'getsocials']);
Route::get('/data/technical', [DataController::class, 'gettech']);
Route::get('/data/logistey', [DataController::class, 'getlogi']);
Route::get('/data/employeepay', [DataController::class, 'getemployeepay']);
Route::get('/data/technicalpay', [DataController::class, 'gettechpay']);
Route::get('/data/logisteypay', [DataController::class, 'getlogipay']);
Route::get('/data/moneytrans', [DataController::class, 'getmoneytrans']);
Route::get('/data/inntrans', [DataController::class, 'getinntrans']);
Route::get('/data/outtrans', [DataController::class, 'getouttrans']);
Route::get('/data/home', [DataController::class, 'home']);


// Mobile

Route::get('/mobile/workshops', [WorkshopController::class, 'index']);
Route::get('/mobile/logisticteams', [LogisticTeamController::class, 'index']);

Route::get('/migrate-and-seed', function () {
  Artisan::call('migrate:fresh --seed');
  return response()->json(['message' => 'Database migrated and seeded successfully!']);
});

// Route::get('/data/workshop',[DataController::class,'getworkshop']);
// Route::get('/data/tresure',[DataController::class,'gettresure']);
// Route::get('/data/tresurefund',[DataController::class,'gettresurefund']);
// // Route::get('/data/note',[DataController::class,'getnote']);
// Route::get('/data/invoice',[DataController::class,'getinvoice']);
// Route::get('/data/invoiceitem',[DataController::class,'getinvoiceitem']);
// Route::get('/data/financeitem',[DataController::class,'getfinanceitem']);