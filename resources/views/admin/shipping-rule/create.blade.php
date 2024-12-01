@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header" style="padding-bottom: 0px!important">
            <h1>Create Shipping Rule</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{route('admin.shipping-rule.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" data-tribute="true" name="name" style="height:40px!important">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Type</label>
                                        <select id="inputState" class="form-control shipping-type" name="type" style="height:40px!important">
                                          <option value="">Select</option>
                                          <option value="flat_cost">Flat Cost</option>
                                          <option value="min_cost">Minium Order Amount</option>
                                        </select>
                                    </div>
                                    <div class="form-group min_cost d-none">
                                        <label>Minium Amount</label>
                                        <input type="text" class="form-control" data-tribute="true" name="min_cost" style="height:40px!important">
                                    </div>
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="text" class="form-control" data-tribute="true" name="cost" style="height:40px!important">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status" style="height:40px!important">
                                          <option selected="" value="1">Active</option>
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
