<?php
    $address = json_decode($order->order_address);
    $shippingMethod = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
?>
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
                                                <th>Shop name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th class="text-right">Totals</th>
                                            </tr>
                                            @foreach ($order->orderProducts as $product)
                                                <?php $variants = json_decode($product->variants); ?>
                                                <tr>
                                                    <td>{{++$loop->index}}</td>
                                                    @if ($product->product->slug)
                                                        <td><a href="{{route('product-detail',$product->product->slug )}}">{{$product->product_name}}</a></td>
                                                    @else
                                                        <td>{{$product->product_name}}</td>
                                                    @endif
                                                    <td>
                                                        @foreach ($variants as $key => $variant)
                                                            <b>{{$key}}:</b>
                                                            {{$variant->name}} ( {{$variant->price.$settings->currency_icon}} )</br>
                                                        @endforeach
                                                    </td>
                                                    <td>{{$product->vendor->shop_name}}</td>
                                                    <td>{{$product->unit_price.$settings->currency_icon}}</td>
                                                    <td>{{$product->qty}}</td>
                                                    <td class="text-right">
                                                        {{(($product->unit_price+ $product->variant_total)*$product->qty).$settings->currency_icon}}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-8">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Order Status</label>
                                                        <select name="" id="order_status" data-id="{{$order->id}}" class="form-control">
                                                            @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                                <option {{$order->order_status == $key ? 'selected' : ''}}
                                                                    value="{{$key}}">{{$orderStatus['status']}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 text-right">
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Subtotal</div>
                                                    <div class="invoice-detail-value">{{@$order->sub_total.$order->currency_icon}}</div>
                                                </div>
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Shipping</div>
                                                    <div class="invoice-detail-value">{{@$shippingMethod->cost.$order->currency_icon}}</div>
                                                </div>
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Coupon</div>
                                                    <div class="invoice-detail-value">
                                                        @if ($coupon->discount_value == null)
                                                            0 {{$order->currency_icon}}
                                                        @else()
                                                            @if($coupon->discount_type == 'percent')
                                                                {{($order->sub_total*$coupon->discount_value/100) . $order->currency_icon}}
                                                            @elseif ($coupon->discount_type == 'amount')
                                                                {{$coupon->discount_value . $order->currency_icon}}
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                                <hr class="mt-2 mb-2">
                                                <div class="invoice-detail-item">
                                                    <div class="invoice-detail-name">Total</div>
                                                    <div class="invoice-detail-value invoice-detail-value-lg">{{@$order->amount.$order->currency_icon}}</div>
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
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#order_status').on('change', function(e){
                e.preventDefault()
                let status = $(this).val()
                let id = $(this).data('id')
                $.ajax({
                    method: 'GET',
                    url: "{{route('admin.order.status')}}",
                    data: {
                        id: id,
                        status: status
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            toastr.success(data.message);

                        }
                    },
                    error: function(data){
                        alert('Error')
                    }
                })
            })
        })
    </script>
@endpush
