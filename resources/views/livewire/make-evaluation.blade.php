<form class="tw-mb-10 tw-h-screen tw-w-full" method="GET" action="{{ route('create-ujian', $mapel->id ?? $mapel) }}">
  <x-alert />
  <x-select
    placeHolder="Mata Pelajaran"
    name="Pilih Mata Pelajaran"
    id="mapel"
    required
    :options="$courses"
    wire="mapel"
    key="course_name"
    keyValue="course_name"
    value="{{ $mapel }}"
  />
  <x-select
    placeHolder="Materi"
    name="Pilih Materi"
    id="materi"
    required
    key="subcourse_name"
    keyValue="subcourse_name"
    :options="$subcourses"
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
  <input type="hidden" value="{{ $mapelId }}" name="course_id">
  <button
    type="submit"
    class="btn btn-success tw-w-full"
  >
    Buat Ujian Materi
  </button>
</form>
