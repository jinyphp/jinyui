---
theme: "docs.bootstrap"
layout: "markdown"
title: "Offcanvas"
subtitle: "Build hidden sidebars into your project for navigation, shopping carts, and more with a few classes and our JavaScript plugin."
breadcrumb:
    - "Docs"
---

## How it works
Offcanvas is a sidebar component that can be toggled via JavaScript to appear from the left, right, or bottom edge of the viewport. Buttons or anchors are used as triggers that are attached to specific elements you toggle, and data attributes are used to invoke our JavaScript.

* Offcanvas shares some of the same JavaScript code as modals. Conceptually, they are quite similar, but they are separate plugins.
* Similarly, some source Sass variables for offcanvas’s styles and dimensions are inherited from the modal’s variables.
* When shown, offcanvas includes a default backdrop that can be clicked to hide the offcanvas.
* Similar to modals, only one offcanvas can be shown at a time.

Heads up! Given how CSS handles animations, you cannot use margin or translate on an .offcanvas element. Instead, use the class as an independent wrapping element.

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.


## Examples

### Offcanvas components
Below is an offcanvas example that is shown by default (via .show on .offcanvas). Offcanvas includes support for a header with a close button and an optional body class for some initial padding. We suggest that you include offcanvas headers with dismiss actions whenever possible, or provide an explicit dismiss action.

## Live demo
Use the buttons below to show and hide an offcanvas element via JavaScript that toggles the .show class on an element with the .offcanvas class.

.offcanvas hides content (default)
.offcanvas.show shows content
You can use a link with the href attribute, or a button with the data-bs-target attribute. In both cases, the data-bs-toggle="offcanvas" is required.

## Placement
There’s no default placement for offcanvas components, so you must add one of the modifier classes below;

.offcanvas-start places offcanvas on the left of the viewport (shown above)
.offcanvas-end places offcanvas on the right of the viewport
.offcanvas-top places offcanvas on the top of the viewport
.offcanvas-bottom places offcanvas on the bottom of the viewport
Try the top, right, and bottom examples out below.

## Backdrop
Scrolling the `<body>` element is disabled when an offcanvas and its backdrop are visible. Use the data-bs-scroll attribute to toggle `<body>` scrolling and data-bs-backdrop to toggle the backdrop.

## Accessibility
Since the offcanvas panel is conceptually a modal dialog, be sure to add aria-labelledby="..."—referencing the offcanvas title—to .offcanvas. Note that you don’t need to add role="dialog" since we already add it via JavaScript.








