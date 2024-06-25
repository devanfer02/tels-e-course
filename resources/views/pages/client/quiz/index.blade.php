<x-guest-layout pageTitle="{{ 'Quiz ' . $evaluation->subcourse->subcourse_name }}">
<x-quiz-show :evaluation="$evaluation" :questions="$evaluation->questions" :index="$index"/>
</x-guest-layout>
