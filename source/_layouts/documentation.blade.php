@extends('_layouts.master')

@section('nav-toggle')
    @include('_nav.menu-toggle')
@endsection

@section('body')
    <section
        class="container px-6 py-4 mx-auto max-w-8xl md:px-8"
    >
        <div
            class="flex flex-col lg:flex-row"
        >
            <nav
                class="hidden nav-menu lg:block"
                id="js-nav-menu"
            >

                @include('_nav.menu', ['items' => $page->navigation])

            </nav>

            <div
                class="w-full pb-16 break-words DocSearch-content lg:w-3/5 lg:pl-4"
                v-pre
            >
                <h1>{{ $page->title }}</h1>

                @if ($page->updatedAt)
                    <p
                        class="text-xs italic text-gray-400"
                    >

                        Last Updated:
                        <time
                            datetime="{{ (new \Carbon\Carbon)->parse($page->updatedAt) }}"
                        >
                            {{ (new \Carbon\Carbon)->parse($page->updatedAt)->format("j M Y") }}
                        </time>
                    </p>
                @endif

                @yield('content')

                <div
                    class="flex flex-col gap-2 pt-2 mt-8 text-sm italic border-t border-gray-300"
                >
                    <p
                        class="p-0 m-0"
                    >
                        ✋ This is currently a manual process for which we don't have a linter (yet).
                    </p>
                    <p
                        class="p-0 m-0"
                    >
                        🤔 This is currently under consideration, but not enforced.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
