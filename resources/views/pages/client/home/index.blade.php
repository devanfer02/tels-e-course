<x-guest-layout pageTitle="TELS">
  <section id="hero" class="lg:tw-flex lg:tw-mx-10 tw-mt-5 tw-mb-5 tw-mx-2">
    <section class="lg:tw-w-1/2 tw-rounded-t-md lg:tw-rounded-t-none lg:tw-rounded-l-md tw-bg-mpsb-primary tw-text-white tw-flex tw-justify-center tw-items-center">
      <section class="lg:tw-p-16 tw-p-10 lg:tw-rounded-l-md">
        <h1 class="tw-text-2xl tw-font-bold">
          Welcome to TELS E-Course
        </h1>
        <p>
          Ready to learn something new? Explore our extensive library of online courses designed to help you achieve your goals. From career advancement to personal development, our expert instructors are here to guide you every step of the way. Join our community of learners and start your journey towards success today.
        </p>
        <section class="tw-flex">
          @if(auth('web')->user())
          <a href="#courses" class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-mr-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-primary tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">Learn Available Courses</a>
          @else
          <a href="{{ route('guest.register') }}" class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-mr-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-primary tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">Register</a>
          <a href="{{ route('guest.login') }}" class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-ml-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-secondary tw-bg-mpsb-primary hover:tw-bg-mpsb-secondary hover:tw-text-mpsb-primary tw-duration-200 tw-ease-in-out">Login</a>
          @endif
        </section>
      </section>
    </section>
    <section class="lg:tw-w-1/2 tw-rounded-b-md lg:tw-rounded-b-none lg:tw-rounded-r-md">
      <img src="{{ asset('assets/img/hero3.jpg') }}" alt="" class="lg:tw-rounded-r-md">
    </section>
  </section>
  <section id="courses" class="lg:tw-px-6">
    <livewire:course-list route="guest.show-mapel"/>
  </section>
</x-guest-layout>
