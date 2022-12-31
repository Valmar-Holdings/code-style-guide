<div>
    <div
        class="flex items-center justify-end flex-1 px-4 text-right"
        x-data="search()"
    >
        <div
            class="absolute top-0 bottom-0 left-0 z-10 justify-end w-full px-4 bg-white mt-7 md:relative md:mt-0 md:px-0"
            x-bind:class="{ 'hidden md:flex': !searching }"
        >
            <label
                for="search"
                class="hidden"
            >Search</label>

            <input
                id="search"
                x-model="query"
                ref="search"
                class="relative block w-full h-10 px-4 pt-px pb-0 text-gray-700 transition-all duration-200 ease-out bg-gray-100 border border-gray-500 outline-none cursor-pointer focus:border-blue-400 lg:w-1/2 lg:focus:w-3/4"
                :class="{ 'transition-border': query }"
                autocomplete="off"
                name="search"
                placeholder="Search"
                type="text"
                @keyup.esc="reset"
                @blur="reset"
            >

            <button
                x-if="query || searching"
                class="absolute top-0 right-0 text-3xl leading-snug text-blue-500 font-400 pr-7 hover:text-blue-600 focus:outline-none md:pr-3"
                @click="reset"
            >&times;</button>

                <div
                    x-if="query"
                    class="absolute bottom-0 left-0 right-0 w-full mb-4 text-left md:inset-auto md:mt-10 lg:w-3/4"
                >
                    <div
                        class="flex flex-col mx-4 bg-white border border-t-0 border-b-0 border-blue-400 rounded-b-lg shadow-search md:mx-0"
                    >
                        <template
                            x-for="(result, index) in results"
                        >
                            <a
                                class="p-4 text-xl bg-white border-b border-blue-400 cursor-pointer hover:bg-blue-100"
                                :class="{ 'rounded-b-lg': (index === results.length - 1) }"
                                :href="result.item.url"
                                :title="result.item.title"
                                :key="result.item.url"
                                @mousedown.prevent
                            >
                                <span
                                    x-text="result.item.title || ''"
                                ></span>
                                <span
                                    class="block my-1 text-sm font-normal text-gray-700"
                                    x-html="result.item.description || ''"
                                ></span>
                            </a>
                        </template>

                        <div
                            x-show="results.length == 0"
                            class="w-full p-4 bg-white border-b border-blue-400 rounded-b-lg shadow cursor-pointer hover:bg-blue-100"
                        >
                            <p class="my-0">
                                No results for
                                <strong x-text="query"></strong>
                            </p>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    <script>
        function search()
        {
            return {
                fuse: null,
                searching: false,
                query: '',

                get results() {
                    let result = this.query
                        ? this.fuse.search(this.query)
                        : [];
                    console.log(result);
                    return result;
                },

                showInput: function () {
                    this.searching = true;
                    this.$nextTick(() => {
                        this.$refs.search.focus();
                    })
                },

                reset: function () {
                    this.query = '';
                    this.searching = false;
                },

                init: function () {
                    let url = new URL(window.location);

                    url.pathname = "index.json";
                    url.searchParams.set("t", Date.now());

                    if (window.location.port != 8000) {
                        url.pathname = "code-style-guide/" + url.pathname;
                    }

                    fetch(url.toString())
                        .then((response) => response.json())
                        .then((items) => {
                            console.log(items);
                            items = _.reject(
                                items,
                                function (item) {
                                    return item.title == null
                                        || item.title == undefined;
                                });
                            console.log(items[0].url);
                            this.fuse = new Fuse(items, {
                                keys: ["content", "title", "url"],
                                minMatchCharLength: 3,
                            });
                        })
                        .catch(console.error);

                },
            };
        }
    </script>

    <style>
        input[name='search'] {
            background-image: url('/assets/img/magnifying-glass.svg');
            background-position: 0.8em;
            background-repeat: no-repeat;
            border-radius: 25px;
            text-indent: 1.2em;
        }

        input[name='search'].transition-border {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            border-top-left-radius: .5rem;
            border-top-right-radius: .5rem;
        }

        .fade-enter-active {
            transition: opacity .5s;
        }

        .fade-leave-active {
            transition: opacity 0s;
        }

        .fade-enter,
        .fade-leave-to {
            opacity: 0;
        }
    </style>
</div>
