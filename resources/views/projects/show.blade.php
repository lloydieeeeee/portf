
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

    // Fallback to the project's main image.
    if (empty($gallery) && !empty($project['image'])) {

        $gallery = [
            [
                'image' => $project['image'],
                'caption' => $project['title'],
            ],
        ];

    }

    // Remove screenshots that do not exist.
    $availableGallery = array_values(
        array_filter($gallery, function ($item) {

            return !empty($item['image'])
                && file_exists(public_path($item['image']));

        })
    );

    $totalSlides = count($availableGallery);

@endphp


<article class="mx-auto max-w-6xl px-6 py-16 md:py-20">

    {{-- ===================================== --}}
    {{-- BACK NAVIGATION --}}
    {{-- ===================================== --}}

    <a href="{{ route('home') }}#projects"
       class="inline-flex items-center gap-2
              text-sm font-semibold text-accent
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

    </header>


    {{-- ===================================== --}}
    {{-- PROJECT SLIDESHOW --}}
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

                Explore screenshots of the project's
                interface and features.

            </p>

        </div>


        @if($totalSlides > 0)

            {{-- ================================= --}}
            {{-- ALPINE.JS CAROUSEL --}}
            {{-- ================================= --}}

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
                            this.focused
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

                class="w-full min-w-0"

                role="region"
                aria-roledescription="carousel"
                aria-label="{{ $project['title'] }} screenshot gallery"
            >

                {{-- ================================= --}}
                {{-- MAIN IMAGE CONTAINER --}}
                {{-- ================================= --}}

                <div class="relative aspect-[16/10]
                            w-full overflow-hidden
                            border border-line
                            bg-white">

                    {{-- SCREENSHOT SLIDES --}}

                    @foreach($availableGallery as $index => $screenshot)

                        <div
                            x-show="active === {{ $index }}"

                            x-transition:enter="
                                transition-opacity
                                duration-500 ease-in-out
                            "

                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"

                            x-transition:leave="
                                transition-opacity
                                duration-500 ease-in-out
                            "

                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"

                            @if($index !== 0)
                                x-cloak
                            @endif

                            class="absolute inset-0
                                   flex items-center
                                   justify-center
                                   bg-white"

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
                                aria-label="Open screenshot {{ $index + 1 }} in full resolution"
                            >

                                <img
                                    src="{{ asset($screenshot['image']) }}"
                                    alt="{{ $screenshot['caption'] ?? $project['title'] }}"
                                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}"
                                    class="h-full w-full
                                           object-contain"
                                >

                            </a>

                        </div>

                    @endforeach


                    {{-- ================================= --}}
                    {{-- PREVIOUS BUTTON --}}
                    {{-- ================================= --}}

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
                                   focus-visible:outline-2
                                   focus-visible:outline-accent
                                   md:left-5"

                            aria-label="Previous screenshot"
                        >

                            &#10094;

                        </button>


                        {{-- NEXT BUTTON --}}

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
                                   focus-visible:outline-2
                                   focus-visible:outline-accent
                                   md:right-5"

                            aria-label="Next screenshot"
                        >

                            &#10095;

                        </button>

                    @endif

                </div>


                {{-- ================================= --}}
                {{-- SCREENSHOT DETAILS --}}
                {{-- ================================= --}}

                <div class="mt-6 flex flex-wrap
                            items-start justify-between
                            gap-5">

                    <div class="min-w-0 flex-1">

                        <p class="font-mono text-xs
                                  tracking-widest
                                  text-accent">

                            PROJECT SCREENSHOT

                            <span x-text="
                                String(active + 1).padStart(2, '0')
                            "></span>

                            /

                            {{ sprintf('%02d', $totalSlides) }}

                        </p>

                        {{-- ACTIVE IMAGE CAPTION --}}

                        @foreach($availableGallery as $index => $screenshot)

                            <div
                                x-show="active === {{ $index }}"

                                @if($index !== 0)
                                    x-cloak
                                @endif

                                class="mt-2"
                            >

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
                                           hover:opacity-70"
                                >

                                    VIEW FULL IMAGE ↗

                                </a>

                            </div>

                        @endforeach

                    </div>


                    {{-- ================================= --}}
                    {{-- SLIDESHOW INDICATORS --}}
                    {{-- ================================= --}}

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

                                    aria-label="Go to screenshot {{ $index + 1 }}"
                                ></button>

                            @endforeach

                        </div>

                    @endif

                </div>


                {{-- SLIDESHOW NOTE --}}

                @if($totalSlides > 1)

                    <p class="mt-7 font-mono
                              text-[11px]
                              tracking-wide text-muted">

                        AUTO-PLAY EVERY 4.5 SECONDS
                        · USE ARROWS TO NAVIGATE

                    </p>

                @endif

            </div>

        @else

            {{-- ================================= --}}
            {{-- NO SCREENSHOTS AVAILABLE --}}
            {{-- ================================= --}}

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
    {{-- TECHNOLOGIES SECTION --}}
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
