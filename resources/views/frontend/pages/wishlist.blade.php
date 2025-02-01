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

                                        <th class="wsus__pro_status">
                                            status
                                        </th>

                                        <th class="wsus__pro_tk">
                                            price
                                        </th>

                                        <th class="wsus__pro_icon">
                                            action
                                        </th>
                                    </tr>
                                    <tr class="d-flex">
                                        <td class="wsus__pro_img"><img src="images/pro9_9.jpg" alt="product"
                                                class="img-fluid w-100">
                                            <a href="#"><i class="far fa-times"></i></a>
                                        </td>

                                        <td class="wsus__pro_name">
                                            <p>men's fashion sholder leather bag</p>
                                        </td>

                                        <td class="wsus__pro_status">
                                            <p>in stock</p>
                                        </td>

                                        <td class="wsus__pro_tk">
                                            <h6>$180,00</h6>
                                        </td>

                                        <td class="wsus__pro_icon">
                                            <a class="common_btn" href="#">add to cart</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
