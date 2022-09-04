@extends('layouts.public')

@section('title', $page->title?: $page->name)

@section('content')
    <section id="currency-exchange" class="currency-exchange">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>{{ $page->name }}</h1>
                    <x-forms.form-obmen></x-forms.form-obmen>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {!! $page->content !!}
                </div>
            </div>
        </div>
    </section>
@endsection
