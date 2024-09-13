@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Type List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="row">
            <div class="col-md-12">
                <a href="javascript:void(0)" id="createmodal-btn" class="btn btn-primary btn-sm rounded-0">Transfer</a>
               
            </div>
        </div>

        <hr>
    
        <div class="loader_container">

        
            <table id="mytable" class="table table-hover border">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Student ID</th>
                        <th>Points</th>
                        <th>Account Type</th>
                        <th>Create At</th>
                        <th>Updated at</th>
                    </tr>
                </thead>

                <tbody id="tabledata">
                    
                </tbody>

                <div class=" loader">
                    <div class="loader-item"></div>
                    <div class="loader-item"></div>
                    <div class="loader-item"></div>
                </div>
                
            </table>
        </div>
        
    </div>
    <!--End Content Area-->

        <!-- START MODAL AREA-->
         <!-- start create modal -->
        <div id="createmodal" class="modal fade">
            <div class="modal-dialog modal-md modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Create Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- step 1 --}}
                        <div id="step1">

                            <form id="verifyform"  method="POST" enctype="multipart/form-data" class=""> 

                            
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 form-group mb-1">
                                        <label for="name">Student Id <span class="text-danger">*</span></label>
                                        <input type="text" name="student_id" id="student_id" class="form-control rounded-0" placeholder="Enter Student ID" value="{{old('student_id')}}">
                                    </div>
                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">
    
                                            <button type="button" id="verify-btn" class="btn btn-primary btn-sm rounded-0 ms-3" >Next</button>
                                        </div>
                                    </div>
    
                                </div>
                            </form>
                        </div>
                        

                        {{-- step 2 --}}
                        <div id="step2" style="display:none">
                            
                            <form id="createform" class=""> 

                                <div class="row">
                                    <ul class="list-group">
                                       
                                    </ul>
                                    
                                    <div class="col-md-12 col-sm-12 form-group mb-1">
                                        <label for="name">Points <span class="text-danger">*</span></label>
                                        <input type="number" name="points" id="points" class="form-control rounded-0" placeholder="Enter Points" value="{{old('point')}}">
                                    </div>
                                    
                                    <input type="hidden" name="receiver_id" id="receiver_id">

                                    <div class="col-md-12">
                                        <div class="d-flex justify-content-end">

                                            <button type="button" id="stepback-btn" class="me-3 btn btn-secondary btn-sm rounded-0 ms-3">Back</button>
                                            <button type="submit" id="create-btn" class="btn btn-primary btn-sm rounded-0 ms-3" >Submit</button>
                                        </div>
                                    </div>
    
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
        <!-- end create modal -->


        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        {{-- <form id="form_action" action="" method="POST" enctype="multipart/form-data" class="">  --}}
                        <form id="form_action" action="" method="" enctype="multipart/form-data" class=""> 

                            {{csrf_field()}}
                            {{ method_field("PUT") }}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="editname" class="form-control rounded-0" placeholder="Enter Status Name" value="{{old('name')}}">
                                </div>
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                     <label for="editstatus_id">Status</label>
                                     <select name="status_id" id="editstatus_id" class="form-control rounded-0">
                                        {{-- @foreach($statuses as $status)
                                            <option value="{{$status->id}}">{{$status['name']}}</option>
                                        @endforeach --}}

                                     </select>
                                 </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

                                        {{-- <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button> --}}
                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Update</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>

        </div>
        <!-- end edit modal -->

        {{-- start verification box --}}
        <!-- start OTP modal -->
        <div id="otpmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        {{-- <form id="form_action" action="" method="POST" enctype="multipart/form-data" class="">  --}}
                        <form id="verifyOtpForm" > 

                            {{-- {{csrf_field()}}
                            {{ method_field("PUT") }} --}}
                            <input type="hidden" name="edituser_id" id="user_id" value="{{$userdata['id']}}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-3">
                                    <label for="otpcode">OTP Code <span class="text-danger">*</span></label>
                                    <input type="text" name="otpcode" id="otpcode" class="form-control rounded-0" placeholder="Enter Status Name" >
                                </div>

                                 <input type="hidden" name="otpuser_id" id="otpuser_id" value="{{$userdata['id']}}">

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

                                        <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                                    </div>
                                </div>

                               

                            </div>

                            <p id="optmessage"></p>
                            <p>Exprie in : <span id="otptimer"></span>Seconds</p>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- end OTP modal -->
    {{-- end verification box --}}
    <!-- END MODAL AREA -->




@endsection

@section("scripts")
{{-- jquyer validate --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script> --}}

{{-- datatable css1 js1 --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        // Start Pass Header Token
        // header token ကို စကတညါးကပို့ထားမည် 
        $.ajaxSetup(   // ajax ဖြင့် စကတည်းက ပို့ထားမည် csrf ကို ပို့ထားမည် 
            {
                headers : { 
                    // header အား သံုးနုိင်ရန် html ရှိ header ထဲတွင် meta tag ဖြင့် attribute name = "csrf-token" content="{{csrf_token()}}"
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr("content"), // meta tag ထဲတွင် ရှိသော value အား ယူမည် 
                }
            }
        )

        // end pass header token
        $(document).ready(function(){
            // start fetch all data
            function fetchalldata(){
                $.ajax({
                    url: "{{route('pointtransfers.index')}}",
                    method : "GET",
                    beforeSend: function(){
                        // loading ပြန်*ရန် 
                        console.log('before');
                        $(".loader").addClass('show');
                    },

                    success : function(response){
                        // console.log(response);
                        $("#tabledata").html(response);
                    },
                    complete : function(){ // complete ဖြစ်လှျင် ပြမည် 
                        console.log("complete");
                        $(".loader").removeClass('show');

                    }
                })
            }

            fetchalldata();

            // end fetch all data


            // create and transfer point
            // start create package 
            $("#modal-btn").click(function(){
                $("#createmodel").modal("show");
            })

            $("#createmodal-btn").click(function(){
                $("#createform").trigger('reset');
                $("#verifyform").trigger('reset');
                $("#step1").show();
                $("#step2").hide();
                $("#createmodal .modal-title").text("Verify Student");
                $("#create-btn").html('Transfer');

                $("#create-btn").val("action-type");
                $("#createmodal").modal("show"); // toggle
            })

            // start verify student
            $("#verify-btn").click(function(){
                const student_id = $("#student_id").val();
                console.log(student_id);
                $.ajax({
                    url : "{{route('userpoints.verifystudents')}}",
                    method : "post",
                    dataType : "json",
                    data : {
                        student_id : student_id,
                    },
                    success : function(response){
                        console.log(response);
                       
                        $("#step1").hide();
                        $("#step2").show();
                        $("#createmodal .modal-title").text("Adding Point");
                        $("#receiver_id").val(response.user.id);

                        let htmlview = ` <li class="list-group-item ">
                                            <a href="{{URL::to('students/${response.student.id}')}}" target="blank">${response.student.firstname} ${response.student.lastname}</a>
                                        </li>`;

                        $("#createmodal .modal-body #createform ul.list-group").html(htmlview);

                    },
                    error: function(response){
                        console.log(response);
                        console.log("false");
                    }
                })
            })
            // end verify student

            $("#stepback-btn").click(function(){
                $("#step1").show();
                $("#step2").hide();
                $("#createmodal .modal-title").text("Verify Student");

            });

            $("#create-btn").click(function(e){
                e.preventDefault();
                console.log("hi");

                let actiontype = $(this).val();
                console.log(actiontype);
                $(this).html("Sending...");

                if(actiontype === "action-type"){

                        Swal.fire({
                            title: "Processing...!",
                            text: "Please wait while sending your OTP .",
                            allowOutsideClick: false,
                            timerProgressBar: true,
                            didOpen: () => {
                                Swal.showLoading();
                                
                            },
                        
                        });

                    
                        $.ajax({
                            url : "/generateotps",
                            type : "POST",
                            success : function(response){
                                console.log(response.otp);
                                Swal.close();
                                $("#optmessage").text("your otp code is " + response.otp);
                                $("#otpmodal").modal("show");
                                $("#createmodal").modal("hide");
                                startotptimer(60); // otp will expire at 120 minutes ( 1 minutes)
                            },
                            error: function(response){
                                console.log("Error",response);
                            }
                        })

                    // console.log(packageid);

              
                  
                
                }
            })


            // start verification
            function startotptimer(duration){
                // let minutes, seconds;
                // let timer = duration;
            
                let timer = duration,minutes, seconds; // veriable တူတူဘဲဖြစ်သည်
                console.log(timer,minutes,seconds);
                let setinv=setInterval(dectimer, 1000);
                $("#otptimer").text(`${minutes} : ${seconds}`);
                
                function dectimer(){
                    minutes = parseInt(timer/60,10); // 10 သည် default ဖြစ်သည် 
                    seconds = parseInt(timer%60);
                    // console.log(parseInt("123 hello")) // -> return 123 ဘဲထွက်မည်ဖြစ်သည် 
                    // console.log(parseInt("123",10)) // -> return 123 ဘဲထွက်မည်ဖြစ်သည်  10 သည် base 10 ကို ဆိုလိုသည်
                    // console.log(parseInt("    123 ",10)) ; // 123 ဘဲထွက်မည် 
                    // console.log(parseInt("0123 ",10)) ; // 0 ဘဲထွက်မည် 
                    minutes = minutes < 10 ? "0"+minutes : minutes;
                    seconds = seconds < 10 ? "0"+seconds : seconds;
                    $("#otptimer").text(`${minutes} : ${seconds}`);
                    if(timer-- < 0){
                        clearInterval(setinv);
                        $("#otpmodal").modal("hide");
                    }
                }
                
            }

            $("#verifyOtpForm").on("submit",function(e){
                e.preventDefault();
                console.log("hello");
                $.ajax({
                    url : "/verifyotps",
                    type : "POST",
                    data: $(this).serialize(),
                    success : function(response){
                        if(response.message){
                            $.ajax({
                                url : "{{route('pointtransfers.transfers')}}",
                                type : "POST",
                                dataType : "JSON",
                                data : $("#createform").serialize(),
                                success : function(response){
                                    console.log(response.message);
                                    // $("#createform")[0].reset();
                                    // or
                                    $("#createform").trigger('reset');
                                    $("#createmodal").modal("hide");
                                    $("#otpmodal").modal('hide');
                                    $("#create-btn").html("Save Change");
                                    fetchalldata();
                                    Swal.fire({
                                                title: "Transfer!",
                                                text: "Transfer Successful.",
                                                icon: "success"
                                            });
                                    

                                },
                                error : function(response){
                                    console.log("Error: ", response);
                                    $("#create-btn").html("Try Again");
                                }

                            })
                        }
                        
                    },
                    error : function(response){
                        console.log("error at OTP", response);
                    }
                })
            })

        // end verification






            // start set package
            $("#set-btn").click(function(){
                $("#setform").trigger('reset');
                $("#setmodal .modal-title").text("Set Package");
                $("#set-btn").html('Set Package');

                $("#setmodal").modal("show");
            })

            $("#setpackage-btn").click(function(e){
                e.preventDefault();
                console.log("hi");

                let actiontype = $(this).val();
                console.log(actiontype);
                $(this).html("Sending...");
                console.log("hello");
                $.ajax({
                    url : "{{route('packages.setpackage')}}",
                    type : "POST",
                    dataType : "JSON",
                    data : $("#setform").serialize(),
                    success : function(response){
                        console.log(response.message);
                        // $("#createform")[0].reset();
                        // or
                        $("#setform").trigger('reset');
                        $("#setmodal").modal("hide");
                        $("#set-btn").html("Save Change");
                        Swal.fire({
                                    title: "Access!",
                                    text: "Package Set Successful.",
                                    icon: "success"
                                });
                        
                    },
                    error : function(response){
                        console.log("Error: ", response);
                        $("#setpackage-btn").html("Try Again");
                    }
                })
            })

            // end set package


        })
    </script>
@endsection