<?php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
?>
@extends('vendor.layouts.master')
@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
        @include('vendor.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0" style="margin-top: -35px!important">
            <div style="display: flex!important; align-items: baseline;">
                <h3><i class="far fa-user"></i> Order Details</h3>
            </div>
            <div class="wsus__dashboard_profile invoice-print">
              <div class="wsus__dash_pro_area">
                    <div class="">
                        <div class="wsus__invoice_header">
                            <div class="wsus__invoice_content">
                                <div class="row">
                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                        <div class="wsus__invoice_single">
                                            <h5>Billing Information</h5>
                                            <h6><b>Name: </b>{{$order->user->name}}</h6>
                                            <p><b>Email: </b>{{$order->user->email}}</p>
                                            <p><b>Phone: </b>{{$order->user->phone}}</p>
                                            <p><b>Zip code: </b>{{$address->zip_code}}</p>
                                            <p><b>Address Detail: </b>{{$address->detail_address}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 mb-5 mb-md-0">
                                        <div class="wsus__invoice_single">
                                            <h5>shipping information</h5>
                                            <h6><b>Name: </b>{{$order->user->name}}</h6>
                                            <p><b>Email: </b>{{$order->user->email}}</p>
                                            <p><b>Phone: </b>{{$order->user->phone}}</p>
                                            <p><b>Zip code: </b>{{$address->zip_code}}</p>
                                            <p><b>Address Detail: </b>{{$address->detail_address}}</p>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4">
                                        <div class="wsus__invoice_single text-md-end">
                                            <h5><b>Order ID:</b> #{{$order->invoice_id}}</h5>
                                            <h6><b>Order Status:</b> {{config('order_status.order_status_admin')[$order->order_status]['status']}}</h6>
                                            <p><b>Payment Method:</b> {{$order->payment_method}}</p>
                                            <p><b>Payment Status:</b> {{$order->payment_status}}</p>
                                            <p><b>Transaction ID:</b> #{{$order->transaction->transaction_id}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__invoice_description">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th class="amount" style="width: 30px!important">
                                                ID
                                            </th>

                                            <th class="name">
                                                product
                                            </th>

                                            <th class="amount">
                                                Shop Name
                                            </th>

                                            <th class="amount">
                                                amount
                                            </th>

                                            <th class="quentity">
                                                quantity
                                            </th>
                                            <th class="total">
                                                total
                                            </th>
                                        </tr>
                                        @foreach ($order->orderProducts as $product)
                                            <?php
                                                $variants = json_decode($product->variants);
                                                $total = 0;
                                                $total += $product->unit_price * $product->qty;
                                            ?>
                                                <tr>
                                                    <td class="amount" style="width: 30px!important">
                                                        {{++$loop->index}}
                                                    </td>
                                                    <td class="name">
                                                        <p>{{$product->product_name}}</p>
                                                        @foreach ($variants as $key => $variant)
                                                            <span>{{$key}} : {{$variant->name}} ( {{$variant->price.$settings->currency_icon}} )</span>
                                                        @endforeach
                                                    </td>
                                                    <td class="amount">
                                                        {{$product->vendor->shop_name}}
                                                    </td>
                                                    <td class="amount">
                                                        {{$product->unit_price}} {{$settings->currency_icon}}
                                                    </td>

                                                    <td class="quentity">
                                                        {{$product->qty}}
                                                    </td>
                                                    <td class="total">
                                                        {{ $product->unit_price * $product->qty }}
                                                        {{ $settings->currency_icon }}
                                                    </td>
                                                </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_footer">
                            <p><span>Subtotal:</span>{{$order->sub_total}} {{$settings->currency_icon}}</p>
                            <p><span>Shipping fee:</span>{{$shipping->cost}} {{$settings->currency_icon}}</p>
                            <p><span>Coupon:</span>
                                @if (!isset($coupon->discount_value))
                                0 {{$settings->currency_icon}}
                                @elseif ($coupon->discount_type == 'amount')
                                    {{$coupon->discount_value}} {{$settings->currency_icon}}
                                @elseif ($coupon->discount_type == 'percent')
                                    {{$coupon->discount_value}} %
                                @endif
                            </p>
                            <p><span>Total Amount:</span>{{$order->amount}} {{$settings->currency_icon}}</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">
                        <div class="mt-5 float-end">
                            <button class="btn btn-warning print_invoice" style="color: white!important">Print</button>
                        </div>
                    </div>
                </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  <script>
    $('.print_invoice').on('click', function(e){
        e.preventDefault()
        let printBody = $('.invoice-print')
        let originalContents = $('body').html()
        $('body').html(printBody.html())
        window.print();
        $('body').html(originalContents)
    })
  </script>
@endpush

