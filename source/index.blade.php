@extends('_layouts.master')

@section('body')
<section class="container max-w-6xl px-6 py-10 mx-auto md:py-12">
    <div class="flex flex-col-reverse mb-10 lg:flex-row lg:mb-24">
        <div class="mt-8">
            <h1 id="intro-docs-template">{{ $page->siteName }}</h1>

            <h2 id="intro-powered-by-jigsaw" class="mt-4 font-light">{{ $page->siteDescription }}</h2>

            <p class="text-lg">Give your documentation a boost with Jigsaw. <br class="hidden sm:block">Generate elegant, static docs quickly and easily.</p>

            <div class="flex my-10">
                <a href="/docs/getting-started" title="{{ $page->siteName }} getting started" class="px-6 py-2 mr-4 font-normal text-white bg-blue-500 rounded hover:bg-blue-600 hover:text-white">Get Started</a>

                <a href="https://jigsaw.tighten.co" title="Jigsaw by Tighten" class="px-6 py-2 font-normal text-blue-900 bg-gray-400 rounded hover:bg-gray-600 hover:text-white">About Jigsaw</a>
            </div>
        </div>

        <img src="{{ url("/assets/img/logo-large.svg") }}" alt="{{ $page->siteName }} large logo" class="mx-auto mb-6 lg:mb-0 ">
    </div>

    <hr class="block my-8 border lg:hidden">

    <div class="-mx-2 -mx-4 md:flex">
        <div class="px-2 mx-3 mb-8 md:w-1/3">
            <img src="{{ url("/assets/img/icon-window.svg") }}" class="w-12 h-12" alt="window icon">

            <h3 id="intro-laravel" class="mb-0 text-2xl text-blue-900">Templating with <br>Laravel's Blade engine</h3>

            <p>Blade is a powerful, simple, and beautiful templating language, and now you can use it for your static sites, not just your Laravel-powered apps.</p>
        </div>

        <div class="px-2 mx-3 mb-8 md:w-1/3">
            <img src="{{ url("/assets/img/icon-terminal.svg") }}" class="w-12 h-12" alt="terminal icon">

            <h3 id="intro-markdown" class="mb-0 text-2xl text-blue-900">Use Markdown for <br>content-driven pages</h3>

            <p>Markdown is the web’s leading format for writing articles, blog posts, documentation, and more. Jigsaw makes it painless to work with Markdown content.</p>
        </div>

        <div class="px-2 mx-3 md:w-1/3">
            <img src="{{ url("/assets/img/icon-stack.svg") }}" class="w-12 h-12" alt="stack icon">

            <h3 id="intro-mix" class="mb-0 text-2xl text-blue-900">Compile your assets <br>using Laravel Mix </h3>

            <p>Jigsaw comes pre-configured with Laravel Mix, a simple and powerful build tool. Use the latest frontend tech with just a few lines of code.</p>
        </div>
    </div>
</section>
@endsection
