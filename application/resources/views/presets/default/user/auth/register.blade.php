@php
    $credentials = $general->socialite_credentials;
    $policyPages = getContent('policy_pages.element', false, null, true);
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
                <form action="{{ route('user.register') }}" method="POST" class="account__form verify-gcaptcha">
                    @csrf
                    <div class="row  gx-3 gy-4">
                        <div class="col-12">
                            <div class="account__header">
                                <h6 class="account__subtitle">@lang('Welcome back!')</h6>
                                <h2 class="account__title">@lang('Sign Up your account')</h2>
                                <p class="account__desc">@lang('It only takes a minute to start earning with surveys you’ll actually enjoy.')</p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <input type="text" class="form-control" placeholder="@lang('Enter User Name')" name="username"
                                value="{{ old('username') }}" required>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="@lang('Email Address')" required>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <select id="country" name="country" class="form-control select2" required>
                                @foreach ($countries as $key => $country)
                                    <option data-mobile_code="{{ $country->dial_code }}" value="{{ $country->country }}"
                                        data-code="{{ $key }}">
                                        {{ __($country->country) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <input type="hidden" name="mobile_code">
                            <input type="hidden" name="country_code">
                            <div class="input-group">
                                <span class="input-group-text mobile-code"></span>
                                <input type="tel" id="phoneNumber" name="mobile" class="form-control checkUser"
                                    placeholder="@lang('Phone Number')">
                                <p class="text--danger mobileExist"></p>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="position-relative w-100">
                                <input id="your-password" type="password" class="form-control"
                                    placeholder="@lang('Password')" required>
                                <span class="password-show-hide fas fa-eye toggle-password" id="#your-password"></span>
                                @if ($general->secure_password)
                                    <div class="input-popup">
                                        <p class="error lower text--white">@lang('1 small letter minimum')</p>
                                        <p class="error capital text--white">@lang('1 capital letter minimum')</p>
                                        <p class="error number text--white">@lang('1 number minimum')</p>
                                        <p class="error special text--white">@lang('1 special character minimum')</p>
                                        <p class="error minimum text--white">@lang('6 character password')</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-6">
                            <div class="position-relative w-100">
                                <input id="confirm-password" type="password" class="form-control"
                                    name="password_confirmation" placeholder="@lang('Confirm Password')" required>
                                <span class="password-show-hide fas fa-eye toggle-password" id="#confirm-password"></span>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-6 col-sm-6 recap">
                            <x-captcha></x-captcha>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="remember">
                                <label class="form-check-label" for="remember">@lang('I agree with')
                                    @foreach ($policyPages as $policy)
                                        <a href="{{ route('policy.pages', [slug($policy->data_values->title), $policy->id]) }}"
                                            class="btn--underline">{{ __($policy->data_values->title) ?? '' }}</a>
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn--base w-100" id="recaptcha">@lang('Sign Up')</button>
                        </div>
                        <div class="col-sm-12">
                            <div class="have-account text-center">
                                <p class="have-account__text">@lang('You have any account?') <a href="{{ route('user.login') }}"
                                        class="btn--underline">@lang('Sign In')</a>@lang('Here')</p>
                            </div>
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
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- sign-up section start -->
    {{-- =======-** Sign Up End **-======= --}}
    <div class="modal fade" id="existModalCenter" tabindex="-1" role="dialog" aria-labelledby="existModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="existModalLongTitle">@lang('You are with us')</h5>
                    <span type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">

                    </span>
                </div>
                <div class="modal-body">
                    <h6 class="text-center my-4">@lang('You already have an account please Login ')</h6>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('user.login') }}" class="btn btn--base btn--md">@lang('Login')</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        .country-code .input-group-text {
            background: #fff !important;
        }

        .country-code select {
            border: none;
        }

        .country-code select:focus {
            border: none;
            outline: none;
        }
    </style>
@endpush
@push('script-lib')
    <script src="{{ asset('assets/common/js/secure_password.js') }}"></script>
@endpush
@push('script')
    <script>
        "use strict";
        (function($) {
            @if ($mobileCode)
                $(`option[data-code={{ $mobileCode }}]`).attr('selected', '');
            @endif

            $('select[name=country]').on('change', function() {
                $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
                $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
                $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            });
            $('input[name=mobile_code]').val($('select[name=country] :selected').data('mobile_code'));
            $('input[name=country_code]').val($('select[name=country] :selected').data('code'));
            $('.mobile-code').text('+' + $('select[name=country] :selected').data('mobile_code'));
            @if ($general->secure_password)
                $('input[name=password]').on('input', function() {
                    secure_password($(this));
                });

                $('[name=password]').on('focus'function() {
                    $(this).closest('.form-group').addClass('hover-input-popup');
                });

                $('[name=password]').on('focusout', function() {
                    $(this).closest('.form-group').removeClass('hover-input-popup');
                });
            @endif

            $('.checkUser').on('focusout', function(e) {
                var url = '{{ route('user.checkUser') }}';
                var value = $(this).val();
                var token = '{{ csrf_token() }}';
                if ($(this).attr('name') == 'mobile') {
                    var mobile = `${$('.mobile-code').text().substr(1)}${value}`;
                    var data = {
                        mobile: mobile,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'email') {
                    var data = {
                        email: value,
                        _token: token
                    }
                }
                if ($(this).attr('name') == 'username') {
                    var data = {
                        username: value,
                        _token: token
                    }
                }
                $.post(url, data, function(response) {
                    if (response.data != false && response.type == 'email') {
                        $('#existModalCenter').modal('show');
                    } else if (response.data != false) {
                        $(`.${response.type}Exist`).text(`${response.type} already exist`);
                    } else {
                        $(`.${response.type}Exist`).text('');
                    }
                });
            });
        })(jQuery);
    </script>
@endpush
