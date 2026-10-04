<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> {{ $general->site_name . ' - ' .  __('404 Page | Not Found') }}</title>
    <link rel="shortcut icon" href="{{ siteFavicon() }}">
    <link rel="stylesheet" href="{{ asset('assets/common/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/common/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/common/css/line-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/main.css') }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue.'css/color.php') }}?color={{ $general->base_color }}&secondColor={{ $general->secondary_color }}">
    <link rel="stylesheet" href="{{asset($activeTemplateTrue.'css/custom.css')}}">
</head>

<body>
    <main>
    <div class="error bg--img" data-background-image="{{ getImage($activeTemplateTrue.'images/error/error-bg.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error__main py-60">
                        <img src="{{ getImage($activeTemplateTrue.'images/error/404.png') }}" alt="@lang('Error Image')">
                        <h2>404</h2>
                        <p>@lang('We\'re sorry, but the page you requested could not be found. It may have been moved, deleted, or never
                    existed in the first place.')</p>
                        <a href="{{route('home')}}" class="btn btn--base">@lang('Back to Home')</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>

    <script src="{{asset('assets/common/js/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('assets/common/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset($activeTemplateTrue.'js/main.js') }}"></script>

</body>
</html>
