@php
    $whyContent  = getContent('why_choose_us.content', true);
    $whyElements = getContent('why_choose_us.element', false, null, true);
@endphp

<!-- ===== Why Choose Us Start ===== -->
<section id="why" class="section why-us">
    <div class="why-shape why-shape-1"></div>
    <div class="why-shape why-shape-2"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="why-img-wrap">
                    <div class="why-blob"></div>
                    <div class="why-dots"></div>
                    <img src="{{ getImage('assets/images/frontend/why_choose_us/' . @$whyContent->data_values->why_image, '800x800') }}"
                        alt="{{ __(@$whyContent->data_values->heading) }}" class="img-fluid rounded-4 shadow why-img">
                    <div class="why-ring"></div>
                    <div class="why-badge">
                        @php echo @$whyContent->data_values->badge_icon; @endphp
                        <div>
                            <h4>{{ __(@$whyContent->data_values->badge_count) }}</h4>
                            <span>{{ __(@$whyContent->data_values->badge_text) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="tag">{{ __(@$whyContent->data_values->tag) }}</span>
                <h2 class="mb-4">{{ __(@$whyContent->data_values->heading) }}</h2>
                @foreach ($whyElements as $why)
                    <div class="why-item">
                        @php echo @$why->data_values->icon; @endphp
                        <div>
                            <h5>{{ __(@$why->data_values->title) }}</h5>
                            <p>{{ __(@$why->data_values->description) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- ===== Why Choose Us End ===== -->
