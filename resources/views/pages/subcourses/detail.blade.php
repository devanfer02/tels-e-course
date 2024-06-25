@extends('layout/item-layout')

@section('content')
<section class="tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 tw-py-5">
  <section class="tw-flex tw-justify-between">
    <section class="tw-flex">
      <iconify-icon
      icon="ic:round-subject"
      class="group-hover:tw-text-mpsb-secondary"
      width="38" height="38"></iconify-icon>
      <h1 class="tw-text-2xl tw-mx-3 tw-font-semibold">
        {{ $subCourse->subcourse_name }}
      </h1>
    </section>
  </section>
  <section class="tw-flex">
    <span class="tw-font-semibold tw-text-lg tw-mr-2">Mata Pelajaran {{ $course->course_name }}</span>
  </section>
</section>
<section class="tw-mx-10 tw-h-full">
  {!! $subCourse->content !!}
</section>
@endsection
