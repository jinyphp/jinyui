---
theme: "docs.bootstrap"
layout: "markdown"
title: "Progress"
subtitle: "Documentation and examples for using Bootstrap custom progress bars featuring support for stacked bars, animated backgrounds, and text labels."
breadcrumb:
    - "Docs"
---

## How it works
Progress components are built with two HTML elements, some CSS to set the width, and a few attributes. We don’t use the HTML5 <progress> element, ensuring you can stack progress bars, animate them, and place text labels over them.

* We use the .progress as a wrapper to indicate the max value of the progress bar.
* We use the inner .progress-bar to indicate the progress so far.
* The .progress-bar requires an inline style, utility class, or custom CSS to set their width.
* The .progress-bar also requires some role and aria attributes to make it accessible.

Put that all together, and you have the following examples.

Bootstrap provides a handful of utilities for setting width. Depending on your needs, these may help with quickly configuring progress.

## Labels
Add labels to your progress bars by placing text within the .progress-bar.

## Height
We only set a height value on the .progress, so if you change that value the inner .progress-bar will automatically resize accordingly.

## Backgrounds
Use background utility classes to change the appearance of individual progress bars.

## Multiple bars
Include multiple progress bars in a progress component if you need.

## Striped
Add .progress-bar-striped to any .progress-bar to apply a stripe via CSS gradient over the progress bar’s background color.

## Animated stripes
The striped gradient can also be animated. Add .progress-bar-animated to .progress-bar to animate the stripes right to left via CSS3 animations.


