@php
    $brandElements = getContent('brand_strip.element', false, null, true);
@endphp

@if ($brandElements->count())
    <!-- ===== Trust Strip Start ===== -->
    <div class="brand-strip">
        <div class="container d-flex flex-wrap justify-content-around align-items-center">
            @foreach ($brandElements as $brand)
                <span>@php echo @$brand->data_values->icon; @endphp {{ __(@$brand->data_values->title) }}</span>
            @endforeach
        </div>
    </div>
    <!-- ===== Trust Strip End ===== -->
@endif
