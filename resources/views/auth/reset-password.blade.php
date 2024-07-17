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
                        <h4>change password</h4>
                        <ul>
                            <li><a href="#">login</a></li>
                            <li><a href="#">change password</a></li>
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
        CHANGE PASSWORD START
    ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <div class="wsus__change_password">
                            <input type="hidden" name="token" value="{{ $request->token }}">
                            <h4>Email</h4>
                            <div class="wsus__single_pass">
                                <label>New password</label>
                                <input id="email" name="email" type="text" value="{{$request->email}}" placeholder="New Password">
                            </div>
                            <h4>Change password</h4>
                            <div class="wsus__single_pass">
                                <label>New password</label>
                                <input id="password" name="password" type="password" placeholder="New Password">
                            </div>
                            <div class="wsus__single_pass">
                                <label>Confirm password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password">
                            </div>
                            <button class="common_btn" type="submit">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--============================
        CHANGE PASSWORD END
    ==============================-->
@endsection
