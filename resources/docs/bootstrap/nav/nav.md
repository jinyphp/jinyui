---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Navs and tabs

Documentation and examples for how to use Bootstrap’s included navigation components.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/41334/1550855391-cc_dark.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI65QKCEBD42JLCKSD5KJYCKAIV27JCKAIVK7KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Adobe Creative Cloud for Teams starting at $33.99 per month.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI65QKCEBD42JLCKSD5KJYCKAIV27JCKAIVK7KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Base nav](https://getbootstrap.com/docs/5.0/components/navs-tabs/#base-nav)[Available styles](https://getbootstrap.com/docs/5.0/components/navs-tabs/#available-styles)[Horizontal alignment](https://getbootstrap.com/docs/5.0/components/navs-tabs/#horizontal-alignment)[Vertical](https://getbootstrap.com/docs/5.0/components/navs-tabs/#vertical)[Tabs](https://getbootstrap.com/docs/5.0/components/navs-tabs/#tabs)[Pills](https://getbootstrap.com/docs/5.0/components/navs-tabs/#pills)[Fill and justify](https://getbootstrap.com/docs/5.0/components/navs-tabs/#fill-and-justify)[Working with flex utilities](https://getbootstrap.com/docs/5.0/components/navs-tabs/#working-with-flex-utilities)[Regarding accessibility](https://getbootstrap.com/docs/5.0/components/navs-tabs/#regarding-accessibility)[Using dropdowns](https://getbootstrap.com/docs/5.0/components/navs-tabs/#using-dropdowns)[Tabs with dropdowns](https://getbootstrap.com/docs/5.0/components/navs-tabs/#tabs-with-dropdowns)[Pills with dropdowns](https://getbootstrap.com/docs/5.0/components/navs-tabs/#pills-with-dropdowns)[Sass](https://getbootstrap.com/docs/5.0/components/navs-tabs/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/navs-tabs/#variables)[JavaScript behavior](https://getbootstrap.com/docs/5.0/components/navs-tabs/#javascript-behavior)[Using data attributes](https://getbootstrap.com/docs/5.0/components/navs-tabs/#using-data-attributes)[Via JavaScript](https://getbootstrap.com/docs/5.0/components/navs-tabs/#via-javascript)[Fade effect](https://getbootstrap.com/docs/5.0/components/navs-tabs/#fade-effect)[Methods](https://getbootstrap.com/docs/5.0/components/navs-tabs/#methods)[constructor](https://getbootstrap.com/docs/5.0/components/navs-tabs/#constructor)[show](https://getbootstrap.com/docs/5.0/components/navs-tabs/#show)[dispose](https://getbootstrap.com/docs/5.0/components/navs-tabs/#dispose)[getInstance](https://getbootstrap.com/docs/5.0/components/navs-tabs/#getinstance)[getOrCreateInstance](https://getbootstrap.com/docs/5.0/components/navs-tabs/#getorcreateinstance)[Events](https://getbootstrap.com/docs/5.0/components/navs-tabs/#events)

## Base nav

Navigation available in Bootstrap share general markup and styles, from the base `.nav` class to the active and disabled states. Swap modifier classes to switch between each style.

The base `.nav` component is built with flexbox and provide a strong foundation for building all types of navigation components. It includes some style overrides (for working with lists), some link padding for larger hit areas, and basic disabled styling.

The base `.nav` component does not include any `.active` state. The following examples include the class, mainly to demonstrate that this particular class does not trigger any special styling.

To convey the active state to assistive technologies, use the `aria-current` attribute — using the `page` value for current page, or `true` for the current item in a set.

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

Classes are used throughout, so your markup can be super flexible. Use `<ul>`s like above, `<ol>` if the order of your items is important, or roll your own with a `<nav>` element. Because the `.nav` uses `display: flex`, the nav links behave the same as nav items would, but without the extra markup.

[Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<nav class="nav">
  <a class="nav-link active" aria-current="page" href="#">Active</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
</nav>
```

## Available styles

Change the style of `.nav`s component with modifiers and utilities. Mix and match as needed, or build your own.

### Horizontal alignment

Change the horizontal alignment of your nav with [flexbox utilities](https://getbootstrap.com/docs/5.0/layout/grid/#horizontal-alignment). By default, navs are left-aligned, but you can easily change them to center or right aligned.

Centered with `.justify-content-center`:

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

Right-aligned with `.justify-content-end`:

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav justify-content-end">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

### Vertical

Stack your navigation by changing the flex item direction with the `.flex-column` utility. Need to stack them on some viewports but not others? Use the responsive versions (e.g., `.flex-sm-column`).

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav flex-column">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

As always, vertical navigation is possible without `<ul>`s, too.

[Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<nav class="nav flex-column">
  <a class="nav-link active" aria-current="page" href="#">Active</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
</nav>
```

### Tabs

Takes the basic nav from above and adds the `.nav-tabs` class to generate a tabbed interface. Use them to create tabbable regions with our [tab JavaScript plugin](https://getbootstrap.com/docs/5.0/components/navs-tabs/#javascript-behavior).

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

### Pills

Take that same HTML, but use `.nav-pills` instead:

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

### Fill and justify

Force your `.nav`’s contents to extend the full available width one of two modifier classes. To proportionately fill all available space with your `.nav-item`s, use `.nav-fill`. Notice that all horizontal space is occupied, but not every nav item has the same width.

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Much longer nav link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav nav-pills nav-fill">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Much longer nav link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

When using a `<nav>`-based navigation, you can safely omit `.nav-item` as only `.nav-link` is required for styling `<a>` elements.

[Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Much longer nav link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<nav class="nav nav-pills nav-fill">
  <a class="nav-link active" aria-current="page" href="#">Active</a>
  <a class="nav-link" href="#">Much longer nav link</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
</nav>
```

For equal-width elements, use `.nav-justified`. All horizontal space will be occupied by nav links, but unlike the `.nav-fill` above, every nav item will be the same width.

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Much longer nav link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav nav-pills nav-justified">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Much longer nav link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

Similar to the `.nav-fill` example using a `<nav>`-based navigation.

[Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Much longer nav link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<nav class="nav nav-pills nav-justified">
  <a class="nav-link active" aria-current="page" href="#">Active</a>
  <a class="nav-link" href="#">Much longer nav link</a>
  <a class="nav-link" href="#">Link</a>
  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
</nav>
```

## Working with flex utilities

If you need responsive nav variations, consider using a series of [flexbox utilities](https://getbootstrap.com/docs/5.0/utilities/flex/). While more verbose, these utilities offer greater customization across responsive breakpoints. In the example below, our nav will be stacked on the lowest breakpoint, then adapt to a horizontal layout that fills the available width starting from the small breakpoint.

[Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Longer nav link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)[Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<nav class="nav nav-pills flex-column flex-sm-row">
  <a class="flex-sm-fill text-sm-center nav-link active" aria-current="page" href="#">Active</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="#">Longer nav link</a>
  <a class="flex-sm-fill text-sm-center nav-link" href="#">Link</a>
  <a class="flex-sm-fill text-sm-center nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
</nav>
```

## Regarding accessibility

If you’re using navs to provide a navigation bar, be sure to add a `role="navigation"` to the most logical parent container of the `<ul>`, or wrap a `<nav>` element around the whole navigation. Do not add the role to the `<ul>` itself, as this would prevent it from being announced as an actual list by assistive technologies.

Note that navigation bars, even if visually styled as tabs with the `.nav-tabs` class, should **not** be given `role="tablist"`, `role="tab"` or `role="tabpanel"` attributes. These are only appropriate for dynamic tabbed interfaces, as described in the [WAI ARIA Authoring Practices](https://www.w3.org/TR/wai-aria-practices/#tabpanel). See [JavaScript behavior](https://getbootstrap.com/docs/5.0/components/navs-tabs/#javascript-behavior) for dynamic tabbed interfaces in this section for an example. The `aria-current` attribute is not necessary on dynamic tabbed interfaces since our JavaScript handles the selected state by adding `aria-selected="true"` on the active tab.

## Using dropdowns

Add dropdown menus with a little extra HTML and the [dropdowns JavaScript plugin](https://getbootstrap.com/docs/5.0/components/dropdowns/#usage).

### Tabs with dropdowns

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Dropdown](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

### Pills with dropdowns

- [Active](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Dropdown](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Link](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)
- [Disabled](https://getbootstrap.com/docs/5.0/components/navs-tabs/#)

Copy

```html
<ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="#">Active</a>
  </li>
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Dropdown</a>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="#">Action</a></li>
      <li><a class="dropdown-item" href="#">Another action</a></li>
      <li><a class="dropdown-item" href="#">Something else here</a></li>
      <li><hr class="dropdown-divider"></li>
      <li><a class="dropdown-item" href="#">Separated link</a></li>
    </ul>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
  </li>
</ul>
```

## Sass

### Variables

Copy

```scss
$nav-link-padding-y:                .5rem;
$nav-link-padding-x:                1rem;
$nav-link-font-size:                null;
$nav-link-font-weight:              null;
$nav-link-color:                    $link-color;
$nav-link-hover-color:              $link-hover-color;
$nav-link-transition:               color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out;
$nav-link-disabled-color:           $gray-600;

$nav-tabs-border-color:             $gray-300;
$nav-tabs-border-width:             $border-width;
$nav-tabs-border-radius:            $border-radius;
$nav-tabs-link-hover-border-color:  $gray-200 $gray-200 $nav-tabs-border-color;
$nav-tabs-link-active-color:        $gray-700;
$nav-tabs-link-active-bg:           $body-bg;
$nav-tabs-link-active-border-color: $gray-300 $gray-300 $nav-tabs-link-active-bg;

$nav-pills-border-radius:           $border-radius;
$nav-pills-link-active-color:       $component-active-color;
$nav-pills-link-active-bg:          $component-active-bg;
```

## JavaScript behavior

Use the tab JavaScript plugin—include it individually or through the compiled `bootstrap.js` file—to extend our navigational tabs and pills to create tabbable panes of local content.

Dynamic tabbed interfaces, as described in the [WAI ARIA Authoring Practices](https://www.w3.org/TR/wai-aria-practices/#tabpanel), require `role="tablist"`, `role="tab"`, `role="tabpanel"`, and additional `aria-` attributes in order to convey their structure, functionality and current state to users of assistive technologies (such as screen readers). As a best practice, we recommend using `<button>` elements for the tabs, as these are controls that trigger a dynamic change, rather than links that navigate to a new page or location.

Note that dynamic tabbed interfaces should *not* contain dropdown menus, as this causes both usability and accessibility issues. From a usability perspective, the fact that the currently displayed tab’s trigger element is not immediately visible (as it’s inside the closed dropdown menu) can cause confusion. From an accessibility point of view, there is currently no sensible way to map this sort of construct to a standard WAI ARIA pattern, meaning that it cannot be easily made understandable to users of assistive technologies.

- Home
- Profile
- Contact

**This is some placeholder content the Home tab's associated content.** Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other `.nav`-powered navigation.

Copy

```html
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
```

To help fit your needs, this works with `<ul>`-based markup, as shown above, or with any arbitrary “roll your own” markup. Note that if you’re using `<nav>`, you shouldn’t add `role="tablist"` directly to it, as this would override the element’s native role as a navigation landmark. Instead, switch to an alternative element (in the example below, a simple `<div>`) and wrap the `<nav>` around it.

HomeProfileContact

**This is some placeholder content the Home tab's associated content.** Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other `.nav`-powered navigation.

Copy

```html
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div>
```

The tabs plugin also works with pills.

- Home
- Profile
- Contact

**This is some placeholder content the Home tab's associated content.** Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other `.nav`-powered navigation.

Copy

```html
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
</div>
```

And with vertical pills.

HomeProfileMessagesSettings

**This is some placeholder content the Home tab's associated content.** Clicking another tab will toggle the visibility of this one for the next. The tab JavaScript swaps classes to control the content visibility and styling. You can use it with tabs, pills, and any other `.nav`-powered navigation.

Copy

```html
<div class="d-flex align-items-start">
  <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
  </div>
  <div class="tab-content" id="v-pills-tabContent">
    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">...</div>
    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">...</div>
    <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
    <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
  </div>
</div>
```

### Using data attributes

You can activate a tab or pill navigation without writing any JavaScript by simply specifying `data-bs-toggle="tab"` or `data-bs-toggle="pill"` on an element. Use these data attributes on `.nav-tabs` or `.nav-pills`.

Copy

```html
<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Messages</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
  <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
</div>
```

### Via JavaScript

Enable tabbable tabs via JavaScript (each tab needs to be activated individually):

Copy

```js
var triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
triggerTabList.forEach(function (triggerEl) {
  var tabTrigger = new bootstrap.Tab(triggerEl)

  triggerEl.addEventListener('click', function (event) {
    event.preventDefault()
    tabTrigger.show()
  })
})
```

You can activate individual tabs in several ways:

Copy

```js
var triggerEl = document.querySelector('#myTab a[href="#profile"]')
bootstrap.Tab.getInstance(triggerEl).show() // Select tab by name

var triggerFirstTabEl = document.querySelector('#myTab li:first-child a')
bootstrap.Tab.getInstance(triggerFirstTabEl).show() // Select first tab
```

### Fade effect

To make tabs fade in, add `.fade` to each `.tab-pane`. The first tab pane must also have `.show` to make the initial content visible.

Copy

```html
<div class="tab-content">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
  <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
</div>
```

### Methods

#### Asynchronous methods and transitions

All API methods are **asynchronous** and start a **transition**. They return to the caller as soon as the transition is started but **before it ends**. In addition, a method call on a **transitioning component will be ignored**.

[See our JavaScript documentation for more information](https://getbootstrap.com/docs/5.0/getting-started/javascript/#asynchronous-functions-and-transitions).

#### constructor

Activates a tab element and content container. Tab should have either a `data-bs-target` or, if using a link, an `href` attribute, targeting a container node in the DOM.

Copy

```html
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab" aria-controls="messages" aria-selected="false">Messages</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">Settings</button>
  </li>
</ul>

<div class="tab-content">
  <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
  <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
</div>

<script>
  var firstTabEl = document.querySelector('#myTab li:last-child a')
  var firstTab = new bootstrap.Tab(firstTabEl)

  firstTab.show()
</script>
```

#### show

Selects the given tab and shows its associated pane. Any other tab that was previously selected becomes unselected and its associated pane is hidden. **Returns to the caller before the tab pane has actually been shown** (i.e. before the `shown.bs.tab` event occurs).

Copy

```js
  var someTabTriggerEl = document.querySelector('#someTabTrigger')
  var tab = new bootstrap.Tab(someTabTriggerEl)

  tab.show()
```

#### dispose

Destroys an element’s tab.

#### getInstance

*Static* method which allows you to get the tab instance associated with a DOM element

Copy

```js
var triggerEl = document.querySelector('#trigger')
var tab = bootstrap.Tab.getInstance(triggerEl) // Returns a Bootstrap tab instance
```

#### getOrCreateInstance

*Static* method which allows you to get the tab instance associated with a DOM element, or create a new one in case it wasn’t initialised

Copy

```js
var triggerEl = document.querySelector('#trigger')
var tab = bootstrap.Tab.getOrCreateInstance(triggerEl) // Returns a Bootstrap tab instance
```

### Events

When showing a new tab, the events fire in the following order:

1. `hide.bs.tab` (on the current active tab)
2. `show.bs.tab` (on the to-be-shown tab)
3. `hidden.bs.tab` (on the previous active tab, the same one as for the `hide.bs.tab` event)
4. `shown.bs.tab` (on the newly-active just-shown tab, the same one as for the `show.bs.tab` event)

If no tab was already active, then the `hide.bs.tab` and `hidden.bs.tab` events will not be fired.

| Event type      | Description                                                  |
| --------------- | ------------------------------------------------------------ |
| `show.bs.tab`   | This event fires on tab show, but before the new tab has been shown. Use `event.target` and `event.relatedTarget` to target the active tab and the previous active tab (if available) respectively. |
| `shown.bs.tab`  | This event fires on tab show after a tab has been shown. Use `event.target` and `event.relatedTarget` to target the active tab and the previous active tab (if available) respectively. |
| `hide.bs.tab`   | This event fires when a new tab is to be shown (and thus the previous active tab is to be hidden). Use `event.target` and `event.relatedTarget` to target the current active tab and the new soon-to-be-active tab, respectively. |
| `hidden.bs.tab` | This event fires after a new tab is shown (and thus the previous active tab is hidden). Use `event.target` and `event.relatedTarget` to target the previous active tab and the new active tab, respectively. |

Copy

```js
var tabEl = document.querySelector('button[data-bs-toggle="tab"]')
tabEl.addEventListener('shown.bs.tab', function (event) {
  event.target // newly activated tab
  event.relatedTarget // previous active tab
})
```

[Bootstrap](https://getbootstrap.com/)

 