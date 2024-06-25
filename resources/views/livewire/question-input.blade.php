<div class="">
  <div class="tw-mb-2">
    <span class="tw-text-obsidian tw-text-xl">Soal {{ $id }}</span>
    <div class="tw-h-[1px] tw-mt-2 tw-bg-obsidian"></div>
  </div>
  <x-select
    name="Kategori Soal"
    placeHolder="Pilihan Ganda"
    id="{{ 'kategori' . $id }}"
    required
    :options="config('constants.questions')"
    wire="type"
    value="{{ $question->questionCategory->category_name??'' }}"
    :loadTiny="true"
  />
  <div class="mb-3 tw-w-full">
    <label for="deskripsi" class="form-label tw-text-obsidian tw-text-md">Deskripsi Soal</label>
    <div class="tw-border tw-border-obsidian tw-rounded-lg" wire:ignore>
      <textarea
        name="{{ 'deskripsi' . $id }}"
        id="{{ 'deskripsi' . $id }}"
        placeholder="Isi deskripsi soal"
        class="tw-border tw-border-obsidian tw-rounded-lg"
      >{!! $question->description??'' !!}</textarea>
    </div>
    @error('deskripsi')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
  <div>
    @if($type === "Pilihan Ganda")
      @if($question)
      <x-pilihan-ganda :id="$id" :pilgan="$question->options[0]->pilgandas ? $question->options : null"/>
      @else
      <x-pilihan-ganda :id="$id"/>
      @endif
    @else
      @if($question)
      <x-drag-and-drop :id="$id" :dragndrop="$question->options[0]->dragNDrops ? $question->options : null"/>
      @else
      <x-drag-and-drop :id="$id" />
      @endif
    @endif
  </div>
</div>
