import Fuse from 'fuse.js/dist/fuse.basic.esm';
import hljs from 'highlight.js/lib/core';

window.search = {
    items: null,
    fuse: null,
    query: "",
    results: [],
    init() {
        let url = new URL(window.location);
        url.pathname = "index.json";
        url.searchParams.set("t", Date.now());

        fetch(url.toString())
            .then((response) => response.json())
            .then((items) => {
                this.items = items;

                this.fuse = new Fuse(this.items, {
                    includeScore: true,
                    minMatchCharLength: 3,
                    keys: ["content", "title"],
                });
            })
            .catch(console.error);
    },
    search() {
        if (this.fuse === null) {
            this.results = [];

            return false;
        }

        this.results = _(this.fuse.search(this.query))
            .orderBy("score", "desc")
            .take(3)
            .map((r) => r.item)
            .values();
    },
};

hljs.registerLanguage('bash', require('highlight.js/lib/languages/bash'));
hljs.registerLanguage('css', require('highlight.js/lib/languages/css'));
hljs.registerLanguage('html', require('highlight.js/lib/languages/xml'));
hljs.registerLanguage('javascript', require('highlight.js/lib/languages/javascript'));
hljs.registerLanguage('json', require('highlight.js/lib/languages/json'));
hljs.registerLanguage('markdown', require('highlight.js/lib/languages/markdown'));
hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
hljs.registerLanguage('scss', require('highlight.js/lib/languages/scss'));
hljs.registerLanguage('yaml', require('highlight.js/lib/languages/yaml'));

document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
});
