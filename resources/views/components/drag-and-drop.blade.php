<section>
  <section class="tw-flex tw-justify-between">
    <section class="tw-w-1/2 tw-mr-2">
      @foreach($options as $option)
      <section class="tw-border tw-border-obsidian tw-rounded-lg tw-py-2.5 tw-px-4 tw-mb-2 tw-bg-mpsb-secondary">
        <x-textarea
          name="Kunci {{ $option }}"
          placeHolder="Isi option {{ $option }}"
          id="{{ 'kunci' . $option . '-' .  $id }}"
          type="text"
          required
          :value="$dragndrop[intval($option)-1]->dragNDrops->option_key??''"
        />
      </section>
      @endforeach
    </section>
    <section class="tw-w-1/2 tw-ml-2">
      @foreach($options as $option)
      <section class="tw-border tw-border-obsidian tw-rounded-lg tw-py-2.5 tw-px-4 tw-mb-2 tw-bg-mpsb-secondary">
        <x-textarea
          name="Jawaban {{ $option }}"
          placeHolder="Isi option {{ $option }}"
          id="{{ 'jawaban' . $option . '-' . $id }}"
          type="text"
          required
          :value="$dragndrop[intval($option)-1]->dragNDrops->option_value??''"
        />
      </section>
      @endforeach
    </section>
  </section>
</section>
