<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => 'https://valmar-holdings.github.io/code-style-guide/',
    'production' => true,

    // DocSearch credentials
    'docsearchApiKey' => env('DOCSEARCH_KEY'),
    'docsearchIndexName' => env('DOCSEARCH_INDEX'),

    'url' => function ($page, $path) {
        return Str::startsWith($path, 'http')
            ? $path
            : '/code-style-guide/' . trimPath($path);
    },
];
