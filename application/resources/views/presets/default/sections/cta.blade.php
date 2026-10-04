@php
    $ctaContent = getContent('cta.content', true);
@endphp

<!-- ===== CTA Banner Start ===== -->
<section class="cta-banner">
    <div class="cta-shape cta-shape-1"></div>
    <div class="cta-shape cta-shape-2"></div>
    <div class="cta-dots"></div>
    <div class="cta-ring"></div>
    <i class="fa-solid fa-paper-plane testi-icon cta-icon-1"></i>
    <i class="fa-solid fa-box testi-icon cta-icon-2"></i>
    <i class="fa-solid fa-location-dot testi-icon cta-icon-3"></i>
    <div class="container position-relative text-center">
        <h2>{{ __(@$ctaContent->data_values->heading) }}</h2>
        <p>{{ __(@$ctaContent->data_values->sub_heading) }}</p>
        <a href="{{ url(@$ctaContent->data_values->button_link ?? '#') }}" class="btn btn-light-custom">
            @php echo @$ctaContent->data_values->button_icon; @endphp
            {{ __(@$ctaContent->data_values->button_text) }}
        </a>
    </div>
</section>
<!-- ===== CTA Banner End ===== -->
