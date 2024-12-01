@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header" style="padding-bottom: 0px!important">
            <h1>Edit Shipping Rule</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{route('admin.shipping-rule.update', $shippingRule->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" data-tribute="true" value="{{$shippingRule->name}}"
                                        name="name" style="height:40px!important">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Type</label>
                                        <select id="inputState" class="form-control shipping-type"
                                        value="{{$shippingRule->type}}" name="type" style="height:40px!important">
                                          <option value="">Select</option>
                                          <option {{$shippingRule->type == 'flat_cost' ? 'selected' : ''}} value="flat_cost">Flat Cost</option>
                                          <option {{$shippingRule->type == 'min_cost' ? 'selected' : ''}} value="min_cost">Minium Order Amount</option>
                                        </select>
                                    </div>
                                    <div class="form-group min_cost {{$shippingRule->type == 'flat_cost' ? 'd-none' : ''}}">
                                        <label>Minium Amount</label>
                                        <input type="text" class="form-control" value="{{$shippingRule->min_cost}}"
                                        data-tribute="true" name="min_cost" style="height:40px!important">
                                    </div>
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="text" class="form-control" data-tribute="true" value="{{$shippingRule->cost}}"
                                        name="cost" style="height:40px!important">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status" value="{{$shippingRule->status}}" style="height:40px!important">
                                          <option {{$shippingRule->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                          <option {{$shippingRule->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.shipping-type',function(){
                let value = $(this).val();
                if(value == 'flat_cost' || value == ''){
                    $('.min_cost').addClass('d-none')
                }else{
                    $('.min_cost').removeClass('d-none')
                }
            })
        })
    </script>
@endpush
