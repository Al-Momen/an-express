@php
    $credentials = $general->socialite_credentials;
@endphp
@extends('Template::layouts.frontend')
@section('content')
    <!-- sign-up section start -->
    <section class="account py-120">
        <div>
            <div class="common__shape">
                <img src="{{ asset($activeTemplateTrue . 'images/shape/shape.png') }}" alt="@lang('image')">
            </div>
            <div class="common__shape">
                <img src="{{ asset($activeTemplateTrue . 'images/shape/shape-4.png') }}" alt="@lang('image')">
            </div>
        </div>
        <div>
            <div class="glove--base"></div>
            <div class="glove--base"></div>
            <div class="glove--base"></div>
            <div class="glove--base"></div>
        </div>
        <div class="pattern-1 mask-box" data-mask="{{ asset($activeTemplateTrue . 'images/shape/pattern.png') }}"></div>
        <div class="account__inner">
            <div class="account__form-wrap">
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ getImage(getFilePath('logoIcon') . '/logo_white.png', '?' . time()) }}"
                        alt="@lang('image')">
                </a>
                <form class="account__form verify-gcaptcha" method="POST" action="{{ route('user.login') }}">
                    @csrf
                    <div class="row gx-3 gy-4">
                        <div class="col-12">
                            <div class="account__header">
                                <h6 class="account__subtitle">@lang('Welcome back!')</h6>
                                <h2 class="account__title">@lang('Sign in your account')</h2>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="text" class="form-control" placeholder="@lang('Enter User Name')" name="username"
                                value="{{ old('username') }}" required>
                        </div>

                        <div class="col-12">
                            <div class="overflow-hidden">
                                <div class="position-relative">
                                    <input id="password" type="password" name="password" class="form-control"
                                        placeholder="@lang('Enter your password')">
                                    <span class="password-show-hide fas fa-eye toggle-password" id="#password"></span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="flex-between gap-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="remember"
                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label w-auto" for="remember">@lang('Remember Me')</label>
                                </div>
                                <a href="{{ route('user.password.request') }}" class="btn--unstyle">@lang('Forgot Password?')</a>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6 col-sm-6 recap">
                            <x-captcha></x-captcha>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn--base w-100">@lang('SINE IN ACCOUNT')</button>
                        </div>

                        @if ($credentials->google->status == 1 || $credentials->facebook->status == 1)
                            <div class="col-12">
                                <p class="account__or">@lang('Or')</p>
                            </div>
                            <div class="col-12">
                                <ul class="social-list">
                                    @if ($credentials->google->status == 1)
                                        <li class="social-list__item">
                                            <a href="{{ route('user.social.login', 'google') }}"
                                                class="social-list__link flex-center">
                                                <i class="fa-brands fa-google"></i>
                                            </a>
                                        </li>
                                    @endif
                                    @if ($credentials->facebook->status == 1)
                                        <li class="social-list__item">
                                            <a href="{{ route('user.social.login', 'facebook') }}"
                                                class="social-list__link flex-center">
                                                <i class="fa-brands fa-facebook-f"></i>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                        <div class="col-sm">
                            <p class="account__already text-center">@lang("Don't have an account?")
                                <a href="{{ route('user.register') }}" class="btn--underline">@lang('Register Now')</a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- sign-up section start -->
@endsection


@push('script')
    <script>
        $(document).ready(function() {
            'use strict';
            $('.recap').each(function() {
                if ($(this).children().length === 0) {
                    $(this).addClass('d-none');
                } else {
                    $(this).removeClass('d-none');
                }
            });
        });
    </script>
@endpush
