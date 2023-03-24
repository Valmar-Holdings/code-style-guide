---
title: Livewire
description:
extends: _layouts.documentation
section: content
updatedAt: 2023-03-24
---
## Components
- ✋ Each livewire component needs to have a wire:key attribute that is immutable across page refreshes, but unique enough so that it never will conflict with another livewire component.
- ✋ When calling a livewire component, it must be wrapped in an empty div to prevent DOM-diffing issues.
- ✋ Each livewire component must have a single root element (usually a div) with no Livewire or Alpine attributes.
