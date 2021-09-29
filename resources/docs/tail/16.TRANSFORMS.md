---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Transform

Utilities for controlling transform behaviour.

## Default class reference

| Class          | Properties                                                   |
| -------------- | ------------------------------------------------------------ |
| transform      | --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); |
| transform-gpu  | --tw-translate-x: 0; --tw-translate-y: 0; --tw-rotate: 0; --tw-skew-x: 0; --tw-skew-y: 0; --tw-scale-x: 1; --tw-scale-y: 1; transform: translate3d(var(--tw-translate-x), var(--tw-translate-y), 0) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y)); |
| transform-none | transform: none;                                             |

## Transform

To enable transformations you have to add the `transform` utility.

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

```html
<img class="transform rotate-45 ...">
<img class="transform skew-y-12 ...">
<img class="transform scale-50 ...">
<img class="transform translate-x-4 translate-y-4 ...">
```

## Hardware acceleration

A lot of transformations can be executed on the GPU instead of the CPU. This enables better performance. You can use the `transform-gpu` utility to enable GPU Acceleration.

```html
<div class="transform-gpu scale-150 ..."></div>
```

## None

If you want to disable transformations, then you can use the `transform-none` utility.

```html
<div class="transform rotate-45 lg:transform-none ..."></div>
```

## Responsive

To enable or disable transforms at a specific breakpoint, add a `{screen}:` prefix to any of the transform utilities. For example, use `md:transform` to apply the `transform` utility at only medium screen sizes and above.

```html
<img class="transform sm:transform-gpu md:transform-none ...">
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

### Variants

By default, only responsive variants are generated for transform utilities.

You can control which variants are generated for the transform utilities by modifying the `transform` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       transform: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the transform utilities in your project, you can disable them entirely by setting the `transform` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     transform: false,
    }
  }
```

[←Animation](https://tailwindcss.com/docs/animation)[Transform Origin
  ](https://tailwindcss.com/docs/transform-origin)



---



# Transform Origin

Utilities for specifying the origin for an element's transformations.

## Default class reference

| Class               | Properties                      |
| ------------------- | ------------------------------- |
| origin-center       | transform-origin: center;       |
| origin-top          | transform-origin: top;          |
| origin-top-right    | transform-origin: top right;    |
| origin-right        | transform-origin: right;        |
| origin-bottom-right | transform-origin: bottom right; |
| origin-bottom       | transform-origin: bottom;       |
| origin-bottom-left  | transform-origin: bottom left;  |
| origin-left         | transform-origin: left;         |
| origin-top-left     | transform-origin: top left;     |

## Usage

Specify an element’s transform origin using the `origin-{keyword}` utilities.

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

```html
<img class="origin-center transform rotate-45 ...">
<img class="origin-top-left transform rotate-45 ...">
<img class="origin-bottom-right transform rotate-45 ...">
<img class="origin-left transform rotate-45 ...">
```

## Responsive

To control the transform-origin of an element at a specific breakpoint, add a `{screen}:` prefix to any existing transform-origin utility. For example, use `md:origin-top` to apply the `origin-top` utility at only medium screen sizes and above.

```html
<img class="origin-center md:origin-top ...">
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Origin values

By default, Tailwind provides transform-origin utilities for all of the built-in browser keyword options. You change, add, or remove these by customizing the `transformOrigin` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        transformOrigin: {
+         '24': '6rem',
+         'full': '100%',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for transform-origin utilities.

You can control which variants are generated for the transform-origin utilities by modifying the `transformOrigin` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       transformOrigin: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the transform-origin utilities in your project, you can disable them entirely by setting the `transformOrigin` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     transformOrigin: false,
    }
  }
```

[←Transform](https://tailwindcss.com/docs/transform)[Scale
  ](https://tailwindcss.com/docs/scale)



---



# Scale

Utilities for scaling elements with transform.

## Default class reference

| Class       | Properties                              |
| ----------- | --------------------------------------- |
| scale-0     | --tw-scale-x: 0; --tw-scale-y: 0;       |
| scale-50    | --tw-scale-x: .5; --tw-scale-y: .5;     |
| scale-75    | --tw-scale-x: .75; --tw-scale-y: .75;   |
| scale-90    | --tw-scale-x: .9; --tw-scale-y: .9;     |
| scale-95    | --tw-scale-x: .95; --tw-scale-y: .95;   |
| scale-100   | --tw-scale-x: 1; --tw-scale-y: 1;       |
| scale-105   | --tw-scale-x: 1.05; --tw-scale-y: 1.05; |
| scale-110   | --tw-scale-x: 1.1; --tw-scale-y: 1.1;   |
| scale-125   | --tw-scale-x: 1.25; --tw-scale-y: 1.25; |
| scale-150   | --tw-scale-x: 1.5; --tw-scale-y: 1.5;   |
| scale-x-0   | --tw-scale-x: 0;                        |
| scale-x-50  | --tw-scale-x: .5;                       |
| scale-x-75  | --tw-scale-x: .75;                      |
| scale-x-90  | --tw-scale-x: .9;                       |
| scale-x-95  | --tw-scale-x: .95;                      |
| scale-x-100 | --tw-scale-x: 1;                        |
| scale-x-105 | --tw-scale-x: 1.05;                     |
| scale-x-110 | --tw-scale-x: 1.1;                      |
| scale-x-125 | --tw-scale-x: 1.25;                     |
| scale-x-150 | --tw-scale-x: 1.5;                      |
| scale-y-0   | --tw-scale-y: 0;                        |
| scale-y-50  | --tw-scale-y: .5;                       |
| scale-y-75  | --tw-scale-y: .75;                      |
| scale-y-90  | --tw-scale-y: .9;                       |
| scale-y-95  | --tw-scale-y: .95;                      |
| scale-y-100 | --tw-scale-y: 1;                        |
| scale-y-105 | --tw-scale-y: 1.05;                     |
| scale-y-110 | --tw-scale-y: 1.1;                      |
| scale-y-125 | --tw-scale-y: 1.25;                     |
| scale-y-150 | --tw-scale-y: 1.5;                      |

## Usage

Control the scale of an element by first enabling transforms with the `transform` utility, then specifying the scale using the `scale-{percentage}`, `scale-x-{percentage}`, and `scale-y-{percentage}` utilities.

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

```html
<img class="transform scale-75 ...">
<img class="transform scale-100 ...">
<img class="transform scale-125 ...">
<img class="transform scale-150 ...">
```

## Responsive

To control the scale of an element at a specific breakpoint, add a `{screen}:` prefix to any existing scale utility. For example, use `md:scale-75` to apply the `scale-75` utility at only medium screen sizes and above.

```html
<div class="transform scale-100 md:scale-75"></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Scale values

By default, Tailwind provides ten general purpose scale utilities. You change, add, or remove these by editing the `theme.scale` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      scale: {
        '0': '0',
+       '25': '.25',
        '50': '.5',
        '75': '.75',
        '90': '.9',
-       '95': '.95',
        '100': '1',
-       '105': '1.05',
-       '110': '1.1',
        '125': '1.25',
        '150': '1.5',
+       '200': '2',
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, hover and focus variants are generated for scale utilities.

You can control which variants are generated for the scale utilities by modifying the `scale` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active and group-hover variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       scale: ['active', 'group-hover'],
      }
    }
  }
```

### Disabling

If you don't plan to use the scale utilities in your project, you can disable them entirely by setting the `scale` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     scale: false,
    }
  }
```

[←Transform Origin](https://tailwindcss.com/docs/transform-origin)[Rotate
  ](https://tailwindcss.com/docs/rotate)



---



# Rotate

Utilities for rotating elements with transform.

## Default class reference

| Class       | Properties            |
| ----------- | --------------------- |
| rotate-0    | --tw-rotate: 0deg;    |
| rotate-1    | --tw-rotate: 1deg;    |
| rotate-2    | --tw-rotate: 2deg;    |
| rotate-3    | --tw-rotate: 3deg;    |
| rotate-6    | --tw-rotate: 6deg;    |
| rotate-12   | --tw-rotate: 12deg;   |
| rotate-45   | --tw-rotate: 45deg;   |
| rotate-90   | --tw-rotate: 90deg;   |
| rotate-180  | --tw-rotate: 180deg;  |
| -rotate-180 | --tw-rotate: -180deg; |
| -rotate-90  | --tw-rotate: -90deg;  |
| -rotate-45  | --tw-rotate: -45deg;  |
| -rotate-12  | --tw-rotate: -12deg;  |
| -rotate-6   | --tw-rotate: -6deg;   |
| -rotate-3   | --tw-rotate: -3deg;   |
| -rotate-2   | --tw-rotate: -2deg;   |
| -rotate-1   | --tw-rotate: -1deg;   |

## Usage

Rotate an element by first enabling transforms with the `transform` utility, then specifying the rotation angle using the `rotate-{angle}` utilities.

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

```html
<img class="transform rotate-0 ...">
<img class="transform rotate-45 ...">
<img class="transform rotate-90 ...">
<img class="transform rotate-180 ...">
```

## Responsive

To control the rotation of an element at a specific breakpoint, add a `{screen}:` prefix to any existing rotate utility. For example, use `md:rotate-90` to apply the `rotate-90` utility at only medium screen sizes and above.

```html
<div class="transform rotate-45 md:rotate-90"></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Rotate scale

By default, Tailwind provides seven general purpose rotate utilities. You change, add, or remove these by editing the `theme.rotate` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      rotate: {
-       '-180': '-180deg',
        '-90': '-90deg',
-       '-45': '-45deg',
        '0': '0',
        '45': '45deg',
        '90': '90deg',
+       '135': '135deg',
        '180': '180deg',
+       '270': '270deg',
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, hover and focus variants are generated for rotate utilities.

You can control which variants are generated for the rotate utilities by modifying the `rotate` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active and group-hover variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       rotate: ['active', 'group-hover'],
      }
    }
  }
```

### Disabling

If you don't plan to use the rotate utilities in your project, you can disable them entirely by setting the `rotate` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     rotate: false,
    }
  }
```

[←Scale](https://tailwindcss.com/docs/scale)[Translate
  ](https://tailwindcss.com/docs/translate)



---



# Translate

Utilities for translating elements with transform.

## Default class reference

| Class             | Properties                     |
| ----------------- | ------------------------------ |
| translate-x-0     | --tw-translate-x: 0px;         |
| translate-x-px    | --tw-translate-x: 1px;         |
| translate-x-0.5   | --tw-translate-x: 0.125rem;    |
| translate-x-1     | --tw-translate-x: 0.25rem;     |
| translate-x-1.5   | --tw-translate-x: 0.375rem;    |
| translate-x-2     | --tw-translate-x: 0.5rem;      |
| translate-x-2.5   | --tw-translate-x: 0.625rem;    |
| translate-x-3     | --tw-translate-x: 0.75rem;     |
| translate-x-3.5   | --tw-translate-x: 0.875rem;    |
| translate-x-4     | --tw-translate-x: 1rem;        |
| translate-x-5     | --tw-translate-x: 1.25rem;     |
| translate-x-6     | --tw-translate-x: 1.5rem;      |
| translate-x-7     | --tw-translate-x: 1.75rem;     |
| translate-x-8     | --tw-translate-x: 2rem;        |
| translate-x-9     | --tw-translate-x: 2.25rem;     |
| translate-x-10    | --tw-translate-x: 2.5rem;      |
| translate-x-11    | --tw-translate-x: 2.75rem;     |
| translate-x-12    | --tw-translate-x: 3rem;        |
| translate-x-14    | --tw-translate-x: 3.5rem;      |
| translate-x-16    | --tw-translate-x: 4rem;        |
| translate-x-20    | --tw-translate-x: 5rem;        |
| translate-x-24    | --tw-translate-x: 6rem;        |
| translate-x-28    | --tw-translate-x: 7rem;        |
| translate-x-32    | --tw-translate-x: 8rem;        |
| translate-x-36    | --tw-translate-x: 9rem;        |
| translate-x-40    | --tw-translate-x: 10rem;       |
| translate-x-44    | --tw-translate-x: 11rem;       |
| translate-x-48    | --tw-translate-x: 12rem;       |
| translate-x-52    | --tw-translate-x: 13rem;       |
| translate-x-56    | --tw-translate-x: 14rem;       |
| translate-x-60    | --tw-translate-x: 15rem;       |
| translate-x-64    | --tw-translate-x: 16rem;       |
| translate-x-72    | --tw-translate-x: 18rem;       |
| translate-x-80    | --tw-translate-x: 20rem;       |
| translate-x-96    | --tw-translate-x: 24rem;       |
| translate-x-1/2   | --tw-translate-x: 50%;         |
| translate-x-1/3   | --tw-translate-x: 33.333333%;  |
| translate-x-2/3   | --tw-translate-x: 66.666667%;  |
| translate-x-1/4   | --tw-translate-x: 25%;         |
| translate-x-2/4   | --tw-translate-x: 50%;         |
| translate-x-3/4   | --tw-translate-x: 75%;         |
| translate-x-full  | --tw-translate-x: 100%;        |
| -translate-x-0    | --tw-translate-x: 0px;         |
| -translate-x-px   | --tw-translate-x: -1px;        |
| -translate-x-0.5  | --tw-translate-x: -0.125rem;   |
| -translate-x-1    | --tw-translate-x: -0.25rem;    |
| -translate-x-1.5  | --tw-translate-x: -0.375rem;   |
| -translate-x-2    | --tw-translate-x: -0.5rem;     |
| -translate-x-2.5  | --tw-translate-x: -0.625rem;   |
| -translate-x-3    | --tw-translate-x: -0.75rem;    |
| -translate-x-3.5  | --tw-translate-x: -0.875rem;   |
| -translate-x-4    | --tw-translate-x: -1rem;       |
| -translate-x-5    | --tw-translate-x: -1.25rem;    |
| -translate-x-6    | --tw-translate-x: -1.5rem;     |
| -translate-x-7    | --tw-translate-x: -1.75rem;    |
| -translate-x-8    | --tw-translate-x: -2rem;       |
| -translate-x-9    | --tw-translate-x: -2.25rem;    |
| -translate-x-10   | --tw-translate-x: -2.5rem;     |
| -translate-x-11   | --tw-translate-x: -2.75rem;    |
| -translate-x-12   | --tw-translate-x: -3rem;       |
| -translate-x-14   | --tw-translate-x: -3.5rem;     |
| -translate-x-16   | --tw-translate-x: -4rem;       |
| -translate-x-20   | --tw-translate-x: -5rem;       |
| -translate-x-24   | --tw-translate-x: -6rem;       |
| -translate-x-28   | --tw-translate-x: -7rem;       |
| -translate-x-32   | --tw-translate-x: -8rem;       |
| -translate-x-36   | --tw-translate-x: -9rem;       |
| -translate-x-40   | --tw-translate-x: -10rem;      |
| -translate-x-44   | --tw-translate-x: -11rem;      |
| -translate-x-48   | --tw-translate-x: -12rem;      |
| -translate-x-52   | --tw-translate-x: -13rem;      |
| -translate-x-56   | --tw-translate-x: -14rem;      |
| -translate-x-60   | --tw-translate-x: -15rem;      |
| -translate-x-64   | --tw-translate-x: -16rem;      |
| -translate-x-72   | --tw-translate-x: -18rem;      |
| -translate-x-80   | --tw-translate-x: -20rem;      |
| -translate-x-96   | --tw-translate-x: -24rem;      |
| -translate-x-1/2  | --tw-translate-x: -50%;        |
| -translate-x-1/3  | --tw-translate-x: -33.333333%; |
| -translate-x-2/3  | --tw-translate-x: -66.666667%; |
| -translate-x-1/4  | --tw-translate-x: -25%;        |
| -translate-x-2/4  | --tw-translate-x: -50%;        |
| -translate-x-3/4  | --tw-translate-x: -75%;        |
| -translate-x-full | --tw-translate-x: -100%;       |
| translate-y-0     | --tw-translate-y: 0px;         |
| translate-y-px    | --tw-translate-y: 1px;         |
| translate-y-0.5   | --tw-translate-y: 0.125rem;    |
| translate-y-1     | --tw-translate-y: 0.25rem;     |
| translate-y-1.5   | --tw-translate-y: 0.375rem;    |
| translate-y-2     | --tw-translate-y: 0.5rem;      |
| translate-y-2.5   | --tw-translate-y: 0.625rem;    |
| translate-y-3     | --tw-translate-y: 0.75rem;     |
| translate-y-3.5   | --tw-translate-y: 0.875rem;    |
| translate-y-4     | --tw-translate-y: 1rem;        |
| translate-y-5     | --tw-translate-y: 1.25rem;     |
| translate-y-6     | --tw-translate-y: 1.5rem;      |
| translate-y-7     | --tw-translate-y: 1.75rem;     |
| translate-y-8     | --tw-translate-y: 2rem;        |
| translate-y-9     | --tw-translate-y: 2.25rem;     |
| translate-y-10    | --tw-translate-y: 2.5rem;      |
| translate-y-11    | --tw-translate-y: 2.75rem;     |
| translate-y-12    | --tw-translate-y: 3rem;        |
| translate-y-14    | --tw-translate-y: 3.5rem;      |
| translate-y-16    | --tw-translate-y: 4rem;        |
| translate-y-20    | --tw-translate-y: 5rem;        |
| translate-y-24    | --tw-translate-y: 6rem;        |
| translate-y-28    | --tw-translate-y: 7rem;        |
| translate-y-32    | --tw-translate-y: 8rem;        |
| translate-y-36    | --tw-translate-y: 9rem;        |
| translate-y-40    | --tw-translate-y: 10rem;       |
| translate-y-44    | --tw-translate-y: 11rem;       |
| translate-y-48    | --tw-translate-y: 12rem;       |
| translate-y-52    | --tw-translate-y: 13rem;       |
| translate-y-56    | --tw-translate-y: 14rem;       |
| translate-y-60    | --tw-translate-y: 15rem;       |
| translate-y-64    | --tw-translate-y: 16rem;       |
| translate-y-72    | --tw-translate-y: 18rem;       |
| translate-y-80    | --tw-translate-y: 20rem;       |
| translate-y-96    | --tw-translate-y: 24rem;       |
| translate-y-1/2   | --tw-translate-y: 50%;         |
| translate-y-1/3   | --tw-translate-y: 33.333333%;  |
| translate-y-2/3   | --tw-translate-y: 66.666667%;  |
| translate-y-1/4   | --tw-translate-y: 25%;         |
| translate-y-2/4   | --tw-translate-y: 50%;         |
| translate-y-3/4   | --tw-translate-y: 75%;         |
| translate-y-full  | --tw-translate-y: 100%;        |
| -translate-y-0    | --tw-translate-y: 0px;         |
| -translate-y-px   | --tw-translate-y: -1px;        |
| -translate-y-0.5  | --tw-translate-y: -0.125rem;   |
| -translate-y-1    | --tw-translate-y: -0.25rem;    |
| -translate-y-1.5  | --tw-translate-y: -0.375rem;   |
| -translate-y-2    | --tw-translate-y: -0.5rem;     |
| -translate-y-2.5  | --tw-translate-y: -0.625rem;   |
| -translate-y-3    | --tw-translate-y: -0.75rem;    |
| -translate-y-3.5  | --tw-translate-y: -0.875rem;   |
| -translate-y-4    | --tw-translate-y: -1rem;       |
| -translate-y-5    | --tw-translate-y: -1.25rem;    |
| -translate-y-6    | --tw-translate-y: -1.5rem;     |
| -translate-y-7    | --tw-translate-y: -1.75rem;    |
| -translate-y-8    | --tw-translate-y: -2rem;       |
| -translate-y-9    | --tw-translate-y: -2.25rem;    |
| -translate-y-10   | --tw-translate-y: -2.5rem;     |
| -translate-y-11   | --tw-translate-y: -2.75rem;    |
| -translate-y-12   | --tw-translate-y: -3rem;       |
| -translate-y-14   | --tw-translate-y: -3.5rem;     |
| -translate-y-16   | --tw-translate-y: -4rem;       |
| -translate-y-20   | --tw-translate-y: -5rem;       |
| -translate-y-24   | --tw-translate-y: -6rem;       |
| -translate-y-28   | --tw-translate-y: -7rem;       |
| -translate-y-32   | --tw-translate-y: -8rem;       |
| -translate-y-36   | --tw-translate-y: -9rem;       |
| -translate-y-40   | --tw-translate-y: -10rem;      |
| -translate-y-44   | --tw-translate-y: -11rem;      |
| -translate-y-48   | --tw-translate-y: -12rem;      |
| -translate-y-52   | --tw-translate-y: -13rem;      |
| -translate-y-56   | --tw-translate-y: -14rem;      |
| -translate-y-60   | --tw-translate-y: -15rem;      |
| -translate-y-64   | --tw-translate-y: -16rem;      |
| -translate-y-72   | --tw-translate-y: -18rem;      |
| -translate-y-80   | --tw-translate-y: -20rem;      |
| -translate-y-96   | --tw-translate-y: -24rem;      |
| -translate-y-1/2  | --tw-translate-y: -50%;        |
| -translate-y-1/3  | --tw-translate-y: -33.333333%; |
| -translate-y-2/3  | --tw-translate-y: -66.666667%; |
| -translate-y-1/4  | --tw-translate-y: -25%;        |
| -translate-y-2/4  | --tw-translate-y: -50%;        |
| -translate-y-3/4  | --tw-translate-y: -75%;        |
| -translate-y-full | --tw-translate-y: -100%;       |

## Usage

Translate an element by first enabling transforms with the `transform` utility, then specifying the translate direction and distance using the `translate-x-{amount}` and `translate-y-{amount}` utilities.

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

```html
<img class="transform translate-y-6 ...">
<img class="transform -translate-y-6 ...">
<img class="transform translate-y-0 ...">
```

## Responsive

To control the translation of an element at a specific breakpoint, add a `{screen}:` prefix to any existing translate utility. For example, use `md:translate-x-8` to apply the `translate-x-8` utility at only medium screen sizes and above.

```html
<img class="transform translate-x-2 md:translate-x-8 ...">
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Translate scale

By default, Tailwind provides fixed value translate utilities that match our [spacing scale](https://tailwindcss.com/docs/customizing-spacing), as well as 50% and 100% variations for translating relative to the element’s size.

You can customize the global spacing scale in the `theme.spacing` or `theme.extend.spacing` sections of your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        spacing: {
+         '72': '18rem',
+         '84': '21rem',
+         '96': '24rem',
        }
      }
    }
  }
```

To customize the translate scale separately, use the `theme.translate` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        translate: {
+         '1/7': '14.2857143%',
+         '2/7': '28.5714286%',
+         '3/7': '42.8571429%',
+         '4/7': '57.1428571%',
+         '5/7': '71.4285714%',
+         '6/7': '85.7142857%',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, hover and focus variants are generated for translate utilities.

You can control which variants are generated for the translate utilities by modifying the `translate` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active and group-hover variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       translate: ['active', 'group-hover'],
      }
    }
  }
```

### Disabling

If you don't plan to use the translate utilities in your project, you can disable them entirely by setting the `translate` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     translate: false,
    }
  }
```

[←Rotate](https://tailwindcss.com/docs/rotate)[Skew
  ](https://tailwindcss.com/docs/skew)



---



# Skew

Utilities for skewing elements with transform.

## Default class reference

| Class      | Properties           |
| ---------- | -------------------- |
| skew-x-0   | --tw-skew-x: 0deg;   |
| skew-x-1   | --tw-skew-x: 1deg;   |
| skew-x-2   | --tw-skew-x: 2deg;   |
| skew-x-3   | --tw-skew-x: 3deg;   |
| skew-x-6   | --tw-skew-x: 6deg;   |
| skew-x-12  | --tw-skew-x: 12deg;  |
| -skew-x-12 | --tw-skew-x: -12deg; |
| -skew-x-6  | --tw-skew-x: -6deg;  |
| -skew-x-3  | --tw-skew-x: -3deg;  |
| -skew-x-2  | --tw-skew-x: -2deg;  |
| -skew-x-1  | --tw-skew-x: -1deg;  |
| skew-y-0   | --tw-skew-y: 0deg;   |
| skew-y-1   | --tw-skew-y: 1deg;   |
| skew-y-2   | --tw-skew-y: 2deg;   |
| skew-y-3   | --tw-skew-y: 3deg;   |
| skew-y-6   | --tw-skew-y: 6deg;   |
| skew-y-12  | --tw-skew-y: 12deg;  |
| -skew-y-12 | --tw-skew-y: -12deg; |
| -skew-y-6  | --tw-skew-y: -6deg;  |
| -skew-y-3  | --tw-skew-y: -3deg;  |
| -skew-y-2  | --tw-skew-y: -2deg;  |
| -skew-y-1  | --tw-skew-y: -1deg;  |

## Usage

Skew an element by first enabling transforms with the `transform` utility, then specifying the skew angle using the `skew-x-{amount}` and `skew-y-{amount}` utilities.

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

![img](https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80)

```html
<img class="transform skew-y-0 ...">
<img class="transform skew-y-3 ...">
<img class="transform skew-y-6 ...">
<img class="transform skew-y-12 ...">
```

## Responsive

To control the skew of an element at a specific breakpoint, add a `{screen}:` prefix to any existing skew utility. For example, use `md:skew-6` to apply the `skew-6` utility at only medium screen sizes and above.

```html
<div class="transform md:skew-6 ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Skew scale

By default, Tailwind provides seven general purpose skew utilities. You change, add, or remove these by customizing the `skew` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        skew: {
+         '25': '25deg',
+         '60': '60deg',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, hover and focus variants are generated for skew utilities.

You can control which variants are generated for the skew utilities by modifying the `skew` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active and group-hover variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       skew: ['active', 'group-hover'],
      }
    }
  }
```

### Disabling

If you don't plan to use the skew utilities in your project, you can disable them entirely by setting the `skew` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     skew: false,
    }
  }
```

[←Translate](https://tailwindcss.com/docs/translate)[Appearance→](https://tailwindcss.com/docs/appearance)



