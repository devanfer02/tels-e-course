<x-guest-layout pageTitle="Register TELS">
  <section class="tw-p-10 lg:tw-p-20 tw-flex tw-justify-center ">
    <div class="tw-w-full tw-py-10">
      <h1 class="tw-font-bold tw-text-4xl tw-text-center">Register</h1>
      <form action="{{ route('guest.web-register') }}" class="lg:tw-px-52" method="POST">
        @csrf
          <x-input
          name="Fullname"
          placeHolder="Your Fullname"
          id="fullname"
          type="text"
          required
          value="{{ old('fullname') }}"
        />
        <x-input
          name="Email"
          placeHolder="Your Email"
          id="email"
          type="text"
          required
          value="{{ old('email') }}"
        />
        <x-input
          name="Password"
          placeHolder="Your Account Password"
          id="password"
          type="password"
          required
          value="{{ old('password') }}"
        />
        <x-input
          name="Confirm Password"
          placeHolder="Confirm Your Password"
          id="confirm_password"
          type="password"
          required
          value="{{ old('confirm_password') }}"
        />
        <button type="submit" class="tw-bg-mpsb-primary tw-w-full tw-rounded-md tw-text-white tw-text-xl tw-py-2 tw-border tw-border-mpsb-primary hover:tw-bg-white hover:tw-text-mpsb-primary tw-duration-300 tw-ease-in-out tw-mb-2">
          Register
        </button>
        <p>Already have an account? <a href="{{ route('guest.login') }}" class="tw-text-obsidian">Login</a></p>
      </form>
    </div>
  </section>
</x-guest-layout>
