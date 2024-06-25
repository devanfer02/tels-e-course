<nav class="navbar tw-bg-mpsb-primary tw-text-mpsb-secondary px-4 py-4 tw-mb-5">
  <section class="tw-flex">
    <iconify-icon
    icon="{{ config('constants.headers')[Route::current()->getName()]['iconify'] }}"
    class="group-hover:tw-text-mpsb-secondary"
    width="34" height="34"></iconify-icon>
    <h1 class="tw-text-2xl tw-mx-2 tw-font-semibold">
      {{ config('constants.headers')[Route::current()->getName()]['name'] }}
    </h1>
  </section>
  <section class="tw-flex lg:tw-hidden">
    <button class="navbar-toggler tw-border tw-border-mpsb-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <iconify-icon icon="charm:menu-hamburger" class="tw-text-mpsb-secondary"></iconify-icon>
    </button>
  </section>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-2">
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
  </div>
</nav>

