# Images

Documentation and examples for opting images into responsive behavior (so they never become larger than their parent elements) and add lightweight styles to them—all via classes.

[![ads via Carbon](https://cdn4.buysellads.net/uu/1/3386/1525189943-38523.png)](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27LCW7DCK3KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[Limited time offer: Get 10 free Adobe Stock images.](https://srv.carbonads.net/ads/click/x/GTND42JLCASI653WCKBLYKQNCVSIKKQUCKADLZ3JCY7D52Q7CTBI653KCEBD42JLCKSD5KJYCKAIV27LCW7DCK3KC6SD627UCEYDTK3EHJNCLSIZ?segment=placement:getbootstrapcom;)[ads via Carbon](http://carbonads.net/?utm_source=getbootstrapcom&utm_medium=ad_via_link&utm_campaign=in_unit&utm_term=carbon)

**On this page**[Responsive images](https://getbootstrap.com/docs/5.0/content/images/#responsive-images)[Image thumbnails](https://getbootstrap.com/docs/5.0/content/images/#image-thumbnails)[Aligning images](https://getbootstrap.com/docs/5.0/content/images/#aligning-images)[Picture](https://getbootstrap.com/docs/5.0/content/images/#picture)[Sass](https://getbootstrap.com/docs/5.0/content/images/#sass)[Variables](https://getbootstrap.com/docs/5.0/content/images/#variables)

## Responsive images

Images in Bootstrap are made responsive with `.img-fluid`. This applies `max-width: 100%;` and `height: auto;` to the image so that it scales with the parent element.

Responsive image

Copy

```html
<img src="..." class="img-fluid" alt="...">
```

## Image thumbnails

In addition to our [border-radius utilities](https://getbootstrap.com/docs/5.0/utilities/borders/), you can use `.img-thumbnail` to give an image a rounded 1px border appearance.

200x200

Copy

```html
<img src="..." class="img-thumbnail" alt="...">
```

## Aligning images

Align images with the [helper float classes](https://getbootstrap.com/docs/5.0/utilities/float/) or [text alignment classes](https://getbootstrap.com/docs/5.0/utilities/text/#text-alignment). `block`-level images can be centered using [the `.mx-auto` margin utility class](https://getbootstrap.com/docs/5.0/utilities/spacing/#horizontal-centering).

200x200200x200

Copy

```html
<img src="..." class="rounded float-start" alt="...">
<img src="..." class="rounded float-end" alt="...">
```

200x200

Copy

```html
<img src="..." class="rounded mx-auto d-block" alt="...">
```

200x200

Copy

```html
<div class="text-center">
  <img src="..." class="rounded" alt="...">
</div>
```

## Picture

If you are using the `<picture>` element to specify multiple `<source>` elements for a specific `<img>`, make sure to add the `.img-*` classes to the `<img>` and not to the `<picture>` tag.

Copy

```html
<picture>
  <source srcset="..." type="image/svg+xml">
  <img src="..." class="img-fluid img-thumbnail" alt="...">
</picture>
```

## Sass

### Variables

Variables are available for image thumbnails.

Copy

```scss
$thumbnail-padding:                 .25rem;
$thumbnail-bg:                      $body-bg;
$thumbnail-border-width:            $border-width;
$thumbnail-border-color:            $gray-300;
$thumbnail-border-radius:           $border-radius;
$thumbnail-box-shadow:              $box-shadow-sm;
```

[Bootstrap](https://getbootstrap.com/)

 