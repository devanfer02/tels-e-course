<nav class="navbar navbar-expand-lg tw-bg-gray-100 px-3 px-lg-4 py-4 tw-border-b tw-border-b-mpsb-primary ">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('assets/icons/TELS.png') }}" alt="" width="80px" >
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <iconify-icon icon="charm:menu-hamburger" class="tw-text-mpsb-primary tw-text-lg" width="30" height="30"></iconify-icon>
    </button>
    <div class="collapse navbar-collapse tw-mt-5 lg:tw-mt-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
        <li class="nav-item tw-mb-2 lg:tw-mb-0">
          <a
            class="tw-no-underline tw-text-xl lg:tw-text-lg lg:tw-px-2
            {{ request()->routeIs('home') ? "tw-text-obsidian" : "tw-text-gray-500" }}"
            href="{{ route('home') }}">
            Home
          </a>
        </li>
        <div class="tw-h-[1px] tw-bg-mpsb-primary lg:tw-hidden tw-mb-4"></div>
        @if(auth('web')->user())
        <li class="nav-item tw-mb-2 lg:tw-mb-0">
          <a
            class="tw-no-underline tw-text-xl lg:tw-text-lg lg:tw-px-2
            {{ request()->routeIs('user.courses') ? "tw-text-obsidian" : "tw-text-gray-500" }}"
            href="{{ route('user.courses') }}">
            My Courses
          </a>
        </li>
        <div class="tw-h-[1px] tw-bg-mpsb-primary lg:tw-hidden tw-mb-4"></div>
        <li class="nav-item tw-mb-2 lg:tw-mb-0 lg:tw-hidden">
          <form action="{{ route('user.web-logout') }}" method="POST">
            @csrf
            @method("DELETE")
            <button class="tw-no-underline tw-text-xl lg:tw-text-lg lg:tw-px-2
            {{ request()->routeIs('guest.login') ? "tw-text-obsidian" : "tw-text-gray-500" }}">Logout</button>
          </form>
        </li>
        <div class="tw-h-[1px] tw-bg-mpsb-primary lg:tw-hidden tw-mb-4"></div>
        <li class="nav-item tw-mb-2 lg:tw-mb-0 lg:tw-hidden">
          <a href="{{ route('user.profile') }}">
            <button class="tw-no-underline tw-text-xl lg:tw-text-lg lg:tw-px-2
            {{ request()->routeIs('guest.login') ? "tw-text-obsidian" : "tw-text-gray-500" }}">Profile</button>
          </a>
        </li>
        <div class="tw-h-[1px] tw-bg-mpsb-primary lg:tw-hidden tw-mb-4"></div>
        @else
        <li class="nav-item tw-mb-2 lg:tw-mb-0 lg:tw-hidden">
          <a
            class="tw-no-underline tw-text-xl lg:tw-text-lg lg:tw-px-2
            {{ request()->routeIs('guest.register') ? "tw-text-obsidian" : "tw-text-gray-500" }}"
            href="{{ route('guest.register') }}">
            Register
          </a>
        </li>
        <div class="tw-h-[1px] tw-bg-mpsb-primary lg:tw-hidden tw-mb-4"></div>
        <li class="nav-item tw-mb-2 lg:tw-mb-0 lg:tw-hidden">
          <a
            class="tw-no-underline tw-text-xl lg:tw-text-lg lg:tw-px-2
            {{ request()->routeIs('guest.login') ? "tw-text-obsidian" : "tw-text-gray-500" }}"
            href="{{ route('guest.login') }}">
            Login
          </a>
        </li>
        <div class="tw-h-[1px] tw-bg-mpsb-primary lg:tw-hidden tw-mb-4"></div>
        @endif
      </ul>
    </div>
    <div class="lg:tw-flex tw-justify-end tw-hidden tw-items-center">
      @if(auth('web')->user())
      <div class="tw-flex tw-items-center tw-mx-2 tw-cursor-pointer tw-group" onclick="location.href='{{ route('user.profile') }}'">
        <div class="tw-mr-2 tw-text-mpsb-primary group-hover:tw-text-mpsb-secondary">
          <span class="tw-block">{{ auth('web')->user()->fullname }} </span>
          @if(auth('web')->user()->load('role')->role->role_name === "User")
          <span class="tw-block">Student</span>
          @else
          <span class="tw-block tw-text-sm tw-text-end">Admin</span>
          @endif
        </div>
        <iconify-icon icon="iconamoon:profile-circle-fill" class="group-hover:tw-text-mpsb-secondary tw-text-mpsb-primary tw-duration-200 tw-ease-in-out" width="40" height="40"></iconify-icon>
      </div>
      <form action="{{ route('user.web-logout') }}" method="POST">
        @csrf
        @method("DELETE")
        <button class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-mr-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-primary tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">Logout</button>
      </form>
      @else
      <a href="{{ route('guest.register') }}" class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-mr-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-primary tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">Register</a>
      <a href="{{ route('guest.login') }}" class="tw-border tw-border-mpsb-secondary tw-rounded-lg tw-mr-2 tw-px-3 tw-py-1.5 tw-no-underline tw-text-mpsb-primary tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-200 tw-ease-in-out">Login</a>
      @endif
    </div>
  </div>
  <div class="tw-h-1 tw-bg-mpsb-primary"></div>
</nav>
