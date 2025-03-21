<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WarehousesController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\TownshipController;
use App\Http\Controllers\Api\StatusesController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\StudentsController;

// api route ကို ခေါ်ပါက http://127.0.0.1:8000/api/warehouses ဟုပြန်ခေါ်ပေးရမည်
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// REST FUll ARI ထုတ်နည်း 

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {   // sanctum ကို မသုံးဘူး 
//     return $request->user();

//     // third parameter ထဲတွင် naming ပေးလိုက်ချင်းဖြင့် error ဖေျာက်နုိင်သည် alias ပေးလိုက်ခြင်းဖြစ်သည်
//     // Route::apiResource("warehouses", WarehousesController::class,["as"=>"api"]);
//     // // custom api route

//     // Route::get("/warehousesstatus",[WarehousesController::class,"warehousesstatus"]);
// });

// php artisan route:cache (error)
// Route::apiResource("warehouses", WarehousesController::class);

// third parameter ထဲတွင် naming ပေးလိုက်ချင်းဖြင့် error ဖေျာက်နုိင်သည် alias ပေးလိုက်ခြင်းဖြစ်သည်


Route::post("/register",[AuthController::class,"register"]);
Route::post("/login",[AuthController::class,"login"]);

Route::post("/logout",[AuthController::class,"logout"]) -> middleware("auth:api");  // log out လုပ်လျှင် middle ware ထဲထည့်ပေးရတော့မယ


                // api သည် passport မှ လာသည်
Route::middleware("auth:api")->group(function(){

 

    Route::apiResource("warehouses", WarehousesController::class,["as"=>"api"]);

});

// Route::apiResource("warehouses", WarehousesController::class,["as"=>"api"]);

// // custom api route

Route::get("/warehousesstatus",[WarehousesController::class,"warehousesstatus"]);

Route::apiResource("cities", CitiesController::class,["as"=>"api"]);
Route::get("/citiesstatus",[CitiesController::class,"citiesstatus"]);
Route::get("/filter/cities/{filter}",[CitiesController::class,"filterbycountryid"])->name("cities.filterbycountryid"); // filter by dynamic select country id

Route::apiResource("townships",TownshipController::class,["as" => "api"]);
Route::get("/townshipsstatus",[TownshipController::class,"townshipsstatus"]);
Route::get("/filter/townships/{filter}",[TownshipController::class,"filterbycityid"])->name("townships.filterbycityid");


Route::apiResource("statuses",StatusesController::class,['as'=>'api']);
Route::get("/statusessearch", [StatusesController::class,"search"]);


Route::get("/leadsdashboard",[LeadsController::class,"dashboard"])->name("dashboards.leadssources");
Route::get("/userdashboard",[UsersController::class,"dashboard"])->name("dashboards.userdashboards");
Route::get("/studentdashboard",[StudentsController::class,"dashboard"])->name("dashboards.studentsdashboards");



