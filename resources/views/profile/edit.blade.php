<x-app-layout>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Member Information</h4>
                    {{-- <a href="{{route('info_employee.list')}}" class="btn btn-sm btn-primary"><i class="fa fa-reply"></i><span class="btn-icon-add"></span>Employee List</a> --}}
                </div>

                <div class="card-body">
                    <div id="accordion-eleven" class="accordion accordion-primary">
                        @if (session()->has('success'))
                            <strong class="text-success">{{session()->get('success')}}</strong>
                        @endif
                        <form action="{{ route('info_employee.update',  1 ) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Step 1 input fields {Personal Information}-->
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary {{ Session::has('messege') ? '' :'collapsed'}}" data-toggle="collapse" data-target="#rounded-stylish_collapseZero" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Personal Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseZero" class="accordion__body collapse {{ Session::has('messege') ? 'show' :''}}" data-parent="#accordion-eleven" style="">
                                    <div class="row pb-0 accordion__body--text">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Your Full Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" value="{{$user->name}}{{$user->name}}"/>
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Email</label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="" value="{{$user->email}}"/>
                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Company Name</label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror" placeholder="" value="{{$infoOther->company_name}}"/>
                                                    @error('company_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Designation
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" placeholder="" value="{{$infoOther->designation}}"/>
                                                    @error('designation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Date Of Birth
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" placeholder="" value="{{$infoPersonal->dob}}"/>
                                                    @error('dob')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Gender
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select name="gender" class="form-control default-select @error('gender') is-invalid @enderror">
                                                        <option value="0" {{ $infoPersonal->gender == '0' ? 'selected' : '' }}>Male</option>
                                                        <option value="1" {{ $infoPersonal->gender == '1' ? 'selected' : '' }}>Female</option>
                                                        <option value="2" {{ $infoPersonal->gender == '2' ? 'selected' : '' }}>Non-binary</option>
                                                    </select>                                                    
                                                    @error('gender')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Your Address
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="" value="{{$infoPersonal->address}}"/>
                                                    @error('address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">City
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" placeholder="" value="{{$infoPersonal->city}}"/>
                                                    @error('city')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Marrital Status
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <select name="marrital_status" class="form-control default-select @error('marrital_status') is-invalid @enderror">
                                                        <option value="0" {{ $infoPersonal->marrital_status == '0' ? 'selected' : '' }}>Unmarried</option>
                                                        <option value="1" {{ $infoPersonal->marrital_status == '1' ? 'selected' : '' }}>Married</option>
                                                        <option value="2" {{ $infoPersonal->marrital_status == '2' ? 'selected' : '' }}>Divorce</option>
                                                        <option value="3" {{ $infoPersonal->marrital_status == '3' ? 'selected' : '' }}>Widowed</option>
                                                    </select>                                                    
                                                    @error('marrital_status')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Contact Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="contact_number" id="contact_number" class="form-control @error('contact_number') is-invalid @enderror" placeholder="" value="{{$user->contact_number}}"/>
                                                    @error('contact_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Spouse Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="spouse" id="spouse" class="form-control @error('spouse') is-invalid @enderror" placeholder="" value="{{$infoPersonal->spouse}}"/>
                                                    @error('spouse')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Number Of Child
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="text" name="number_child" id="number_child" class="form-control @error('number_child') is-invalid @enderror" placeholder="" value="{{$infoPersonal->number_child}}"/>
                                                    @error('number_child')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Spouse DOB
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-7">
                                                    <input type="date" name="birth_day" id="birth_day" class="form-control @error('birth_day') is-invalid @enderror" placeholder="" value="{{$infoPersonal->birth_day}}"/>
                                                    @error('birth_day')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 2 input fields {Family Information}-->
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary {{ Session::has('messege') ? '' :'collapsed'}}" data-toggle="collapse" data-target="#rounded-stylish_collapseTwo" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Family Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseTwo" class="accordion__body collapse {{ Session::has('messege') ? 'show' :''}}" data-parent="#accordion-eleven" style="">
                                    <div class="pb-0 accordion__body--text">
                                        <div class="row">
                                            <label class="col-md-4 col-form-label">Name</label>
                                            <label class="col-md-3 col-form-label">Date Of Birth</label>
                                            <label class="col-md-3 col-form-label">Gender</label>
                                            <label class="col-md-2 col-form-label">
                                                <button class="btn btn-success px-2 py-2">Add New</button>
                                            </label>
                                        </div>
                                        
                                        @foreach ($infoFamily as $index => $item)
                                        <div class="row pb-1">
                                            <div class="col-md-4">
                                                <input type="text" name="moreFields[{{ $index }}][child_name]" class="form-control" value="{{ $item['child_name'] }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="date" name="moreFields[{{ $index }}][child_dob]" class="form-control" value="{{ $item['child_dob'] }}"/>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="moreFields[{{ $index }}][child_gender]" class="form-control default-select">
                                                    <option value="0" {{ $item['child_gender'] == '0' ? 'selected' : '' }}>Male</option>
                                                    <option value="1" {{ $item['child_gender'] == '1' ? 'selected' : '' }}>Female</option>
                                                    <option value="2" {{ $item['child_gender'] == '2' ? 'selected' : '' }}>Non-binary</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger px-2 py-2">Delete</button>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Step 3 input fields {Academic Information}-->
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary {{ Session::has('messege') ? '' :'collapsed'}}" data-toggle="collapse" data-target="#rounded-stylish_collapseThree" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Academic Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseThree" class="accordion__body collapse {{ Session::has('messege') ? 'show' :''}}" data-parent="#accordion-eleven" style="">
                                    <div class="row pb-0 accordion__body--text">
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">College Name</label>
                                                <div class="col-lg-7">
                                                    <input type="test" name="collage" id="collage" class="form-control @error('collage') is-invalid @enderror" placeholder="" value="{{$infoAcademic->collage}}"/>
                                                    @error('collage')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Batch No.</label>
                                                <div class="col-lg-7">
                                                    <input type="test" name="batch" id="batch" class="form-control @error('batch') is-invalid @enderror" placeholder="" value="{{$user->batch}}"/>
                                                    @error('batch')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Passing Year</label>
                                                <div class="col-lg-7">
                                                    <input type="test" name="passing_year" id="passing_year" class="form-control @error('passing_year') is-invalid @enderror" placeholder="" value="{{$infoAcademic->passing_year}}"/>
                                                    @error('passing_year')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Subject</label>
                                                <div class="col-lg-7">
                                                    <input type="test" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="" value="{{$infoAcademic->subject}}"/>
                                                    @error('subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Degree</label>
                                                <div class="col-lg-7">
                                                    <select name="degree" class="@error('degree') is-invalid @enderror form-control default-select">
                                                        <option value="0" {{ $infoAcademic->degree == 0 ? 'selected' : '' }}>--- Select ---</option>
                                                        <option value="1" {{ $infoAcademic->degree == 1 ? 'selected' : '' }}>12th Standard</option>
                                                        <option value="2" {{ $infoAcademic->degree == 2 ? 'selected' : '' }}>Graduation</option>
                                                        <option value="3" {{ $infoAcademic->degree == 3 ? 'selected' : '' }}>Masters</option>
                                                        <option value="4" {{ $infoAcademic->degree == 4 ? 'selected' : '' }}>Ph.D</option>
                                                    </select>                               
                                                    @error('degree')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Step 4 input fields {Other Information}-->
                            <div class="accordion__item">
                                <div class="accordion__header accordion__header--primary {{ Session::has('messege') ? '' :'collapsed'}}" data-toggle="collapse" data-target="#rounded-stylish_collapseFour" aria-expanded="false">
                                    <span class="accordion__header--icon"></span>
                                    <span class="accordion__header--text">Other Information</span>
                                    <span class="accordion__header--indicator"></span>
                                </div>
                                <div id="rounded-stylish_collapseFour" class="accordion__body collapse {{ Session::has('messege') ? 'show' :''}}" data-parent="#accordion-eleven" style="">
                                    <div class="row pb-0 accordion__body--text">
                                    
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function(){
            //---Save Data
            var form = '#add-user-form';
            $(form).on('submit', function(event){
                event.preventDefault();

                var url = $(this).attr('data-action');
                var src = $('#redirect').attr('redirect-action');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: new FormData(this),
                    dataType: 'JSON',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success:function(response)
                    {
                        $(form).trigger("reset");
                        // alert(response.success);
                        swal("Success Message Title", "Well done, you pressed a button", "success")
                        // window.location.href = src;


                        if(response.institute_name){
                            var row = '<tr id="row_todo_'+ response.id + '">';
                            row += '<td> @if ('+response.qualification == 1 +') SSC  @elseif ('+response.qualification == 2 +')HSC @elseif ('+response.qualification == 3 +')12th Stander @elseif ('+response.qualification == 4 +')Graduation @elseif ('+response.qualification == 5 +')Masters @elseif ('+response.qualification == 6 +')Ph.D @endif </td>';
                            row += '<td>' + response.institute_name + '</td>';
                            row += '<td>' + response.grade + '</td>';
                            row += '<td>' + response.passing_year + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_todo" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>' + '</td>';

                            if($("#id").val()){
                                $("#row_todo_" + response.id).replaceWith(row);
                            }else{
                                $("#list_todo").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                            $("#educational").load(" #educational");
                            $("#form_todo").load(" #form_todo");
                        }
                        if(response.company_name){
                            var row = '<tr id="row_work_experience_'+ response.id + '">';
                            row += '<td>' + response.company_name + '</td>';
                            row += '<td>' + response.start_date + '</td>';
                            row += '<td>' + response.end_date + '</td>';
                            row += '<td>' + response.job_description + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_experience" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                            $("#work_experience").load(" #work_experience");
                            if($("#id").val()){
                                $("#row_work_experience_" + response.id).replaceWith(row);
                            }else{
                                $("#list_work").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                        }
                        if(response.bank_name){
                            var row = '<tr id="row_info_bank_'+ response.id + '">';
                            row += '<td>' + response.bank_name + '</td>';
                            row += '<td>' + response.brance_name + '</td>';
                            row += '<td>' + response.acount_name + '</td>';
                            row += '<td>' + response.acount_no + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_info_bank" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                            $("#info_bank").load(" #info_bank");
                            if($("#id").val()){
                                $("#row_info_bank_" + response.id).replaceWith(row);
                            }else{
                                $("#list_work").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                        }
                        if(response.full_name){
                            var row = '<tr id="row_nominee_'+ response.id + '">';
                            row += '<td>' + response.full_name + '</td>';
                            row += '<td>' + response.nid_no + '</td>';
                            row += '<td>' + response.relation + '</td>';
                            row += '<td>' + response.mobile_no + '</td>';
                            row += '<td>' + response.nominee_percentage + '</td>';
                            row += '<td width="90">' + '<button type="button" id="delete_nominee" data-id="' + response.id +'" class="btn btn-danger btn-sm">Delete</button>'+'</td>';

                            $("#info_nominee").load(" #info_nominee");
                            if($("#id").val()){
                                $("#row_nominee_" + response.id).replaceWith(row);
                            }else{
                                $("#list_work").prepend(row);
                            }
                            $("#form_todo").trigger('reset');
                            
                        }
                    },
                    error: function (xhr) {
                        var errors = xhr.responseJSON.errors;
                        var errorHtml = '';
                        $.each(errors, function(key, value) {
                            errorHtml += '<li style="color:red">' + value + '</li>';
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Required data missing?',
                            html: '<ul>' + errorHtml + '</ul>',
                        });
                    }
                });
            });
        });

        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'x-csrf-token' : $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        $("body").on('click','#delete_todo',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/education/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                success: function(response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_todo_" + id).remove();
                    $("#educational").load(" #educational");
                },
                error: function(response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        $("body").on('click','#delete_experience',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/experience/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                success: function (response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_todo_" + id).remove();
                    $("#work_experience").load(" #work_experience");
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        $("body").on('click','#delete_info_bank',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/info_bank/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                success: function (response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_info_bank_" + id).remove();
                    $("#info_bank").load(" #info_bank");
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
        $("body").on('click','#delete_nominee',function(){
            var id = $(this).data('id');
            $.ajax({
                url: "{{ url('info_related/info_nominee/destroy')}}" + '/' + id,
                method: 'DELETE',
                type: 'DELETE',
                dataType: 'json',               
                success: function (response) {
                    toastr.success("Record deleted successfully!");
                    $("#row_nominee_" + id).remove();
                    $("#info_nominee").load(" #info_nominee");
                },
                error: function (response) {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
 
</x-app-layout>