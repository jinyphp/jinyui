---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Fill

Utilities for styling the fill of SVG elements.

## Default class reference

| Class        | Properties          |
| ------------ | ------------------- |
| fill-current | fill: currentColor; |

## Usage

Use `fill-current` to set the fill color of an SVG to the current text color. This makes it easy to set an element’s fill color by combining this class with an existing [text color utility](https://tailwindcss.com/docs/text-color).

Useful for styling icon sets like [Zondicons](http://www.zondicons.com/) that are drawn entirely with fills.



```html
<svg class="fill-current text-green-600 ..."></svg>
```

## Customizing

Control which fill utilities Tailwind generates by customizing the `theme.fill` section of your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
-     fill: {
-       current: 'currentColor',
-     }
+     fill: theme => ({
+       'red': theme('colors.red.500'),
+       'green': theme('colors.green.500'),
+       'blue': theme('colors.blue.500'),
+     })
    }
  }
```

### Variants

By default, only responsive variants are generated for fill utilities.

You can control which variants are generated for the fill utilities by modifying the `fill` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fill: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the fill utilities in your project, you can disable them entirely by setting the `fill` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fill: false,
    }
  }
```

[←User Select](https://tailwindcss.com/docs/user-select)[Stroke
  ](https://tailwindcss.com/docs/stroke)



---



# Stroke

Utilities for styling the stroke of SVG elements.

## Default class reference

| Class          | Properties            |
| -------------- | --------------------- |
| stroke-current | stroke: currentColor; |

## Usage

Use `stroke-current` to set the stroke color of an SVG to the current text color. This makes it easy to set an element’s stroke color by combining this class with an existing [text color utility](https://tailwindcss.com/docs/text-color).

Useful for styling icon sets like [Heroicons](http://heroicons.com/) that are drawn entirely with strokes.



```html
<svg class="stroke-current text-purple-600 ..."></svg>
```

## Customizing

Control which stroke utilities Tailwind generates by customizing the `theme.stroke` section in your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
-     stroke: {
-       current: 'currentColor',
-     }
+     stroke: theme => ({
+       'red': theme('colors.red.500'),
+       'green': theme('colors.green.500'),
+       'blue': theme('colors.blue.500'),
+     })
    }
  }
```

### Variants

By default, only responsive variants are generated for stroke utilities.

You can control which variants are generated for the stroke utilities by modifying the `stroke` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       stroke: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the stroke utilities in your project, you can disable them entirely by setting the `stroke` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     stroke: false,
    }
  }
```

[←Fill](https://tailwindcss.com/docs/fill)[Stroke Width
  ](https://tailwindcss.com/docs/stroke-width)



---



# Stroke Width

Utilities for styling the stroke width of SVG elements.

## Default class reference

| Class    | Properties       |
| -------- | ---------------- |
| stroke-0 | stroke-width: 0; |
| stroke-1 | stroke-width: 1; |
| stroke-2 | stroke-width: 2; |

## Usage

Use the `stroke-{width}` utilities to set the stroke width of an SVG.

Useful for styling icon sets like [Heroicons](http://heroicons.com/) that are drawn entirely with strokes.

 

```html
<svg class="stroke-current stroke-1 text-green-600 ..."></svg>
<svg class="stroke-current stroke-2 text-green-600 ..."></svg>
```

## Responsive

To control the stroke width of an SVG element at a specific breakpoint, add a `{screen}:` prefix to any existing width utility. For example, adding the class `md:stroke-2` to an element would apply the `stroke-2` utility at medium screen sizes and above.

```html
<svg class="stroke-1 md:stroke-2 ...">
  <!-- ... -->
</svg>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

Control which stroke-width utilities Tailwind generates by customizing the `theme.strokeWidth` section in your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        strokeWidth: {
+         '3': '3',
+         '4': '4',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for stroke-width utilities.

You can control which variants are generated for the stroke-width utilities by modifying the `strokeWidth` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       strokeWidth: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the stroke-width utilities in your project, you can disable them entirely by setting the `strokeWidth` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     strokeWidth: false,
    }
  }
```

[←Stroke](https://tailwindcss.com/docs/stroke)[Screen Readers
  ](https://tailwindcss.com/docs/screen-readers)



