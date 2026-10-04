@extends('Admin::layouts.app')
@section('panel')

<div class="row mb-4">
    <div class="col-lg-5">
        <form>
            <div class="search-input--wrap position-relative">
                <input type="search" name="search" class="form-control"
                    placeholder="@lang('Search by shipper, consignee or destination')" value="{{ request()->search }}">
                <button class="search--btn position-absolute" type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card b-radius--10">
            <div class="card-body p-0">
                <div class="table-responsive--sm table-responsive">
                    <table class="table table--light style--two">
                        <thead>
                            <tr>
                                <th>@lang('Shipper')</th>
                                <th>@lang('Consignee')</th>
                                <th>@lang('Destination')</th>
                                <th>@lang('Pieces / Weight')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Submitted')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($bookings as $booking)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $booking->shipper_name }}</span>
                                        <br><span class="text-muted small">{{ $booking->shipper_company }}</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $booking->consignee_name }}</span>
                                        <br><span class="text-muted small">{{ $booking->consignee_company }}</span>
                                    </td>
                                    <td>{{ $booking->consignee_country }}</td>
                                    <td>{{ $booking->pieces }} pcs / {{ $booking->weight_kg }} KG</td>
                                    <td>@php echo $booking->statusBadge(); @endphp</td>
                                    <td>{{ diffForHumans($booking->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('admin.booking.view', $booking->id) }}" title="@lang('View')"
                                            class="btn btn-sm btn-outline--primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <button title="@lang('Delete')" href="javascript:void(0)"
                                            class="btn btn-sm btn--danger confirmationBtn"
                                            data-question="@lang('Are you sure to delete this booking?')"
                                            data-action="{{ route('admin.booking.delete', $booking->id) }}">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($bookings->hasPages())
                <div class="pagination__wrapper py-4">
                    {{ paginateLinks($bookings) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal></x-confirmation-modal>
@endsection
