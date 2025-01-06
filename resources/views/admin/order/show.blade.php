<?php $address = json_decode($order->order_address); ?>
@extends('admin.layouts.master')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="section-body">
                                <div class="invoice">
                                <div class="invoice-print">
                                    <div class="row">
                                    <div class="col-lg-12">
                                        <div class="invoice-title">
                                            <div style="float:left!important" class="invoice-number">Order #{{$order->invoice_id}}</div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                            <strong>Billed To:</strong><br>
                                                <b>Name: </b>{{$address->name}}<br>
                                                <b>Email: </b>{{$address->email}}<br>
                                                <b>Phone: </b>{{$address->phone}}<br>
                                                <b>Zip code: </b>{{$address->zip_code}}<br>
                                                <b>Address: </b>{{$address->detail_address}}<br>
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                                <strong>Billed To:</strong><br>
                                                    <b>Name: </b>{{$address->name}}<br>
                                                    <b>Email: </b>{{$address->email}}<br>
                                                    <b>Phone: </b>{{$address->phone}}<br>
                                                    <b>Zip code: </b>{{$address->zip_code}}<br>
                                                    <b>Address: </b>{{$address->detail_address}}<br>
                                            </address>
                                        </div>
                                        </div></br>
                                        <div class="row">
                                        <div class="col-md-6">
                                            <address>
                                            <strong>Payment Infomation:</strong><br>
                                            <b>Method: </b>{{Str::ucfirst($order->payment_method);}}</br>
                                            <b>Transaction ID: </b>{{@$order->transaction->transaction_id}}</br>
                                            <b>Status: </b>{{$order->order_status == 1 ? 'Complete' : 'Pending'}}
                                            </address>
                                        </div>
                                        <div class="col-md-6 text-md-right">
                                            <address>
                                            <strong>Order Date:</strong><br>
                                            {{date('d M, Y', strtotime($order->created_at))}}<br><br>
                                            </address>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="section-title">Order Summary</div>
                                        <p class="section-lead">All items here cannot be deleted.</p>
                                        <div class="table-responsive">
                                        <table class="table table-striped table-hover table-md">
                                            <tr>
                                                <th data-width="40">#</th>
                                                <th>Item</th>
                                                <th>Variant</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-right">Totals</th>
                                            </tr>
                                            @foreach ($order->orderProducts as $product)
                                                <?php $variants = json_decode($product->variants); ?>
                                                <tr>
                                                    <td>{{++$loop->index}}</td>
                                                    <td>{{$product->product_name}}</td>
                                                    <td>
                                                        @foreach ($variants as $key => $variant)
                                                            <b>{{$key}}:</b>
                                                            {{$variant->name}} ( {{$variant->price.$settings->currency_icon}} )</br>
                                                        @endforeach
                                                    </td>
                                                    <td class="text-center">{{$product->unit_price.$settings->currency_icon}}</td>
                                                    <td class="text-center">{{$product->qty}}</td>
                                                    <td class="text-right">
                                                        {{($product->unit_price*$product->qty).$settings->currency_icon}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        </div>
                                        <div class="row mt-4">
                                        <div class="col-lg-8">
                                            <div class="section-title">Payment Method</div>
                                            <p class="section-lead">The payment method that we provide is to make it easier for you to pay invoices.</p>
                                            <div class="images">
                                            <img src="assets/img/visa.png" alt="visa">
                                            <img src="assets/img/jcb.png" alt="jcb">
                                            <img src="assets/img/mastercard.png" alt="mastercard">
                                            <img src="assets/img/paypal.png" alt="paypal">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 text-right">
                                            <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Subtotal</div>
                                            <div class="invoice-detail-value">$670.99</div>
                                            </div>
                                            <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Shipping</div>
                                            <div class="invoice-detail-value">$15</div>
                                            </div>
                                            <hr class="mt-2 mb-2">
                                            <div class="invoice-detail-item">
                                            <div class="invoice-detail-name">Total</div>
                                            <div class="invoice-detail-value invoice-detail-value-lg">$685.99</div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="text-md-right">
                                    <div class="float-lg-left mb-lg-0 mb-3">
                                    <button class="btn btn-primary btn-icon icon-left"><i class="fas fa-credit-card"></i> Process Payment</button>
                                    <button class="btn btn-danger btn-icon icon-left"><i class="fas fa-times"></i> Cancel</button>
                                    </div>
                                    <button class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Print</button>
                                </div>
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
