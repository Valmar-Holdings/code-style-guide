<?php

declare(strict_types=1);

use Illuminate\Support\Str;

return [
    "baseUrl" => "https://valmar-holdings.github.io/code-style-guide/",
    "production" => true,

    "url" => function ($page, $path) {
        return Str::startsWith($path, "http")
            ? $path
            : "https://valmar-holdings.github.io/code-style-guide/" . trimPath($path);
    },
];
