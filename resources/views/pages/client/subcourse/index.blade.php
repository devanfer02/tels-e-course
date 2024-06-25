<x-guest-layout pageTitle="{{ 'Materi ' . $subCourse->subcourse_name }}">
  <section class="tw-mb-2 lg:tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 lg:tw-px-14 tw-py-10">
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
      <button class="tw-hidden lg:tw-flex tw-justify-center tw-items-center tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
        <iconify-icon icon="ri:sidebar-fold-fill" width="26" height="26"></iconify-icon>
      </button>
    </section>

    <section class="tw-flex">
      <span class="tw-font-semibold tw-text-lg tw-mr-2">Mata Pelajaran {{ $course->course_name }}</span>
    </section>
  </section>
  <div class="tw-flex tw-justify-center lg:tw-hidden tw-mb-4 tw-mx-2">
    @php
      $index = 0;
      foreach(range(0, count($course->subcourses)-1) as $idx) {
        if($course->subcourses[$idx]->subcourse_name === $subCourse->subcourse_name) {
          $index = $idx;
        }
      }
    @endphp
    @if($index !== 0 )
    <a class="tw-flex tw-items-center tw-justify-center tw-w-1/3 tw-mx-1  tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary tw-no-underline tw-text-center" href="{{ route('guest.show-materi', [$course->id, $course->subcourses[$index-1]->id]) }}">
      <iconify-icon icon="fluent:previous-frame-24-filled" width="24px" height="24px"></iconify-icon>
    </a>
    @endif
    <button class="tw-w-1/3 tw-flex lg:tw-hidden tw-justify-center tw-items-center tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-2 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <iconify-icon icon="ri:sidebar-fold-fill" width="26" height="26"></iconify-icon>
    </button>
    @if($index !== count($course->subcourses)-1)
    <a class="tw-flex tw-items-center tw-justify-center tw-w-1/3 tw-mx-1  tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary tw-no-underline tw-text-center" href="{{ route('guest.show-materi', [$course->id, $course->subcourses[$index+1]->id]) }}">
      <iconify-icon icon="fluent:next-frame-24-filled" width="24px" height="24px"></iconify-icon>
    </a>
    @endif
  </div>
  <section class="tw-mx-10 lg:tw-mx-14 tw-h-full tw-mb-10 ">
    {!! $subCourse->content !!}
  </section>
  <div class="tw-hidden lg:tw-flex tw-justify-between tw-mb-2 tw-mx-10">
    @if($index !== 0)
    <a class="tw-flex tw-items-center tw-w-1/8 tw-mx-1  tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary tw-no-underline tw-text-center" href="{{ route('guest.show-materi', [$course->id, $course->subcourses[$index-1]->id]) }}">
      <iconify-icon icon="fluent:previous-frame-24-filled" width="24px" height="24px"></iconify-icon>
    </a>
    @endif
    @if($index !== count($course->subcourses)-1)
    <a class="tw-flex tw-items-center tw-w-1/8 tw-mx-1  tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary tw-no-underline tw-text-center" href="{{ route('guest.show-materi', [$course->id, $course->subcourses[$index+1]->id]) }}">
      <iconify-icon icon="fluent:next-frame-24-filled" width="24px" height="24px"></iconify-icon>
    </a>
    @endif
  </div>
  <div class="offcanvas offcanvas-end " tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header tw-bg-mpsb-primary">
      <div class="tw-flex tw-items-center tw-w-full">
        <iconify-icon
        icon='bxs:book'
        class="tw-text-mpsb-secondary tw-mr-2"
        width="38"
        height="38"
        >
        </iconify-icon>
        <div class="tw-flex tw-justify-between tw-w-full">
          <h5 class="offcanvas-title tw-text-mpsb-secondary" id="offcanvasExampleLabel">{{ $course->course_name  }}</h5>
          <button type="button" class="tw-flex tw-items-center" data-bs-dismiss="offcanvas" aria-label="Close">
            <iconify-icon icon="material-symbols:close" class="tw-text-mpsb-secondary" width="30" height="30"></iconify-icon>
          </button>

        </div>
      </div>
    </div>
    <div class="tw-h-[1px] tw-bg-obsidian"></div>
    <div class="offcanvas-body">
      @foreach($course->subcourses as $sub)
      @if((strpos($sub->subcourse_name, "UTS") !== false || strpos($sub->subcourse_name, "UAS") !== false) && $sub->load('evaluation')->evaluation)
      <div
      class="tw-my-2  tw-px-4 tw-py-2 tw-rounded-md  tw-group tw-cursor-pointer
      tw-flex  tw-border tw-border-obsidian tw-items-center"
      onclick="location.href='{{ route('user.show-exam', $sub->evaluation->id) }}'">
        <iconify-icon
        icon='healthicons:i-exam-multiple-choice'
        class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary"
        width="38"
        height="38"
        >
        </iconify-icon>
        <span

          class="tw-no-underline tw-ml-2 tw-text-lg tw-text-obsidian"
          >
          {{ $sub->subcourse_name }}
        </span>
      </div>
      @else
      <div
      class="tw-my-2  tw-px-4 tw-py-2 tw-rounded-md  tw-duration-300 tw-ease-out tw-group tw-cursor-pointer
      tw-flex tw-items-center tw-border tw-border-obsidian"
      onclick="location.href='{{ route('guest.show-materi', [$course->id, $sub->id]) }}'">
        <iconify-icon
        icon='ic:round-subject'
        class="{{ $sub->subcourse_name == $subCourse->subcourse_name ? 'tw-text-mpsb-secondary group-hover:tw-text-mpsb-primary' : 'tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary' }}"
        width="38"
        height="38"
        >
        </iconify-icon>
        <span
          class="tw-no-underline tw-text-lg tw-ml-2 {{ $sub->subcourse_name == $subCourse->subcourse_name ? 'tw-text-mpsb-secondary group-hover:tw-text-mpsb-primary' : 'tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary' }} tw-duration-300 tw-ease-out"
          >
          {{ $sub->subcourse_name }}
        </span>
      </div>
      @if($sub->load('evaluation')->evaluation)
      <div
      class="tw-my-2  tw-px-4 tw-py-2 tw-rounded-md  tw-group tw-cursor-pointer
      tw-flex  tw-border tw-border-obsidian tw-items-center"
      onclick="location.href='{{ route('user.show-exam', $sub->evaluation->id) }}'">
        <iconify-icon
        icon='healthicons:i-exam-multiple-choice'
        class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary"
        width="38"
        height="38"
        >
        </iconify-icon>
        <span

          class="tw-no-underline tw-ml-2 tw-text-lg tw-text-obsidian"
          >
          {{ $sub->subcourse_name }}'s Quiz
        </span>
      </div>
      @endif
      @endif
      @endforeach

    </div>
  </div>
</x-guest-layout>
