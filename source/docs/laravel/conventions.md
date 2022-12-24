---
title: Conventions
description: 
extends: _layouts.documentation
section: content
---
This file will be for brain-dumping rules that will later be sorted and broken out to one of the other pages where it fits in. This page will allow me to gather rules as we perform reviews and make sure they are documented.

- Try to avoid conditionals where possible (they increase cyclomatic complexity, which in turn increases mental and technical debt).
- 🏁 Never use `else` or `elseif` if you end up using a conditional.
- One alternative to conditionals is interpolation.
- Try to keep all code within the 80 character per line soft-limit.
- Absolutely always keep all code under 120 characters per line. However, exceeding 80 characters can be an indication of too deeply indented code. Consider refactoring out to one or more methods.
- Adhere to coding styles set forth in phpcs.xml, no exceptions.
- Code should not have any PHPMD, PHPCS, and PHPCPD warnings. (TBD Try not to customize the rule sets, if at all possible.)

## Operators

- 🏁 all operators should be surrounded by 1 space, with the exception of operators at the beginning of the statement, such as the notoperator, in which case it does not have a preceding space:

  ```php
  if (! $test) {
  ```

- 👀 if there is only a single condition in an if-statement, keep the if-statement condition portion on a single line, do not place the condition on its own line.
- 🏁 do not use inline if-statements.

## Blade

- empty lines around blade directives
- html attributes on their own lines, even if there is only one
