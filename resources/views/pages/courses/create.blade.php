@extends('layout/item-layout')

@section('content')
<section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <iconify-icon
  icon="bxs:book"
  class="group-hover:tw-text-mpsb-secondary"
  width="38" height="38"></iconify-icon>
  <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
    Tambah Mata Pelajaran
  </h1>
</section>
<section class="tw-container">
  <form action="{{ route('add-mapel') }}" method="POST" enctype="multipart/form-data" >
    @csrf
    <x-input
      name="Nama Mata Pelajaran"
      placeHolder="Pemrograman Dasar"
      id="mapel"
      type="text"
      required
      value="{{ old('mapel') }}"
    />
    <x-select
      name="Pilih Kelas"
      placeHolder="Kelas"
      id="kelas"
      required
      :options="config('constants.grades')"
      value="{{ old('kelas') }}"
    />
    <x-select
      name="Pilih Jurusan"
      placeHolder="Jurusan"
      id="jurusan"
      required
      :options="config('constants.majors')"
      value="{{ old('jurusan') }}"
    />
    <x-select
      name="Pilih Kurikulum"
      placeHolder="Kurikulum"
      id="kurikulum"
      required
      :options="config('constants.curricula')"
      value="{{ old('kurikulum') }}"
    />
    <livewire:create-embed-link/>
    <x-input
      name="Link Video Preview"
      placeHolder="Masukkan link video youtube preview mapel"
      id="preview"
      type="text"
      required
      value="{{ old('preview') }}"
    />
    <x-input
      name="Upload foto"
      placeHolder=""
      id="img"
      type="file"
      note="Maximum size : 4MB"
      value="{{ old('img') }}"
    />
    <div class="mb-3 tw-w-full">
      <label for="deskripsi" class="form-label tw-text-obsidian">Deskripsi Mata Pelajaran</label>
      <div class="tw-border tw-border-obsidian tw-rounded-lg">
        <textarea
          name="deskripsi"
          id="deskripsi"
          placeholder="Isi penjabaran tentang mata pelajaran"
          class="tw-border tw-border-obsidian tw-rounded-lg"
        >{{ old('deskripsi') }}</textarea>
      </div>
      @error('deskripsi')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-success">Tambah</button>
    </div>
  </form>
</section>

@endsection
