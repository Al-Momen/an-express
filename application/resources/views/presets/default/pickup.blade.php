@extends('Template::layouts.frontend')

@section('content')
    @php
        $pickupContent  = getContent('pickup_page.content', true);
        $pickupChecklist = getContent('pickup_page.element', false, null, true);

        $countries = [
            'Bangladesh', 'India', 'Pakistan', 'Nepal', 'Sri Lanka', 'China', 'Singapore',
            'Malaysia', 'Thailand', 'Japan', 'South Korea', 'United Arab Emirates',
            'Saudi Arabia', 'United Kingdom', 'Germany', 'France', 'Italy', 'Canada',
            'United States of America', 'Australia', 'Other',
        ];
    @endphp

    <!-- ===== Pickup Form Start ===== -->
    <section class="section quote-section">
        <div class="container">
            <div class="section-title text-center">
                <span class="tag">{{ __(@$pickupContent->data_values->tag) }}</span>
                <h2>{{ __(@$pickupContent->data_values->heading) }}</h2>
                <p>{{ __(@$pickupContent->data_values->sub_heading) }}</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="form-card">
                        <form class="contact-form" method="POST" action="{{ route('pickup.submit') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input name="company_name" value="{{ old('company_name') }}" type="text"
                                        class="form-control" placeholder="@lang('Company Name')">
                                </div>
                                <div class="col-md-6">
                                    <input name="name" value="{{ old('name') }}" type="text" class="form-control"
                                        placeholder="@lang('Your Name')" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="email" value="{{ old('email') }}" type="email" class="form-control"
                                        placeholder="@lang('Your Email')" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="phone" value="{{ old('phone') }}" type="tel" class="form-control"
                                        placeholder="@lang('Your Phone')" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="pickup_time" value="{{ old('pickup_time') }}" type="datetime-local"
                                        class="form-control" placeholder="@lang('Pick-Up Date & Time')" required>
                                </div>
                                <div class="col-md-6">
                                    <select name="destination_country" class="form-control" required>
                                        <option value="" selected disabled>@lang('Select Destination Country')</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country }}" @selected(old('destination_country') == $country)>
                                                {{ __($country) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">
                                    <input name="pickup_address" value="{{ old('pickup_address') }}" type="text"
                                        class="form-control" placeholder="@lang('Pick-Up Address')" required>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input name="weight" value="{{ old('weight') }}" type="text"
                                            inputmode="decimal" class="form-control" placeholder="@lang('Approx. Weight')"
                                            required>
                                        <span class="input-group-text">KG</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input name="item_type" value="{{ old('item_type') }}" type="text"
                                        class="form-control" placeholder="@lang('Parcel / Item Type')">
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="4" placeholder="@lang('Additional Instructions')">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fa-solid fa-truck-fast"></i> @lang('Send Pick-Up Request')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="side-cta-card">
                        <div class="icon-box">@php echo @$pickupContent->data_values->side_icon; @endphp</div>
                        <h5>{{ __(@$pickupContent->data_values->side_heading) }}</h5>
                        <p>{{ __(@$pickupContent->data_values->side_text) }}</p>
                        <a href="tel:{{ @$pickupContent->data_values->side_phone }}" class="side-cta-phone">
                            <i class="fa-solid fa-phone"></i> {{ @$pickupContent->data_values->side_phone }}
                        </a>
                    </div>
                    @if ($pickupChecklist->count())
                        <ul class="side-check-list">
                            @foreach ($pickupChecklist as $item)
                                <li><i class="fa-solid fa-check"></i> {{ __(@$item->data_values->title) }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ===== Pickup Form End ===== -->

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @includeIf('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
