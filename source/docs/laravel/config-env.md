---
title: Config & Environment
description: 
extends: _layouts.documentation
section: content
---
- Always assign env variables to config properties in the config file that is most appropriate (or create a new config file it that makes more sense).
- Always refer to the config variable in your code, never reference env('xxxxx', 'abc) outside of config files.

## .env

### ✅ Do

- store sensitive settings (passwords, API keys, etc.) in the .env file.

### ⛔️ Do Not

- commit the .env file to version control (Git).
- use the env() command outside of config files, as it calls the cached config values, and not the actual values in the .env file.
