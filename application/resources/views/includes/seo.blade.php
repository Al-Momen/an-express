@if($seo)
    @php
        $blogDetailsRoute = Route::is('blog.details');

        $title = $general->siteName(__($pageTitle));
        $description = $seo->description;
        $image = getImage(getFilePath('seo') .'/'. $seo->image);
        $socialTitle = $seo->social_title;
        $socialDescription = $seo->social_description;
        $socialImageSize = explode('x', getFileSize('seo'));

        // Per-page SEO: admin can set a meta title/description for each Page
        // Builder page (Home, Pickup, Quote, etc.) which overrides the
        // sitewide defaults above when present.
        $currentPage = $sections ?? $page ?? null;
        if ($currentPage instanceof \App\Models\Page) {
            if (!empty($currentPage->meta_title)) {
                $title = $general->siteName($currentPage->meta_title);
            }
            if (!empty($currentPage->meta_description)) {
                $description = $currentPage->meta_description;
                $socialDescription = $currentPage->meta_description;
            }
        }

        if($blogDetailsRoute && isset($blog->data_values))
        {
            $title = !empty($blog->data_values->meta_title) ? $blog->data_values->meta_title : ($blog->data_values->title ?? $title);
            $description = !empty($blog->data_values->meta_description) ? $blog->data_values->meta_description : strip_tags($blog->data_values->description ?? '');
            $image = getImage(getFilePath('blog') . '/' . ($blog->data_values->blog_image ?? ''));
            $socialTitle = $title;
            $socialDescription = $description;
        }

        if (Route::is('policy.pages') && isset($policy->data_values)) {
            $title = !empty($policy->data_values->meta_title) ? $policy->data_values->meta_title : ($policy->data_values->title ?? $title);
            $description = !empty($policy->data_values->meta_description) ? $policy->data_values->meta_description : strip_tags($policy->data_values->details ?? '');
            $socialTitle = $title;
            $socialDescription = $description;
        }

        if (Route::is('cookie.policy') && isset($cookie->data_values)) {
            $title = !empty($cookie->data_values->meta_title) ? $cookie->data_values->meta_title : $title;
            $description = !empty($cookie->data_values->meta_description) ? $cookie->data_values->meta_description : ($cookie->data_values->short_desc ?? $description);
            $socialTitle = $title;
            $socialDescription = $description;
        }
    @endphp

    <meta name="title" content="{{ __($title) }}">
    <meta name="description" content="{{ __($description) }}">
    <meta name="keywords" content="{{ implode(',', $seo->keywords) }}">
    <link rel="shortcut icon" href="{{ siteFavicon() }}" type="image/x-icon">

    {{-- Apple --}}
    <link rel="apple-touch-icon" href="{{ siteLogo() }}">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="{{ __($title) }}">

    {{-- Google --}}
    <meta itemprop="name" content="{{ __($title) }}">
    <meta itemprop="description" content="{{ __($description) }}">
    <meta itemprop="image" content="{{ $image }}">


    {{-- Facebook --}}
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ __($socialTitle) }}">
    <meta property="og:description" content="{{ __($socialDescription) }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:image:type" content="image/{{ pathinfo($image, PATHINFO_EXTENSION) }}">
    <meta property="og:image:width" content="{{ $socialImageSize[0] }}">
    <meta property="og:image:height" content="{{ $socialImageSize[1] }}">
    <meta property="og:url" content="{{ url()->current() }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
@endif


