---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Box Shadow

Utilities for controlling the box shadow of an element.

## Default class reference

| Class        | Properties                                                   |
| ------------ | ------------------------------------------------------------ |
| *            | --tw-shadow: 0 0 #0000;                                      |
| shadow-sm    | --tw-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow       | --tw-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow-md    | --tw-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow-lg    | --tw-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow-xl    | --tw-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow-2xl   | --tw-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow-inner | --tw-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |
| shadow-none  | --tw-shadow: 0 0 #0000; box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); |

## Outer shadow

Use the `shadow-sm`, `shadow`, `shadow-md`, `shadow-lg`, `shadow-xl`, or `shadow-2xl` utilities to apply different sized outer box shadows to an element.

.shadow-sm

.shadow

.shadow-md

.shadow-lg

.shadow-xl

.shadow-2xl

```html
<div class="shadow-sm ..."></div>
<div class="shadow ..."></div>
<div class="shadow-md ..."></div>
<div class="shadow-lg ..."></div>
<div class="shadow-xl ..."></div>
<div class="shadow-2xl ..."></div>
```

## Inner shadow

Use the `shadow-inner` utility to apply a subtle inset box shadow to an element. This can be useful for things like form controls or wells.

.shadow-inner

```html
<div class="shadow-inner ..."></div>
```

## No shadow

Use `shadow-none` to remove an existing box shadow from an element. This is most commonly used to remove a shadow that was applied at a smaller breakpoint.

.shadow-none

```html
<div class="shadow-none ..."></div>
```

## Responsive

To control the shadow of an element at a specific breakpoint, add a `{screen}:` prefix to any existing shadow utility. For example, use `md:shadow-lg` to apply the `shadow-lg` utility at only medium screen sizes and above.

```html
<div class="shadow md:shadow-lg ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Box Shadows

By default, Tailwind provides six drop shadow utilities, one inner shadow utility, and a utility for removing existing shadows. You can change, add, or remove these by editing the `theme.boxShadow` section of your Tailwind config.

If a `DEFAULT` shadow is provided, it will be used for the non-suffixed `shadow` utility. Any other keys will be used as suffixes, for example the key `'2'` will create a corresponding `shadow-2` utility.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      boxShadow: {
        sm: '0 1px 2px 0 rgba(0, 0, 0, 0.05)',
        DEFAULT: '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
        md: '0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)',
        lg: '0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)',
        xl: '0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)',
        '2xl': '0 25px 50px -12px rgba(0, 0, 0, 0.25)',
+       '3xl': '0 35px 60px -15px rgba(0, 0, 0, 0.3)',
        inner: 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
        none: 'none',
      }
    }
  }
```

### Variants

By default, only responsive, group-hover, focus-within, hover and focus variants are generated for box shadow utilities.

You can control which variants are generated for the box shadow utilities by modifying the `boxShadow` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       boxShadow: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the box shadow utilities in your project, you can disable them entirely by setting the `boxShadow` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     boxShadow: false,
    }
  }
```

[←Ring Offset Color](https://tailwindcss.com/docs/ring-offset-color)[Opacity
  ](https://tailwindcss.com/docs/opacity)



---



# Opacity

Utilities for controlling the opacity of an element.

## Default class reference

| Class       | Properties     |
| ----------- | -------------- |
| opacity-0   | opacity: 0;    |
| opacity-5   | opacity: 0.05; |
| opacity-10  | opacity: 0.1;  |
| opacity-20  | opacity: 0.2;  |
| opacity-25  | opacity: 0.25; |
| opacity-30  | opacity: 0.3;  |
| opacity-40  | opacity: 0.4;  |
| opacity-50  | opacity: 0.5;  |
| opacity-60  | opacity: 0.6;  |
| opacity-70  | opacity: 0.7;  |
| opacity-75  | opacity: 0.75; |
| opacity-80  | opacity: 0.8;  |
| opacity-90  | opacity: 0.9;  |
| opacity-95  | opacity: 0.95; |
| opacity-100 | opacity: 1;    |

## Usage

Control the opacity of an element using the `opacity-{amount}` utilities.

100%

75%

50%

25%

0%

```html
<div class="bg-light-blue-600 opacity-100 ..."></div>
<div class="bg-light-blue-600 opacity-75 ..."></div>
<div class="bg-light-blue-600 opacity-50 ..."></div>
<div class="bg-light-blue-600 opacity-25 ..."></div>
<div class="bg-light-blue-600 opacity-0 ..."></div>
```

## Responsive

To control the opacity of an element at a specific breakpoint, add a `{screen}:` prefix to any existing opacity utility. For example, use `md:opacity-50` to apply the `opacity-50` utility at only medium screen sizes and above.

```html
<div class="opacity-100 md:opacity-50 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Opacity Scale

By default, Tailwind provides five opacity utilities based on a simple numeric scale. You change, add, or remove these by editing the `theme.opacity` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      opacity: {
        '0': '0',
-       '25': '.25',
-       '50': '.5',
-       '75': '.75',
+       '10': '.1',
+       '20': '.2',
+       '30': '.3',
+       '40': '.4',
+       '50': '.5',
+       '60': '.6',
+       '70': '.7',
+       '80': '.8',
+       '90': '.9',
        '100': '1',
      }
    }
  }
```

### Variants

By default, only responsive, group-hover, focus-within, hover and focus variants are generated for opacity utilities.

You can control which variants are generated for the opacity utilities by modifying the `opacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       opacity: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the opacity utilities in your project, you can disable them entirely by setting the `opacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     opacity: false,
    }
  }
```

[←Box Shadow](https://tailwindcss.com/docs/box-shadow)[Mix Blend Mode
  ](https://tailwindcss.com/docs/mix-blend-mode)



---

# Mix Blend Mode

- Tailwind CSS version

  v2.1+

Utilities for controlling how an element should blend with the background.

## Default class reference

| Class                 | Properties                   |
| --------------------- | ---------------------------- |
| mix-blend-normal      | mix-blend-mode: normal;      |
| mix-blend-multiply    | mix-blend-mode: multiply;    |
| mix-blend-screen      | mix-blend-mode: screen;      |
| mix-blend-overlay     | mix-blend-mode: overlay;     |
| mix-blend-darken      | mix-blend-mode: darken;      |
| mix-blend-lighten     | mix-blend-mode: lighten;     |
| mix-blend-color-dodge | mix-blend-mode: color-dodge; |
| mix-blend-color-burn  | mix-blend-mode: color-burn;  |
| mix-blend-hard-light  | mix-blend-mode: hard-light;  |
| mix-blend-soft-light  | mix-blend-mode: soft-light;  |
| mix-blend-difference  | mix-blend-mode: difference;  |
| mix-blend-exclusion   | mix-blend-mode: exclusion;   |
| mix-blend-hue         | mix-blend-mode: hue;         |
| mix-blend-saturation  | mix-blend-mode: saturation;  |
| mix-blend-color       | mix-blend-mode: color;       |
| mix-blend-luminosity  | mix-blend-mode: luminosity;  |

## Usage

Use the `mix-blend-{mode}` utilities to control how an element’s content should be blended with the background.

```html
<div class="bg-green-300 ...">
  <div class="mix-blend-multiply bg-amber-300 ..."></div>
</div>
```

## Responsive

To control the mix-blend-mode property at a specific breakpoint, add a `{screen}:` prefix to any existing mix-blend-mode utility. For example, use `md:mix-blend-overlay` to apply the `mix-blend-overlay` utility at only medium screen sizes and above.

```html
<div class="mix-blend-multiply md:mix-blend-overlay ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for mix-blend-mode utilities.

You can control which variants are generated for the mix-blend-mode utilities by modifying the `mixBlendMode` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       mixBlendMode: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the mix-blend-mode utilities in your project, you can disable them entirely by setting the `mixBlendMode` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     mixBlendMode: false,
    }
  }
```

[←Opacity](https://tailwindcss.com/docs/opacity)[Background Blend Mode
  ](https://tailwindcss.com/docs/background-blend-mode)



---



# Background Blend Mode

- Tailwind CSS version

  v2.1+

Utilities for controlling how an element's background image should blend with its background color.

## Default class reference

| Class                | Properties                          |
| -------------------- | ----------------------------------- |
| bg-blend-normal      | background-blend-mode: normal;      |
| bg-blend-multiply    | background-blend-mode: multiply;    |
| bg-blend-screen      | background-blend-mode: screen;      |
| bg-blend-overlay     | background-blend-mode: overlay;     |
| bg-blend-darken      | background-blend-mode: darken;      |
| bg-blend-lighten     | background-blend-mode: lighten;     |
| bg-blend-color-dodge | background-blend-mode: color-dodge; |
| bg-blend-color-burn  | background-blend-mode: color-burn;  |
| bg-blend-hard-light  | background-blend-mode: hard-light;  |
| bg-blend-soft-light  | background-blend-mode: soft-light;  |
| bg-blend-difference  | background-blend-mode: difference;  |
| bg-blend-exclusion   | background-blend-mode: exclusion;   |
| bg-blend-hue         | background-blend-mode: hue;         |
| bg-blend-saturation  | background-blend-mode: saturation;  |
| bg-blend-color       | background-blend-mode: color;       |
| bg-blend-luminosity  | background-blend-mode: luminosity;  |

## Usage

Use the `bg-blend-{mode}` utilities to control how an element’s background image should be blended its background color.

```html
<div class="bg-blend-multiply ...">
  <!-- ... -->
</div>
```

## Responsive

To control the background-blend-mode property at a specific breakpoint, add a `{screen}:` prefix to any existing background-blend-mode utility. For example, use `md:bg-blend-darken` to apply the `bg-blend-darken` utility at only medium screen sizes and above.

```html
<div class="bg-blend-lighten md:bg-blend-darken ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for background-blend-mode utilities.

You can control which variants are generated for the background-blend-mode utilities by modifying the `backgroundBlendMode` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundBlendMode: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background-blend-mode utilities in your project, you can disable them entirely by setting the `backgroundBlendMode` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundBlendMode: false,
    }
  }
```

[←Mix Blend Mode](https://tailwindcss.com/docs/mix-blend-mode)[Filter
  ](https://tailwindcss.com/docs/filter)





