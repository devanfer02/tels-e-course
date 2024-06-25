<div class="mb-3 tw-w-full">
  <label
    for="{{ $id }}"
    class="form-label tw-text-obsidian"
  >
    {{ $name }} @if($required) <span class="tw-text-red-600"> *</span> @endif
  </label>
  <div class="tw-border tw-border-obsidian tw-rounded-lg" >
    <textarea
      class=" @error($id) is-invalid @enderror"
      id="{{ $id }}" name="{{ $id }}"
      placeholder="{{ $placeHolder }}"
    >{{ $value }}</textarea>
    @error($id)
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
</div>

