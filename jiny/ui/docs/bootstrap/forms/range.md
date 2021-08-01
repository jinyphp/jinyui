# Range

Use our custom range inputs for consistent cross-browser styling and built-in customization.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCKBITK3KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27JCKBITK3KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Overview](https://getbootstrap.com/docs/5.0/forms/range/#overview)[Disabled](https://getbootstrap.com/docs/5.0/forms/range/#disabled)[Min and max](https://getbootstrap.com/docs/5.0/forms/range/#min-and-max)[Steps](https://getbootstrap.com/docs/5.0/forms/range/#steps)[Sass](https://getbootstrap.com/docs/5.0/forms/range/#sass)[Variables](https://getbootstrap.com/docs/5.0/forms/range/#variables)

## Overview

Create custom `<input type="range">` controls with `.form-range`. The track (the background) and thumb (the value) are both styled to appear the same across browsers. As only Firefox supports “filling” their track from the left or right of the thumb as a means to visually indicate progress, we do not currently support it.

Example range 

Copy

```html
<label for="customRange1" class="form-label">Example range</label>
<input type="range" class="form-range" id="customRange1">
```

## Disabled

Add the `disabled` boolean attribute on an input to give it a grayed out appearance and remove pointer events.

Disabled range 

Copy

```html
<label for="disabledRange" class="form-label">Disabled range</label>
<input type="range" class="form-range" id="disabledRange" disabled>
```

## Min and max

Range inputs have implicit values for `min` and `max`—`0` and `100`, respectively. You may specify new values for those using the `min` and `max` attributes.

Example range 

Copy

```html
<label for="customRange2" class="form-label">Example range</label>
<input type="range" class="form-range" min="0" max="5" id="customRange2">
```

## Steps

By default, range inputs “snap” to integer values. To change this, you can specify a `step` value. In the example below, we double the number of steps by using `step="0.5"`.

Example range 

Copy

```html
<label for="customRange3" class="form-label">Example range</label>
<input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
```

## Sass

### Variables

Copy

```scss
$form-range-track-width:          100%;
$form-range-track-height:         .5rem;
$form-range-track-cursor:         pointer;
$form-range-track-bg:             $gray-300;
$form-range-track-border-radius:  1rem;
$form-range-track-box-shadow:     $box-shadow-inset;

$form-range-thumb-width:                   1rem;
$form-range-thumb-height:                  $form-range-thumb-width;
$form-range-thumb-bg:                      $component-active-bg;
$form-range-thumb-border:                  0;
$form-range-thumb-border-radius:           1rem;
$form-range-thumb-box-shadow:              0 .1rem .25rem rgba($black, .1);
$form-range-thumb-focus-box-shadow:        0 0 0 1px $body-bg, $input-focus-box-shadow;
$form-range-thumb-focus-box-shadow-width:  $input-focus-width; // For focus box shadow issue in Edge
$form-range-thumb-active-bg:               tint-color($component-active-bg, 70%);
$form-range-thumb-disabled-bg:             $gray-500;
$form-range-thumb-transition:              background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
```

[Bootstrap](https://getbootstrap.com/)

 