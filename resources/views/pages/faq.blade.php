@extends('layouts.public')

@section('title', $page->title?: $page->name)


@section('content')
    <div id="main" class="without-sidebar">
        <div class="container">

            <h1>{{ $page->name }}</h1>

            <div id="faq">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
