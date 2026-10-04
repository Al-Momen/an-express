@extends('Admin::layouts.app')
@section('panel')

<div class="row justify-content-center gy-4">
    <div class="col-lg-8">
        <div class="card b-radius--10">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Name')
                        <span>{{ $pickup->name }}</span>
                    </li>
                    @if ($pickup->company_name)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Company')
                            <span>{{ $pickup->company_name }}</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Email')
                        <span><a href="mailto:{{ $pickup->email }}">{{ $pickup->email }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Phone')
                        <span><a href="tel:{{ $pickup->phone }}">{{ $pickup->phone }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Pick-Up Date & Time')
                        <span>{{ showDateTime($pickup->pickup_time, 'd M, Y - h:i A') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Destination Country')
                        <span>{{ $pickup->destination_country }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Pick-Up Address')
                        <span>{{ $pickup->pickup_address }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Approx. Weight')
                        <span>{{ $pickup->weight }} KG</span>
                    </li>
                    @if ($pickup->item_type)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            @lang('Parcel / Item Type')
                            <span>{{ $pickup->item_type }}</span>
                        </li>
                    @endif
                    @if ($pickup->message)
                        <li class="list-group-item">
                            <div class="mb-2">@lang('Additional Instructions')</div>
                            <p class="mb-0">{{ $pickup->message }}</p>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Submitted At')
                        <span>{{ showDateTime($pickup->created_at) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card b-radius--10">
            <div class="card-body">
                <h6 class="mb-3">@lang('Status')</h6>
                <form action="{{ route('admin.pickup.status', $pickup->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="status" class="form-control form-select" onchange="this.form.submit()">
                            <option value="0" @selected($pickup->status == 0)>@lang('Pending')</option>
                            <option value="1" @selected($pickup->status == 1)>@lang('Processing')</option>
                            <option value="2" @selected($pickup->status == 2)>@lang('Completed')</option>
                            <option value="3" @selected($pickup->status == 3)>@lang('Cancelled')</option>
                        </select>
                    </div>
                </form>

                <hr>

                <button title="@lang('Delete')" href="javascript:void(0)"
                    class="btn btn--danger w-100 confirmationBtn"
                    data-question="@lang('Are you sure to delete this pickup request?')"
                    data-action="{{ route('admin.pickup.delete', $pickup->id) }}">
                    <i class="fa-solid fa-trash-can"></i> @lang('Delete Request')
                </button>
            </div>
        </div>
    </div>
</div>

<x-confirmation-modal></x-confirmation-modal>
@endsection
