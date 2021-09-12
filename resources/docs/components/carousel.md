---
theme: "docs.bootstrap"
layout: "markdown"
title: "Carousel"
subtitle: "A slideshow component for cycling through elements—images or slides of text—like a carousel."
breadcrumb:
    - "Docs"
---

## How it works
The carousel is a slideshow for cycling through a series of content, built with CSS 3D transforms and a bit of JavaScript. It works with a series of images, text, or custom markup. It also includes support for previous/next controls and indicators.

In browsers where the Page Visibility API is supported, the carousel will avoid sliding when the webpage is not visible to the user (such as when the browser tab is inactive, the browser window is minimized, etc.).

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.

Please be aware that nested carousels are not supported, and carousels are generally not compliant with accessibility standards.

## Example
Carousels don’t automatically normalize slide dimensions. As such, you may need to use additional utilities or custom styles to appropriately size content. While carousels support previous/next controls and indicators, they’re not explicitly required. Add and customize as you see fit.

The .active class needs to be added to one of the slides otherwise the carousel will not be visible. Also be sure to set a unique id on the .carousel for optional controls, especially if you’re using multiple carousels on a single page. Control and indicator elements must have a data-bs-target attribute (or href for links) that matches the id of the .carousel element.

## Slides only
Here’s a carousel with slides only. Note the presence of the .d-block and .w-100 on carousel images to prevent browser default image alignment.

## With controls
Adding in the previous and next controls. We recommend using <button> elements, but you can also use <a> elements with role="button".

## With indicators
You can also add the indicators to the carousel, alongside the controls, too.

## With captions
Add captions to your slides easily with the .carousel-caption element within any .carousel-item. They can be easily hidden on smaller viewports, as shown below, with optional display utilities. We hide them initially with .d-none and bring them back on medium-sized devices with .d-md-block.

## Crossfade
Add .carousel-fade to your carousel to animate slides with a fade transition instead of a slide.

## Individual .carousel-item interval
Add data-bs-interval="" to a .carousel-item to change the amount of time to delay between automatically cycling to the next item.

## Disable touch swiping
Carousels support swiping left/right on touchscreen devices to move between slides. This can be disabled using the data-bs-touch attribute. The example below also does not include the data-bs-ride attribute and has data-bs-interval="false" so it doesn’t autoplay.

## Dark variant
Add .carousel-dark to the .carousel for darker controls, indicators, and captions. Controls have been inverted from their default white fill with the filter CSS property. Captions and controls have additional Sass variables that customize the color and background-color.

## Custom transition
The transition duration of .carousel-item can be changed with the $carousel-transition-duration Sass variable before compiling or custom styles if you’re using the compiled CSS. If multiple transitions are applied, make sure the transform transition is defined first (eg. transition: transform 2s ease, opacity .5s ease-out).

## Sass

