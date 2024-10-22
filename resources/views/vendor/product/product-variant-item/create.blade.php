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
                    <h3><i class="far fa-user"></i> Product Variant Items</h3></br>
                    <a href="{{route('vendor.products-variant-item.create', ['productId' => $product->id, 'variantId' => $variant->id])}}"
                        class="btn btn-primary" style="margin-left: 10px">+ Create New</a>
                </div>
                <h4 style="padding-left: 42px!important">Product: {{$product->name}}</h4>
                <h4 style="padding-left: 42px!important">Variant: {{$variant->name}}</h4>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant-item.store', $variant->id)}}" method="POST">
                    @csrf
                    <div class="form-group wsus_input">
                        <label>Variant Name</label>
                        <input type="text" readonly class="form-control" data-tribute="true" name="product_variant_name"
                        value="{{$variant->name}}">
                    </div>
                    <div class="form-group wsus_input">
                        <input type="hidden" readonly class="form-control" data-tribute="true" name="variant_id" value="{{$variant->id}}">
                    </div>
                    <div class="form-group wsus_input">
                        <input type="hidden" readonly class="form-control" data-tribute="true" name="product_id" value="{{$product->id}}">
                    </div>
                    <div class="form-group wsus_input">
                        <label>Item Name</label>
                        <input type="text" class="form-control" data-tribute="true" name="name">
                    </div>
                    <div class="form-group wsus_input">
                        <label>Price <code>(Set 0 for make it free)</code></label>
                        <input type="text" class="form-control" data-tribute="true" name="price">
                    </div>

                    <div class="form-group wsus_input">
                        <label for="inputState">Is Default</label>
                        <select id="inputState" class="form-control" name="is_default">
                          <option value="">Select</option>
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                        </select>
                    </div>

                    <div class="form-group wsus_input">
                        <label for="inputState">Status</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="">Select</option>
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

