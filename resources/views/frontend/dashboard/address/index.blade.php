@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar');
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
              <div class="dashboard_content" style="margin-top: -30px!important">
                <h3><i class="fal fa-gift-card"></i> address</h3>
                <div class="wsus__dashboard_add">
                  <div class="row">
                    @foreach ($addresses as $address)
                        <div class="col-xl-6">
                            <div class="wsus__dash_add_single">
                                <h4>Billing Address <span>office</span></h4>
                                <ul>
                                    <li><span>Tên địa chỉ :</span> {{$address->name}}</li>
                                    <li><span>Số điện thoại :</span> +{{$address->phone}}</li>
                                    <li><span>email :</span> {{$address->email}}</li>
                                    <li><span>Tỉnh/Thành phố :</span>
                                        @foreach ($provinces as $province)
                                            @if ($address->province == $province->code)
                                                {{$province->full_name}}
                                            @endif
                                        @endforeach
                                    </li>
                                    <li><span>Quận/Huyện :</span>
                                        @foreach ($districts as $district)
                                            @if ($address->district == $district->code)
                                                {{$district->full_name}}
                                            @endif
                                        @endforeach
                                    </li>
                                    <li><span>Phường/Xã :</span>
                                        @foreach ($wards as $ward)
                                            @if ($address->ward == $ward->code)
                                                {{$ward->full_name}}
                                            @endif
                                        @endforeach
                                    </li>
                                    <li><span>Mã Zip :</span> {{$address->zip_code}}</li>
                                    <li><span>Địa chỉ chi tiết :</span> {{$address->detail_address}}</li>
                                </ul>
                                <div class="wsus__address_btn">
                                    <a href="{{route('user.address.edit', $address->id)}}" class="edit"><i class="fal fa-edit"></i> edit</a>
                                    <a href="{{route('user.address.destroy', $address->id)}}" class="del delete-item"><i class="fal fa-trash-alt"></i> delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-12">
                      <a href="{{route('user.address.create')}}" class="add_address_btn common_btn"><i class="far fa-plus"></i>
                        add new address</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </section>
@endsection
