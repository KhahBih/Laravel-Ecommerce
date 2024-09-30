@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column; align-items: flex-start">
            <h1>Product Variant</h1>
            <h2 style="font-size: 18px">Product: {{$product->name}}</h2>
        </div>
        <div class="mb-3">
            <a class="btn btn-primary" href="{{route('admin.products.index')}}">Back</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4></h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.products-variant.create', ['product' => $product->id])}}" class="btn btn-primary">+ Add new</a>
                        </div>
                    </div>
                    <div class="card-body">
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
