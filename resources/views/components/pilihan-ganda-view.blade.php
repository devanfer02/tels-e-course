<div class="tw-border tw-border-obsidian tw-p-5 tw-rounded-md" id="{{ $id }}">
  <div class="tw-mb-2">
    <span class="tw-text-obsidian tw-text-xl">Soal {{ $id }}</span>
    <div class="tw-h-[1px] tw-mt-2 tw-bg-obsidian"></div>
  </div>
  <div class="mb-3 tw-w-full">
    <label for="deskripsi" class="form-label tw-text-obsidian tw-text-md">Deskripsi Soal</label>
    <div class="tw-border tw-border-obsidian tw-rounded-lg tw-px-5 tw-py-2">
      <span>{!! $pilganda->description !!}</span>
    </div>
  </div>
  <div>
    @foreach ($pilganda->options as $option)
      @if($show)
      <section class="tw-border tw-border-mpsb-primary
      {{ $option->pilgandas->correct ? "bg-primary" : "bg-danger" }}
      tw-text-white tw-rounded-md tw-my-2 tw-px-3 tw-py-2 tw-flex">
        <section class="tw-flex tw-items-center tw-self-center tw-mr-4  ">
          @if($option->pilgandas->correct)
          <iconify-icon icon="mdi:check"></iconify-icon>
          @else
          <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
          @endif
        </section>
        <span>
          {{ $option->pilgandas->option_value }}
        </span>
      </section>
      @else
      <section class="tw-border tw-border-mpsb-primary tw-cursor-pointer
      tw-text-obsidian tw-rounded-md tw-my-2 tw-px-3 tw-py-2 tw-flex hover:tw-bg-blue-500 tw-duration-300 tw-ease-in-out">
        <section class="tw-flex tw-items-center tw-self-center tw-mr-4 tw-border tw-rounded-full tw-px-2 tw-border-obsidian tw-bg-white">
          {{ chr($loop->index+65) }}
        </section>
        <span>
          {{ $option->pilgandas->option_value }}
        </span>
      </section>
      @endif
    @endforeach
  </div>
</div>
