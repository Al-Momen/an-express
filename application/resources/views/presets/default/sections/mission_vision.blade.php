@php
    $missionElements = getContent('mission_vision.element', false, null, true);
@endphp

@if ($missionElements->count())
    <!-- ===== Mission & Vision Start ===== -->
    <section class="section mission-vision">
        <div class="container">
            <div class="row g-4">
                @foreach ($missionElements as $item)
                    <div class="col-md-6">
                        <div class="service-card h-100">
                            <div class="icon-box">@php echo @$item->data_values->icon; @endphp</div>
                            <h4>{{ __(@$item->data_values->title) }}</h4>
                            <p>{{ __(@$item->data_values->description) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===== Mission & Vision End ===== -->
@endif
