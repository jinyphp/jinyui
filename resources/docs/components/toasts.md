---
theme: "docs.bootstrap"
layout: "markdown"
title: "Toasts"
subtitle: "Push notifications to your visitors with a toast, a lightweight and easily customizable alert message."
breadcrumb:
    - "Docs"
---

Toasts are lightweight notifications designed to mimic the push notifications that have been popularized by mobile and desktop operating systems. They’re built with flexbox, so they’re easy to align and position.

## Overview
Things to know when using the toast plugin:

* Toasts are opt-in for performance reasons, so you must initialize them yourself.
* Toasts will automatically hide if you do not specify autohide: false.

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.


## Examples
### Basic
To encourage extensible and predictable toasts, we recommend a header and body. Toast headers use display: flex, allowing easy alignment of content thanks to our margin and flexbox utilities.

Toasts are as flexible as you need and have very little required markup. At a minimum, we require a single element to contain your “toasted” content and strongly encourage a dismiss button.

> Previously, our scripts dynamically added the .hide class to completely hide a toast (with display:none, rather than just with opacity:0). This is now not necessary anymore. However, for backwards compatibility, our script will continue to toggle the class (even though there is no practical need for it) until the next major version.

### Live example
Click the button below to show a toast (positioned with our utilities in the lower right corner) that has been hidden by default.


## Translucent
Toasts are slightly translucent to blend in with what’s below them.


## Stacking
You can stack toasts by wrapping them in a toast container, which will vertically add some spacing.

## Custom content
Customize your toasts by removing sub-components, tweaking them with utilities, or by adding your own markup. Here we’ve created a simpler toast by removing the default .toast-header, adding a custom hide icon from Bootstrap Icons, and using some flexbox utilities to adjust the layout.

## Color schemes
Building on the above example, you can create different toast color schemes with our color and background utilities. Here we’ve added .bg-primary and .text-white to the .toast, and then added .btn-close-white to our close button. For a crisp edge, we remove the default border with .border-0.

## Placement
Place toasts with custom CSS as you need them. The top right is often used for notifications, as is the top middle. If you’re only ever going to show one toast at a time, put the positioning styles right on the .toast.

## Accessibility
Toasts are intended to be small interruptions to your visitors or users, so to help those with screen readers and similar assistive technologies, you should wrap your toasts in an aria-live region. Changes to live regions (such as injecting/updating a toast component) are automatically announced by screen readers without needing to move the user’s focus or otherwise interrupt the user. Additionally, include aria-atomic="true" to ensure that the entire toast is always announced as a single (atomic) unit, rather than just announcing what was changed (which could lead to problems if you only update part of the toast’s content, or if displaying the same toast content at a later point in time). If the information needed is important for the process, e.g. for a list of errors in a form, then use the alert component instead of toast.

Note that the live region needs to be present in the markup before the toast is generated or updated. If you dynamically generate both at the same time and inject them into the page, they will generally not be announced by assistive technologies.

You also need to adapt the role and aria-live level depending on the content. If it’s an important message like an error, use role="alert" aria-live="assertive", otherwise use role="status" aria-live="polite" attributes.

As the content you’re displaying changes, be sure to update the delay timeout so that users have enough time to read the toast.