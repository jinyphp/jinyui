---
theme: "docs.bootstrap"
layout: "markdown"
title: "Dropdowns"
subtitle: "Toggle contextual overlays for displaying lists of links and more with the Bootstrap dropdown plugin."
breadcrumb:
    - "Docs"
---

## Overview
Dropdowns are toggleable, contextual overlays for displaying lists of links and more. They’re made interactive with the included Bootstrap dropdown JavaScript plugin. They’re toggled by clicking, not by hovering; this is an intentional design decision.

Dropdowns are built on a third party library, Popper, which provides dynamic positioning and viewport detection. Be sure to include popper.min.js before Bootstrap’s JavaScript or use bootstrap.bundle.min.js / bootstrap.bundle.js which contains Popper. Popper isn’t used to position dropdowns in navbars though as dynamic positioning isn’t required.

## Accessibility
The WAI ARIA standard defines an actual role="menu" widget, but this is specific to application-like menus which trigger actions or functions. ARIA menus can only contain menu items, checkbox menu items, radio button menu items, radio button groups, and sub-menus.

Bootstrap’s dropdowns, on the other hand, are designed to be generic and applicable to a variety of situations and markup structures. For instance, it is possible to create dropdowns that contain additional inputs and form controls, such as search fields or login forms. For this reason, Bootstrap does not expect (nor automatically add) any of the role and aria- attributes required for true ARIA menus. Authors will have to include these more specific attributes themselves.

However, Bootstrap does add built-in support for most standard keyboard menu interactions, such as the ability to move through individual .dropdown-item elements using the cursor keys and close the menu with the ESC key.

## Examples
Wrap the dropdown’s toggle (your button or link) and the dropdown menu within .dropdown, or another element that declares position: relative;. Dropdowns can be triggered from `<a>` or `<button>` elements to better fit your potential needs. The examples shown here use semantic `<ul>` elements where appropriate, but custom markup is supported.

## Single button
Any single .btn can be turned into a dropdown toggle with some markup changes. Here’s how you can put them to work with either `<button>` elements:

## Split button
Similarly, create split button dropdowns with virtually the same markup as single button dropdowns, but with the addition of .dropdown-toggle-split for proper spacing around the dropdown caret.

We use this extra class to reduce the horizontal padding on either side of the caret by 25% and remove the margin-left that’s added for regular button dropdowns. Those extra changes keep the caret centered in the split button and provide a more appropriately sized hit area next to the main button.

## Sizing
Button dropdowns work with buttons of all sizes, including default and split dropdown buttons.

## Dark dropdowns
Opt into darker dropdowns to match a dark navbar or custom style by adding .dropdown-menu-dark onto an existing .dropdown-menu. No changes are required to the dropdown items.

## Directions
> RTL
Directions are mirrored when using Bootstrap in RTL, meaning .dropstart will appear on the right side.

## Dropup
Trigger dropdown menus above elements by adding .dropup to the parent element.

## Dropright
Trigger dropdown menus at the right of the elements by adding .dropend to the parent element.

## Dropleft
Trigger dropdown menus at the left of the elements by adding .dropstart to the parent element.

## Menu items
You can use `<a>` or `<button>` elements as dropdown items.

## Active
Add .active to items in the dropdown to style them as active. To convey the active state to assistive technologies, use the aria-current attribute — using the page value for the current page, or true for the current item in a set.

## Disabled
Add .disabled to items in the dropdown to style them as disabled.

## Menu alignment
By default, a dropdown menu is automatically positioned 100% from the top and along the left side of its parent. You can change this with the directional .drop* classes, but you can also control them with additional modifier classes.

Add .dropdown-menu-end to a .dropdown-menu to right align the dropdown menu. Directions are mirrored when using Bootstrap in RTL, meaning .dropdown-menu-end will appear on the left side.

> Heads up! Dropdowns are positioned thanks to Popper except when they are contained in a navbar.

## Responsive alignment
If you want to use responsive alignment, disable dynamic positioning by adding the data-bs-display="static" attribute and use the responsive variation classes.

To align right the dropdown menu with the given breakpoint or larger, add .dropdown-menu{-sm|-md|-lg|-xl|-xxl}-end.

## Alignment options
Taking most of the options shown above, here’s a small kitchen sink demo of various dropdown alignment options in one place.

## Menu content
### Header
Add a header to label sections of actions in any dropdown menu.

### Dividers
Separate groups of related menu items with a divider.

### Text
Place any freeform text within a dropdown menu with text and use spacing utilities. Note that you’ll likely need additional sizing styles to constrain the menu width.

## Forms
Put a form within a dropdown menu, or make it into a dropdown menu, and use margin or padding utilities to give it the negative space you require.

## Dropdown options
Use data-bs-offset or data-bs-reference to change the location of the dropdown.


## Auto close behavior
By default, the dropdown menu is closed when clicking inside or outside the dropdown menu. You can use the autoClose option to change this behavior of the dropdown.








