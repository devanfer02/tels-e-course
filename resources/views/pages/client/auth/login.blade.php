<x-guest-layout pageTitle="Login TELS">
  <section class="tw-p-10 lg:tw-p-20 tw-flex tw-justify-center">
    <div class="tw-w-full tw-py-10">
      <h1 class="tw-font-bold tw-text-4xl tw-text-center">Login</h1>
      <form action="{{ route('guest.web-login') }}" class="lg:tw-px-52" method="POST">
        @csrf
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
        <button type="submit" class="tw-bg-mpsb-primary tw-w-full tw-rounded-md tw-text-white tw-text-xl tw-py-2 tw-border tw-border-mpsb-primary hover:tw-bg-white hover:tw-text-mpsb-primary tw-duration-300 tw-ease-in-out tw-mb-2">
          Login
        </button>
        <p>Don't have an account? <a href="{{ route('guest.register') }}" class="tw-text-obsidian">Register</a></p>
        <x-alert />
      </form>
    </div>
  </section>
</x-guest-layout>
