@props(['nameField', 'text' => ''])

<div class="row">
    <div class="col">
        <div class="form-group">
            <label>{{ $nameField }}</label>
            <textarea {{ $attributes->merge(['class' => 'form-control']) }}>{{ $text }}</textarea>
        </div>
    </div>
</div>
