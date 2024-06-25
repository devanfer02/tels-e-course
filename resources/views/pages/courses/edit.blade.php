@extends('layout/item-layout')

@section('content')
<section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <iconify-icon
  icon="bxs:book"
  class="group-hover:tw-text-mpsb-secondary"
  width="38" height="38"></iconify-icon>
  <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
    {{ $course->course_name }}
  </h1>
</section>
<section class="tw-container">
  <form action="{{ route('update-mapel', $course->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <x-input
      name="Nama Mata Pelajaran"
      placeHolder="Pemrograman Dasar"
      id="mapel"
      type="text"
      required
      value="{{ $course->course_name }}"
    />
    <x-select
      name="Pilih Kelas"
      placeHolder="Kelas"
      id="kelas"
      required
      :options="config('constants.grades')"
      value="{{ $course->grade->grade_name }}"
    />
    <x-select
      name="Pilih Jurusan"
      placeHolder="Jurusan"
      id="jurusan"
      required
      :options="config('constants.majors')"
      value="{{ $course->major->major_name }}"
    />
    <x-select
      name="Pilih Kurikulum"
      placeHolder="Kurikulum"
      id="kurikulum"
      required
      :options="config('constants.curricula')"
      value="{{ $course->curriculum->curriculum_name }}"
    />
    <livewire:create-embed-link/>
    <x-input
      name="Link Video Preview"
      placeHolder="Masukkan link video youtube preview mapel"
      id="preview"
      type="text"
      required
      value="{{ $course->video_link }}"
    />
    <x-input
      name="Upload foto"
      placeHolder=""
      id="img"
      type="file"
      note="Maximum size : 4MB"
      value="{{ $course->photo_link }}"
    />
    @if($course->photo_link)
    <div class="mb-3 lg:tw-flex tw-border tw-border-obsidian tw-rounded-lg tw-pb-10 tw-pt-5 tw-justify-center">
      <div class="tw-px-2">
        <p class="tw-text-md tw-obisidian tw-text-center">
          Cover Mata Pelajaran
        </p>
        <img
          src="{{ $course->photo_link }}"
          alt=""
          class="tw-max-h-[360px] tw-min-h-[360px]"
        >
      </div>
      @if($course->video_link)
      <div class="tw-px-2">
        <p class="tw-text-md tw-obisidian tw-text-center">
          Preview Mata Pelajaran
        </p>
        <div class="">
          <iframe src="{{ $course->video_link }}" frameborder="0" width="640px" height="360px"></iframe>
        </div>
      </div>
      @endif
    </div>
    @endif
    <x-textarea
      name="Deskripsi Mata Pelajaran"
      placeHolder="Isi penjabaran tentang mata pelajaran"
      id="deskripsi"
      required
      value="{!! $course->course_description !!}"
    />
    <div class="mb-3">
      <button type="submit" class="btn btn-success" onclick="console.log('HELLO WORLD')">Update</button>
      <a onclick="window.history.back(); return false;" class="btn btn-secondary tw-mx-1">Back</a>
    </div>
  </form>
</section>
@endsection
