<div>
    <div
        x-data="search()"
        class="mb-4 space-y-2 md:mb-8 lg:mb-10 xl:mb-12"
    >
        <input
            type="search"
            name="search"
            placeholder="Search &mldr;"
            autocomplete="off"
            @input.debounce.250ms="search"
            x-model="query"
            class="w-full px-4 py-2 bg-white border-b-2 shadow dark:bg-night-10 border-night-10 dark:border-snow-10 rounded-1 focus:border-brand focus:outline-none"
        />
        <ol
            class="space-y-2 list-none"
        >
            <template
                x-for="result in results"
            >
                <li
                    class="p-4 overflow-hidden bg-white shadow rounded-1 dark:bg-night-20"
                >
                    <a
                        :href="result.url"
                        class="block group"
                    >
                        <div
                            class="flex justify-between space-x-2 sm:justify-start"
                        >
                            <strong
                                x-text="result.title"
                                class="group-hover:text-brand"
                            ></strong>
                            <span class="text-snow-20 dark:text-snow-10">
                                {{-- <x-icon class="mr-1 fal fa-calendar" /> --}}
                                <time x-text="result.date"></time>
                            </span>
                        </div>
                        <p
                            class="truncate"
                            x-text="result.description"
                        ></p>
                    </a>
                </li>
            </template>
        </ol>
    </div>
    <script>
        function search() {
            return {
                items: [],
                fuse: null,
                query: "",
                results: [],

                init: function() {
                    let url = new URL(window.location);

                    url.pathname = "index.json";
                    url.searchParams.set("t", Date.now());

                    if (window.location.port != 8000) {
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

                search: function() {
                    if (this.fuse === null) {
                        this.results = [];

                        return false;
                    }

                    this.results = this.fuse.search(this.query)
                        .map(function(item) {
                            return item.item;
                        });
                },
            };
        }
    </script>
</div>
