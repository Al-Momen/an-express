@php
    $bannerContent  = getContent('banner.content', true);
    $bannerElements = getContent('banner.element', false, null, true);
@endphp

<!-- ===== Hero Section Start ===== -->
<header id="home" class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 hero-text" data-aos>
                @if (@$bannerContent->data_values->badge_text)
                    <span class="badge-pill">
                        @php echo @$bannerContent->data_values->badge_icon; @endphp
                        {{ __(@$bannerContent->data_values->badge_text) }}
                    </span>
                @endif
                <h1>
                    {{ __(@$bannerContent->data_values->heading) }}
                    <span>{{ __(@$bannerContent->data_values->highlight_text) }}</span>
                    {{ __(@$bannerContent->data_values->heading_after) }}
                </h1>
                <p>{{ __(@$bannerContent->data_values->sub_heading) }}</p>
                <div class="hero-btns">
                    <a href="{{ @$bannerContent->data_values->button_one_link ?? '#' }}" class="btn btn-primary-custom">
                        <i class="fa-solid fa-box"></i> {{ __(@$bannerContent->data_values->button_one_text) }}
                    </a>
                    <a href="{{ @$bannerContent->data_values->button_two_link ?? '#' }}" class="btn btn-outline-custom">
                        <i class="fa-solid fa-circle-play"></i> {{ __(@$bannerContent->data_values->button_two_text) }}
                    </a>
                </div>
                @if ($bannerElements->count())
                    <div class="hero-stats">
                        @foreach ($bannerElements as $stat)
                            <div>
                                <h3 class="counter" data-target="{{ getAmount(@$stat->data_values->counter_value) }}">0</h3>
                                <p>{{ __(@$stat->data_values->title) }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-lg-6 hero-img text-center">
                <img src="{{ getImage('assets/images/frontend/banner/' . @$bannerContent->data_values->banner_image, '700x700') }}"
                    alt="{{ $general->site_name }}" class="img-fluid main-hero-img">
            </div>
        </div>

        <!-- CTA Box -->
        <div id="track" class="tracking-box cta-box">
            <div class="row g-3 align-items-center text-center text-md-start">
                <div class="col-md-4">
                    <i class="fa-solid fa-truck-fast track-icon"></i>
                    <span class="fw-semibold">{{ __(@$bannerContent->data_values->cta_text) }}</span>
                </div>
                <div class="col-md-8 d-flex flex-wrap justify-content-center justify-content-md-end gap-2">
                    <a href="{{ url(@$bannerContent->data_values->cta_button_one_link ?? '#') }}" class="btn btn-primary-custom">
                        <i class="fa-solid fa-file-invoice"></i> {{ __(@$bannerContent->data_values->cta_button_one_text) }}
                    </a>
                    <a href="{{ url(@$bannerContent->data_values->cta_button_two_link ?? '#') }}"
                        class="btn btn-outline-custom btn-outline-dark-custom">
                        <i class="fa-solid fa-calendar-check"></i> {{ __(@$bannerContent->data_values->cta_button_two_text) }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- ===== Hero Section End ===== -->
