<section class="tw-mb-5 tw-text-mpsb-secondary tw-bg-mpsb-primary tw-px-10 lg:tw-px-14 tw-py-10">
  <section class="tw-flex tw-justify-center lg:tw-justify-start">
    <span class="tw-font-semibold lg:tw-text-lg tw-mr-2">{{ $evaluation->subcourse->subcourse_name }}'s quiz </span>
  </section>
</section>
<section class="tw-mx-2 lg:tw-mx-10 tw-h-full">
  <section class="lg:tw-flex">
    <section class="lg:tw-w-1/5 tw-mx-5">
      <section class="tw-bg-gray-100 tw-p-5 tw-rounded-lg tw-mb-3 tw-border-obsidian tw-border ">
        <p class="tw-font-semibold tw-text-xl">Question's Detail</p>
        <div class="tw-h-[1px] tw-bg-mpsb-primary tw-mb-2"></div>
        <p class="tw-text-lg">Subcourse : {{ $evaluation->subcourse->subcourse_name }}</p>
        <p class="tw-text-lg">Minimum Pass : {{ $evaluation->minimum_competency }}%  </p>
      </section>
      <section class="tw-bg-gray-100 tw-p-5 tw-rounded-lg tw-mb-3 tw-border-obsidian tw-border">
        <p class="tw-font-semibold tw-text-xl">Question's List</p>
        <div class="tw-h-[1px] tw-bg-mpsb-primary tw-mb-3"></div>
        <x-quiz-buttons :questions="$evaluation->questions" :evaluation="$evaluation" :index="$index"/>
        <form action="{{ route('submit.quiz', $evaluation->subcourse->id)}}" class="tw-w-full tw-mt-4" method="POST">
          @csrf
          <button class="tw-bg-mpsb-primary tw-w-full tw-text-mpsb-secondary tw-rounded-lg tw-py-2 hover:tw-bg-mpsb-secondary hover:tw-text-mpsb-primary tw-border tw-border-mpsb-primary tw-duration-300 tw-ease-in-out">Submit</button>
        </form>
      </section>
    </section>
    <section class="tw-mx-5 lg:tw-w-4/5 tw-mb-10 lg:tw-mb-0">
      @if($evaluation->questions[$index-1]->questionCategory->category_name === "Pilihan Ganda")
      <x-pilihan-ganda-view :pilganda="$evaluation->questions[$index-1]" :id="$index" :show="false"/>
      @else
      <x-drag-and-drop-view :dragndrop="$evaluation->questions[$index-1]" :id="$index" :show="false"/>
      @endif
      <section class="tw-flex tw-mt-4 @if($index !== 1 && $index !== count($evaluation->questions)) tw-justify-between @elseif($index === 1) tw-justify-end @else tw-justify-start @endif">
        @if($index !== 1 )
        <a class="tw-flex tw-items-center tw-justify-center tw-w-1/8 tw-mx-1  tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary tw-no-underline tw-text-center" href="{{ route('user.show-question', [$evaluation->id, $index-1])}}">
          <iconify-icon icon="fluent:previous-frame-24-filled" width="24px" height="24px"></iconify-icon>
        </a>
        @endif
        @if($index !== count($evaluation->questions))
        <a class="tw-flex tw-items-center tw-justify-center tw-w-1/8 tw-mx-1  tw-bg-mpsb-secondary tw-text-mpsb-primary tw-rounded-lg tw-px-4 tw-py-3 hover:tw-bg-mpsb-primary hover:tw-text-mpsb-secondary tw-duration-300 tw-ease-in-out tw-border tw-border-mpsb-primary tw-no-underline tw-text-center" href="{{ route('user.show-question', [$evaluation->id, $index+1])}}">
          <iconify-icon icon="fluent:next-frame-24-filled" width="24px" height="24px"></iconify-icon>
        </a>
        @endif
      </section>
    </section>
  </section>
</section>
