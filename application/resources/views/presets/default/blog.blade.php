@extends('Template::layouts.frontend')

@section('content')
    <!-- ===== Blog Listing Start ===== -->
    <section class="section blog-listing">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-8">
                    <div class="row g-4">
                        @forelse ($blogs as $blog)
                            @php
                                $blogUrl = route('blog.details', ['slug' => slug(@$blog->data_values->title), 'id' => $blog->id]);
                                $excerpt = preg_replace('/\s+/', ' ', strip_tags(str_replace('<', ' <', __(@$blog->data_values->description))));
                            @endphp
                            <div class="col-md-6">
                                <div class="blog-card blog-list-card">
                                    <div class="blog-img">
                                        <img src="{{ getImage(getFilePath('blog') . '/thumb_' . @$blog->data_values->blog_image, '475x320') }}"
                                            alt="{{ __(@$blog->data_values->title) }}">
                                        @if (@$blog->data_values->category)
                                            <span class="blog-cat">{{ __(@$blog->data_values->category) }}</span>
                                        @endif
                                    </div>
                                    <div class="blog-body">
                                        <div class="blog-meta">
                                            <i class="fa-solid fa-calendar-days"></i>
                                            {{ showDateTime($blog->created_at, 'M d, Y') }}
                                            <i class="fa-solid fa-user ms-2"></i> @lang('Admin')
                                        </div>
                                        <h5><a href="{{ $blogUrl }}">{{ __(@$blog->data_values->title) }}</a></h5>
                                        <p>{{ strLimit(trim($excerpt), 110) }}</p>
                                        <a href="{{ $blogUrl }}" class="blog-link">
                                            @lang('Read More') <i class="fa-solid fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h5>@lang('No article found')</h5>
                            </div>
                        @endforelse
                    </div>

                    @if ($blogs->hasPages())
                        <ul class="blog-pagination">
                            @if (!$blogs->onFirstPage())
                                <li>
                                    <a href="{{ $blogs->previousPageUrl() }}"><i class="fa-solid fa-chevron-left"></i></a>
                                </li>
                            @endif
                            @foreach (range(1, $blogs->lastPage()) as $page)
                                <li>
                                    <a href="{{ $blogs->url($page) }}"
                                        class="{{ $blogs->currentPage() == $page ? 'active' : '' }}">{{ $page }}</a>
                                </li>
                            @endforeach
                            @if ($blogs->hasMorePages())
                                <li>
                                    <a href="{{ $blogs->nextPageUrl() }}"><i class="fa-solid fa-chevron-right"></i></a>
                                </li>
                            @endif
                        </ul>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    @include('Template::components.blog_sidebar')
                </div>
            </div>
        </div>
    </section>
    <!-- ===== Blog Listing End ===== -->

    @if (@$sections->secs != null)
        @foreach (json_decode($sections->secs) as $sec)
            @includeIf('Template::sections.' . $sec)
        @endforeach
    @endif
@endsection
