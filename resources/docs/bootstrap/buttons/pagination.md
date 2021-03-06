---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Pagination

Documentation and examples for showing pagination to indicate a series of related content exists across multiple pages.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCEYDL2QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCEYDL2QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Overview](https://getbootstrap.com/docs/5.0/components/pagination/#overview)[Working with icons](https://getbootstrap.com/docs/5.0/components/pagination/#working-with-icons)[Disabled and active states](https://getbootstrap.com/docs/5.0/components/pagination/#disabled-and-active-states)[Sizing](https://getbootstrap.com/docs/5.0/components/pagination/#sizing)[Alignment](https://getbootstrap.com/docs/5.0/components/pagination/#alignment)[Sass](https://getbootstrap.com/docs/5.0/components/pagination/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/pagination/#variables)[Mixins](https://getbootstrap.com/docs/5.0/components/pagination/#mixins)

## Overview

We use a large block of connected links for our pagination, making links hard to miss and easily scalable—all while providing large hit areas. Pagination is built with list HTML elements so screen readers can announce the number of available links. Use a wrapping `<nav>` element to identify it as a navigation section to screen readers and other assistive technologies.

In addition, as pages likely have more than one such navigation section, it’s advisable to provide a descriptive `aria-label` for the `<nav>` to reflect its purpose. For example, if the pagination component is used to navigate between a set of search results, an appropriate label could be `aria-label="Search results pages"`.

[Previous](https://getbootstrap.com/docs/5.0/components/pagination/#)[1](https://getbootstrap.com/docs/5.0/components/pagination/#)[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)[Next](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
```

## Working with icons

Looking to use an icon or symbol in place of text for some pagination links? Be sure to provide proper screen reader support with `aria` attributes.

[«](https://getbootstrap.com/docs/5.0/components/pagination/#)[1](https://getbootstrap.com/docs/5.0/components/pagination/#)[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)[»](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
```

## Disabled and active states

Pagination links are customizable for different circumstances. Use `.disabled` for links that appear un-clickable and `.active` to indicate the current page.

While the `.disabled` class uses `pointer-events: none` to *try* to disable the link functionality of `<a>`s, that CSS property is not yet standardized and doesn’t account for keyboard navigation. As such, you should always add `tabindex="-1"` on disabled links and use custom JavaScript to fully disable their functionality.

[Previous](https://getbootstrap.com/docs/5.0/components/pagination/#)[1](https://getbootstrap.com/docs/5.0/components/pagination/#)[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)[Next](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <a class="page-link" href="#">2</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
```

You can optionally swap out active or disabled anchors for `<span>`, or omit the anchor in the case of the prev/next arrows, to remove click functionality and prevent keyboard focus while retaining intended styles.

Previous[1](https://getbootstrap.com/docs/5.0/components/pagination/#)2[3](https://getbootstrap.com/docs/5.0/components/pagination/#)[Next](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item active" aria-current="page">
      <span class="page-link">2</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
```

## Sizing

Fancy larger or smaller pagination? Add `.pagination-lg` or `.pagination-sm` for additional sizes.

1[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="...">
  <ul class="pagination pagination-lg">
    <li class="page-item active" aria-current="page">
      <span class="page-link">1</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
  </ul>
</nav>
```

1[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="...">
  <ul class="pagination pagination-sm">
    <li class="page-item active" aria-current="page">
      <span class="page-link">1</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
  </ul>
</nav>
```

## Alignment

Change the alignment of pagination components with [flexbox utilities](https://getbootstrap.com/docs/5.0/utilities/flex/).

[Previous](https://getbootstrap.com/docs/5.0/components/pagination/#)[1](https://getbootstrap.com/docs/5.0/components/pagination/#)[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)[Next](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
```

[Previous](https://getbootstrap.com/docs/5.0/components/pagination/#)[1](https://getbootstrap.com/docs/5.0/components/pagination/#)[2](https://getbootstrap.com/docs/5.0/components/pagination/#)[3](https://getbootstrap.com/docs/5.0/components/pagination/#)[Next](https://getbootstrap.com/docs/5.0/components/pagination/#)

Copy

```html
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-end">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
```

## Sass

### Variables

Copy

```scss
$pagination-padding-y:              .375rem;
$pagination-padding-x:              .75rem;
$pagination-padding-y-sm:           .25rem;
$pagination-padding-x-sm:           .5rem;
$pagination-padding-y-lg:           .75rem;
$pagination-padding-x-lg:           1.5rem;

$pagination-color:                  $link-color;
$pagination-bg:                     $white;
$pagination-border-width:           $border-width;
$pagination-border-radius:          $border-radius;
$pagination-margin-start:           -$pagination-border-width;
$pagination-border-color:           $gray-300;

$pagination-focus-color:            $link-hover-color;
$pagination-focus-bg:               $gray-200;
$pagination-focus-box-shadow:       $input-btn-focus-box-shadow;
$pagination-focus-outline:          0;

$pagination-hover-color:            $link-hover-color;
$pagination-hover-bg:               $gray-200;
$pagination-hover-border-color:     $gray-300;

$pagination-active-color:           $component-active-color;
$pagination-active-bg:              $component-active-bg;
$pagination-active-border-color:    $pagination-active-bg;

$pagination-disabled-color:         $gray-600;
$pagination-disabled-bg:            $white;
$pagination-disabled-border-color:  $gray-300;

$pagination-transition:              color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;

$pagination-border-radius-sm:       $border-radius-sm;
$pagination-border-radius-lg:       $border-radius-lg;
```

### Mixins

Copy

```scss
@mixin pagination-size($padding-y, $padding-x, $font-size, $border-radius) {
  .page-link {
    padding: $padding-y $padding-x;
    @include font-size($font-size);
  }

  .page-item {
    @if $pagination-margin-start == (-$pagination-border-width) {
      &:first-child {
        .page-link {
          @include border-start-radius($border-radius);
        }
      }

      &:last-child {
        .page-link {
          @include border-end-radius($border-radius);
        }
      }
    } @else {
      //Add border-radius to all pageLinks in case they have left margin
      .page-link {
        @include border-radius($border-radius);
      }
    }
  }
}
```

[Bootstrap](https://getbootstrap.com/)

 