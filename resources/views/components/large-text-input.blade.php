<!-- resources/views/components/large-description-input.blade.php -->

@props(['label', 'name', 'id', 'required' => false, 'value' => null, 'readonly' => false])

<div class="mb-3">
  <label for="{{ $id }}" class="form-label">{{ $label }}</label>
  <textarea class="form-control" name="{{ $name }}" id="{{ $id }}" rows="6"
    @if ($required) required @endif @if ($readonly) readonly @endif>{{ $value ?? '' }}</textarea> <!-- Mengatur jumlah baris menjadi 8 -->
</div>
