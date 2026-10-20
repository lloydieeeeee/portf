
@extends('layouts.app')

@section('title', 'John Lloyd Oresca | Portfolio')

@section('content')

{{-- ========================================= --}}
{{-- HERO SECTION --}}
{{-- ========================================= --}}

<section id="home"
    class="relative overflow-hidden border-b border-line">

    <div class="mx-auto grid min-h-[85vh] max-w-7xl
                items-center gap-12 px-6 py-16
                lg:grid-cols-2 lg:gap-20">

        {{-- LEFT: INTRODUCTION --}}

        <div class="relative z-10">

            <p class="reveal mb-6 flex flex-wrap
                      items-center gap-3 font-mono
                      text-xs font-semibold
                      tracking-widest text-accent">

                <span class="h-2 w-2 rounded-full bg-accent"></span>

                DEVELOPER / DESIGNER

                <span class="text-muted">
                    PORTFOLIO 2026
                </span>
            </p>

            <h1 class="reveal font-display text-5xl
                       font-bold leading-[1.08]
                       tracking-tight sm:text-6xl
                       xl:text-7xl">

                Turning

                <span class="block text-accent">
                    ideas into
                </span>

                experiences.
            </h1>

            <p class="reveal mt-7 max-w-xl text-lg
                      leading-relaxed text-muted">

                {{ $profile['intro'] }}

            </p>

            <div class="reveal mt-9 flex flex-wrap
                        items-center gap-7">

                <a href="#projects"
                   class="border-b-2 border-accent
                          pb-2 font-semibold transition
                          hover:text-accent">

                    EXPLORE MY WORK ↗
                </a>

                <a href="#contact"
                   class="border-b-2 border-ink
                          pb-2 font-semibold transition
                          hover:border-accent
                          hover:text-accent">

                    CONTACT ME ↗
                </a>

            </div>

            <p class="reveal mt-16 font-mono text-xs
                      tracking-widest text-muted">

                SCROLL TO EXPLORE ↓
            </p>

        </div>


        {{-- ================================= --}}
        {{-- INTERACTIVE ORBITAL ARTWORK --}}
        {{-- ================================= --}}

        <div class="flex w-full min-w-0 items-center
                    justify-center py-4">

            <div
                id="orbital-art"
                class="orbital-art"
                role="group"
                aria-label="Interactive orbital artwork"
            >

                {{-- BACKGROUND GRID --}}
                <div class="orbital-grid"
                     aria-hidden="true"></div>

                {{-- SOFT LIGHT --}}
                <div class="orbital-aura"
                     aria-hidden="true"></div>

                {{-- THREE ROTATING ORBITS --}}

                <div class="orbital-ring orbital-ring--outer"
                     aria-hidden="true"></div>

                <div class="orbital-ring orbital-ring--middle"
                     aria-hidden="true"></div>

                <div class="orbital-ring orbital-ring--inner"
                     aria-hidden="true"></div>

                {{-- SMALL FLOATING PARTICLES --}}

                <span class="orbital-dot orbital-dot--one"
                      aria-hidden="true"></span>

                <span class="orbital-dot orbital-dot--two"
                      aria-hidden="true"></span>

                {{-- CLICKABLE LIQUID CENTER --}}

                <div class="orbital-core-wrap">

                    <button
                        id="orbital-core"
                        type="button"
                        class="orbital-core"
                        aria-label="Create a water ripple"
                        title="Click to create a ripple"
                    >

                        <span class="orbital-core-light"
                              aria-hidden="true"></span>

                        <span id="orbital-ripple-layer"
                              class="orbital-ripple-layer"
                              aria-hidden="true"></span>

                    </button>

                </div>

            </div>

        </div>

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

            <p class="mt-7 text-lg leading-relaxed text-muted">

                I'm {{ $profile['name'] }},
                a Bachelor of Science in
                Information Technology graduate
                from Camarines Norte State College.

            </p>

            <p class="mt-5 text-lg leading-relaxed text-muted">

                I have experience developing
                web applications, working with
                information systems, exploring IoT,
                and creating visual designs.

            </p>

            <p class="mt-5 text-lg leading-relaxed text-muted">

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

            <p class="mt-5 max-w-xl leading-relaxed text-muted">

                A collection of development,
                design, and technology projects.

            </p>

        </div>

        <div class="grid gap-12 md:grid-cols-2">

            @foreach($projects as $index => $project)

                @php
                    $projectImage = $project['image'] ?? null;

                    $hasProjectImage = $projectImage &&
                        file_exists(public_path($projectImage));
                @endphp

                <a href="{{ route('projects.show', $project['slug']) }}"
                   class="project-card group block">

                    {{-- PROJECT PREVIEW --}}

                    <div class="flex aspect-[4/3]
                                items-center justify-center
                                overflow-hidden bg-[#E7E2D8]">

                        @if($hasProjectImage)

                            <img
                                src="{{ asset($projectImage) }}"
                                alt="{{ $project['title'] }}"
                                loading="lazy"
                                class="h-full w-full object-cover
                                       transition-transform duration-500
                                       group-hover:scale-105"
                            >

                        @else

                            <div class="flex flex-col
                                        items-center justify-center">

                                <span class="font-display
                                             text-7xl font-bold
                                             text-muted/30">

                                    {{ sprintf('%02d', $index + 1) }}

                                </span>

                                <span class="mt-4 font-mono
                                             text-xs tracking-widest
                                             text-muted">

                                    PROJECT PREVIEW

                                </span>

                            </div>

                        @endif

                    </div>

                    {{-- PROJECT DETAILS --}}

                    <div class="mt-5 flex justify-between gap-4">

                        <div>

                            <p class="text-xs font-semibold
                                      uppercase tracking-widest
                                      text-accent">

                                {{ $project['category'] }}

                            </p>

                            <h3 class="mt-2 font-display
                                       text-2xl font-bold
                                       transition-colors
                                       group-hover:text-accent">

                                {{ $project['title'] }}

                            </h3>

                            <p class="mt-3 leading-relaxed text-muted">

                                {{ $project['description'] }}

                            </p>

                            <div class="mt-5 flex flex-wrap gap-2">

                                @foreach($project['technologies'] as $technology)

                                    <span class="border border-line
                                                 px-3 py-1 text-xs
                                                 text-muted">

                                        {{ $technology }}

                                    </span>

                                @endforeach

                            </div>

                        </div>

                        <span class="text-2xl transition
                                     group-hover:text-accent"
                              aria-hidden="true">
                            ↗
                        </span>

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
            turn ideas into functional digital solutions.

        </p>

        <div class="mt-12 grid gap-10 md:grid-cols-3">

            @foreach($skills as $category => $items)

                @if(count($items) > 0)

                    <div class="reveal border-t-2 border-ink pt-5">

                        <h3 class="font-display text-xl font-bold">
                            {{ $category }}
                        </h3>

                        <div class="mt-5 flex flex-wrap gap-2">

                            @foreach($items as $skill)

                                <span class="border border-line
                                             px-3 py-2 text-sm
                                             transition-colors
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
                       text-4xl font-bold md:text-5xl">

                Background & experience.

            </h2>

            {{-- INTERNSHIP --}}

            <div class="mt-10 border-t border-line py-6">

                <h3 class="font-display text-2xl font-bold">

                    IT Administrative Intern

                </h3>

                <p class="mt-3 leading-relaxed text-muted">

                    Worked on administrative workflows,
                    information systems, documentation,
                    and technical troubleshooting.

                </p>

            </div>

            {{-- EDUCATION --}}

            <div class="border-t border-line py-6">

                <h3 class="font-display text-2xl font-bold">

                    {{ $profile['education']['degree'] }}

                </h3>

                <p class="mt-3 text-muted">

                    {{ $profile['education']['school'] }}
                    ·
                    {{ $profile['education']['years'] }}

                </p>

            </div>

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
                  text-lg leading-relaxed text-muted">

            Interested in collaborating,
            working together, or discussing
            an opportunity?

        </p>

        <a href="mailto:{{ $profile['email'] }}"
           class="mt-9 inline-block border-b-2
                  border-accent pb-2 font-semibold
                  transition hover:text-accent">

            GET IN TOUCH ↗

        </a>

    </div>

</section>

@endsection
