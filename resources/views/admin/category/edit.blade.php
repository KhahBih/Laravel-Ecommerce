@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Category</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label>Iconc</label>
                                        <div><button class="btn btn-primary" data-selected-class="btn-danger"
                                            data-unselected-class="btn-info" role="iconpicker" name="icon" data-icon="{{$category->icon}}"></button></div>
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" data-tribute="true" name="name" value="{{$category->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">Status</label>
                                        <select id="inputState" class="form-control" name="status">
                                          <option {{$category->status == 1 ? 'selected' : ''}} value="1">Active</option>
                                          <option {{$category->status == 0 ? 'selected' : ''}} value="0">Inactive</option>
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
