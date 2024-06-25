@extends('layout/layout')

@section('content')
  <section class="tw-container">
    <section id="users" class="tw-overflow-x-scroll">
      <table class="tw-w-full" id="table-users">
        <thead>
          <tr class="tw-border tw-border-obsidian tw-bg-mpsb-primary tw-text-white">
            <th class="tw-px-4 tw-py-2.5 tw-text-center">No</th>
            <th class="tw-px-4 tw-py-2.5">Nama Lengkap</th>
            <th class="tw-px-10 tw-py-2.5">Email</th>
            <th class="tw-px-4 tw-py-2.5">Registered At</th>
            <th class="tw-px-4 tw-py-2.5">Enrolled Course</th
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr class="tw-border tw-border-obsidian tw-bg-gray-300 hover:tw-bg-mpsb-secondary
            tw-duration-200 tw-ease-in-out tw-cursor-pointer">
              <td class="tw-px-4 tw-py-2.5 tw-text-center">{{ $loop->index + 1 + 10 * (((int)request('page') or 1) - 1)}}</td>
              <td class="tw-px-4 tw-py-2.5">{{ $user->fullname }}</td>
              <td class="tw-px-10 tw-py-2.5">{{ $user->email }}</td>
              <td class="tw-px-4 tw-py-2.5">{{ $user->created_at }}</td>
              <td class="tw-px-4 tw-py-2.5 tw-text-center">{{ $user->user_enroll_details_count }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </section>
    <section class="tw-mt-5">
      {{ $users->links() }}
    </section>
  </section>
@endsection
