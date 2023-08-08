@props(['name', 'label', 'value', 'type' => 'text', 'disabled' => false, 'start' => false, 'end' => false, 'startText' => 'Rp.', 'endText' => 'hari'])

<div class="form-group">
    <label for="{{ $name }}">{{ $label }}</label>

    <div class="input-group mb-2">
        @if ($start)
            <div class="input-group-prepend">
                <div class="input-group-text">{{ $startText }}</div>
            </div>
        @endif

        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ $value }}"
            {{ $disabled ? 'disabled' : '' }} class="form-control @error($name) is-invalid @enderror">

        @if ($end)
            <div class="input-group-append">
                <div class="input-group-text">{{ $endText }}</div>
            </div>
        @endif

        @error($name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
