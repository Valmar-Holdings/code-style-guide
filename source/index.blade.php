@extends('_layouts.master')

@section('body')
    <section
        class="container max-w-6xl px-6 py-10 mx-auto md:py-12"
    >
        <div
            class="flex flex-col-reverse mb-10 lg:mb-24 lg:flex-row"
        >
            <div
                class="mt-8"
            >
                <h1
                    id="intro-docs-template"
                >
                    {{ $page->siteName }}
                </h1>

                <h2
                    class="mt-4 font-light"
                    id="intro-powered-by-jigsaw"
                >
                    {{ $page->siteDescription }}
                </h2>

                <p class="text-lg">Collection of best practices used in Valmar Holdings development. This documentation should be considered a living document.</p>

                <div class="flex my-10">
                    <a
                        href="{{ url('/docs/overview') }}"
                        title="{{ $page->siteName }} getting started"
                        class="px-6 py-2 mr-4 font-normal text-white bg-blue-500 rounded hover:bg-blue-600 hover:text-white"
                    >Get Started</a>
                </div>
            </div>

            <img
                src="{{ url('/assets/img/logo-large.svg') }}"
                alt="{{ $page->siteName }} large logo"
                class="mx-auto mb-6 lg:mb-0"
            >
        </div>
    </section>
@endsection
