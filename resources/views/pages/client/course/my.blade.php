<x-guest-layout pageTitle="My Courses">
  <section id="hero" class="lg:tw-flex lg:tw-mx-10 tw-pt-5 tw-mb-5 tw-mx-2">
    <section class="lg:tw-w-1/2 tw-rounded-t-md lg:tw-rounded-t-none lg:tw-rounded-l-md tw-bg-mpsb-primary tw-text-white tw-flex tw-justify-center tw-items-center">
      <section class="lg:tw-p-16 tw-p-10">
        <h1 class="tw-text-2xl tw-font-bold">
          Your Enrolled Courses
        </h1>
        <p>
          Welcome to your personalized learning dashboard! Here you can find all the courses you've enrolled in. Continue where you left off, explore new lessons, and track your progress. Each course is designed to help you master new skills and knowledge at your own pace.
        </p>
        <section class="tw-flex">
          <a href="#courses" class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-mr-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-primary tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">Learn Enrolled Courses</a>
        </section>
      </section>
    </section>
    <section class="lg:tw-w-1/2 tw-rounded-b-md lg:tw-rounded-b-none lg:tw-rounded-r-md">
      <img src="{{ asset('assets/img/hero4.jpg') }}" alt="" class="tw-rounded-b-md lg:tw-rounded-b-none lg:tw-rounded-r-md">
    </section>
  </section>
  <section id="courses" class="lg:tw-px-6  tw-min-h-screen">
    <livewire:course-list route="guest.show-mapel" userId="{{ auth('web')->user()->id }}"/>
  </section>
</x-guest-layout>
