---
theme: "docs.bootstrap"
layout: "markdown"
title: "Buttons"
subtitle: "Use Bootstrap’s custom button styles for actions in forms, dialogs, and more with support for multiple sizes, states, and more."
breadcrumb:
    - "Docs"
---

## Examples
Bootstrap includes several predefined button styles, each serving its own semantic purpose, with a few extras thrown in for more control.

> Conveying meaning to assistive technologies
Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the .visually-hidden class.

## Disable text wrapping
If you don’t want the button text to wrap, you can add the .text-nowrap class to the button. In Sass, you can set $btn-white-space: nowrap to disable text wrapping for each button.

## Button tags
The .btn classes are designed to be used with the <button> element. However, you can also use these classes on <a> or <input> elements (though some browsers may apply a slightly different rendering).

When using button classes on <a> elements that are used to trigger in-page functionality (like collapsing content), rather than linking to new pages or sections within the current page, these links should be given a role="button" to appropriately convey their purpose to assistive technologies such as screen readers.

## Outline buttons
In need of a button, but not the hefty background colors they bring? Replace the default modifier classes with the .btn-outline-* ones to remove all background images and colors on any button.

> Some of the button styles use a relatively light foreground color, and should only be used on a dark background in order to have sufficient contrast.

## Sizes
Fancy larger or smaller buttons? Add .btn-lg or .btn-sm for additional sizes.


## Disabled state
Make buttons look inactive by adding the disabled boolean attribute to any <button> element. Disabled buttons have pointer-events: none applied to, preventing hover and active states from triggering.

Disabled buttons using the <a> element behave a bit different:

* `<a>`s don’t support the disabled attribute, so you must add the .disabled class to make it visually appear disabled.
* Some future-friendly styles are included to disable all pointer-events on anchor buttons.
* Disabled buttons using `<a>` should include the aria-disabled="true" attribute to indicate the state of the element to assistive technologies.
* Disabled buttons using `<a>` should not include the href attribute.

## Link functionality caveat
To cover cases where you have to keep the href attribute on a disabled link, the .disabled class uses pointer-events: none to try to disable the link functionality of <a>s. Note that this CSS property is not yet standardized for HTML, but all modern browsers support it. In addition, even in browsers that do support pointer-events: none, keyboard navigation remains unaffected, meaning that sighted keyboard users and users of assistive technologies will still be able to activate these links. So to be safe, in addition to aria-disabled="true", also include a tabindex="-1" attribute on these links to prevent them from receiving keyboard focus, and use custom JavaScript to disable their functionality altogether.

## Block buttons
Create responsive stacks of full-width, “block buttons” like those in Bootstrap 4 with a mix of our display and gap utilities. By using utilities instead of button specific classes, we have much greater control over spacing, alignment, and responsive behaviors.

Here we create a responsive variation, starting with vertically stacked buttons until the md breakpoint, where .d-md-block replaces the .d-grid class, thus nullifying the gap-2 utility. Resize your browser to see them change.


You can adjust the width of your block buttons with grid column width classes. For example, for a half-width “block button”, use .col-6. Center it horizontally with .mx-auto, too.

Additional utilities can be used to adjust the alignment of buttons when horizontal. Here we’ve taken our previous responsive example and added some flex utilities and a margin utility on the button to right align the buttons when they’re no longer stacked.

## Button plugin

Add data-bs-toggle="button" to toggle a button’s active state. If you’re pre-toggling a button, you must manually add the .active class and aria-pressed="true" to ensure that it is conveyed appropriately to assistive technologies.

## Methods
You can create a button instance with the button constructor, for example:
