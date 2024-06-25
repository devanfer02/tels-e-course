<section class="tw-grid tw-grid-cols-4 tw-gap-2">
  @foreach(range(1,$jumlahSoal) as $i)
  <a
    class="tw-border tw-rounded-lg tw-py-2.5 tw-border-mpsb-primary tw-font-semibold
    tw-text-center tw-no-underline
    @if($active === $i)
    tw-text-mpsb-secondary tw-bg-mpsb-primary
      @else
    tw-text-mpsb-primary
    tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-border-mpsb-secondary
    hover:tw-text-mpsb-secondary
    @endif
    "
    wire:click.debounce="changeActive({{ $i }})"
    href="#{{ $i }}"
    >
    {{ $i }}
  </a>
  @endforeach
</section>
