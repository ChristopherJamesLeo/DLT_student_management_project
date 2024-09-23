@extends("layouts.adminindex")
@section("css")
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endsection
@section("caption","Gender List")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">

        <div class="col-md-12 my-3">
           <div class="col-md-12"></div>
                <form action="{{route('religions.store')}}" method="POST" enctype="multipart/form-data" class="">

                     {{csrf_field()}}
                     @method("POST")

                     <div class="row">
                         <div class="col-md-12 col-sm-12 form-group mb-1">
                             <label for="name">Name <span class="text-danger">*</span></label>


                             <input type="text" name="name" id="name" class="form-control rounded-0 @error("name") is-invalid @enderror" placeholder="Enter Status Name" value="{{old('name')}}">
                             {{-- @error("name")
                             <span class="invalid-feedback">{{$message}}</span>
                             @enderror --}}
                             {{-- @error("name")
                             <span class="text-danger">{{$message}}</span>
                             @enderror --}}
                             {{-- class ထဲတွင် error ထုတ်ပ့န်ရန် @errorထဲတါင် (name) သည် error တက်ပါက is-invalid ဖြင့် စစ်ပြီး error တက်ပါ span ကို ပြပေးမည်ဖြစ်သည် ထို့နောက် class ထဲတွင် invalid-feedback ဟူသော class ထဲတွင် message ထုတ်ပြမည်ဖြစ်သည် class ထဲတွင် is-invalid သည် border color အတွက်တစ်ခုတည်းဖြစ်သည် invalid-feedback သည် spantag ကို text-အနီးရောက်ပေးရန် -error message ကို စစ်ရန် controller ထဲတွင် require စစ်ပေးထားရမည် --}}
                         </div>

                         <div class="col-md-12">
                             <div class="d-flex justify-content-end">

                                 <button type="reset" class="btn btn-secondary btn-sm rounded-0 ms-3">Cancel</button>
                                 <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                             </div>
                         </div>

                     </div>
                 </form>
            <hr>
        </div>


        <table id="mytable" class="table table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>By</th>
                    <th>Create At</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($religions as $idx=>$religion)

                <tr>

                    <td>{{++$idx}}</td>

                    <td>{{$religion->name}}</td>
                    <td>{{$religion->user["name"]}}</td>

                    <td>{{$religion->created_at->format('d m Y')}}</td>
                    <td>{{$religion->updated_at->format('d M Y')}}</td>
                    <td>
                        <a href="javascript:void(0)" class="me-3 btn btn-outline-info btn-sm edit_form" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="{{$religion->id}}" data-name="{{$religion->name}}"><i class="fas fa-pen"></i></a>


                        <a href="#" class="text-danger me-3 delete-btns" data-idx = "{{$religion->id}}" ><i class="fas fa-trash"></i></a>

                    </td>
                    <form id="formdelete{{$religion->id}}" action="{{route('religions.destroy',$religion->id)}}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>






                </tr>

                @endforeach
            </tbody>


        </table>

    </div>
    <!--End Content Area-->

    <!-- singe page upload -->
    <!-- START MODAL AREA-->
        <!-- start edit modal -->
        <div id="editmodal" class="modal fade">
            <div class="modal-dialog modal-sm modal-dialog-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Form</h6>
                        <button type="type" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_action" action="" method="POST" enctype="multipart/form-data" class="">

                            {{csrf_field()}}
                            {{ method_field("PUT") }}

                            <div class="row">
                                <div class="col-md-12 col-sm-12 form-group mb-1">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="editname" class="form-control rounded-0" placeholder="Enter Status Name" value="{{old('name')}}">
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end">

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
    <!-- END MODAL AREA -->




@endsection

@section("scripts")
{{-- datatable css1 js1 --}}
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script>



        $(document).ready(function(){
            // start delete item
            $(".delete-btns").click(function(){
                // console.log("hello");
                var getidx = $(this).data("idx");

                // console.log(getidx);

                if(confirm(`Are Your Sure!! You want to delete ${getidx}`)){
                    $("#formdelete"+getidx).submit();
                }else{

                }
            })
            // end delete item

            // start edit form
                // single page upload
            $(document).on("click",".edit_form",function(e){
                e.preventDefault();
                // console.log("hello");
                // console.log($(this).attr("data-name"));
                // console.log($(this).data("id"));
                $("#editname").val($(this).data("name"));

                const getid = $(this).data("id");

                // $("#form_action").attr('action',`\{\{route('statuses.update',$status->id)\}\}`); // error

                // use method 1
                // $("#form_action").attr('action',`http://127.0.0.1:8000/statuses/${getid}`);

                // method 2
                $("#form_action").attr('action',`/religions/${getid}`);

            })

            // end edit form

            $("#mytable").DataTable();
        })






    </script>
@endsection

{{-- Add on ရှိ role
    fix အားလုံးကို error ထုတ်ပြခဲ့ရန် --}}

    {{-- custom filter ပေးထားသမျှ pagination ပေးထားမည်  --}}
