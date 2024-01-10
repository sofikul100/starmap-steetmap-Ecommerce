@extends('admin.master')
@section('backend_title')
    Product-Edit
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
            <i class="fa fa-cube"></i>
        </div>
        <div class="header-title">
            <h1> Edit Product</h1>
            <small>Add Product Features</small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="{{ route('dashboard') }}"><i class="pe-7s-home"></i> Home</a></li>
                <li><a href="{{ route('product.index') }}"><i class="pe-7s-home"></i> Product List</a></li>
                <li class="active">Edit Product</li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd panel-primary">
                    <div class="panel-heading">
                        <div class="header_button_content">
                            <h4>Edit Product</h4>
                            <a type="button" href="{{ route('product.index') }}" class="btn btn-labeled btn-black m-b-5">
                                <span class="btn-label"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                                </span>Back To Product List
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data" method="POST">
                @method('PUT')
                @csrf
                <div class="col-md-8">
                    <div class="panel panel-bd lobidrag panel-primary">
                        <div class="panel-heading">
                            <div class="btn-group">
                                <h4></h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div>
                                <label for="product_title">Product Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ $product->product_title }}" placeholder="Product Name.." 
                                    name="product_title" id="product_name">

                                @error('product_title')
                                    <p class="text-danger error_message">{{ $message }}</p>
                                @enderror    
                            </div>
                            <div class="spacer"></div>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="category">Category<span class="text-danger">*</span></label>
                                    <select name="category" id="category" class="form-control" >
                                        <option value="" selected disabled>Select Category</option>
                                        @forelse ($categories as $categorie)
                                           
                                            <option value="{{ $categorie->id }}" id="category_name" {{ $product->category == $categorie->id ? 'selected' : '' }}>{{ $categorie->categoy_name }}</option>
                                        @empty
                                            <option value="" disabled>No Category Found!</option>
                                        @endforelse

                                    </select>
                                    @error('category')
                                    <p class="text-danger error_message">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="subcategory">Sub-Category</label>
                                    <select name="subcategory" id="subcategory" class="form-control" >
                                        <option value="" selected disabled>Select Sub-Category</option>

                                        @forelse ($subcategories as $subcategorie)
                                        <option value="{{ $subcategorie->id }}" {{ $product->subcategory == $subcategorie->id ? 'selected' : '' }}>{{ $subcategorie->subcategory_name }}</option>
                                        @empty
                                        <option value="" disabled>No Subcategory Found!</option>
                                        @endforelse
                                       
                                    </select>
                                </div>

                              

                            </div>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="brand">Brand <span>(optional)</span> </span></label>
                                    <select name="brand" id="exampleSelect" class="form-control">
                                         @forelse ($brands as $brand)
                                         <option value="{{ $brand->id }}" {{ $product->brand == $brand->id ? 'selected':'' }}>{{ $brand->name }}</option>
                                         @empty
                                             <option disabled>No Brand Found!</option>
                                         @endforelse
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="video_url">Video Url <span>(optional)</span> </span></span></label>
                                    <input type="text" class="form-control" value="{{ $product->video_url }}" placeholder="Video Url..."
                                        name="video_url" id="video_url">
                                </div>

                            </div>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="selling_price">Selling Price<span class="text-danger">*</span></label>
                                    <input type="number" min="1" value="{{ $product->selling_price }}" class="form-control"  placeholder="Selling Price..."
                                        name="selling_price" id="selling_price">
                                        @error('selling_price')
                                        <p class="text-danger error_message">{{ $message }}</p>
                                      @enderror    
                                </div>

                                <div class="col-md-6">
                                    <label for="discount_price">Discount Price <span class="text-danger">*</span></label>
                                    <input type="number" min="1" class="form-control" value="{{ $product->discount_price }}"  placeholder="Discount Price..."
                                        name="discount_price" id="discount_price">
                                        @error('discount_price')
                                        <p class="text-danger error_message">{{ $message }}</p>
                                    @enderror    
                                </div>

                            </div>

                            <div class="spacer"></div>
                            <div class="spacer"></div>
                            <div class="spacer"></div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button  type="submit" class="btn btn-labeled btn-success m-b-5">
                                        <span class="btn-label"><i class="fa fa-wrench" aria-hidden="true"></i>
                                        </span>Update
                                    </button>
                                </div>
                            </div>



                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-bd lobidrag panel-primary">
                        <div class="panel-heading">
                            <div class="btn-group">
                                <h4></h4>
                            </div>
                        </div>
                        <div class="panel-body">


                            <div class="thumbnail_input_content">
                                <label for="product_thumbnail">New Main Thumbnail</label>
                                <small>( If you want to change main thumbnail then select new one ) </small>
                                <div class="file-drop-area">
                                    <div class="choose-file-button">
                                        <img class="add_image" src="{{ asset('backend/assets/dist/img/add.png') }}"
                                            alt="">
                                    </div>
                                    <small class="thumbnail_drag_text">Drag and drop a file or click</small>
                                    <input type="file" class="file-input"  accept="image/*" name="main_thumbnail"
                                        id="product_thumbnail">
                                </div>
                                @error('main_thumbnail')
                                <p class="text-danger error_message">{{ $message }}</p>
                                @enderror
                                <div class="preview_image_content">
                                    <img class="thumbnail_preview_image" alt="">
                                </div>
                            </div>
                            <div class="spacer">

                            </div>
                            <p class="product_image_preview_title">Previous Product Images: </p>
                            <div class="product_images_preview">
                                  
                                  @forelse ($product->productImage as $image)
                                    <div>
                                        <img src="{{ asset('') }}{{ $image->product_image }}" alt="" width="50" height="50">
                                    </div>
                                  @empty
                                      <p class="text-danger">No Images Found For Preview!</p>
                                  @endforelse
                                  
                            </div>
                            <div>
                                <label for="" class="product_image_text_title">Click Plus Button Add New ImageS. 
                                    </label>
                                <small>( If you want to change Product Images then select new  ) </small>
                                <div class="spacer"></div>
                                <table class="table table-bordered" id="product_images_table">
                                    <tbody id="tbody_content">
                                        <tr class="image_tr_content">
                                            <td><input type="file" accept="image/*" name="product_image[]"
                                                    id="product_image" class="form-control" id=""></td>
                                            <td><a class="btn btn-primary btn-sm " id="add_button"> <i
                                                        class="fa fa-plus-circle"></i> </a></td>
                                        </tr>

                                    </tbody>
                                </table>

                                <div class="switch_content">
                                    <div>
                                        <div>
                                            <p class="switch_title">Top Review</p>
                                            <label class="switch">
                                                <input type="checkbox" {{ $product->top_review == 1 ? 'checked' :'' }} value="1" name="top_review">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <p class="switch_title">Best Sell</p>
                                            <label class="switch">
                                                <input type="checkbox" value="1" {{ $product->best_sell == 1 ? 'checked' :'' }} name="best_sell">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="switch_content">
                                    <div>
                                        <div>
                                            <p class="switch_title">Exclusive Template</p>
                                            <label class="switch">
                                                <input type="checkbox" {{ $product->exclusive_template == 1 ? 'checked' :'' }} value="1" name="exclusive_template">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <div>
                                            <p class="switch_title">Status</p>
                                            <label class="switch">
                                                <input type="checkbox" {{ $product->status == 1 ? 'checked' :'' }} value="1" name="status">
                                                <span class="slider"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>



                        </div>
                    </div>
                </div>

            </form>




        </div>

        </div>
    </section> <!-- /.content -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function(){
           $(".error_message").delay(8000).slideUp(300);
       });
     </script>
    <script>
        $("#category").change(function() {
            let category_id = $("#category").val();
            $('#subcategory').prop('disabled', true);
            var token = '{{ csrf_token() }}';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': token
                },
                url: '{{ route('getSubcategoryByCategory') }}',
                method: "GET",
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    $('#subcategory').empty();
                    if (response.length === 0) {
                       
                    } else {
                        response.forEach(element => {
                            $('#subcategory').append($('<option>', {
                                value: element.id,
                                text: element.subcategory_name
                            }));
                        });
                    }
                    $('#subcategory').prop('disabled', false);
                },
                error: function(error) {
                    console.log(error)
                }



            });

        })
    </script>


    <script>
        let html = ` <tr class="image_tr_content">
                        <td><input type="file" name="product_image[]" class="form-control" id=""></td>
                        <td><a class="btn  btn-sm" id="remove_button"> <i class="fa fa-minus" aria-hidden="true"></i>
                        </a></td>
                    </tr>`;
        let i = 1;
        $("#add_button").click(function() {
            $("#tbody_content").append(html);
            i++;
        });


        $("#tbody_content").on('click', '#remove_button', function() {
            $(this).closest('tr').fadeOut();
        })
    </script>
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
@endsection
