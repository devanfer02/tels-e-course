<div class="tw-hidden lg:tw-flex flex-column flex-shrink-0 p-3 tw-bg-mpsb-primary tw-w-[15em] tw-h-screen tw-border-r-2 tw-border-r-obsidian">
  <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none tw-group">
    <iconify-icon
    icon="simple-icons:knowledgebase"
    class="group-hover:tw-text-mpsb-secondary"
    width="32" height="32"></iconify-icon>
    <span class="tw-font-semibold group-hover:tw-text-mpsb-secondary tw-text-3xl tw-mx-2">TELS</span>
  </a>
  <div class="tw-h-[1.5px] tw-my-2 tw-bg-white tw-mb-4"></div>
  <ul class="nav nav-pills flex-column mb-auto">
    @foreach(config('constants.navs') as $nav)
    <li class="nav-item tw-my-1 tw-group">
      <a href="{{ route($nav['route_name']) }}" class="tw-flex tw-no-underline tw-text-white" aria-current="page">
        <iconify-icon
          icon="{{ $nav['iconify'] }}"
          class="group-hover:tw-text-mpsb-secondary
          {{ Route::is($nav['route_name']) ? 'tw-text-mpsb-secondary' : 'tw-text-white' }}"
          width="26" height="26"></iconify-icon>
        <p
          class="tw-style-none tw-no-underline tw-mx-2
          {{ Route::is($nav['route_name']) ? 'tw-text-mpsb-secondary' : 'tw-text-white' }}
          group-hover:tw-text-mpsb-secondary">
          {{ $nav['name'] }}
        </p>
      </a>
    </li>
    <div class="tw-h-[1px] tw-bg-white tw-mb-5"></div>
    @endforeach
  </ul>
  <div class="tw-h-[1.5px] tw-my-2 tw-bg-white"></div>
  <div class="tw-flex tw-group tw-text-white tw-my-2.5">
    <iconify-icon
      icon="dashicons:admin-users"
      width="26" height="26"
      class="group-hover:tw-text-mpsb-secondary"
      >
    </iconify-icon>
    <span class="tw-mx-1 group-hover:tw-text-mpsb-secondary tw-font-semibold" >
      {{ auth()->guard('web')->user()->fullname }}
    </span>
  </div>
  <form class="tw-flex tw-group tw-text-white tw-my-2.5" method="POST" action="{{ route('logout') }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="tw-flex tw-group">
      <iconify-icon
        icon="material-symbols:logout"
        width="26" height="26"
        class="group-hover:tw-text-mpsb-secondary"
        >
      </iconify-icon>
      <span class="tw-mx-1 group-hover:tw-text-mpsb-secondary tw-font-semibold" >Logout</span>
    </button>
  </form>
</div>
