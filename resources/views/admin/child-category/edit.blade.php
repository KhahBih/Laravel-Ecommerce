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
                                <form action="{{route('admin.child-category.update', $childCategory->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" data-tribute="true" name="name" value="{{$childCategory->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Parent Category</label>
                                        <select id="inputState" class="form-control select2 parent-category" name="parent_category">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option {{$category->id == $childCategory->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Sub Category</label>
                                        <select id="inputState" class="form-control select2 sub-category" name="sub_category">
                                            <option value="">Select</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option {{$subCategory->id == $childCategory->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                          <option {{$subCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                          <option {{$subCategory->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
