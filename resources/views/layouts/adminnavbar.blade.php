<div class="col-lg-10 col-md-9 fixed-top ms-auto topnavbars">
    <div class="row">
        <nav class="navbar navbar-expand navbar-light bg-white shadow">
            <!--Seacrh-->

            <!--Seacrh-->
            <form id="quicksearchform" class="me-auto" action="" method="">
                <div class="input-group">
                    <input type="text" name="quicksearch" id="quicksearch" class="form-control border-0 shadow-none" placeholder="Search Something..." />
                    <div class="input-group-append">
                        <button type="submit" id="quicksearch_btn" class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!--notify & userlogout-->
            <ul class="navbar-nav me-5 pe-5">
                <!-- notify -->

                <li class="nav-item  me-1">
                    <a href="{{route('carts.index')}}" class="nav-link dropbtn" onclick="dropbtn(event)">
                        <i class="fas fa-shopping-cart"></i>
                        @if (Auth::user()->carts()->exists())
                            <sup class="badge bg-danger text-white">{{Auth::user()->carts()->count()}}</sup>
                        @endif
                    </a>
                </li>

                <li class="nav-item dropdowns me-3">
                    <a href="javascript:void(0);" class="nav-link dropbtn" onclick="dropbtn(event)">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">{{auth()->user()->unreadNotifications->count()}}</span>
                    </a>
                    
                    <div class="dropdown-contents mydropdowns">
                        {{-- noti ရှိနေမှ --}}
                        @if ($userdata ->unreadNotifications->count() > 0) 
                            <a href="{{route('leaves.markasread')}}" class="small text-center text-muted ">Mark all as read</a>

                            {{-- @foreach ($userdata->notifications as $notification) --}}
                            @foreach (Auth::user()->notifications as $notification)
                            {{-- noti ကို show ပြရန် --}}
                                <a href="{{route( $notification->type === 'App\Notifications\AnnouncementNotify' ? 'announcements.show' : 'leaves.show' ,$notification->data['id'])}}" class="d-flex">
                              
                                    <div class="me-3">
                                        @if ($notification->type == "App\Notifications\AnnouncementNotify")
                                            <img src="{{$notification->data["image"]}}" class="rounded-circle" width="30px" height="30px" alt="{{$notification->data['id']}}">
                                        @else
                                            <i class="fas fa-bell fa-xs text-primary"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <ul class="list-unstyled">
                                            @if ($notification->type == "App\Notifications\AnnouncementNotify")
                                                <li>{{$notification->data["title"]}}</li>
                                                
                                            @else
                                                <li>{{$notification->data["studentId"]}}</li>
                                                <li>
                                                    {{Str::limit($notification->data["title"],20)}}
                                                </li>
                                                <li>
                                                    {{$notification ->created_at->format("d M Y h:i:s A")}}
                                                </li>
                                            @endif
                                            
                                            
                                        </ul>
                                    </div>
                                </a>
                            @endforeach
                            
                            <a href="javascript:void(0);" class="small text-center text-muted">Show All Notification</a>

                        @else
                            <a href="javascript:void(0);" class="small text-center text-muted">No New Notification</a>
                        @endif
                
                    </div>
                </li>
                <!-- notify -->


                <!--user logout-->
                <li class="nav-item dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-bs-toggle="dropdown" ">
                       <!-- name အား provider ထဲတွင် ထည့်ပြီး မည့်သည့် file တွင်မဆိုလှမ်းခေါ်နိုင်အောင် လုပ်ထားသည်  -->
                        <span class="text-muted small me-2">{{$userdata['name']}}</span>
                        <img src="./assets/img/users/user1.jpg" class="rounded-circle" width="25" />
                    </a>
                    <div class="dropdown-menu">
                        <a href="{{route('profile.edit')}}" class="dropdown-item"><i class="fas fa-user fa-sm text-muted me-2"></i> Profile</a>
                        <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-cogs fa-sm text-muted me-2"></i> Settings</a>
                        <a href="javascript:void(0);" class="dropdown-item"><i class="fas fa-list fa-sm text-muted me-2"></i> Avtivity Log</a>
                        <div class="dropdown-divider"></div>
                        
                        {{-- <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            @method("POST") --}}
                            {{-- method 1 --}}
                            {{-- <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault();
                            this.closest('form').submit();"><i class="fas fa-sign-out-alt fa-sm text-muted me-2"></i> Logout</a> --}}

                            {{-- method 2 --}}
                            {{-- <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault();
                            this.parentElement.submit();"><i class="fas fa-sign-out-alt fa-sm text-muted me-2"></i> Logout</a> --}}

                            {{-- default --}}
                            {{-- <x-responsive-nav-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-responsive-nav-link> --}}
                        {{-- </form> --}}
                        {{-- closest() သည် အနီးစပ်ဆုံးရှိနေသော ကောင်ကိုလှမ်းခေါ်မည်  --}}
                        {{-- this.closest('form') -> သူနှင့် အနီးစပ်ဆုံးရှိနေသော form ကို sumbit လုပ်မည် ဟုဆိုလိုသည် ထို့ကြောင့် form ကို submit လုပ်ပြီး logout ဖြစ်သွားမည် --}}

                        {{-- method 3 --}}
                            <a href="javascript:void(0);" class="dropdown-item" onclick="event.preventDefault();
                            document.getElementById('logout_form').submit();"><i class="fas fa-sign-out-alt fa-sm text-muted me-2"></i> Logout</a>
                            <form action="{{ route('logout') }}" method="POST" id="logout_form">
                                @csrf 
                                @method("POST")
                            </form>
                    </div>

                </li>
                <!--user logout-->

            </ul>
            <!--notify & userlogout-->
        </nav>
    </div>
</div>