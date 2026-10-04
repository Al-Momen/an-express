@php
    $sidebar     = getContent('blog_sidebar.content', true);
    $recentPosts = App\Models\Frontend::where('data_keys', 'blog.element')
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();
    // Category counts come from the JSON column, so they are tallied in PHP.
    $categories  = getContent('blog.element', false)
        ->pluck('data_values.category')
        ->filter()
        ->countBy();
@endphp

<div class="widget search-widget">
    <form method="GET" action="{{ route('blog') }}">
        <input type="text" name="search" value="{{ request()->search }}" placeholder="@lang('Search articles...')">
        <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>

@if ($categories->count())
    <div class="widget">
        <h5 class="widget-title">@lang('Categories')</h5>
        <ul class="cat-widget-list">
            @foreach ($categories as $category => $count)
                <li>
                    <a href="{{ route('blog', ['category' => $category]) }}">
                        {{ __($category) }} <span>{{ $count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if ($recentPosts->count())
    <div class="widget">
        <h5 class="widget-title">@lang('Recent Posts')</h5>
        @foreach ($recentPosts as $post)
            <div class="recent-post-item">
                <img src="{{ getImage(getFilePath('blog') . '/thumb_' . @$post->data_values->blog_image, '475x320') }}"
                    alt="{{ __(@$post->data_values->title) }}">
                <div>
                    <h6>
                        <a
                            href="{{ route('blog.details', ['slug' => slug(@$post->data_values->title), 'id' => $post->id]) }}">
                            {{ strLimit(__(@$post->data_values->title), 45) }}
                        </a>
                    </h6>
                    <span><i class="fa-solid fa-calendar-days"></i> {{ showDateTime($post->created_at, 'M d, Y') }}</span>
                </div>
            </div>
        @endforeach
    </div>
@endif

@if (@$sidebar->data_values->cta_heading)
    <div class="sidebar-cta">
        @php echo @$sidebar->data_values->cta_icon; @endphp
        <h5>{{ __(@$sidebar->data_values->cta_heading) }}</h5>
        <p>{{ __(@$sidebar->data_values->cta_text) }}</p>
        <a href="{{ @$sidebar->data_values->cta_button_link ?? '#' }}" class="btn btn-primary-custom">
            {{ __(@$sidebar->data_values->cta_button_text) }}
        </a>
    </div>
@endif
