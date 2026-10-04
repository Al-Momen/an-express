@php
    $storyContent  = getContent('our_story.content', true);
    $storyElements = getContent('our_story.element', false, null, true);
@endphp

<!-- ===== Our Story Start ===== -->
<section class="section about-us">
    <div class="about-shape about-shape-1"></div>
    <div class="about-shape about-shape-2"></div>
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="about-img-wrap">
                    <div class="about-blob"></div>
                    <div class="about-dots"></div>
                    <img src="{{ getImage('assets/images/frontend/our_story/' . @$storyContent->data_values->story_image, '800x800') }}"
                        alt="{{ $general->site_name }}" class="img-fluid rounded-4 shadow about-img">
                    <div class="about-ring"></div>
                    <div class="about-badge">
                        @php echo @$storyContent->data_values->badge_icon; @endphp
                        <div>
                            <h4>{{ __(@$storyContent->data_values->badge_count) }}</h4>
                            <span>{{ __(@$storyContent->data_values->badge_text) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="tag">{{ __(@$storyContent->data_values->tag) }}</span>
                <h2 class="mb-4">{{ __(@$storyContent->data_values->heading) }}</h2>
                <p>{{ __(@$storyContent->data_values->description) }}</p>
                @if (@$storyContent->data_values->description_two)
                    <p>{{ __(@$storyContent->data_values->description_two) }}</p>
                @endif
                @if ($storyElements->count())
                    <ul class="about-points">
                        @foreach ($storyElements as $point)
                            <li><i class="fa-solid fa-check"></i> {{ __(@$point->data_values->title) }}</li>
                        @endforeach
                    </ul>
                @endif
                <a href="{{ url(@$storyContent->data_values->button_link ?? '#') }}" class="btn btn-primary-custom">
                    <i class="fa-solid fa-arrow-right"></i> {{ __(@$storyContent->data_values->button_text) }}
                </a>
            </div>
        </div>
    </div>
</section>
<!-- ===== Our Story End ===== -->
