# Tables

Documentation and examples for opt-in styling of tables (given their prevalent use in JavaScript plugins) with Bootstrap.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCK7ITKQKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52QYF67I553KCEBD42JLCKSD5KJYCKAIV27JCK7ITKQKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Overview](https://getbootstrap.com/docs/5.0/content/tables/#overview)[Variants](https://getbootstrap.com/docs/5.0/content/tables/#variants)[Accented tables](https://getbootstrap.com/docs/5.0/content/tables/#accented-tables)[Striped rows](https://getbootstrap.com/docs/5.0/content/tables/#striped-rows)[Hoverable rows](https://getbootstrap.com/docs/5.0/content/tables/#hoverable-rows)[Active tables](https://getbootstrap.com/docs/5.0/content/tables/#active-tables)[How do the variants and accented tables work?](https://getbootstrap.com/docs/5.0/content/tables/#how-do-the-variants-and-accented-tables-work)[Table borders](https://getbootstrap.com/docs/5.0/content/tables/#table-borders)[Bordered tables](https://getbootstrap.com/docs/5.0/content/tables/#bordered-tables)[Tables without borders](https://getbootstrap.com/docs/5.0/content/tables/#tables-without-borders)[Small tables](https://getbootstrap.com/docs/5.0/content/tables/#small-tables)[Vertical alignment](https://getbootstrap.com/docs/5.0/content/tables/#vertical-alignment)[Nesting](https://getbootstrap.com/docs/5.0/content/tables/#nesting)[How nesting works](https://getbootstrap.com/docs/5.0/content/tables/#how-nesting-works)[Anatomy](https://getbootstrap.com/docs/5.0/content/tables/#anatomy)[Table head](https://getbootstrap.com/docs/5.0/content/tables/#table-head)[Table foot](https://getbootstrap.com/docs/5.0/content/tables/#table-foot)[Captions](https://getbootstrap.com/docs/5.0/content/tables/#captions)[Responsive tables](https://getbootstrap.com/docs/5.0/content/tables/#responsive-tables)[Always responsive](https://getbootstrap.com/docs/5.0/content/tables/#always-responsive)[Breakpoint specific](https://getbootstrap.com/docs/5.0/content/tables/#breakpoint-specific)[Sass](https://getbootstrap.com/docs/5.0/content/tables/#sass)[Variables](https://getbootstrap.com/docs/5.0/content/tables/#variables)[Loop](https://getbootstrap.com/docs/5.0/content/tables/#loop)[Customizing](https://getbootstrap.com/docs/5.0/content/tables/#customizing)

## Overview

Due to the widespread use of `<table>` elements across third-party widgets like calendars and date pickers, Bootstrap’s tables are **opt-in**. Add the base class `.table` to any `<table>`, then extend with our optional modifier classes or custom styles. All table styles are not inherited in Bootstrap, meaning any nested tables can be styled independent from the parent.

Using the most basic table markup, here’s how `.table`-based tables look in Bootstrap.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
```

## Variants

Use contextual classes to color tables, table rows or individual cells.

| Class     | Heading | Heading |
| --------- | ------- | ------- |
| Default   | Cell    | Cell    |
| Primary   | Cell    | Cell    |
| Secondary | Cell    | Cell    |
| Success   | Cell    | Cell    |
| Danger    | Cell    | Cell    |
| Warning   | Cell    | Cell    |
| Info      | Cell    | Cell    |
| Light     | Cell    | Cell    |
| Dark      | Cell    | Cell    |

Copy

```html
<!-- On tables -->
<table class="table-primary">...</table>
<table class="table-secondary">...</table>
<table class="table-success">...</table>
<table class="table-danger">...</table>
<table class="table-warning">...</table>
<table class="table-info">...</table>
<table class="table-light">...</table>
<table class="table-dark">...</table>

<!-- On rows -->
<tr class="table-primary">...</tr>
<tr class="table-secondary">...</tr>
<tr class="table-success">...</tr>
<tr class="table-danger">...</tr>
<tr class="table-warning">...</tr>
<tr class="table-info">...</tr>
<tr class="table-light">...</tr>
<tr class="table-dark">...</tr>

<!-- On cells (`td` or `th`) -->
<tr>
  <td class="table-primary">...</td>
  <td class="table-secondary">...</td>
  <td class="table-success">...</td>
  <td class="table-danger">...</td>
  <td class="table-warning">...</td>
  <td class="table-info">...</td>
  <td class="table-light">...</td>
  <td class="table-dark">...</td>
</tr>
```

##### Conveying meaning to assistive technologies

Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the `.visually-hidden` class.

## Accented tables

### Striped rows

Use `.table-striped` to add zebra-striping to any table row within the `<tbody>`.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-striped">
  ...
</table>
```

These classes can also be added to table variants:

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-dark table-striped">
  ...
</table>
```

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-success table-striped">
  ...
</table>
```

### Hoverable rows

Add `.table-hover` to enable a hover state on table rows within a `<tbody>`.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-hover">
  ...
</table>
```

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-dark table-hover">
  ...
</table>
```

These hoverable rows can also be combined with the striped variant:

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-striped table-hover">
  ...
</table>
```

### Active tables

Highlight a table row or cell by adding a `.table-active` class.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table">
  <thead>
    ...
  </thead>
  <tbody>
    <tr class="table-active">
      ...
    </tr>
    <tr>
      ...
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2" class="table-active">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
```

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-dark">
  <thead>
    ...
  </thead>
  <tbody>
    <tr class="table-active">
      ...
    </tr>
    <tr>
      ...
    </tr>
    <tr>
      <th scope="row">3</th>
      <td colspan="2" class="table-active">Larry the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
```

## How do the variants and accented tables work?

For the accented tables ([striped rows](https://getbootstrap.com/docs/5.0/content/tables/#striped-rows), [hoverable rows](https://getbootstrap.com/docs/5.0/content/tables/#hoverable-rows), and [active tables](https://getbootstrap.com/docs/5.0/content/tables/#active-tables)), we used some techniques to make these effects work for all our [table variants](https://getbootstrap.com/docs/5.0/content/tables/#variants):

- We start by setting the background of a table cell with the `--bs-table-bg` custom property. All table variants then set that custom property to colorize the table cells. This way, we don’t get into trouble if semi-transparent colors are used as table backgrounds.
- Then we add an inset box shadow on the table cells with `box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);` to layer on top of any specified `background-color`. Because we use a huge spread and no blur, the color will be monotone. Since `--bs-table-accent-bg` is unset by default, we don’t have a default box shadow.
- When either `.table-striped`, `.table-hover` or `.table-active` classes are added, the `--bs-table-accent-bg` is set to a semitransparent color to colorize the background.
- For each table variant, we generate a `--bs-table-accent-bg` color with the highest contrast depending on that color. For example, the accent color for `.table-primary` is darker while `.table-dark` has a lighter accent color.
- Text and border colors are generated the same way, and their colors are inherited by default.

Behind the scenes it looks like this:

Copy

```scss
@mixin table-variant($state, $background) {
  .table-#{$state} {
    $color: color-contrast(opaque($body-bg, $background));
    $hover-bg: mix($color, $background, percentage($table-hover-bg-factor));
    $striped-bg: mix($color, $background, percentage($table-striped-bg-factor));
    $active-bg: mix($color, $background, percentage($table-active-bg-factor));

    --#{$variable-prefix}table-bg: #{$background};
    --#{$variable-prefix}table-striped-bg: #{$striped-bg};
    --#{$variable-prefix}table-striped-color: #{color-contrast($striped-bg)};
    --#{$variable-prefix}table-active-bg: #{$active-bg};
    --#{$variable-prefix}table-active-color: #{color-contrast($active-bg)};
    --#{$variable-prefix}table-hover-bg: #{$hover-bg};
    --#{$variable-prefix}table-hover-color: #{color-contrast($hover-bg)};

    color: $color;
    border-color: mix($color, $background, percentage($table-border-factor));
  }
}
```

## Table borders

### Bordered tables

Add `.table-bordered` for borders on all sides of the table and cells.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-bordered">
  ...
</table>
```

[Border color utilities](https://getbootstrap.com/docs/5.0/utilities/borders/#border-color) can be added to change colors:

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-bordered border-primary">
  ...
</table>
```

### Tables without borders

Add `.table-borderless` for a table without borders.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-borderless">
  ...
</table>
```

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-dark table-borderless">
  ...
</table>
```

## Small tables

Add `.table-sm` to make any `.table` more compact by cutting all cell `padding` in half.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-sm">
  ...
</table>
```

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-dark table-sm">
  ...
</table>
```

## Vertical alignment

Table cells of `<thead>` are always vertical aligned to the bottom. Table cells in `<tbody>` inherit their alignment from `<table>` and are aligned to the the top by default. Use the [vertical align](https://getbootstrap.com/docs/5.0/utilities/vertical-align/) classes to re-align where needed.

| Heading 1                                                    | Heading 2                                                    | Heading 3                                                    | Heading 4                                                    |
| ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ | ------------------------------------------------------------ |
| This cell inherits `vertical-align: middle;` from the table  | This cell inherits `vertical-align: middle;` from the table  | This cell inherits `vertical-align: middle;` from the table  | This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells. |
| This cell inherits `vertical-align: bottom;` from the table row | This cell inherits `vertical-align: bottom;` from the table row | This cell inherits `vertical-align: bottom;` from the table row | This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells. |
| This cell inherits `vertical-align: middle;` from the table  | This cell inherits `vertical-align: middle;` from the table  | This cell is aligned to the top.                             | This here is some placeholder text, intended to take up quite a bit of vertical space, to demonstrate how the vertical alignment works in the preceding cells. |

Copy

```html
<div class="table-responsive">
  <table class="table align-middle">
    <thead>
      <tr>
        ...
      </tr>
    </thead>
    <tbody>
      <tr>
        ...
      </tr>
      <tr class="align-bottom">
        ...
      </tr>
      <tr>
        <td>...</td>
        <td>...</td>
        <td class="align-top">This cell is aligned to the top.</td>
        <td>...</td>
      </tr>
    </tbody>
  </table>
</div>
```

## Nesting

Border styles, active styles, and table variants are not inherited by nested tables.

| #                                                | First | Last     | Handle   |
| ------------------------------------------------ | ----- | -------- | -------- |
| 1                                                | Mark  | Otto     | @mdo     |
| HeaderHeaderHeaderAFirstLastBFirstLastCFirstLast |       |          |          |
| 3                                                | Larry | the Bird | @twitter |

Copy

```html
<table class="table table-striped">
  <thead>
    ...
  </thead>
  <tbody>
    ...
    <tr>
      <td colspan="4">
        <table class="table mb-0">
          ...
        </table>
      </td>
    </tr>
    ...
  </tbody>
</table>
```

## How nesting works

To prevent *any* styles from leaking to nested tables, we use the child combinator (`>`) selector in our CSS. Since we need to target all the `td`s and `th`s in the `thead`, `tbody`, and `tfoot`, our selector would look pretty long without it. As such, we use the rather odd looking `.table > :not(caption) > * > *` selector to target all `td`s and `th`s of the `.table`, but none of any potential nested tables.

Note that if you add `<tr>`s as direct children of a table, those `<tr>` will be wrapped in a `<tbody>` by default, thus making our selectors work as intended.

## Anatomy

### Table head

Similar to tables and dark tables, use the modifier classes `.table-light` or `.table-dark` to make `<thead>`s appear light or dark gray.

| #    | First | Last     | Handle   |
| ---- | ----- | -------- | -------- |
| 1    | Mark  | Otto     | @mdo     |
| 2    | Jacob | Thornton | @fat     |
| 3    | Larry | the Bird | @twitter |

Copy

```html
<table class="table">
  <thead class="table-light">
    ...
  </thead>
  <tbody>
    ...
  </tbody>
</table>
```

| #    | First | Last     | Handle   |
| ---- | ----- | -------- | -------- |
| 1    | Mark  | Otto     | @mdo     |
| 2    | Jacob | Thornton | @fat     |
| 3    | Larry | the Bird | @twitter |

Copy

```html
<table class="table">
  <thead class="table-dark">
    ...
  </thead>
  <tbody>
    ...
  </tbody>
</table>
```

### Table foot

| #      | First  | Last     | Handle   |
| ------ | ------ | -------- | -------- |
| 1      | Mark   | Otto     | @mdo     |
| 2      | Jacob  | Thornton | @fat     |
| 3      | Larry  | the Bird | @twitter |
| Footer | Footer | Footer   | Footer   |

Copy

```html
<table class="table">
  <thead>
    ...
  </thead>
  <tbody>
    ...
  </tbody>
  <tfoot>
    ...
  </tfoot>
</table>
```

### Captions

A `<caption>` functions like a heading for a table. It helps users with screen readers to find a table and understand what it’s about and decide if they want to read it.

| #    | First          | Last     | Handle |
| ---- | -------------- | -------- | ------ |
| 1    | Mark           | Otto     | @mdo   |
| 2    | Jacob          | Thornton | @fat   |
| 3    | Larry the Bird | @twitter |        |

Copy

```html
<table class="table table-sm">
  <caption>List of users</caption>
  <thead>
    ...
  </thead>
  <tbody>
    ...
  </tbody>
</table>
```

You can also put the `<caption>` on the top of the table with `.caption-top`.

| #    | First | Last     | Handle   |
| ---- | ----- | -------- | -------- |
| 1    | Mark  | Otto     | @mdo     |
| 2    | Jacob | Thornton | @fat     |
| 3    | Larry | the Bird | @twitter |

Copy

```html
<table class="table caption-top">
  <caption>List of users</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">First</th>
      <th scope="col">Last</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
      <td>@fat</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
      <td>@twitter</td>
    </tr>
  </tbody>
</table>
```

## Responsive tables

Responsive tables allow tables to be scrolled horizontally with ease. Make any table responsive across all viewports by wrapping a `.table` with `.table-responsive`. Or, pick a maximum breakpoint with which to have a responsive table up to by using `.table-responsive{-sm|-md|-lg|-xl|-xxl}`.

##### Vertical clipping/truncation

Responsive tables make use of `overflow-y: hidden`, which clips off any content that goes beyond the bottom or top edges of the table. In particular, this can clip off dropdown menus and other third-party widgets.

### Always responsive

Across every breakpoint, use `.table-responsive` for horizontally scrolling tables.

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

Copy

```html
<div class="table-responsive">
  <table class="table">
    ...
  </table>
</div>
```

### Breakpoint specific

Use `.table-responsive{-sm|-md|-lg|-xl|-xxl}` as needed to create responsive tables up to a particular breakpoint. From that breakpoint and up, the table will behave normally and not scroll horizontally.

**These tables may appear broken until their responsive styles apply at specific viewport widths.**

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

| #    | Heading | Heading | Heading | Heading | Heading | Heading | Heading | Heading |
| ---- | ------- | ------- | ------- | ------- | ------- | ------- | ------- | ------- |
| 1    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 2    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |
| 3    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    | Cell    |

Copy

```html
<div class="table-responsive">
  <table class="table">
    ...
  </table>
</div>

<div class="table-responsive-sm">
  <table class="table">
    ...
  </table>
</div>

<div class="table-responsive-md">
  <table class="table">
    ...
  </table>
</div>

<div class="table-responsive-lg">
  <table class="table">
    ...
  </table>
</div>

<div class="table-responsive-xl">
  <table class="table">
    ...
  </table>
</div>

<div class="table-responsive-xxl">
  <table class="table">
    ...
  </table>
</div>
```

## Sass

### Variables

Copy

```scss
$table-cell-padding-y:        .5rem;
$table-cell-padding-x:        .5rem;
$table-cell-padding-y-sm:     .25rem;
$table-cell-padding-x-sm:     .25rem;

$table-cell-vertical-align:   top;

$table-color:                 $body-color;
$table-bg:                    transparent;
$table-accent-bg:             transparent;

$table-th-font-weight:        null;

$table-striped-color:         $table-color;
$table-striped-bg-factor:     .05;
$table-striped-bg:            rgba($black, $table-striped-bg-factor);

$table-active-color:          $table-color;
$table-active-bg-factor:      .1;
$table-active-bg:             rgba($black, $table-active-bg-factor);

$table-hover-color:           $table-color;
$table-hover-bg-factor:       .075;
$table-hover-bg:              rgba($black, $table-hover-bg-factor);

$table-border-factor:         .1;
$table-border-width:          $border-width;
$table-border-color:          $border-color;

$table-striped-order:         odd;

$table-group-separator-color: currentColor;

$table-caption-color:         $text-muted;

$table-bg-scale:              -80%;
```

### Loop

Copy

```scss
$table-variants: (
  "primary":    shift-color($primary, $table-bg-scale),
  "secondary":  shift-color($secondary, $table-bg-scale),
  "success":    shift-color($success, $table-bg-scale),
  "info":       shift-color($info, $table-bg-scale),
  "warning":    shift-color($warning, $table-bg-scale),
  "danger":     shift-color($danger, $table-bg-scale),
  "light":      $light,
  "dark":       $dark,
);
```

### Customizing

- The factor variables (`$table-striped-bg-factor`, `$table-active-bg-factor` & `$table-hover-bg-factor`) are used to determine the contrast in table variants.
- Apart from the light & dark table variants, theme colors are lightened by the `$table-bg-level` variable.