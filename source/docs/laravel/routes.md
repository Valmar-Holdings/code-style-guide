---
title: Routes
description: 
extends: _layouts.documentation
section: content
---
## ✅ Do

- use resource routes that point to controllers whenever possible.

## ⛔️ Do Not

- use closures in routes, as they cannot be cached in `php artisan route:cache`.

## APIs

- API routes should be within an `API` route namespace.
- API routes should use resource controllers: [https://laravel.com/docs/5.2/controllers#restful-resource-controllers](https://laravel.com/docs/5.2/controllers#restful-resource-controllers).
- API route controllers should be named after the model they act on.
- API route controller methods should implement the restful naming scheme.
- API route controllers should only be responsible for a single model.

## Views

- View routes should have no namespace.
- View routes should use implicit controllers: [https://laravel.com/docs/5.1/controllers#implicit-controllers](https://laravel.com/docs/5.1/controllers#implicit-controllers).
- View route controllers should be named after the blade view folder they are responsible for.
- View route controller methods should be named after the action they are responsible for.
- View route controllers should only be responsible for a single view type, but responsible for all sub-views, like:
  - /resources/views/reports/index.blade.php
  - /resources/views/reports/create.blade.php
  - /resources/views/reports/show.blade.php
  - etc...
