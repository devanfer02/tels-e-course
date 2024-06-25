@extends('layout/item-layout')

@section('content')
<section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5 tw-justify-between">
  <section class="tw-flex">
    <iconify-icon
    icon="ic:round-subject"
    class="group-hover:tw-text-mpsb-secondary"
    width="38" height="38"></iconify-icon>
    <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
      Update materi {{ $subCourse->subcourse_name }}
    </h1>
  </section>
</section>
<section class="tw-container">
  <form action="{{ route('update-materi', $subCourse->id ) }}" method="POST" enctype="multipart/form-data" >
    @csrf
    @method('PUT')
    <x-input
      name="Nama Materi"
      placeHolder="Masukkan nama materi"
      id="subcourse_name"
      type="text"
      required
      value="{{ $subCourse->subcourse_name }}"
    />
    <x-input
      name="Urutan Materi"
      placeHolder="Masukkan urutan materi"
      id="order"
      type="text"
      required
      value="{{ $subCourse->order }}"
    />
    <livewire:create-content-link/>
    <div class="mb-3 tw-w-full">
      <label for="content" class="form-label tw-text-obsidian">Konten Materi</label>
      <div class="tw-border tw-border-obsidian tw-rounded-lg">
        <textarea
          name="content"
          id="content"
          placeholder="Isi konten materi"
          class="tw-border tw-border-obsidian tw-rounded-lg"
        >{{ $subCourse->content }}</textarea>
      </div>
      @error('content')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>
    <div class="mb-3">
      <button type="submit" class="btn btn-success">Update</button>
    </div>
  </form>
</section>
@endsection
