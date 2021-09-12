---
theme: "docs.bootstrap"
layout: "markdown"
title: "Breadcrumb"
subtitle: "Indicate the current page’s location within a navigational hierarchy that automatically adds separators via CSS."
breadcrumb:
    - "Docs"
---

## Example
Use an ordered or unordered list with linked list items to create a minimally styled breadcrumb. Use our utilities to add additional styles as desired.

## Dividers
Dividers are automatically added in CSS through ::before and content. They can be changed by modifying a local CSS custom property --bs-breadcrumb-divider, or through the $breadcrumb-divider Sass variable — and $breadcrumb-divider-flipped for its RTL counterpart, if needed. We default to our Sass variable, which is set as a fallback to the custom property. This way, you get a global divider that you can override without recompiling CSS at any time.

## Accessibility
Since breadcrumbs provide a navigation, it’s a good idea to add a meaningful label such as aria-label="breadcrumb" to describe the type of navigation provided in the <nav> element, as well as applying an aria-current="page" to the last item of the set to indicate that it represents the current page.

For more information, see the WAI-ARIA Authoring Practices for the breadcrumb pattern.

## Sass
