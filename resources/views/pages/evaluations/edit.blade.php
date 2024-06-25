@extends('layout/item-layout')

@section('content')
<section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <iconify-icon
  icon="ic:round-subject"
  class="group-hover:tw-text-mpsb-secondary"
  width="38" height="38"></iconify-icon>
  <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
    Ujian Materi {{ $evaluation->subcourse->subcourse_name }}
  </h1>
</section>
<section class="tw-mx-10 tw-h-full">
  <section class="tw-flex tw-mb-10 tw-h-screen tw-w-full">
    <section class="tw-fixed tw-mx-2 tw tw-w-1/4 tw-pr-32 tw-flex tw-justify-start">
      <section>
        <section class="tw-mb-5">
          <h1 class="tw-text-xl tw-text-obsidian">List Soal</h1>
          <div class="tw-h-[1px] tw-bg-obsidian"></div>
        </section>
        <livewire:evaluation-buttons :jumlahSoal="$evaluation->questions->count()"/>
        <form class="tw-mt-4" action="{{ route('update-evaluation', $evaluation->id) }}" method="POST">
          @csrf
          @method('PUT')
          <x-input
            name="Nilai KKM"
            id="minimum_competency"
            placeHolder="Masukkan KKM"
            value="{{ $evaluation->minimum_competency }}"
          />
          <button class="btn btn-success tw-w-full">Perbarui KKM</button>
        </form>
        <a
          class="btn btn-primary tw-w-full tw-mt-2"
          href="{{ route('show-ujian', $evaluation->id) }}"
        >
          View Ujian
        </a>
        <div class="tw-my-4">
          <livewire:create-content-link/>
        </div>
        <div>
          <x-alert/>
        </div>
      </section>
    </section>
    <section class="tw-ml-80 tw-mx-5 tw-w-3/4">
      @foreach($evaluation->questions as $question)
      <form
        class="tw-border tw-border-obsidian tw-rounded-md tw-p-5 tw-mb-5"
        id="{{ $loop->index+1 }}"
        action="{{ route('update-question', $question->id) }}"
        method="POST"
      >
        @csrf
        @method('PUT')
        <input type="hidden" value="{{ $loop->index + 1 }}" name="id">
        <livewire:question-input :id="$loop->index+1" :question="$question" :type="$question->questionCategory->category_name"/>
        <button
          type="submit"
          class="btn btn-success tw-w-full"
          id="update-pertanyaan"
        >
          Update Pertanyaan
        </button>
      </form>
      @endforeach
    </section>
  </section>
</section>
@endsection
