@php
    $counterElements = getContent('counter.element', false, null, true);
@endphp

@if ($counterElements->count())
    <!-- ===== Counter Banner Start ===== -->
    <section class="stats-banner">
        <div class="container">
            <div class="row text-center">
                @foreach ($counterElements as $counter)
                    <div class="col-6 col-lg-3">
                        @php echo @$counter->data_values->icon; @endphp
                        <h3 class="counter" data-target="{{ getAmount(@$counter->data_values->counter_value) }}">0</h3>
                        <p>{{ __(@$counter->data_values->title) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ===== Counter Banner End ===== -->
@endif
