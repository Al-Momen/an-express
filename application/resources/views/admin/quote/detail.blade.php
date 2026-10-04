@extends('Admin::layouts.app')
@section('panel')

<div class="row justify-content-center gy-4">
    <div class="col-lg-8">
        <div class="card b-radius--10">
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Name')
                        <span>{{ $quote->name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Email')
                        <span><a href="mailto:{{ $quote->email }}">{{ $quote->email }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Phone')
                        <span><a href="tel:{{ $quote->phone }}">{{ $quote->phone }}</a></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Parcel / Item Type')
                        <span>{{ $quote->item_type }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Item Weight (Appr.)')
                        <span>{{ $quote->weight }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Destination Country')
                        <span>{{ $quote->destination_country }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Collection Option')
                        <span>{{ $quote->collection_option }}</span>
                    </li>
                    @if ($quote->message)
                        <li class="list-group-item">
                            <div class="mb-2">@lang('Additional Notes')</div>
                            <p class="mb-0">{{ $quote->message }}</p>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        @lang('Submitted At')
                        <span>{{ showDateTime($quote->created_at) }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card b-radius--10">
            <div class="card-body">
                <h6 class="mb-3">@lang('Status')</h6>
                <form action="{{ route('admin.quote.status', $quote->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <select name="status" class="form-control form-select" onchange="this.form.submit()">
                            <option value="0" @selected($quote->status == 0)>@lang('Pending')</option>
                            <option value="1" @selected($quote->status == 1)>@lang('Processing')</option>
                            <option value="2" @selected($quote->status == 2)>@lang('Completed')</option>
                            <option value="3" @selected($quote->status == 3)>@lang('Cancelled')</option>
                        </select>
                    </div>
                </form>

                <hr>

                <button title="@lang('Delete')" href="javascript:void(0)"
                    class="btn btn--danger w-100 confirmationBtn"
                    data-question="@lang('Are you sure to delete this quote request?')"
                    data-action="{{ route('admin.quote.delete', $quote->id) }}">
                    <i class="fa-solid fa-trash-can"></i> @lang('Delete Request')
                </button>
            </div>
        </div>
    </div>
</div>

<x-confirmation-modal></x-confirmation-modal>
@endsection
