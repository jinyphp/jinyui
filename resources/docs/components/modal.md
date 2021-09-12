---
theme: "docs.bootstrap"
layout: "markdown"
title: "Modal"
subtitle: "Use Bootstrap’s JavaScript modal plugin to add dialogs to your site for lightboxes, user notifications, or completely custom content."
breadcrumb:
    - "Docs"
---

## How it works
Before getting started with Bootstrap’s modal component, be sure to read the following as our menu options have recently changed.

* Modals are built with HTML, CSS, and JavaScript. They’re positioned over everything else in the document and remove scroll from the <body> so that modal content scrolls instead.
* Clicking on the modal “backdrop” will automatically close the modal.
* Bootstrap only supports one modal window at a time. Nested modals aren’t supported as we believe them to be poor user experiences.
* Modals use position: fixed, which can sometimes be a bit particular about its rendering. Whenever possible, place your modal HTML in a top-level position to avoid potential interference from other elements. You’ll likely run into issues when nesting a .modal within another fixed element.
* Once again, due to position: fixed, there are some caveats with using modals on mobile devices. See our browser support docs for details.
* Due to how HTML5 defines its semantics, the autofocus HTML attribute has no effect in Bootstrap modals. To achieve the same effect, use some custom JavaScript:

> The animation effect of this component is dependent on the prefers-reduced-motion media query. See the reduced motion section of our accessibility documentation.

Keep reading for demos and usage guidelines.

## Examples
### Modal components
Below is a static modal example (meaning its position and display have been overridden). Included are the modal header, modal body (required for padding), and modal footer (optional). We ask that you include modal headers with dismiss actions whenever possible, or provide another explicit dismiss action.

## Live demo
Toggle a working modal demo by clicking the button below. It will slide down and fade in from the top of the page.

## Static backdrop
When backdrop is set to static, the modal will not close when clicking outside it. Click the button below to try it.

## Scrolling long content
When modals become too long for the user’s viewport or device, they scroll independent of the page itself. Try the demo below to see what we mean.

You can also create a scrollable modal that allows scroll the modal body by adding .modal-dialog-scrollable to .modal-dialog.

## Vertically centered
Add .modal-dialog-centered to .modal-dialog to vertically center the modal.

## Tooltips and popovers
Tooltips and popovers can be placed within modals as needed. When modals are closed, any tooltips and popovers within are also automatically dismissed.

## Using the grid
Utilize the Bootstrap grid system within a modal by nesting .container-fluid within the .modal-body. Then, use the normal grid system classes as you would anywhere else.

## Varying modal content
Have a bunch of buttons that all trigger the same modal with slightly different contents? Use event.relatedTarget and HTML data-bs-* attributes to vary the contents of the modal depending on which button was clicked.

Below is a live demo followed by example HTML and JavaScript. For more information, read the modal events docs for details on relatedTarget.

## Toggle between modals
Toggle between multiple modals with some clever placement of the data-bs-target and data-bs-toggle attributes. For example, you could toggle a password reset modal from within an already open sign in modal. Please note multiple modals cannot be open at the same time—this method simply toggles between two separate modals.

## Change animation
The $modal-fade-transform variable determines the transform state of .modal-dialog before the modal fade-in animation, the $modal-show-transform variable determines the transform of .modal-dialog at the end of the modal fade-in animation.

If you want for example a zoom-in animation, you can set $modal-fade-transform: scale(.8).

## Remove animation
For modals that simply appear rather than fade in to view, remove the .fade class from your modal markup.

## Dynamic heights
If the height of a modal changes while it is open, you should call myModal.handleUpdate() to readjust the modal’s position in case a scrollbar appears.

## Accessibility
Be sure to add aria-labelledby="...", referencing the modal title, to .modal. Additionally, you may give a description of your modal dialog with aria-describedby on .modal. Note that you don’t need to add role="dialog" since we already add it via JavaScript.

## Embedding YouTube videos
Embedding YouTube videos in modals requires additional JavaScript not in Bootstrap to automatically stop playback and more. See this helpful Stack Overflow post for more information.

## Optional sizes
Modals have three optional sizes, available via modifier classes to be placed on a .modal-dialog. These sizes kick in at certain breakpoints to avoid horizontal scrollbars on narrower viewports.

Size	Class	Modal max-width
Small	.modal-sm	300px
Default	None	500px
Large	.modal-lg	800px
Extra large	.modal-xl	1140px
Our default modal without modifier class constitutes the “medium” size modal.

## Fullscreen Modal
Another override is the option to pop up a modal that covers the user viewport, available via modifier classes that are placed on a .modal-dialog.



