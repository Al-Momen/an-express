 @forelse ($blogs ?? [] as $item)
     <div class="col-sm-6 col-lg-4">
         <div class="blog__card">
             <div class="blog__thumb-wrap">
                 <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}"
                     class="blog__thumb">
                     <img src="{{ getImage(getFilePath('blog') . 'thumb_' . $item->data_values->blog_image) }}"
                         class="fit--img" alt="@lang('news-card')">
                 </a>
                 <p class="blog__date">{{ showDateTime($item->created_at, 'd M') }}</p>
             </div>
             <div class="blog__body">
                 <h4 class="blog__title"><a
                         href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}">
                         @if (strlen(__($item->data_values->title)) > 55)
                             {{ strLimit(__($item->data_values->title), 55) }}
                         @else
                             {{ __($item->data_values->title) }}
                         @endif
                     </a>
                 </h4>
                 <a href="{{ route('blog.details', ['slug' => slug($item->data_values->title), 'id' => $item->id]) }}"
                     class="btn--unstyle-2">@lang('Read More')</a>
             </div>
         </div>
     </div>
 @empty
     <div class="col-12 text-center">
         <h6>@lang('No Data Found')</h6>
     </div>
 @endforelse
