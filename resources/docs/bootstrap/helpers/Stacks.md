# Stacks
Shorthand helpers that build on top of our flexbox utilities to make component layout faster and easier than ever.

Stacks offer a shortcut for applying a number of flexbox properties to quickly and easily create layouts in Bootstrap. All credit for the concept and implementation goes to the open source Pylon project.

> Heads up! Support for gap utilities with flexbox was recently added to Safari, so consider verifying your intended browser support. Grid layout should have no issues. Read more.

## Vertical
Use .vstack to create vertical layouts. Stacked items are full-width by default. Use .gap-* utilities to add space between items.

```
<div class="vstack gap-3">
  <div class="bg-light border">First item</div>
  <div class="bg-light border">Second item</div>
  <div class="bg-light border">Third item</div>
</div>
```

## Horizontal
Use .hstack for horizontal layouts. Stacked items are vertically centered by default and only take up their necessary width. Use .gap-* utilities to add space between items.

```
<div class="hstack gap-3">
  <div class="bg-light border">First item</div>
  <div class="bg-light border">Second item</div>
  <div class="bg-light border">Third item</div>
</div>
```

Using horizontal margin utilities like .ms-auto as spacers:

```
<div class="hstack gap-3">
  <div class="bg-light border">First item</div>
  <div class="bg-light border ms-auto">Second item</div>
  <div class="bg-light border">Third item</div>
</div>
```

And with vertical rules:

```
<div class="hstack gap-3">
  <div class="bg-light border">First item</div>
  <div class="bg-light border ms-auto">Second item</div>
  <div class="vr"></div>
  <div class="bg-light border">Third item</div>
</div>
```

## Examples
Use .vstack to stack buttons and other elements:
```
<div class="vstack gap-2 col-md-5 mx-auto">
  <button type="button" class="btn btn-secondary">Save changes</button>
  <button type="button" class="btn btn-outline-secondary">Cancel</button>
</div>
```

Create an inline form with .hstack:

```
<div class="hstack gap-3">
  <input class="form-control me-auto" type="text" placeholder="Add your item here..." aria-label="Add your item here...">
  <button type="button" class="btn btn-secondary">Submit</button>
  <div class="vr"></div>
  <button type="button" class="btn btn-outline-danger">Reset</button>
</div>
```

## Sass

```
.hstack {
  display: flex;
  flex-direction: row;
  align-items: center;
  align-self: stretch;
}

.vstack {
  display: flex;
  flex: 1 1 auto;
  flex-direction: column;
  align-self: stretch;
}
```


