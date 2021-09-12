---
theme: "docs.bootstrap"
layout: "markdown"
title: "Popovers"
subtitle: "Documentation and examples for adding Bootstrap popovers, like those found in iOS, to any element on your site."
breadcrumb:
    - "Docs"
---

## Overview
Things to know when using the popover plugin:

* Popovers rely on the 3rd party library Popper for positioning. You must include popper.min.js before bootstrap.js or use bootstrap.bundle.min.js / bootstrap.bundle.js which contains Popper in order for popovers to work!
* Popovers require the tooltip plugin as a dependency.
* Popovers are opt-in for performance reasons, so you must initialize them yourself.
* Zero-length title and content values will never show a popover.
* Specify container: 'body' to avoid rendering problems in more complex components (like our input groups, button groups, etc).
* Triggering popovers on hidden elements will not work.
* Popovers for .disabled or disabled elements must be triggered on a wrapper element.
* When triggered from anchors that wrap across multiple lines, popovers will be centered between the anchors' overall width. Use .text-nowrap on your `<a>`s to avoid this behavior.
* Popovers must be hidden before their corresponding elements have been removed from the DOM.
* Popovers can be triggered thanks to an element inside a shadow DOM.

> By default, this component uses the built-in content sanitizer, which strips out any HTML elements that are not explicitly allowed. See the sanitizer section in our JavaScript documentation for more details.

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.

Keep reading to see how popovers work with some examples.

## Example: Enable popovers everywhere
One way to initialize all popovers on a page would be to select them by their data-bs-toggle attribute:

## Example: Using the container option
When you have some styles on a parent element that interfere with a popover, you’ll want to specify a custom container so that the popover’s HTML appears within that element instead.

## Example

## Four directions
Four options are available: top, right, bottom, and left aligned. Directions are mirrored when using Bootstrap in RTL.

## Dismiss on next click
Use the focus trigger to dismiss popovers on the user’s next click of a different element than the toggle element.

> Specific markup required for dismiss-on-next-click
For proper cross-browser and cross-platform behavior, you must use the `<a>` tag, not the `<button>` tag, and you also must include a tabindex attribute.

## Disabled elements
Elements with the disabled attribute aren’t interactive, meaning users cannot hover or click them to trigger a popover (or tooltip). As a workaround, you’ll want to trigger the popover from a wrapper `<div>` or `<span>`, ideally made keyboard-focusable using tabindex="0".

For disabled popover triggers, you may also prefer data-bs-trigger="hover focus" so that the popover appears as immediate visual feedback to your users as they may not expect to click on a disabled element.


