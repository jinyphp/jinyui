
# Clearfix
Quickly and easily clear floated content within a container by adding a clearfix utility.

Easily clear floats by adding .clearfix to the parent element. Can also be used as a mixin.

Use in HTML:
```
<div class="clearfix">...</div>
```

The mixin source code:

```
@mixin clearfix() {
  &::after {
    display: block;
    clear: both;
    content: "";
  }
}
```

Use the mixin in SCSS:

```
.element {
  @include clearfix;
}
```

The following example shows how the clearfix can be used. Without the clearfix the wrapping div would not span around the buttons which would cause a broken layout.

```
<div class="bg-info clearfix">
  <button type="button" class="btn btn-secondary float-start">Example Button floated left</button>
  <button type="button" class="btn btn-secondary float-end">Example Button floated right</button>
</div>
```