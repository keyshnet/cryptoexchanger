@extends('layouts.public')

@section('title', $page->title?: $page->name)

@section('content')
    <div id="main" class="without-sidebar">
        <div class="container narrow">
            <h1>{{ $page->name }}</h1>
            <div id="contacts">

                <div class="methods">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </div>
@endsection
