---
theme: "docs.bootstrap"
layout: "markdown"
title: "Placeholders"
subtitle: "Use loading placeholders for your components or pages to indicate something may still be loading."
breadcrumb:
    - "Docs"
---

## About
Placeholders can be used to enhance the experience of your application. They’re built only with HTML and CSS, meaning you don’t need any JavaScript to create them. You will, however, need some custom JavaScript to toggle their visibility. Their appearance, color, and sizing can be easily customized with our utility classes.

## Example
In the example below, we take a typical card component and recreate it with placeholders applied to create a “loading card”. Size and proportions are the same between the two.

## How it works
Create placeholders with the .placeholder class and a grid column class (e.g., .col-6) to set the width. They can replace the text inside an element or be added as a modifier class to an existing component.

We apply additional styling to .btns via ::before to ensure the height is respected. You may extend this pattern for other situations as needed, or add a &nbsp; within the element to reflect the height when actual text is rendered in its place.

> The use of aria-hidden="true" only indicates that the element should be hidden to screen readers. The loading behavior of the placeholder depends on how authors will actually use the placeholder styles, how they plan to update things, etc. Some JavasSript code may be needed to swap the state of the placeholder and inform AT users of the update.

## Width
You can change the width through grid column classes, width utilities, or inline styles.

## Color
By default, the placeholder uses currentColor. This can be overridden with a custom color or utility class.

## Sizing
The size of .placeholders are based on the typographic style of the parent element. Customize them with sizing modifiers: .placeholder-lg, .placeholder-sm, or .placeholder-xs.

## Animation
Animate placeholders with .placeholder-glow or .placeholder-wave to better convey the perception of something being actively loaded.



