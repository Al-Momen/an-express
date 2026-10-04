@extends('Template::layouts.frontend')

@section('content')
    @php
        $relatedPosts = App\Models\Frontend::where('data_keys', 'blog.element')
            ->where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->limit(2)
            ->get();
    @endphp

    <!-- ===== Blog Details Start ===== -->
    <section class="section blog-details">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <article class="post-content">
                        <div class="post-meta-row">
                            <span><i class="fa-solid fa-user"></i> @lang('By Admin')</span>
                            <span><i class="fa-solid fa-calendar-days"></i>
                                {{ showDateTime($blog->created_at, 'M d, Y') }}</span>
                            @if (@$blog->data_values->category)
                                <span><i class="fa-solid fa-folder"></i> {{ __(@$blog->data_values->category) }}</span>
                            @endif
                        </div>

                        <div class="blog-details-cover">
                            <img src="{{ getImage(getFilePath('blog') . '/' . @$blog->data_values->blog_image, '1100x740') }}"
                                alt="{{ __(@$blog->data_values->title) }}">
                        </div>

                        <div class="wyg">
                            @php echo __(@$blog->data_values->description); @endphp
                        </div>

                        @if (@$blog->data_values->quote)
                            <div class="post-quote">
                                <i class="fa-solid fa-quote-left"></i>
                                {{ __(@$blog->data_values->quote) }}
                            </div>
                        @endif

                        <div class="post-footer-row">
                            <div class="post-stats">
                                <span><i class="fa-solid fa-calendar-days"></i>
                                    {{ diffForHumans($blog->created_at) }}</span>
                            </div>
                            <div class="post-share">
                                <span>@lang('Share'):</span>
                                <a href="https://www.facebook.com/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode(__(@$blog->data_values->title)) }}"
                                    target="_blank"><i class="fa-brands fa-twitter"></i></a>
                                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->url()) }}&title={{ urlencode(__(@$blog->data_values->title)) }}"
                                    target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                                <a href="{{ request()->url() }}"><i class="fa-solid fa-link"></i></a>
                            </div>
                        </div>
                    </article>

                    @if ($relatedPosts->count())
                        <div class="mt-5">
                            <h4 class="mb-4">@lang('Related Articles')</h4>
                            <div class="row g-4">
                                @foreach ($relatedPosts as $post)
                                    @php
                                        $postUrl = route('blog.details', ['slug' => slug(@$post->data_values->title), 'id' => $post->id]);
                                        $excerpt = preg_replace('/\s+/', ' ', strip_tags(str_replace('<', ' <', __(@$post->data_values->description))));
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="blog-card blog-list-card">
                                            <div class="blog-img">
                                                <img src="{{ getImage(getFilePath('blog') . '/thumb_' . @$post->data_values->blog_image, '475x320') }}"
                                                    alt="{{ __(@$post->data_values->title) }}">
                                                @if (@$post->data_values->category)
                                                    <span class="blog-cat">{{ __(@$post->data_values->category) }}</span>
                                                @endif
                                            </div>
                                            <div class="blog-body">
                                                <div class="blog-meta">
                                                    <i class="fa-solid fa-calendar-days"></i>
                                                    {{ showDateTime($post->created_at, 'M d, Y') }}
                                                    <i class="fa-solid fa-user ms-2"></i> @lang('Admin')
                                                </div>
                                                <h5><a href="{{ $postUrl }}">{{ __(@$post->data_values->title) }}</a></h5>
                                                <p>{{ strLimit(trim($excerpt), 110) }}</p>
                                                <a href="{{ $postUrl }}" class="blog-link">
                                                    @lang('Read More') <i class="fa-solid fa-arrow-right"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    @include('Template::components.blog_sidebar')
                </div>
            </div>
        </div>
    </section>
    <!-- ===== Blog Details End ===== -->
@endsection
