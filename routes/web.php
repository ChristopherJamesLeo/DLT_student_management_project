<?php
use App\Http\Controllers\AnnouncementsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryContrller;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\EdulinksController;
use App\Http\Controllers\EnrollsController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StatusesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\StagesController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\RelativesController;
use App\Http\Controllers\TypesController;
use App\Http\Controllers\PostsController;

use App\Http\Controllers\PostsLikeController;
use App\Http\Controllers\UsersFollwerController;

use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PaymentmethodsController;



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



// dashborad ကို middleware ပေးထားလဲ ရသည် 
// route ကို တစ်ခုတည်းပေးမည်ဆိုလျှင် ၍ သို့ရျွေးနိုင်သည် 
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


// auth လုပ်ထားသော သူသာလျှင် middle အတွင်းရှိနေသောသူများအလုပ်လုပ်မည် 
// group လုပ်ပြီးလဲ middleware ၏ permission ပေးမှသာ ဝင်နိုင်မည် 
Route::middleware('auth')->group(function () {

    Route::get("dashboards",[DashboardsController::class,"index"])->name("dashboard.index");

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // log in ဝင်ပြီးမှ အသုံးပြုလို့ရစေချင်သောကြောင့် middleware  ထဲမှာ‌ရေးခြင်းဖြစ်သည် 
    Route::resource("statuses",StatusesController::class);

    Route::resource("announcements",AnnouncementsController::class);

    Route::resource("days",DaysController::class);
    Route::get("daystatus",[DaysController::class,"daystatus"]);


    Route::resource("enrolls",EnrollsController::class);

    Route::resource("edulinks",EdulinksController::class);

    Route::resource("students",StudentsController::class);
    // mail ပို့ရန် route သတ်မှတ်သည် 
    Route::post("compose/mailbox",[StudentsController::class,"mailbox"])->name("students.mailbox");

    Route::resource("roles",RolesController::class);
    Route::get("rolestatus",[RolesController::class,"rolestatus"]);


    Route::resource("cities",CityController::class);
    Route::resource("countries",CountryContrller::class);
    Route::resource("contacts",ContactsController::class);
    Route::resource("comments",CommentsController::class);
    Route::resource("genders",GenderController::class);

    Route::resource("tags",TagsController::class);
    Route::get("tagstatus",[TagsController::class,"tagstatus"]);

    Route::resource("categories",CategoriesController::class);
    Route::get("categoriesstatus",[CategoriesController::class,"categoriesstatus"]);

    Route::resource("types",TypesController::class)->except("destory"); // destory မှ တစ်ပါး ကျန်တာအားလံုး resource ဖြင့်သံုးမည်
    // type ထဲရှိ method ေခါ်ရန်
    Route::get("/typesstatus",[TypesController::class,"typestatus"]);
    Route::get("/typesdelete",[TypesController::class,"destroy"])->name("types.delete");
    // delete ကို ajax ဖြင့် တည်ေဆာက်မည်


    Route::resource("relatives",RelativesController::class);
    Route::get("relativestatus",[RelativesController::class,"relativestatus"]);
    
    Route::resource("posts",PostsController::class);

    // form မှ submt လုပ်ပေးသောကြောင့် post ကို သံုးသည် 
    // post ထဲမှ မည်သည့် post ကို like လုပ်တာလဲ id တောင်းထားမည် 
    Route::post("posts/{post}/like",[PostsLikeController::class,"like"])->name("posts.like");
    Route::post("posts/{post}/unlike",[PostsLikeController::class,"unlike"])->name("posts.unlike");

    // follow လုပ်မည်
    Route::post("users/{user}/follow",[UsersFollwerController::class,"follow"])->name("users.follow");
    Route::post("users/{user}/unfollow",[UsersFollwerController::class,"unfollow"])->name("users.unfollow");

    Route::resource("attendances",AttendancesController::class);

    Route::resource("stages",StagesController::class);
    Route::get("/stagestatus",[StagesController::class,"stagestatus"]);


    Route::resource("leaves",LeavesController::class);
    Route::get("notify/makrasread",[LeavesController::class,"makrasread"])->name("leaves.markasread");
    // route name ပေးပါက default နှင့် မှားနိုင်သည့်အတွက် name အား parameter သံုးခုသံုးသင့်သည် route name ထဲမရှိတဲ့ကောင်အား ကွဲကွဲပြာပြားပေးသင့်သည်

    Route::resource("paymentmethods",PaymentmethodsController::class);
    Route::get("/paymentmethodsstatus",[PaymentmethodsController::class,"paymentmethodsstatus"]);

    
});

require __DIR__.'/auth.php';