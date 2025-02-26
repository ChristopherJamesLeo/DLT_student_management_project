<?php

use App\Http\Controllers\Auth\RegisteredUserController;

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
use App\Http\Controllers\OtpsController;
use App\Http\Controllers\PostsController;

use App\Http\Controllers\PostsLikeController;
use App\Http\Controllers\UsersFollwerController;
use App\Http\Controllers\SocialapplicationsController;
use App\Http\Controllers\AttendancesController;
use App\Http\Controllers\LeavesController;
use App\Http\Controllers\PaymentmethodsController;
use App\Http\Controllers\PaymenttypesController;
use App\Http\Controllers\WarehousesController;

use App\Http\Controllers\RegionsController;
use App\Http\Controllers\TownshipsController;



use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PostLiveViewersController;

use App\Http\Controllers\PostViewDurationsController;
use App\Http\Controllers\SubscriptionsController;

use App\Http\Controllers\PackagesController;

use App\Http\Controllers\UserPointsController;

use App\Http\Controllers\PlansController;

use App\Http\Controllers\CartsController;
use App\Http\Controllers\PointTransfersController;
use App\Http\Controllers\ReligionsController;

use App\Http\Controllers\StudentPhonesController;

use App\Http\Controllers\LeadsController;

use App\Http\Controllers\RoleUserController;

use App\Http\Controllers\PermissionRolesController;

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


Route::get("/register/step1",[RegisteredUserController::class,'createstep1'])->name("register.step1");
Route::post("/register/step1",[RegisteredUserController::class,'storestep1'])->name("register.storestep1");
//                                                                                                                                        middleware alias name : parameter ( ပါရာကို ကြိုက်နှငစ်သက်ရာ နမည်ပေးနိုင်သည် )
Route::get("/register/step2",[RegisteredUserController::class,'createstep2'])->name("register.step2")->middleware("check.registration.step:step2");
Route::post("/register/step2",[RegisteredUserController::class,'storestep2'])->name("register.storestep2");

Route::get("/register/step3",[RegisteredUserController::class,'createstep3'])->name("register.step3")->middleware("check.registration.step:step3");
Route::post("/register/step3",[RegisteredUserController::class,'storestep3'])->name("register.storestep3");

// auth လုပ်ထားသော သူသာလျှင် middle အတွင်းရှိနေသောသူများအလုပ်လုပ်မည်
// group လုပ်ပြီးလဲ middleware ၏ permission ပေးမှသာ ဝင်နိုင်မည်

//Route::middleware('auth')->group(function () {  // auth တစ်ခုဘဲစစ်ပြီး page ထဲဝင်မည်
Route::middleware(["auth","autologout","verified"])->group(function () {  // email အ;ာ verify လုပ်ပြီးမှ page ထဲဝင်ခိုင်းမည် // custom ၇ေးထားသော autologout အား web ထဲ တွင် invoke လုပ်ရမည် 
    // role:Admin တွင် Admin သည် Db ထဲရှိ name အတိုင်းထည့်ပေးရမည်
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
    Route::put("/enrolls/{id}/updatestage",[EnrollsController::class,"updatestage"])->name("enrlls.updatestage");

    // search
    Route::resource("edulinks",EdulinksController::class);
    Route::get("/edulinks/download/{id}",[EdulinksController::class,"download"])->name("edulinks.download");


    Route::resource("students",StudentsController::class);
    Route::get("/studentphone/delete/{id}",[StudentPhonesController::class,"destory"])->name("studentsphone.delete");
    // mail ပို့ရန် route သတ်မှတ်သည်
    Route::post("compose/mailbox",[StudentsController::class,"mailbox"])->name("students.mailbox");
    // search route
    Route::post("/students/quicksearch",[StudentsController::class,"quicksearch"])->name("students.quicksearch");

    Route::resource("roles",RolesController::class);
    Route::resource("roleusers",RoleUserController::class);
    Route::resource("permissionroles",PermissionRolesController::class);
    Route::get("rolestatus",[RolesController::class,"rolestatus"]);


    Route::resource("cities",CityController::class);

    // bulk delete
    Route::delete("citiesbulkdeletes",[CityController::class,"bulkdelete"])->name("cities.bulkdelete");

    Route::resource("countries",CountryContrller::class);
    Route::get("countrystatus",[CountryContrller::class,"typestatus"]);

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

    // OTP
    Route::post("/generateotps",[OtpsController::class,"generate"]); // post method ကိုverify မလုပ်ပေ
    Route::post("/verifyotps",[OtpsController::class,"verify"]);


    // Route::middleware(["role:Admin,Teacher"])->group(function(){
    //     Route::resource("posts",PostsController::class);
    // });

    Route::middleware(["role:Admin,Teacher"])->group(function(){
        // Route::resource("posts",PostsController::class);
        // Route::resource("posts",PostsController::class);
        Route::get("/posts",[PostsController::class,"index"])->name("posts.index");
        Route::get("/posts/create",[PostsController::class,"create"])->name("posts.create");
        Route::post("/posts",[PostsController::class,"store"])->name("posts.store");
        Route::get("/posts/{id}",[PostsController::class,"show"])->name("posts.show");
        Route::get("/posts/{id}/edit",[PostsController::class,"edit"])->name("posts.edit");
        Route::put("/posts/{id}",[PostsController::class,"update"])->name("posts.update");
        Route::delete("/posts/{id}",[PostsController::class,"destroy"])->name("posts.destroy");
 
        
    });


    // form မှ submt လုပ်ပေးသောကြောင့် post ကို သံုးသည်
    // post ထဲမှ မည်သည့် post ကို like လုပ်တာလဲ id တောင်းထားမည်
    Route::post("posts/{post}/like",[PostsLikeController::class,"like"])->name("posts.like");
    Route::post("posts/{post}/unlike",[PostsLikeController::class,"unlike"])->name("posts.unlike");

    // follow လုပ်မည်
    Route::post("users/{user}/follow",[UsersFollwerController::class,"follow"])->name("users.follow");
    Route::post("users/{user}/unfollow",[UsersFollwerController::class,"unfollow"])->name("users.unfollow");

    // Route::resource("attendances",AttendancesController::class);

    Route::resource("stages",StagesController::class);
    Route::get("/stagestatus",[StagesController::class,"stagestatus"]);


    Route::resource("socialapplications",SocialapplicationsController::class);
    Route::get("/socialapplicationstatus",[SocialapplicationsController::class,"socialapplicationstatus"]);
    Route::get("/socialapplicationfatchalldatas",[SocialapplicationsController::class,"fatchalldates"])->name("socialapplications.fatchalldatas");


    Route::resource("leaves",LeavesController::class);
    Route::put("/leaves/{id}/updatestage",[LeavesController::class,"updatestage"])->name("leaves.updatestage");
    Route::get("notify/makrasread",[LeavesController::class,"makrasread"])->name("leaves.markasread");
    // route name ပေးပါက default နှင့် မှားနိုင်သည့်အတွက် name အား parameter သံုးခုသံုးသင့်သည် route name ထဲမရှိတဲ့ကောင်အား ကွဲကွဲပြာပြားပေးသင့်သည်

    Route::resource("paymentmethods",PaymentmethodsController::class);
    Route::get("/paymentmethodsstatus",[PaymentmethodsController::class,"paymentmethodsstatus"]);

    Route::resource("paymenttypes",PaymenttypesController::class);
    Route::get("/paymenttypesstatus",[PaymenttypesController::class,"paymenttypesstatus"]);

    Route::resource("warehouses",WarehousesController::class);
    Route::get("/warehousesstatus",[WarehousesController::class,"warehousesstatus"]);
    Route::get("/warehousesfatchalldatas",[WarehousesController::class,"fatchalldates"])->name("warehouses.fatchalldatas");

    // pusher outer route
    Route::get("/pushers",function(){
        return view("pushers");
    });

    Route::get("/chatboxs",function(){
        return view("chatbox");
    });


    // pusher chat event
    Route::post("/chatmessage",[ChatsController::class, "sendmessage"]);

    // request ဖြင့် တောင်းထားတာမဟုတ်ဘဲ post ဖြင့် တောင်းထားသောကြောင့် variable name ဖြစ်သော post ဖြစ်သာ ေခါ်ပေးရမည် ဖြစ်သ်ည
    Route::post("/postliveviewersinc/{post}",[PostLiveViewersController::class,"incrementviewer"]);
    Route::post("/postliveviewerdec/{post}",[PostLiveViewersController::class,"decrementviewer"]);


    // post page ထဲ view duration ဘယ်လောက်ရှိလဲ ကြည့်နိုင်ရန်
    Route::post("/trackduration",[PostViewDurationsController::class,"trackduration"]);
    // အလိုအလျောက်လုပ်ဆောင်ပေးနိုင်ရန် Middle ware တစ်ခုဖန်တီးရန် လိုအပ်လာသည်


    // package သတ်မှတ်ရန်
    Route::get("/subscribesexpired",[SubscriptionsController::class,"expire"])->name("subscription.expired");
    Route::resource("/packages",PackagesController::class);
    Route::post("/packages/setpackage",[PackagesController::class,"setpackage"])->name('packages.setpackage');

    // User point သက်မှတ်ရန်
    Route::resource("userpoints",UserPointsController::class);
    Route::post("/userpoints/verifystudents",[UserPointsController::class,"verifystudents"])->name('userpoints.verifystudents');

    // plans ဝယ်ရန်
    Route::resource("plans",PlansController::class);

    //carts
    Route::get("/carts",[CartsController::class,'index'])->name('carts.index');
    Route::post("/carts/add",[CartsController::class,"add"])->name('carts.add');
    Route::post("/carts/remove",[CartsController::class,"remove"])->name('carts.remove');
    Route::post("/carts/paybypoints",[CartsController::class,"paybypoints"])->name('carts.paybypoints');
    // Route::post("/carts/testing",[CartsController::class,"testing"])->name('carts.testing');


    // point transfers
    Route::resource("pointtransfers",PointTransfersController::class);
    Route::post("/pointtransfers/transfer",[PointTransfersController::class,"transfers"])->name('pointtransfers.transfers');

    Route::resource("/regions",RegionsController::class);
    Route::get("/regionsstatus",[RegionsController::class,"regionsstatus"]);

    Route::resource("/townships",TownshipsController::class);
    Route::get("/townshipsstatus",[TownshipsController::class,"townshipsstatus"]);
    Route::get("/filter/regions/{filter}",[TownshipsController::class,"filterbycityid"]);

    Route::resource("/religions",ReligionsController::class);
    Route::get("/religionsstatus",[ReligionsController::class,"religionsstatus"]);

    Route::resource("/leads",LeadsController::class);
    Route::post("/leads/pipelines/{id}",[LeadsController::class,"converttostudent"])->name('leads.converttostudent');


});


// login လည်း ဝင်ရမည် middleware ကကောင်ကိုလဲ if မှ return ပေးမှာသာ Attendance route အလုပ်လုပ်မည် // if မှ condition ှားပါက expire page ကို ညွန်းမည်ဖြစ်သည်
Route::middleware(['auth','validate.subscriptions'])->group(function(){
    Route::resource("attendances",AttendancesController::class);
});


Route::middleware(["auth","role:Admin"])->group(function(){
    
});





require __DIR__.'/auth.php';


// php artisan route:clear
// php aritsan route:cache
// php artisan config:clear
// php artisan config:cache
// php artisan optimize


// API ထုတ်ရန်
// php artisan make:resource WarehousesResource  // resource file ဖန်တီးကေးရမည်
