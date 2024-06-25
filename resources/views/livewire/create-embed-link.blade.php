<div>
  <label for="" class="tw-mb-1">Konversi Link</label>
  <div class="tw-border tw-border-obsidian tw-rounded-md">
    <input
      type="text"
      class="tw-w-full tw-block
      shadow-none tw-px-3 tw-py-1.5 tw-rounded-xl
      focus:tw-outline-none form-control
      focus:tw-border-mpsb-secondary-dark"
      id="" name=""
      wire:model.live="ytLink"
      value="{{ $ytLink }}"
      placeholder="Masukkan link watch video youtube"
      autocomplete="off"
    >
  </div>
  <div class="tw-mb-2">
    <span class="tw-text-sm tw-mt-[0.5px] tw-block">
      Link merupakan link watch atau share video youtube
    </span>
  </div>
  <div class="">
    <label for="" class="tw-mb-1">Hasil Konversi</label>
    <div class="tw-flex tw-mb-2">
      <button
        class="tw-border tw-border-obsidian tw-px-3 tw-py-2 tw-rounded-l-md "
        id="copyButton" type="button"
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="This top tooltip is themed via CSS variables."
      >
      <div class="tw-flex tw-self-center">
        <iconify-icon
          icon="icon-park-solid:copy"
          class="tw-text-obsidian" width="20" height="20"
          id="copy-icon">
        </iconify-icon>
      </div>
      </button>
      <div class="tw-border tw-border-obsidian tw-px-3 tw-rounded-r-md tw-w-full tw-flex tw-items-center">
        <span id="paste" wire:model="embedLink">{{ $embedLink }}</span>
      </div>
    </div>
  </div>
</div>
