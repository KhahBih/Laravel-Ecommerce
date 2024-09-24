@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product: {{$productVariant->product->name}}</h1>
            <h1>Product Variant: {{$productVariant->name}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Edit product variant</h3>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.products-variant.update', $productVariant->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" data-tribute="true" name="name" value="{{$productVariant->name}}">
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" data-tribute="true" name="product" value="{{$productVariant->product_id}}">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status" value="{{$productVariant->status}}">
                                  <option {{$productVariant->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                  <option {{$productVariant->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                       </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
