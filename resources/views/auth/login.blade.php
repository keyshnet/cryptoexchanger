@extends('layouts.public')

@section('content')
    <div id="main" class="without-sidebar">
        <div>
            <h1 class="breadcrumb_title" id="the_title_page" itemprop="title">{{ __('Login') }}</h1>
        </div>
        <div class="container narrow">
            <div class="text">
                <div class="acf_div_wrap form">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 form-group acf_line type_input field_name_login has_title">
                            <div class="form-group acf_line type_input field_name_login has_title">
                                <div class=" acf_label">
                                    <label for="email"><span class="form_field_label_ins">{{ __('Email Address') }}:</span></label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <input id="email" type="email" class="acf_input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3  form-group acf_line type_input field_name_login has_title">
                            <div class="form-group acf_line type_input field_name_login has_title"><div class=" acf_label"><label for="password"><span class="form_field_label_ins">{{ __('Password') }}:</span></label></div></div>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3  form-group acf_line type_input field_name_login has_title">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
