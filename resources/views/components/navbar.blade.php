
<header
    x-data="{
        open: false,
        scrolled: false,
        active: '{{ request()->routeIs('projects.show') ? 'projects' : 'home' }}',

        updateActive() {
            this.scrolled = window.scrollY > 30;

            const sections = [
                ...document.querySelectorAll('main section[id]')
            ];

            if (!sections.length) return;

            const offset = 110;

            let current = sections[0].id;

            sections.forEach((section) => {
                if (section.getBoundingClientRect().top <= offset) {
                    current = section.id;
                }
            });

            if (
                window.innerHeight + window.scrollY >=
                document.documentElement.scrollHeight - 5
            ) {
                current = sections[sections.length - 1].id;
            }

            this.active = current;
        },

        init() {
            this.$nextTick(() => this.updateActive());
        }
    }"

    x-on:scroll.window="updateActive()"
    x-on:resize.window="updateActive()"

    class="sticky top-0 z-50
           
           bg-paper/95 backdrop-blur-md"
>
    <nav
        class="mx-auto flex max-w-7xl
               items-center justify-between
               px-6 transition-all duration-300"

        :class="scrolled ? 'py-2' : 'py-3'"
    >
        <!-- LOGO -->
        <a href="{{ route('home') }}#home"
           class="font-display text-xl
                  font-bold tracking-tight">
            John Lloyd<span class="text-accent"> Oresca</span>
        </a>

        <!-- DESKTOP NAVIGATION -->
        <div class="hidden items-center gap-6
                    md:flex">

            @foreach ([
                'home' => 'HOME',
                'about' => 'ABOUT',
                'projects' => 'PROJECTS',
                'skills' => 'SKILLS',
                'experience' => 'EXPERIENCE',
                'contact' => 'CONTACT'
            ] as $id => $label)

                <a
                    href="{{ route('home') }}#{{ $id }}"

                    class="border-b-2 pb-1
                           text-xs font-semibold
                           tracking-wide
                           transition-colors duration-200"

                    :class="active === '{{ $id }}'
                        ? 'border-accent text-accent'
                        : 'border-transparent text-ink hover:text-accent'">
                    {{ $label }}
                </a>

            @endforeach

        </div>

        <!-- MOBILE MENU BUTTON -->
        <button
            type="button"
            @click="open = !open"
            :aria-expanded="open.toString()"
            aria-controls="mobile-menu"
            class="text-xl text-ink md:hidden"
            aria-label="Toggle navigation">
            ☰
        </button>
    </nav>

    <!-- MOBILE NAVIGATION -->
    <div
        id="mobile-menu"
        x-cloak
        x-show="open"
        x-transition
        class="border-t border-line
               bg-paper px-6 py-4 md:hidden"
    >
        <div class="flex flex-col gap-4">

            @foreach ([
                'home' => 'HOME',
                'about' => 'ABOUT',
                'projects' => 'PROJECTS',
                'skills' => 'SKILLS',
                'experience' => 'EXPERIENCE',
                'contact' => 'CONTACT'
            ] as $id => $label)

                <a
                    href="{{ route('home') }}#{{ $id }}"

                    @click="open = false"

                    class="w-fit border-b-2 pb-1
                           text-sm font-semibold"

                    :class="active === '{{ $id }}'
                        ? 'border-accent text-accent'
                        : 'border-transparent text-ink'">

                    {{ $label }}
                </a>

            @endforeach

        </div>
    </div>
</header>
