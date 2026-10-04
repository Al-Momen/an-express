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
                <form class="account__form" method="POST" action="{{ route('user.password.email') }}">
                    @csrf
                    <div class="row  gx-3 gy-4">
                        <div class="col-12">
                            <div class="account__header">
                                <h2 class="account__subtitle">{{ __($pageTitle) }}</h2>
                                <p class="account__title">@lang('To recover your account please provide your email or username to find your account.')</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <input type="text" class="form-control" autofocus="off" placeholder="@lang('Email or Username')"
                                name="value" value="{{ old('value') }}" required>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn--base w-100">@lang('SUBMIT')</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- sign-up section start -->
@endsection
