@php
    $solutionContent = getContent('solution.content', true);
    $solutionElements = getContent('solution.element', false, false, true);
@endphp

<!--==========================   smart-solutions Start  ==========================-->
<section class="smart-solutions my-120">
    <div class="container">
        <div class="row gy-5 justify-content-between align-items-center">
            <div class="col-lg-7 col-xxl-8">
                <div class="section-heading style-left">
                    <h2 class="section-heading__title">{{ __($solutionContent->data_values->heading) }}</h2>
                    <p class="section-heading__desc">{{ __($solutionContent->data_values->sub_heading) }}</p>
                </div>
                <div class="row justify-content-center gy-4 gy-lg-5">
                    @foreach ($solutionElements ?? [] as $item)
                        <div class="col-md-6">
                            <div class="smart-solutions__card">
                                <div class="smart-solutions__icon">
                                    <img src="{{ getImage(getFilePath('solution') . $item->data_values->image) }}"
                                        alt="@lang('image')">
                                </div>
                                <div class="smart-solutions__content">
                                    <h5 class="smart-solutions__title">{{ __($item->data_values->heading) }}</h5>
                                    <p class="smart-solutions__desc">{{ __($item->data_values->sub_heading) }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
            <div class="col-lg-5 col-xxl-4">
                <div class="smart-solutions__banner">
                    <div class="svg-wrapper">
                        <svg id="motionSvg" class="smart-solutions__chart" viewBox="0 0 337 400" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M221.6 180.1L278.6 143.1L281.6 60.6" />
                            <path d="M171.6 162.1L97.6 61.1V0.599976" />
                            <path d="M231.6 224.1L277.1 262.6L335.6 216.6" />
                            <path d="M201.6 259.6L282.1 344.6L273.6 385.1" />
                            <path d="M174.1 263.6L165.1 355.6L90.6 398.6" />
                            <path d="M146.6 250.6L72.6 312.1L20.6 278.6" />
                            <path d="M131.1 203.1L0.599976 185.1V141.6" />
                        </svg>
                    </div>
                    <div class="smart-solutions__center"><i class="fa-solid fa-users"></i></div>
                    <div class="smart-solithins__badges">
                        <span class="badge bg--orange">@lang('Grid')</span>
                        <span class="badge bg--warning">@lang('Short Period')</span>
                        <span class="badge bg--success">@lang('Profit')</span>
                        <span class="badge bg--danger">@lang('Trailing up')</span>
                        <span class="badge bg--info">@lang('Investment')</span>
                        <span class="badge bg--purple">@lang('Investment')</span>
                        <span class="badge bg--pink">@lang('Short Period')</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--==========================  smart-solutions End  ==========================-->
