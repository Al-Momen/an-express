@extends('Template::layouts.frontend')
@section('content')


    @if($page->secs != null)
        @foreach(json_decode($page->secs) as $sec)
            @includeIf('Template::sections.'.$sec)
        @endforeach
    @endif
@endsection
