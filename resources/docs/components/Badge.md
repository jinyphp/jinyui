---
theme: "docs.bootstrap"
layout: "markdown"
title: "Badges"
subtitle: "Documentation and examples for badges, our small count and labeling component."
breadcrumb:
    - "Docs"
---

## Examples
Badges scale to match the size of the immediate parent element by using relative font sizing and em units. As of v5, badges no longer have focus or hover styles for links.

## Headings

## Buttons
Badges can be used as part of links or buttons to provide a counter.

Note that depending on how they are used, badges may be confusing for users of screen readers and similar assistive technologies. While the styling of badges provides a visual cue as to their purpose, these users will simply be presented with the content of the badge. Depending on the specific situation, these badges may seem like random additional words or numbers at the end of a sentence, link, or button.

Unless the context is clear (as with the “Notifications” example, where it is understood that the “4” is the number of notifications), consider including additional context with a visually hidden piece of additional text.

## Positioned
Use utilities to modify a .badge and position it in the corner of a link or button.

## Background colors
Use our background utility classes to quickly change the appearance of a badge. Please note that when using Bootstrap’s default .bg-light, you’ll likely need a text color utility like .text-dark for proper styling. This is because background utilities do not set anything but background-color.

## Pill badges
Use the .rounded-pill utility class to make badges more rounded with a larger border-radius.

## Sass
