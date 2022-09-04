@extends('layouts.public')

@section('title', $page->title?: $page->name)

@section('content')

    <section class="article" id="page-{{ $page->code }}">
        <div class="container thin">

            <h1>{{ $page->name }}</h1>

            <div class="text">
                {!! $page->content !!}
            </div>
        </div>
    </section>
@endsection
