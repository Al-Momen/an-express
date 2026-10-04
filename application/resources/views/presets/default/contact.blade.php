@extends('Template::layouts.frontend')

@section('content')
    @php
        $contact     = getContent('contact_us.content', true);
        $infoStrip   = getContent('contact_info.element', false, null, true);
        $socialIcons = getContent('social_icon.element', false, null, true);
        $mapQuery    = @$contact->data_values->map_query ?: @$contact->data_values->contact_details;
    @endphp

    <!-- ===== Floating Contact Info Strip ===== -->
    @if ($infoStrip->count())
        <div class="container">
            <div class="contact-info-strip">
                @foreach ($infoStrip as $info)
                    <div class="contact-info-strip-item">
                        <div class="icon-box">@php echo @$info->data_values->icon; @endphp</div>
                        <div>
                            <h5>{{ __(@$info->data_values->title) }}</h5>
                            <p>{{ __(@$info->data_values->details) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- ===== Contact Form ===== -->
    <section class="section contact-form-section">
        <div class="container">
            <div class="contact-split">
                <div class="contact-split-info">
                    <div class="contact-split-shape"></div>
                    <span class="tag">{{ __(@$contact->data_values->top_heading) }}</span>
                    <h2>{{ __(@$contact->data_values->heading) }}</h2>
                    <p>{{ __(@$contact->data_values->short_description) }}</p>
                    <ul class="contact-list">
                        @if (@$contact->data_values->contact_details)
                            <li><i class="fa-solid fa-location-dot"></i> {{ __(@$contact->data_values->contact_details) }}
                            </li>
                        @endif
                        @if (@$contact->data_values->contact_number)
                            <li><i class="fa-solid fa-phone"></i> {{ @$contact->data_values->contact_number }}</li>
                        @endif
                        @if (@$contact->data_values->email_address)
                            <li><i class="fa-solid fa-envelope"></i> {{ @$contact->data_values->email_address }}</li>
                        @endif
                        @if (@$contact->data_values->working_hours)
                            <li><i class="fa-solid fa-clock"></i> {{ __(@$contact->data_values->working_hours) }}</li>
                        @endif
                    </ul>
                    <div class="contact-split-social">
                        @foreach ($socialIcons as $social)
                            <a href="{{ @$social->data_values->url }}" target="_blank"
                                title="{{ __(@$social->data_values->title) }}">
                                @php echo @$social->data_values->social_icon; @endphp
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="contact-split-form">
                    <h3>{{ __(@$contact->data_values->form_heading) }}</h3>
                    <p>{{ __(@$contact->data_values->form_sub_heading) }}</p>
                    <form class="contact-form verify-gcaptcha" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" value="{{ old('name', auth()->user()?->fullname) }}"
                                    class="form-control" placeholder="@lang('Your Name')" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" value="{{ old('email', auth()->user()?->email) }}"
                                    class="form-control" placeholder="@lang('Your Email')" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control"
                                    placeholder="@lang('Phone Number')">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control"
                                    placeholder="@lang('Subject')" required>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" rows="5" placeholder="@lang('Your Message')" required>{{ old('message') }}</textarea>
                            </div>
                            <x-captcha></x-captcha>
                            <div class="col-12">
                                <button type="submit" id="recaptcha" class="btn btn-primary-custom">
                                    <i class="fa-solid fa-paper-plane"></i>
                                    {{ __(@$contact->data_values->button_text) }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Map ===== -->
    @if ($mapQuery)
        <section class="section pt-0 contact-map-section">
            <div class="container">
                <div class="contact-map-wrap">
                    <span class="contact-map-badge">
                        <i class="fa-solid fa-location-dot"></i> {{ __(@$contact->data_values->map_badge) }}
                    </span>
                    <iframe src="https://www.google.com/maps?q={{ urlencode($mapQuery) }}&output=embed" width="100%"
                        height="420" style="border:0;" allowfullscreen loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="{{ $general->site_name }}"></iframe>
                </div>
            </div>
        </section>
    @endif

    @if ($sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @includeIf('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
