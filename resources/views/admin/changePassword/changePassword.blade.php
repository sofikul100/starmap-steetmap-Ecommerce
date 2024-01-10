@extends('admin.master')
@section('backend_title')
  Change Password
@endsection

@section('admin_main_content')
    <section class="content-header">
        <form action="#" method="get" class="sidebar-form search-box pull-right hidden-md hidden-lg hidden-sm">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn"><i
                            class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <div class="header-icon">
            <i class="fa fa-key" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1> Change Password</h1>
            <small>Change Password Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Change Password</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag panel-primary">
                    <div class="panel-heading">
                        <div class="btn-group">
                            <h4>Change Password</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                                
                            <form action="{{ route('update.password') }}" method="POST">
                                @csrf
                                <div class="col-md-6">
                                   <div class="input-group">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" disabled class="form-control " value="{{ Auth::user()->name }}" name="name"  id="name"  placeholder="Enter Name...">
                                   </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <label for="Email" class="form-label">Email</label>
                                        <input type="email" disabled class="form-control" id="email" value="{{ Auth::user()->email }}"  name="email"  placeholder="Enter Email...">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                     <div class="input-group">
                                        <label for="current_password" class="form-label">Current Password</label>
                                        <input type="text" class="form-control" id="current_password" required  name="current_password" placeholder="Enter Current Password..">
                                         
                                    </div>
                                    <div class="mt-1" id="show_message"></div>                   
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="new_password" class="form-label">New Password</label>
                                        <input type="text" disabled class="form-control" id="new_password" required name="new_password" placeholder="Enter New Password..">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <input type="text" disabled class="form-control" required id="password_confirmation"  name="password_confirmation" placeholder="Enter Confirm Password..">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-labeled btn-success m-b-5 update_button">
                                        <span class="btn-label"><i class="fa fa-wrench" aria-hidden="true"></i>
                                        </span>Change
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function(){
            $("#current_password").keyup(function (){
               let current_password = $("#current_password").val();
               var token = '{{ csrf_token() }}';
               $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                  url:"{{url('/check/current/password')}}",
                  method:"GET",
                  data:{
                      current_password:current_password
                  },
                  success:function(response){
                     if(response.success == true){
                       $("#show_message").html("<font class='text-success'>Password Is Currect..</font>");
                       $("#new_password").attr('disabled',false);
                       $("#password_confirmation").attr('disabled',false);
                       $("#change_password").attr('disabled',false)
                     }else{
                       $("#show_message").html("<font class='text-danger'>Password Is InCurrect.. </font>");
                       $("#new_password").attr('disabled','true');
                       $("#password_confirmation").attr('disabled',true);
                       $("#change_password").attr('disabled',true) 
                     }
                  },
                  error:function(error){
                     console.log(error)
                  }
  
  
  
               });
  
            })
        })
  </script>

<script>
    $(document).ready(function(){
       $(".error_text").delay(5000).slideUp(300);
   });
 </script>
@endsection
