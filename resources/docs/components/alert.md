---
theme: "docs.bootstrap"
layout: "markdown"
title: "Alerts"
subtitle: "Provide contextual feedback messages for typical user actions with the handful of available and flexible alert messages."
breadcrumb:
    - "Docs"
---

## Examples
Alerts are available for any length of text, as well as an optional close button. For proper styling, use one of the eight required contextual classes (e.g., .alert-success). For inline dismissal, use the alerts JavaScript plugin.

> Conveying meaning to assistive technologies
Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the .visually-hidden class.

## Live example
Click the button below to show an alert (hidden with inline styles to start), then dismiss (and destroy) it with the built-in close button.

## Link color
Use the .alert-link utility class to quickly provide matching colored links within any alert.

## Additional content
Alerts can also contain additional HTML elements like headings, paragraphs and dividers.

## Icons
Similarly, you can use flexbox utilities and Bootstrap Icons to create alerts with icons. Depending on your icons and content, you may want to add more utilities or custom styles.

## Dismissing
Using the alert JavaScript plugin, it’s possible to dismiss any alert inline. Here’s how:

* Be sure you’ve loaded the alert plugin, or the compiled Bootstrap JavaScript.
* Add a close button and the .alert-dismissible class, which adds extra padding to the right of the alert and positions the close button.
* On the close button, add the data-bs-dismiss="alert" attribute, which triggers the JavaScript functionality. Be sure to use the <button> element with it for proper behavior across all devices.
* To animate alerts when dismissing them, be sure to add the .fade and .show classes.
You can see this in action with a live demo:

> When an alert is dismissed, the element is completely removed from the page structure. If a keyboard user dismisses the alert using the close button, their focus will suddenly be lost and, depending on the browser, reset to the start of the page/document. For this reason, we recommend including additional JavaScript that listens for the closed.bs.alert event and programmatically sets focus() to the most appropriate location in the page. If you’re planning to move focus to a non-interactive element that normally does not receive focus, make sure to add tabindex="-1" to the element.

## Sass

## JavaScript behavior
