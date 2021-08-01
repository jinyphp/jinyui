# Select

Customize the native `<select>`s with custom CSS that changes the element’s initial appearance.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCKBIT5QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCKBIT5QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Default](https://getbootstrap.com/docs/5.0/forms/select/#default)[Sizing](https://getbootstrap.com/docs/5.0/forms/select/#sizing)[Disabled](https://getbootstrap.com/docs/5.0/forms/select/#disabled)[Sass](https://getbootstrap.com/docs/5.0/forms/select/#sass)[Variables](https://getbootstrap.com/docs/5.0/forms/select/#variables)

## Default

Custom `<select>` menus need only a custom class, `.form-select` to trigger the custom styles. Custom styles are limited to the `<select>`’s initial appearance and cannot modify the `<option>`s due to browser limitations.

  Open this select menu  One  Two  Three 

Copy

```html
<select class="form-select" aria-label="Default select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
```

## Sizing

You may also choose from small and large custom selects to match our similarly sized text inputs.

  Open this select menu  One  Two  Three   Open this select menu  One  Two  Three 

Copy

```html
<select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>

<select class="form-select form-select-sm" aria-label=".form-select-sm example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
```

The `multiple` attribute is also supported:

  Open this select menu  One  Two  Three 

Copy

```html
<select class="form-select" multiple aria-label="multiple select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
```

As is the `size` attribute:

  Open this select menu  One  Two  Three 

Copy

```html
<select class="form-select" size="3" aria-label="size 3 select example">
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
```

## Disabled

Add the `disabled` boolean attribute on a select to give it a grayed out appearance and remove pointer events.

  Open this select menu  One  Two  Three 

Copy

```html
<select class="form-select" aria-label="Disabled select example" disabled>
  <option selected>Open this select menu</option>
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
</select>
```

## Sass

### Variables

Copy

```scss
$form-select-padding-y:             $input-padding-y;
$form-select-padding-x:             $input-padding-x;
$form-select-font-family:           $input-font-family;
$form-select-font-size:             $input-font-size;
$form-select-indicator-padding:     $form-select-padding-x * 3; // Extra padding for background-image
$form-select-font-weight:           $input-font-weight;
$form-select-line-height:           $input-line-height;
$form-select-color:                 $input-color;
$form-select-bg:                    $input-bg;
$form-select-disabled-color:        null;
$form-select-disabled-bg:           $gray-200;
$form-select-disabled-border-color: $input-disabled-border-color;
$form-select-bg-position:           right $form-select-padding-x center;
$form-select-bg-size:               16px 12px; // In pixels because image dimensions
$form-select-indicator-color:       $gray-800;
$form-select-indicator:             url("data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'><path fill='none' stroke='#{$form-select-indicator-color}' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/></svg>");

$form-select-feedback-icon-padding-end: $form-select-padding-x * 2.5 + $form-select-indicator-padding;
$form-select-feedback-icon-position:    center right $form-select-indicator-padding;
$form-select-feedback-icon-size:        $input-height-inner-half $input-height-inner-half;

$form-select-border-width:        $input-border-width;
$form-select-border-color:        $input-border-color;
$form-select-border-radius:       $border-radius;
$form-select-box-shadow:          $box-shadow-inset;

$form-select-focus-border-color:  $input-focus-border-color;
$form-select-focus-width:         $input-focus-width;
$form-select-focus-box-shadow:    0 0 0 $form-select-focus-width $input-btn-focus-color;

$form-select-padding-y-sm:        $input-padding-y-sm;
$form-select-padding-x-sm:        $input-padding-x-sm;
$form-select-font-size-sm:        $input-font-size-sm;

$form-select-padding-y-lg:        $input-padding-y-lg;
$form-select-padding-x-lg:        $input-padding-x-lg;
$form-select-font-size-lg:        $input-font-size-lg;

$form-select-transition:          $input-transition;
```

[Bootstrap](https://getbootstrap.com/)

 