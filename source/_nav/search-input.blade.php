<div>
{{--
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
 </div> --}}

<div x-data="search()" class="mb-4 space-y-2 md:mb-8 lg:mb-10 xl:mb-12">
  <input
    type="search"
    name="search"
    placeholder="Search &mldr;"
    autocomplete="off"
    @input.debounce.250ms="search"
    x-model="query"
    class="w-full px-4 py-2 bg-white border-b-2 shadow dark:bg-night-10 border-night-10 dark:border-snow-10 rounded-1 focus:outline-none focus:border-brand"
  />
<ol class="space-y-2 list-none"
>
    <template x-for="result in results">
      <li
        class="p-4 overflow-hidden bg-white shadow rounded-1 dark:bg-night-20"
      >
        <a :href="result.url" class="block group">
          <div class="flex justify-between space-x-2 sm:justify-start">
            <strong
              x-text="result.title"
              class="group-hover:text-brand"
            ></strong>
            <span class="text-snow-20 dark:text-snow-10">
              {{-- <x-icon class="mr-1 fal fa-calendar" /> --}}
              <time x-text="result.date"></time>
            </span>
          </div>
          <p class="truncate" x-text="result.description"></p>
        </a>
      </li>
    </template>
  </ol>
</div>
  <script>
    function search()
    {
        return {
    items: [],
    fuse: null,
    query: "",
    results: [],

    init: function () {
        let url = new URL(window.location);

        url.pathname = "index.json";
        url.searchParams.set("t", Date.now());

        if (window.location.port !== 8000) {
            url.pathname = "code-style-guide/" + url.pathname;
        }

        fetch(url.toString())
            .then((response) => response.json())
            .then((items) => {
                this.items = items;

                this.fuse = new Fuse(this.items, {
                    findAllMatches: true,
                    includeScore: true,
                    keys: ["content"],
                    minMatchCharLength: 3,
                });
            })
            .catch(console.error);
    },

    search: function () {
        if (this.fuse === null) {
            this.results = [];

            return false;
        }

        this.results = this.fuse.search(this.query)
            .map(function (item) {
                return item.item;
            });
    },
};
    }
  </script>
</div>
