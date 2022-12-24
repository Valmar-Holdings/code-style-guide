---
title: Code Cleanliness
description: 
extends: _layouts.documentation
section: content
---
## Quotes

- use quotes (`"`) first, then apostrophes (`'`) if nesting
- HTML attributes should always use quotes, never apostrophes
- escape quotes when rendering HTML or similar inside quoted strings

  ```php
  $test = "<a href=\"test.html\">test</a>";
  ```

> #### Why
> - 👉 Quoted strings can be sorted.
> - 👉 Reduced mental load when reading code that has nested quotes.
> - 👉 Adherence to HTML5 standards.

## Conditionals

- use ternary operators instead of if statements where possible
- combine sequential conditions that have the same result
- use mapping arrays instead of multiple if-statements when inspecting different values of the same variable
- for conditions that consist of multiple conditions, place each condition on its own line with the operator preceding the condition

## Arrays

- always use data_get() to access arrays, instead of accessing their elements directly.
