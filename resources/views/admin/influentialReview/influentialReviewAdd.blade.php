@extends('admin.master')
@section('backend_title')
    InfluentialReview-Add
@endsection

@section('admin_main_content')
    <section class="content-header">
        <div class="header-icon">
            <i class="fa fa-star"></i>
        </div>
        <div class="header-title">
            <h1> Add New Influential Review</h1>
            <small>Add Influential Review Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('influentialReview.index') }}"><i class="pe-7s-home"></i> Influential Review List</a></li>
                <li class="active">Add Influential Review</li>
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
                            <a type="button" href="{{ route('influentialReview.index') }}"
                                class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left"></i></span>Back To Influential
                                Review List
                            </a>&nbsp;&nbsp;&nbsp;
                        </div>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('influentialReview.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Name<span class="text-danger">*</span></label>
                                    <input type="text" name="name" required id="name" class="form-control"
                                        placeholder="Influencer  Name">
                                    @error('name')
                                        <p class="text-danger err">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="ratings">Select Rating<span class="text-danger">*</span></label>
                                    <select name="ratings" id="ratings" required class="form-control">
                                        <option value="1"><span>⭐</span></option>
                                        <option value="2">
                                            <span>⭐</span>
                                            <span>⭐</span>
                                        </option>
                                        <option value="3">
                                            <span>⭐</span>
                                            <span>⭐</span>
                                            <span>⭐</span>
                                        </option>

                                        <option value="4">
                                            <span>⭐</span>
                                            <span>⭐</span>
                                            <span>⭐</span>
                                            <span>⭐</span>
                                        </option>

                                        <option value="5">
                                            <span>⭐</span>
                                            <span>⭐</span>
                                            <span>⭐</span>
                                            <span>⭐</span>
                                            <span>⭐</span>
                                        </option>
                                    </select>
                                    @error('ratings')
                                        <p class="text-danger err">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="review">Review<span class="text-danger">*</span></label>
                                    <textarea name="review" rows="10" cols="10" id="review" required class="form-control" placeholder="Review Text Here..."></textarea>
                                    @error('review')
                                        <p class="text-danger err">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="spacer"></div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image">Influencer Image<span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" required class="form-control">
                                    @error('image')
                                        <p class="text-danger err">{{ $message }}</p>
                                    @enderror
                                    <div class="preview_section">
                                        @if (!empty($user->avatar))
                                        <div class="">
                                            <p>Previos Image</p>
                                            <img src="{{ asset('') }}{{ $user->avatar }}" class="profile_avatar_preview" alt="">
                                        </div>
                                        @endif
                                        <div class="preview_image_content">
                                            <p>New Image</p>
                                            <img class="thumbnail_preview_image profile_avatar_preview" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group">
                                        <button type="submit" class="btn btn-labeled btn-success m-b-5 update_button">
                                            <span class="btn-label"><i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </span>Add Now
                                        </button>
                                    </div>
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
            $('#image').change(function() {

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
            $(".err").delay(10000).slideUp(300);
        });
    </script>
@endsection
