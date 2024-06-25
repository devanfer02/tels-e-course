<div class="tw-border tw-border-obsidian tw-p-5 tw-rounded-md" id="{{ $id }}">
  <div class="tw-mb-2">
    <span class="tw-text-obsidian tw-text-xl">Soal {{ $id }}</span>
    <div class="tw-h-[1px] tw-mt-2 tw-bg-obsidian"></div>
  </div>
  <div class="mb-3 tw-w-full">
    <label for="deskripsi" class="form-label tw-text-obsidian tw-text-md">Deskripsi Soal</label>
    <div class="tw-border tw-border-obsidian tw-rounded-lg tw-px-5 tw-py-2">
      <span>{!! $dragndrop->description !!}</span>
    </div>
  </div>
  <div class="tw-flex tw-justify-between tw-w-full">
    @if($show)
    <section class="tw-w-1/2 tw-mr-2 tw-rounded-md tw-grid tw-grid-cols-1 tw-gap-4">
      @foreach ($dragndrop->options as $option)
      <section class="tw-border tw-border-mpsb-secondary tw-px-3 tw-py-2 tw-rounded-md tw-flex tw-items-center
      tw-self-center tw-bg-mpsb-primary ">
        <span class="tw-bg-mpsb-secondary tw-px-3 tw-py-1 tw-rounded-full">
          {{ $loop->index + 1 }}
        </span>
        <span class="tw-mx-5 tw-text-white">
          {!! $option->dragNDrops->option_key !!}
        </span>
      </section>
      @endforeach
    </section>
    <section class="tw-w-1/2 tw-ml-2 tw-rounded-md tw-grid tw-grid-cols-1 tw-gap-4">
      @foreach ($dragndrop->options as $option)
      <section class="tw-border tw-border-mpsb-primary tw-px-3 tw-py-2 tw-rounded-md tw-flex tw-items-center
      tw-self-center tw-bg-mpsb-secondary ">
        <span class="tw-bg-mpsb-primary tw-px-3 tw-py-1 tw-rounded-full tw-text-white">
          {{ $loop->index + 1 }}
        </span>
        <span class="tw-mx-5 tw-text-obsidian">
          {!! $option->dragNDrops->option_value !!}
        </span>
      </section>
      @endforeach
    </section>
    @else
    <section class="tw-w-1/2 tw-mr-2 tw-rounded-md tw-grid tw-grid-cols-1 tw-gap-4">
      @foreach ($dragndrop->options as $option)
      <section class="tw-border tw-border-mpsb-secondary tw-px-3 tw-py-2 tw-rounded-md tw-flex tw-items-center
      tw-self-center tw-text-obsidian tw-cursor-pointer">
        <span class="tw-bg-mpsb-secondary tw-px-3 tw-py-1 tw-rounded-full">
          {{ $loop->index + 1 }}
        </span>
        <span class="tw-mx-5 ">
          {!! $option->dragNDrops->option_key !!}
        </span>
      </section>
      @endforeach
    </section>
    <section class="tw-w-1/2 tw-ml-2 tw-rounded-md tw-grid tw-grid-cols-1 tw-gap-4">
      @foreach ($dragndrop->options as $option)
      <section class="tw-border tw-border-mpsb-primary tw-px-3 tw-py-2 tw-rounded-md tw-flex tw-items-center
      tw-self-center tw-text-obsidian tw-cursor-pointer">
        <span class="tw-bg-mpsb-primary tw-px-3 tw-py-1 tw-rounded-full tw-text-white">
          {{ $loop->index + 1 }}
        </span>
        <span class="tw-mx-5 tw-text-obsidian">
          {!! $option->dragNDrops->option_value !!}
        </span>
      </section>
      @endforeach
    </section>
    @endif

  </div>
</div>
