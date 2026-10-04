<!doctype html>
<html lang="{{ config('app.locale') }}" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @php
        $currentPage = $sections ?? $page ?? null;
        $blogMetaTitle = (Route::is('blog.details') && !empty($blog->data_values->meta_title ?? null))
            ? $blog->data_values->meta_title
            : null;
        $policyMetaTitle = (Route::is('policy.pages') && !empty($policy->data_values->meta_title ?? null))
            ? $policy->data_values->meta_title
            : null;
        $cookieMetaTitle = (Route::is('cookie.policy') && !empty($cookie->data_values->meta_title ?? null))
            ? $cookie->data_values->meta_title
            : null;
        $titleTag = $blogMetaTitle
            ?? $policyMetaTitle
            ?? $cookieMetaTitle
            ?? (($currentPage instanceof \App\Models\Page && !empty($currentPage->meta_title))
                ? $currentPage->meta_title
                : $general->siteName(__($pageTitle)));
    @endphp
    <title>{{ __($titleTag) }}</title>
    @include('includes.seo')

    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 & Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/common/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/common/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/main.css') }}?v={{ $general->updated_at }}">
    <link rel="stylesheet" href="{{ asset($activeTemplateTrue . 'css/custom.css') }}?v={{ $general->updated_at }}">
    @stack('style')
    @stack('style-lib')

    <style>
        :root {
            --primary: #{{ $general->base_color }};
            --dark: #{{ $general->secondary_color }};
        }
    </style>
</head>

<body>
    @include('Template::components.loader')

    @include('Template::components.header')

    @if (request()->route()->uri != '/')
        @include('Template::components.breadcrumb')
    @endif

    <main>
        @yield('content')
    </main>

    @include('Template::components.footer')

    @include('Template::components.cookie')

    <script src="{{ asset('assets/common/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/common/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset($activeTemplateTrue . 'js/main.js') }}?v={{ $general->updated_at }}"></script>

    @stack('script-lib')
    @stack('script')
    @include('includes.notify')
    @include('includes.plugins')

    <script>
        (function($) {
            "use strict";

            $(document).on('click', '.lang-change', function() {
                const lang = $(this).data('lang');
                window.location.href = "{{ route('home') }}/change/" + lang;
            });

            $('.policy').on('click', function() {
                $.get('{{ route('cookie.accept') }}', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });

            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

        })(jQuery);
    </script>
</body>

</html>
