@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar');
        <div class="row">
            <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
              <div class="dashboard_content mt-2 mt-md-0" style="margin-top: -30px!important">
                <h3><i class="fal fa-gift-card"></i>create address</h3>
                <div class="wsus__dashboard_add wsus__add_address">
                  <form action="{{route('user.address.store')}}" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>Tên địa chỉ <b>*</b></label>
                          <input type="text" placeholder="Tên địa chỉ" name="address_name" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>email <b>*</b></label>
                          <input type="email" placeholder="Email" name="email" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>Số điện thoại <b>*</b></label>
                          <input type="text" placeholder="Số điện thoại" name="phone" autocomplete="off">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label for="city">Tỉnh/Thành phố <b>*</b></label>
                          <div class="wsus__topbar_select">
                            <select class="select_2 province" name="province" id="province">
                                <option value="">Select</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->code}}">{{$city->full_name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label for="district">Quận/Huyện <b>*</b></label>
                          <div class="wsus__topbar_select">
                            <select class="select_2 district" name="district" id="district">
                                <option value="">Select</option>

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>Phường/Xã <b>*</b></label>
                          <select class="select_2 ward" name="ward" id="ward">
                            <option value="">Select</option>

                        </select>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>Mã Zip <b>*</b></label>
                          <input type="text" placeholder="Mã Zip" name="zip_code">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>Địa chỉ cụ thể <b>*</b></label>
                          <input type="text" name="address">
                        </div>
                      </div>
                      <div class="col-xl-6">
                        <button type="submit" class="common_btn">Create</button>
                      </div>
                    </div>
                  </form>
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
            $('body').on('change', '.province', function(e){
                e.preventDefault();
                let id = $(this).val();
                let url = "{{route('user.address.getDistrict')}}";
                $.ajax({
                        method: 'GET',
                        url: url,
                        data: {
                            id:id
                        },
                        success: function(data){
                            $('.district').html('<option value="">Select</option>');
                            $.each(data, function(i, item){
                                $('.district').append(`<option value="${item.code}">${item.full_name}</option>`)
                            });
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                })
            })
            $('body').on('change', '.district', function(e){
                e.preventDefault();
                let id = $(this).val();
                let url = "{{route('user.address.getWard')}}";
                $.ajax({
                        method: 'GET',
                        url: url,
                        data: {
                            id:id
                        },
                        success: function(data){
                            $('.ward').html('<option value="">Select</option>');
                            $.each(data, function(i, item){
                                $('.ward').append(`<option value="${item.code}">${item.full_name}</option>`)
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
