@if(count($banners))
<div class="mb-4" id="displayer">
    <div class="displayer-carousel">
        @foreach($banners as $banner)
            {!! $banner->code !!}
        @endforeach
    </div>
</div>
@endif
