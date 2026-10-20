
@extends('layouts.app')

@section('title', 'John Lloyd Oresca | Portfolio')

@section('content')

{{-- ========================================= --}}
{{-- HERO DISPLAY SETTINGS --}}
{{-- ========================================= --}}

@php
    /*
    |--------------------------------------------------------------------------
    | HERO DISPLAY MODE
    |--------------------------------------------------------------------------
    | false = Display an image
    | true  = Display the Blender 3D sculpture
    |
    | Change this to true when the Blender model is ready.
    */
    $useHero3D = false;

    $heroImage = 'images/splaceholder.jpg';
@endphp


{{-- ========================================= --}}
{{-- HERO SECTION --}}
{{-- ========================================= --}}

<section id="home"
    class="mx-auto grid min-h-[85vh]
           max-w-7xl items-center gap-10
           px-6 py-16 lg:grid-cols-2">

    {{-- LEFT SIDE: INTRODUCTION --}}
    <div>

        <p class="reveal mb-5 font-mono text-sm
                  tracking-widest text-accent">
            PORTFOLIO / 2026
        </p>

        <h1 class="reveal font-display text-5xl
                   font-bold leading-[1.08]
                   tracking-tight md:text-7xl">

            I believe
            <br>
            I can fly
            <br>

            <span class="text-accent">
                wala me magawa
            </span>

        </h1>

        <p class="reveal mt-7 max-w-xl text-lg
                  leading-relaxed text-muted">
            {{ $profile['intro'] }}
        </p>

        <div class="reveal mt-9 flex flex-wrap gap-6">

            <a href="#projects"
               class="border-b-2 border-accent
                      pb-2 font-semibold
                      transition hover:text-accent">
                EXPLORE MY WORK ↗
            </a>

            <a href="#contact"
               class="border-b-2 border-ink
                      pb-2 font-semibold
                      transition hover:text-accent">
                CONTACT ME
            </a>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- RIGHT SIDE: IMAGE OR BLENDER 3D --}}
    {{-- ========================================= --}}

    <div class="relative">

        @if($useHero3D)

            {{-- ================================= --}}
            {{-- BLENDER 3D MODE --}}
            {{-- ================================= --}}

            <div id="sculpture-viewer"
                 role="img"
                 aria-label="Animated abstract 3D sculpture"
                 class="relative h-[360px] w-full
                        md:h-[520px]">

                {{-- Temporary placeholder while
                     the Blender model loads --}}

                <div id="sculpture-placeholder"
                     class="absolute inset-0 flex
                            items-center justify-center
                            bg-[#E9E4DA]">

                    <div class="text-center">

                        <p class="font-display text-6xl
                                  font-bold text-accent/30">
                            FORM.
                        </p>

                        <p class="mt-2 font-mono
                                  text-xs text-muted">
                            ORIGINAL DIGITAL SCULPTURE
                        </p>

                    </div>

                </div>

            </div>

            <p class="mt-4 text-right font-mono
                      text-xs text-muted">
                FORM / 01 — BLENDER EXPERIMENT
            </p>

        @else

            {{-- ================================= --}}
            {{-- IMAGE MODE: CURRENTLY ACTIVE --}}
            {{-- ================================= --}}

            <div class="relative h-[360px] w-full
                        overflow-hidden md:h-[520px]">

                <img
                    src="{{ asset($heroImage) }}"
                    alt="Portfolio hero artwork"
                    class="h-full w-full object-cover"
                    onerror="this.style.display='none'"
                >

            </div>

            <p class="mt-4 text-right font-mono
                      text-xs text-muted">
                CREATIVE WORK / PORTFOLIO
            </p>

        @endif

    </div>

</section>


{{-- ========================================= --}}
{{-- ABOUT SECTION --}}
{{-- ========================================= --}}

<section id="about"
         class="border-t border-line px-6 py-24">

    <div class="mx-auto grid max-w-7xl
                gap-10 md:grid-cols-3">

        <p class="reveal font-mono text-sm text-accent">
            01 / ABOUT
        </p>

        <div class="reveal md:col-span-2">

            <h2 class="font-display text-4xl
                       font-bold md:text-5xl">
                Code, design, and curiosity.
            </h2>

            <p class="mt-7 text-lg leading-relaxed
                      text-muted">

                I'm {{ $profile['name'] }},
                a Bachelor of Science in
                Information Technology graduate
                from Camarines Norte State College.

            </p>

            <p class="mt-5 text-lg leading-relaxed
                      text-muted">

                I have experience developing
                web applications, working with
                information systems, exploring IoT,
                and creating visual designs.

            </p>

            <p class="mt-5 text-lg leading-relaxed
                      text-muted">

                I enjoy approaching problems
                from both a technical and
                creative perspective.

            </p>

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- PROJECTS SECTION --}}
{{-- ========================================= --}}

<section id="projects"
         class="border-t border-line px-6 py-24">

    <div class="mx-auto max-w-7xl">

        <div class="reveal mb-12">

            <p class="font-mono text-sm text-accent">
                02 / SELECTED WORK
            </p>

            <h2 class="mt-3 font-display
                       text-4xl font-bold md:text-5xl">
                Things I've built.
            </h2>

            <p class="mt-5 text-muted">
                A collection of development,
                design, and technology projects.
            </p>

        </div>

        <div class="grid gap-12 md:grid-cols-2">

            @foreach($projects as $index => $project)

                @php
                    /*
                    Use the project's own image if available.
                    Otherwise, use the shared placeholder.
                    */
                    $projectImage = $project['image']
                        ?? 'images/projects/placeholder.jpg';

                    if (!file_exists(public_path($projectImage))) {
                        $projectImage =
                            'images/projects/placeholder.jpg';
                    }
                @endphp

                <a href="{{ route('projects.show', $project['slug']) }}"
                   class="project-card group block">

                    {{-- PROJECT IMAGE --}}

                    <div class="flex aspect-[4/3]
                                items-center justify-center
                                overflow-hidden bg-[#E7E2D8]">

                        @if(file_exists(public_path($projectImage)))

                            <img
                                src="{{ asset($projectImage) }}"
                                alt="{{ $project['title'] }}"
                                loading="lazy"
                                class="h-full w-full
                                       object-cover
                                       transition-transform
                                       duration-500
                                       group-hover:scale-105"
                            >

                        @else

                            <span class="font-display
                                         text-7xl text-muted/30">
                                {{ sprintf('%02d', $index + 1) }}
                            </span>

                        @endif

                    </div>


                    {{-- PROJECT INFORMATION --}}

                    <div class="mt-5 flex
                                justify-between gap-4">

                        <div>

                            <p class="text-xs font-semibold
                                      uppercase tracking-widest
                                      text-accent">
                                {{ $project['category'] }}
                            </p>

                            <h3 class="mt-2 font-display
                                       text-2xl font-bold">
                                {{ $project['title'] }}
                            </h3>

                        </div>

                        <span class="text-2xl">↗</span>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- SKILLS SECTION --}}
{{-- ========================================= --}}

<section id="skills"
         class="border-t border-line px-6 py-24">

    <div class="mx-auto max-w-7xl">

        <p class="reveal font-mono text-sm text-accent">
            03 / MY TOOLKIT
        </p>

        <h2 class="reveal mt-3 font-display
                   text-4xl font-bold md:text-5xl">
            Languages, tools & technologies.
        </h2>

        <p class="reveal mt-5 max-w-2xl text-muted">
            Technologies and tools I use to
            turn ideas into functional
            digital solutions.
        </p>

        <div class="mt-12 grid gap-10 md:grid-cols-3">

            @foreach($skills as $category => $items)

                @if(count($items) > 0)

                    <div class="reveal border-t-2
                                border-ink pt-5">

                        <h3 class="font-display
                                   text-xl font-bold">
                            {{ $category }}
                        </h3>

                        <div class="mt-5 flex flex-wrap gap-2">

                            @foreach($items as $skill)

                                <span class="border border-line
                                             px-3 py-2 text-sm
                                             transition
                                             hover:border-accent
                                             hover:text-accent">
                                    {{ $skill }}
                                </span>

                            @endforeach

                        </div>

                    </div>

                @endif

            @endforeach

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- EXPERIENCE SECTION --}}
{{-- ========================================= --}}

<section id="experience"
         class="border-t border-line px-6 py-24">

    <div class="mx-auto grid max-w-7xl
                gap-10 md:grid-cols-3">

        <p class="reveal font-mono text-sm text-accent">
            04 / EXPERIENCE
        </p>

        <div class="reveal md:col-span-2">

            <h2 class="font-display
                       text-4xl font-bold">
                Background & experience.
            </h2>


            {{-- INTERNSHIP --}}

            <div class="mt-10 border-t border-line py-6">

                <h3 class="font-display
                           text-2xl font-bold">
                    IT Administrative Intern
                </h3>

                <p class="mt-3 text-muted">
                    Worked on administrative workflows,
                    information systems, documentation,
                    and technical troubleshooting.
                </p>

            </div>


            {{-- EDUCATION --}}

            <div class="border-t border-line py-6">

                <h3 class="font-display
                           text-2xl font-bold">
                    {{ $profile['education']['degree'] }}
                </h3>

                <p class="mt-3 text-muted">
                    {{ $profile['education']['school'] }}
                    · {{ $profile['education']['years'] }}
                </p>

            </div>

            {{-- CERTIFICATION --}}
            {{-- Reserved for future certification content --}}

        </div>

    </div>

</section>


{{-- ========================================= --}}
{{-- CONTACT SECTION --}}
{{-- ========================================= --}}

<section id="contact"
         class="border-t border-line px-6 py-24">

    <div class="reveal mx-auto max-w-7xl">

        <p class="font-mono text-sm text-accent">
            05 / CONTACT
        </p>

        <h2 class="mt-5 font-display
                   text-5xl font-bold md:text-7xl">
            Let's build something.
        </h2>

        <p class="mt-6 max-w-xl
                  text-lg text-muted">
            Interested in collaborating,
            working together, or discussing
            an opportunity?
        </p>

        <a href="mailto:{{ $profile['email'] }}"
           class="mt-9 inline-block
                  border-b-2 border-accent
                  pb-2 font-semibold
                  transition hover:text-accent">
            GET IN TOUCH ↗
        </a>

    </div>

</section>

@endsection
