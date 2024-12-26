@extends('frontend.layouts.master')
@section('title') Check out @endsection
@section('content')

    <!--============================
        CHECK OUT PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
                <h2>Check Out</h2>
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <div class="wsus__check_form">
                            <h5>Shipping Details <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">add
                                    new address</a></h5>
                            <div class="row">
                                @foreach ($addresses as $address)
                                    <div class="col-xl-6">
                                        <div class="wsus__checkout_single_address">
                                            <div class="form-check">
                                                <input class="form-check-input shipping_address" type="radio"
                                                name="flexRadioDefault" id="flexRadioDefault1" data-id="{{$address->id}}">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Select Address
                                                </label>
                                            </div>
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
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="wsus__order_details" id="sticky_sidebar">
                            <p class="wsus__product">shipping Methods</p>
                            @foreach ($shippingMethods as $shippingMethod)
                                @if ($shippingMethod->type === 'min_cost' && getCartTotal() >= $shippingMethod->min_cost)
                                    <div class="form-check">
                                        <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios1"
                                            value="{{$shippingMethod->id}}" data-id="{{$shippingMethod->cost}}">
                                        <label class="form-check-label" for="exampleRadios1">
                                            {{$shippingMethod->name}}
                                            <span>cost: {{$shippingMethod->cost . $settings->currency_icon}}</span>
                                        </label>
                                    </div>
                                @elseif ($shippingMethod->type === 'flat_cost')
                                    <div class="form-check">
                                        <input class="form-check-input shipping_method" type="radio" name="exampleRadios" id="exampleRadios2"
                                            value="{{$shippingMethod->id}}" data-id="{{$shippingMethod->cost}}">
                                        <label class="form-check-label" for="exampleRadios2">
                                            {{$shippingMethod->name}}
                                            <span>cost: {{$shippingMethod->cost . $settings->currency_icon}}</span>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                            <div class="wsus__order_details_summery">
                                <p>subtotal: <span>{{getCartTotal() . $settings->currency_icon}}</span></p>
                                <p>shipping fee: <span id="shipping_fee">0{{$settings->currency_icon}}</span></p>
                                <p>Coupon: <span>{{getMainCartDiscount()}}</span></p>
                                <p>tax: <span>$00.00</span></p>
                                <p><b>total:</b> <span><b id="total_amount" data-id="{{getMainCartTotal()}}">{{getMainCartTotal() . $settings->currency_icon}}</b></span></p>
                            </div>
                            <div class="terms_area">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked3"
                                        checked>
                                    <label class="form-check-label" for="flexCheckChecked3">
                                        I have read and agree to the website <a href="#">terms and conditions *</a>
                                    </label>
                                </div>
                            </div>
                            <form action="" id="checkOutForm">
                                <input type="hidden" name="shipping_method_id" value="" id="shipping_method_id">
                                <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">
                            </form>
                            <a href="" id="submitCheckoutForm" class="common_btn">Place Order</a>
                        </div>
                    </div>
                </div>
        </div>
    </section>

    <div class="wsus__popup_address">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">add new address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="wsus__check_form p-3">
                            <form action="{{route('user.checkout.create-address')}}" method="POST">
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
                                            @foreach ($provinces as $city)
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
    </div>
    <!--============================
        CHECK OUT PAGE END
    ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('input[type="radio"]').prop('checked', false)
            $('#shipping_method_id').val('')
            $('#shipping_address_id').val('')
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

            $('#submitCheckoutForm').on('click', function(e){
                e.preventDefault();
                if($('#shipping_method_id').val() == ''){
                    toastr.error('Shipping method is required!')
                }else if($('#shipping_address_id').val() == ''){
                    toastr.error('Address is required!')
                }else{
                    $.ajax({
                            method: 'POST',
                            url: "{{route('user.checkout.form-submit')}}",
                            data: $('#checkOutForm').serialize(),
                            success: function(data){

                            },
                            error: function(xhr, status, error){
                                console.log(error);
                            }
                    })
                }
            })

            $('.shipping_method').on('click', function(e){
                let shippingFee = $(this).data('id')
                let currentTotalAmount = $('#total_amount').data('id')
                let totalAmount = currentTotalAmount + shippingFee
                $('#shipping_method_id').val($(this).val())
                $('#shipping_fee').text(shippingFee + "{{$settings->currency_icon}}")
                $('#total_amount').text(totalAmount + "{{$settings->currency_icon}}")
            })

            $('.shipping_address').on('click', function(e){
                $('#shipping_address_id').val($(this).data('id'))
            })
        })
    </script>
@endpush
@include('frontend.layouts.scripts')
