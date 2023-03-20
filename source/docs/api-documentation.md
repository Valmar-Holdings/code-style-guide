---
title: API Documentation
description: Guide to creating and updating API documentation.
extends: _layouts.documentation
section: content
updatedAt: 2023-03-20
---
## Setup & Configuration
1. [Download Stoplight Studio](https://stoplight.io/studio).
2. Create or login to your free account using your personal email address.
3. Create a **New Local Project** (important to not create a Git project) and give it a name, for example `Totality` or `CarQuant`. Do not check "Include tutorial files?"
4. Click the pink "API" button, set the name to `openapi.json`, set the version to `3.1`, set the format to `JSON`, and click the "Create" button.

## Editing
1. Copy the content from `/resources/docs/openapi.json` (in VSCode).
2. Open your Stoplight Studio project (if not already open).
3. Click the "</> Code" button at the top-right of the screen.
4. Highlight all code and replace it with the code you copied from step 1.
5. Click the "Form" button (next to the "</> Code" button).
6. Make any desired changes and resolve all errors.
7. Once done, toggle back to the code view, copy the entire code, and paste the code back into `/resources/docs/openapi.json` (in VSCode).
8. Run `cu` (composer update) in your terminal.
