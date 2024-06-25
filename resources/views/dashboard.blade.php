@extends('layout/layout')

@section('content')
  <section class="" id="dashboard">
    <section class="tw-bg-mpsb-primary tw-min-h-52 tw-mb-5 tw-flex tw-items-center tw-self-center tw-justify-center
    tw-rounded-md">
      <h1 class="tw-text-mpsb-secondary tw-font-semibold tw-text-center tw-p-4">
        Welcome to TELS Dashboard
      </h1>
    </section>
    <section class="tw-grid tw-grid-cols-2 lg:tw-grid-cols-6 tw-gap-5 tw-mb-5">
      @foreach($details as $detail)
      <section class="tw-border tw-border-mpsb-primary tw-bg-mpsb-secondary
      tw-p-5 tw-rounded-md tw-group hover:tw-bg-mpsb-primary hover:tw-border-mpsb-secondary
      @if(isset($detail['href'])) tw-cursor-pointer @endif
      "
      @if(isset($detail['href']))
      onclick="location.href='{{ $detail['href'] }}'"
      @endif
      >
        <section class="tw-flex tw-justify-center tw-duration-300 tw-ease-in-out">
          <iconify-icon
            icon="{{ $detail['iconify'] }}"
            width="60"
            heigth="60"
            class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out"
          >
        </section>
        </iconify-icon>
        <div class="tw-mx-2 group-hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out">
          <span class="tw-mt-1 tw-block tw-text-lg tw-font-semibold tw-text-obsidian group-hover:tw-text-mpsb-secondary tw-text-center">{{ $detail['count'] }} @if($detail['datatype'] ==='double') % @endif</span>
          <span class="tw-block tw-text-center">{{ $detail['detail'] }}</span>
          <div class="tw-flex">
          </div>
        </div>
      </section>
      @endforeach
    </section>
    <section
      class="tw-bg-mpsb-secondary tw-mb-5 tw-rounded-md tw-container tw-py-5 tw-border tw-border-mpsb-primary tw-flex tw-items-center tw-self-center
      tw-group hover:tw-bg-mpsb-primary hover:tw-border-mpsb-secondary tw-duration-200 tw-ease-in-out tw-cursor-pointer"
      onclick="location.href='{{ route('record') }}'"
      >
      <iconify-icon icon="icon-park-solid:log" width="34" height="34" class="tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary"></iconify-icon>
      <span class="tw-text-mpsb-obsidian tw-mx-2 tw-text-xl tw-font-semibold group-hover:tw-text-mpsb-secondary">Admin Logs</span>
    </section>
    <section class="tw-px-5 tw-border tw-border-mpsb-primary tw-rounded-md tw-py-4 tw-mb-5 tw-bg-mpsb-secondary">
      <h1 class="tw-text-center tw-text-3xl tw-font-semibold tw-text-mpsb-primary">
        About Us
      </h1>
      <p class="tw-text-md tw-text-mpsb-obsidian">
        MPSB E-Learning Platform is a project made for Manajemen Pengetahuan dan Sumber Belajar class.
        It's a E-Learning plaftorm that provides subject content in vocational high schools.
        Our E-Learning platform consist of 2 application, client side and server side.
        What you see right now is the server side one, made by the backend developers of IT Division Team.
      </p>
    </section>
    <section class="">
      <section class="tw-text-center tw-text-xl">
        Made with ❤️ by Divisi IT Backend
      </section>
      <section class="tw-text-center tw-text-lg">
        Contact Person : (Rivaldo) +62 895-1826-1422
      </section>
    </section>
  </section>
@endsection
