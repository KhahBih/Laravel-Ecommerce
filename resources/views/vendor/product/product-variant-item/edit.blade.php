@extends('vendor.layouts.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0" style="margin-top: -35px!important">
            <div style="display: flex!important; align-items: baseline; flex-direction: column!important">
                <div style="display: flex!important; align-items: baseline;">
                    <h3><i class="far fa-user"></i> Product Variant Item Edit</h3></br>
                </div>
                <p style="padding-left: 42px!important">Product: {{$product->name}}</p>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant-item.update', $productVariantItem->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group wsus_input">
                            <label>Variant Name</label>
                            <input type="text" readonly class="form-control" data-tribute="true" name="variant_name" value="{{$productVariantItem->productVariant->name}}">
                        </div>
                        <div class="form-group wsus_input">
                            <label>Name</label>
                            <input type="text" class="form-control" data-tribute="true" name="name" value="{{$productVariantItem->name}}">
                        </div>
                        <div class="form-group wsus_input">
                            <label>Price</label>
                            <input type="text" class="form-control" data-tribute="true" name="price" value="{{$productVariantItem->price}}">
                        </div>
                        <div class="form-group wsus_input">
                            <label for="inputState">Is default</label>
                            <select id="inputState" class="form-control" name="is_default" value="{{$productVariantItem->is_default}}">
                              <option {{$productVariantItem->status == '1' ? 'selected' : ''}} value="1">Yes</option>
                              <option {{$productVariantItem->status == '0' ? 'selected' : ''}} value="0">No</option>
                            </select>
                        </div>
                        <div class="form-group wsus_input">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status" value="{{$productVariantItem->status}}">
                              <option {{$productVariantItem->status == '1' ? 'selected' : ''}} value="1">Active</option>
                              <option {{$productVariantItem->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button style="margin-top: 10px" type="submit" class="btn btn-primary">Update</button>
                   </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

