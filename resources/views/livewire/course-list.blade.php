<section class="tw-container">
  <section class="tw-flex tw-mb-5">
    <div class="tw-w-3/4 tw-mr-1">
      <input
        wire:model.live.debounce.300ms="search"
        class="tw-border tw-border-obsidian focus:tw-outline-none
        tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-full"
        type="text"
        value="{{ $search }}"
        placeholder="Pencarian"
      >
    </div>
    <div class="tw-w-1/5 tw-mx-1">
      <x-select
        placeHolder="Kelas"
        id="kelas"
        required
        :options="config('constants.grades')"
        default="All Kelas"
        wire="grade"
        value="{{ $grade }}"
      />
    </div>
    <div class="tw-w-1/5 tw-mx-1">
      <x-select
        placeHolder="Jurusan"
        id="jurusan"
        required
        :options="config('constants.majors')"
        default="All Jurusan"
        wire="major"
        value="{{ $major }}"
      />
    </div>
    <div class="tw-w-1/5 tw-mx-1">
      <x-select
        placeHolder="Kurikulum"
        id="kurikulum"
        required
        :options="config('constants.curricula')"
        default="All Kurikulum"
        wire="curriculum"
        value="{{ $curriculum }}"
      />
    </div>
    @if(auth('web')->user())
    @if(auth('web')->user()->load('role')->role->role_name === "Admin" && $displayButton)
    <div class="tw-ml-1">
      <button class="btn btn-success">
        <a href="{{ route('tambah-mapel') }}" class="tw-no-underline tw-text-white">
          Tambah
        </a>
      </button>
    </div>
    @endif
    @endif
  </section>
  <x-alert/>
  @if($courses->isEmpty() && ($search || $grade || $major || $curriculum))
  <section class="alert alert-warning tw-text-xl">
    Mata Pelajaran yang dicari tidak dapat ditemukan
  </section>
  @elseif($courses->isEmpty())
  @else
  <section class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-4 tw-gap-y-4 tw-gap-x-4 tw-mb-5">
    @foreach($courses as $course)
      <x-course-card :course="$course" route="{{ $route }}"/>
    @endforeach
  </section>
  @endif
  <section class="">
    {{ $courses->links() }}
  </section>
</section>
