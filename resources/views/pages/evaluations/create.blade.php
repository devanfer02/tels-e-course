@extends('layout/item-layout')

@section('content')
<section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <iconify-icon
  icon="ic:round-subject"
  class="group-hover:tw-text-mpsb-secondary"
  width="38" height="38"></iconify-icon>
  <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
    Buat Ujian Materi {{ $subcourse->subcourse_name }}
  </h1>
</section>
<section class="tw-mx-10 tw-h-full">
  <form class="tw-flex tw-mb-10 tw-h-screen tw-w-full" method="POST" action="{{ route('add-ujian') }}">
    @csrf
    <section class="tw-fixed tw-mx-2 tw tw-w-1/4 tw-pr-32 tw-flex tw-justify-start">
      <section>
        <section class="tw-mb-5">
          <h1 class="tw-text-xl tw-text-obsidian">List Soal</h1>
          <div class="tw-h-[1px] tw-bg-obsidian"></div>
        </section>
        <livewire:evaluation-buttons :jumlahSoal="$jumlahSoal"/>
        <section class="tw-my-4 tw-w-full">
          <button class="btn btn-success tw-w-full">
            Buat Kuis
          </button>
        </section>
        <livewire:create-content-link/>
      </section>
    </section>
    <section class="tw-ml-80 tw-mx-5 tw-w-3/4">
      @foreach(range(1, $jumlahSoal) as $id)
      <div class="tw-border tw-border-obsidian tw-rounded-md tw-p-5 tw-mb-5" id="{{ $id }}">
        <livewire:question-input :id="$id"/>
      </div>
      @endforeach
    </section>
    <input type='hidden' name="jumlahSoal" value="{{ $jumlahSoal }}"/>
    <input type='hidden' name="kkm" value="{{ $kkm }}"/>
    <input type="hidden" name="materi" value="{{ $subcourse->id }}"/>
    <input type="hidden" name="kategori" value="{{ $evalCategory->id }}" />
  </form>
</section>
@endsection
