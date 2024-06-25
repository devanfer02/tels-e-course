<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/css/app.scss', 'resources/js/app.js'])
    @livewireStyles
    <title>MPSB Dashboard</title>
</head>
<body class="tw-h-screen">
  <section class="tw-min-h-screen tw-flex tw-justify-center tw-self-center tw-items-center tw-bg-mpsb-primary">

    <div>
      <h1 class="tw-px-5 tw-font-semibold tw-text-4xl tw-text-mpsb-secondary tw-block tw-text-center">
        ADMIN DASHBOARD IS ON MAINTANCE
      </h1>
      <h1 class="tw-font-semibold tw-text-4xl tw-text-mpsb-secondary tw-block tw-text-center">
        YOU CAN COME BACK LATER, THANK YOU
      </h1>
      <p class="tw-text-white tw-text-center">❤️ by Divisi IT Backend</p>
    </div>

  </section>
</body>
</html>
