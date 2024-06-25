<section class="tw-container">
  <section id="users" class="tw-overflow-x-scroll">
    <section class="tw-flex tw-mb-5">
      <input
        wire:model.live.debounce.300ms="namaAdmin"
        class="tw-border tw-border-obsidian focus:tw-outline-none
        tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-1/6 tw-mr-1"
        type="text"
        value="{{ $namaAdmin }}"
        placeholder="Masukkan nama admin"
      >
      <input
        wire:model.live.debounce.300ms="action"
        class="tw-border tw-border-obsidian focus:tw-outline-none
        tw-px-3 tw-py-1.5 tw-rounded-lg tw-w-3/6 tw-mx-1"
        type="text"
        value="{{ $action }}"
        placeholder="Masukkan aksi admin"
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
          <th class="tw-px-4 tw-py-2.5">Nama Admin</th>
          <th class="tw-px-10 tw-py-2.5">Aksi Admin</th>
          <th class="tw-px-4 tw-py-2.5">Waktu Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($records as $record)
          <tr class="tw-border tw-border-obsidian tw-bg-gray-300 hover:tw-bg-mpsb-secondary
          tw-duration-200 tw-ease-in-out tw-cursor-pointer">
            <td class="tw-px-4 tw-py-2.5 tw-text-center">{{ $loop->index + 1 + 10 * (((int)request('page') or 1) - 1)}}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $record->admin->fullname }}</td>
            <td class="tw-px-10 tw-py-2.5">{{ $record->log }}</td>
            <td class="tw-px-4 tw-py-2.5">{{ $record->created_at }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </section>
  <section class="tw-mt-5">
    {{ $records->links() }}
  </section>
</section>
