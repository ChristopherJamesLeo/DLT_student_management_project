@include("layouts.adminheader")
    <!--Start Site Setting-->
    
    <!--End Site Setting-->

<div>
    
    <!-- start left side bar -->
    @include("layouts.adminleftsidebar")
    <!-- end left side bar -->

    <!-- start content area -->
    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 col-md-9 pt-md-5 ms-auto">

                    <!--Start inner Area-->
                    <div class="row">
                        {{-- ucfirst သည် uppercase first -> ရှေ့စာလုံးကို အကြီးပြောင်းမည်  --}}
                        <h5>{{ucfirst(\Request::path())}}</h5>
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{\Request::root()}}"><i class="fas fa-home"></i></a></li>
                                {{-- back ကိုပြန်သွားမည် --}}
                                <li class="breadcrumb-item"><a href="{{url()->previous()}}">{{Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root()."/","",url()->previous())))}}</a></li>
                                {{-- current ကို ပြပေးမည် --}}
                                <li class="breadcrumb-item active">{{ucfirst(\Request::path())}}</li>
                            </ol>
                        </nav>

                        @yield("content")
                    </div>
                    <!-- end inner area -->

                </div>
            </div>
        </div>
    </section>
    <!-- end content area -->

</div>


{{-- <p> --}}
    {{-- {{\Request::root()}} --}}
    {{-- {{request()->root()}}  request method ကို သံဒးလဲရသည် arrow operator ဖြစ်သွားမည် --}}

    {{--domain name address ကို ရရှိမည် http://127.0.0.1:8000 --}}
{{-- </p> --}}
{{-- <p> --}}
    {{-- {{\Request::fullurl()}} --}}
    {{-- {{request()->fullurl()}}  request method ကို သံဒးလဲရသည် arrow operator ဖြစ်သွားမည် --}}
    {{-- search bar ထဲရှိ url တစ်ခုလုံးကို ရရှီမည် http://127.0.0.1:8000/edulinks?filter=2--}}


    {{-- {{url()->full()}} url ဟူသော် method တစ်ခု သက်သက်တည်ရှိနေပြီး ၄င်းသည်လည်း search bar ထဲ၇ှ url တစ်ခုလံးကိုရနေမညမ --}}
{{-- </p> --}}

{{-- <p> --}}
    {{-- {{\Request::url()}} --}}
    {{-- {{request()->url()}}  request method ကို သံဒးလဲရသည် arrow operator ဖြစ်သွားမည် --}}
    {{-- search bar ထဲရှိ url တစ်ခုလုံး၏ ? နောက်ရှိ စာသားများ query ဖမ်းထားသော ကောင်များ ပါလာမည်မဟုတ်ပေ http://127.0.0.1:8000/edulinks--}}

    {{-- {{url()->current()}} current url ကို ပြမည် query တော့ မပါလာပေ  --}}
{{-- </p> --}}

{{-- <p> --}}
    {{-- {{\Request::getRequestUri()}} --}}
    {{-- {{request()->getRequestUri()}}  request method ကို သံဒးလဲရသည် arrow operator ဖြစ်သွားမည် --}}
    {{-- search bar ထဲရှိ domain name နောက်က စာသားများသာ ပါလာသည် /contacts?filter=11 --}}
{{-- </p> --}}

{{-- <p> --}}
    {{-- {{\Request::getPathInfo()}} --}}
    {{-- {{request()->getPathInfo()}}  request method ကို သံဒးလဲရသည် arrow operator ဖြစ်သွားမည် --}}
    {{-- search bar ထဲရှိ domain name နောက်က path nameများသာ ပါလာပြီး query များလည် ပါလာမည်မဟုတ်ပေ /contacts --}}
{{-- </p> --}}

{{-- <p> --}}
    {{-- {{\Request::path()}} --}}
    {{-- {{request()->path()}}  request method ကို သံဒးလဲရသည် arrow operator ဖြစ်သွားမည် --}}
    {{-- search bar ထဲရှိ မိမိသွားမည့် path name ကို သာ ထုတ်ပေးမည်ဖြစ်ပီး / မပါလာပေ contacts--}}
{{-- </p> --}}

{{-- <p> --}}

    {{-- {{url()->previous()}}  --}}
    {{-- route name အား page window တစ်ဆင့်နောက်ကျ ပြီးမှ ဖော်ပြပေးနေမည်  --}}

    {{-- {{str_replace(\Request::root(),'',url()->previous())}}  --}}

    {{-- {{str_replace(\Request::root()."/","",url()->previous())}} --}}

    {{-- {{preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root()."/","",url()->previous()))}}  --}}



    {{-- /[[:punct:]]+[[:alnum:]]+/ -> query တစ်ခုလုံးအား ဖျက်ထုတ်မည် --}}

    {{-- ရှေ့စာလံဒး အကြီးပြောင်းမည် --}}
    {{-- {{Str::title(preg_replace('/[[:punct:]]+[[:alnum:]]+/','',str_replace(\Request::root()."/","",url()->previous())))}} --}}
{{-- </p> --}}

@include("layouts.adminfooter")