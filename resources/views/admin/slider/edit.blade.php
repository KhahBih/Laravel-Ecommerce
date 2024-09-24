@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Slider</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Edit Slider</h3>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-group" style="display: flex!important; flex-direction: column!important">
                                <label>Image</label>
                                <img src="{{asset($slider->banner)}}" alt="" width="300px" height="300px">
                            </div>
                            <div class="form-group">
                                <label>Banner</label>
                                <input type="file" class="form-control" data-tribute="true" name="banner">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <input type="text" class="form-control" data-tribute="true" name="type" value="{{$slider->type}}">
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" data-tribute="true" name="title" value="{{$slider->title}}">
                            </div>
                            <div class="form-group">
                                <label>Starting Price</label>
                                <input type="text" class="form-control" data-tribute="true" name="starting_price" value="{{$slider->starting_price}}">
                            </div>
                            <div class="form-group">
                                <label>Button URL</label>
                                <input type="text" class="form-control" data-tribute="true" name="btn_url" value="{{$slider->btn_url}}">
                            </div>
                            <div class="form-group">
                                <label>Serial</label>
                                <input type="text" class="form-control" data-tribute="true" name="serial" value="{{$slider->serial}}">
                            </div>
                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status" value="{{$slider->status}}">
                                  <option {{$slider->status == '1' ? 'selected' : ''}} value="1">Active</option>
                                  <option {{$slider->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
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
