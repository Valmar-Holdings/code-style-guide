---
title: Patterns
description: 
extends: _layouts.documentation
section: content
---
## NULL-Objects

Do not use null-objects as a substitute for using null for negative results (btw, don't use null anywhere in code, as it is semantically void). Instead, add a __toString() method that returns an empty string for empty models, and non-empty value for valid objects. For example:

```php
public function __toString()
{
    return "{$this->getPrimaryKey()}";
}
```

This has the following benefits:

- Less cluttered code by eliminating noisy null-object classes (which serve no other purpose than to eliminate null-checks).
- Ease of maintenance.
- Adherence to single responsibility principle, in that a method only returns a single type of data.

## DRY (Don't Repeat Yourself)

- Do not apply the dry principle to code that deals with content, or even content itself.
- Apply DRY only to code that deals with logic.
- If you find wet code, but it doesn't appear that it can be dried out, you might have an architectural flaw. Restructuring or refactoring your classes could help.
- Only start drying out your code if you actually have duplication.
- DO NOT dry out code that isn't duplicated, as this leads to premature abstraction, and is almost certain to introduce both mental and technical debt.

## SOLID

- TBD

## Collections

- Use collections for all the things.
- TBD Consider using classes as collection transformers:
- is there any intent to use more of magic method __invoke in future versions of Laravel? I found an interesting possibly to try things like: $collection->map(new MyModelTransformer());
