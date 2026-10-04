@php
    $howContent  = getContent('how_it_works.content', true);
    $howElements = getContent('how_it_works.element', false, null, true);
@endphp

<!-- ===== How It Works Start ===== -->
<section id="how" class="section how-it-works">
    <div class="how-shape how-shape-1"></div>
    <div class="how-shape how-shape-2"></div>
    <div class="how-dots"></div>
    <i class="fa-solid fa-plane testi-icon how-icon-1"></i>
    <i class="fa-solid fa-location-dot testi-icon how-icon-2"></i>
    <div class="container position-relative">
        <div class="section-title text-center">
            <span class="tag">{{ __(@$howContent->data_values->tag) }}</span>
            <h2>{{ __(@$howContent->data_values->heading) }}</h2>
            <p>{{ __(@$howContent->data_values->sub_heading) }}</p>
        </div>
        <div class="row g-4 text-center how-steps">
            <div class="how-line d-none d-md-block"></div>
            @foreach ($howElements as $step)
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-num">{{ __(@$step->data_values->serial) }}</div>
                        @php echo @$step->data_values->icon; @endphp
                        <h5>{{ __(@$step->data_values->title) }}</h5>
                        <p>{{ __(@$step->data_values->description) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ===== How It Works End ===== -->
