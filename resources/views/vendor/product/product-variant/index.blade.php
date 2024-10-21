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
                    <h3><i class="far fa-user"></i> Product Variants</h3></br>
                    <a href="{{route('vendor.products-variant.create', ['product' => $product])}}" class="btn btn-primary" style="margin-left: 10px">+ Create New</a>
                </div>
                <h4 style="padding-left: 42px!important">Product: {{$product->name}}</h4>
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

