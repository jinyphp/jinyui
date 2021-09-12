---
theme: "docs.bootstrap"
layout: "markdown"
title: "Scrollspy"
subtitle: "Automatically update Bootstrap navigation or list group components based on scroll position to indicate which link is currently active in the viewport."
breadcrumb:
    - "Docs"
---

## How it works
Scrollspy has a few requirements to function properly:

It must be used on a Bootstrap nav component or list group.
Scrollspy requires position: relative; on the element you’re spying on, usually the <body>.
Anchors (<a>) are required and must point to an element with that id.
When successfully implemented, your nav or list group will update accordingly, moving the .active class from one item to the next based on their associated targets.

> Scrollable containers and keyboard access
If you’re making a scrollable container (other than the <body>), be sure to have a height set and overflow-y: scroll; applied to it—alongside a tabindex="0" to ensure keyboard access.

## Example in navbar
Scroll the area below the navbar and watch the active class change. The dropdown items will be highlighted as well.

## Example with nested nav
Scrollspy also works with nested .navs. If a nested .nav is .active, its parents will also be .active. Scroll the area next to the navbar and watch the active class change.

## Example with list-group
Scrollspy also works with .list-groups. Scroll the area next to the list group and watch the active class change.

