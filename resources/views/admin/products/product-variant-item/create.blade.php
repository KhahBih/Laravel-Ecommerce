@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column; align-items: flex-start">
            <h1>Create Product Variant Items</h1>
            <div style="display: flex; flex-direction: column;" class="mt-3">
                <h3 style="font-size: 18px">Product: {{$variant->product->name}}</h3>
                <h3 style="font-size: 18px">Variant: {{$variant->name}}</h3>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('admin.products-variant-item.store', $variant->id)}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Variant Name</label>
                                    <input type="text" readonly class="form-control" data-tribute="true" name="product_variant_name" value="{{$variant->name}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" readonly class="form-control" data-tribute="true" name="variant_id" value="{{$variant->id}}">
                                </div>
                                <div class="form-group">
                                    <input type="hidden" readonly class="form-control" data-tribute="true" name="product_id" value="{{$product->id}}">
                                </div>
                                <div class="form-group">
                                    <label>Item Name</label>
                                    <input type="text" class="form-control" data-tribute="true" name="name">
                                </div>
                                <div class="form-group">
                                    <label>Price <code>(Set 0 for make it free)</code></label>
                                    <input type="text" class="form-control" data-tribute="true" name="price">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Is Default</label>
                                    <select id="inputState" class="form-control" name="is_default">
                                      <option value="">Select</option>
                                      <option value="1">Yes</option>
                                      <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
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
