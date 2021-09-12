---
theme: "docs.bootstrap"
layout: "markdown"
title: "Navs and tabs"
subtitle: "Documentation and examples for how to use Bootstrap’s included navigation components."
breadcrumb:
    - "Docs"
---

## Base nav
Navigation available in Bootstrap share general markup and styles, from the base .nav class to the active and disabled states. Swap modifier classes to switch between each style.

The base .nav component is built with flexbox and provide a strong foundation for building all types of navigation components. It includes some style overrides (for working with lists), some link padding for larger hit areas, and basic disabled styling.

> The base .nav component does not include any .active state. The following examples include the class, mainly to demonstrate that this particular class does not trigger any special styling.

To convey the active state to assistive technologies, use the aria-current attribute — using the page value for current page, or true for the current item in a set.

Classes are used throughout, so your markup can be super flexible. Use `<ul>`s like above, `<ol>` if the order of your items is important, or roll your own with a `<nav>` element. Because the .nav uses display: flex, the nav links behave the same as nav items would, but without the extra markup.


## Available styles
Change the style of .navs component with modifiers and utilities. Mix and match as needed, or build your own.

## Horizontal alignment
Change the horizontal alignment of your nav with flexbox utilities. By default, navs are left-aligned, but you can easily change them to center or right aligned.

Centered with .justify-content-center:

Right-aligned with .justify-content-end:

## Vertical
Stack your navigation by changing the flex item direction with the .flex-column utility. Need to stack them on some viewports but not others? Use the responsive versions (e.g., .flex-sm-column).

As always, vertical navigation is possible without `<ul>`s, too.

## Tabs
Takes the basic nav from above and adds the .nav-tabs class to generate a tabbed interface. Use them to create tabbable regions with our tab JavaScript plugin.

## Pills
Take that same HTML, but use .nav-pills instead:

## Fill and justify
Force your .nav’s contents to extend the full available width one of two modifier classes. To proportionately fill all available space with your .nav-items, use .nav-fill. Notice that all horizontal space is occupied, but not every nav item has the same width.

When using a `<nav>`-based navigation, you can safely omit .nav-item as only .nav-link is required for styling `<a>` elements.

For equal-width elements, use .nav-justified. All horizontal space will be occupied by nav links, but unlike the .nav-fill above, every nav item will be the same width.

Similar to the .nav-fill example using a `<nav>`-based navigation.

## Working with flex utilities
If you need responsive nav variations, consider using a series of flexbox utilities. While more verbose, these utilities offer greater customization across responsive breakpoints. In the example below, our nav will be stacked on the lowest breakpoint, then adapt to a horizontal layout that fills the available width starting from the small breakpoint.

## Regarding accessibility
If you’re using navs to provide a navigation bar, be sure to add a role="navigation" to the most logical parent container of the `<ul>`, or wrap a `<nav>` element around the whole navigation. Do not add the role to the `<ul>` itself, as this would prevent it from being announced as an actual list by assistive technologies.

Note that navigation bars, even if visually styled as tabs with the .nav-tabs class, should not be given role="tablist", role="tab" or role="tabpanel" attributes. These are only appropriate for dynamic tabbed interfaces, as described in the WAI ARIA Authoring Practices. See JavaScript behavior for dynamic tabbed interfaces in this section for an example. The aria-current attribute is not necessary on dynamic tabbed interfaces since our JavaScript handles the selected state by adding aria-selected="true" on the active tab.

## Using dropdowns
Add dropdown menus with a little extra HTML and the dropdowns JavaScript plugin.

### Tabs with dropdowns

### Pills with dropdowns

