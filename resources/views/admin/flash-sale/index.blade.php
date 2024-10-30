@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Flash Sale</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Flash Sale End Date</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.flash-sale.update')}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control datepicker" data-tribute="true" name="sale_end_date" value="{{@$flashSaleDate->end_date}}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Add Flash Sale Product</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.flash-sale.addProduct')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Add product</label>
                                    <select name="product" class="form-control select2">
                                        <option value="">Select</option>
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Show at home</label>
                                            <select name="show_at_home" class="form-control select2">
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" class="form-control select2">
                                                <option value="">Select</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>All Flash Sale Products</h4>
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
