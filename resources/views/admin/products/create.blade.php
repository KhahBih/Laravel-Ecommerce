@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Products</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Create Product</h4>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.products.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" data-tribute="true" name="image">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" data-tribute="true" name="name" value="{{old('name')}}">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Category</label>
                                        <select id="inputState" class="form-control main-category" name="category">
                                          <option value="">Select</option>
                                          @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                          @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Sub category</label>
                                        <select id="inputState" class="form-control sub-category" name="sub_category">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Child category</label>
                                        <select id="inputState" class="form-control child-category" name="child_category">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Brand</label>
                                <select id="inputState" class="form-control" name="brand">
                                    <option value="">Select</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>SKU</label>
                                <input type="text" class="form-control" data-tribute="true" name="sku" value="{{old('sku')}}">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" data-tribute="true" name="price" value="{{old('price')}}">
                            </div>
                            <div class="form-group">
                                <label>Offer price</label>
                                <input type="text" class="form-control" data-tribute="true" name="offer_price" value="{{old('offer_price')}}">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer start date</label>
                                        <input type="text" class="form-control datepicker" data-tribute="true" name="offer_start_date" value="{{old('offer_start_date')}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer end date</label>
                                        <input type="text" class="form-control datepicker" data-tribute="true" name="offer_end_date" value="{{old('offer_end_date')}}">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Stock quantity</label>
                                <input type="number" min="0" class="form-control" data-tribute="true" name="qty" value="{{old('qty')}}">
                            </div>

                            <div class="form-group">
                                <label>Video link</label>
                                <input type="text" class="form-control" data-tribute="true" name="video_link" value="{{old('video_link')}}">
                            </div>

                            <div class="form-group">
                                <label>Short description</label>
                                <textarea name="short_desc" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Long description</label>
                                <textarea name="long_desc" class="form-control summernote"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Product type</label>
                                <select id="inputState" class="form-control" name="product_type">
                                    <option value="">Select</option>
                                    <option value="new_arrival">New Arrival</option>
                                    <option value="featured_product">Featured</option>
                                    <option value="top_product">Top Product</option>
                                    <option value="best_product">Best Product</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputState">SEO title</label>
                                <input type="text" class="form-control" data-tribute="true" name="seo_title">
                            </div>

                            <div class="form-group">
                                <label for="inputState">SEO description</label>
                                <textarea name="seo_desc" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                  <option value="1">Active</option>
                                  <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                       </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-sub-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>');
                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })

            $('body').on('change', '.sub-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.product.get-child-categories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.child-category').html('<option value="">Select</option>');
                        $.each(data, function(i, item){
                            $('.child-category').append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush