@extends('Template::layouts.frontend')
@section('content')
    <!--==========================  privacy-policy Section Start  ==========================-->
    <div class="cookie-policy py-120">
        <div class="container">
            <div class="cookie-policy__inner">
                <div class="cookie-policy__item wyg">
                    @php
                        echo $policy->data_values->details;
                    @endphp
                </div>
            </div>
        </div>
    </div>
    <!--==========================  privacy-policy Section End  ==========================-->
@endsection
