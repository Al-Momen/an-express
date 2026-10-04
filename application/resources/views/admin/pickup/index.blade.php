@extends('Admin::layouts.app')
@section('panel')

<div class="row mb-4">
    <div class="col-lg-5">
        <form>
            <div class="search-input--wrap position-relative">
                <input type="search" name="search" class="form-control"
                    placeholder="@lang('Search by name, email, phone or address')" value="{{ request()->search }}">
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
                                <th>@lang('Name')</th>
                                <th>@lang('Phone')</th>
                                <th>@lang('Pickup Address')</th>
                                <th>@lang('Pickup Time')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Submitted')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pickups as $pickup)
                                <tr>
                                    <td>
                                        <span class="fw-bold">{{ $pickup->name }}</span>
                                        @if ($pickup->company_name)
                                            <br><span class="text-muted small">{{ $pickup->company_name }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $pickup->phone }}</td>
                                    <td>{{ strLimit($pickup->pickup_address, 35) }}</td>
                                    <td>{{ showDateTime($pickup->pickup_time) }}</td>
                                    <td>@php echo $pickup->statusBadge(); @endphp</td>
                                    <td>{{ diffForHumans($pickup->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('admin.pickup.view', $pickup->id) }}" title="@lang('View')"
                                            class="btn btn-sm btn-outline--primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <button title="@lang('Delete')" href="javascript:void(0)"
                                            class="btn btn-sm btn--danger confirmationBtn"
                                            data-question="@lang('Are you sure to delete this pickup request?')"
                                            data-action="{{ route('admin.pickup.delete', $pickup->id) }}">
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
            @if ($pickups->hasPages())
                <div class="pagination__wrapper py-4">
                    {{ paginateLinks($pickups) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal></x-confirmation-modal>
@endsection
