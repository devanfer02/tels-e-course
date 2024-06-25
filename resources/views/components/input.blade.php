<div class="mb-3 tw-w-full">
  <label
    for="{{ $id }}"
    class="form-label tw-text-obsidian tw-block"
  >
    {{ $name }} @if($required) <span class="tw-text-red-600"> *</span> @endif
  </label>
  <div class="tw-border tw-border-obsidian tw-rounded-md">
    <input
      type="{{ $type }}"
      class="tw-w-full tw-block
      shadow-none tw-px-3 tw-py-1.5 tw-rounded-xl
      focus:tw-outline-none form-control
      focus:tw-border-mpsb-secondary-dark
      @error($id) is-invalid @enderror"
      id="{{ $id }}" name="{{ $id }}"
      value="{{ $value }}"
      placeholder="{{ $placeHolder }}"
      @if($required) required @endif
      @if(!$autoComplete) autocomplete="off" @endif
    >
  </div>
  @if($note)
  <span class="tw-text-sm tw-mt-[0.5px]">Maximum size : 4MB</span>
  @endif
  @error($id)
  <div class="tw-mt-1 tw-border tw-border-red-600 tw-text-red-600
  tw-rounded-md tw-w-full tw-px-4 tw-py-1"
  >
    {{ $message }}
  </div>
  @enderror
</div>

