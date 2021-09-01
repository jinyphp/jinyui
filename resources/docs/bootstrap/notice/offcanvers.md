---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Offcanvas

Build hidden sidebars into your project for navigation, shopping carts, and more with a few classes and our JavaScript plugin.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCKAD52QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCKAD52QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[How it works](https://getbootstrap.com/docs/5.0/components/offcanvas/#how-it-works)[Examples](https://getbootstrap.com/docs/5.0/components/offcanvas/#examples)[Offcanvas components](https://getbootstrap.com/docs/5.0/components/offcanvas/#offcanvas-components)[Live demo](https://getbootstrap.com/docs/5.0/components/offcanvas/#live-demo)[Placement](https://getbootstrap.com/docs/5.0/components/offcanvas/#placement)[Backdrop](https://getbootstrap.com/docs/5.0/components/offcanvas/#backdrop)[Accessibility](https://getbootstrap.com/docs/5.0/components/offcanvas/#accessibility)[Sass](https://getbootstrap.com/docs/5.0/components/offcanvas/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/offcanvas/#variables)[Usage](https://getbootstrap.com/docs/5.0/components/offcanvas/#usage)[Via data attributes](https://getbootstrap.com/docs/5.0/components/offcanvas/#via-data-attributes)[Via JavaScript](https://getbootstrap.com/docs/5.0/components/offcanvas/#via-javascript)[Options](https://getbootstrap.com/docs/5.0/components/offcanvas/#options)[Methods](https://getbootstrap.com/docs/5.0/components/offcanvas/#methods)[Events](https://getbootstrap.com/docs/5.0/components/offcanvas/#events)

## How it works

Offcanvas is a sidebar component that can be toggled via JavaScript to appear from the left, right, or bottom edge of the viewport. Buttons or anchors are used as triggers that are attached to specific elements you toggle, and `data` attributes are used to invoke our JavaScript.

- Offcanvas shares some of the same JavaScript code as modals. Conceptually, they are quite similar, but they are separate plugins.
- Similarly, some [source Sass](https://getbootstrap.com/docs/5.0/components/offcanvas/#sass) variables for offcanvas’s styles and dimensions are inherited from the modal’s variables.
- When shown, offcanvas includes a default backdrop that can be clicked to hide the offcanvas.
- Similar to modals, only one offcanvas can be shown at a time.

**Heads up!** Given how CSS handles animations, you cannot use `margin` or `translate` on an `.offcanvas` element. Instead, use the class as an independent wrapping element.

The animation effect of this component is dependent on the `prefers-reduced-motion` media query. See the [reduced motion section of our accessibility documentation](https://getbootstrap.com/docs/5.0/getting-started/accessibility/#reduced-motion).

## Examples

### Offcanvas components

Below is an offcanvas example that is shown by default (via `.show` on `.offcanvas`). Offcanvas includes support for a header with a close button and an optional body class for some initial `padding`. We suggest that you include offcanvas headers with dismiss actions whenever possible, or provide an explicit dismiss action.

##### Offcanvas



Content for the offcanvas goes here. You can place just about any Bootstrap component or custom elements here.

Copy

```html
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasLabel">Offcanvas</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    Content for the offcanvas goes here. You can place just about any Bootstrap component or custom elements here.
  </div>
</div>
```

### Live demo

Use the buttons below to show and hide an offcanvas element via JavaScript that toggles the `.show` class on an element with the `.offcanvas` class.

- `.offcanvas` hides content (default)
- `.offcanvas.show` shows content

You can use a link with the `href` attribute, or a button with the `data-bs-target` attribute. In both cases, the `data-bs-toggle="offcanvas"` is required.

[Link with href](https://getbootstrap.com/docs/5.0/components/offcanvas/#offcanvasExample) Button with data-bs-target

Copy

```html
<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
  Link with href
</a>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
  Button with data-bs-target
</button>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
      Some text as placeholder. In real life you can have the elements you have chosen. Like, text, images, lists, etc.
    </div>
    <div class="dropdown mt-3">
      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown">
        Dropdown button
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        <li><a class="dropdown-item" href="#">Action</a></li>
        <li><a class="dropdown-item" href="#">Another action</a></li>
        <li><a class="dropdown-item" href="#">Something else here</a></li>
      </ul>
    </div>
  </div>
</div>
```

## Placement

There’s no default placement for offcanvas components, so you must add one of the modifier classes below;

- `.offcanvas-start` places offcanvas on the left of the viewport (shown above)
- `.offcanvas-end` places offcanvas on the right of the viewport
- `.offcanvas-top` places offcanvas on the top of the viewport
- `.offcanvas-bottom` places offcanvas on the bottom of the viewport

Try the top, right, and bottom examples out below.

Toggle top offcanvas

Copy

```html
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop">Toggle top offcanvas</button>

<div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasTopLabel">Offcanvas top</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    ...
  </div>
</div>
```

Toggle right offcanvas

Copy

```html
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Toggle right offcanvas</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">Offcanvas right</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    ...
  </div>
</div>
```

Toggle bottom offcanvas

Copy

```html
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Toggle bottom offcanvas</button>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Offcanvas bottom</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    ...
  </div>
</div>
```

## Backdrop

Scrolling the `<body>` element is disabled when an offcanvas and its backdrop are visible. Use the `data-bs-scroll` attribute to toggle `<body>` scrolling and `data-bs-backdrop` to toggle the backdrop.

Enable body scrolling Enable backdrop (default) Enable both scrolling & backdrop

Copy

```html
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">Enable body scrolling</button>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop">Enable backdrop (default)</button>
<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">Enable both scrolling & backdrop</button>

<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Colored with scrolling</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Offcanvas with backdrop</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>.....</p>
  </div>
</div>
<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions" aria-labelledby="offcanvasWithBothOptionsLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">Backdroped with scrolling</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <p>Try scrolling the rest of the page to see this option in action.</p>
  </div>
</div>
```

## Accessibility

Since the offcanvas panel is conceptually a modal dialog, be sure to add `aria-labelledby="..."`—referencing the offcanvas title—to `.offcanvas`. Note that you don’t need to add `role="dialog"` since we already add it via JavaScript.

## Sass

### Variables

Copy

```scss
$offcanvas-padding-y:               $modal-inner-padding;
$offcanvas-padding-x:               $modal-inner-padding;
$offcanvas-horizontal-width:        400px;
$offcanvas-vertical-height:         30vh;
$offcanvas-transition-duration:     .3s;
$offcanvas-border-color:            $modal-content-border-color;
$offcanvas-border-width:            $modal-content-border-width;
$offcanvas-title-line-height:       $modal-title-line-height;
$offcanvas-bg-color:                $modal-content-bg;
$offcanvas-color:                   $modal-content-color;
$offcanvas-box-shadow:              $modal-content-box-shadow-xs;
```

## Usage

The offcanvas plugin utilizes a few classes and attributes to handle the heavy lifting:

- `.offcanvas` hides the content
- `.offcanvas.show` shows the content
- `.offcanvas-start` hides the offcanvas on the left
- `.offcanvas-end` hides the offcanvas on the right
- `.offcanvas-bottom` hides the offcanvas on the bottom

Add a dismiss button with the `data-bs-dismiss="offcanvas"` attribute, which triggers the JavaScript functionality. Be sure to use the `<button>` element with it for proper behavior across all devices.

### Via data attributes

Add `data-bs-toggle="offcanvas"` and a `data-bs-target` or `href` to the element to automatically assign control of one offcanvas element. The `data-bs-target` attribute accepts a CSS selector to apply the offcanvas to. Be sure to add the class `offcanvas` to the offcanvas element. If you’d like it to default open, add the additional class `show`.

### Via JavaScript

Enable manually with:

Copy

```js
var offcanvasElementList = [].slice.call(document.querySelectorAll('.offcanvas'))
var offcanvasList = offcanvasElementList.map(function (offcanvasEl) {
  return new bootstrap.Offcanvas(offcanvasEl)
})
```

### Options

Options can be passed via data attributes or JavaScript. For data attributes, append the option name to `data-bs-`, as in `data-bs-backdrop=""`.

| Name       | Type    | Default | Description                                      |
| ---------- | ------- | ------- | ------------------------------------------------ |
| `backdrop` | boolean | `true`  | Apply a backdrop on body while offcanvas is open |
| `keyboard` | boolean | `true`  | Closes the offcanvas when escape key is pressed  |
| `scroll`   | boolean | `false` | Allow body scrolling while offcanvas is open     |

### Methods

#### Asynchronous methods and transitions

All API methods are **asynchronous** and start a **transition**. They return to the caller as soon as the transition is started but **before it ends**. In addition, a method call on a **transitioning component will be ignored**.

[See our JavaScript documentation for more information](https://getbootstrap.com/docs/5.0/getting-started/javascript/#asynchronous-functions-and-transitions).

Activates your content as an offcanvas element. Accepts an optional options `object`.

You can create an offcanvas instance with the constructor, for example:

Copy

```js
var myOffcanvas = document.getElementById('myOffcanvas')
var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
```

| Method                | Description                                                  |
| --------------------- | ------------------------------------------------------------ |
| `toggle`              | Toggles an offcanvas element to shown or hidden. **Returns to the caller before the offcanvas element has actually been shown or hidden** (i.e. before the `shown.bs.offcanvas` or `hidden.bs.offcanvas` event occurs). |
| `show`                | Shows an offcanvas element. **Returns to the caller before the offcanvas element has actually been shown** (i.e. before the `shown.bs.offcanvas` event occurs). |
| `hide`                | Hides an offcanvas element. **Returns to the caller before the offcanvas element has actually been hidden** (i.e. before the `hidden.bs.offcanvas` event occurs). |
| `getInstance`         | *Static* method which allows you to get the offcanvas instance associated with a DOM element |
| `getOrCreateInstance` | *Static* method which allows you to get the offcanvas instance associated with a DOM element, or create a new one in case it wasn’t initialised |

### Events

Bootstrap’s offcanvas class exposes a few events for hooking into offcanvas functionality.

| Event type            | Description                                                  |
| --------------------- | ------------------------------------------------------------ |
| `show.bs.offcanvas`   | This event fires immediately when the `show` instance method is called. |
| `shown.bs.offcanvas`  | This event is fired when an offcanvas element has been made visible to the user (will wait for CSS transitions to complete). |
| `hide.bs.offcanvas`   | This event is fired immediately when the `hide` method has been called. |
| `hidden.bs.offcanvas` | This event is fired when an offcanvas element has been hidden from the user (will wait for CSS transitions to complete). |

Copy

```js
var myOffcanvas = document.getElementById('myOffcanvas')
myOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
  // do something...
})
```