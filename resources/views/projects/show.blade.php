
@extends('layouts.app')

@section('title', $project['title'] . ' | Portfolio')

@section('content')

<article class="mx-auto max-w-5xl px-6 py-20">

    <a href="{{ route('home') }}#projects"
       class="text-sm font-semibold text-accent">
        ← BACK TO PROJECTS
    </a>

    <p class="mt-14 font-mono text-sm
              uppercase tracking-widest text-accent">
        {{ $project['category'] }}
    </p>

    <h1 class="mt-4 font-display
               text-4xl font-bold md:text-6xl">
        {{ $project['title'] }}
    </h1>

    <p class="mt-7 max-w-3xl
              text-lg leading-relaxed text-muted">
        {{ $project['description'] }}
    </p>

    <div class="mt-12 flex min-h-72
                items-center justify-center
                overflow-hidden bg-[#E7E2D8]">

        @if(file_exists(public_path($project['image'])))

            <img src="{{ asset($project['image']) }}"
                 alt="{{ $project['title'] }}"
                 class="w-full object-cover">

        @else

            <span class="text-muted">
                Project preview coming soon
            </span>

        @endif
    </div>

    <div class="mt-12 border-t border-line pt-8">

        <h2 class="font-display text-2xl font-bold">
            Technologies & Areas
        </h2>

        <div class="mt-6 flex flex-wrap gap-3">

            @foreach($project['technologies'] as $technology)

                <span class="border border-line px-4 py-2">
                    {{ $technology }}
                </span>

            @endforeach
        </div>
    </div>

</article>

@endsection
