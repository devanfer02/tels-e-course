<x-guest-layout pageTitle="Quiz Result">
  <section class="tw-h-screen ">
    <section class="tw-mt-52 tw-flex tw-items-center tw-justify-center">
      <section class="tw-w-full">
        <h1 class="tw-text-3xl tw-text-mpsb-primary tw-text-center">
          Yeay, you succeeded the test!
        </h1>
      </section>
    </section>
    <section class="tw-flex tw-justify-center">
      <a href="{{ route('guest.show-materi', [$subcourse->course->id, $subcourse->id]) }}" class="tw-w-full tw-text-center tw-no-underline  tw-px-4 tw-py-2 tw-text-blue-500  tw-rounded-md hover:tw-bg-white hover:tw-text-blue-500 tw-duration-300 tw-ease-in-out">
        Go back to subcourse
      </a>
    </section>
  </section>
</x-guest-layout>
