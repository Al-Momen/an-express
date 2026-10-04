<!-- ===== Page Header ===== -->
<header class="page-header">
    <div class="page-header-shape page-header-shape-1"></div>
    <div class="page-header-shape page-header-shape-2"></div>
    <i class="fa-solid fa-truck-fast page-header-icon page-header-icon-1"></i>
    <i class="fa-solid fa-box page-header-icon page-header-icon-2"></i>
    <div class="container position-relative text-center">
        <h1>{{ __($pageTitle) }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('Home')</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __($pageTitle) }}</li>
            </ol>
        </nav>
    </div>
</header>
