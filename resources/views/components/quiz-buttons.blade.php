<section class="tw-grid tw-grid-cols-4 tw-gap-2">
  @foreach($questions as $question)
  <a
    class="tw-border tw-rounded-lg tw-py-2.5 tw-px-5 tw-border-mpsb-primary tw-font-semibold
    tw-text-center tw-no-underline
    @if($loop->iteration === $index)
    tw-text-mpsb-secondary
    tw-bg-mpsb-primary hover:tw-bg-mpsb-secondary hover:tw-border-mpsb-primary
    hover:tw-text-mpsb-primary
    @else
    tw-text-mpsb-primary
    tw-bg-mpsb-secondary hover:tw-bg-mpsb-primary hover:tw-border-mpsb-secondary
    hover:tw-text-mpsb-secondary
    @endif
    "
    href="{{ route('user.show-question', [$evaluation->id, $loop->iteration])}}"
    >
    {{ $loop->iteration }}
  </a>
  @endforeach
</section>
