@extends('layout/item-layout')

@section('content')
<section class="tw-flex tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <iconify-icon
  icon="healthicons:i-exam-multiple-choice"
  class="group-hover:tw-text-mpsb-secondary"
  width="38" height="38"></iconify-icon>
  <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
    Buat Ujian Materi
  </h1>
</section>
<section class="tw-mx-10 tw-h-full">
  <livewire:make-evaluation/>
</section>
@endsection
