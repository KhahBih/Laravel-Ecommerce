@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Vendor Profile</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h3>Edit Vendor</h3>
                    </div>
                    <div class="card-body">
                       <form action="{{route('admin.vendor-profile.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="form-group">
                                <label>Banner</label>
                                <input type="file" class="form-control" data-tribute="true" name="banner">
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" data-tribute="true" name="phone" value="{{old('phone')}}">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" data-tribute="true" name="email" value="{{old('email')}}">
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" data-tribute="true" name="address" value="{{old('address')}}">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="summernote" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Facebook</label>
                                <input type="text" class="form-control" data-tribute="true" name="fb_link" value="{{old('fb_link')}}">
                            </div>
                            <div class="form-group">
                                <label>Twitter</label>
                                <input type="text" class="form-control" data-tribute="true" name="tw_link" value="{{old('tw_link')}}">
                            </div>
                            <div class="form-group">
                                <label>Instagram</label>
                                <input type="text" class="form-control" data-tribute="true" name="insta_link" value="{{old('insta_link')}}">
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
