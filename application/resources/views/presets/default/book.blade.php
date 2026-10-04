@extends('Template::layouts.frontend')

@section('content')
    @php
        $bookContent    = getContent('book_page.content', true);
        $bookChecklist  = getContent('book_page.element', false, null, true);

        $shipperCountries = [
            'Bangladesh', 'India', 'Pakistan', 'Nepal', 'China', 'Singapore',
            'United Arab Emirates', 'United Kingdom', 'United States of America', 'Other',
        ];
        $consigneeCountries = [
            'India', 'Pakistan', 'Nepal', 'Sri Lanka', 'China', 'Singapore', 'Malaysia',
            'United Arab Emirates', 'Saudi Arabia', 'United Kingdom', 'Germany', 'Canada',
            'United States of America', 'Australia', 'Other',
        ];
    @endphp

    <!-- ===== Booking Form Start ===== -->
    <section class="section quote-section">
        <div class="container">
            <div class="section-title text-center">
                <span class="tag">{{ __(@$bookContent->data_values->tag) }}</span>
                <h2>{{ __(@$bookContent->data_values->heading) }}</h2>
                <p>{{ __(@$bookContent->data_values->sub_heading) }}</p>
            </div>
            <div class="row g-5">
                <div class="col-lg-9">
                    <form class="contact-form" method="POST" action="{{ route('book.submit') }}"
                        onsubmit="return acsSyncVolumetric();">
                        @csrf

                        <!-- Shipper / Consignee -->
                        <div class="form-card mb-4">
                            <h3 class="booking-panel-title"><i class="fa-solid fa-user"></i>
                                @lang('Shipper & Consignee Information')</h3>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <h6 class="booking-col-title">@lang('Shipper (Sender)')</h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input name="shipper_name" value="{{ old('shipper_name') }}" type="text"
                                                class="form-control" placeholder="@lang('Attention Name')" required>
                                        </div>
                                        <div class="col-12">
                                            <input name="shipper_company" value="{{ old('shipper_company') }}"
                                                type="text" class="form-control" placeholder="@lang('Company Name')"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <input name="shipper_phone" value="{{ old('shipper_phone') }}" type="tel"
                                                class="form-control" placeholder="@lang('Phone No')" required>
                                        </div>
                                        <div class="col-12">
                                            <input name="shipper_email" value="{{ old('shipper_email') }}"
                                                type="email" class="form-control" placeholder="@lang('Email')"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <select name="shipper_country" class="form-control" required>
                                                @foreach ($shipperCountries as $country)
                                                    <option value="{{ $country }}"
                                                        @selected(old('shipper_country', 'Bangladesh') == $country)>
                                                        {{ __($country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-7">
                                            <input name="shipper_city" value="{{ old('shipper_city') }}" type="text"
                                                class="form-control" placeholder="@lang('City')" required>
                                        </div>
                                        <div class="col-5">
                                            <input name="shipper_zip" value="{{ old('shipper_zip') }}" type="text"
                                                class="form-control" placeholder="@lang('ZIP')" required>
                                        </div>
                                        <div class="col-12">
                                            <textarea name="shipper_address" class="form-control" rows="4" placeholder="@lang('Address')" required>{{ old('shipper_address') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 booking-col-divider">
                                    <h6 class="booking-col-title">@lang('Consignee (Receiver)')</h6>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <input name="consignee_name" value="{{ old('consignee_name') }}"
                                                type="text" class="form-control" placeholder="@lang('Attention Name')"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <input name="consignee_company" value="{{ old('consignee_company') }}"
                                                type="text" class="form-control" placeholder="@lang('Company Name')"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <input name="consignee_phone" value="{{ old('consignee_phone') }}"
                                                type="tel" class="form-control" placeholder="@lang('Phone No')"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <input name="consignee_email" value="{{ old('consignee_email') }}"
                                                type="email" class="form-control" placeholder="@lang('Email')"
                                                required>
                                        </div>
                                        <div class="col-12">
                                            <select name="consignee_country" class="form-control" required>
                                                <option value="" @selected(!old('consignee_country')) disabled>
                                                    @lang('Select Destination Country')</option>
                                                @foreach ($consigneeCountries as $country)
                                                    <option value="{{ $country }}"
                                                        @selected(old('consignee_country') == $country)>
                                                        {{ __($country) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-7">
                                            <input name="consignee_city" value="{{ old('consignee_city') }}"
                                                type="text" class="form-control" placeholder="@lang('City')" required>
                                        </div>
                                        <div class="col-5">
                                            <input name="consignee_zip" value="{{ old('consignee_zip') }}" type="text"
                                                class="form-control" placeholder="@lang('ZIP')" required>
                                        </div>
                                        <div class="col-12">
                                            <textarea name="consignee_address" class="form-control" rows="4" placeholder="@lang('Address')" required>{{ old('consignee_address') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipment Details -->
                        <div class="form-card mb-4">
                            <h3 class="booking-panel-title"><i class="fa-solid fa-box-open"></i>
                                @lang('Shipment Details')</h3>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <select name="payment_mode" class="form-control" required>
                                        <option value="" @selected(!old('payment_mode')) disabled>
                                            @lang('Payment Mode')</option>
                                        <option value="Prepaid" @selected(old('payment_mode') == 'Prepaid')>
                                            @lang('Prepaid')</option>
                                        <option value="Collect" @selected(old('payment_mode') == 'Collect')>
                                            @lang('Collect')</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input name="shipment_ref" value="{{ old('shipment_ref') }}" type="text"
                                        class="form-control" placeholder="@lang('Shipment Ref (if any)')">
                                </div>
                                <div class="col-md-4">
                                    <input name="pieces" value="{{ old('pieces', 1) }}" type="number"
                                        class="form-control" placeholder="@lang('Pieces')" min="1" required>
                                </div>

                                <div class="col-md-4">
                                    <input name="declared_value" value="{{ old('declared_value', 0) }}" type="number"
                                        class="form-control" placeholder="@lang('Declared Value (USD)')" min="0">
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input name="weight_kg" value="{{ old('weight_kg') }}" type="text"
                                            id="w_kgs" class="form-control" placeholder="@lang('Weight')" required>
                                        <span class="input-group-text">KG</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input name="weight_gm" value="{{ old('weight_gm') }}" type="text" id="w_gms"
                                            class="form-control" placeholder="@lang('Weight')">
                                        <span class="input-group-text">GM</span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <select name="item_type" class="form-control" required>
                                        <option value="" @selected(!old('item_type')) disabled>
                                            @lang('Select Item Type')</option>
                                        <option value="Sample" @selected(old('item_type') == 'Sample')>
                                            @lang('Sample')</option>
                                        <option value="Documents" @selected(old('item_type') == 'Documents')>
                                            @lang('Documents')</option>
                                        <option value="Parcel" @selected(old('item_type') == 'Parcel')>
                                            @lang('Parcel')</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input name="item_description" value="{{ old('item_description') }}" type="text"
                                        class="form-control" placeholder="@lang('e.g. Shirt 05 Pcs, Scarf 02 Pcs')"
                                        required>
                                </div>

                                <div class="col-12">
                                    <textarea name="remarks" class="form-control" rows="3" placeholder="@lang('Remarks (optional)')">{{ old('remarks') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Dimensional Weight -->
                        <div class="form-card mb-4">
                            <h3 class="booking-panel-title"><i class="fa-solid fa-ruler-combined"></i>
                                @lang('Dimensional Weight') <span class="booking-optional">(@lang('optional'))</span>
                            </h3>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" id="dim_l" class="form-control"
                                            placeholder="@lang('Length')" value="{{ old('length', 0) }}"
                                            oninput="acsCalcVolumetric()">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" id="dim_h" class="form-control"
                                            placeholder="@lang('Height')" value="{{ old('height', 0) }}"
                                            oninput="acsCalcVolumetric()">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" id="dim_w" class="form-control"
                                            placeholder="@lang('Width')" value="{{ old('width', 0) }}"
                                            oninput="acsCalcVolumetric()">
                                        <span class="input-group-text">cm</span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-group">
                                        <input type="text" id="dim_vol" class="form-control"
                                            placeholder="@lang('Volumetric Weight')"
                                            value="{{ old('volumetric_weight', '0.00') }}" readonly>
                                        <span class="input-group-text">KG</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="length" id="length_hidden" value="{{ old('length', 0) }}">
                        <input type="hidden" name="height" id="height_hidden" value="{{ old('height', 0) }}">
                        <input type="hidden" name="width" id="width_hidden" value="{{ old('width', 0) }}">
                        <input type="hidden" name="volumetric_weight" id="volumetric_weight_hidden"
                            value="{{ old('volumetric_weight', '0.00') }}">

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary-custom btn-lg-custom">
                                <i class="fa-solid fa-circle-check"></i> @lang('Book Now')
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-3">
                    <div class="side-cta-card">
                        <div class="icon-box">@php echo @$bookContent->data_values->side_icon; @endphp</div>
                        <h5>{{ __(@$bookContent->data_values->side_heading) }}</h5>
                        <p>{{ __(@$bookContent->data_values->side_text) }}</p>
                        <a href="tel:{{ @$bookContent->data_values->side_phone }}" class="side-cta-phone">
                            <i class="fa-solid fa-phone"></i> {{ @$bookContent->data_values->side_phone }}
                        </a>
                    </div>
                    @if ($bookChecklist->count())
                        <ul class="side-check-list">
                            @foreach ($bookChecklist as $item)
                                <li><i class="fa-solid fa-check"></i> {{ __(@$item->data_values->title) }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- ===== Booking Form End ===== -->

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @includeIf('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection

@push('script')
    <script>
        function acsCalcVolumetric() {
            var l = parseFloat(document.getElementById('dim_l').value) || 0;
            var h = parseFloat(document.getElementById('dim_h').value) || 0;
            var w = parseFloat(document.getElementById('dim_w').value) || 0;
            document.getElementById('dim_vol').value = ((l * h * w) / 5000).toFixed(2);
        }

        // Mirrors the visible dimension fields into the hidden inputs the
        // form actually submits, right before submit.
        function acsSyncVolumetric() {
            document.getElementById('length_hidden').value = document.getElementById('dim_l').value;
            document.getElementById('height_hidden').value = document.getElementById('dim_h').value;
            document.getElementById('width_hidden').value = document.getElementById('dim_w').value;
            document.getElementById('volumetric_weight_hidden').value = document.getElementById('dim_vol').value;
            return true;
        }
    </script>
@endpush
