@extends('Admin::layouts.app')
@section('panel')

<div class="row mb-4">
    <div class="col-lg-5">
        <form>
            <div class="search-input--wrap position-relative">
                <input type="search" name="search" class="form-control"
                    placeholder="@lang('Search by name, email, phone or destination')" value="{{ request()->search }}">
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
                                <th>@lang('Item')</th>
                                <th>@lang('Destination')</th>
                                <th>@lang('Status')</th>
                                <th>@lang('Submitted')</th>
                                <th>@lang('Action')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($quotes as $quote)
                                <tr>
                                    <td>{{ $quote->name }}</td>
                                    <td>{{ $quote->phone }}</td>
                                    <td>{{ $quote->item_type }} ({{ $quote->weight }})</td>
                                    <td>{{ $quote->destination_country }}</td>
                                    <td>@php echo $quote->statusBadge(); @endphp</td>
                                    <td>{{ diffForHumans($quote->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('admin.quote.view', $quote->id) }}" title="@lang('View')"
                                            class="btn btn-sm btn-outline--primary">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <button title="@lang('Delete')" href="javascript:void(0)"
                                            class="btn btn-sm btn--danger confirmationBtn"
                                            data-question="@lang('Are you sure to delete this quote request?')"
                                            data-action="{{ route('admin.quote.delete', $quote->id) }}">
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
            @if ($quotes->hasPages())
                <div class="pagination__wrapper py-4">
                    {{ paginateLinks($quotes) }}
                </div>
            @endif
        </div>
    </div>
</div>

<x-confirmation-modal></x-confirmation-modal>
@endsection
