@extends('layout/item-layout')

@section('content')
<section class="tw-fixed tw-w-full">
  <section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
    <iconify-icon
    icon="ic:round-subject"
    class="group-hover:tw-text-mpsb-secondary"
    width="38" height="38"></iconify-icon>
    <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
      Ujian Materi {{ $evaluation->subcourse->subcourse_name }}
    </h1>
  </section>
</section>
<section class="tw-mx-10 tw-mt-32">
  <section class="lg:tw-flex tw-mb-10 tw-h-screen tw-w-full">
    <section class="lg:tw-fixed tw-mx-2 lg:tw-w-1/4 lg:tw-pr-32 tw-flex lg:tw-justify-start tw-justify-center">
      <section class="tw-w-full">
        <section class="tw-mb-5">
          <h1 class="tw-text-xl tw-text-obsidian">List Soal</h1>
          <div class="tw-h-[1px] tw-bg-obsidian"></div>
        </section>
        <livewire:evaluation-buttons :jumlahSoal="$evaluation->questions->count()"/>
        <section class="tw-w-full tw-mt-4">
          <div class="tw-mb-2">
            <span class="tw-text-xl">Detail Ujian</span>
            <div class="tw-h-[1px] tw-bg-obsidian tw-mb-2"></div>
            <table>
              <tbody>
                <tr>
                  <td>Tipe Ujian</td>
                  <td>: {{ $evaluation->evaluationCategory->category_name }}</td>
                </tr>
                <tr>
                  <td>KKM</td>
                  <td>: {{ $evaluation->minimum_competency }}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div>
            <span class="tw-text-obsidian tw-text-xl tw-mb-2">Actions</span>
            <div class="tw-h-[1px] tw-bg-obsidian"></div>
          </div>
          <a class="btn btn-success tw-w-full tw-mt-2" href="{{ route('edit-ujian', $evaluation->id) }}">Edit Ujian</a>
          <button class="btn btn-danger tw-w-full tw-mt-2" data-bs-toggle="modal" data-bs-target="#confirmDeleteUjian">Hapus Ujian</button>
        </section>
        <div class="tw-mt-5">
          <x-alert/>
        </div>
      </section>
    </section>
    <section class="lg:tw-ml-72 tw-mx-5 lg:tw-w-3/4 tw-grid tw-grid-cols-1 tw-gap-5 tw-mb-10">
      @foreach($evaluation->questions as $question)
        @if($question->questionCategory->category_name === "Pilihan Ganda")
        <x-pilihan-ganda-view :pilganda="$question" :id="$loop->index+1"/>
        @else
        <x-drag-and-drop-view :dragndrop="$question" :id="$loop->index+1"/>
        @endif
      @endforeach
    </section>
  </section>
</section>
<div class="modal fade" id="confirmDeleteUjian" tabindex="-1" aria-labelledby="confirmDeleteUjian" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="confirmDeleteUjian">Konfirmasi Hapus Ujian Materi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="tw-mb-5">
          <span class="tw-font-semibold">Apakah kamu yakin ingin menghapus ujian materi {{ $evaluation->subcourse->subcourse_name }}</span>
        </section>
        <form action="{{ route('delete-ujian', $evaluation->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <div class="modal-footer">
            <button type="submit" class="btn btn-danger">Hapus</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
