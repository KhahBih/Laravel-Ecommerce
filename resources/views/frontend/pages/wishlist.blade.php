@extends('frontend.layouts.master')
@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4 class="text-center">Wishlist</h4>
                        {{-- <ul>
                            <li><a href="#">home</a></li>
                            <li><a href="#">peoduct</a></li>
                            <li><a href="#">cart view</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
                            @if(count($products) == 0)
                                <h4 class="text-center">Wishlist is empty!</h4>
                            @else
                                <div class="table-responsive">
                                    <table>
                                        <tbody>
                                            <tr class="d-flex">
                                                <th class="wsus__pro_img">
                                                    product item
                                                </th>

                                                <th class="wsus__pro_name" style="width:580px!important">
                                                    product details
                                                </th>

                                                <th class="wsus__pro_status">
                                                    stock
                                                </th>

                                                <th class="wsus__pro_tk">
                                                    price
                                                </th>

                                                <th class="wsus__pro_icon">
                                                    action
                                                </th>
                                            </tr>
                                            @foreach ($products as $item)
                                                <tr class="d-flex">
                                                    <td class="wsus__pro_img"><img src="{{asset($item->product->thumb_image)}}" alt="product"
                                                            class="img-fluid w-100">
                                                        <a href="{{route('user.wishlist.remove', $item->product_id)}}"><i class="far fa-times"></i></a>
                                                    </td>

                                                    <td class="wsus__pro_name" style="width:580px!important">
                                                        <p>{{$item->product->name}}</p>
                                                    </td>

                                                    <td class="wsus__pro_status">
                                                        <p>{{$item->product->qty}}</p>
                                                    </td>

                                                    <td class="wsus__pro_tk">
                                                        <h6>{{$item->product->price}} {{$settings->currency_icon}}</h6>
                                                    </td>

                                                    <td class="wsus__pro_icon">
                                                        <a class="common_btn" href="{{route('product-detail', $item->product->slug)}}">View Product</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
