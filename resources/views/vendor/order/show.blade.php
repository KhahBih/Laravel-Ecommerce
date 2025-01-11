<?php $address = json_decode($order->order_address); ?>
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
            <div class="wsus__dashboard_profile">
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
                                            <h6><b>Order Status:</b> {{$order->order_status}}</h6>
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
                                            @if ($product->vendor_id == Auth::user()->vendor->id)
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
                                                        {{$product->unit_price.$settings->currency_icon}}
                                                    </td>

                                                    <td class="quentity">
                                                        {{$product->qty}}
                                                    </td>
                                                    <td class="total">
                                                        $110
                                                    </td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="wsus__invoice_footer">
                            <p><span>Total Amount:</span>{{$total}} {{$settings->currency_icon}}</p>
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

@endpush

