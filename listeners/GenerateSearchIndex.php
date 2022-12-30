<?php

declare(strict_types=1);

namespace App\Listeners;

use Illuminate\Support\Str;
use TightenCo\Jigsaw\Jigsaw;
use Illuminate\Support\Carbon;
use TightenCo\Jigsaw\PageVariable;

class GenerateSearchIndex
{
    public function handle(Jigsaw $jigsaw): void
    {
        $data = $jigsaw
            ->getPages()
            ->reject(function (PageVariable $page, string $path): bool {
                return Str::contains($path, "/assets/")
                    || Str::contains($path, "favicon");
            })
            ->map(function (PageVariable $page, string $path) use ($jigsaw): array {
                $content = file_get_contents(__DIR__ . "/../{$page->build->destination}{$path}/index.html");
                $content = preg_replace('/<script(.*?)>(.*?)<\/script>/is', "", $content);
                $content = preg_replace('/<style(.*?)>(.*?)<\/style>/is', "", $content);
                $content = Str::replace("\n", " ", strip_tags($content));
                $content = trim(preg_replace('/[ ]+/', " ", $content));

                return [
                    "categories" => $page->categories,
                    "content" => trim($content),
                    "date" => $page->getModifiedTime()
                        ? (new Carbon)->parse($page->getModifiedTime())->format("M jS, Y")
                        : null,
                    "url" => rightTrimPath($jigsaw->getConfig('baseUrl')) . $page->getPath(),
                    "title" => $page->getTitle,
                ];
            })
            ->values();

        file_put_contents($jigsaw->getDestinationPath() . '/index.json', json_encode($data));
    }
}
