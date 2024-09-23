<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\WarehousesController;
use App\Http\Controllers\Api\CitiesController;
use App\Http\Controllers\Api\StatusesController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// php artisan route:cache (error)
// Route::apiResource("warehouses", WarehousesController::class);

// third parameter ထဲတွင် naming ပေးလိုက်ချင်းဖြင့် error ဖေျာက်နုိင်သည် alias ပေးလိုက်ခြင်းဖြစ်သည်
Route::apiResource("warehouses", WarehousesController::class,["as"=>"api"]);
// custom api route

Route::get("/warehousesstatus",[WarehousesController::class,"warehousesstatus"]);

Route::apiResource("cities", CitiesController::class,["as"=>"api"]);
Route::get("/citiesstatus",[CitiesController::class,"citiesstatus"]);
Route::get("/filter/cities/{filter}",[CitiesController::class,"filterbycountryid"])->name("cities.filterbycountryid"); // filter by dynamic select country id

Route::apiResource("statuses",StatusesController::class,['as'=>'api']);
Route::get("/statusessearch", [StatusesController::class,"search"]);
