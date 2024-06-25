<section class="tw-container">
  <section id="users" class="tw-overflow-x-scroll">
    <section class="tw-flex tw-mb-5">
      <input
        wire:model.live.debounce.300ms="userFullname"
        class="tw-border tw-border-obsidian focus:tw-outline-none
        tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-1/6 tw-mr-1"
        type="text"
        value="{{ $userFullname }}"
        placeholder="Masukkan nama pengguna"
      >
      <input
        wire:model.live.debounce.300ms="mapelName"
        class="tw-border tw-border-obsidian focus:tw-outline-none
        tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-3/6 tw-mx-1"
        type="text"
        value="{{ $mapelName }}"
        placeholder="Masukkan nama mata pelajaran"
      >
      <input
        wire:model.live.debounce.300ms="date"
        type="date"
        class="tw-border tw-border-obsidian focus:tw-outline-none
        tw-px-3 tw-py-1.5 tw-rounded-lg tw-flex tw-w-1/6 tw-self-center
        tw-items-center tw-mx-1"
        id="date"
      />
      <button
        class="btn btn-primary tw-w-1/6 tw-ml-1"
        wire:click="clearDate"
        >
        Reset Date
      </button>
    </section>
    <table class="tw-w-full" id="table-users">
      <thead>
        <tr class="tw-border tw-border-obsidian tw-bg-mpsb-primary tw-text-white">
          <th class="tw-px-4 tw-py-2.5 tw-text-center">No</th>
          <th class="tw-px-4 tw-py-2.5">Nama Pengguna</th>
          <th class="tw-px-10 tw-py-2.5">Nama Mata Pelajaran</th>
          <th class="tw-px-4 tw-py-2.5">Waktu Enroll</th>
        </tr>
      </thead>
      <tbody>
        @foreach($enrolls as $enroll)
          <tr class="tw-border tw-border-obsidian tw-bg-gray-300 hover:tw-bg-mpsb-secondary
          tw-duration-200 tw-ease-in-out tw-cursor-pointer">
            <td class="tw-px-4 tw-py-2.5 tw-text-center">{{ $loop->iteration }}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $enroll->user->fullname }}</td>
            <td class="tw-px-10 tw-py-2.5">{{ $enroll->course->course_name }}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $enroll->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>
  <section class="tw-mt-5">
    {{ $enrolls->links() }}
  </section>
</section>
