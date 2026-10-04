@php
    $testimonialContent  = getContent('testimonial.content', true);
    $testimonialElements = getContent('testimonial.element', false, null, true);
@endphp

<!-- ===== Testimonials Start ===== -->
<section id="testimonials" class="section testimonials">
    <div class="testi-shape testi-shape-1"></div>
    <div class="testi-shape testi-shape-2"></div>
    <div class="testi-shape testi-shape-3"></div>
    <div class="testi-dots"></div>
    <i class="fa-solid fa-truck-fast testi-icon testi-icon-1"></i>
    <i class="fa-solid fa-box testi-icon testi-icon-2"></i>
    <i class="fa-solid fa-envelope testi-icon testi-icon-3"></i>
    <div class="container position-relative">
        <div class="section-title text-center">
            <span class="tag">{{ __(@$testimonialContent->data_values->tag) }}</span>
            <h2>{{ __(@$testimonialContent->data_values->heading) }}</h2>
        </div>
        <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($testimonialElements as $review)
                    <div class="carousel-item @if ($loop->first) active @endif">
                        <div class="testimonial-card mx-auto">
                            <i class="fa-solid fa-quote-left quote-icon"></i>
                            <p>{{ __(@$review->data_values->review) }}</p>
                            <div class="testimonial-author">
                                <img src="{{ getImage('assets/images/frontend/testimonial/' . @$review->data_values->image, '120x120') }}"
                                    alt="{{ __(@$review->data_values->name) }}">
                                <div>
                                    <h6>{{ __(@$review->data_values->name) }}</h6>
                                    <span>{{ __(@$review->data_values->designation) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if ($testimonialElements->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
                    <span class="carousel-nav-icon"><i class="fa-solid fa-chevron-left"></i></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
                    <span class="carousel-nav-icon"><i class="fa-solid fa-chevron-right"></i></span>
                </button>
            @endif
        </div>
    </div>
</section>
<!-- ===== Testimonials End ===== -->
