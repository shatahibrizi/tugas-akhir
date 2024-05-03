@props(['label', 'name', 'id', 'value' => null, 'required' => false, 'readonly' => false])

<div class="mb-3">
  <label for="{{ $id }}" class="form-label">{{ $label }}</label>
  <input type="text" class="form-control" name="{{ $name }}" id="{{ $id }}"
    @if ($value !== null) value="{{ $value }}" @endif
    @if ($required) required @endif @if ($readonly) readonly @endif>
</div>
