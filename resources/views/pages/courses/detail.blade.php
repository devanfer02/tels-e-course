@extends('layout.item-layout')

@section('content')
<section class="tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <section class="tw-flex tw-justify-between tw-self-center tw-items-center">
    <section class="tw-flex">
      <iconify-icon
      icon="bxs:book"
      class="group-hover:tw-text-mpsb-secondary"
      width="38" height="38"></iconify-icon>
      <h1 class="tw-text-lg lg:tw-text-2xl tw-mx-3 tw-font-semibold">
        {{ $course->course_name }}
      </h1>
    </section>
  </section>
  <section class="tw-flex">
    <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $course->grade->grade_name }} - </span>
    <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $course->major->major_name }} - </span>
    <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $course->curriculum->curriculum_name }}</span>
  </section>
</section>
<section class="tw-mx-10 tw-h-full">
  <section class="lg:tw-flex tw-px-5 lg:tw-px-20 tw-border-2 tw-border-mpsb-primary tw-rounded-lg tw-mb-5 tw-py-5 lg:tw-mr-2">
    <section class="lg:tw-hidden tw-mb-5 tw-flex tw-justify-center">
      @if($course->video_link)
      <iframe src="{{ $course->video_link }}" frameborder="0" width="440px" height="250px"></iframe>
      @else
      <img src="{{ $course['photo_link'] === '' ? asset('assets/img/default_course.png') : $course['photo_link'] }}" alt="">
      @endif
    </section>
    <section class="tw-w-2/3 tw-flex tw-self-center">
      <div class="tw-text-obsidian">
        <div class="tw-text-sm lg:tw-text-md">
          {!! $course->course_description !!}
        </div>
      </div>
    </section>
    <section class="tw-w-2/4 tw-self-center lg:tw-ml-2 tw-hidden lg:tw-flex">
      @if($course->video_link)
      <iframe src="{{ $course->video_link }}" frameborder="0" width="480px" height="270px"></iframe>
      @else
      <img src="{{ $course['photo_link'] === '' ? asset('assets/img/default_course.png') : $course['photo_link'] }}" alt="">
      @endif
    </section>
  </section>
  <x-alert/>
  <section class="tw-flex tw-justify-center">
    <a class="tw-mx-1 tw-w-1/4 tw-bg-mpsb-primary btn btn-primary" href="{{ route('tambah-materi', $course) }}">Tambah Materi</a>
    <button type="button" class="tw-mx-1 tw-w-1/4 tw-bg-mpsb-primary btn btn-primary" data-bs-toggle="modal" data-bs-target="#evaluationModal">
      Buat Ujian
    </button>
    <a class="tw-mx-1 tw-w-1/4 tw-bg-mpsb-primary btn btn-success tw-flex tw-items-center" href="{{ route('edit-mapel', $course->id) }}">Edit Mapel</a>
    <button class="tw-mx-1 tw-w-1/4 btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmDeleteMapel">Hapus Mapel</button>
  </section>

  @if($course->subcourses->isEmpty())
  <section class="tw-mt-5 alert alert-warning" role="alert">
    <h5 class="lg:tw-text-xl tw-font-semibold tw-text-md">
      Materi mata pelajaran masih kosong
    </h5>
  </section>
  @else
  <section class="tw-mt-5 tw-mb-16">
    {{-- RENDER SUBCOURSES IN HERE --}}
    @foreach($course->subcourses as $subCourse)
    <section
      class="tw-mt-5 tw-border tw-border-mpsb-primary tw-bg-mpsb-secondary
      tw-rounded-lg tw-p-5 tw-group hover:tw-bg-mpsb-primary hover:tw-border-mpsb-secondary
      tw-duration-200 tw-ease-in-out tw-flex tw-justify-between
      tw-cursor-pointer"
      onclick="location.href='{{ route('show-materi',[$course->id, $subCourse->id]) }}';"
    >
      <div class="tw-flex">
        <iconify-icon
          icon="ic:round-subject"
          width="38" height="38"
          class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">
        </iconify-icon>
        <span class="tw-block tw-text-obsidian tw-text-md lg:tw-text-xl tw-mx-3
        group-hover:tw-text-white tw-duration-200 tw-ease-in-out">
          {{ $subCourse->subcourse_name }}
        </span>
      </div>
      <div class="tw-flex tw-justify-end">
        @if($subCourse->evaluation)
        <a href="{{ route('show-ujian', $subCourse->evaluation->id) }}" class="btn btn-primary tw-mx-1">
          Lihat Ujian
        </a>
        @endif
        <a href="{{ route('edit-materi', [$course->id, $subCourse->id]) }}" class="btn btn-success tw-mx-1">
          Edit
        </a>
        <form action="{{ route('delete-materi', [$course->id, $subCourse->id]) }}" class="btn btn-danger tw-mx-1" method="POST">
          @csrf
          @method('DELETE')
          <button>Hapus</button>
        </form>
      </div>
    </section>
    @endforeach
  </section>
  @endif
</section>
<div class="modal fade" id="confirmDeleteMapel" tabindex="-1" aria-labelledby="confirmDeleteMapel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="confirmDeleteMapel">Konfirmasi Hapus Mata Pelajaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="tw-mb-5">
          <span class="tw-font-semibold">Apakah kamu yakin ingin menghapus mata pelajaran {{ $course->course_name }}</span>
        </section>
        <form action="{{ route('delete-mapel', $course->id) }}" method="POST">
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
<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="evaluationModal">Buat Ujian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('create-ujian') }}">
          <x-select
            name="Pilih Materi"
            id="materi"
            placeHolder="Materi"
            required
            :options="$course->subcourses->toArray()"
            key="subcourse_name"
            keyValue="subcourse_name"
            value=""
          />
          <x-select
            name="Pilih Kategori Ujian"
            id="ujian"
            placeHolder="Kategori"
            required
            :options="config('constants.evaluations')"
            value=""
          />
          <x-input
            name="KKM Ujian"
            id="kkm"
            placeHolder="Masukkan KKM"
            required
            value=""
          />
          <input type="hidden" value="{{ $course->id }}" name="course_id">
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Buat</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
