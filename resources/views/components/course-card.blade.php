<div
  class="tw-border tw-border-obsidian tw-rounded-lg tw-max-h-[460px] tw-cursor-pointer tw-bg-mpsb-secondary tw-group hover:tw-bg-mpsb-primary"
  onclick="location.href = '{{ route($route, $course) }}'"
  >
  <div class="tw-max-h-[300px] tw-text-center tw-flex tw-justify-center tw-items-center tw-bg-white tw-rounded-t-lg">
    <img
      class="tw-rounded-t-lg tw-max-h-[250px] tw-min-h-[250px] tw-object-cover"
      src="{{ $course['photo_link'] === '' ? asset('assets/img/default_course.png') : $course['photo_link'] }}"
      alt=""
      >
  </div>
  <div class="tw-p-4 tw-text-obsidian
  tw-rounded-b-lg tw-border-t tw-border-t-obsidian
   group-hover:tw-text-white tw-duration-200 tw-ease-in-out">
    <h1 class="tw-font-bold tw-text-lg">
      {{ $course["course_name"] }}
    </h1>
    <span class="tw-mt-1 tw-block tw-text-sm">
      {{ $course["grade"]["grade_name"] }}
    </span>
    <span class="tw-mt-1 tw-block tw-text-sm">
      {{ $course["major"]["major_name"] }}
    </span>
    <span class="tw-mt-1 tw-block tw-text-sm">
      {{ $course["curriculum"]["curriculum_name"] }}
    </span>
  </div>
</div>
