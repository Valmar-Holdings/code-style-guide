---
title: Code Cleanliness
description:
extends: _layouts.documentation
section: content
updatedAt: 2022-12-31
---
- ✋ Try to avoid conditionals where possible (they increase cyclomatic complexity, which in turn increases mental and technical debt).
- Never use `else` or `elseif` if you end up using a conditional.
- ✋ One alternative to conditionals is interpolation.
- Keep all code within the 80 character per line limit, except for blade files.
- Absolutely always keep all code under 120 characters per line. However, exceeding 80 characters can be an indication of too deeply indented code. Consider refactoring out to one or more methods.
- Adhere to coding styles set forth in phpcs.xml, no exceptions.
- Code should not have any PHPMD, PHPCS, and PHPCPD warnings. (TBD Try not to customize the rule sets, if at all possible.)
- ✋ Use `php artisan:make` to create new objects, as these will have customized stubs that conform to our style guide.

## Operators

- all operators should be surrounded by 1 space, with the exception of operators at the beginning of the statement, such as the notoperator, in which case it does not have a preceding space:

  ```php
  if (! $test) {
  ```

- ✋ if there is only a single condition in an if-statement, keep the if-statement condition portion on a single line, do not place the condition on its own line.
- do not use inline if-statements.

## Type Hinting & Return Types
- Type hint all method parameters and return values.
- Type hints serve as documentation, making the code more fluent and readable.
- Type hints and return types prevent some logic errors from propagating, catching them as close as possible to their source.

## Quotes
- ✋ use quotes (`"`) first, then apostrophes (`'`) if nesting
- ✋ HTML attributes should always use quotes, never apostrophes
- ✋ escape quotes when rendering HTML or similar inside quoted strings:

  ```php
  $test = "<a href=\"test.html\">test</a>";
  ```

> #### Why
> - 👉 Quoted strings can be sorted.
> - 👉 Reduced mental load when reading code that has nested quotes.
> - 👉 Adherence to HTML5 standards.

## Conditionals
- use ternary operators instead of if statements where possible
- ✋ combine sequential conditions that have the same result
- ✋ use mapping arrays instead of multiple if-statements when inspecting different values of the same variable
- ✋ for conditions that consist of multiple conditions, place each condition on its own line with the operator preceding the condition

## Arrays
- ✋ always use data_get() to access arrays, instead of accessing their elements directly.
