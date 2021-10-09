---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Screen Readers

Utilities for improving accessibility with screen readers.

## Default class reference

| Class       | Properties                                                   |
| ----------- | ------------------------------------------------------------ |
| sr-only     | position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border-width: 0; |
| not-sr-only | position: static; width: auto; height: auto; padding: 0; margin: 0; overflow: visible; clip: auto; white-space: normal; |

## Usage

Use `sr-only` to hide an element visually without hiding it from screen readers:

```html
<a href="#">
  <svg><!-- ... --></svg>
  <span class="sr-only">Settings</span>
</a>
```

Use `not-sr-only` to undo `sr-only`, making an element visible to sighted users as well as screen readers. This can be useful when you want to visually hide something on small screens but show it on larger screens for example:

```html
<a href="#">
  <svg><!-- ... --></svg>
  <span class="sr-only sm:not-sr-only">Settings</span>
</a>
```

By default, `responsive` and `focus` variants are generated for these utilities. You can use `focus:not-sr-only` to make an element visually hidden by default but visible when the user tabs to it — useful for “skip to content” links:

```html
<a href="#" class="sr-only focus:not-sr-only">
  Skip to content
</a>
```

## Customizing

### Variants

By default, only responsive, focus-within and focus variants are generated for accessibility utilities.

You can control which variants are generated for the accessibility utilities by modifying the `accessibility` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       accessibility: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the accessibility utilities in your project, you can disable them entirely by setting the `accessibility` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     accessibility: false,
    }
  }
```

[←Stroke Width](https://tailwindcss.com/docs/stroke-width)[Typography
  ](https://github.com/tailwindlabs/tailwindcss-typography)