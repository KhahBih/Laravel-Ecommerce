@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product Image Gallery</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Upload image</h4>
                        </div>
                        <div class="card-body">
                            <form action="" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Image<code>(Multiple image supported!)</code></label>
                                    <input type="file" name="" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Products</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.products.create')}}" class="btn btn-primary">+ Add new</a>
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
