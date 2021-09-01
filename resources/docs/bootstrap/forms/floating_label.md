---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Floating labels

Create beautifully simple form labels that float over your input fields.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCKYI6K7KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCKYI6K7KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Example](https://getbootstrap.com/docs/5.0/forms/floating-labels/#example)[Textareas](https://getbootstrap.com/docs/5.0/forms/floating-labels/#textareas)[Selects](https://getbootstrap.com/docs/5.0/forms/floating-labels/#selects)[Layout](https://getbootstrap.com/docs/5.0/forms/floating-labels/#layout)[Sass](https://getbootstrap.com/docs/5.0/forms/floating-labels/#sass)[Variables](https://getbootstrap.com/docs/5.0/forms/floating-labels/#variables)

## Example

Wrap a pair of `<input class="form-control">` and `<label>` elements in `.form-floating` to enable floating labels with Bootstrap’s textual form fields. A `placeholder` is required on each `<input>` as our method of CSS-only floating labels uses the `:placeholder-shown` pseudo-element. Also note that the `<input>` must come first so we can utilize a sibling selector (e.g., `~`).

Email address

Password

Copy

```html
<div class="form-floating mb-3">
  <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
  <label for="floatingInput">Email address</label>
</div>
<div class="form-floating">
  <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
  <label for="floatingPassword">Password</label>
</div>
```

When there’s a `value` already defined, `<label>`s will automatically adjust to their floated position.

Input with value

Copy

```html
<form class="form-floating">
  <input type="email" class="form-control" id="floatingInputValue" placeholder="name@example.com" value="test@example.com">
  <label for="floatingInputValue">Input with value</label>
</form>
```

Form validation styles also work as expected.

Invalid input

Copy

```html
<form class="form-floating">
  <input type="email" class="form-control is-invalid" id="floatingInputInvalid" placeholder="name@example.com" value="test@example.com">
  <label for="floatingInputInvalid">Invalid input</label>
</form>
```

## Textareas

By default, `<textarea>`s with `.form-control` will be the same height as `<input>`s.

Comments

Copy

```html
<div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
  <label for="floatingTextarea">Comments</label>
</div>
```

To set a custom height on your `<textarea>`, do not use the `rows` attribute. Instead, set an explicit `height` (either inline or via custom CSS).

Comments

Copy

```html
<div class="form-floating">
  <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
  <label for="floatingTextarea2">Comments</label>
</div>
```

## Selects

Other than `.form-control`, floating labels are only available on `.form-select`s. They work in the same way, but unlike `<input>`s, they’ll always show the `<label>` in its floated state. **Selects with `size` and `multiple` are not supported.**

   Open this select menu   One   Two   Three  Works with selects

Copy

```html
<div class="form-floating">
  <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
    <option selected>Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
  <label for="floatingSelect">Works with selects</label>
</div>
```

## Layout

When working with the Bootstrap grid system, be sure to place form elements within column classes.

Email address

​      Open this select menu      One      Two      Three     Works with selects

Copy

```html
<div class="row g-2">
  <div class="col-md">
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInputGrid" placeholder="name@example.com" value="mdo@example.com">
      <label for="floatingInputGrid">Email address</label>
    </div>
  </div>
  <div class="col-md">
    <div class="form-floating">
      <select class="form-select" id="floatingSelectGrid" aria-label="Floating label select example">
        <option selected>Open this select menu</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
      <label for="floatingSelectGrid">Works with selects</label>
    </div>
  </div>
</div>
```

## Sass

### Variables

Copy

```scss
$form-floating-height:            add(3.5rem, $input-height-border);
$form-floating-line-height:       1.25;
$form-floating-padding-x:         $input-padding-x;
$form-floating-padding-y:         1rem;
$form-floating-input-padding-t:   1.625rem;
$form-floating-input-padding-b:   .625rem;
$form-floating-label-opacity:     .65;
$form-floating-label-transform:   scale(.85) translateY(-.5rem) translateX(.15rem);
$form-floating-transition:        opacity .1s ease-in-out, transform .1s ease-in-out;
```

[Bootstrap](https://getbootstrap.com/)

 