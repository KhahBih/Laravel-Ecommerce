@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Coupon</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Edit Coupon</h3>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.coupons.update', $coupon->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group" style="display: flex!important; flex-direction: column!important">
                                <label>Name</label>
                                <input type="text" class="form-control" data-tribute="true" name="name" value="{{$coupon->name}}">
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" data-tribute="true" name="code" value="{{$coupon->code}}">
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" class="form-control" data-tribute="true" name="quantity" value="{{$coupon->quantity}}">
                            </div>
                            <div class="form-group">
                                <label>Max use</label>
                                <input type="text" class="form-control" data-tribute="true" name="max_use" value="{{$coupon->max_use}}">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Start date</label>
                                        <input type="text" class="form-control datepicker" data-tribute="true" name="start_date" value="{{$coupon->start_date}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>End date</label>
                                        <input type="text" class="form-control datepicker" data-tribute="true" name="end_date" value="{{$coupon->end_date}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discount Type</label>
                                        <select id="inputState" class="form-control" name="discount_type" value="{{$coupon->discount_type}}">
                                            <option {{$coupon->discount_type == 'Percentage' ? 'selected' : ''}} value="Percentage">Percentage</option>
                                            <option {{$coupon->discount_type == 'Amount' ? 'selected' : ''}} value="Amount">Amount</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discount Value</label>
                                        <input type="text" class="form-control" data-tribute="true" name="discount_value" value="{{$coupon->discount_value}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status" value="{{$coupon->status}}">
                                  <option {{$coupon->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                  <option {{$coupon->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                       </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
