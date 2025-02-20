@extends('frontend.layouts.master')
@section('content')
    <!--============================
        BREADCRUMB START
    ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>cart View</h4>
                        <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        BREADCRUMB END
    ==============================-->


    <!--============================
        CART VIEW PAGE START
    ==============================-->
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-xl-9">
                    <div class="wsus__cart_list">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            product item
                                        </th>

                                        <th class="wsus__pro_name">
                                            product details
                                        </th>

                                        <th class="wsus__pro_select">
                                            quantity
                                        </th>

                                        <th class="wsus__pro_tk">
                                            unit price
                                        </th>

                                        <th class="wsus__pro_tk">
                                            total
                                        </th>

                                        <th class="wsus__pro_icon">
                                            <a href="#" class="common_btn clear_cart">clear cart</a>
                                        </th>
                                    </tr>
                                    @foreach ($cartItems as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{asset($item->options->image)}}" alt="product"
                                                    class="img-fluid w-100" style="height: 100px!important">
                                            </td>

                                            <td class="wsus__pro_name">
                                                <p>{{$item->name}}</p>
                                                @foreach ($item->options->variants as $key => $variant)
                                                    <span>{{$key}}: {{$variant['name']}} ({{$variant['price'].$settings->currency_icon}})</span>
                                                @endforeach
                                            </td>

                                            <td class="wsus__pro_select">
                                                <div class="product_qty_wrapper">
                                                    <button class="btn btn-danger decrement">-</button>
                                                    <input class="product-qty" data-rowid="{{$item->rowId}}"
                                                    type="text" min="1" max="100" value="{{$item->qty}}" />
                                                    <button class="btn btn-success increment">+</button>
                                                </div>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6>{{$item->price.$settings->currency_icon}}</h6>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                <h6 id="{{$item->rowId}}">
                                                    {{(($item->options->variants_total + $item->price) * $item->qty).$settings->currency_icon}}
                                                </h6>
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a href="{{route('cart.remove-product', $item->rowId)}}"><i class="far fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if (count($cartItems) === 0)
                                        <tr class="d-flex" style="justify-content: center!important;">
                                            <td class="wsus__pro_icon">
                                                Cart is empty
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="wsus__cart_list_footer_button" id="sticky_sidebar">
                        <h6>total cart</h6>
                        <p id="subtotal">subtotal: <span>{{getCartTotal()}}{{$settings->currency_icon}}</span></p>
                        <p id="discount_value">discount: <span>{{getMainCartDiscount()}}</span></p>
                        <p class="total" id="totalDiscount"><span>total:</span> <span>{{getMainCartTotal()}}</span></p>
                        <form id="coupon_form">
                            <input type="text" placeholder="Coupon Code" name="coupon_code"
                            value="{{session()->has('coupon') ? session()->get('coupon')['coupon_code'] : ''}}">
                            <button type="submit" class="common_btn">apply</button>
                        </form>
                        <a class="common_btn mt-4 w-100 text-center" href="{{route('user.checkout')}}">checkout</a>
                        <a class="common_btn mt-1 w-100 text-center" href="/"><i
                                class="fab fa-shopify"></i> Keep Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__single_banner">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_2.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>sell on <span>35% off</span></h6>
                            <h3>smart watch</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="wsus__single_banner_content single_banner_2">
                        <div class="wsus__single_banner_img">
                            <img src="images/single_banner_3.jpg" alt="banner" class="img-fluid w-100">
                        </div>
                        <div class="wsus__single_banner_text">
                            <h6>New Collection</h6>
                            <h3>Cosmetics</h3>
                            <a class="shop_btn" href="#">shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
          CART VIEW PAGE END
    ==============================-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            function getCartTotal(){
                $.ajax({
                    method: 'GET',
                    url: "{{ route('cart.total') }}",
                    success: function(data) {
                        $('#subtotal').html(`subtotal: <span>${data}{{$settings->currency_icon}}</span>`);
                    },
                    error: function(data) {

                    }
                })
            }

            function calculateCouponDiscount(){
                $.ajax({
                    url: "{{route('cart.coupon-calculate')}}",
                    method: 'GET',
                    success: function(data){
                        if(data.status == 'success'){
                            $('.total').html(`<span>total:</span> <span>${data.cart_total}{{$settings->currency_icon}}</span>`)
                            if(data.discount_type == 'percent'){
                                return $('#discount_value').html(`discount: <span>${data.discount}%</span>`)
                            }else if(data.discount_type == 'amount'){
                                return $('#discount_value').html(`discount: <span>${data.discount_value}{{$settings->currency_icon}}</span>`)
                            }else{
                                return $('#discount_value').html(`discount: <span>0{{$settings->currency_icon}}</span>`)
                            }
                        }
                    },
                    error: function(data){

                    }
                })
            }

            $('.increment').on('click', function(){
                let input = $(this).siblings('.product-qty');
                let quantity = parseInt(input.val()) + 1;
                let rowId = input.data('rowid');
                $.ajax({
                    url: "{{route('update-quantity')}}",
                    method: 'POST',
                    data: {
                        rowId: rowId,
                        quantity: quantity
                    },
                    success: function(data){
                        let productId = '#'+rowId;
                        let total = data.product_total+data.currencyIcon;
                        if(data.status == 'error'){
                            toastr.error(data.message);
                            $(productId).text(total);
                        }else{
                            input.val(quantity);
                            getCartTotal()
                            calculateCouponDiscount()
                            $(productId).text(total);
                        }
                    },
                    error: function(data){

                    }
                })
            })

            $('.decrement').on('click', function(e){
                let input = $(this).siblings('.product-qty');
                if(input.val() > 1){
                    let quantity = parseInt(input.val()) - 1;
                    let rowId = input.data('rowid');
                    input.val(quantity);
                    $.ajax({
                        url: "{{route('update-quantity')}}",
                        method: 'POST',
                        data: {
                            rowId: rowId,
                            quantity: quantity
                        },
                        success: function(data){
                            let productId = '#'+rowId;
                            let total = data.product_total+data.currencyIcon;
                            getCartTotal()
                            calculateCouponDiscount()
                            $(productId).text(total);
                        },
                        error: function(data){

                        }
                    })
                }
            })

            $('.clear_cart').on('click', function(e){
                e.preventDefault();
                Swal.fire({
                title: "Are you sure?",
                text: "This action wil clear your cart!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, clear it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: 'GET',
                            url: "{{route('clear-cart')}}",
                            success: function(data){
                                if(data.status == 'success'){
                                    window.location.reload();
                                }else if(data.status == 'error'){

                                }
                            },
                            error: function(xhr, status, error){
                                console.log(error);
                            }
                        });
                    }
                });
            });

            $('#coupon_form').on('submit', function(e){
                e.preventDefault();
                let data = $(this).serialize()
                $.ajax({
                    url: "{{route('cart.apply-coupon')}}",
                    method: 'GET',
                    data: data,
                    success: function(data){
                        if(data.status == 'error'){
                            toastr.error(data.message);
                        }else if(data.status == 'success'){
                            calculateCouponDiscount()
                            toastr.success(data.message);
                        }
                    },
                    error: function(data){

                    }
                })
            })
        })
    </script>
@endpush
