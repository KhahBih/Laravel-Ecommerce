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
                          <label>name <b>*</b></label>
                          <input type="text" placeholder="name">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>email</label>
                          <input type="email" placeholder="email">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>phone <b>*</b></label>
                          <input type="text" placeholder="phone">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label for="city">city <b>*</b></label>
                          <div class="wsus__topbar_select">
                            <select class="select_2 city" name="city" id="city">
                                <option value="">Select</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label for="district">District <b>*</b></label>
                          <div class="wsus__topbar_select">
                            <select class="select_2 district" name="district" id="district">
                                <option value="">Select</option>

                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>zip code <b>*</b></label>
                          <input type="text" placeholder="Zip Code" name="zip_code">
                        </div>
                      </div>
                      <div class="col-xl-6 col-md-6">
                        <div class="wsus__add_address_single">
                          <label>address <b>*</b></label>
                          <input type="text" placeholder="Home / Office / others" name="address">
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
            $('body').on('change', '.city', function(e){
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
                                $('.district').append(`<option value="${item.id}">${item.name}</option>`)
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
