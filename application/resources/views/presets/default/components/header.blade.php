@php
    $hmenu         = App\Models\Menu::where('code', 'header_menu')->first();
    $menuItems     = $hmenu ? $hmenu->items()->get() : collect();
    $socialIcons   = getContent('social_icon.element', false, null, true);
    $headerContent = getContent('header.content', true);
    $contactInfo   = getContent('contact_us.content', true);



@endphp
<!-- ===== Top Bar ===== -->
<div class="top-bar d-none d-lg-block">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="top-bar-info">
            @if (@$contactInfo->data_values->contact_number)
                <span><i class="fa-solid fa-phone"></i> {{ @$contactInfo->data_values->contact_number }}</span>
            @endif
            @if (@$contactInfo->data_values->email_address)
                <span><i class="fa-solid fa-envelope"></i> {{ @$contactInfo->data_values->email_address }}</span>
            @endif
            @if (@$headerContent->data_values->address)
                <span><i class="fa-solid fa-location-dot"></i> {{ __(@$headerContent->data_values->address) }}</span>
            @endif
        </div>

        
        <div class="top-bar-social">
            @foreach ($socialIcons as $social)
                <a href="{{ route('book') }}" target="_blank"
                    title="{{ __(@$social->data_values->title) }}">
                    @php echo @$social->data_values->social_icon; @endphp
                </a>
            @endforeach
        </div>
    </div>
</div>


 


<!-- ===== Navbar ===== -->
<nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ siteLogo() }}" alt="{{ $general->site_name }}" class="img-fluid logo-img">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link @if (request()->routeIs('home')) active @endif"
                        href="{{ route('home') }}">@lang('Home')</a>
                </li>
                @foreach ($menuItems as $item)
                    @if ($item->link_type == 2)
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $item->url ?? '#' }}" target="_blank">{{ __($item->title) }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link @if (route('pages', [$item->url]) == url()->current()) active @endif"
                                href="{{ route('pages', [$item->url]) }}">{{ __($item->title) }}</a>
                        </li>
                    @endif
                @endforeach
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.home') }}">@lang('Dashboard')</a>
                    </li>
                @endauth
            </ul>
            @if (@$headerContent->data_values->booking_button_text)
                <a href="{{ @$headerContent->data_values->booking_button_link ?? '#' }}" class="btn btn-track">
                    <i class="fa-solid fa-clipboard-list"></i>
                    {{ __(@$headerContent->data_values->booking_button_text) }}
                </a>
            @endif
        </div>
    </div>
</nav>
