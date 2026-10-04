@extends('Admin::layouts.master')

@section('content')
<div class="body-overlay"></div>

<!-- page-wrapper start -->
<div class="page-wrapper default-version">
    @include('Admin::components.sidenav')
    <div class="">
        @include('Admin::components.topnav')
        <div class="breadcrumb-wrapper">
            @include('Admin::components.breadcrumb')
        </div>
    </div>

    <div class="body-wrapper">
        <div class="bodywrapper__inner">
            @yield('panel')
        </div>
    </div>
</div>



@endsection
