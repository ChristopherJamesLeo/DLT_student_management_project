@extends("layouts.adminindex")

@section("caption","Create Student")
@section("content")

    <!-- start content area -->
    <div class="container-fluid">
        
        <div class="col-md-12 my-3">
            <form action="{{route('students.store')}}" method="POST" enctype="multipart/form-data" class=""> 
                
                @csrf
                @method("POST")
                
                {{-- old('firstname')  သည် refresh ဖြစ်ပြီး data reject ဖြစ်၍ ပြန်လာပါက မူလပေးခဲ့သောစာသားကို မပြောက်ဘဲ invalit ဖြစ်နေသော data input box တစ်ခုတည်းသာ blank ဖြစ်ပြီး အရင် ထည့်ခဲ့သော data ကိူ ပြန်ဖော်ပြပေးနေမည် --}}
                <div class="row">
                    <div class="col-md-6 col-sm-12 form-group mb-1">
                        <label for="firstname">First name <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control rounded-0" placeholder="First Name" value="{{old('firstname')}}">
                    </div>
                    <div class="col-md-6 col-sm-12 form-group mb-2">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control  rounded-0" placeholder="last name" value="{{old('lastname')}}">
                    </div>
                    {{-- <div class="col-md-4 col-sm-12 form-group mb-3">
                        <label for="regnumber">Register Number</label>
                        <input type="text" name="regnumber" id="regnumber" class="form-control  rounded-0" placeholder="reg number" value="{{old('regnumber')}}">
                    </div> --}}
                    
                    <div class="form-group mb-4 col-md-12 col-sm-12">
                        <label for="remark">Remark</label>
                        <textarea name="remark" id="remark" class="form-control rounded-0" placeholder="Remark"></textarea>
                    </div>
                    <div class="col-md-12">
                        <div class="d-flex justify-content-end">
                            <a href="{{route('students.index')}}" class="btn btn-secondary btn-sm rounded-0">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0 ms-3">Submit</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>

    </div>
    <!--End Content Area-->




@endsection