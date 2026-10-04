@php
    $aboutContent  = getContent('about.content', true);
    $aboutElements = getContent('about.element', false, null, true);
@endphp

<!-- ===== About Start ===== -->
<section id="about" class="section about-us">
    <div class="about-shape about-shape-1"></div>
    <div class="about-shape about-shape-2"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-img-wrap">
                    <div class="about-blob"></div>
                    <div class="about-dots"></div>
                    <img src="{{ getImage('assets/images/frontend/about/' . @$aboutContent->data_values->about_image, '800x800') }}"
                        alt="{{ __(@$aboutContent->data_values->heading) }}" class="img-fluid rounded-4 shadow about-img">
                    <div class="about-ring"></div>
                    <div class="about-badge">
                        @php echo @$aboutContent->data_values->badge_icon; @endphp
                        <div>
                            <h4>{{ __(@$aboutContent->data_values->badge_count) }}</h4>
                            <span>{{ __(@$aboutContent->data_values->badge_text) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="tag">{{ __(@$aboutContent->data_values->tag) }}</span>
                <h2 class="mb-4">{{ __(@$aboutContent->data_values->heading) }}</h2>
                <p>{{ __(@$aboutContent->data_values->description) }}</p>
                @if ($aboutElements->count())
                    <ul class="about-points">
                        @foreach ($aboutElements as $point)
                            <li><i class="fa-solid fa-check"></i> {{ __(@$point->data_values->title) }}</li>
                        @endforeach
                    </ul>
                @endif
                <a href="{{ url(@$aboutContent->data_values->button_link ?? '#') }}" class="btn btn-primary-custom">
                    <i class="fa-solid fa-arrow-right"></i> {{ __(@$aboutContent->data_values->button_text) }}
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ===== About End ===== -->
