---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Dropdowns

Toggle contextual overlays for displaying lists of links and more with the Bootstrap dropdown plugin.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCE7D527KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCE7D527KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Overview](https://getbootstrap.com/docs/5.0/components/dropdowns/#overview)[Accessibility](https://getbootstrap.com/docs/5.0/components/dropdowns/#accessibility)[Examples](https://getbootstrap.com/docs/5.0/components/dropdowns/#examples)[Single button](https://getbootstrap.com/docs/5.0/components/dropdowns/#single-button)[Split button](https://getbootstrap.com/docs/5.0/components/dropdowns/#split-button)[Sizing](https://getbootstrap.com/docs/5.0/components/dropdowns/#sizing)[Dark dropdowns](https://getbootstrap.com/docs/5.0/components/dropdowns/#dark-dropdowns)[Directions](https://getbootstrap.com/docs/5.0/components/dropdowns/#directions)[Dropup](https://getbootstrap.com/docs/5.0/components/dropdowns/#dropup)[Dropright](https://getbootstrap.com/docs/5.0/components/dropdowns/#dropright)[Dropleft](https://getbootstrap.com/docs/5.0/components/dropdowns/#dropleft)[Menu items](https://getbootstrap.com/docs/5.0/components/dropdowns/#menu-items)[Active](https://getbootstrap.com/docs/5.0/components/dropdowns/#active)[Disabled](https://getbootstrap.com/docs/5.0/components/dropdowns/#disabled)[Menu alignment](https://getbootstrap.com/docs/5.0/components/dropdowns/#menu-alignment)[Responsive alignment](https://getbootstrap.com/docs/5.0/components/dropdowns/#responsive-alignment)[Alignment options](https://getbootstrap.com/docs/5.0/components/dropdowns/#alignment-options)[Menu content](https://getbootstrap.com/docs/5.0/components/dropdowns/#menu-content)[Headers](https://getbootstrap.com/docs/5.0/components/dropdowns/#headers)[Dividers](https://getbootstrap.com/docs/5.0/components/dropdowns/#dividers)[Text](https://getbootstrap.com/docs/5.0/components/dropdowns/#text)[Forms](https://getbootstrap.com/docs/5.0/components/dropdowns/#forms)[Dropdown options](https://getbootstrap.com/docs/5.0/components/dropdowns/#dropdown-options)[Auto close behavior](https://getbootstrap.com/docs/5.0/components/dropdowns/#auto-close-behavior)[Sass](https://getbootstrap.com/docs/5.0/components/dropdowns/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/dropdowns/#variables)[Mixins](https://getbootstrap.com/docs/5.0/components/dropdowns/#mixins)[Usage](https://getbootstrap.com/docs/5.0/components/dropdowns/#usage)[Via data attributes](https://getbootstrap.com/docs/5.0/components/dropdowns/#via-data-attributes)[Via JavaScript](https://getbootstrap.com/docs/5.0/components/dropdowns/#via-javascript)[Options](https://getbootstrap.com/docs/5.0/components/dropdowns/#options)[Using function with `popperConfig`](https://getbootstrap.com/docs/5.0/components/dropdowns/#using-function-with-popperconfig)[Methods](https://getbootstrap.com/docs/5.0/components/dropdowns/#methods)[Events](https://getbootstrap.com/docs/5.0/components/dropdowns/#events)

## Overview

Dropdowns are toggleable, contextual overlays for displaying lists of links and more. They’re made interactive with the included Bootstrap dropdown JavaScript plugin. They’re toggled by clicking, not by hovering; this is [an intentional design decision](https://markdotto.com/2012/02/27/bootstrap-explained-dropdowns/).

Dropdowns are built on a third party library, [Popper](https://popper.js.org/), which provides dynamic positioning and viewport detection. Be sure to include [popper.min.js](https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js) before Bootstrap’s JavaScript or use `bootstrap.bundle.min.js` / `bootstrap.bundle.js` which contains Popper. Popper isn’t used to position dropdowns in navbars though as dynamic positioning isn’t required.

## Accessibility

The [WAI ARIA](https://www.w3.org/TR/wai-aria/) standard defines an actual [`role="menu"` widget](https://www.w3.org/WAI/PF/aria/roles#menu), but this is specific to application-like menus which trigger actions or functions. ARIA menus can only contain menu items, checkbox menu items, radio button menu items, radio button groups, and sub-menus.

Bootstrap’s dropdowns, on the other hand, are designed to be generic and applicable to a variety of situations and markup structures. For instance, it is possible to create dropdowns that contain additional inputs and form controls, such as search fields or login forms. For this reason, Bootstrap does not expect (nor automatically add) any of the `role` and `aria-` attributes required for true ARIA menus. Authors will have to include these more specific attributes themselves.

However, Bootstrap does add built-in support for most standard keyboard menu interactions, such as the ability to move through individual `.dropdown-item` elements using the cursor keys and close the menu with the ESC key.

## Examples

Wrap the dropdown’s toggle (your button or link) and the dropdown menu within `.dropdown`, or another element that declares `position: relative;`. Dropdowns can be triggered from `<a>` or `<button>` elements to better fit your potential needs. The examples shown here use semantic `<ul>` elements where appropriate, but custom markup is supported.

### Single button

Any single `.btn` can be turned into a dropdown toggle with some markup changes. Here’s how you can put them to work with either `<button>` elements:

Dropdown button 

Copy

```html
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
```

And with `<a>` elements:

[Dropdown link ](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<div class="dropdown">
  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown link
  </a>

  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
  </ul>
</div>
```

The best part is you can do this with any button variant, too:

Primary

 

Secondary

 

Success

 

Info

 

Warning

 

Danger

Copy

```html
<!-- Example single danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Action
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>
```

### Split button

Similarly, create split button dropdowns with virtually the same markup as single button dropdowns, but with the addition of `.dropdown-toggle-split` for proper spacing around the dropdown caret.

We use this extra class to reduce the horizontal `padding` on either side of the caret by 25% and remove the `margin-left` that’s added for regular button dropdowns. Those extra changes keep the caret centered in the split button and provide a more appropriately sized hit area next to the main button.

PrimaryToggle Dropdown

 

SecondaryToggle Dropdown

 

SuccessToggle Dropdown

 

InfoToggle Dropdown

 

WarningToggle Dropdown

 

DangerToggle Dropdown

Copy

```html
<!-- Example split danger button -->
<div class="btn-group">
  <button type="button" class="btn btn-danger">Action</button>
  <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>
```

## Sizing

Button dropdowns work with buttons of all sizes, including default and split dropdown buttons.

Large button 

 

Large split buttonToggle Dropdown

Copy

```html
<!-- Large button groups (default and split) -->
<div class="btn-group">
  <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Large button
  </button>
  <ul class="dropdown-menu">
    ...
  </ul>
</div>
<div class="btn-group">
  <button class="btn btn-secondary btn-lg" type="button">
    Large split button
  </button>
  <button type="button" class="btn btn-lg btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    ...
  </ul>
</div>
```

Small button 

 

Small split buttonToggle Dropdown

Copy

```html
<div class="btn-group">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Small button
  </button>
  <ul class="dropdown-menu">
    ...
  </ul>
</div>
<div class="btn-group">
  <button class="btn btn-secondary btn-sm" type="button">
    Small split button
  </button>
  <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    ...
  </ul>
</div>
```

## Dark dropdowns

Opt into darker dropdowns to match a dark navbar or custom style by adding `.dropdown-menu-dark` onto an existing `.dropdown-menu`. No changes are required to the dropdown items.

Dropdown button 

Copy

```html
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton2">
    <li><a class="dropdown-item active" href="#">Action</a></li>
    <li><a class="dropdown-item" href="#">Another action</a></li>
    <li><a class="dropdown-item" href="#">Something else here</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="#">Separated link</a></li>
  </ul>
</div>
```

And putting it to use in a navbar:

[Navbar](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

- [Dropdown ](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
```

## Directions

#### RTL

Directions are mirrored when using Bootstrap in RTL, meaning `.dropstart` will appear on the right side.

### Dropup

Trigger dropdown menus above elements by adding `.dropup` to the parent element.

Dropup 

 

Split dropupToggle Dropdown

Copy

```html
<!-- Default dropup button -->
<div class="btn-group dropup">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropup
  </button>
  <ul class="dropdown-menu">
    <!-- Dropdown menu links -->
  </ul>
</div>

<!-- Split dropup button -->
<div class="btn-group dropup">
  <button type="button" class="btn btn-secondary">
    Split dropup
  </button>
  <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropdown</span>
  </button>
  <ul class="dropdown-menu">
    <!-- Dropdown menu links -->
  </ul>
</div>
```

### Dropright

Trigger dropdown menus at the right of the elements by adding `.dropend` to the parent element.

Dropright 

 

Split dropendToggle Dropright

Copy

```html
<!-- Default dropend button -->
<div class="btn-group dropend">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropright
  </button>
  <ul class="dropdown-menu">
    <!-- Dropdown menu links -->
  </ul>
</div>

<!-- Split dropend button -->
<div class="btn-group dropend">
  <button type="button" class="btn btn-secondary">
    Split dropend
  </button>
  <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
    <span class="visually-hidden">Toggle Dropright</span>
  </button>
  <ul class="dropdown-menu">
    <!-- Dropdown menu links -->
  </ul>
</div>
```

### Dropleft

Trigger dropdown menus at the left of the elements by adding `.dropstart` to the parent element.

 Dropleft

 

Toggle Dropleft

Split dropstart

Copy

```html
<!-- Default dropstart button -->
<div class="btn-group dropstart">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropstart
  </button>
  <ul class="dropdown-menu">
    <!-- Dropdown menu links -->
  </ul>
</div>

<!-- Split dropstart button -->
<div class="btn-group">
  <div class="btn-group dropstart" role="group">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
      <span class="visually-hidden">Toggle Dropstart</span>
    </button>
    <ul class="dropdown-menu">
      <!-- Dropdown menu links -->
    </ul>
  </div>
  <button type="button" class="btn btn-secondary">
    Split dropstart
  </button>
</div>
```

## Menu items

You can use `<a>` or `<button>` elements as dropdown items.

Dropdown 

Copy

```html
<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
    <li><button class="dropdown-item" type="button">Action</button></li>
    <li><button class="dropdown-item" type="button">Another action</button></li>
    <li><button class="dropdown-item" type="button">Something else here</button></li>
  </ul>
</div>
```

You can also create non-interactive dropdown items with `.dropdown-item-text`. Feel free to style further with custom CSS or text utilities.

- Dropdown item text
- [Action](https://getbootstrap.com/docs/5.0/components/dropdowns/#)
- [Another action](https://getbootstrap.com/docs/5.0/components/dropdowns/#)
- [Something else here](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<ul class="dropdown-menu">
  <li><span class="dropdown-item-text">Dropdown item text</span></li>
  <li><a class="dropdown-item" href="#">Action</a></li>
  <li><a class="dropdown-item" href="#">Another action</a></li>
  <li><a class="dropdown-item" href="#">Something else here</a></li>
</ul>
```

### Active

Add `.active` to items in the dropdown to **style them as active**. To convey the active state to assistive technologies, use the `aria-current` attribute — using the `page` value for the current page, or `true` for the current item in a set.

- [Regular link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)
- [Active link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)
- [Another link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<ul class="dropdown-menu">
  <li><a class="dropdown-item" href="#">Regular link</a></li>
  <li><a class="dropdown-item active" href="#" aria-current="true">Active link</a></li>
  <li><a class="dropdown-item" href="#">Another link</a></li>
</ul>
```

### Disabled

Add `.disabled` to items in the dropdown to **style them as disabled**.

- [Regular link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)
- [Disabled link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)
- [Another link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<ul class="dropdown-menu">
  <li><a class="dropdown-item" href="#">Regular link</a></li>
  <li><a class="dropdown-item disabled" href="#" tabindex="-1" aria-disabled="true">Disabled link</a></li>
  <li><a class="dropdown-item" href="#">Another link</a></li>
</ul>
```

## Menu alignment

By default, a dropdown menu is automatically positioned 100% from the top and along the left side of its parent. You can change this with the directional `.drop*` classes, but you can also control them with additional modifier classes.

Add `.dropdown-menu-end` to a `.dropdown-menu` to right align the dropdown menu. Directions are mirrored when using Bootstrap in RTL, meaning `.dropdown-menu-end` will appear on the left side.

**Heads up!** Dropdowns are positioned thanks to Popper except when they are contained in a navbar.

Right-aligned menu example 

Copy

```html
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Right-aligned menu example
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><button class="dropdown-item" type="button">Action</button></li>
    <li><button class="dropdown-item" type="button">Another action</button></li>
    <li><button class="dropdown-item" type="button">Something else here</button></li>
  </ul>
</div>
```

### Responsive alignment

If you want to use responsive alignment, disable dynamic positioning by adding the `data-bs-display="static"` attribute and use the responsive variation classes.

To align **right** the dropdown menu with the given breakpoint or larger, add `.dropdown-menu{-sm|-md|-lg|-xl|-xxl}-end`.

Left-aligned but right aligned when large screen 

Copy

```html
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Left-aligned but right aligned when large screen
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li><button class="dropdown-item" type="button">Action</button></li>
    <li><button class="dropdown-item" type="button">Another action</button></li>
    <li><button class="dropdown-item" type="button">Something else here</button></li>
  </ul>
</div>
```

To align **left** the dropdown menu with the given breakpoint or larger, add `.dropdown-menu-end` and `.dropdown-menu{-sm|-md|-lg|-xl|-xxl}-start`.

Right-aligned but left aligned when large screen 

Copy

```html
<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Right-aligned but left aligned when large screen
  </button>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
    <li><button class="dropdown-item" type="button">Action</button></li>
    <li><button class="dropdown-item" type="button">Another action</button></li>
    <li><button class="dropdown-item" type="button">Something else here</button></li>
  </ul>
</div>
```

Note that you don’t need to add a `data-bs-display="static"` attribute to dropdown buttons in navbars, since Popper isn’t used in navbars.

### Alignment options

Taking most of the options shown above, here’s a small kitchen sink demo of various dropdown alignment options in one place.

Dropdown 

 

Right-aligned menu 

 

Left-aligned, right-aligned lg 

 

Right-aligned, left-aligned lg 

 

 Dropstart

 

Dropend 

 

Dropup 

Copy

```html
<div class="btn-group">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Right-aligned menu
  </button>
  <ul class="dropdown-menu dropdown-menu-end">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Left-aligned, right-aligned lg
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
    Right-aligned, left-aligned lg
  </button>
  <ul class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group dropstart">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropstart
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group dropend">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropend
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group dropup">
  <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
    Dropup
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>
```

## Menu content

### Headers

Add a header to label sections of actions in any dropdown menu.

- ###### Dropdown header

- [Action](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

- [Another action](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<ul class="dropdown-menu">
  <li><h6 class="dropdown-header">Dropdown header</h6></li>
  <li><a class="dropdown-item" href="#">Action</a></li>
  <li><a class="dropdown-item" href="#">Another action</a></li>
</ul>
```

### Dividers

Separate groups of related menu items with a divider.

- [Action](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

- [Another action](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

- [Something else here](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

- ------

- [Separated link](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<ul class="dropdown-menu">
  <li><a class="dropdown-item" href="#">Action</a></li>
  <li><a class="dropdown-item" href="#">Another action</a></li>
  <li><a class="dropdown-item" href="#">Something else here</a></li>
  <li><hr class="dropdown-divider"></li>
  <li><a class="dropdown-item" href="#">Separated link</a></li>
</ul>
```

### Text

Place any freeform text within a dropdown menu with text and use [spacing utilities](https://getbootstrap.com/docs/5.0/utilities/spacing/). Note that you’ll likely need additional sizing styles to constrain the menu width.

Some example text that's free-flowing within the dropdown menu.

And this is more example text.

Copy

```html
<div class="dropdown-menu p-4 text-muted" style="max-width: 200px;">
  <p>
    Some example text that's free-flowing within the dropdown menu.
  </p>
  <p class="mb-0">
    And this is more example text.
  </p>
</div>
```

### Forms

Put a form within a dropdown menu, or make it into a dropdown menu, and use [margin or padding utilities](https://getbootstrap.com/docs/5.0/utilities/spacing/) to give it the negative space you require.

Email address

Password

Remember me

Sign in

[New around here? Sign up](https://getbootstrap.com/docs/5.0/components/dropdowns/#)[Forgot password?](https://getbootstrap.com/docs/5.0/components/dropdowns/#)

Copy

```html
<div class="dropdown-menu">
  <form class="px-4 py-3">
    <div class="mb-3">
      <label for="exampleDropdownFormEmail1" class="form-label">Email address</label>
      <input type="email" class="form-control" id="exampleDropdownFormEmail1" placeholder="email@example.com">
    </div>
    <div class="mb-3">
      <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password">
    </div>
    <div class="mb-3">
      <div class="form-check">
        <input type="checkbox" class="form-check-input" id="dropdownCheck">
        <label class="form-check-label" for="dropdownCheck">
          Remember me
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Sign in</button>
  </form>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="#">New around here? Sign up</a>
  <a class="dropdown-item" href="#">Forgot password?</a>
</div>
```

Email address

Password

Remember me

Sign in

Copy

```html
<form class="dropdown-menu p-4">
  <div class="mb-3">
    <label for="exampleDropdownFormEmail2" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleDropdownFormEmail2" placeholder="email@example.com">
  </div>
  <div class="mb-3">
    <label for="exampleDropdownFormPassword2" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleDropdownFormPassword2" placeholder="Password">
  </div>
  <div class="mb-3">
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="dropdownCheck2">
      <label class="form-check-label" for="dropdownCheck2">
        Remember me
      </label>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>
```

## Dropdown options

Use `data-bs-offset` or `data-bs-reference` to change the location of the dropdown.

Offset 

ReferenceToggle Dropdown

Copy

```html
<div class="d-flex">
  <div class="dropdown me-1">
    <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdownMenuOffset" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="10,20">
      Offset
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
    </ul>
  </div>
  <div class="btn-group">
    <button type="button" class="btn btn-secondary">Reference</button>
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuReference" data-bs-toggle="dropdown" aria-expanded="false" data-bs-reference="parent">
      <span class="visually-hidden">Toggle Dropdown</span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuReference">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
  </div>
</div>
```

### Auto close behavior

By default, the dropdown menu is closed when clicking inside or outside the dropdown menu. You can use the `autoClose` option to change this behavior of the dropdown.

Default dropdown 

 

Clickable outside 

 

Clickable inside 

 

Manual close 

Copy

```html
<div class="btn-group">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
    Default dropdown
  </button>
  <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableOutside" data-bs-toggle="dropdown" data-bs-auto-close="inside" aria-expanded="false">
    Clickable outside
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableOutside">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickableInside" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
    Clickable inside
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickableInside">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>

<div class="btn-group">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuClickable" data-bs-toggle="dropdown" data-bs-auto-close="false" aria-expanded="false">
    Manual close
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenuClickable">
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
    <li><a class="dropdown-item" href="#">Menu item</a></li>
  </ul>
</div>
```

## Sass

### Variables

Variables for all dropdowns:

Copy

```scss
$dropdown-min-width:                10rem;
$dropdown-padding-x:                0;
$dropdown-padding-y:                .5rem;
$dropdown-spacer:                   .125rem;
$dropdown-font-size:                $font-size-base;
$dropdown-color:                    $body-color;
$dropdown-bg:                       $white;
$dropdown-border-color:             rgba($black, .15);
$dropdown-border-radius:            $border-radius;
$dropdown-border-width:             $border-width;
$dropdown-inner-border-radius:      subtract($dropdown-border-radius, $dropdown-border-width);
$dropdown-divider-bg:               $dropdown-border-color;
$dropdown-divider-margin-y:         $spacer * .5;
$dropdown-box-shadow:               $box-shadow;

$dropdown-link-color:               $gray-900;
$dropdown-link-hover-color:         shade-color($gray-900, 10%);
$dropdown-link-hover-bg:            $gray-200;

$dropdown-link-active-color:        $component-active-color;
$dropdown-link-active-bg:           $component-active-bg;

$dropdown-link-disabled-color:      $gray-500;

$dropdown-item-padding-y:           $spacer * .25;
$dropdown-item-padding-x:           $spacer;

$dropdown-header-color:             $gray-600;
$dropdown-header-padding:           $dropdown-padding-y $dropdown-item-padding-x;
```

Variables for the [dark dropdown](https://getbootstrap.com/docs/5.0/components/dropdowns/#dark-dropdowns):

Copy

```scss
$dropdown-dark-color:               $gray-300;
$dropdown-dark-bg:                  $gray-800;
$dropdown-dark-border-color:        $dropdown-border-color;
$dropdown-dark-divider-bg:          $dropdown-divider-bg;
$dropdown-dark-box-shadow:          null;
$dropdown-dark-link-color:          $dropdown-dark-color;
$dropdown-dark-link-hover-color:    $white;
$dropdown-dark-link-hover-bg:       rgba($white, .15);
$dropdown-dark-link-active-color:   $dropdown-link-active-color;
$dropdown-dark-link-active-bg:      $dropdown-link-active-bg;
$dropdown-dark-link-disabled-color: $gray-500;
$dropdown-dark-header-color:        $gray-500;
```

Variables for the CSS-based carets that indicate a dropdown’s interactivity:

Copy

```scss
$caret-width:                 .3em;
$caret-vertical-align:        $caret-width * .85;
$caret-spacing:               $caret-width * .85;
```

### Mixins

Mixins are used to generate the CSS-based carets and can be found in `scss/mixins/_caret.scss`.

Copy

```scss
@mixin caret-down {
  border-top: $caret-width solid;
  border-right: $caret-width solid transparent;
  border-bottom: 0;
  border-left: $caret-width solid transparent;
}

@mixin caret-up {
  border-top: 0;
  border-right: $caret-width solid transparent;
  border-bottom: $caret-width solid;
  border-left: $caret-width solid transparent;
}

@mixin caret-end {
  border-top: $caret-width solid transparent;
  border-right: 0;
  border-bottom: $caret-width solid transparent;
  border-left: $caret-width solid;
}

@mixin caret-start {
  border-top: $caret-width solid transparent;
  border-right: $caret-width solid;
  border-bottom: $caret-width solid transparent;
}

@mixin caret($direction: down) {
  @if $enable-caret {
    &::after {
      display: inline-block;
      margin-left: $caret-spacing;
      vertical-align: $caret-vertical-align;
      content: "";
      @if $direction == down {
        @include caret-down();
      } @else if $direction == up {
        @include caret-up();
      } @else if $direction == end {
        @include caret-end();
      }
    }

    @if $direction == start {
      &::after {
        display: none;
      }

      &::before {
        display: inline-block;
        margin-right: $caret-spacing;
        vertical-align: $caret-vertical-align;
        content: "";
        @include caret-start();
      }
    }

    &:empty::after {
      margin-left: 0;
    }
  }
}
```

## Usage

Via data attributes or JavaScript, the dropdown plugin toggles hidden content (dropdown menus) by toggling the `.show` class on the parent `.dropdown-menu`. The `data-bs-toggle="dropdown"` attribute is relied on for closing dropdown menus at an application level, so it’s a good idea to always use it.

On touch-enabled devices, opening a dropdown adds empty `mouseover` handlers to the immediate children of the `<body>` element. This admittedly ugly hack is necessary to work around a [quirk in iOS' event delegation](https://www.quirksmode.org/blog/archives/2014/02/mouse_event_bub.html), which would otherwise prevent a tap anywhere outside of the dropdown from triggering the code that closes the dropdown. Once the dropdown is closed, these additional empty `mouseover` handlers are removed.

### Via data attributes

Add `data-bs-toggle="dropdown"` to a link or button to toggle a dropdown.

Copy

```html
<div class="dropdown">
  <button id="dLabel" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown trigger
  </button>
  <ul class="dropdown-menu" aria-labelledby="dLabel">
    ...
  </ul>
</div>
```

### Via JavaScript

Call the dropdowns via JavaScript:

Copy

```js
var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'))
var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
  return new bootstrap.Dropdown(dropdownToggleEl)
})
```

##### `data-bs-toggle="dropdown"` still required

Regardless of whether you call your dropdown via JavaScript or instead use the data-api, `data-bs-toggle="dropdown"` is always required to be present on the dropdown’s trigger element.

### Options

Options can be passed via data attributes or JavaScript. For data attributes, append the option name to `data-bs-`, as in `data-bs-offset=""`. Make sure to change the case type of the option name from camelCase to kebab-case when passing the options via data attributes. For example, instead of using `data-bs-autoClose="false"`, use `data-bs-auto-close="false"`.

| Name           | Type                        | Default             | Description                                                  |
| -------------- | --------------------------- | ------------------- | ------------------------------------------------------------ |
| `boundary`     | string \| element           | `'clippingParents'` | Overflow constraint boundary of the dropdown menu (applies only to Popper's preventOverflow modifier). By default it's `'clippingParents'` and can accept an HTMLElement reference (via JavaScript only). For more information refer to Popper's [detectOverflow docs](https://popper.js.org/docs/v2/utils/detect-overflow/#boundary). |
| `reference`    | string \| element \| object | `'toggle'`          | Reference element of the dropdown menu. Accepts the values of `'toggle'`, `'parent'`, an HTMLElement reference or an object providing `getBoundingClientRect`. For more information refer to Popper's [constructor docs](https://popper.js.org/docs/v2/constructors/#createpopper) and [virtual element docs](https://popper.js.org/docs/v2/virtual-elements/). |
| `display`      | string                      | `'dynamic'`         | By default, we use Popper for dynamic positioning. Disable this with `static`. |
| `offset`       | array \| string \| function | `[0, 2]`            | Offset of the dropdown relative to its target. You can pass a string in data attributes with comma separated values like: `data-bs-offset="10,20"`When a function is used to determine the offset, it is called with an object containing the popper placement, the reference, and popper rects as its first argument. The triggering element DOM node is passed as the second argument. The function must return an array with two numbers: `[skidding, distance]`.For more information refer to Popper's [offset docs](https://popper.js.org/docs/v2/modifiers/offset/#options). |
| `autoClose`    | boolean \| string           | `true`              | Configure the auto close behavior of the dropdown:`true` - the dropdown will be closed by clicking outside or inside the dropdown menu.`false` - the dropdown will be closed by clicking the toggle button and manually calling `hide` or `toggle` method. (Also will not be closed by pressing esc key)`'inside'` - the dropdown will be closed (only) by clicking inside the dropdown menu.`'outside'` - the dropdown will be closed (only) by clicking outside the dropdown menu. |
| `popperConfig` | null \| object \| function  | `null`              | To change Bootstrap's default Popper config, see [Popper's configuration](https://popper.js.org/docs/v2/constructors/#options).When a function is used to create the Popper configuration, it's called with an object that contains the Bootstrap's default Popper configuration. It helps you use and merge the default with your own configuration. The function must return a configuration object for Popper. |

#### Using function with `popperConfig`

Copy

```js
var dropdown = new bootstrap.Dropdown(element, {
  popperConfig: function (defaultBsPopperConfig) {
    // var newPopperConfig = {...}
    // use defaultBsPopperConfig if needed...
    // return newPopperConfig
  }
})
```

### Methods

| Method                | Description                                                  |
| --------------------- | ------------------------------------------------------------ |
| `toggle`              | Toggles the dropdown menu of a given navbar or tabbed navigation. |
| `show`                | Shows the dropdown menu of a given navbar or tabbed navigation. |
| `hide`                | Hides the dropdown menu of a given navbar or tabbed navigation. |
| `update`              | Updates the position of an element's dropdown.               |
| `dispose`             | Destroys an element's dropdown. (Removes stored data on the DOM element) |
| `getInstance`         | Static method which allows you to get the dropdown instance associated to a DOM element, you can use it like this: `bootstrap.Dropdown.getInstance(element)` |
| `getOrCreateInstance` | Static method which returns a dropdown instance associated to a DOM element or create a new one in case it wasn't initialised. You can use it like this: `bootstrap.Dropdown.getOrCreateInstance(element)` |

### Events

All dropdown events are fired at the toggling element and then bubbled up. So you can also add event listeners on the `.dropdown-menu`’s parent element. `hide.bs.dropdown` and `hidden.bs.dropdown` events have a `clickEvent` property (only when the original Event type is `click`) that contains an Event Object for the click event.

| Method               | Description                                                  |
| -------------------- | ------------------------------------------------------------ |
| `show.bs.dropdown`   | Fires immediately when the show instance method is called.   |
| `shown.bs.dropdown`  | Fired when the dropdown has been made visible to the user and CSS transitions have completed. |
| `hide.bs.dropdown`   | Fires immediately when the hide instance method has been called. |
| `hidden.bs.dropdown` | Fired when the dropdown has finished being hidden from the user and CSS transitions have completed. |

Copy

```js
var myDropdown = document.getElementById('myDropdown')
myDropdown.addEventListener('show.bs.dropdown', function () {
  // do something...
})
```

[Bootstrap](https://getbootstrap.com/)

 