<button
    title="Start searching"
    type="button"
    class="flex items-center justify-center h-10 px-3 bg-gray-100 border border-gray-500 rounded-full md:hidden hover:bg-blue-100 focus:outline-none"
    onclick="searchInput.toggle()"
>
    <img src="{{ url("/assets/img/magnifying-glass.svg") }}" alt="search icon" class="w-4 h-4 max-w-none">
</button>

<div id="js-search-input" class="hidden docsearch-input__wrapper md:block">
    <label for="search" class="hidden">Search</label>

    <input
        id="docsearch-input"
        class="relative block w-full h-10 px-4 pb-0 ml-auto text-gray-700 bg-gray-100 border border-gray-500 rounded-full outline-none docsearch-input transition-fast lg:w-1/2 xl:w-1/3 focus:border-blue-400"
        name="docsearch"
        type="text"
        placeholder="Search"
    >

    <button
        class="absolute h-full -mt-px text-3xl font-light text-blue-500 md:hidden pin-t pin-r hover:text-blue-600 focus:outline-none pr-7"
        onclick="searchInput.toggle()"
    >&times;</button>
</div>

@push('scripts')
    @if ($page->docsearchApiKey && $page->docsearchIndexName)
        <script type="text/javascript">
            docsearch({
                apiKey: '{{ $page->docsearchApiKey }}',
                indexName: '{{ $page->docsearchIndexName }}',
                inputSelector: '#docsearch-input',
                debug: false // Set debug to true if you want to inspect the dropdown
            });

            const searchInput = {
                toggle() {
                    const menu = document.getElementById('js-search-input');
                    menu.classList.toggle('hidden');
                    menu.classList.toggle('md:block');
                    document.getElementById('docsearch-input').focus();
                },
            }
        </script>
    @endif
@endpush
