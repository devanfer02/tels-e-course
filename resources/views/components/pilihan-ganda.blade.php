<section>
  <x-select
    name="Pilih Kunci Jawaban"
    placeHolder="Kunci Jawaban"
    id="{{ 'kunci' . $id }}"
    :options="$options"
    :required="true"
    :value="$correct??''"
  />
  <section>
    @if(isset($pilgan))
    @foreach($pilgan as $index => $pilga)
    <section class="tw-border tw-border-obsidian tw-rounded-lg tw-py-2.5 tw-px-4 tw-mb-2 tw-bg-mpsb-secondary">
      <x-input
        name="Pilihan {{ $options[$index] }}"
        placeHolder="Isi option {{ $options[$index] }}"
        id="{{ 'pilihan' . $options[$index] . $id }}"
        type="text"
        required
        value="{{ $pilga->pilgandas->option_value }}"
      />
    </section>
    @endforeach
    @else
    @foreach($options as $option)
    <section class="tw-border tw-border-obsidian tw-rounded-lg tw-py-2.5 tw-px-4 tw-mb-2 tw-bg-mpsb-secondary">
      <x-input
        name="Pilihan {{ $option }}"
        placeHolder="Isi option {{ $option }}"
        id="{{ 'pilihan' . $option . $id }}"
        type="text"
        required
        value=""
      />
    </section>
    @endforeach
    @endif
  </section>
</section>

