@php
    $blogContent  = getContent('blog.content', true);
    $blogElements = App\Models\Frontend::where('data_keys', 'blog.element')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();
@endphp

<!-- ===== Blog Start ===== -->
<section id="blog" class="section blog">
    <div class="container">
        <div class="section-title text-center">
            <span class="tag">{{ __(@$blogContent->data_values->tag) }}</span>
            <h2>{{ __(@$blogContent->data_values->heading) }}</h2>
            <p>{{ __(@$blogContent->data_values->sub_heading) }}</p>
        </div>
        <div class="row g-4">
            @forelse ($blogElements as $blog)
                @php
                    $blogUrl = route('blog.details', ['slug' => slug(@$blog->data_values->title), 'id' => $blog->id]);
                    // Block tags carry no whitespace, so add one before stripping or the
                    // excerpt runs two paragraphs together.
                    $excerpt = preg_replace('/\s+/', ' ', strip_tags(str_replace('<', ' <', __(@$blog->data_values->description))));
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="{{ getImage(getFilePath('blog') . '/thumb_' . @$blog->data_values->blog_image, '475x320') }}"
                                alt="{{ __(@$blog->data_values->title) }}">
                            @if (@$blog->data_values->category)
                                <span class="blog-cat">{{ __(@$blog->data_values->category) }}</span>
                            @endif
                        </div>
                        <div class="blog-body">
                            <div class="blog-meta">
                                <i class="fa-solid fa-calendar-days"></i> {{ showDateTime($blog->created_at, 'M d, Y') }}
                            </div>
                            <h5><a href="{{ $blogUrl }}">{{ strLimit(__(@$blog->data_values->title), 60) }}</a></h5>
                            <p>{{ strLimit(trim($excerpt), 110) }}</p>
                            <a href="{{ $blogUrl }}" class="blog-link">
                                @lang('Read More') <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <h6>@lang('No Data Found')</h6>
                </div>
            @endforelse
        </div>
        @if (@$blogContent->data_values->button_text)
            <div class="text-center mt-5">
                <a href="{{ url(@$blogContent->data_values->button_link ?? 'blog') }}"
                    class="btn btn-outline-custom btn-outline-dark-custom">
                    {{ __(@$blogContent->data_values->button_text) }} <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        @endif
    </div>
</section>
<!-- ===== Blog End ===== -->
