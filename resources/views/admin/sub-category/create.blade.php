@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Create Sub Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{route('admin.sub-category.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" data-tribute="true" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Parent Category</label>
                                        <select id="inputState" class="form-control select2" name="parent_category">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
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
