@extends('admin.master')
@section('backend_title')
    Edit-Profile
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
            <i class="fa fa-user" aria-hidden="true"></i>
        </div>
        <div class="header-title">
            <h1> Edit Profile</h1>
            <small>Edit Profile Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li class="active">Edit Profile</li>
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
                            <h4>Edit Profile</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control " value="{{ $user->name }}" name="name"
                                        id="name" placeholder="Enter Name...">
                                </div>
                                <div class="col-md-6">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                        name="email" placeholder="Enter Email...">
                                </div>
                            </div>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="number" min="1" class="form-control" id="phone"
                                        value="{{ $user->phone }}" name="phone" placeholder="Enter Phone...">
                                       
                                </div>

                                <div class="col-md-6">
                                    <div>
                                        <h1 style="opacity: 0">hello world</h1>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-6">
                                    <div class="thumbnail_input_content">
                                        <label for="">Your Image</label>

                                        <input type="file" class="form-control" accept="image/*" name="avatar"
                                            id="product_thumbnail">

                                        @error('main_thumbnail')
                                            <p class="text-danger error_message">{{ $message }}</p>
                                        @enderror


                                        <div class="preview_section">
                                            @if (!empty($user->avatar))
                                            <div class="">
                                                <p>Previos Profile</p>
                                                <img src="{{ asset('') }}{{ $user->avatar }}" class="profile_avatar_preview" alt="">
                                            </div>
                                            @endif
                                            <div class="preview_image_content">
                                                <p>New Profile</p>
                                                <img class="thumbnail_preview_image profile_avatar_preview" alt="">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-labeled btn-success m-b-5 update_button">
                                        <span class="btn-label"><i class="fa fa-wrench" aria-hidden="true"></i>
                                        </span>Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

        </div>
    </section> <!-- /.content -->
    <script src="{{ asset('backend/assets/plugins/jQuery/jquery-1.12.4.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function(e) {

            $('.preview_image_content').fadeOut();
            $('#product_thumbnail').change(function() {

                let reader = new FileReader();

                reader.onload = (e) => {

                    $('.preview_image_content').slideDown();
                    $('.thumbnail_preview_image').attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $(".error_text").delay(5000).slideUp(300);
        });
    </script>
@endsection
