---
theme: "docs.bootstrap"
layout: "markdown"
title: "Spinners"
subtitle: "Indicate the loading state of a component or page with Bootstrap spinners, built entirely with HTML, CSS, and no JavaScript."
breadcrumb:
    - "Docs"
---

## About
Bootstrap “spinners” can be used to show the loading state in your projects. They’re built only with HTML and CSS, meaning you don’t need any JavaScript to create them. You will, however, need some custom JavaScript to toggle their visibility. Their appearance, alignment, and sizing can be easily customized with our amazing utility classes.

For accessibility purposes, each loader here includes role="status" and a nested <span class="visually-hidden">Loading...</span>.

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.

## Border spinner
Use the border spinners for a lightweight loading indicator.

## Colors
The border spinner uses currentColor for its border-color, meaning you can customize the color with text color utilities. You can use any of our text color utilities on the standard spinner.

> Why not use border-color utilities? Each border spinner specifies a transparent border for at least one side, so .border-{color} utilities would override that.

## Growing spinner
If you don’t fancy a border spinner, switch to the grow spinner. While it doesn’t technically spin, it does repeatedly grow!

Once again, this spinner is built with currentColor, so you can easily change its appearance with text color utilities. Here it is in blue, along with the supported variants.

## Alignment
Spinners in Bootstrap are built with rems, currentColor, and display: inline-flex. This means they can easily be resized, recolored, and quickly aligned.

## Margin
Use margin utilities like .m-5 for easy spacing.

## Placement
Use flexbox utilities, float utilities, or text alignment utilities to place spinners exactly where you need them in any situation.


## Size
Add .spinner-border-sm and .spinner-grow-sm to make a smaller spinner that can quickly be used within other components.

Loading... Loading...

## Buttons
Use spinners within buttons to indicate an action is currently processing or taking place. You may also swap the text out of the spinner element and utilize button text as needed.

