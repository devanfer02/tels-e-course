<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('assets/icons/icon.png') }}">
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <title><?= $pageTitle?></title>
</head>
<body class="tw-h-screen tw-flex tw-items-center tw-justify-center tw-bg-mpsb-primary">
    <section class="tw-bg-mpsb-secondary tw-py-8 lg:tw-py-16 tw-px-12 tw-rounded-lg lg:tw-flex">
      <section class="tw-flex tw-self-center tw-items-center tw-justify-center tw-mx-5 tw-mb-4 lg:tw-mb-0">
        <section>
          <img src="{{ asset('assets/icons/icon.png') }}" alt="" class="tw-max-w-[200px] tw-bg-white tw-border tw-border-mpsb-primary tw-rounded-2xl">
          <span class="tw-text-xl tw-font-semibold tw-text-center ">TELS Admin Dashboard</span>
        </section>
      </section>
      <section class="tw-flex tw-self-center tw-items-center tw-mx-5">
        <section>
          <div class="">
            <h1 class="tw-text-xl tw-font-semibold">Login</h1>
          </div>
          <div class="tw-h-[1px] tw-bg-mpsb-primary tw-mb-4"></div>
          <form action="{{ route('login') }}" class="" method="POST">
            @csrf
            <x-input
              name="Email"
              placeHolder="Masukkan email"
              id="email"
              required
            />
            <x-input
              name="Password"
              placeHolder="Masukkan password"
              id="password"
              type="password"
              required
            />
            @if(session('failed'))
            <div class="alert alert-danger">
              <span>{{ session('failed') }}</span>
            </div>
            @endif
            <div class="tw-w-full">
              <button class="btn btn-success tw-w-full">Login</button>
            </div>
          </form>
        </section>
      </section>
    </section>

</body>
</html>
