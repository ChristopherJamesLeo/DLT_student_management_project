{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends("layouts.adminindex")
@section("css")
<style>
.nav {
    display: flex;
    padding: 0;
    margin: 0;

}
.nav .nav-item {
    list-style: none;
}
.nav .tablinks {
    padding: 14px 16px;
    border: none;
    outline: none;
    cursor: pointer;
    transition: all 0.3s ease 0s;
}

.nav .tablinks:hover {
    background-color: #f3f3f3;
}
.nav .tablinks.active {
    color: blue;
}

.tab-pane {
    padding: 6px 12px;
    display: none;
}
.accordion {
    width: 100%;
}
.acctitle {
    font-size: 13px;
    padding: 5px;
    margin: 0px;

    cursor: pointer;
    user-select: none;
    transition: all 0.1s ease 0s;

    position: relative;
}
.acctitle i{
    margin-right: 10px;
}
.acctitle::after{
    content: "\f0e0";
    font-family: "Font Awesome 5 Free";
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    transition: all 0.5s ease-in 0s;
}
.acctitle:hover , .shown{
    /* background-color: #4682b4; */
}
.accordion.shown .acctitle {
    /* background-color: #4682b4; */
}
.accortent{
    height: 0;
    background-color: #f4f4f4;
    text-align: justify;
    font-size: 13px;
    padding: 0px 10px;
    line-height: 1.5;
    overflow: hidden;
    transition: all 0.5s ease 0s;
}
.shown::after{
    content: '\f2b6';
}
    </style>
@endsection
@section("caption","Student List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">

            <a href="javascript:void(0)" id="btn_back" class="btn btn-secondary btn-sm rounded-0">Back</a>

            <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0">Close</a>

            <hr>
        </div>
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-2">
                <h6>Info</h6>
                <div class="card border-0 shadow rounded-0">
            

                    
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center mb-3">
                            <div class="h5 mb-1"></div>
                            <div class="text-muted">
                                <span></span>
                            </div>
                        </div>
                        <div class="w-100 d-flex flex-row justify-content-between mb-3">
                            
                            
                           

                            
                            

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-5">
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="">Status</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="">Authorize</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-calendar fa-sm "></i>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="">Created At</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-edit fa-sm "></i>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="">Updated At</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-5">
                            <p class="text-small text-muted text-uppercase mb-2">Personal Info</p>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="col">
                                    {{-- page ဘယ္်နခေါက်ဝင်ကြည်သလဲ မျတ်ထားနိုင်သည်  --}}
                                    @php
                                        // $getpageurl = url(); array ကို string အဖြစ် convert ပြောင်းနေသော error ောကြာ်င့ current ကို သံုးပေးရမည် 
                                        $getpageurl = url()->current();

                                        // dd($getpageurl);
                                        $pageview = App\Models\Pageview::where("pageurl",$getpageurl)->first()->counter; // Pageview သည် blade file မှဖြစ်သောကြောင့် File route တစ်ခုလံုးပေးရမည်

                                    @endphp
                                    Viewed {{$pageview}} Times
                                </div>
                                
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>



                        </div>
                        <div class="mb-5">
                            <p class="text-small text-muted text-uppercase mb-2">Contact Info</p>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>
                            <div class="row gap-0 mb-2">
                                <div class="col-auto">
                                    <i class="fas fa-info"></i>
                                </div>
                                <div class="col">
                                    Sample Date
                                </div>
                                
                            </div>



                        </div>

                    </div>
                    
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                {{-- start accordian --}}
                <h6>Compose</h6>

                <div class="card border-0 rounded-0 shadow mb-4">
                    <div class="card-body d-flex flex-wrap gap-3">
                        <div class="accordion ">
                            <h1 class="acctitle "><i class="fas fa-hand-point-right"></i>Email </h1>
                            <div class="accortent ">
                                <div class="py-3 col-md-12">
                                    <form action="{{route('students.mailbox')}}" method="POST">
                                        @csrf 
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6 form-group mb-3">
                                                <input type="email" name="cmpemail" id="cmpemail" class="form-control form-control-sm border-0 rounded-0 shadow-none" placeholder="To" value="" readonly> 
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <input type="text" name="comsubject" id="cmpsubject" class="form-control form-control-sm border-0 rounded-0 shadow-none" placeholder="Subject"> 
                                            </div>
                                            <div class="col-md-12 form-group mb-3">
                                                <textarea style="resize: none" rows="3" name="cmpcontent" id="cmpcontent" class="form-control form-control-sm border-0 rounded-0 shadow-none" placeholder="Your message here..."></textarea>
                                            </div>
                                            <div class="col d-flex justify-content-end align-items-end">
                                                <button type="submit" class="btn btn-sm btn-secondary rounded-0">Send</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                {{-- end accordian --}}


                <h6>Enrolls</h6>
                <div class="mb-4 card border-0 shadow rounded-0">
                    <div class="card-body d-flex flex-wrap gap-3">

                        
                        

                    </div>

                </div>

                <h6>Additional Info</h6>

                <div class="mb-4 card border-0 shadow rounded-0">
                    <ul class="nav">
                        <li class="nav-item "><button type="button" id="autoclick" class="tablinks active" onclick="gettab(event,'personaltab')">Personal</button></li>
                        <!-- event ကို html မှ parameter  ပေးရန် event ဟု အပြည့်အပြည့်စုံရေးပေးရမည် -->
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'accounttab')">Account</button></li>
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'linktab')">Linked</button></li>
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'signtab')">Sign In</button></li>
                        <li class="nav-item"><button type="button" id="" class="tablinks" onclick="gettab(event,'logtab')">Log</button></li>
                    </ul>


                    <div class="tab-content">
                        <div id="personaltab" class="tab-pane">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id consequuntur explicabo ea eveniet qui ipsum quae commodi similique fuga ipsam reiciendis officia, tempora sapiente porro modi distinctio autem! Repellendus!
                                Quaerat optio mollitia beatae? Similique est, molestias eius quos voluptas porro necessitatibus sit facere repellat unde beatae accusamus id distinctio dolore tempora dolorem modi earum numquam laborum provident debitis architecto.
                                Provident minima est laudantium fugit dicta atque esse excepturi repudiandae quo iusto ipsam, animi id nulla, consectetur commodi quisquam facilis at accusamus dolorum iste et pariatur odit. Temporibus, dignissimos alias!
                            </p>
                        </div>
                        <div id="accounttab" class="tab-pane">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id consequuntur explicabo ea eveniet qui ipsum quae commodi similique fuga ipsam reiciendis officia, tempora sapiente porro modi distinctio autem! Repellendus!
                                Quaerat optio mollitia beatae? Similique est, molestias eius quos voluptas porro necessitatibus sit facere repellat unde beatae accusamus id distinctio dolore tempora dolorem modi earum numquam laborum provident debitis architecto.
                                Provident minima est laudantium fugit dicta atque esse excepturi repudiandae quo iusto ipsam, animi id nulla, consectetur commodi quisquam facilis at accusamus dolorum iste et pariatur odit. Temporibus, dignissimos alias!
                            </p>
                        </div>
                        <div id="linktab" class="tab-pane">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim id consequuntur explicabo ea eveniet qui ipsum quae commodi similique fuga ipsam reiciendis officia, tempora sapiente porro modi distinctio autem! Repellendus!
                                Quaerat optio mollitia beatae? Similique est, molestias eius quos voluptas porro necessitatibus sit facere repellat unde beatae accusamus id distinctio dolore tempora dolorem modi earum numquam laborum provident debitis architecto.
                                Provident minima est laudantium fugit dicta atque esse excepturi repudiandae quo iusto ipsam, animi id nulla, consectetur commodi quisquam facilis at accusamus dolorum iste et pariatur odit. Temporibus, dignissimos alias!
                            </p>
                        </div>
                        <div id="signtab" class="tab-pane">
                            <h6>Sign-In password</h6>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12 mx-auto mb-3">
                                    <form class="mt-3" action="{{ route('password.store') }}"  method="POST" style="width: 100%" class="border-1">
                                        @csrf
                  
                        
                                        <div class="form-group mb-3">
                                            <input name="oldpassword" type="password" class="form-control shadow-none @error('password') is-invalid @enderror" placeholder="Old Password"/>
                                        </div>
                        
                                        <div class="form-group mb-3">
                                            <input name="password" type="password" class="form-control shadow-none @error('password') is-invalid @enderror" placeholder="New Password"/>
                                        </div>
                        
                                        <div class="form-group mb-3">
                                            <input name="password_confirmation" type="password" class="form-control shadow-none @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password"/>
                                        </div>
                        
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-sm btn-info rounded-0">Save Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                           
                        </div>
                        <div id="logtab" class="tab-pane">
                            <h6></h6>
                        </div>
                    </div>

                </div>



                <div class="card rounded-0">
                    <ul class="list-group rounded-0 text-center">
                        <li class="active list-group-item">Information</li>
                    </ul>

                    <!-- start remark  -->
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                               
                            </tr>
                        </tbody>
                        
                    </table>
                    <!-- end remark -->
                </div>
            </div>
        </div>
    </div>
    <!--End Content Area-->




@endsection

@section("scripts")

    <script>
        $(document).ready(function(){
            $(".delete-btns").click(function(){
                // console.log("hello");
                var getidx = $(this).data("idx");

                // console.log(getidx);

                if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){
                    $("#formdelete"+getidx).submit();
                }else{

                }
            })

            // start back btn
            $("#btn_back").click(function(){
                
            })
            
            // end back btn

        })
        const getBtnBack = document.querySelector("#btn_back");
        getBtnBack.addEventListener("click",function(){
            // window.history.back();
            window.history.go(-1); // window page history ကို ရြှေနောက် ကြိုက်သလို ပေးလို့ရသည် 
        })

        // start tabs box
        // Get Ui
        var gettablinks = document.getElementsByClassName("tablinks");
        var gettabpanes = document.getElementsByClassName("tab-pane");


        function gettab(even,link){

            var tabpanes = Array.from(gettabpanes);
            tabpanes.forEach(function(tabpane){
            tabpane.style.display = "none";
            })
            for(let i = 0 ; i < gettablinks.length ; i++){
                gettablinks[i].className = gettablinks[i].className.replace(" active","")

                
            }
            document.getElementById(link).style.display = "block";

            even.currentTarget.className += " active";
        }

        document.getElementById("autoclick").click(); // page စ run သည် နှင့် click ခေါက်ထားမည်ဟုဆိုလိုသည်

        // end tabs box

        // start accordian

            let getacctitle = document.querySelectorAll(".acctitle");
            let getactiveacctitle = document.querySelectorAll(".accortent");
            // console.log(getactiveacctitle);

            for( var i = 0 ; i < getacctitle.length ; i++){
                // console.log(list[i]);
                getacctitle[i].addEventListener("click", function(e){
                    // console.log(e)
                    // console.log(e.target) // event နှိပ်လိုက်သော tag ၏ target ကို သိရှိစေရန်
                    // console.log(this) // this key word သည် နှိပ်လိုက်သော tag အား  သူ့ကိုသူ ပြန်လည်ပြောခြင်းဖြစ်သည် example . event.target နှင့်ညီသည် 
                    this.classList.toggle("shown");
                    // console.warn(e.target.children[0]);
                    // nextElementSibling သည် this တွင်ဝင်နေသော tag နှင့် တစ်တန်းထဲ ရှီနေသော ဖြစ်သူ tag အား ခေါ်ပေးမည်ဖစ်သည် 
                    var getcontent = this.nextElementSibling;
                    // console.log(getcontent);
                    // console.log(getcontent.scrollHeight) // scrollHeight သည် element ၏ height ကို number data type ဖြင့် ဖော်ပြပေးမည်ဖြစ်သည် ထို့ကြောင့် အောက်ပါ အတိုင်း ၄င်း property အား အသုံးချနိုင်သည် 
                    // getcontent.style.height = getcontent.scrollHeight+"px"; 

                    if(getcontent.style.height){
                        // getcontent.style.height = "0px"; // ၄င်းသည် 0 px ပေးထားသောကြောင့်  HTML ထဲတွင် သွားထည့်ပေးမည်ဖြစ်သည်။ သို့သော် ပထမတစ်ကြိမ်ကတည်းက ဝင်နေမည်ဖြစ်သောကြောင့် ဒုတိယတစ်ကြိမ် ပြန်လည် run သည့်အခါ ၄င်း height သည် ရှိနေပြီးဖြ့စ်ပြီး tag height porperty သည် 0px သာဖြစ်နေမည် ထို့ကြောင့် ၄င်း height အား ရှိနေပါက အပြီးသတ် css property ပါဖျောက်ရန် NULL တန်ဖိုး‌ပေးရမည်ဖြစ်သည် သို့မှသာ heigt property သည် tag အတွင်းမှ မပြီးပျောက်သွားမည်ဖြစ်သည် ။
                        getcontent.style.height = null;
                    }else {
                        getcontent.style.height = getcontent.scrollHeight+"px"; 
                    }
                })     
                if(getacctitle[i].classList.contains("shown")) {
                    // contains() သည် classList အတွင်း () အထဲရှိ class ပါသလားကို စစ်ပေးသော method ဖြစ်သည် 
                    getactiveacctitle[i].style.height = getactiveacctitle[i].scrollHeight+ "px";
                }
            }
        // end accordian
    </script>
@endsection





