
@extends('layouts.app')

@section('title', $project['title'] . ' | Portfolio')

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | PROJECT GALLERY SETUP
    |--------------------------------------------------------------------------
    */

    $gallery = $project['gallery'] ?? [];

    if (empty($gallery) && !empty($project['image'])) {
        $gallery = [
            [
                'image' => $project['image'],
                'caption' => $project['title'],
            ],
        ];
    }

    $availableGallery = array_values(
        array_filter($gallery, function ($item) {
            return !empty($item['image'])
                && file_exists(public_path($item['image']));
        })
    );

    $totalSlides = count($availableGallery);

    $features = $project['features'] ?? [];

    $overview = $project['overview']
        ?? $project['description'];

    $liveUrl = $project['live_url'] ?? null;
@endphp


<article class="mx-auto max-w-6xl px-6 py-16 md:py-20">

    {{-- BACK NAVIGATION --}}

    <a href="{{ route('home') }}#projects"
       class="text-sm font-semibold text-accent
              transition hover:opacity-70">

        ← BACK TO PROJECTS
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

        <div class="mt-8 flex flex-wrap
                    items-center gap-5">

            @if(!empty($project['project_type']))

                <span class="border border-line
                             px-4 py-2 font-mono
                             text-xs tracking-wide
                             text-muted">

                    {{ $project['project_type'] }}
                </span>

            @endif

            @if($liveUrl)

                <a href="{{ $liveUrl }}"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="border-b-2 border-accent
                          pb-2 text-sm font-semibold
                          text-accent transition
                          hover:opacity-70">

                    VISIT LIVE WEBSITE ↗
                </a>

            @endif

        </div>

    </header>


    {{-- ===================================== --}}
    {{-- PROJECT GALLERY --}}
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
                Explore the project's interface
                and screenshots.
            </p>

        </div>

        @if($totalSlides > 0)

            <div
                x-data="{
                    active: 0,
                    total: {{ $totalSlides }},
                    timer: null,
                    hovering: false,
                    focused: false,
                    reduced: false,

                    init() {
                        this.reduced = window.matchMedia(
                            '(prefers-reduced-motion: reduce)'
                        ).matches;

                        this.start();
                    },

                    start() {
                        this.stop();

                        if (
                            this.total < 2 ||
                            this.reduced ||
                            this.hovering ||
                            this.focused ||
                            document.hidden
                        ) {
                            return;
                        }

                        this.timer = window.setInterval(() => {
                            this.active =
                                (this.active + 1) % this.total;
                        }, 4500);
                    },

                    stop() {
                        if (this.timer !== null) {
                            window.clearInterval(this.timer);
                            this.timer = null;
                        }
                    },

                    next() {
                        this.active =
                            (this.active + 1) % this.total;
                        this.start();
                    },

                    previous() {
                        this.active =
                            (this.active - 1 + this.total)
                            % this.total;
                        this.start();
                    },

                    goTo(index) {
                        this.active = index;
                        this.start();
                    },

                    destroy() {
                        this.stop();
                    }
                }"

                x-on:pointerenter="
                    if ($event.pointerType === 'mouse') {
                        hovering = true;
                        stop();
                    }
                "

                x-on:pointerleave="
                    if ($event.pointerType === 'mouse') {
                        hovering = false;
                        start();
                    }
                "

                x-on:focusin="
                    focused = true;
                    stop();
                "

                x-on:focusout="
                    if (!$el.contains($event.relatedTarget)) {
                        focused = false;
                        start();
                    }
                "

                x-on:visibilitychange.document="
                    document.hidden ? stop() : start()
                "

                class="w-full min-w-0"

                role="region"
                aria-roledescription="carousel"
                aria-label="{{ $project['title'] }} gallery"
            >

                {{-- MAIN SLIDESHOW --}}

                <div class="relative aspect-[16/10]
                            w-full overflow-hidden
                            border border-line bg-white">

                    @foreach($availableGallery as $index => $screenshot)

                        <div
                            x-show="active === {{ $index }}"

                            x-transition:enter="
                                transition-opacity duration-500
                            "
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"

                            x-transition:leave="
                                transition-opacity duration-500
                            "
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"

                            @if($index !== 0)
                                x-cloak
                            @endif

                            class="absolute inset-0
                                   flex items-center
                                   justify-center bg-white"

                            role="group"
                            aria-roledescription="slide"
                            aria-label="{{ $index + 1 }} of {{ $totalSlides }}"
                        >

                            <a
                                href="{{ asset($screenshot['image']) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="flex h-full w-full
                                       items-center justify-center"
                                aria-label="Open screenshot {{ $index + 1 }} in full size">

                                <img
                                    src="{{ asset($screenshot['image']) }}"
                                    alt="{{ $screenshot['caption'] ?? $project['title'] }}"
                                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                    class="h-full w-full
                                           object-contain">

                            </a>

                        </div>

                    @endforeach

                    {{-- NAVIGATION ARROWS --}}

                    @if($totalSlides > 1)

                        <button
                            type="button"
                            x-on:click="previous()"
                            class="absolute left-3 top-1/2
                                   z-10 flex h-11 w-11
                                   -translate-y-1/2
                                   items-center justify-center
                                   rounded-full border
                                   border-line bg-paper/95
                                   text-xl text-ink
                                   shadow-sm transition
                                   hover:border-accent
                                   hover:text-accent
                                   md:left-5"
                            aria-label="Previous screenshot">

                            &#10094;
                        </button>

                        <button
                            type="button"
                            x-on:click="next()"
                            class="absolute right-3 top-1/2
                                   z-10 flex h-11 w-11
                                   -translate-y-1/2
                                   items-center justify-center
                                   rounded-full border
                                   border-line bg-paper/95
                                   text-xl text-ink
                                   shadow-sm transition
                                   hover:border-accent
                                   hover:text-accent
                                   md:right-5"
                            aria-label="Next screenshot">

                            &#10095;
                        </button>

                    @endif

                </div>


                {{-- SCREENSHOT CAPTION AND DOTS --}}

                <div class="mt-6 flex flex-wrap
                            items-start justify-between
                            gap-5">

                    <div class="min-w-0 flex-1">

                        <p class="font-mono text-xs
                                  tracking-widest text-accent">

                            PROJECT SCREENSHOT

                            <span x-text="
                                String(active + 1).padStart(2, '0')
                            "></span>

                            /

                            {{ sprintf('%02d', $totalSlides) }}
                        </p>

                        @foreach($availableGallery as $index => $screenshot)

                            <div
                                x-show="active === {{ $index }}"

                                @if($index !== 0)
                                    x-cloak
                                @endif

                                class="mt-2">

                                <h3 class="font-display
                                           text-lg font-bold">

                                    {{ $screenshot['caption'] ?? 'Project Screenshot' }}
                                </h3>

                                <a
                                    href="{{ asset($screenshot['image']) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="mt-2 inline-block
                                           text-sm font-semibold
                                           text-accent
                                           hover:opacity-70">

                                    VIEW FULL IMAGE ↗
                                </a>

                            </div>

                        @endforeach

                    </div>

                    @if($totalSlides > 1)

                        <div class="flex flex-wrap
                                    items-center gap-2"
                             role="group"
                             aria-label="Select screenshot">

                            @foreach($availableGallery as $index => $screenshot)

                                <button
                                    type="button"
                                    x-on:click="goTo({{ $index }})"

                                    x-bind:aria-current="
                                        active === {{ $index }}
                                        ? 'true'
                                        : 'false'
                                    "

                                    x-bind:class="
                                        active === {{ $index }}
                                        ? 'bg-accent'
                                        : 'bg-line hover:bg-accent/60'
                                    "

                                    class="h-3 w-3 rounded-full
                                           transition-colors
                                           focus-visible:outline-2
                                           focus-visible:outline-ink"

                                    aria-label="Go to screenshot {{ $index + 1 }}">
                                </button>

                            @endforeach

                        </div>

                    @endif

                </div>

            </div>

        @else

            {{-- PLACEHOLDER FOR MISSING IMAGES --}}

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
    {{-- PROJECT OVERVIEW --}}
    {{-- ===================================== --}}

    <section class="mt-16 border-t border-line pt-12">

        <div class="grid gap-10 md:grid-cols-3">

            <div>

                <p class="font-mono text-xs
                          tracking-widest text-accent">

                    ABOUT THE PROJECT
                </p>

            </div>

            <div class="md:col-span-2">

                <h2 class="font-display text-3xl
                           font-bold md:text-4xl">

                    Project Overview
                </h2>

                <p class="mt-6 whitespace-pre-line
                          text-base leading-8
                          text-muted md:text-lg">{{ trim($overview) }}</p>

            </div>

        </div>

    </section>


    {{-- ===================================== --}}
    {{-- KEY FEATURES --}}
    {{-- ===================================== --}}

    @if(count($features) > 0)

        <section class="mt-16 border-t border-line pt-12">

            <p class="font-mono text-xs
                      tracking-widest text-accent">

                PROJECT CAPABILITIES
            </p>

            <h2 class="mt-3 font-display
                       text-3xl font-bold md:text-4xl">

                Key Features
            </h2>

            <div class="mt-10 grid gap-5 sm:grid-cols-2">

                @foreach($features as $index => $feature)

                    <div class="border border-line
                                p-6 md:p-7">

                        <p class="font-mono text-xs text-accent">

                            {{ sprintf('%02d', $index + 1) }}
                        </p>

                        <h3 class="mt-4 font-display
                                   text-xl font-bold">

                            {{ $feature['title'] }}
                        </h3>

                        <p class="mt-3 leading-relaxed text-muted">

                            {{ $feature['description'] }}
                        </p>

                    </div>

                @endforeach

            </div>

        </section>

    @endif


    {{-- ===================================== --}}
    {{-- TECHNOLOGIES --}}
    {{-- ===================================== --}}

    <section class="mt-16 border-t border-line pt-12">

        <p class="font-mono text-xs
                  tracking-widest text-accent">

            TECHNOLOGIES & PROJECT AREAS
        </p>

        <h2 class="mt-3 font-display
                   text-3xl font-bold md:text-4xl">

            Built With & Core Areas
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
    {{-- BACK TO ALL PROJECTS --}}
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
