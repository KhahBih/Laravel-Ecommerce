@extends('frontend.layouts.master')
@section('title') {{$settings->site_name}} || Payment @endsection
@section('content')
<section id="wsus__cart_view">
    <div class="container">
        <div class="wsus__pay_info_area">
            <div class="row">
                <div class="col-xl-3 col-lg-3">
                    <div class="wsus__payment_menu" id="sticky_sidebar">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            {{-- <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                                aria-selected="true">card payment</button> --}}
                            <button class="nav-link common_btn active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-paypal" type="button" role="tab" aria-controls="v-pills-paypal"
                            aria-selected="true">Paypal</button>
                            <button class="nav-link common_btn" id="v-pills-stripe-tab" data-bs-toggle="pill"
                                data-bs-target="#v-pills-stripe" type="button" role="tab"
                                aria-controls="v-pills-stripe" aria-selected="false">Stripe</button>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5">
                    <div class="tab-content" id="v-pills-tabContent" id="sticky_sidebar">
                        {{-- <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                            aria-labelledby="v-pills-paypal-tab">
                            <div class="row">
                                <div class="col-xl-12 m-auto">
                                    <div class="wsus__payment_area">
                                        <form>
                                            <div class="wsus__pay_caed_header">
                                                <h5>credit or debit card</h5>
                                                <img src="images/payment5.png" alt="payment" class="img-=fluid">
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <input class="input" type="text"
                                                        placeholder="MD. MAHAMUDUL HASSAN SAZAL">
                                                </div>
                                                <div class="col-12">
                                                    <input class="input" type="text"
                                                        placeholder="2540 4587 **** 3215">
                                                </div>
                                                <div class="col-4">
                                                    <input class="input" type="text" placeholder="MM/YY">
                                                </div>
                                                <div class="col-4 ms-auto">
                                                    <input class="input" type="text" placeholder="1234">
                                                </div>
                                            </div>
                                            <div class="wsus__save_payment">
                                                <h6><i class="fas fa-user-lock"></i> 100% secure payment with :</h6>
                                                <img src="images/payment1.png" alt="payment" class="img-fluid">
                                                <img src="images/payment2.png" alt="payment" class="img-fluid">
                                                <img src="images/payment3.png" alt="payment" class="img-fluid">
                                            </div>
                                            <div class="wsus__save_card">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckDefault">save thid Card</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="common_btn">confirm</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="tab-pane fade show active" id="v-pills-paypal" role="tabpanel"
                            aria-labelledby="v-pills-paypal-tab">
                            <div class="row">
                                <div class="col-xl-12 m-auto">
                                    <div class="wsus__payment_area">
                                        <a href="{{route('user.paypal.payment')}}" class="nav-link common_btn text-center">Pay with Paypal</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @include('frontend.pages.payment-gateway.stripe')
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora cum optio
                                cumque rerum dolor impedit exercitationem? Eveniet suscipit repellat, quae natus hic
                                assumenda consequatur excepturi ducimus.</p>
                            <ul>
                                <li>Natus hic assumenda consequatur excepturi ducimu.</li>
                                <li>Cumque rerum dolor impedit exercitationem Eveniet suscipit repellat.</li>
                                <li>Dolor sit amet consectetur adipisicing elit tempora cum .</li>
                                <li>Orem ipsum dolor sit amet consectetur adipisicing elit asperiores.</li>
                            </ul>
                            <form class="wsus__input_area">
                                <input type="text" placeholder="Enter Something">
                                <textarea cols="3" rows="4" placeholder="Enter Something"></textarea>
                                <select class="select_2" name="state">
                                    <option>default select</option>
                                    <option>short by rating</option>
                                    <option>short by latest</option>
                                    <option>low to high </option>
                                    <option>high to low</option>
                                </select>
                                <button type="submit" class="common_btn mt-4">confirm</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="wsus__pay_booking_summary" id="sticky_sidebar2">
                        <h5>Order Summary</h5>
                        <p>subtotal: <span>{{getCartTotal() . $settings->currency_icon}}</span></p>
                        <p>shipping fee: <span>{{getShippingFee() . $settings->currency_icon}} </span></p>
                        <p>coupon: <span>{{getMainCartDiscount()}}</span></p>
                        <h6>total <span>{{getFinalPayableAmount() . $settings->currency_icon}}</span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

