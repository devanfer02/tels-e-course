<div class="mb-3">
  @if($name)
  <label
    for="{{ $id }}"
    class="tw-mb-1"
  >
    {{ $name }}
  </label>
  @endif
  <select class="tw-w-full tw-border tw-border-obsidian
  tw-py-2 tw-px-3 tw-rounded-lg focus:tw-border-mpsb-secondary-dark
  @error($id) is-invalid @enderror"
  @if($wire) wire:model.change="{{ $wire }}" @endif
  @if($required) required @endif
  id="{{ $id }}" name="{{ $id }}"
  @if($loadTiny) onchange="loadTinyAfter()" @endif
  >
    @if($value)
    <option default="{{ $value }}" value="{{ $value }}" class="tw-hidden">{{ $value }}</option>
    @else
    <option default="" class="tw-hidden" value="">{{ $placeHolder }}</option>
    @endif
    @if($default)
    <option default="" value="">{{ $default }}</option>
    @endif
    @foreach($options as $option)
    @if($key && $keyValue)
    <option value="{{ $option[$key] }}">{{ $option[$keyValue] }}</option>
    @else
    <option value="{{ $option }}">{{ $option }}</option>
    @endif
    @endforeach
  </select>
</div>
