@extends('vendor.layouts.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0" style="margin-top: -35px!important">
            <div style="display: flex!important; align-items: baseline;">
                <h3><i class="far fa-user"></i> Product Variants</h3>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.products-variant.update', $productVariant->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        <div class="form-group wsus_input">
                            <label>Name</label>
                            <input type="text" class="form-control" data-tribute="true" name="name" value="{{$productVariant->name}}">
                        </div>
                        <div class="form-group wsus_input">
                            <input type="hidden" class="form-control" data-tribute="true" name="product" value="{{$productVariant->product_id}}">
                        </div>
                        <div class="form-group wsus_input">
                            <label for="inputState">Status</label>
                            <select id="inputState" class="form-control" name="status" value="{{$productVariant->status}}">
                              <option {{$productVariant->status == '1' ? 'selected' : ''}} value="1">Active</option>
                              <option {{$productVariant->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top:10px!important">Update</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

