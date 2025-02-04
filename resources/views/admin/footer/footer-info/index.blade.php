@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Footer</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-body">
                                <form action="{{route('admin.footer-info.update', 1)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <img src="{{asset($footerInfo->logo)}}" alt="" style="width: 100px; height: 100px">
                                        <div style="display:flex; flex-direction: column">
                                            <label>Footer Logo</label>
                                            <input type="file" class="form-control" data-tribute="true" name="logo" style="height: 47px!important">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input type="text" class="form-control" data-tribute="true" name="phone" value="{{$footerInfo->phone}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" data-tribute="true" name="email" value="{{$footerInfo->email}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" data-tribute="true" name="address" value="{{$footerInfo->address}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Copyright</label>
                                        <input type="text" class="form-control" data-tribute="true" name="copyright" value="{{$footerInfo->copyright}}">
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
