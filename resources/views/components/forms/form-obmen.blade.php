<div class="form">
        <form action="{{ route('ajaxCreateOrder') }}" method="post" id="change_form" class="ajax_post_bids">
            <div class="container">
                <x-forms.get-direction></x-forms.get-direction>

                <div class="step three" id="result">
                    forma
                    @csrf
                </div>
            </div>
        </form>
</div>

@section('page-scripts')
    <script type="application/javascript" src="{{asset('/assets/js/exchange.js')}}"></script>
@endsection
