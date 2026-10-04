@php
    $footerContent   = getContent('footer.content', true);
    $footerColOne    = getContent('footer_link_one.content', true);
    $footerColOneEls = getContent('footer_link_one.element', false, null, true);
    $footerColTwo    = getContent('footer_link_two.content', true);
    $footerColTwoEls = getContent('footer_link_two.element', false, null, true);
    $socialIcons     = getContent('social_icon.element', false, null, true);
    $contactInfo     = getContent('contact_us.content', true);
@endphp

<!-- ===== Footer ===== -->
<footer id="contact">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <a class="footer-brand" href="{{ route('home') }}">
                    <img src="{{ siteLogo('white') }}" alt="{{ $general->site_name }}" class="img-fluid footer-logo-img">
                </a>
                <p>{{ __(@$footerContent->data_values->description) }}</p>
                <div class="footer-social">
                    @foreach ($socialIcons as $social)
                        <a href="{{ @$social->data_values->url }}" target="_blank"
                            title="{{ __(@$social->data_values->title) }}">
                            @php echo @$social->data_values->social_icon; @endphp
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <h5>{{ __(@$footerColOne->data_values->heading) }}</h5>
                <ul>
                    @foreach ($footerColOneEls as $link)
                        <li><a href="{{ @$link->data_values->link ?? '#' }}">{{ __(@$link->data_values->title) }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-2 col-md-4 col-6">
                <h5>{{ __(@$footerColTwo->data_values->heading) }}</h5>
                <ul>
                    @foreach ($footerColTwoEls as $link)
                        <li><a href="{{ @$link->data_values->link ?? '#' }}">{{ __(@$link->data_values->title) }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="col-lg-4 col-md-4">
                <h5>{{ __(@$footerContent->data_values->newsletter_heading) }}</h5>
                <p>{{ __(@$footerContent->data_values->newsletter_text) }}</p>
                <form class="newsletter-form subscribe-form" method="POST" action="{{ route('subscribe') }}">
                    @csrf
                    <input type="email" name="email" placeholder="@lang('Your email address')" required>
                    <button type="submit"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
                @if (@$contactInfo->data_values->contact_number)
                    <p class="mt-3 mb-0"><i class="fa-solid fa-phone"></i>
                        {{ @$contactInfo->data_values->contact_number }}</p>
                @endif
                @if (@$contactInfo->data_values->email_address)
                    <p><i class="fa-solid fa-envelope"></i> {{ @$contactInfo->data_values->email_address }}</p>
                @endif
            </div>
        </div>
        <hr>
        <div class="footer-bottom text-center">
            <p>{{ __(@$footerContent->data_values->copyright) }}</p>
        </div>
    </div>
</footer>

<!-- Back to top -->
<a href="#home" class="back-to-top"><i class="fa-solid fa-arrow-up"></i></a>

@php
    $whatsappNumber  = preg_replace('/[^0-9]/', '', @$contactInfo->data_values->whatsapp_number ?: @$contactInfo->data_values->contact_number);
    $whatsappMessage = __('Hello') . ' ' . $general->site_name . ", I'd like to know more about your courier services.";
@endphp
@if ($whatsappNumber)
    <!-- WhatsApp float -->
    <a href="https://wa.me/{{ $whatsappNumber }}?text={{ rawurlencode($whatsappMessage) }}" class="whatsapp-float"
        target="_blank" rel="noopener" aria-label="@lang('Chat with us on WhatsApp')"
        title="@lang('Chat with us on WhatsApp')">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
@endif
