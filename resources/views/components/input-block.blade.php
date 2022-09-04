@props(['nameField'])

<div class="row">
    <div class="col">
        <div class="form-group">
            <label>{{ $nameField }}</label>
            <input {{ $attributes->merge(['class' => 'form-control']) }} />
        </div>
    </div>
</div>
