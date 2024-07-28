@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Table</h1>
            <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="#">Components</a></div>
            <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h4>Simple Table</h4>
                        <div class="card-header-action">
                            <a href="{{route('admin.slider.create')}}" class="btn btn-primary">+ Add new</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="table-responsive">
                        <table class="table table-bordered table-md">
                            <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Irwansyah Saputra</td>
                            <td>2017-01-09</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>2</td>
                            <td>Hasan Basri</td>
                            <td>2017-01-09</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>3</td>
                            <td>Kusnadi</td>
                            <td>2017-01-11</td>
                            <td><div class="badge badge-danger">Not Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                            <tr>
                            <td>4</td>
                            <td>Rizal Fakhri</td>
                            <td>2017-01-11</td>
                            <td><div class="badge badge-success">Active</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                            </tr>
                        </table>
                        </div> --}}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
