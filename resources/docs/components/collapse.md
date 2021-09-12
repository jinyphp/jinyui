---
theme: "docs.bootstrap"
layout: "markdown"
title: "Collapse"
subtitle: "Toggle the visibility of content across your project with a few classes and our JavaScript plugins."
breadcrumb:
    - "Docs"
---

## How it works
The collapse JavaScript plugin is used to show and hide content. Buttons or anchors are used as triggers that are mapped to specific elements you toggle. Collapsing an element will animate the height from its current value to 0. Given how CSS handles animations, you cannot use padding on a .collapse element. Instead, use the class as an independent wrapping element.

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.


## Example
Click the buttons below to show and hide another element via class changes:

* .collapse hides content
* .collapsing is applied during transitions
* .collapse.show shows content
Generally, we recommend using a button with the data-bs-target attribute. While not recommended from a semantic point of view, you can also use a link with the href attribute (and a role="button"). In both cases, the data-bs-toggle="collapse" is required.


## Horizontal
The collapse plugin also supports horizontal collapsing. Add the .collapse-horizontal modifier class to transition the width instead of height and set a width on the immediate child element. Feel free to write your own custom Sass, use inline styles, or use our width utilities.

> Please note that while the example below has a min-height set to avoid excessive repaints in our docs, this is not explicitly required. Only the width on the child element is required.

## Multiple targets
A `<button>` or `<a>` can show and hide multiple elements by referencing them with a selector in its href or data-bs-target attribute. Multiple `<button>` or `<a>` can show and hide an element if they each reference it with their href or data-bs-target attribute

## Accessibility
Be sure to add aria-expanded to the control element. This attribute explicitly conveys the current state of the collapsible element tied to the control to screen readers and similar assistive technologies. If the collapsible element is closed by default, the attribute on the control element should have a value of aria-expanded="false". If you’ve set the collapsible element to be open by default using the show class, set aria-expanded="true" on the control instead. The plugin will automatically toggle this attribute on the control based on whether or not the collapsible element has been opened or closed (via JavaScript, or because the user triggered another control element also tied to the same collapsible element). If the control element’s HTML element is not a button (e.g., an <a> or <div>), the attribute role="button" should be added to the element.

If your control element is targeting a single collapsible element – i.e. the data-bs-target attribute is pointing to an id selector – you should add the aria-controls attribute to the control element, containing the id of the collapsible element. Modern screen readers and similar assistive technologies make use of this attribute to provide users with additional shortcuts to navigate directly to the collapsible element itself.

Note that Bootstrap’s current implementation does not cover the various optional keyboard interactions described in the WAI-ARIA Authoring Practices 1.1 accordion pattern - you will need to include these yourself with custom JavaScript.




