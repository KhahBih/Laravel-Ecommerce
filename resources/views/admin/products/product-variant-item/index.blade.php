@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Variant Items</h1>
        </div>
        <div class="mb-3">
            <a class="btn btn-primary" href="{{route('admin.products-variant.index', ['product' => request()->productId])}}">Back</a>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>All Products</h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.products-variant-item.create', $variant->id)}}" class="btn btn-primary">+ Add new</a>
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
