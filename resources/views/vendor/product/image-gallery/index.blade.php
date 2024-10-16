@extends('vendor.layouts.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid" style="margin-top: -40px!important">
        @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div style="display: flex!important; align-items: baseline; flex-direction: column!important">
                <h3><i class="far fa-user"></i> Product: {{$product->name}}</h3>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('vendor.vendor-product-image-gallery.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Image<code>(Multiple image supported!)</code></label>
                        <input type="file" name="image[]" class="form-control" multiple>
                        <input type="hidden" name="product" value="{{$product->id}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top:15px!important">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <div style="display: flex!important; align-items: baseline;">
                <h3><i class="fas fa-images"></i> Product Gallery</h3>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{ $dataTable->table() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

