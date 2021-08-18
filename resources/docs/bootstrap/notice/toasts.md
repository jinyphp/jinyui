---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Toasts

Push notifications to your visitors with a toast, a lightweight and easily customizable alert message.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCKSDCKJKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCKSDCKJKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Overview](https://getbootstrap.com/docs/5.0/components/toasts/#overview)[Examples](https://getbootstrap.com/docs/5.0/components/toasts/#examples)[Basic](https://getbootstrap.com/docs/5.0/components/toasts/#basic)[Live](https://getbootstrap.com/docs/5.0/components/toasts/#live)[Translucent](https://getbootstrap.com/docs/5.0/components/toasts/#translucent)[Stacking](https://getbootstrap.com/docs/5.0/components/toasts/#stacking)[Custom content](https://getbootstrap.com/docs/5.0/components/toasts/#custom-content)[Color schemes](https://getbootstrap.com/docs/5.0/components/toasts/#color-schemes)[Placement](https://getbootstrap.com/docs/5.0/components/toasts/#placement)[Accessibility](https://getbootstrap.com/docs/5.0/components/toasts/#accessibility)[Sass](https://getbootstrap.com/docs/5.0/components/toasts/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/toasts/#variables)[Usage](https://getbootstrap.com/docs/5.0/components/toasts/#usage)[Options](https://getbootstrap.com/docs/5.0/components/toasts/#options)[Methods](https://getbootstrap.com/docs/5.0/components/toasts/#methods)[show](https://getbootstrap.com/docs/5.0/components/toasts/#show)[hide](https://getbootstrap.com/docs/5.0/components/toasts/#hide)[dispose](https://getbootstrap.com/docs/5.0/components/toasts/#dispose)[getInstance](https://getbootstrap.com/docs/5.0/components/toasts/#getinstance)[getOrCreateInstance](https://getbootstrap.com/docs/5.0/components/toasts/#getorcreateinstance)[Events](https://getbootstrap.com/docs/5.0/components/toasts/#events)

Toasts are lightweight notifications designed to mimic the push notifications that have been popularized by mobile and desktop operating systems. They’re built with flexbox, so they’re easy to align and position.

## Overview

Things to know when using the toast plugin:

- Toasts are opt-in for performance reasons, so **you must initialize them yourself**.
- Toasts will automatically hide if you do not specify `autohide: false`.

The animation effect of this component is dependent on the `prefers-reduced-motion` media query. See the [reduced motion section of our accessibility documentation](https://getbootstrap.com/docs/5.0/getting-started/accessibility/#reduced-motion).

## Examples

### Basic

To encourage extensible and predictable toasts, we recommend a header and body. Toast headers use `display: flex`, allowing easy alignment of content thanks to our margin and flexbox utilities.

Toasts are as flexible as you need and have very little required markup. At a minimum, we require a single element to contain your “toasted” content and strongly encourage a dismiss button.

**Bootstrap**11 mins ago

Hello, world! This is a toast message.

Copy

```html
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
```

### Live

Click the button below to show a toast (positioned with our utilities in the lower right corner) that has been hidden by default with `.hide`.

Show live toast

Copy

```html
<button type="button" class="btn btn-primary" id="liveToastBtn">Show live toast</button>

<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
  <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>
```

### Translucent

Toasts are slightly translucent to blend in with what’s below them.

**Bootstrap**11 mins ago

Hello, world! This is a toast message.

Copy

```html
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small class="text-muted">11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
```

### Stacking

You can stack toasts by wrapping them in a toast container, which will vertically add some spacing.

**Bootstrap**just now

See? Just like this.

**Bootstrap**2 seconds ago

Heads up, toasts will stack automatically

Copy

```html
<div class="toast-container">
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small class="text-muted">just now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      See? Just like this.
    </div>
  </div>

  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small class="text-muted">2 seconds ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Heads up, toasts will stack automatically
    </div>
  </div>
</div>
```

### Custom content

Customize your toasts by removing sub-components, tweaking them with [utilities](https://getbootstrap.com/docs/5.0/utilities/api/), or by adding your own markup. Here we’ve created a simpler toast by removing the default `.toast-header`, adding a custom hide icon from [Bootstrap Icons](https://icons.getbootstrap.com/), and using some [flexbox utilities](https://getbootstrap.com/docs/5.0/utilities/flex/) to adjust the layout.

Hello, world! This is a toast message.



Copy

```html
<div class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
    Hello, world! This is a toast message.
   </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
```

Alternatively, you can also add additional controls and components to toasts.

Hello, world! This is a toast message.

Take action Close

Copy

```html
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-body">
    Hello, world! This is a toast message.
    <div class="mt-2 pt-2 border-top">
      <button type="button" class="btn btn-primary btn-sm">Take action</button>
      <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="toast">Close</button>
    </div>
  </div>
</div>
```

### Color schemes

Building on the above example, you can create different toast color schemes with our [color](https://getbootstrap.com/docs/5.0/utilities/colors/) and [background](https://getbootstrap.com/docs/5.0/utilities/background/) utilities. Here we’ve added `.bg-primary` and `.text-white` to the `.toast`, and then added `.btn-close-white` to our close button. For a crisp edge, we remove the default border with `.border-0`.

Hello, world! This is a toast message.



Copy

```html
<div class="toast align-items-center text-white bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>
```

## Placement

Place toasts with custom CSS as you need them. The top right is often used for notifications, as is the top middle. If you’re only ever going to show one toast at a time, put the positioning styles right on the `.toast`.

Toast placement     Select a position...     Top left     Top center     Top right     Middle left     Middle center     Middle right     Bottom left     Bottom center     Bottom right   

**Bootstrap**11 mins ago

Hello, world! This is a toast message.

Copy

```html
<form>
  <div class="mb-3">
    <label for="selectToastPlacement">Toast placement</label>
    <select class="form-select mt-2" id="selectToastPlacement">
      <option value="" selected>Select a position...</option>
      <option value="top-0 start-0">Top left</option>
      <option value="top-0 start-50 translate-middle-x">Top center</option>
      <option value="top-0 end-0">Top right</option>
      <option value="top-50 start-0 translate-middle-y">Middle left</option>
      <option value="top-50 start-50 translate-middle">Middle center</option>
      <option value="top-50 end-0 translate-middle-y">Middle right</option>
      <option value="bottom-0 start-0">Bottom left</option>
      <option value="bottom-0 start-50 translate-middle-x">Bottom center</option>
      <option value="bottom-0 end-0">Bottom right</option>
    </select>
  </div>
</form>
<div aria-live="polite" aria-atomic="true" class="bg-dark position-relative bd-example-toasts">
  <div class="toast-container position-absolute p-3" id="toastPlacement">
    <div class="toast">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small>11 mins ago</small>
      </div>
      <div class="toast-body">
        Hello, world! This is a toast message.
      </div>
    </div>
  </div>
</div>
```

For systems that generate more notifications, consider using a wrapping element so they can easily stack.

**Bootstrap**just now

See? Just like this.

**Bootstrap**2 seconds ago

Heads up, toasts will stack automatically

Copy

```html
<div aria-live="polite" aria-atomic="true" class="position-relative">
  <!-- Position it: -->
  <!-- - `.toast-container` for spacing between toasts -->
  <!-- - `.position-absolute`, `top-0` & `end-0` to position the toasts in the upper right corner -->
  <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
  <div class="toast-container position-absolute top-0 end-0 p-3">

    <!-- Then put toasts within -->
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small class="text-muted">just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        See? Just like this.
      </div>
    </div>

    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <img src="..." class="rounded me-2" alt="...">
        <strong class="me-auto">Bootstrap</strong>
        <small class="text-muted">2 seconds ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        Heads up, toasts will stack automatically
      </div>
    </div>
  </div>
</div>
```

You can also get fancy with flexbox utilities to align toasts horizontally and/or vertically.

**Bootstrap**11 mins ago

Hello, world! This is a toast message.

Copy

```html
<!-- Flexbox container for aligning the toasts -->
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">

  <!-- Then put toasts within -->
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small>11 mins ago</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      Hello, world! This is a toast message.
    </div>
  </div>
</div>
```

## Accessibility

Toasts are intended to be small interruptions to your visitors or users, so to help those with screen readers and similar assistive technologies, you should wrap your toasts in an [`aria-live` region](https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/ARIA_Live_Regions). Changes to live regions (such as injecting/updating a toast component) are automatically announced by screen readers without needing to move the user’s focus or otherwise interrupt the user. Additionally, include `aria-atomic="true"` to ensure that the entire toast is always announced as a single (atomic) unit, rather than just announcing what was changed (which could lead to problems if you only update part of the toast’s content, or if displaying the same toast content at a later point in time). If the information needed is important for the process, e.g. for a list of errors in a form, then use the [alert component](https://getbootstrap.com/docs/5.0/components/alerts/) instead of toast.

Note that the live region needs to be present in the markup *before* the toast is generated or updated. If you dynamically generate both at the same time and inject them into the page, they will generally not be announced by assistive technologies.

You also need to adapt the `role` and `aria-live` level depending on the content. If it’s an important message like an error, use `role="alert" aria-live="assertive"`, otherwise use `role="status" aria-live="polite"` attributes.

As the content you’re displaying changes, be sure to update the [`delay` timeout](https://getbootstrap.com/docs/5.0/components/toasts/#options) so that users have enough time to read the toast.

Copy

```html
<div class="toast" role="alert" aria-live="polite" aria-atomic="true" data-bs-delay="10000">
  <div role="alert" aria-live="assertive" aria-atomic="true">...</div>
</div>
```

When using `autohide: false`, you must add a close button to allow users to dismiss the toast.

**Bootstrap**11 mins ago

Hello, world! This is a toast message.

Copy

```html
<div role="alert" aria-live="assertive" aria-atomic="true" class="toast" data-bs-autohide="false">
  <div class="toast-header">
    <img src="..." class="rounded me-2" alt="...">
    <strong class="me-auto">Bootstrap</strong>
    <small>11 mins ago</small>
    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
  <div class="toast-body">
    Hello, world! This is a toast message.
  </div>
</div>
```

While technically it’s possible to add focusable/actionable controls (such as additional buttons or links) in your toast, you should avoid doing this for autohiding toasts. Even if you give the toast a long [`delay` timeout](https://getbootstrap.com/docs/5.0/components/toasts/#options), keyboard and assistive technology users may find it difficult to reach the toast in time to take action (since toasts don’t receive focus when they are displayed). If you absolutely must have further controls, we recommend using a toast with `autohide: false`.

## Sass

### Variables

Copy

```scss
$toast-max-width:                   350px;
$toast-padding-x:                   .75rem;
$toast-padding-y:                   .5rem;
$toast-font-size:                   .875rem;
$toast-color:                       null;
$toast-background-color:            rgba($white, .85);
$toast-border-width:                1px;
$toast-border-color:                rgba(0, 0, 0, .1);
$toast-border-radius:               $border-radius;
$toast-box-shadow:                  $box-shadow;
$toast-spacing:                     $container-padding-x;

$toast-header-color:                $gray-600;
$toast-header-background-color:     rgba($white, .85);
$toast-header-border-color:         rgba(0, 0, 0, .05);
```

## Usage

Initialize toasts via JavaScript:

Copy

```js
var toastElList = [].slice.call(document.querySelectorAll('.toast'))
var toastList = toastElList.map(function (toastEl) {
  return new bootstrap.Toast(toastEl, option)
})
```

### Options

Options can be passed via data attributes or JavaScript. For data attributes, append the option name to `data-bs-`, as in `data-bs-animation=""`.

| Name        | Type    | Default | Description                              |
| ----------- | ------- | ------- | ---------------------------------------- |
| `animation` | boolean | `true`  | Apply a CSS fade transition to the toast |
| `autohide`  | boolean | `true`  | Auto hide the toast                      |
| `delay`     | number  | `5000`  | Delay hiding the toast (ms)              |

### Methods

#### Asynchronous methods and transitions

All API methods are **asynchronous** and start a **transition**. They return to the caller as soon as the transition is started but **before it ends**. In addition, a method call on a **transitioning component will be ignored**.

[See our JavaScript documentation for more information](https://getbootstrap.com/docs/5.0/getting-started/javascript/#asynchronous-functions-and-transitions).

#### show

Reveals an element’s toast. **Returns to the caller before the toast has actually been shown** (i.e. before the `shown.bs.toast` event occurs). You have to manually call this method, instead your toast won’t show.

Copy

```js
toast.show()
```

#### hide

Hides an element’s toast. **Returns to the caller before the toast has actually been hidden** (i.e. before the `hidden.bs.toast` event occurs). You have to manually call this method if you made `autohide` to `false`.

Copy

```js
toast.hide()
```

#### dispose

Hides an element’s toast. Your toast will remain on the DOM but won’t show anymore.

Copy

```js
toast.dispose()
```

#### getInstance

*Static* method which allows you to get the scrollspy instance associated with a DOM element

Copy

```js
var myToastEl = document.getElementById('myToastEl')
var myToast = bootstrap.Toast.getInstance(myToastEl) // Returns a Bootstrap toast instance
```

#### getOrCreateInstance

*Static* method which allows you to get the scrollspy instance associated with a DOM element, or create a new one in case it wasn’t initialised

Copy

```js
var myToastEl = document.getElementById('myToastEl')
var myToast = bootstrap.Toast.getOrCreateInstance(myToastEl) // Returns a Bootstrap toast instance
```

### Events

| Event type        | Description                                                  |
| ----------------- | ------------------------------------------------------------ |
| `show.bs.toast`   | This event fires immediately when the `show` instance method is called. |
| `shown.bs.toast`  | This event is fired when the toast has been made visible to the user. |
| `hide.bs.toast`   | This event is fired immediately when the `hide` instance method has been called. |
| `hidden.bs.toast` | This event is fired when the toast has finished being hidden from the user. |

Copy

```js
var myToastEl = document.getElementById('myToast')
myToastEl.addEventListener('hidden.bs.toast', function () {
  // do something...
})
```

[Bootstrap](https://getbootstrap.com/)

 