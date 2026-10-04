@php
    $teamContent  = getContent('team.content', true);
    $teamElements = getContent('team.element', false, null, true);
@endphp

<!-- ===== Team Start ===== -->
<section class="section team-section">
    <div class="container">
        <div class="section-title text-center">
            <span class="tag">{{ __(@$teamContent->data_values->tag) }}</span>
            <h2>{{ __(@$teamContent->data_values->heading) }}</h2>
            <p>{{ __(@$teamContent->data_values->sub_heading) }}</p>
        </div>
        <div class="row g-4">
            @foreach ($teamElements as $member)
                <div class="col-md-6 col-lg-3">
                    <div class="team-card">
                        <div class="team-img-wrap">
                            <img src="{{ getImage('assets/images/frontend/team/' . @$member->data_values->image, '400x400') }}"
                                alt="{{ __(@$member->data_values->name) }}">
                            <div class="team-social">
                                @if (@$member->data_values->facebook_url)
                                    <a href="{{ @$member->data_values->facebook_url }}" target="_blank">
                                        <i class="fa-brands fa-facebook-f"></i></a>
                                @endif
                                @if (@$member->data_values->twitter_url)
                                    <a href="{{ @$member->data_values->twitter_url }}" target="_blank">
                                        <i class="fa-brands fa-twitter"></i></a>
                                @endif
                                @if (@$member->data_values->linkedin_url)
                                    <a href="{{ @$member->data_values->linkedin_url }}" target="_blank">
                                        <i class="fa-brands fa-linkedin-in"></i></a>
                                @endif
                            </div>
                        </div>
                        <h5>{{ __(@$member->data_values->name) }}</h5>
                        <span>{{ __(@$member->data_values->designation) }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ===== Team End ===== -->
