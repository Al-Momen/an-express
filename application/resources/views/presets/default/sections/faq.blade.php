@php
    $faqContent  = getContent('faq.content', true);
    $faqElements = getContent('faq.element', false, null, true);
@endphp

<!-- ===== FAQ Start ===== -->
<section id="faq" class="section faq-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="tag">{{ __(@$faqContent->data_values->tag) }}</span>
            <h2>{{ __(@$faqContent->data_values->heading) }}</h2>
            <p>{{ __(@$faqContent->data_values->sub_heading) }}</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="accordion faq-accordion" id="homeFaq">
                    @foreach ($faqElements as $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button @if (!$loop->first) collapsed @endif" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#hfaq{{ $faq->id }}">
                                    {{ __(@$faq->data_values->question) }}
                                </button>
                            </h2>
                            <div id="hfaq{{ $faq->id }}"
                                class="accordion-collapse collapse @if ($loop->first) show @endif"
                                data-bs-parent="#homeFaq">
                                <div class="accordion-body">@php echo __(@$faq->data_values->answer); @endphp</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ===== FAQ End ===== -->
