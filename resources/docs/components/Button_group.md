---
theme: "docs.bootstrap"
layout: "markdown"
title: "Button group"
subtitle: "Group a series of buttons together on a single line or stack them in a vertical column."
breadcrumb:
    - "Docs"
---

## Basic example
Wrap a series of buttons with .btn in .btn-group.

> Ensure correct role and provide a label
In order for assistive technologies (such as screen readers) to convey that a series of buttons is grouped, an appropriate role attribute needs to be provided. For button groups, this would be role="group", while toolbars should have a role="toolbar".

In addition, groups and toolbars should be given an explicit label, as most assistive technologies will otherwise not announce them, despite the presence of the correct role attribute. In the examples provided here, we use aria-label, but alternatives such as aria-labelledby can also be used.

These classes can also be added to groups of links, as an alternative to the .nav navigation components.

## Mixed styles


## Outlined styles

## Checkbox and radio button groups
Combine button-like checkbox and radio toggle buttons into a seamless looking button group.

## Button toolbar
Combine sets of button groups into button toolbars for more complex components. Use utility classes as needed to space out groups, buttons, and more.

## Sizing
Instead of applying button sizing classes to every button in a group, just add .btn-group-* to each .btn-group, including each one when nesting multiple groups.

## Nesting
Place a .btn-group within another .btn-group when you want dropdown menus mixed with a series of buttons.

## Vertical variation
Make a set of buttons appear vertically stacked rather than horizontally. Split button dropdowns are not supported here.