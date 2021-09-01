---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Close button

A generic close button for dismissing content like modals and alerts.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCE7IC5QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCE7IC5QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Example](https://getbootstrap.com/docs/5.0/components/close-button/#example)[Disabled state](https://getbootstrap.com/docs/5.0/components/close-button/#disabled-state)[White variant](https://getbootstrap.com/docs/5.0/components/close-button/#white-variant)[Sass](https://getbootstrap.com/docs/5.0/components/close-button/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/close-button/#variables)

## Example

Provide an option to dismiss or close a component with `.btn-close`. Default styling is limited, but highly customizable. Modify the Sass variables to replace the default `background-image`. **Be sure to include text for screen readers**, as we’ve done with `aria-label`.

Copy

```html
<button type="button" class="btn-close" aria-label="Close"></button>
```

## Disabled state

Disabled close buttons change their `opacity`. We’ve also applied `pointer-events: none` and `user-select: none` to preventing hover and active states from triggering.

Copy

```html
<button type="button" class="btn-close" disabled aria-label="Close"></button>
```

## White variant

Change the default `.btn-close` to be white with the `.btn-close-white` class. This class uses the `filter` property to invert the `background-image`.

 

Copy

```html
<button type="button" class="btn-close btn-close-white" aria-label="Close"></button>
<button type="button" class="btn-close btn-close-white" disabled aria-label="Close"></button>
```

## Sass

### Variables

Copy

```scss
$btn-close-width:            1em;
$btn-close-height:           $btn-close-width;
$btn-close-padding-x:        .25em;
$btn-close-padding-y:        $btn-close-padding-x;
$btn-close-color:            $black;
$btn-close-bg:               url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='#{$btn-close-color}'><path d='M.293.293a1 1 0 011.414 0L8 6.586 14.293.293a1 1 0 111.414 1.414L9.414 8l6.293 6.293a1 1 0 01-1.414 1.414L8 9.414l-6.293 6.293a1 1 0 01-1.414-1.414L6.586 8 .293 1.707a1 1 0 010-1.414z'/></svg>");
$btn-close-focus-shadow:     $input-btn-focus-box-shadow;
$btn-close-opacity:          .5;
$btn-close-hover-opacity:    .75;
$btn-close-focus-opacity:    1;
$btn-close-disabled-opacity: .25;
$btn-close-white-filter:     invert(1) grayscale(100%) brightness(200%);
```

[Bootstrap](https://getbootstrap.com/)

 