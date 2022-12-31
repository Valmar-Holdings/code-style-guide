---
title: Routes
description:
extends: _layouts.documentation
section: content
updatedAt: 2022-12-31
---

#### ✅ Do
- ✋ use resource routes that point to controllers.

#### ⛔️ Do Not
- ✋ use closures in routes, as they cannot be cached in `php artisan route:cache`.

## APIs
- ✋ API routes should be within an `API` route namespace.
- ✋ API routes should use resource controllers.
- ✋ API route controllers should be named after the model they act on.
- ✋ API route controller methods should implement the restful naming scheme.
- ✋ API route controllers should only be responsible for a single model.

## Views
- ✋ View routes should have no namespace.
- ✋ View routes should use resource controllers.
- ✋ View route controllers should be named after the blade view folder they are responsible for.
- ✋ View route controller methods should implement the restful naming scheme.
- ✋ View route controllers should only be responsible for a single model, but responsible for all views that pertain to that model, for example:
  - /resources/views/reports/index.blade.php
  - /resources/views/reports/create.blade.php
  - /resources/views/reports/show.blade.php
  - etc...
