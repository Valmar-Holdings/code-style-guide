<?php

use Illuminate\Support\Str;

return [
    "baseUrl" => "http://localhost:8000/",
    "production" => false,
    "siteName" => "Development Standards",
    "siteDescription" => "as practiced in Valmar Holdings",

    // navigation menu
    "navigation" => require_once("navigation.php"),

    // helpers
    "isActive" => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
    "isActiveParent" => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) === trimPath($child);
            });
        }
    },
    "url" => function ($page, $path) {
        return Str::startsWith($path, "http")
            ? $path
            : "/" . trimPath($path);
    },
    "build" => [
        "destination" => "docs",
    ],
];
