---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Border Radius

Utilities for controlling the border radius of an element.

## Default class reference

| Class           | Properties                                                   |
| --------------- | ------------------------------------------------------------ |
| rounded-none    | border-radius: 0px;                                          |
| rounded-sm      | border-radius: 0.125rem;                                     |
| rounded         | border-radius: 0.25rem;                                      |
| rounded-md      | border-radius: 0.375rem;                                     |
| rounded-lg      | border-radius: 0.5rem;                                       |
| rounded-xl      | border-radius: 0.75rem;                                      |
| rounded-2xl     | border-radius: 1rem;                                         |
| rounded-3xl     | border-radius: 1.5rem;                                       |
| rounded-full    | border-radius: 9999px;                                       |
| rounded-t-none  | border-top-left-radius: 0px; border-top-right-radius: 0px;   |
| rounded-r-none  | border-top-right-radius: 0px; border-bottom-right-radius: 0px; |
| rounded-b-none  | border-bottom-right-radius: 0px; border-bottom-left-radius: 0px; |
| rounded-l-none  | border-top-left-radius: 0px; border-bottom-left-radius: 0px; |
| rounded-t-sm    | border-top-left-radius: 0.125rem; border-top-right-radius: 0.125rem; |
| rounded-r-sm    | border-top-right-radius: 0.125rem; border-bottom-right-radius: 0.125rem; |
| rounded-b-sm    | border-bottom-right-radius: 0.125rem; border-bottom-left-radius: 0.125rem; |
| rounded-l-sm    | border-top-left-radius: 0.125rem; border-bottom-left-radius: 0.125rem; |
| rounded-t       | border-top-left-radius: 0.25rem; border-top-right-radius: 0.25rem; |
| rounded-r       | border-top-right-radius: 0.25rem; border-bottom-right-radius: 0.25rem; |
| rounded-b       | border-bottom-right-radius: 0.25rem; border-bottom-left-radius: 0.25rem; |
| rounded-l       | border-top-left-radius: 0.25rem; border-bottom-left-radius: 0.25rem; |
| rounded-t-md    | border-top-left-radius: 0.375rem; border-top-right-radius: 0.375rem; |
| rounded-r-md    | border-top-right-radius: 0.375rem; border-bottom-right-radius: 0.375rem; |
| rounded-b-md    | border-bottom-right-radius: 0.375rem; border-bottom-left-radius: 0.375rem; |
| rounded-l-md    | border-top-left-radius: 0.375rem; border-bottom-left-radius: 0.375rem; |
| rounded-t-lg    | border-top-left-radius: 0.5rem; border-top-right-radius: 0.5rem; |
| rounded-r-lg    | border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem; |
| rounded-b-lg    | border-bottom-right-radius: 0.5rem; border-bottom-left-radius: 0.5rem; |
| rounded-l-lg    | border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; |
| rounded-t-xl    | border-top-left-radius: 0.75rem; border-top-right-radius: 0.75rem; |
| rounded-r-xl    | border-top-right-radius: 0.75rem; border-bottom-right-radius: 0.75rem; |
| rounded-b-xl    | border-bottom-right-radius: 0.75rem; border-bottom-left-radius: 0.75rem; |
| rounded-l-xl    | border-top-left-radius: 0.75rem; border-bottom-left-radius: 0.75rem; |
| rounded-t-2xl   | border-top-left-radius: 1rem; border-top-right-radius: 1rem; |
| rounded-r-2xl   | border-top-right-radius: 1rem; border-bottom-right-radius: 1rem; |
| rounded-b-2xl   | border-bottom-right-radius: 1rem; border-bottom-left-radius: 1rem; |
| rounded-l-2xl   | border-top-left-radius: 1rem; border-bottom-left-radius: 1rem; |
| rounded-t-3xl   | border-top-left-radius: 1.5rem; border-top-right-radius: 1.5rem; |
| rounded-r-3xl   | border-top-right-radius: 1.5rem; border-bottom-right-radius: 1.5rem; |
| rounded-b-3xl   | border-bottom-right-radius: 1.5rem; border-bottom-left-radius: 1.5rem; |
| rounded-l-3xl   | border-top-left-radius: 1.5rem; border-bottom-left-radius: 1.5rem; |
| rounded-t-full  | border-top-left-radius: 9999px; border-top-right-radius: 9999px; |
| rounded-r-full  | border-top-right-radius: 9999px; border-bottom-right-radius: 9999px; |
| rounded-b-full  | border-bottom-right-radius: 9999px; border-bottom-left-radius: 9999px; |
| rounded-l-full  | border-top-left-radius: 9999px; border-bottom-left-radius: 9999px; |
| rounded-tl-none | border-top-left-radius: 0px;                                 |
| rounded-tr-none | border-top-right-radius: 0px;                                |
| rounded-br-none | border-bottom-right-radius: 0px;                             |
| rounded-bl-none | border-bottom-left-radius: 0px;                              |
| rounded-tl-sm   | border-top-left-radius: 0.125rem;                            |
| rounded-tr-sm   | border-top-right-radius: 0.125rem;                           |
| rounded-br-sm   | border-bottom-right-radius: 0.125rem;                        |
| rounded-bl-sm   | border-bottom-left-radius: 0.125rem;                         |
| rounded-tl      | border-top-left-radius: 0.25rem;                             |
| rounded-tr      | border-top-right-radius: 0.25rem;                            |
| rounded-br      | border-bottom-right-radius: 0.25rem;                         |
| rounded-bl      | border-bottom-left-radius: 0.25rem;                          |
| rounded-tl-md   | border-top-left-radius: 0.375rem;                            |
| rounded-tr-md   | border-top-right-radius: 0.375rem;                           |
| rounded-br-md   | border-bottom-right-radius: 0.375rem;                        |
| rounded-bl-md   | border-bottom-left-radius: 0.375rem;                         |
| rounded-tl-lg   | border-top-left-radius: 0.5rem;                              |
| rounded-tr-lg   | border-top-right-radius: 0.5rem;                             |
| rounded-br-lg   | border-bottom-right-radius: 0.5rem;                          |
| rounded-bl-lg   | border-bottom-left-radius: 0.5rem;                           |
| rounded-tl-xl   | border-top-left-radius: 0.75rem;                             |
| rounded-tr-xl   | border-top-right-radius: 0.75rem;                            |
| rounded-br-xl   | border-bottom-right-radius: 0.75rem;                         |
| rounded-bl-xl   | border-bottom-left-radius: 0.75rem;                          |
| rounded-tl-2xl  | border-top-left-radius: 1rem;                                |
| rounded-tr-2xl  | border-top-right-radius: 1rem;                               |
| rounded-br-2xl  | border-bottom-right-radius: 1rem;                            |
| rounded-bl-2xl  | border-bottom-left-radius: 1rem;                             |
| rounded-tl-3xl  | border-top-left-radius: 1.5rem;                              |
| rounded-tr-3xl  | border-top-right-radius: 1.5rem;                             |
| rounded-br-3xl  | border-bottom-right-radius: 1.5rem;                          |
| rounded-bl-3xl  | border-bottom-left-radius: 1.5rem;                           |
| rounded-tl-full | border-top-left-radius: 9999px;                              |
| rounded-tr-full | border-top-right-radius: 9999px;                             |
| rounded-br-full | border-bottom-right-radius: 9999px;                          |
| rounded-bl-full | border-bottom-left-radius: 9999px;                           |

## Rounded corners

Use utilities like `.rounded-sm`, `.rounded`, or `.rounded-lg` to apply different border radius sizes to an element.

.rounded-sm

.rounded

.rounded-md

.rounded-lg

```html
<div class="rounded-sm ..."></div>
<div class="rounded ..."></div>
<div class="rounded-md ..."></div>
<div class="rounded-lg ..."></div>
```

## Pills and circles

Use the `rounded-full` utility to create pills and circles.

Pill Shape

Circle

```html
<div class="rounded-full py-3 px-6...">Pill Shape</div>
<div class="rounded-full h-24 w-24 flex items-center justify-center...">Circle</div>
```

## No rounding

Use `rounded-none` to remove an existing border radius from an element.

This is most commonly used to remove a border radius that was applied at a smaller breakpoint.

.rounded-none

```html
<div class="rounded-none ...">.rounded-none</div>
```

## Rounding sides separately

Use `rounded-{t|r|b|l}{-size?}` to only round one side of an element.

.rounded-t-lg

.rounded-r-lg

.rounded-b-lg

.rounded-l-lg

```html
<div class="rounded-t-lg ...">.rounded-t-lg</div>
<div class="rounded-r-lg ...">.rounded-r-lg</div>
<div class="rounded-b-lg ...">.rounded-b-lg</div>
<div class="rounded-l-lg ...">.rounded-l-lg</div>
```

## Rounding corners separately

Use `rounded-{tl|tr|br|bl}{-size?}` to only round one corner an element.

.rounded-tl-lg

.rounded-tr-lg

.rounded-br-lg

.rounded-bl-lg

```html
<div class="rounded-tl-lg ..."></div>
<div class="rounded-tr-lg ..."></div>
<div class="rounded-br-lg ..."></div>
<div class="rounded-bl-lg ..."></div>
```

## Responsive

To control the border radius of an element at a specific breakpoint, add a `{screen}:` prefix to any existing border radius utility. For example, use `md:rounded-lg` to apply the `rounded-lg` utility at only medium screen sizes and above.

```html
<div class="rounded md:rounded-lg ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Border Radiuses

By default, Tailwind provides five border radius size utilities. You can change, add, or remove these by editing the `theme.borderRadius` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      borderRadius: {
        'none': '0',
-       'sm': '0.125rem',
-       DEFAULT: '0.25rem',
+       DEFAULT: '4px',
-       'md': '0.375rem',
-       'lg': '0.5rem',
-       'full': '9999px',
+       'large': '12px',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for border radius utilities.

You can control which variants are generated for the border radius utilities by modifying the `borderRadius` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       borderRadius: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the border radius utilities in your project, you can disable them entirely by setting the `borderRadius` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     borderRadius: false,
    }
  }
```

[←Gradient Color Stops](https://tailwindcss.com/docs/gradient-color-stops)[Border Width
  ](https://tailwindcss.com/docs/border-width)



---



# Border Width

Utilities for controlling the width of an element's borders.

## Default class reference

| Class      | Properties                |
| ---------- | ------------------------- |
| border-0   | border-width: 0px;        |
| border-2   | border-width: 2px;        |
| border-4   | border-width: 4px;        |
| border-8   | border-width: 8px;        |
| border     | border-width: 1px;        |
| border-t-0 | border-top-width: 0px;    |
| border-r-0 | border-right-width: 0px;  |
| border-b-0 | border-bottom-width: 0px; |
| border-l-0 | border-left-width: 0px;   |
| border-t-2 | border-top-width: 2px;    |
| border-r-2 | border-right-width: 2px;  |
| border-b-2 | border-bottom-width: 2px; |
| border-l-2 | border-left-width: 2px;   |
| border-t-4 | border-top-width: 4px;    |
| border-r-4 | border-right-width: 4px;  |
| border-b-4 | border-bottom-width: 4px; |
| border-l-4 | border-left-width: 4px;   |
| border-t-8 | border-top-width: 8px;    |
| border-r-8 | border-right-width: 8px;  |
| border-b-8 | border-bottom-width: 8px; |
| border-l-8 | border-left-width: 8px;   |
| border-t   | border-top-width: 1px;    |
| border-r   | border-right-width: 1px;  |
| border-b   | border-bottom-width: 1px; |
| border-l   | border-left-width: 1px;   |

## All sides

Use the `border`, `.border-0`, `.border-2`, `.border-4`, or `.border-8` utilities to set the border width for all sides of an element.

.border-0

.border

.border-2

.border-4

.border-8

```html
<div class="border-0 border-indigo-600 ..."></div>
<div class="border border-indigo-600 ..."></div>
<div class="border-2 border-indigo-600 ..."></div>
<div class="border-4 border-indigo-600 ..."></div>
<div class="border-8 border-indigo-600 ..."></div>
```

## Individual sides

Use the `border-{side}`, `.border-{side}-0`, `.border-{side}-2`, `.border-{side}-4`, or `.border-{side}-8` utilities to set the border width for one side of an element.

.border-t-2

.border-r-2

.border-b-2

.border-l-2

```html
<div class="border-t-2 border-fuchsia-600 ..."></div>
<div class="border-r-2 border-fuchsia-600 ..."></div>
<div class="border-b-2 border-fuchsia-600 ..."></div>
<div class="border-l-2 border-fuchsia-600 ..."></div>
```

## Between elements

You can also add borders between child elements using the `divide-{x/y}-{width}` and `divide-{color}` utilities.

Learn more in the [Divide Width](https://tailwindcss.com/docs/divide-width) and [Divide Color](https://tailwindcss.com/docs/divide-color) documentation.

1

2

3

```html
<div class="divide-y divide-light-blue-400 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div></div>
</div>
```

## Responsive

To control the border width of an element at a specific breakpoint, add a `{screen}:` prefix to any existing border width utility. For example, use `md:border-t-4` to apply the `border-t-4` utility at only medium screen sizes and above.

```html
<div class="border-2 md:border-t-4 ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Border Widths

By default, Tailwind provides five `border-width` utilities, and the same number of utilities per side (top, right, bottom, and left). You change, add, or remove these by editing the `theme.borderWidth` section of your Tailwind config. The values in this section will also control which utilities will be generated side.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      borderWidth: {
        DEFAULT: '1px',
        '0': '0',
        '2': '2px',
+       '3': '3px',
        '4': '4px',
+       '6': '6px',
-       '8': '8px',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for border width utilities.

You can control which variants are generated for the border width utilities by modifying the `borderWidth` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       borderWidth: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the border width utilities in your project, you can disable them entirely by setting the `borderWidth` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     borderWidth: false,
    }
  }
```

[←Border Radius](https://tailwindcss.com/docs/border-radius)[Border Color
  ](https://tailwindcss.com/docs/border-color)



---



# Border Color

Utilities for controlling the color of an element's borders.

## Default class reference

| Class              | Properties                                                   | Preview |
| ------------------ | ------------------------------------------------------------ | ------- |
| border-transparent | border-color: transparent;                                   |         |
| border-current     | border-color: currentColor;                                  |         |
| border-black       | --tw-border-opacity: 1; border-color: rgba(0, 0, 0, var(--tw-border-opacity)); |         |
| border-white       | --tw-border-opacity: 1; border-color: rgba(255, 255, 255, var(--tw-border-opacity)); |         |
| border-gray-50     | --tw-border-opacity: 1; border-color: rgba(249, 250, 251, var(--tw-border-opacity)); |         |
| border-gray-100    | --tw-border-opacity: 1; border-color: rgba(243, 244, 246, var(--tw-border-opacity)); |         |
| border-gray-200    | --tw-border-opacity: 1; border-color: rgba(229, 231, 235, var(--tw-border-opacity)); |         |
| border-gray-300    | --tw-border-opacity: 1; border-color: rgba(209, 213, 219, var(--tw-border-opacity)); |         |
| border-gray-400    | --tw-border-opacity: 1; border-color: rgba(156, 163, 175, var(--tw-border-opacity)); |         |
| border-gray-500    | --tw-border-opacity: 1; border-color: rgba(107, 114, 128, var(--tw-border-opacity)); |         |
| border-gray-600    | --tw-border-opacity: 1; border-color: rgba(75, 85, 99, var(--tw-border-opacity)); |         |
| border-gray-700    | --tw-border-opacity: 1; border-color: rgba(55, 65, 81, var(--tw-border-opacity)); |         |
| border-gray-800    | --tw-border-opacity: 1; border-color: rgba(31, 41, 55, var(--tw-border-opacity)); |         |
| border-gray-900    | --tw-border-opacity: 1; border-color: rgba(17, 24, 39, var(--tw-border-opacity)); |         |
| border-red-50      | --tw-border-opacity: 1; border-color: rgba(254, 242, 242, var(--tw-border-opacity)); |         |
| border-red-100     | --tw-border-opacity: 1; border-color: rgba(254, 226, 226, var(--tw-border-opacity)); |         |
| border-red-200     | --tw-border-opacity: 1; border-color: rgba(254, 202, 202, var(--tw-border-opacity)); |         |
| border-red-300     | --tw-border-opacity: 1; border-color: rgba(252, 165, 165, var(--tw-border-opacity)); |         |
| border-red-400     | --tw-border-opacity: 1; border-color: rgba(248, 113, 113, var(--tw-border-opacity)); |         |
| border-red-500     | --tw-border-opacity: 1; border-color: rgba(239, 68, 68, var(--tw-border-opacity)); |         |
| border-red-600     | --tw-border-opacity: 1; border-color: rgba(220, 38, 38, var(--tw-border-opacity)); |         |
| border-red-700     | --tw-border-opacity: 1; border-color: rgba(185, 28, 28, var(--tw-border-opacity)); |         |
| border-red-800     | --tw-border-opacity: 1; border-color: rgba(153, 27, 27, var(--tw-border-opacity)); |         |
| border-red-900     | --tw-border-opacity: 1; border-color: rgba(127, 29, 29, var(--tw-border-opacity)); |         |
| border-yellow-50   | --tw-border-opacity: 1; border-color: rgba(255, 251, 235, var(--tw-border-opacity)); |         |
| border-yellow-100  | --tw-border-opacity: 1; border-color: rgba(254, 243, 199, var(--tw-border-opacity)); |         |
| border-yellow-200  | --tw-border-opacity: 1; border-color: rgba(253, 230, 138, var(--tw-border-opacity)); |         |
| border-yellow-300  | --tw-border-opacity: 1; border-color: rgba(252, 211, 77, var(--tw-border-opacity)); |         |
| border-yellow-400  | --tw-border-opacity: 1; border-color: rgba(251, 191, 36, var(--tw-border-opacity)); |         |
| border-yellow-500  | --tw-border-opacity: 1; border-color: rgba(245, 158, 11, var(--tw-border-opacity)); |         |
| border-yellow-600  | --tw-border-opacity: 1; border-color: rgba(217, 119, 6, var(--tw-border-opacity)); |         |
| border-yellow-700  | --tw-border-opacity: 1; border-color: rgba(180, 83, 9, var(--tw-border-opacity)); |         |
| border-yellow-800  | --tw-border-opacity: 1; border-color: rgba(146, 64, 14, var(--tw-border-opacity)); |         |
| border-yellow-900  | --tw-border-opacity: 1; border-color: rgba(120, 53, 15, var(--tw-border-opacity)); |         |
| border-green-50    | --tw-border-opacity: 1; border-color: rgba(236, 253, 245, var(--tw-border-opacity)); |         |
| border-green-100   | --tw-border-opacity: 1; border-color: rgba(209, 250, 229, var(--tw-border-opacity)); |         |
| border-green-200   | --tw-border-opacity: 1; border-color: rgba(167, 243, 208, var(--tw-border-opacity)); |         |
| border-green-300   | --tw-border-opacity: 1; border-color: rgba(110, 231, 183, var(--tw-border-opacity)); |         |
| border-green-400   | --tw-border-opacity: 1; border-color: rgba(52, 211, 153, var(--tw-border-opacity)); |         |
| border-green-500   | --tw-border-opacity: 1; border-color: rgba(16, 185, 129, var(--tw-border-opacity)); |         |
| border-green-600   | --tw-border-opacity: 1; border-color: rgba(5, 150, 105, var(--tw-border-opacity)); |         |
| border-green-700   | --tw-border-opacity: 1; border-color: rgba(4, 120, 87, var(--tw-border-opacity)); |         |
| border-green-800   | --tw-border-opacity: 1; border-color: rgba(6, 95, 70, var(--tw-border-opacity)); |         |
| border-green-900   | --tw-border-opacity: 1; border-color: rgba(6, 78, 59, var(--tw-border-opacity)); |         |
| border-blue-50     | --tw-border-opacity: 1; border-color: rgba(239, 246, 255, var(--tw-border-opacity)); |         |
| border-blue-100    | --tw-border-opacity: 1; border-color: rgba(219, 234, 254, var(--tw-border-opacity)); |         |
| border-blue-200    | --tw-border-opacity: 1; border-color: rgba(191, 219, 254, var(--tw-border-opacity)); |         |
| border-blue-300    | --tw-border-opacity: 1; border-color: rgba(147, 197, 253, var(--tw-border-opacity)); |         |
| border-blue-400    | --tw-border-opacity: 1; border-color: rgba(96, 165, 250, var(--tw-border-opacity)); |         |
| border-blue-500    | --tw-border-opacity: 1; border-color: rgba(59, 130, 246, var(--tw-border-opacity)); |         |
| border-blue-600    | --tw-border-opacity: 1; border-color: rgba(37, 99, 235, var(--tw-border-opacity)); |         |
| border-blue-700    | --tw-border-opacity: 1; border-color: rgba(29, 78, 216, var(--tw-border-opacity)); |         |
| border-blue-800    | --tw-border-opacity: 1; border-color: rgba(30, 64, 175, var(--tw-border-opacity)); |         |
| border-blue-900    | --tw-border-opacity: 1; border-color: rgba(30, 58, 138, var(--tw-border-opacity)); |         |
| border-indigo-50   | --tw-border-opacity: 1; border-color: rgba(238, 242, 255, var(--tw-border-opacity)); |         |
| border-indigo-100  | --tw-border-opacity: 1; border-color: rgba(224, 231, 255, var(--tw-border-opacity)); |         |
| border-indigo-200  | --tw-border-opacity: 1; border-color: rgba(199, 210, 254, var(--tw-border-opacity)); |         |
| border-indigo-300  | --tw-border-opacity: 1; border-color: rgba(165, 180, 252, var(--tw-border-opacity)); |         |
| border-indigo-400  | --tw-border-opacity: 1; border-color: rgba(129, 140, 248, var(--tw-border-opacity)); |         |
| border-indigo-500  | --tw-border-opacity: 1; border-color: rgba(99, 102, 241, var(--tw-border-opacity)); |         |
| border-indigo-600  | --tw-border-opacity: 1; border-color: rgba(79, 70, 229, var(--tw-border-opacity)); |         |
| border-indigo-700  | --tw-border-opacity: 1; border-color: rgba(67, 56, 202, var(--tw-border-opacity)); |         |
| border-indigo-800  | --tw-border-opacity: 1; border-color: rgba(55, 48, 163, var(--tw-border-opacity)); |         |
| border-indigo-900  | --tw-border-opacity: 1; border-color: rgba(49, 46, 129, var(--tw-border-opacity)); |         |
| border-purple-50   | --tw-border-opacity: 1; border-color: rgba(245, 243, 255, var(--tw-border-opacity)); |         |
| border-purple-100  | --tw-border-opacity: 1; border-color: rgba(237, 233, 254, var(--tw-border-opacity)); |         |
| border-purple-200  | --tw-border-opacity: 1; border-color: rgba(221, 214, 254, var(--tw-border-opacity)); |         |
| border-purple-300  | --tw-border-opacity: 1; border-color: rgba(196, 181, 253, var(--tw-border-opacity)); |         |
| border-purple-400  | --tw-border-opacity: 1; border-color: rgba(167, 139, 250, var(--tw-border-opacity)); |         |
| border-purple-500  | --tw-border-opacity: 1; border-color: rgba(139, 92, 246, var(--tw-border-opacity)); |         |
| border-purple-600  | --tw-border-opacity: 1; border-color: rgba(124, 58, 237, var(--tw-border-opacity)); |         |
| border-purple-700  | --tw-border-opacity: 1; border-color: rgba(109, 40, 217, var(--tw-border-opacity)); |         |
| border-purple-800  | --tw-border-opacity: 1; border-color: rgba(91, 33, 182, var(--tw-border-opacity)); |         |
| border-purple-900  | --tw-border-opacity: 1; border-color: rgba(76, 29, 149, var(--tw-border-opacity)); |         |
| border-pink-50     | --tw-border-opacity: 1; border-color: rgba(253, 242, 248, var(--tw-border-opacity)); |         |
| border-pink-100    | --tw-border-opacity: 1; border-color: rgba(252, 231, 243, var(--tw-border-opacity)); |         |
| border-pink-200    | --tw-border-opacity: 1; border-color: rgba(251, 207, 232, var(--tw-border-opacity)); |         |
| border-pink-300    | --tw-border-opacity: 1; border-color: rgba(249, 168, 212, var(--tw-border-opacity)); |         |
| border-pink-400    | --tw-border-opacity: 1; border-color: rgba(244, 114, 182, var(--tw-border-opacity)); |         |
| border-pink-500    | --tw-border-opacity: 1; border-color: rgba(236, 72, 153, var(--tw-border-opacity)); |         |
| border-pink-600    | --tw-border-opacity: 1; border-color: rgba(219, 39, 119, var(--tw-border-opacity)); |         |
| border-pink-700    | --tw-border-opacity: 1; border-color: rgba(190, 24, 93, var(--tw-border-opacity)); |         |
| border-pink-800    | --tw-border-opacity: 1; border-color: rgba(157, 23, 77, var(--tw-border-opacity)); |         |
| border-pink-900    | --tw-border-opacity: 1; border-color: rgba(131, 24, 67, var(--tw-border-opacity)); |         |

## Usage

Control the border color of an element using the `border-{color}` utilities.

```html
<input class="border-2 border-red-500 ...">
```

### Changing opacity

Control the opacity of an element’s border color using the `border-opacity-{amount}` utilities.

100%

75%

50%

25%

0%

```html
<div class="border-4 border-light-blue-500 border-opacity-100 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-75 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-50 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-25 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-0 ..."></div>
```

Learn more in the [border opacity documentation](https://tailwindcss.com/docs/border-opacity).

## Responsive

To control the border color of an element at a specific breakpoint, add a `{screen}:` prefix to any existing border color utility. For example, use `md:border-green-500` to apply the `border-green-500` utility at only medium screen sizes and above.

```html
<button class="border-blue-500 md:border-green-500 ...">
  Button
</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Hover

To control the border color of an element on hover, add the `hover:` prefix to any existing border color utility. For example, use `hover:border-blue-500` to apply the `border-blue-500` utility on hover.

Button

```html
<button class="border-2 border-purple-500 hover:border-gray-500 ...">
  Button
</button>
```

Hover utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `hover:` prefix.

```html
<button class="... md:border-blue-500 md:hover:border-blue-700 ...">Button</button>
```

## Focus

To control the border color of an element on focus, add the `focus:` prefix to any existing border color utility. For example, use `focus:border-blue-500` to apply the `border-blue-500` utility on focus.

```html
<input class="border border-red-500 focus:border-blue-500 ...">
```

Focus utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<input class="... md:border-gray-200 md:focus:border-white ...">
```

------

## Customizing

### Border Colors

By default, Tailwind makes the entire [default color palette](https://tailwindcss.com/docs/customizing-colors#default-color-palette) available as border colors.

You can [customize your color palette](https://tailwindcss.com/docs/colors#customizing) by editing the `theme.colors` section of your `tailwind.config.js` file, or customize just your border colors using the `theme.borderColor` section.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      borderColor: theme => ({
-       ...theme('colors'),
        DEFAULT: theme('colors.gray.300', 'currentColor'),
+       'primary': '#3490dc',
+       'secondary': '#ffed4a',
+       'danger': '#e3342f',
      })
    }
  }
```

### Variants

By default, only responsive, dark mode *(if enabled)*, group-hover, focus-within, hover and focus variants are generated for border color utilities.

You can control which variants are generated for the border color utilities by modifying the `borderColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       borderColor: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the border color utilities in your project, you can disable them entirely by setting the `borderColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     borderColor: false,
    }
  }
```

[←Border Width](https://tailwindcss.com/docs/border-width)[Border Opacity
  ](https://tailwindcss.com/docs/border-opacity)



---



# Border Opacity

Utilities for controlling the opacity of an element's border color.

## Default class reference

| Class              | Properties                 |
| ------------------ | -------------------------- |
| border-opacity-0   | --tw-border-opacity: 0;    |
| border-opacity-5   | --tw-border-opacity: 0.05; |
| border-opacity-10  | --tw-border-opacity: 0.1;  |
| border-opacity-20  | --tw-border-opacity: 0.2;  |
| border-opacity-25  | --tw-border-opacity: 0.25; |
| border-opacity-30  | --tw-border-opacity: 0.3;  |
| border-opacity-40  | --tw-border-opacity: 0.4;  |
| border-opacity-50  | --tw-border-opacity: 0.5;  |
| border-opacity-60  | --tw-border-opacity: 0.6;  |
| border-opacity-70  | --tw-border-opacity: 0.7;  |
| border-opacity-75  | --tw-border-opacity: 0.75; |
| border-opacity-80  | --tw-border-opacity: 0.8;  |
| border-opacity-90  | --tw-border-opacity: 0.9;  |
| border-opacity-95  | --tw-border-opacity: 0.95; |
| border-opacity-100 | --tw-border-opacity: 1;    |

## Usage

Control the opacity of an element’s border color using the `border-opacity-{amount}` utilities.

100%

75%

50%

25%

0%

```html
<div class="border-4 border-light-blue-500 border-opacity-100 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-75 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-50 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-25 ..."></div>
<div class="border-4 border-light-blue-500 border-opacity-0 ..."></div>
```

## Responsive

To control an element’s border color opacity at a specific breakpoint, add a `{screen}:` prefix to any existing border color opacity utility. For example, use `md:border-opacity-50` to apply the `border-opacity-50` utility at only medium screen sizes and above.

```html
<div class="border-2 border-blue-500 border-opacity-75 md:border-opacity-50">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

To customize the opacity values for all opacity-related utilities at once, use the `opacity` section of your `tailwind.config.js` theme configuration:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        opacity: {
+         '10': '0.1',
+         '20': '0.2',
+         '95': '0.95',
        }
      }
    }
  }
```

If you want to customize only the border opacity utilities, use the `borderOpacity` section:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        borderOpacity: {
+         '10': '0.1',
+         '20': '0.2',
+         '95': '0.95',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, dark mode *(if enabled)*, group-hover, focus-within, hover and focus variants are generated for border opacity utilities.

You can control which variants are generated for the border opacity utilities by modifying the `borderOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       borderOpacity: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the border opacity utilities in your project, you can disable them entirely by setting the `borderOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     borderOpacity: false,
    }
  }
```

[←Border Color](https://tailwindcss.com/docs/border-color)[Border Style
  ](https://tailwindcss.com/docs/border-style)



---



# Border Style

Utilities for controlling the style of an element's borders.

## Default class reference

| Class         | Properties            |
| ------------- | --------------------- |
| border-solid  | border-style: solid;  |
| border-dashed | border-style: dashed; |
| border-dotted | border-style: dotted; |
| border-double | border-style: double; |
| border-none   | border-style: none;   |

## Usage

Use `border-{style}` to control an element’s border style.

.border-solid

.border-dashed

.border-dotted

.border-double

.border-none

```html
<div class="border-solid border-4 border-light-blue-500 ..."></div>
<div class="border-dashed border-4 border-light-blue-500 ..."></div>
<div class="border-dotted border-4 border-light-blue-500 ..."></div>
<div class="border-double border-4 border-light-blue-500 ..."></div>
<div class="border-none border-4 border-light-blue-500 ..."></div>
```

## Responsive

To control the border style of an element at a specific breakpoint, add a `{screen}:` prefix to any existing border style utility. For example, use `md:border-dotted` to apply the `border-dotted` utility at only medium screen sizes and above.

```html
<div class="border-solid md:border-dotted ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for border style utilities.

You can control which variants are generated for the border style utilities by modifying the `borderStyle` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       borderStyle: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the border style utilities in your project, you can disable them entirely by setting the `borderStyle` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     borderStyle: false,
    }
  }
```

[←Border Opacity](https://tailwindcss.com/docs/border-opacity)[Divide Width
  ](https://tailwindcss.com/docs/divide-width)



---

# Divide Width

Utilities for controlling the border width between elements.

## Default class reference

| Class                    | Properties                                                   |
| ------------------------ | ------------------------------------------------------------ |
| divide-y-0 > * + *       | --tw-divide-y-reverse: 0; border-top-width: calc(0px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(0px * var(--tw-divide-y-reverse)); |
| divide-x-0 > * + *       | --tw-divide-x-reverse: 0; border-right-width: calc(0px * var(--tw-divide-x-reverse)); border-left-width: calc(0px * calc(1 - var(--tw-divide-x-reverse))); |
| divide-y-2 > * + *       | --tw-divide-y-reverse: 0; border-top-width: calc(2px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(2px * var(--tw-divide-y-reverse)); |
| divide-x-2 > * + *       | --tw-divide-x-reverse: 0; border-right-width: calc(2px * var(--tw-divide-x-reverse)); border-left-width: calc(2px * calc(1 - var(--tw-divide-x-reverse))); |
| divide-y-4 > * + *       | --tw-divide-y-reverse: 0; border-top-width: calc(4px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(4px * var(--tw-divide-y-reverse)); |
| divide-x-4 > * + *       | --tw-divide-x-reverse: 0; border-right-width: calc(4px * var(--tw-divide-x-reverse)); border-left-width: calc(4px * calc(1 - var(--tw-divide-x-reverse))); |
| divide-y-8 > * + *       | --tw-divide-y-reverse: 0; border-top-width: calc(8px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(8px * var(--tw-divide-y-reverse)); |
| divide-x-8 > * + *       | --tw-divide-x-reverse: 0; border-right-width: calc(8px * var(--tw-divide-x-reverse)); border-left-width: calc(8px * calc(1 - var(--tw-divide-x-reverse))); |
| divide-y > * + *         | --tw-divide-y-reverse: 0; border-top-width: calc(1px * calc(1 - var(--tw-divide-y-reverse))); border-bottom-width: calc(1px * var(--tw-divide-y-reverse)); |
| divide-x > * + *         | --tw-divide-x-reverse: 0; border-right-width: calc(1px * var(--tw-divide-x-reverse)); border-left-width: calc(1px * calc(1 - var(--tw-divide-x-reverse))); |
| divide-y-reverse > * + * | --tw-divide-y-reverse: 1;                                    |
| divide-x-reverse > * + * | --tw-divide-x-reverse: 1;                                    |

## Add borders between horizontal children

Add borders between horizontal elements using the `divide-x-{amount}` utilities.

1

2

3

```html
<div class="grid grid-cols-3 divide-x divide-green-500">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Add borders between stacked children

Add borders between stacked elements using the `divide-y-{amount}` utilities.

1

2

3

```html
<div class="grid grid-cols-1 divide-y divide-yellow-500">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Reversing children order

If your elements are in reverse order (using say `flex-row-reverse` or `flex-col-reverse`), use the `divide-x-reverse` or `divide-y-reverse` utilities to ensure the border is added to the correct side of each element.

1

2

3

```html
<div class="flex flex-col-reverse divide-y divide-y-reverse divide-rose-400">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

------

## Responsive

To control the borders between elements at a specific breakpoint, add a `{screen}:` prefix to any existing divide utility. For example, adding the class `md:divide-y-8` to an element would apply the `divide-y-8` utility at medium screen sizes and above.

```html
<div class="divide-y divide-gray-400 md:divide-y-8">
  <div class="py-2">1</div>
  <div class="py-2">2</div>
  <div class="py-2">3</div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

### Divide width scale

The divide width scale inherits its values from the `borderWidth` scale by default, so if you’d like to customize your values for both border width and divide width together, use the `theme.borderWidth` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      borderWidth: {
        DEFAULT: '1px',
        '0': '0',
        '2': '2px',
+       '3': '3px',
        '4': '4px',
+       '6': '6px',
-       '8': '8px',
      }
    }
  }
```

To customize only the divide width values, use the `theme.divideWidth` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      divideWidth: {
        DEFAULT: '1px',
        '0': '0',
        '2': '2px',
+       '3': '3px',
        '4': '4px',
+       '6': '6px',
-       '8': '8px',
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for divide width utilities.

You can control which variants are generated for the divide width utilities by modifying the `divideWidth` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       divideWidth: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the divide width utilities in your project, you can disable them entirely by setting the `divideWidth` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     divideWidth: false,
    }
  }
```

[←Border Style](https://tailwindcss.com/docs/border-style)[Divide Color
  ](https://tailwindcss.com/docs/divide-color)



---



# Divide Color

Utilities for controlling the border color between elements.

## Default class reference

| Class                      | Properties                                                   | Preview |
| -------------------------- | ------------------------------------------------------------ | ------- |
| divide-transparent > * + * | border-color: transparent;                                   |         |
| divide-current > * + *     | border-color: currentColor;                                  |         |
| divide-black > * + *       | --tw-divide-opacity: 1; border-color: rgba(0, 0, 0, var(--tw-divide-opacity)); |         |
| divide-white > * + *       | --tw-divide-opacity: 1; border-color: rgba(255, 255, 255, var(--tw-divide-opacity)); |         |
| divide-gray-50 > * + *     | --tw-divide-opacity: 1; border-color: rgba(249, 250, 251, var(--tw-divide-opacity)); |         |
| divide-gray-100 > * + *    | --tw-divide-opacity: 1; border-color: rgba(243, 244, 246, var(--tw-divide-opacity)); |         |
| divide-gray-200 > * + *    | --tw-divide-opacity: 1; border-color: rgba(229, 231, 235, var(--tw-divide-opacity)); |         |
| divide-gray-300 > * + *    | --tw-divide-opacity: 1; border-color: rgba(209, 213, 219, var(--tw-divide-opacity)); |         |
| divide-gray-400 > * + *    | --tw-divide-opacity: 1; border-color: rgba(156, 163, 175, var(--tw-divide-opacity)); |         |
| divide-gray-500 > * + *    | --tw-divide-opacity: 1; border-color: rgba(107, 114, 128, var(--tw-divide-opacity)); |         |
| divide-gray-600 > * + *    | --tw-divide-opacity: 1; border-color: rgba(75, 85, 99, var(--tw-divide-opacity)); |         |
| divide-gray-700 > * + *    | --tw-divide-opacity: 1; border-color: rgba(55, 65, 81, var(--tw-divide-opacity)); |         |
| divide-gray-800 > * + *    | --tw-divide-opacity: 1; border-color: rgba(31, 41, 55, var(--tw-divide-opacity)); |         |
| divide-gray-900 > * + *    | --tw-divide-opacity: 1; border-color: rgba(17, 24, 39, var(--tw-divide-opacity)); |         |
| divide-red-50 > * + *      | --tw-divide-opacity: 1; border-color: rgba(254, 242, 242, var(--tw-divide-opacity)); |         |
| divide-red-100 > * + *     | --tw-divide-opacity: 1; border-color: rgba(254, 226, 226, var(--tw-divide-opacity)); |         |
| divide-red-200 > * + *     | --tw-divide-opacity: 1; border-color: rgba(254, 202, 202, var(--tw-divide-opacity)); |         |
| divide-red-300 > * + *     | --tw-divide-opacity: 1; border-color: rgba(252, 165, 165, var(--tw-divide-opacity)); |         |
| divide-red-400 > * + *     | --tw-divide-opacity: 1; border-color: rgba(248, 113, 113, var(--tw-divide-opacity)); |         |
| divide-red-500 > * + *     | --tw-divide-opacity: 1; border-color: rgba(239, 68, 68, var(--tw-divide-opacity)); |         |
| divide-red-600 > * + *     | --tw-divide-opacity: 1; border-color: rgba(220, 38, 38, var(--tw-divide-opacity)); |         |
| divide-red-700 > * + *     | --tw-divide-opacity: 1; border-color: rgba(185, 28, 28, var(--tw-divide-opacity)); |         |
| divide-red-800 > * + *     | --tw-divide-opacity: 1; border-color: rgba(153, 27, 27, var(--tw-divide-opacity)); |         |
| divide-red-900 > * + *     | --tw-divide-opacity: 1; border-color: rgba(127, 29, 29, var(--tw-divide-opacity)); |         |
| divide-yellow-50 > * + *   | --tw-divide-opacity: 1; border-color: rgba(255, 251, 235, var(--tw-divide-opacity)); |         |
| divide-yellow-100 > * + *  | --tw-divide-opacity: 1; border-color: rgba(254, 243, 199, var(--tw-divide-opacity)); |         |
| divide-yellow-200 > * + *  | --tw-divide-opacity: 1; border-color: rgba(253, 230, 138, var(--tw-divide-opacity)); |         |
| divide-yellow-300 > * + *  | --tw-divide-opacity: 1; border-color: rgba(252, 211, 77, var(--tw-divide-opacity)); |         |
| divide-yellow-400 > * + *  | --tw-divide-opacity: 1; border-color: rgba(251, 191, 36, var(--tw-divide-opacity)); |         |
| divide-yellow-500 > * + *  | --tw-divide-opacity: 1; border-color: rgba(245, 158, 11, var(--tw-divide-opacity)); |         |
| divide-yellow-600 > * + *  | --tw-divide-opacity: 1; border-color: rgba(217, 119, 6, var(--tw-divide-opacity)); |         |
| divide-yellow-700 > * + *  | --tw-divide-opacity: 1; border-color: rgba(180, 83, 9, var(--tw-divide-opacity)); |         |
| divide-yellow-800 > * + *  | --tw-divide-opacity: 1; border-color: rgba(146, 64, 14, var(--tw-divide-opacity)); |         |
| divide-yellow-900 > * + *  | --tw-divide-opacity: 1; border-color: rgba(120, 53, 15, var(--tw-divide-opacity)); |         |
| divide-green-50 > * + *    | --tw-divide-opacity: 1; border-color: rgba(236, 253, 245, var(--tw-divide-opacity)); |         |
| divide-green-100 > * + *   | --tw-divide-opacity: 1; border-color: rgba(209, 250, 229, var(--tw-divide-opacity)); |         |
| divide-green-200 > * + *   | --tw-divide-opacity: 1; border-color: rgba(167, 243, 208, var(--tw-divide-opacity)); |         |
| divide-green-300 > * + *   | --tw-divide-opacity: 1; border-color: rgba(110, 231, 183, var(--tw-divide-opacity)); |         |
| divide-green-400 > * + *   | --tw-divide-opacity: 1; border-color: rgba(52, 211, 153, var(--tw-divide-opacity)); |         |
| divide-green-500 > * + *   | --tw-divide-opacity: 1; border-color: rgba(16, 185, 129, var(--tw-divide-opacity)); |         |
| divide-green-600 > * + *   | --tw-divide-opacity: 1; border-color: rgba(5, 150, 105, var(--tw-divide-opacity)); |         |
| divide-green-700 > * + *   | --tw-divide-opacity: 1; border-color: rgba(4, 120, 87, var(--tw-divide-opacity)); |         |
| divide-green-800 > * + *   | --tw-divide-opacity: 1; border-color: rgba(6, 95, 70, var(--tw-divide-opacity)); |         |
| divide-green-900 > * + *   | --tw-divide-opacity: 1; border-color: rgba(6, 78, 59, var(--tw-divide-opacity)); |         |
| divide-blue-50 > * + *     | --tw-divide-opacity: 1; border-color: rgba(239, 246, 255, var(--tw-divide-opacity)); |         |
| divide-blue-100 > * + *    | --tw-divide-opacity: 1; border-color: rgba(219, 234, 254, var(--tw-divide-opacity)); |         |
| divide-blue-200 > * + *    | --tw-divide-opacity: 1; border-color: rgba(191, 219, 254, var(--tw-divide-opacity)); |         |
| divide-blue-300 > * + *    | --tw-divide-opacity: 1; border-color: rgba(147, 197, 253, var(--tw-divide-opacity)); |         |
| divide-blue-400 > * + *    | --tw-divide-opacity: 1; border-color: rgba(96, 165, 250, var(--tw-divide-opacity)); |         |
| divide-blue-500 > * + *    | --tw-divide-opacity: 1; border-color: rgba(59, 130, 246, var(--tw-divide-opacity)); |         |
| divide-blue-600 > * + *    | --tw-divide-opacity: 1; border-color: rgba(37, 99, 235, var(--tw-divide-opacity)); |         |
| divide-blue-700 > * + *    | --tw-divide-opacity: 1; border-color: rgba(29, 78, 216, var(--tw-divide-opacity)); |         |
| divide-blue-800 > * + *    | --tw-divide-opacity: 1; border-color: rgba(30, 64, 175, var(--tw-divide-opacity)); |         |
| divide-blue-900 > * + *    | --tw-divide-opacity: 1; border-color: rgba(30, 58, 138, var(--tw-divide-opacity)); |         |
| divide-indigo-50 > * + *   | --tw-divide-opacity: 1; border-color: rgba(238, 242, 255, var(--tw-divide-opacity)); |         |
| divide-indigo-100 > * + *  | --tw-divide-opacity: 1; border-color: rgba(224, 231, 255, var(--tw-divide-opacity)); |         |
| divide-indigo-200 > * + *  | --tw-divide-opacity: 1; border-color: rgba(199, 210, 254, var(--tw-divide-opacity)); |         |
| divide-indigo-300 > * + *  | --tw-divide-opacity: 1; border-color: rgba(165, 180, 252, var(--tw-divide-opacity)); |         |
| divide-indigo-400 > * + *  | --tw-divide-opacity: 1; border-color: rgba(129, 140, 248, var(--tw-divide-opacity)); |         |
| divide-indigo-500 > * + *  | --tw-divide-opacity: 1; border-color: rgba(99, 102, 241, var(--tw-divide-opacity)); |         |
| divide-indigo-600 > * + *  | --tw-divide-opacity: 1; border-color: rgba(79, 70, 229, var(--tw-divide-opacity)); |         |
| divide-indigo-700 > * + *  | --tw-divide-opacity: 1; border-color: rgba(67, 56, 202, var(--tw-divide-opacity)); |         |
| divide-indigo-800 > * + *  | --tw-divide-opacity: 1; border-color: rgba(55, 48, 163, var(--tw-divide-opacity)); |         |
| divide-indigo-900 > * + *  | --tw-divide-opacity: 1; border-color: rgba(49, 46, 129, var(--tw-divide-opacity)); |         |
| divide-purple-50 > * + *   | --tw-divide-opacity: 1; border-color: rgba(245, 243, 255, var(--tw-divide-opacity)); |         |
| divide-purple-100 > * + *  | --tw-divide-opacity: 1; border-color: rgba(237, 233, 254, var(--tw-divide-opacity)); |         |
| divide-purple-200 > * + *  | --tw-divide-opacity: 1; border-color: rgba(221, 214, 254, var(--tw-divide-opacity)); |         |
| divide-purple-300 > * + *  | --tw-divide-opacity: 1; border-color: rgba(196, 181, 253, var(--tw-divide-opacity)); |         |
| divide-purple-400 > * + *  | --tw-divide-opacity: 1; border-color: rgba(167, 139, 250, var(--tw-divide-opacity)); |         |
| divide-purple-500 > * + *  | --tw-divide-opacity: 1; border-color: rgba(139, 92, 246, var(--tw-divide-opacity)); |         |
| divide-purple-600 > * + *  | --tw-divide-opacity: 1; border-color: rgba(124, 58, 237, var(--tw-divide-opacity)); |         |
| divide-purple-700 > * + *  | --tw-divide-opacity: 1; border-color: rgba(109, 40, 217, var(--tw-divide-opacity)); |         |
| divide-purple-800 > * + *  | --tw-divide-opacity: 1; border-color: rgba(91, 33, 182, var(--tw-divide-opacity)); |         |
| divide-purple-900 > * + *  | --tw-divide-opacity: 1; border-color: rgba(76, 29, 149, var(--tw-divide-opacity)); |         |
| divide-pink-50 > * + *     | --tw-divide-opacity: 1; border-color: rgba(253, 242, 248, var(--tw-divide-opacity)); |         |
| divide-pink-100 > * + *    | --tw-divide-opacity: 1; border-color: rgba(252, 231, 243, var(--tw-divide-opacity)); |         |
| divide-pink-200 > * + *    | --tw-divide-opacity: 1; border-color: rgba(251, 207, 232, var(--tw-divide-opacity)); |         |
| divide-pink-300 > * + *    | --tw-divide-opacity: 1; border-color: rgba(249, 168, 212, var(--tw-divide-opacity)); |         |
| divide-pink-400 > * + *    | --tw-divide-opacity: 1; border-color: rgba(244, 114, 182, var(--tw-divide-opacity)); |         |
| divide-pink-500 > * + *    | --tw-divide-opacity: 1; border-color: rgba(236, 72, 153, var(--tw-divide-opacity)); |         |
| divide-pink-600 > * + *    | --tw-divide-opacity: 1; border-color: rgba(219, 39, 119, var(--tw-divide-opacity)); |         |
| divide-pink-700 > * + *    | --tw-divide-opacity: 1; border-color: rgba(190, 24, 93, var(--tw-divide-opacity)); |         |
| divide-pink-800 > * + *    | --tw-divide-opacity: 1; border-color: rgba(157, 23, 77, var(--tw-divide-opacity)); |         |
| divide-pink-900 > * + *    | --tw-divide-opacity: 1; border-color: rgba(131, 24, 67, var(--tw-divide-opacity)); |         |

## Usage

Control the border color between elements using the `divide-{color}` utilities.

1

2

3

```html
<div class="divide-y divide-fuchsia-300">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

### Changing opacity

Control the opacity of borders between elements using the `divide-opacity-{amount}` utilities.

1

2

3

```html
<div class="divide-y-4 divide-black divide-opacity-25">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

Learn more in the [divide opacity documentation](https://tailwindcss.com/docs/divide-opacity).

------

## Responsive

To control the borders between elements at a specific breakpoint, add a `{screen}:` prefix to any existing divide utility. For example, adding the class `md:divide-x-8` to an element would apply the `divide-x-8` utility at medium screen sizes and above.

```html
<div class="divide-y divide-teal-400 md:divide-pink-400">
  <div class="py-2">1</div>
  <div class="py-2">2</div>
  <div class="py-2">3</div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

### Border Colors

By default, Tailwind makes the entire [default color palette](https://tailwindcss.com/docs/customizing-colors#default-color-palette) available as divide colors.

You can [customize your color palette](https://tailwindcss.com/docs/colors#customizing) by editing the `theme.colors` section of your `tailwind.config.js` file, customize just your border and divide colors together using the `theme.borderColor` section, or customize only the divide colors using the `theme.divideColor` section.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      divideColor: theme => ({
-       ...theme('borderColors'),
+       'primary': '#3490dc',
+       'secondary': '#ffed4a',
+       'danger': '#e3342f',
      })
    }
  }
```

### Variants

By default, only responsive and dark mode *(if enabled)* variants are generated for divide color utilities.

You can control which variants are generated for the divide color utilities by modifying the `divideColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       divideColor: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the divide color utilities in your project, you can disable them entirely by setting the `divideColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     divideColor: false,
    }
  }
```

[←Divide Width](https://tailwindcss.com/docs/divide-width)[Divide Opacity
  ](https://tailwindcss.com/docs/divide-opacity)



---



# Divide Opacity

Utilities for controlling the opacity borders between elements.

## Default class reference

| Class              | Properties                 |
| ------------------ | -------------------------- |
| divide-opacity-0   | --tw-divide-opacity: 0;    |
| divide-opacity-5   | --tw-divide-opacity: 0.05; |
| divide-opacity-10  | --tw-divide-opacity: 0.1;  |
| divide-opacity-20  | --tw-divide-opacity: 0.2;  |
| divide-opacity-25  | --tw-divide-opacity: 0.25; |
| divide-opacity-30  | --tw-divide-opacity: 0.3;  |
| divide-opacity-40  | --tw-divide-opacity: 0.4;  |
| divide-opacity-50  | --tw-divide-opacity: 0.5;  |
| divide-opacity-60  | --tw-divide-opacity: 0.6;  |
| divide-opacity-70  | --tw-divide-opacity: 0.7;  |
| divide-opacity-75  | --tw-divide-opacity: 0.75; |
| divide-opacity-80  | --tw-divide-opacity: 0.8;  |
| divide-opacity-90  | --tw-divide-opacity: 0.9;  |
| divide-opacity-95  | --tw-divide-opacity: 0.95; |
| divide-opacity-100 | --tw-divide-opacity: 1;    |

## Usage

Control the opacity of borders between elements using the `divide-opacity-{amount}` utilities.

1

2

3

```html
<div class="divide-y-4 divide-black divide-opacity-25">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To control the opacity of borders between elements at a specific breakpoint, add a `{screen}:` prefix to any existing divide opacity utility. For example, use `md:divide-opacity-50` to apply the `divide-opacity-50` utility at only medium screen sizes and above.

```html
<div class="divide-y-2 divide-blue-500 divide-opacity-75 md:divide-opacity-50">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

To customize the opacity values for all opacity-related utilities at once, use the `opacity` section of your `tailwind.config.js` theme configuration:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        opacity: {
+         '10': '0.1',
+         '20': '0.2',
+         '95': '0.95',
        }
      }
    }
  }
```

If you want to customize only the divide opacity utilities, use the `divideOpacity` section:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        divideOpacity: {
+         '10': '0.1',
+         '20': '0.2',
+         '95': '0.95',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive and dark mode *(if enabled)* variants are generated for divide opacity utilities.

You can control which variants are generated for the divide opacity utilities by modifying the `divideOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       divideOpacity: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the divide opacity utilities in your project, you can disable them entirely by setting the `divideOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     divideOpacity: false,
    }
  }
```

[←Divide Color](https://tailwindcss.com/docs/divide-color)[Divide Style
  ](https://tailwindcss.com/docs/divide-style)



---



# Divide Style

Utilities for controlling the border style between elements.

## Default class reference

| Class                 | Properties            |
| --------------------- | --------------------- |
| divide-solid > * + *  | border-style: solid;  |
| divide-dashed > * + * | border-style: dashed; |
| divide-dotted > * + * | border-style: dotted; |
| divide-double > * + * | border-style: double; |
| divide-none > * + *   | border-style: none;   |

## Usage

Control the border style between elements using the `divide-{style}` utilities.

1

2

3

```html
<div class="divide-y-4 divide-yellow-600 divide-dashed">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To control the border style between elements at a specific breakpoint, add a `{screen}:` prefix to any existing divide style utility. For example, use `md:divide-dashed` to apply the `divide-dashed` utility at only medium screen sizes and above.

```html
<div class="divide-y-2 divide-dashed md:divide-solid">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for divide style utilities.

You can control which variants are generated for the divide style utilities by modifying the `divideStyle` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       divideStyle: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the divide style utilities in your project, you can disable them entirely by setting the `divideStyle` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     divideStyle: false,
    }
  }
```

[←Divide Opacity](https://tailwindcss.com/docs/divide-opacity)[Ring Width
  ](https://tailwindcss.com/docs/ring-width)



---



# Ring Width

Utilities for creating outline rings with box-shadows.

## Default class reference

| Class      | Properties                                                   |
| ---------- | ------------------------------------------------------------ |
| *          | box-shadow: 0 0 #0000;                                       |
| ring-0     | box-shadow: var(--tw-ring-inset) 0 0 0 calc(0px + var(--tw-ring-offset-width)) var(--tw-ring-color); |
| ring-1     | box-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width)) var(--tw-ring-color); |
| ring-2     | box-shadow: var(--tw-ring-inset) 0 0 0 calc(2px + var(--tw-ring-offset-width)) var(--tw-ring-color); |
| ring-4     | box-shadow: var(--tw-ring-inset) 0 0 0 calc(4px + var(--tw-ring-offset-width)) var(--tw-ring-color); |
| ring-8     | box-shadow: var(--tw-ring-inset) 0 0 0 calc(8px + var(--tw-ring-offset-width)) var(--tw-ring-color); |
| ring       | box-shadow: var(--tw-ring-inset) 0 0 0 calc(3px + var(--tw-ring-offset-width)) var(--tw-ring-color); |
| ring-inset | --tw-ring-inset: inset;                                      |

## Usage

Use the `ring-{width}` utilities to apply solid box-shadow of a specific thickness to an element. Rings are a semi-transparent blue color by default, similar to the default focus ring style in many systems.

ring-0ring-2ringring-4

```html
<button class="... ring-0">ring-0</button>
<button class="... ring-2">ring-2</button>
<button class="... ring">ring</button>
<button class="... ring-4">ring-4</button>
```

Ring utilities compose gracefully with regular `shadow-{size}` utilities and can be combined on the same element.

You can also control the color, opacity, and offset of rings using the [ringColor](https://tailwindcss.com/docs/ring-color), [ringOpacity](https://tailwindcss.com/docs/ring-opacity), and [ringOffsetWidth](https://tailwindcss.com/docs/ring-offset-width) utilities.

### Focus rings

The `focus` variant is enabled for `ring-{width}` utilities by default, which makes it easy to use them for custom focus styles by adding `focus:` to the beginning of any `ring-{width}` utility.

UnfocusedFocused

```html
<button class="... focus:outline-none focus:ring-4 focus:ring-green-500 focus:ring-opacity-50">
  Button
</button>
```

The `focus` variant is enabled by default for the [ringColor](https://tailwindcss.com/docs/ring-color), [ringOpacity](https://tailwindcss.com/docs/ring-opacity), [ringOffsetWidth](https://tailwindcss.com/docs/ring-offset-width), and [ringOffsetColor](https://tailwindcss.com/docs/ring-offset-color) utilities as well.

### Inset rings

Use the `ring-inset` utility to force a ring to render on the inside of an element instead of the outside. This can be useful for elements at the edge of the screen where part of the ring wouldn’t be visible.

DefaultInset

```html
<button class="... ring-4 ring-pink-300">
  Default
</button>

<button class="... ring-4 ring-pink-300 ring-inset">
  Inset
</button>
```

------

## Responsive

To control the ring width at a specific breakpoint, add a `{screen}:` prefix to any existing ring width utility. For example, use `md:ring-4` to apply the `ring-4` utility at only medium screen sizes and above.

```html
<button class="ring-2 md:ring-4">
  <!-- ... -->
</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

To customize which ring width utilities are generated, add your custom values under `ringWidth` key in the `theme` section of your `tailwind.config.js` file. You can use the `DEFAULT` key to specify which width is used for the plain `ring` utility.

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      ringWidth: {
        'DEFAULT': '2px',
        '6': '6px',
        '10': '10px',
      }
    }
  }
}
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, focus-within and focus variants are generated for ring width utilities.

You can control which variants are generated for the ring width utilities by modifying the `ringWidth` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       ringWidth: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the ring width utilities in your project, you can disable them entirely by setting the `ringWidth` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     ringWidth: false,
    }
  }
```

[←Divide Style](https://tailwindcss.com/docs/divide-style)[Ring Color
  ](https://tailwindcss.com/docs/ring-color)



---



# Ring Color

Utilities for setting the color of outline rings.

## Default class reference

| Class            | Properties                                                   |
| ---------------- | ------------------------------------------------------------ |
| ring-transparent | --tw-ring-color: transparent;                                |
| ring-current     | --tw-ring-color: currentColor;                               |
| ring-black       | --tw-ring-color: rgba(0, 0, 0, var(--tw-ring-opacity));      |
| ring-white       | --tw-ring-color: rgba(255, 255, 255, var(--tw-ring-opacity)); |
| ring-gray-50     | --tw-ring-color: rgba(249, 250, 251, var(--tw-ring-opacity)); |
| ring-gray-100    | --tw-ring-color: rgba(243, 244, 246, var(--tw-ring-opacity)); |
| ring-gray-200    | --tw-ring-color: rgba(229, 231, 235, var(--tw-ring-opacity)); |
| ring-gray-300    | --tw-ring-color: rgba(209, 213, 219, var(--tw-ring-opacity)); |
| ring-gray-400    | --tw-ring-color: rgba(156, 163, 175, var(--tw-ring-opacity)); |
| ring-gray-500    | --tw-ring-color: rgba(107, 114, 128, var(--tw-ring-opacity)); |
| ring-gray-600    | --tw-ring-color: rgba(75, 85, 99, var(--tw-ring-opacity));   |
| ring-gray-700    | --tw-ring-color: rgba(55, 65, 81, var(--tw-ring-opacity));   |
| ring-gray-800    | --tw-ring-color: rgba(31, 41, 55, var(--tw-ring-opacity));   |
| ring-gray-900    | --tw-ring-color: rgba(17, 24, 39, var(--tw-ring-opacity));   |
| ring-red-50      | --tw-ring-color: rgba(254, 242, 242, var(--tw-ring-opacity)); |
| ring-red-100     | --tw-ring-color: rgba(254, 226, 226, var(--tw-ring-opacity)); |
| ring-red-200     | --tw-ring-color: rgba(254, 202, 202, var(--tw-ring-opacity)); |
| ring-red-300     | --tw-ring-color: rgba(252, 165, 165, var(--tw-ring-opacity)); |
| ring-red-400     | --tw-ring-color: rgba(248, 113, 113, var(--tw-ring-opacity)); |
| ring-red-500     | --tw-ring-color: rgba(239, 68, 68, var(--tw-ring-opacity));  |
| ring-red-600     | --tw-ring-color: rgba(220, 38, 38, var(--tw-ring-opacity));  |
| ring-red-700     | --tw-ring-color: rgba(185, 28, 28, var(--tw-ring-opacity));  |
| ring-red-800     | --tw-ring-color: rgba(153, 27, 27, var(--tw-ring-opacity));  |
| ring-red-900     | --tw-ring-color: rgba(127, 29, 29, var(--tw-ring-opacity));  |
| ring-yellow-50   | --tw-ring-color: rgba(255, 251, 235, var(--tw-ring-opacity)); |
| ring-yellow-100  | --tw-ring-color: rgba(254, 243, 199, var(--tw-ring-opacity)); |
| ring-yellow-200  | --tw-ring-color: rgba(253, 230, 138, var(--tw-ring-opacity)); |
| ring-yellow-300  | --tw-ring-color: rgba(252, 211, 77, var(--tw-ring-opacity)); |
| ring-yellow-400  | --tw-ring-color: rgba(251, 191, 36, var(--tw-ring-opacity)); |
| ring-yellow-500  | --tw-ring-color: rgba(245, 158, 11, var(--tw-ring-opacity)); |
| ring-yellow-600  | --tw-ring-color: rgba(217, 119, 6, var(--tw-ring-opacity));  |
| ring-yellow-700  | --tw-ring-color: rgba(180, 83, 9, var(--tw-ring-opacity));   |
| ring-yellow-800  | --tw-ring-color: rgba(146, 64, 14, var(--tw-ring-opacity));  |
| ring-yellow-900  | --tw-ring-color: rgba(120, 53, 15, var(--tw-ring-opacity));  |
| ring-green-50    | --tw-ring-color: rgba(236, 253, 245, var(--tw-ring-opacity)); |
| ring-green-100   | --tw-ring-color: rgba(209, 250, 229, var(--tw-ring-opacity)); |
| ring-green-200   | --tw-ring-color: rgba(167, 243, 208, var(--tw-ring-opacity)); |
| ring-green-300   | --tw-ring-color: rgba(110, 231, 183, var(--tw-ring-opacity)); |
| ring-green-400   | --tw-ring-color: rgba(52, 211, 153, var(--tw-ring-opacity)); |
| ring-green-500   | --tw-ring-color: rgba(16, 185, 129, var(--tw-ring-opacity)); |
| ring-green-600   | --tw-ring-color: rgba(5, 150, 105, var(--tw-ring-opacity));  |
| ring-green-700   | --tw-ring-color: rgba(4, 120, 87, var(--tw-ring-opacity));   |
| ring-green-800   | --tw-ring-color: rgba(6, 95, 70, var(--tw-ring-opacity));    |
| ring-green-900   | --tw-ring-color: rgba(6, 78, 59, var(--tw-ring-opacity));    |
| ring-blue-50     | --tw-ring-color: rgba(239, 246, 255, var(--tw-ring-opacity)); |
| ring-blue-100    | --tw-ring-color: rgba(219, 234, 254, var(--tw-ring-opacity)); |
| ring-blue-200    | --tw-ring-color: rgba(191, 219, 254, var(--tw-ring-opacity)); |
| ring-blue-300    | --tw-ring-color: rgba(147, 197, 253, var(--tw-ring-opacity)); |
| ring-blue-400    | --tw-ring-color: rgba(96, 165, 250, var(--tw-ring-opacity)); |
| ring-blue-500    | --tw-ring-color: rgba(59, 130, 246, var(--tw-ring-opacity)); |
| ring-blue-600    | --tw-ring-color: rgba(37, 99, 235, var(--tw-ring-opacity));  |
| ring-blue-700    | --tw-ring-color: rgba(29, 78, 216, var(--tw-ring-opacity));  |
| ring-blue-800    | --tw-ring-color: rgba(30, 64, 175, var(--tw-ring-opacity));  |
| ring-blue-900    | --tw-ring-color: rgba(30, 58, 138, var(--tw-ring-opacity));  |
| ring-indigo-50   | --tw-ring-color: rgba(238, 242, 255, var(--tw-ring-opacity)); |
| ring-indigo-100  | --tw-ring-color: rgba(224, 231, 255, var(--tw-ring-opacity)); |
| ring-indigo-200  | --tw-ring-color: rgba(199, 210, 254, var(--tw-ring-opacity)); |
| ring-indigo-300  | --tw-ring-color: rgba(165, 180, 252, var(--tw-ring-opacity)); |
| ring-indigo-400  | --tw-ring-color: rgba(129, 140, 248, var(--tw-ring-opacity)); |
| ring-indigo-500  | --tw-ring-color: rgba(99, 102, 241, var(--tw-ring-opacity)); |
| ring-indigo-600  | --tw-ring-color: rgba(79, 70, 229, var(--tw-ring-opacity));  |
| ring-indigo-700  | --tw-ring-color: rgba(67, 56, 202, var(--tw-ring-opacity));  |
| ring-indigo-800  | --tw-ring-color: rgba(55, 48, 163, var(--tw-ring-opacity));  |
| ring-indigo-900  | --tw-ring-color: rgba(49, 46, 129, var(--tw-ring-opacity));  |
| ring-purple-50   | --tw-ring-color: rgba(245, 243, 255, var(--tw-ring-opacity)); |
| ring-purple-100  | --tw-ring-color: rgba(237, 233, 254, var(--tw-ring-opacity)); |
| ring-purple-200  | --tw-ring-color: rgba(221, 214, 254, var(--tw-ring-opacity)); |
| ring-purple-300  | --tw-ring-color: rgba(196, 181, 253, var(--tw-ring-opacity)); |
| ring-purple-400  | --tw-ring-color: rgba(167, 139, 250, var(--tw-ring-opacity)); |
| ring-purple-500  | --tw-ring-color: rgba(139, 92, 246, var(--tw-ring-opacity)); |
| ring-purple-600  | --tw-ring-color: rgba(124, 58, 237, var(--tw-ring-opacity)); |
| ring-purple-700  | --tw-ring-color: rgba(109, 40, 217, var(--tw-ring-opacity)); |
| ring-purple-800  | --tw-ring-color: rgba(91, 33, 182, var(--tw-ring-opacity));  |
| ring-purple-900  | --tw-ring-color: rgba(76, 29, 149, var(--tw-ring-opacity));  |
| ring-pink-50     | --tw-ring-color: rgba(253, 242, 248, var(--tw-ring-opacity)); |
| ring-pink-100    | --tw-ring-color: rgba(252, 231, 243, var(--tw-ring-opacity)); |
| ring-pink-200    | --tw-ring-color: rgba(251, 207, 232, var(--tw-ring-opacity)); |
| ring-pink-300    | --tw-ring-color: rgba(249, 168, 212, var(--tw-ring-opacity)); |
| ring-pink-400    | --tw-ring-color: rgba(244, 114, 182, var(--tw-ring-opacity)); |
| ring-pink-500    | --tw-ring-color: rgba(236, 72, 153, var(--tw-ring-opacity)); |
| ring-pink-600    | --tw-ring-color: rgba(219, 39, 119, var(--tw-ring-opacity)); |
| ring-pink-700    | --tw-ring-color: rgba(190, 24, 93, var(--tw-ring-opacity));  |
| ring-pink-800    | --tw-ring-color: rgba(157, 23, 77, var(--tw-ring-opacity));  |
| ring-pink-900    | --tw-ring-color: rgba(131, 24, 67, var(--tw-ring-opacity));  |

## Usage

Use the `ring-{color}` utilities to set the color of an [outline ring](https://tailwindcss.com/docs/ring-width).

Button

```html
<button class="... ring-4 ring-indigo-300">
  Button
</button>
```

### Changing opacity

You can control the opacity of rings using the `ring-opacity-{amount}` utilities:

Button

```html
<button class="... ring-4 ring-yellow-500 ring-opacity-50">
  Button
</button>
```

For more information, see the [ringOpacity documentation](https://tailwindcss.com/docs/ring-opacity).

------

## Responsive

To control the ring color at a specific breakpoint, add a `{screen}:` prefix to any existing ring color utility. For example, use `md:ring-blue-500` to apply the `ring-blue-500` utility at only medium screen sizes and above.

```html
<button class="ring-2 ring-blue-300 md:ring-blue-500">
  <!-- ... -->
</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

You can customize which ring color utilities are generated by customizing your color palette using the `colors` key in the `theme` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      gray: colors.blueGray,
      indigo: colors.indigo,
      red: colors.rose,
      yellow: colors.yellow,
    }
  }
}
```

If you’d like to customize only the ring color utilities without affecting your global color palette, use the `ringColor` key instead:

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    ringColor: {
      white: colors.white,
      pink: colors.fuchsia,
    }
  }
}
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, dark mode *(if enabled)*, focus-within and focus variants are generated for ring color utilities.

You can control which variants are generated for the ring color utilities by modifying the `ringColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       ringColor: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the ring color utilities in your project, you can disable them entirely by setting the `ringColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     ringColor: false,
    }
  }
```

[←Ring Width](https://tailwindcss.com/docs/ring-width)[Ring Opacity
  ](https:

[

---



# Ring Opacity

Utilities for setting the opacity of outline rings.

## Default class reference

| Class            | Properties               |
| ---------------- | ------------------------ |
| ring-opacity-0   | --tw-ring-opacity: 0;    |
| ring-opacity-5   | --tw-ring-opacity: 0.05; |
| ring-opacity-10  | --tw-ring-opacity: 0.1;  |
| ring-opacity-20  | --tw-ring-opacity: 0.2;  |
| ring-opacity-25  | --tw-ring-opacity: 0.25; |
| ring-opacity-30  | --tw-ring-opacity: 0.3;  |
| ring-opacity-40  | --tw-ring-opacity: 0.4;  |
| ring-opacity-50  | --tw-ring-opacity: 0.5;  |
| ring-opacity-60  | --tw-ring-opacity: 0.6;  |
| ring-opacity-70  | --tw-ring-opacity: 0.7;  |
| ring-opacity-75  | --tw-ring-opacity: 0.75; |
| ring-opacity-80  | --tw-ring-opacity: 0.8;  |
| ring-opacity-90  | --tw-ring-opacity: 0.9;  |
| ring-opacity-95  | --tw-ring-opacity: 0.95; |
| ring-opacity-100 | --tw-ring-opacity: 1;    |

## Usage

Use the `ring-opacity-{amount}` utilities to set the opacity of an [outline ring](https://tailwindcss.com/docs/ring-width).

Button

```html
<button class="... ring-4 ring-red-500 ring-opacity-50">
  Button
</button>
```

------

## Responsive

To control the ring opacity at a specific breakpoint, add a `{screen}:` prefix to any existing ring opacity utility. For example, use `md:ring-opacity-50` to apply the `ring-opacity-50` utility at only medium screen sizes and above.

```html
<button class="ring-2 ring-blue-500 ring-opacity-75 md:ring-opacity-50">
  <!-- ... -->
</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

You can customize which ring opacity utilities are generated by customizing your global opacity scale under the `opacity` key in the `theme` section of your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        opacity: {
+         '15': '0.15',
+         '35': '0.35',
+         '65': '0.65',
        }
      }
    }
  }
```

If you’d like to customize only the ring opacity utilities without affecting your global opacity scale, use the `ringOpacity` key instead:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        ringOpacity: {
+         '15': '0.15',
+         '35': '0.35',
+         '65': '0.65',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, dark mode *(if enabled)*, focus-within and focus variants are generated for ring opacity utilities.

You can control which variants are generated for the ring opacity utilities by modifying the `ringOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       ringOpacity: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the ring opacity utilities in your project, you can disable them entirely by setting the `ringOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     ringOpacity: false,
    }
  }
```

[←Ring Color](https://tailwindcss.com/docs/ring-color)[Ring Offset Width
  ](https://tailwindcss.com/docs/ring-offset-width)



---



# Ring Offset Width

Utilities for simulating an offset when adding outline rings.

## Default class reference

| Class         | Properties                                                   |
| ------------- | ------------------------------------------------------------ |
| ring-offset-0 | --tw-ring-offset-width: 0px; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-1 | --tw-ring-offset-width: 1px; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-2 | --tw-ring-offset-width: 2px; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-4 | --tw-ring-offset-width: 4px; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-8 | --tw-ring-offset-width: 8px; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |

## Usage

Use the `ring-offset-{width}` utilities to simulate an offset by adding solid white box-shadow and increasing the thickness of the accompanying outline ring to accommodate the offset.

ring-offset-0ring-offset-2ring-offset-4

```html
<button class="... ring ring-pink-600 ring-offset-0">ring-0</button>
<button class="... ring ring-pink-600 ring-offset-2">ring-2</button>
<button class="... ring ring-pink-600 ring-offset-4">ring-4</button>
```

### Changing the offset color

You can’t actually offset a box-shadow in CSS, so we have to fake it using a solid color shadow that matches the parent background color. We use white by default, but if you are adding a ring offset over a different background color, you should use the `ring-offset-{color}` utilities to match the parent background color:

bg-green-100

ring-offset-green-100

```html
<div class="... bg-green-100">
  <button class="... ring ring-green-600 ring-offset-4 ring-offset-green-100">
    ring-offset-green-100
  </button>
</div>
```

For more information, see the [ringOffsetColor documentation](https://tailwindcss.com/docs/ring-offset-color).

------

## Responsive

To control the ring offset width at a specific breakpoint, add a `{screen}:` prefix to any existing ring offset width utility. For example, use `md:ring-offset-4` to apply the `ring-offset-4` utility at only medium screen sizes and above.

```html
<button class="ring-2 ring-offset-2 md:ring-offset-4">
  <!-- ... -->
</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

To customize which ring offset width utilities are generated, add your custom values under `ringOffsetWidth` key in the `theme` section of your `tailwind.config.js` file.

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      ringOffsetWidth: {
        '3': '3px',
        '6': '6px',
        '10': '10px',
      }
    }
  }
}
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, focus-within and focus variants are generated for ring offset width utilities.

You can control which variants are generated for the ring offset width utilities by modifying the `ringOffsetWidth` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       ringOffsetWidth: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the ring offset width utilities in your project, you can disable them entirely by setting the `ringOffsetWidth` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     ringOffsetWidth: false,
    }
  }
```

[←Ring Opacity](https://tailwindcss.com/docs/ring-opacity)[Ring Offset Color
  ](https://tailwindcss.com/docs/ring-offset-color)



---



# Ring Offset Color

Utilities for setting the color of outline ring offsets.

## Default class reference

| Class                   | Properties                                                   |
| ----------------------- | ------------------------------------------------------------ |
| ring-offset-transparent | --tw-ring-offset-color: transparent; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-current     | --tw-ring-offset-color: currentColor; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-black       | --tw-ring-offset-color: #000; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-white       | --tw-ring-offset-color: #fff; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-50     | --tw-ring-offset-color: #f9fafb; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-100    | --tw-ring-offset-color: #f3f4f6; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-200    | --tw-ring-offset-color: #e5e7eb; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-300    | --tw-ring-offset-color: #d1d5db; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-400    | --tw-ring-offset-color: #9ca3af; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-500    | --tw-ring-offset-color: #6b7280; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-600    | --tw-ring-offset-color: #4b5563; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-700    | --tw-ring-offset-color: #374151; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-800    | --tw-ring-offset-color: #1f2937; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-gray-900    | --tw-ring-offset-color: #111827; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-50      | --tw-ring-offset-color: #fef2f2; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-100     | --tw-ring-offset-color: #fee2e2; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-200     | --tw-ring-offset-color: #fecaca; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-300     | --tw-ring-offset-color: #fca5a5; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-400     | --tw-ring-offset-color: #f87171; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-500     | --tw-ring-offset-color: #ef4444; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-600     | --tw-ring-offset-color: #dc2626; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-700     | --tw-ring-offset-color: #b91c1c; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-800     | --tw-ring-offset-color: #991b1b; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-red-900     | --tw-ring-offset-color: #7f1d1d; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-50   | --tw-ring-offset-color: #fffbeb; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-100  | --tw-ring-offset-color: #fef3c7; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-200  | --tw-ring-offset-color: #fde68a; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-300  | --tw-ring-offset-color: #fcd34d; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-400  | --tw-ring-offset-color: #fbbf24; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-500  | --tw-ring-offset-color: #f59e0b; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-600  | --tw-ring-offset-color: #d97706; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-700  | --tw-ring-offset-color: #b45309; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-800  | --tw-ring-offset-color: #92400e; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-yellow-900  | --tw-ring-offset-color: #78350f; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-50    | --tw-ring-offset-color: #ecfdf5; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-100   | --tw-ring-offset-color: #d1fae5; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-200   | --tw-ring-offset-color: #a7f3d0; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-300   | --tw-ring-offset-color: #6ee7b7; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-400   | --tw-ring-offset-color: #34d399; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-500   | --tw-ring-offset-color: #10b981; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-600   | --tw-ring-offset-color: #059669; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-700   | --tw-ring-offset-color: #047857; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-800   | --tw-ring-offset-color: #065f46; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-green-900   | --tw-ring-offset-color: #064e3b; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-50     | --tw-ring-offset-color: #eff6ff; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-100    | --tw-ring-offset-color: #dbeafe; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-200    | --tw-ring-offset-color: #bfdbfe; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-300    | --tw-ring-offset-color: #93c5fd; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-400    | --tw-ring-offset-color: #60a5fa; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-500    | --tw-ring-offset-color: #3b82f6; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-600    | --tw-ring-offset-color: #2563eb; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-700    | --tw-ring-offset-color: #1d4ed8; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-800    | --tw-ring-offset-color: #1e40af; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-blue-900    | --tw-ring-offset-color: #1e3a8a; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-50   | --tw-ring-offset-color: #eef2ff; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-100  | --tw-ring-offset-color: #e0e7ff; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-200  | --tw-ring-offset-color: #c7d2fe; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-300  | --tw-ring-offset-color: #a5b4fc; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-400  | --tw-ring-offset-color: #818cf8; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-500  | --tw-ring-offset-color: #6366f1; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-600  | --tw-ring-offset-color: #4f46e5; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-700  | --tw-ring-offset-color: #4338ca; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-800  | --tw-ring-offset-color: #3730a3; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-indigo-900  | --tw-ring-offset-color: #312e81; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-50   | --tw-ring-offset-color: #f5f3ff; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-100  | --tw-ring-offset-color: #ede9fe; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-200  | --tw-ring-offset-color: #ddd6fe; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-300  | --tw-ring-offset-color: #c4b5fd; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-400  | --tw-ring-offset-color: #a78bfa; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-500  | --tw-ring-offset-color: #8b5cf6; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-600  | --tw-ring-offset-color: #7c3aed; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-700  | --tw-ring-offset-color: #6d28d9; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-800  | --tw-ring-offset-color: #5b21b6; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-purple-900  | --tw-ring-offset-color: #4c1d95; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-50     | --tw-ring-offset-color: #fdf2f8; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-100    | --tw-ring-offset-color: #fce7f3; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-200    | --tw-ring-offset-color: #fbcfe8; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-300    | --tw-ring-offset-color: #f9a8d4; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-400    | --tw-ring-offset-color: #f472b6; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-500    | --tw-ring-offset-color: #ec4899; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-600    | --tw-ring-offset-color: #db2777; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-700    | --tw-ring-offset-color: #be185d; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-800    | --tw-ring-offset-color: #9d174d; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |
| ring-offset-pink-900    | --tw-ring-offset-color: #831843; box-shadow: 0 0 0 var(--tw-ring-offset-width) var(--tw-ring-offset-color), var(--tw-ring-shadow); |

## Usage

Use the `ring-offset-{color}` utilities to change the color of a ring offset. Usually this is done to try and match the offset to the parent background color, since true box-shadow offsets aren’t actually possible in CSS.

bg-purple-100

ring-offset-purple-100

```html
<div class="... bg-purple-100">
  <button class="... ring ring-purple-600 ring-offset-4 ring-offset-purple-100">
    ring-offset-purple-100
  </button>
</div>
```

------

## Responsive

To control the ring offset color at a specific breakpoint, add a `{screen}:` prefix to any existing ring offset color utility. For example, use `md:ring-offset-blue-500` to apply the `ring-offset-blue-500` utility at only medium screen sizes and above.

```html
<button class="ring-2 ring-offset-2 ring-offset-blue-300 md:ring-offset-blue-500">
  <!-- ... -->
</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

You can customize which ring offset color utilities are generated by customizing your color palette under the `colors` key in the `theme` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      gray: colors.blueGray,
      indigo: colors.indigo,
      red: colors.rose,
      yellow: colors.yellow,
    }
  }
}
```

If you’d like to customize only the ring offset color utilities without affecting your global color palette, use the `ringOffsetColor` key instead:

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    ringOffsetColor: {
      white: colors.white,
      pink: colors.fuchsia,
    }
  }
}
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive, dark mode *(if enabled)*, focus-within and focus variants are generated for ring offset color utilities.

You can control which variants are generated for the ring offset color utilities by modifying the `ringOffsetColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       ringOffsetColor: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the ring offset color utilities in your project, you can disable them entirely by setting the `ringOffsetColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     ringOffsetColor: false,
    }
  }
```

[←Ring Offset Width](https://tailwindcss.com/docs/ring-offset-width)[Box Shadow
  ](https://tailwindcss.com/docs/box-shadow)



