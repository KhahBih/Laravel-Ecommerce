@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Item: {{$productVariantItem->name}}</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Edit</h3>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.products-variant-item.update', $productVariantItem->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group">
                                <label>Variant Name</label>
                                <input type="text" readonly class="form-control" data-tribute="true" name="variant_name" value="{{$productVariantItem->productVariant->name}}">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" data-tribute="true" name="name" value="{{$productVariantItem->name}}">
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" data-tribute="true" name="price" value="{{$productVariantItem->price}}">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Is default</label>
                                <select id="inputState" class="form-control" name="is_default" value="{{$productVariantItem->is_default}}">
                                  <option {{$productVariantItem->status == '1' ? 'selected' : ''}} value="1">Yes</option>
                                  <option {{$productVariantItem->status == '0' ? 'selected' : ''}} value="0">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status" value="{{$productVariantItem->status}}">
                                  <option {{$productVariantItem->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                  <option {{$productVariantItem->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
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
