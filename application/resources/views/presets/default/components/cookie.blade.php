@php
    $cookie = App\Models\Frontend::where('data_keys', 'cookie.data')->first();
@endphp
@if ($cookie->data_values->status == 1 && !\Cookie::get('gdpr_cookie'))
    <!-- cookies card start -->
    <div class="cookies-card hide">
        <div class="cookies-card__head">
            <span class="cookies-card__icon"><i class="fa-solid fa-cookie-bite"></i></span>
            <h6 class="cookies-card__title">@lang('We use cookies')</h6>
        </div>
        <p class="cookies-card__content">
            {{ $cookie->data_values->short_desc }}
            <a href="{{ route('cookie.policy') }}" target="_blank">@lang('Learn more')</a>
        </p>
        <button type="button" class="cookies-card__btn policy">@lang('Accept')</button>
    </div>
    <!-- cookies card end -->
@endif
