@extends('Admin::layouts.app')
@section('panel')

    @adminHas('dashboard')

        @if (isset($general->system_info) && !empty(json_decode($general->system_info)->message))
            @if(json_decode($general->system_info)->message)
            <div class="row">
                @foreach (json_decode($general->system_info)->message as $msg)
                    <div class="col-md-12">
                        <div class="alert border border--primary" role="alert">
                            <div class="alert__icon bg--primary"><i class="far fa-bell"></i></div>
                            <p class="alert__message">@php echo $msg; @endphp</p>
                            <button type="button" class="close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
        @endif

        <div class="row gy-4">
            <div class="col-xl-12">

                <div class="row gy-4">
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <a class="dashboard-widget--card position-relative" href="{{ route('admin.pickup.index') }}">
                            <div class="dashboard-widget__icon">
                                <i class="dashboard-card-icon fa-solid fa-truck-fast"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="title">@lang('Pickup Requests')</span>
                                <h5 class="number">{{ $widget['total_pickup'] }}</h5>
                            </div>
                            @if ($widget['pending_pickup'] > 0)
                                <span class="badge badge--warning position-absolute">
                                    {{ $widget['pending_pickup'] }} @lang('pending')
                                </span>
                            @endif
                        </a>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <a class="dashboard-widget--card position-relative" href="{{ route('admin.quote.index') }}">
                            <div class="dashboard-widget__icon">
                                <i class="dashboard-card-icon fa-solid fa-file-invoice"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="title">@lang('Quote Requests')</span>
                                <h5 class="number">{{ $widget['total_quote'] }}</h5>
                            </div>
                            @if ($widget['pending_quote'] > 0)
                                <span class="badge badge--warning position-absolute">
                                    {{ $widget['pending_quote'] }} @lang('pending')
                                </span>
                            @endif
                        </a>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <a class="dashboard-widget--card position-relative" href="{{ route('admin.booking.index') }}">
                            <div class="dashboard-widget__icon">
                                <i class="dashboard-card-icon fa-solid fa-clipboard-list"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="title">@lang('Online Bookings')</span>
                                <h5 class="number">{{ $widget['total_booking'] }}</h5>
                            </div>
                            @if ($widget['pending_booking'] > 0)
                                <span class="badge badge--warning position-absolute">
                                    {{ $widget['pending_booking'] }} @lang('pending')
                                </span>
                            @endif
                        </a>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <a class="dashboard-widget--card position-relative" href="{{ route('admin.ticket.index') }}">
                            <div class="dashboard-widget__icon">
                                <i class="dashboard-card-icon fa-solid fa-envelope-open-text"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="title">@lang('Pending Messages')</span>
                                <h5 class="number">{{ $widget['pending_messages'] }}</h5>
                            </div>
                        </a>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="dashboard-widget--card position-relative">
                            <div class="dashboard-widget__icon">
                                <i class="dashboard-card-icon fa-solid fa-users"></i>
                            </div>
                            <div class="dashboard-widget__content">
                                <span class="title">@lang('Newsletter Subscribers')</span>
                                <h5 class="number">{{ $widget['total_subscribers'] }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card bg--white br--solid">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <h5 class="card-title mb-0">@lang('Recent Pickup Requests')</h5>
                            <a href="{{ route('admin.pickup.index') }}" class="fw--500">@lang('View All')</a>
                        </div>
                        <div class="table-responsive table-responsive--sm">
                            <table class="table align-items-center style--three table--light">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Phone')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentPickups as $pickup)
                                        <tr>
                                            <td>{{ $pickup->name }}</td>
                                            <td>{{ $pickup->phone }}</td>
                                            <td>@php echo $pickup->statusBadge(); @endphp</td>
                                            <td>
                                                <a href="{{ route('admin.pickup.view', $pickup->id) }}"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
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
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card bg--white br--solid">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <h5 class="card-title mb-0">@lang('Recent Quote Requests')</h5>
                            <a href="{{ route('admin.quote.index') }}" class="fw--500">@lang('View All')</a>
                        </div>
                        <div class="table-responsive table-responsive--sm">
                            <table class="table align-items-center style--three table--light">
                                <thead>
                                    <tr>
                                        <th>@lang('Name')</th>
                                        <th>@lang('Destination')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentQuotes as $quote)
                                        <tr>
                                            <td>{{ $quote->name }}</td>
                                            <td>{{ $quote->destination_country }}</td>
                                            <td>@php echo $quote->statusBadge(); @endphp</td>
                                            <td>
                                                <a href="{{ route('admin.quote.view', $quote->id) }}"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
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
                </div>
            </div>

            <div class="col-xl-4">
                <div class="card bg--white br--solid">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <h5 class="card-title mb-0">@lang('Recent Online Bookings')</h5>
                            <a href="{{ route('admin.booking.index') }}" class="fw--500">@lang('View All')</a>
                        </div>
                        <div class="table-responsive table-responsive--sm">
                            <table class="table align-items-center style--three table--light">
                                <thead>
                                    <tr>
                                        <th>@lang('Shipper')</th>
                                        <th>@lang('Destination')</th>
                                        <th>@lang('Status')</th>
                                        <th>@lang('Action')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($recentBookings as $booking)
                                        <tr>
                                            <td>{{ $booking->shipper_name }}</td>
                                            <td>{{ $booking->consignee_country }}</td>
                                            <td>@php echo $booking->statusBadge(); @endphp</td>
                                            <td>
                                                <a href="{{ route('admin.booking.view', $booking->id) }}"
                                                    class="btn btn-sm btn-outline--primary">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
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
                </div>
            </div>

            <div class="col-xl-12">
                <div class="card bg--white br--solid">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                            <h5 class="card-title mb-0">@lang('Recent Contact Messages')</h5>
                            <a href="{{ route('admin.ticket.index') }}" class="fw--500">@lang('View All')</a>
                        </div>

                        <div class="table-responsive table-responsive--sm">
                            <table class="table align-items-center style--three table--light">
                                <thead>
                                    <tr>
                                        <th>@lang('Customer')</th>
                                        <th>@lang('Subject')</th>
                                        <th>@lang('Priority')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tickets as $key=>$ticket)
                                    <tr>
                                        <td>
                                            <div class="d-flex flex-wrap flex-md-nowrap justify-content-end justify-content-lg-start align-items-center gap-2">
                                                <div class="user--thumb">
                                                    @if(!empty($ticket->user->image))
                                                        <img src="{{ getImage(getFilePath('userProfile') . '/' . $ticket?->user?->image ) }}" alt="@lang('Image')">
                                                    @else
                                                        <img src="{{ getImage('assets/images/general/avatar.png') }}" alt="@lang('Image')">
                                                    @endif
                                                </div>
                                                <div class="user--content">
                                                    <p class="text-start mb-0">{{ $ticket->user_id ? $ticket->user->fullname : $ticket->name }}</p>
                                                    <p class="text-start">{{ $ticket->user_id ? $ticket?->user?->email : $ticket->email }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="{{ route('admin.ticket.view', $ticket->id) }}" class="fw--500">
                                                @lang('Ticket')#{{ $ticket->ticket }} - {{ strLimit($ticket->subject,15) }}
                                            </a>
                                        </td>

                                        <td>
                                            @php echo $ticket->priorityBadge; @endphp
                                        </td>
                                    </tr>
                                    @empty

                                    @endforelse


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    @else
        <div class="row">
            <div class="col-lg-12">
                <p>@lang('You have no permission to view the page content!')</p>
            </div>
        </div>

    @endadminHas

@endsection
