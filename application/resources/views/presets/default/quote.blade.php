@extends('Template::layouts.frontend')

@section('content')
    @php
        $quoteContent   = getContent('quote_page.content', true);
        $quoteChecklist = getContent('quote_page.element', false, null, true);
    @endphp

    <!-- ===== Quote Form Start ===== -->
    <section class="section quote-section">
        <div class="container">
            <div class="section-title text-center">
                <span class="tag">{{ __(@$quoteContent->data_values->tag) }}</span>
                <h2>{{ __(@$quoteContent->data_values->heading) }}</h2>
                <p>{{ __(@$quoteContent->data_values->sub_heading) }}</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="form-card">
                        <form class="contact-form" method="POST" action="{{ route('quote.submit') }}">
                            @csrf
                            <div class="row g-3">
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
                                    <input name="item_type" value="{{ old('item_type') }}" type="text"
                                        class="form-control" placeholder="@lang('Parcel / Item Type')" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="weight" value="{{ old('weight') }}" type="text" class="form-control"
                                        placeholder="@lang('Item Weight (Appr.)')" required>
                                </div>
                                <div class="col-md-6">
                                    <input name="destination_country" value="{{ old('destination_country') }}"
                                        type="text" class="form-control" placeholder="@lang('Destination Country')"
                                        required>
                                </div>
                                <div class="col-12">
                                    <select name="collection_option" class="form-control" required>
                                        <option value="" selected disabled>@lang('How should we collect your parcel?')
                                        </option>
                                        <option value="Please send a pickup rider"
                                            @selected(old('collection_option') == 'Please send a pickup rider')>
                                            @lang('Please send a pickup rider')</option>
                                        <option value="I will drop it off at the nearest branch"
                                            @selected(old('collection_option') == 'I will drop it off at the nearest branch')>
                                            @lang('I will drop it off at the nearest branch')</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" class="form-control" rows="4" placeholder="@lang('Additional Notes')">{{ old('message') }}</textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary-custom">
                                        <i class="fa-solid fa-paper-plane"></i> @lang('Request Quote')
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="side-cta-card">
                        <div class="icon-box">@php echo @$quoteContent->data_values->side_icon; @endphp</div>
                        <h5>{{ __(@$quoteContent->data_values->side_heading) }}</h5>
                        <p>{{ __(@$quoteContent->data_values->side_text) }}</p>
                        <a href="tel:{{ @$quoteContent->data_values->side_phone }}" class="side-cta-phone">
                            <i class="fa-solid fa-phone"></i> {{ @$quoteContent->data_values->side_phone }}
                        </a>
                    </div>
                    @if ($quoteChecklist->count())
                        <ul class="side-check-list">
                            @foreach ($quoteChecklist as $item)
                                <li><i class="fa-solid fa-check"></i> {{ __(@$item->data_values->title) }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ===== Quote Form End ===== -->

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @includeIf('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
