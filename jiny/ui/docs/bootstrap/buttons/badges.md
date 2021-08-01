# Badges

Documentation and examples for badges, our small count and labeling component.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/41334/1550855391-cc_dark.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI65QKCEBD42JLCKSD5KJYCKAIV27JCESDT5QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Adobe Creative Cloud for Teams starting at $33.99 per month.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI65QKCEBD42JLCKSD5KJYCKAIV27JCESDT5QKC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Examples](https://getbootstrap.com/docs/5.0/components/badge/#examples)[Headings](https://getbootstrap.com/docs/5.0/components/badge/#headings)[Buttons](https://getbootstrap.com/docs/5.0/components/badge/#buttons)[Positioned](https://getbootstrap.com/docs/5.0/components/badge/#positioned)[Background colors](https://getbootstrap.com/docs/5.0/components/badge/#background-colors)[Pill badges](https://getbootstrap.com/docs/5.0/components/badge/#pill-badges)[Sass](https://getbootstrap.com/docs/5.0/components/badge/#sass)[Variables](https://getbootstrap.com/docs/5.0/components/badge/#variables)

## Examples

Badges scale to match the size of the immediate parent element by using relative font sizing and `em` units. As of v5, badges no longer have focus or hover styles for links.

### Headings

# Example heading **New**

## Example heading **New**

### Example heading **New**

#### Example heading **New**

##### Example heading **New**

###### Example heading **New**

Copy

```html
<h1>Example heading <span class="badge bg-secondary">New</span></h1>
<h2>Example heading <span class="badge bg-secondary">New</span></h2>
<h3>Example heading <span class="badge bg-secondary">New</span></h3>
<h4>Example heading <span class="badge bg-secondary">New</span></h4>
<h5>Example heading <span class="badge bg-secondary">New</span></h5>
<h6>Example heading <span class="badge bg-secondary">New</span></h6>
```

### Buttons

Badges can be used as part of links or buttons to provide a counter.

Notifications **4**

Copy

```html
<button type="button" class="btn btn-primary">
  Notifications <span class="badge bg-secondary">4</span>
</button>
```

Note that depending on how they are used, badges may be confusing for users of screen readers and similar assistive technologies. While the styling of badges provides a visual cue as to their purpose, these users will simply be presented with the content of the badge. Depending on the specific situation, these badges may seem like random additional words or numbers at the end of a sentence, link, or button.

Unless the context is clear (as with the “Notifications” example, where it is understood that the “4” is the number of notifications), consider including additional context with a visually hidden piece of additional text.

### Positioned

Use utilities to modify a `.badge` and position it in the corner of a link or button.

Inbox**99+unread messages**

Copy

```html
<button type="button" class="btn btn-primary position-relative">
  Inbox
  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    99+
    <span class="visually-hidden">unread messages</span>
  </span>
</button>
```

You can also replace the `.badge` class with a few more utilities without a count for a more generic indicator.

ProfileNew alerts

Copy

```html
<button type="button" class="btn btn-primary position-relative">
  Profile
  <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
    <span class="visually-hidden">New alerts</span>
  </span>
</button>
```

## Background colors

Use our background utility classes to quickly change the appearance of a badge. Please note that when using Bootstrap’s default `.bg-light`, you’ll likely need a text color utility like `.text-dark` for proper styling. This is because background utilities do not set anything but `background-color`.

**Primary** **Secondary** **Success** **Danger** **Warning** **Info** **Light** **Dark**

Copy

```html
<span class="badge bg-primary">Primary</span>
<span class="badge bg-secondary">Secondary</span>
<span class="badge bg-success">Success</span>
<span class="badge bg-danger">Danger</span>
<span class="badge bg-warning text-dark">Warning</span>
<span class="badge bg-info text-dark">Info</span>
<span class="badge bg-light text-dark">Light</span>
<span class="badge bg-dark">Dark</span>
```

##### Conveying meaning to assistive technologies

Using color to add meaning only provides a visual indication, which will not be conveyed to users of assistive technologies – such as screen readers. Ensure that information denoted by the color is either obvious from the content itself (e.g. the visible text), or is included through alternative means, such as additional text hidden with the `.visually-hidden` class.

## Pill badges

Use the `.rounded-pill` utility class to make badges more rounded with a larger `border-radius`.

**Primary** **Secondary** **Success** **Danger** **Warning** **Info** **Light** **Dark**

Copy

```html
<span class="badge rounded-pill bg-primary">Primary</span>
<span class="badge rounded-pill bg-secondary">Secondary</span>
<span class="badge rounded-pill bg-success">Success</span>
<span class="badge rounded-pill bg-danger">Danger</span>
<span class="badge rounded-pill bg-warning text-dark">Warning</span>
<span class="badge rounded-pill bg-info text-dark">Info</span>
<span class="badge rounded-pill bg-light text-dark">Light</span>
<span class="badge rounded-pill bg-dark">Dark</span>
```

## Sass

### Variables

Copy

```scss
$badge-font-size:                   .75em;
$badge-font-weight:                 $font-weight-bold;
$badge-color:                       $white;
$badge-padding-y:                   .35em;
$badge-padding-x:                   .65em;
$badge-border-radius:               $border-radius;
```

[Bootstrap](https://getbootstrap.com/)

 