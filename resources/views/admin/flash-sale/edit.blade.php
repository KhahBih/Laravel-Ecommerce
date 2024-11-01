@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Child Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{route('admin.flash-sale-item.update', $flashSaleItem->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Product</label>
                                        <input type="text" readonly class="form-control" data-tribute="true" name="show_at_home" value="{{$flashSaleItem->product->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Show at home</label>
                                        <select name="show_at_home" class="form-control">
                                            <option {{$flashSaleItem->show_at_home == 1 ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{$flashSaleItem->show_at_home == 0 ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option {{$flashSaleItem->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                            <option {{$flashSaleItem->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
            $('body').on('change', '.parent-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.get-subCategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>');
                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        });
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
