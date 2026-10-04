@php
    $serviceContent  = getContent('service.content', true);
    $serviceElements = getContent('service.element', false, null, true);
@endphp

<!-- ===== Services Start ===== -->
<section id="services" class="section services">
    <div class="services-shape services-shape-1"></div>
    <div class="services-shape services-shape-2"></div>
    <div class="services-dots"></div>
    <div class="services-ring"></div>
    <i class="fa-solid fa-box-open testi-icon services-icon-1"></i>
    <i class="fa-solid fa-truck testi-icon services-icon-2"></i>
    <div class="container position-relative">
        <div class="section-title text-center">
            <span class="tag">{{ __(@$serviceContent->data_values->tag) }}</span>
            <h2>{{ __(@$serviceContent->data_values->heading) }}</h2>
            <p>{{ __(@$serviceContent->data_values->sub_heading) }}</p>
        </div>
        <div class="row g-4">
            @foreach ($serviceElements as $service)
                <div class="col-md-6 col-lg-4">
                    <div class="service-card">
                        <div class="icon-box">@php echo @$service->data_values->icon; @endphp</div>
                        <h4>{{ __(@$service->data_values->title) }}</h4>
                        <p>{{ __(@$service->data_values->description) }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ===== Services End ===== -->
