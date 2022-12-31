<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <base href="{{ $page->baseUrl }}">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        >
        <meta
            http-equiv="x-ua-compatible"
            content="ie=edge"
        >
        <meta
            name="description"
            content="{{ $page->description ?? $page->siteDescription }}"
        >

        <meta
            property="og:site_name"
            content="{{ $page->siteName }}"
        />
        <meta
            property="og:title"
            content="{{ $page->title ? $page->title . ' | ' : '' }}{{ $page->siteName }}"
        />
        <meta
            property="og:description"
            content="{{ $page->description ?? $page->siteDescription }}"
        />
        <meta
            property="og:url"
            content="{{ $page->getUrl() }}"
        />
        <meta
            property="og:image"
            content="/assets/img/logo.png"
        />
        <meta
            property="og:type"
            content="website"
        />

        <meta
            name="twitter:image:alt"
            content="{{ $page->siteName }}"
        >
        <meta
            name="twitter:card"
            content="summary_large_image"
        >
        <meta
            name="generator"
            content="tighten_jigsaw_doc"
        >

        <title>{{ $page->siteName }}{{ $page->title ? ' | ' . $page->title : '' }}</title>

        <link
            rel="home"
            href="{{ $page->baseUrl }}"
        >
        <link
            rel="icon"
            href="{{ url('/favicon.ico') }}"
        >

        @stack('meta')

        @if ($page->production)
            <!-- Insert analytics code here -->
        @endif

        <link
            href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,700,700i,800,800i"
            rel="stylesheet"
        >
        <link
            rel="stylesheet"
            href="{{ url(mix('css/main.css', 'assets/build')) }}"
        >
        <script
            defer
            src="{{ url(mix('js/main.js', 'assets/build')) }}"
        ></script>
    </head>

    <body class="flex flex-col justify-between min-h-screen font-sans leading-normal text-gray-800 bg-gray-100">
        <header
            class="flex items-center h-24 py-4 mb-8 bg-white border-b shadow"
            role="banner"
        >
            <div class="container flex items-center px-4 mx-auto max-w max-w-8xl lg:px-8">
                <div class="flex items-center">
                    <a
                        href="{{ url('/') }}"
                        title="{{ $page->siteName }} home"
                        class="inline-flex items-center"
                    >
                        <img
                            class="h-8 mr-3 md:h-10"
                            src="{{ url('/assets/img/logo.svg') }}"
                            alt="{{ $page->siteName }} logo"
                        />

                        <h1
                            class="pr-4 my-0 text-lg font-semibold text-blue-900 whitespace-nowrap hover:text-blue-600 md:text-2xl"
                        >
                            {{ $page->siteName }}
                        </h1>
                    </a>
                </div>

                <div class="flex items-center justify-end flex-1 text-right md:pl-10">

                    {{-- @include('_nav.search-input') --}}

                </div>
            </div>

            @yield('nav-toggle')

        </header>

        <main
            role="main"
            class="flex-auto w-full"
        >

            @yield('body')

        </main>


        @stack('scripts')

        <footer
            class="py-4 mt-12 text-sm text-center bg-white"
            role="contentinfo"
        >
            <p
                class="text-base text-gray-400 xl:text-center"
            >
                &copy; {{ date('Y') }}
                <a
                    href="https://valmar.holdings"
                    title="Valmar Holdings"
                >
                    Valmar Holdings
                </a>.
                All rights reserved.
            </p>
        </footer>
    </body>
</html>
