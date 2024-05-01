@props(['label', 'name', 'id', 'required' => false])

<div class="mb-3">
  <label for="{{ $id }}" class="form-label">{{ $label }}</label>
  <input type="text" class="form-control" name="{{ $name }}" id="{{ $id }}"
    @if ($required) required @endif>
</div>
