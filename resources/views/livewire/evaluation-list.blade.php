<section class="tw-container">
  <section id="users" class="tw-overflow-x-scroll">
    <section class="tw-flex tw-mb-2">
      <div class="tw-w-2/4 tw-mr-1">
        <input
          wire:model.live.debounce.300ms="judulMapel"
          class="tw-border tw-border-obsidian focus:tw-outline-none
          tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-full"
          type="text"
          value="{{ $judulMapel }}"
          placeholder="Masukkan nama mata pelajaran"
        >
      </div>
      <div class="tw-w-2/4 tw-mr-1 tw-ml-1">
        <input
          wire:model.live.debounce.300ms="judulMateri"
          class="tw-border tw-border-obsidian focus:tw-outline-none
          tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-full"
          type="text"
          value="{{ $judulMateri }}"
          placeholder="Masukkan nama materi"
        >
      </div>
      <div class="tw-w-1/5 tw-h-full tw-mx-1">
        <x-select
          placeHolder="Kategori"
          id="kelas"
          required
          :options="config('constants.evaluations')"
          default="All Kategori"
          wire="kategori"
          value="{{ $kategori }}"
        />
      </div>
      <div class="tw-w-1/5 tw-ml-1">
        <a
          class="btn btn-primary tw-w-full "
          href="{{ route('make-ujian') }}"
        >
          Buat Ujian
        </a>
      </div>
    </section>
    <table class="tw-w-full" id="table-users">
      <thead>
        <tr class="tw-border tw-border-obsidian tw-bg-mpsb-primary tw-text-white">
          <th class="tw-px-4 tw-py-2.5 tw-text-center">No</th>
          <th class="tw-px-4 tw-py-2.5">Mata Pelajaran</th>
          <th class="tw-px-4 tw-py-2.5">Materi</th>
          <th class="tw-px-10 tw-py-2.5">Kategori Ujian</th>
          <th class="tw-px-4 tw-py-2.5">KKM Ujian</th>
        </tr>
      </thead>
      <tbody>
        @foreach($evaluations as $evaluation)
          <tr
            class="tw-border tw-border-obsidian tw-bg-gray-300 hover:tw-bg-mpsb-secondary
            tw-duration-200 tw-ease-in-out tw-cursor-pointer"
            onclick="location.href='{{ route('show-ujian', $evaluation->id) }}'"
            >
            <td class="tw-px-4 tw-py-2.5 tw-text-center">{{ $loop->index + 1 + 10 * (((int)request('page') or 1) - 1)}}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $evaluation->subcourse->course->course_name }}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $evaluation->subcourse->subcourse_name }}</td>
            <td class="tw-px-10 tw-py-2.5">{{ $evaluation->evaluationCategory->category_name }}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $evaluation->minimum_competency }}</td>
          </tr>
        @endforeach
      </tbody>
  </table>
  </section>
  <section class="tw-mt-5">
    {{ $evaluations->links() }}
  </section>
</section>
