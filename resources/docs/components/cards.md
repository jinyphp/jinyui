---
theme: "docs.bootstrap"
layout: "markdown"
title: "Cards"
subtitle: "Bootstrap’s cards provide a flexible and extensible content container with multiple variants and options."
breadcrumb:
    - "Docs"
---

## About
A card is a flexible and extensible content container. It includes options for headers and footers, a wide variety of content, contextual background colors, and powerful display options. If you’re familiar with Bootstrap 3, cards replace our old panels, wells, and thumbnails. Similar functionality to those components is available as modifier classes for cards.

## Example
Cards are built with as little markup and styles as possible, but still manage to deliver a ton of control and customization. Built with flexbox, they offer easy alignment and mix well with other Bootstrap components. They have no margin by default, so use spacing utilities as needed.

Below is an example of a basic card with mixed content and a fixed width. Cards have no fixed width to start, so they’ll naturally fill the full width of its parent element. This is easily customized with our various sizing options.

## Content types
Cards support a wide variety of content, including images, text, list groups, links, and more. Below are examples of what’s supported.

## Body
The building block of a card is the .card-body. Use it whenever you need a padded section within a card.

## Titles, text, and links
Card titles are used by adding .card-title to a `<h*>` tag. In the same way, links are added and placed next to each other by adding .card-link to an `<a>` tag.

Subtitles are used by adding a .card-subtitle to a `<h*>` tag. If the .card-title and the .card-subtitle items are placed in a .card-body item, the card title and subtitle are aligned nicely.

## Images
.card-img-top places an image to the top of the card. With .card-text, text can be added to the card. Text within .card-text can also be styled with the standard HTML tags.

## List groups
Create lists of content in a card with a flush list group.

## Kitchen sink
Mix and match multiple content types to create the card you need, or throw everything in there. Shown below are image styles, blocks, text styles, and a list group—all wrapped in a fixed-width card.

## Header and footer
Add an optional header and/or footer within a card.

Card headers can be styled by adding .card-header to `<h*>` elements.

## Sizing
Cards assume no specific width to start, so they’ll be 100% wide unless otherwise stated. You can change this as needed with custom CSS, grid classes, grid Sass mixins, or utilities.

## Using grid markup
Using the grid, wrap cards in columns and rows as needed.

## Using utilities
Use our handful of available sizing utilities to quickly set a card’s width.

## Using custom CSS
Use custom CSS in your stylesheets or as inline styles to set a width.

## Text alignment
You can quickly change the text alignment of any card—in its entirety or specific parts—with our text align classes.

## Navigation
Add some navigation to a card’s header (or block) with Bootstrap’s nav components.


## Images
Cards include a few options for working with images. Choose from appending “image caps” at either end of a card, overlaying images with card content, or simply embedding the image in a card.

### Image caps
Similar to headers and footers, cards can include top and bottom “image caps”—images at the top or bottom of a card.

### Image overlays
Turn an image into a card background and overlay your card’s text. Depending on the image, you may or may not need additional styles or utilities.

> Note that content should not be larger than the height of the image. If content is larger than the image the content will be displayed outside the image.

## Horizontal
Using a combination of grid and utility classes, cards can be made horizontal in a mobile-friendly and responsive way. In the example below, we remove the grid gutters with .g-0 and use .col-md-* classes to make the card horizontal at the md breakpoint. Further adjustments may be needed depending on your card content.

## Card styles
Cards include various options for customizing their backgrounds, borders, and color.

### Background and color
Use text color and background utilities to change the appearance of a card.

> Conveying meaning to assistive technologies
Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the .visually-hidden class.

## Border
Use border utilities to change just the border-color of a card. Note that you can put .text-{color} classes on the parent .card or a subset of the card’s contents as shown below.

## Mixins utilities
You can also change the borders on the card header and footer as needed, and even remove their background-color with .bg-transparent.

## Card layout
In addition to styling the content within cards, Bootstrap includes a few options for laying out series of cards. For the time being, these layout options are not yet responsive.

### Card groups
Use card groups to render cards as a single, attached element with equal width and height columns. Card groups start off stacked and use display: flex; to become attached with uniform dimensions starting at the sm breakpoint.

When using card groups with footers, their content will automatically line up.

### Grid cards
Use the Bootstrap grid system and its .row-cols classes to control how many grid columns (wrapped around your cards) you show per row. For example, here’s .row-cols-1 laying out the cards on one column, and .row-cols-md-2 splitting four cards to equal width across multiple rows, from the medium breakpoint up.

Change it to .row-cols-3 and you’ll see the fourth card wrap.

When you need equal height, add .h-100 to the cards. If you want equal heights by default, you can set $card-height: 100% in Sass.

Just like with card groups, card footers will automatically line up.

## Masonry
In v4 we used a CSS-only technique to mimic the behavior of Masonry-like columns, but this technique came with lots of unpleasant side effects. If you want to have this type of layout in v5, you can just make use of Masonry plugin. Masonry is not included in Bootstrap, but we’ve made a demo example to help you get started.

