@extends('Template::layouts.frontend')
@section('content')
    <!--==========================  Cookie Section Start  ==========================-->
    <div class="cookie-policy py-120">
        <div class="container">
            <div class="cookie-policy__inner">
                <div class="cookie-policy__item wyg">
                    @php
                        echo $cookie->data_values->description;
                    @endphp
                </div>
            </div>
        </div>
    </div>
    <!--==========================  Cookie Section End  ==========================-->
@endsection


