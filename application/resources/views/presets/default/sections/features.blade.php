@php
    $featuresContent = getContent('features.content', true);
    $featuresElements = getContent('features.element', false, false, true);
    $featuresElements = Route::is('home') ? $featuresElements->take(3) : $featuresElements;
@endphp

<!--==========================   features Start  ==========================-->
<section class="features my-120">
    <div class="features__shape">
        <img src="{{ asset($activeTemplateTrue . 'images/shape/shape.png') }}" alt="@lang('image')">
    </div>
    <div class="glove--base"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2 class="section-heading__title">{{ __($featuresContent->data_values->heading) }}</h2>
                    <p class="section-heading__desc">{{ __($featuresContent->data_values->sub_heading) }}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center gy-4">
            @foreach ($featuresElements ?? [] as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="features__card">
                        <div class="features__icon">
                            <img src="{{ getImage(getFilePath('features') . $item->data_values->image) }}"
                                alt="@lang('image')">
                        </div>
                        <h4 class="features__title">{{ __($item->data_values->heading) }}</h4>
                        <p class="features__desc">{{ __($item->data_values->sub_heading) }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!--==========================  features End  ==========================-->
