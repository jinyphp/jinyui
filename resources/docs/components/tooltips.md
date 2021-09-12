---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tooltips"
subtitle: "Documentation and examples for adding custom Bootstrap tooltips with CSS and JavaScript using CSS3 for animations and data-bs-attributes for local title storage."
breadcrumb:
    - "Docs"
---

## Overview
Things to know when using the tooltip plugin:

* Tooltips rely on the 3rd party library Popper for positioning. You must include popper.min.js before bootstrap.js or use bootstrap.bundle.min.js / bootstrap.bundle.js which contains Popper in order for tooltips to work!
* Tooltips are opt-in for performance reasons, so you must initialize them yourself.
* Tooltips with zero-length titles are never displayed.
* Specify container: 'body' to avoid rendering problems in more complex components (like our input groups, button groups, etc).
* Triggering tooltips on hidden elements will not work.
* Tooltips for .disabled or disabled elements must be triggered on a wrapper element.
* When triggered from hyperlinks that span multiple lines, tooltips will be centered. Use white-space: nowrap; on your <a>s to avoid this behavior.
* Tooltips must be hidden before their corresponding elements have been removed from the DOM.
* Tooltips can be triggered thanks to an element inside a shadow DOM.

> By default, this component uses the built-in content sanitizer, which strips out any HTML elements that are not explicitly allowed. See the sanitizer section in our JavaScript documentation for more details.

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.

Got all that? Great, let’s see how they work with some examples.

## Example: Enable tooltips everywhere
One way to initialize all tooltips on a page would be to select them by their data-bs-toggle attribute:

## Examples
Hover over the links below to see tooltips:

Hover over the buttons below to see the four tooltips directions: top, right, bottom, and left. Directions are mirrored when using Bootstrap in RTL.