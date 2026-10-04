@extends('Admin::layouts.app')
@section('panel')

<div class="row gy-4">
    <div class="col-lg-6">
        <div class="card b-radius--10 h-100">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fa-solid fa-user me-2"></i>@lang('Shipper (Sender)')</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Name')
                        <span>{{ $booking->shipper_name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Company')
                        <span>{{ $booking->shipper_company }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Phone')
                        <span><a href="tel:{{ $booking->shipper_phone }}">{{ $booking->shipper_phone }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Email')
                        <span><a href="mailto:{{ $booking->shipper_email }}">{{ $booking->shipper_email }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Country')
                        <span>{{ $booking->shipper_country }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('City / ZIP')
                        <span>{{ $booking->shipper_city }} / {{ $booking->shipper_zip }}</span>
                    </li>
                    <li class="list-group-item">
                        <div class="mb-2">@lang('Address')</div>
                        <p class="mb-0">{{ $booking->shipper_address }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card b-radius--10 h-100">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fa-solid fa-map-location-dot me-2"></i>@lang('Consignee (Receiver)')</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Name')
                        <span>{{ $booking->consignee_name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Company')
                        <span>{{ $booking->consignee_company }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Phone')
                        <span><a href="tel:{{ $booking->consignee_phone }}">{{ $booking->consignee_phone }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Email')
                        <span><a href="mailto:{{ $booking->consignee_email }}">{{ $booking->consignee_email }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Country')
                        <span>{{ $booking->consignee_country }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('City / ZIP')
                        <span>{{ $booking->consignee_city }} / {{ $booking->consignee_zip }}</span>
                    </li>
                    <li class="list-group-item">
                        <div class="mb-2">@lang('Address')</div>
                        <p class="mb-0">{{ $booking->consignee_address }}</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="card b-radius--10">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fa-solid fa-box-open me-2"></i>@lang('Shipment Details')</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Payment Mode')
                        <span>{{ $booking->payment_mode }}</span>
                    </li>
                    @if ($booking->shipment_ref)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Shipment Ref')
                            <span>{{ $booking->shipment_ref }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Pieces')
                        <span>{{ $booking->pieces }}</span>
                    </li>
                    @if ($booking->declared_value)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Declared Value')
                            <span>${{ $booking->declared_value }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Weight')
                        <span>{{ $booking->weight_kg }} KG @if ($booking->weight_gm) {{ $booking->weight_gm }} GM @endif</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Item Type')
                        <span>{{ $booking->item_type }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Item Description')
                        <span>{{ $booking->item_description }}</span>
                    </li>
                    @if ($booking->length || $booking->height || $booking->width)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Dimensions (L x H x W)')
                            <span>{{ $booking->length }} x {{ $booking->height }} x {{ $booking->width }} cm</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Volumetric Weight')
                            <span>{{ $booking->volumetric_weight }} KG</span>
                        </li>
                    @endif
                    @if ($booking->remarks)
                        <li class="list-group-item">
                            <div class="mb-2">@lang('Remarks')</div>
                            <p class="mb-0">{{ $booking->remarks }}</p>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Submitted At')
                        <span>{{ showDateTime($booking->created_at) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card b-radius--10">
            <div class="card-body">
                <h6 class="mb-3">@lang('Status')</h6>
                <form action="{{ route('admin.booking.status', $booking->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="status" class="form-control form-select" onchange="this.form.submit()">
                            <option value="0" @selected($booking->status == 0)>@lang('Pending')</option>
                            <option value="1" @selected($booking->status == 1)>@lang('Processing')</option>
                            <option value="2" @selected($booking->status == 2)>@lang('Completed')</option>
                            <option value="3" @selected($booking->status == 3)>@lang('Cancelled')</option>
                        </select>
                    </div>
                </form>

                <hr>

                <button title="@lang('Delete')" href="javascript:void(0)"
                    class="btn btn--danger w-100 confirmationBtn"
                    data-question="@lang('Are you sure to delete this booking?')"
                    data-action="{{ route('admin.booking.delete', $booking->id) }}">
                    <i class="fa-solid fa-trash-can"></i> @lang('Delete Booking')
                </button>
            </div>
        </div>
    </div>
</div>

<x-confirmation-modal></x-confirmation-modal>
@endsection
