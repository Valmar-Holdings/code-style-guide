---
title: Blade
description:
extends: _layouts.documentation
section: content
updatedAt: 2022-12-31
---
## Directives
- ✋ All blade directives should have a space between the directive and the parameters, mirroring the way PSR2 handles the equivalent PHP statements (if, for, etc.):

    ```php
        @errors ()
    ```

- ✋ Directives should be surrounded by blank lines, unless they are directly nested in other blade directives:

    ```php
        <div>

            @foreach ($items as $item)
                <div>

                    @foreach ($subItems as $subItem)
                        @can ("update", $subItem)
                            <div>Update</div>
                        @endcan
                    @endforeach

                </div>
            @endforeach

        </div>
    ```

## HTML

- ✋ Each HTML tag should be on its own line:

    ```html
    <h1>Header</h1>
    <span>test</span>
    <a>test</a>
    ```

- ✋ All attributes of an HTML tag should be on their own line, indented, and in alphabetical order:

    ```html
    <div
        class="p-0 m-0"
        wire:click="submit"
        x-data="{}"
    >
    ```
