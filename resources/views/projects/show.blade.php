
@extends('layouts.app')

@section('title', $project['title'] . ' | Portfolio')

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | PROJECT SCREENSHOT GALLERY
    |--------------------------------------------------------------------------
    | Use gallery images from config/portfolio.php.
    |
    | If no gallery is configured, try the main image.
    | Missing images are excluded automatically.
    */

    $gallery = $project['gallery'] ?? [];

    if (empty($gallery) && !empty($project['image'])) {

        $gallery = [
            [
                'image' => $project['image'],
                'caption' => 'Project Preview',
            ],
        ];

    }

    $availableGallery = array_values(
        array_filter($gallery, function ($item) {

            return !empty($item['image']) &&
                file_exists(public_path($item['image']));

        })
    );

@endphp

<article class="mx-auto max-w-6xl px-6 py-16 md:py-20">

    {{-- ===================================== --}}
    {{-- BACK BUTTON --}}
    {{-- ===================================== --}}

    <a href="{{ route('home') }}#projects"
       class="inline-flex items-center gap-2
              text-sm font-semibold text-accent
              transition hover:opacity-70">

        <span aria-hidden="true">←</span>

        BACK TO PROJECTS

    </a>


    {{-- ===================================== --}}
    {{-- PROJECT HEADER --}}
    {{-- ===================================== --}}

    <header class="mt-14">

        <p class="font-mono text-sm uppercase
                  tracking-widest text-accent">

            {{ $project['category'] }}

        </p>

        <h1 class="mt-4 max-w-4xl font-display
                   text-4xl font-bold tracking-tight
                   md:text-6xl">

            {{ $project['title'] }}

        </h1>

        <p class="mt-7 max-w-3xl text-lg
                  leading-relaxed text-muted">

            {{ $project['description'] }}

        </p>

    </header>


    {{-- ===================================== --}}
    {{-- SCREENSHOT GALLERY --}}
    {{-- ===================================== --}}

    <section class="mt-16">

        <div class="mb-8">

            <p class="font-mono text-xs
                      tracking-widest text-accent">

                PROJECT SHOWCASE

            </p>

            <h2 class="mt-3 font-display
                       text-3xl font-bold md:text-4xl">

                Project Gallery

            </h2>

            <p class="mt-4 max-w-2xl
                      leading-relaxed text-muted">

                Screenshots highlighting the
                interface and features of this project.

            </p>

        </div>

        @if(count($availableGallery) > 0)

            <div class="grid grid-cols-1 gap-8
                        {{ count($availableGallery) > 1 ? 'md:grid-cols-2' : '' }}">

                @foreach($availableGallery as $index => $screenshot)

                    <figure class="group min-w-0">

                        {{-- CLICKABLE IMAGE --}}

                        <a
                            href="{{ asset($screenshot['image']) }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="block overflow-hidden border
                                   border-line bg-[#E7E2D8]
                                   transition-colors
                                   hover:border-accent"
                            aria-label="Open {{ $screenshot['caption'] ?? 'project screenshot' }} in full size"
                        >

                            <div class="flex aspect-video
                                        items-center justify-center
                                        overflow-hidden bg-white">

                                <img
                                    src="{{ asset($screenshot['image']) }}"
                                    alt="{{ $screenshot['caption'] ?? $project['title'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-contain
                                           transition-transform
                                           duration-500
                                           group-hover:scale-[1.03]"
                                >

                            </div>

                        </a>

                        {{-- IMAGE CAPTION --}}

                        <figcaption class="mt-4 flex
                                           items-center
                                           justify-between gap-4">

                            <div>

                                <p class="font-mono
                                          text-xs text-accent">

                                    {{ sprintf('%02d', $index + 1) }}

                                </p>

                                <h3 class="mt-1 font-display
                                           text-base font-semibold">

                                    {{ $screenshot['caption'] ?? 'Project Screenshot' }}

                                </h3>

                            </div>

                            <a
                                href="{{ asset($screenshot['image']) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-sm font-semibold
                                       text-accent
                                       hover:opacity-70"
                                aria-label="View {{ $screenshot['caption'] ?? 'project screenshot' }} full size"
                            >

                                VIEW ↗

                            </a>

                        </figcaption>

                    </figure>

                @endforeach

            </div>

        @else

            {{-- PLACEHOLDER FOR PROJECTS WITHOUT IMAGES --}}

            <div class="flex min-h-72 flex-col
                        items-center justify-center
                        border border-line bg-[#E7E2D8]
                        px-6 text-center">

                <p class="font-display text-2xl
                          font-bold text-muted/50">

                    Project Preview

                </p>

                <p class="mt-3 text-sm text-muted">

                    Screenshots will be added soon.

                </p>

            </div>

        @endif

    </section>


    {{-- ===================================== --}}
    {{-- TECHNOLOGIES --}}
    {{-- ===================================== --}}

    <section class="mt-16 border-t border-line pt-10">

        <p class="font-mono text-xs
                  tracking-widest text-accent">

            TECHNOLOGIES

        </p>

        <h2 class="mt-3 font-display text-2xl
                   font-bold md:text-3xl">

            Technologies & Areas

        </h2>

        <div class="mt-7 flex flex-wrap gap-3">

            @foreach($project['technologies'] as $technology)

                <span class="border border-line
                             px-4 py-2 text-sm
                             transition-colors
                             hover:border-accent
                             hover:text-accent">

                    {{ $technology }}

                </span>

            @endforeach

        </div>

    </section>


    {{-- ===================================== --}}
    {{-- BOTTOM NAVIGATION --}}
    {{-- ===================================== --}}

    <div class="mt-16 border-t border-line pt-8">

        <a href="{{ route('home') }}#projects"
           class="inline-flex items-center gap-2
                  border-b-2 border-accent
                  pb-2 font-semibold
                  transition hover:text-accent">

            ← ALL PROJECTS

        </a>

    </div>

</article>

@endsection
