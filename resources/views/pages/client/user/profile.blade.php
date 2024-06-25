<x-guest-layout pageTitle="My Profile">
  <section class="card tw-p-5 lg:tw-p-10 tw-mb-5 tw-mx-5 lg:tw-mx-20 tw-mt-10 tw-flex tw-justify-center">
    <section class="tw-px-10">
      <h1 class="tw-text-3xl tw-font-semibold">Hello {{ auth('web')->user()->fullname }}</h1>
      <div class="tw-h-[1px] tw-bg-mpsb-primary tw-mb-4"></div>
      <div>
        <h3 class="tw-text-2xl">Your Stats</h3>
        <div class="tw-grid tw-grid-cols-3">
          <div>
            <span class="tw-block tw-text-3xl">
              {{ count(auth('web')->user()->load('userEnrollDetails')->userEnrollDetails) }}
            </span>
            Enrolled Courses
          </div>
          <div>
            <span class="tw-block tw-text-3xl">
              {{ auth('web')->user()->userEnrollDetails()
                ->where('progress', '=', '100')
                ->count()}}
            </span>
            Finished Courses
          </div>
          <div>
            <span class="tw-block tw-text-3xl">
              {{-- {{ auth('web')->user()->load('userSubcourseDetails')->userSubcourseDetails()
              ->avg('evaluation_grade', '=', '100') }} % --}}
              0 %
            </span>
            Average Score
          </div>
        </div>
      </div>
    </section>
  </section>
  <section class="card tw-p-5 lg:tw-p-10 tw-mb-20 tw-mx-5 lg:tw-mx-20 lg:tw-mb-10 tw-mt-5 tw-flex tw-justify-center">
    <section class="tw-px-10">
      <section class="tw-mb-4">
        <h1 class="tw-text-3xl tw-font-semibold">Update Profile</h1>
        <div class="tw-h-[1px] tw-bg-mpsb-primary"></div>
      </section>
      <x-alert />
      <form action="{{ route('user.profile.update', auth('web')->user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-input
          name="Fullname"
          placeHolder=""
          id="fullname"
          type="text"
          required
          value="{{ auth('web')->user()->fullname }}"
        />
        <x-input
          name="Email"
          placeHolder=""
          id="email"
          type="text"
          required
          value="{{ auth('web')->user()->email }}"
        />
        <x-input
          name="Password"
          placeHolder=""
          id="password"
          type="password"
          value=""
        />
        <x-input
          name="Profile Picture"
          placeHolder=""
          id="profile_pic"
          type="file"
          value="{{ auth('web')->user()->fullname }}"
        />
        <button class="tw-bg-green-500 tw-text-white tw-px-4 tw-py-2 tw-rounded-md tw-border tw-border-green-500 hover:tw-bg-white hover:tw-text-green-500 tw-duration-200 tw-ease-in-out">
          Update Profile
        </button>
      </form>
    </section>
  </section>
</x-guest-layout>
