<x-guest-layout pageTitle="TELS Course">
  <section class="tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 lg:tw-px-14 tw-py-10">
    <section class="tw-flex tw-justify-center lg:tw-justify-start">
      <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $course->grade->grade_name }} - </span>
      <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $course->major->major_name }} - </span>
      <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $course->curriculum->curriculum_name }}</span>
    </section>
  </section>
  <section class="tw-mx-2 lg:tw-mx-10 tw-h-full">
    <section class="lg:tw-flex tw-px-5 lg:tw-px-20 tw-py-16 tw-border-2 tw-border-mpsb-primary tw-rounded-lg tw-mb-5 lg:tw-mr-2">
      <section class="lg:tw-hidden tw-mb-5 tw-flex tw-justify-center">
        @if($course->video_link)
        <iframe src="{{ $course->video_link }}" frameborder="0" width="500px" height="300px"></iframe>
        @else
        <img src="{{ $course['photo_link'] === '' ? asset('assets/img/default_course.png') : $course['photo_link'] }}" alt="">
        @endif
      </section>
      <section class="tw-w-2/3 tw-flex tw-self-center">
        <div class="tw-text-obsidian">
          <h1 class="tw-text-2  xl lg:tw-text-4xl tw-font-bold tw-mb-5 lg:tw-mb-10">
            {{ $course->course_name}}
          </h1>
          <div class="tw-text-sm lg:tw-text-md tw-break-all tw-whitespace-normal ">
            {!! $course->course_description !!}
          </div>
          @if(auth('web')->user())
            @if(auth('web')->user()->load('userEnrollDetails')->userEnrollDetails->contains('course_id', $course->id))
            <span class="tw-font-semibold tw-block">You already enrolled to this course!</span>
            @php
            $index = auth('web')->user()->userEnrollDetails->search(function ($item) use ($course) {
                return $item->course_id === $course->id;
            });

            @endphp
            <span class="tw-block">Enrolled at : {{ auth('web')->user()->userEnrollDetails[$index]->created_at }}</span>
            @else
            <form action="{{ route('user.enroll', $course->id) }}" method="POST">
              @csrf
              <button class="tw-no-underline tw-px-4 tw-py-1.5 tw-bg-mpsb-secondary tw-rounded-md hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out">Enroll Course</button>
            </form>
            @endif
          @else
          <a class="tw-no-underline tw-px-4 tw-py-2 tw-bg-mpsb-secondary tw-rounded-md hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-text-obsidian" href="{{ route('guest.login') }}">Enroll Course</a>
          @endif
        </div>
      </section>
      <section class="tw-w-2/4 tw-self-center lg:tw-ml-2 tw-hidden lg:tw-flex">
        @if($course->video_link)
        <iframe src="{{ $course->video_link }}" frameborder="0" width="480px" height="270px"></iframe>
        @else
        <img src="{{ $course['photo_link'] === '' ? asset('assets/img/default_course.png') : $course['photo_link'] }}" alt="">
        @endif
      </section>
    </section>
    @if($course->userEnrollDetails)
    <div class="tw-mb-1 tw-text-base tw-font-medium dark:text-white tw-flex tw-justify-between tw-mx-2">
      <span>Your Progress</span>
      <span>{{ $course->userEnrollDetails->progress }} %</span>
    </div>
    <div class="tw-w-full tw-bg-gray-200 tw-rounded-full tw-h-2.5 tw-mb-4 dark:bg-gray-700">
      <div class="tw-bg-blue-600 tw-h-2.5 tw-rounded-full dark:bg-blue-500" style="width: {{$course->userEnrollDetails->progress}}%"></div>
    </div>
    @endif
    <x-alert />
    @if($course->subcourses->isEmpty())
    <section class="tw-mt-5 alert alert-warning" role="alert">
      <h5 class="lg:tw-text-xl tw-font-semibold tw-text-md">
        Materi mata pelajaran masih kosong
      </h5>
    </section>
    @else
    <section class="tw-mt-5 tw-mb-16">
      {{-- RENDER SUBCOURSES IN HERE --}}
      @foreach($course->subcourses as $subCourse)
      <section
        class="tw-mt-5 tw-border tw-border-mpsb-primary tw-bg-mpsb-secondary
        tw-rounded-lg tw-p-5 tw-group hover:tw-bg-mpsb-primary hover:tw-border-mpsb-secondary
        tw-duration-200 tw-ease-in-out tw-flex tw-justify-between
        tw-cursor-pointer"
        onclick="location.href='{{ route('guest.show-materi',[$course->id, $subCourse->id]) }}';"
      >
        <div class="tw-flex tw-items-center">
          <iconify-icon
            icon="ic:round-subject"
            width="38" height="38"
            class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">
          </iconify-icon>
          <span class="tw-flex tw-text-obsidian tw-text-lg lg:tw-text-xl tw-mx-3
          group-hover:tw-text-white tw-duration-200 tw-ease-in-out tw-items-center">
            {{ $subCourse->subcourse_name }}
          </span>
        </div>
        @if($subCourse->evaluation)
        <div class="tw-flex tw-items-center tw-text-mpsb-primary ">
          <a href="{{ route('user.show-exam', $subCourse->evaluation->id) }}">
            <iconify-icon
            icon='healthicons:i-exam-multiple-choice'
            class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary"
            width="38"
            height="38"
            >
            </iconify-icon>
          </a>
        </div>
        @endif
      </section>
      @endforeach
    </section>
    @endif
  </section>

</x-guest-layout>
