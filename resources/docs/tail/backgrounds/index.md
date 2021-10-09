---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---


# Background Attachment

Utilities for controlling how a background image behaves when scrolling.

## Default class reference

| Class     | Properties                     |
| --------- | ------------------------------ |
| bg-fixed  | background-attachment: fixed;  |
| bg-local  | background-attachment: local;  |
| bg-scroll | background-attachment: scroll; |

## Fixed

Use `bg-fixed` to fix the background image relative to the viewport.

```html
<div class="bg-fixed ..." style="background-image: url(...)"></div>
```

## Local

Use `bg-local` to scroll the background image with the container and the viewport.

```html
<div class="bg-local ..." style="background-image: url(...)"></div>
```

## Scroll

Use `bg-scroll` to scroll the background image with the viewport, but not with the container.

```html
<div class="bg-scroll ..." style="background-image: url(...)"></div>
```

## Responsive

To control the background attachment of an element at a specific breakpoint, add a `{screen}:` prefix to any existing background attachment utility. For example, use `md:bg-fixed` to apply the `bg-fixed` utility at only medium screen sizes and above.

```html
<div class="bg-local md:bg-fixed ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for background attachment utilities.

You can control which variants are generated for the background attachment utilities by modifying the `backgroundAttachment` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundAttachment: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background attachment utilities in your project, you can disable them entirely by setting the `backgroundAttachment` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundAttachment: false,
    }
  }
```

[←Word Break](https://tailwindcss.com/docs/word-break)[Background Clip
  ](https://tailwindcss.com/docs/background-clip)



---



# Background Clip

Utilities for controlling the bounding box of an element's background.

## Default class reference

| Class           | Properties                    |
| --------------- | ----------------------------- |
| bg-clip-border  | background-clip: border-box;  |
| bg-clip-padding | background-clip: padding-box; |
| bg-clip-content | background-clip: content-box; |
| bg-clip-text    | background-clip: text;        |

## Usage

Use the `bg-clip-{keyword}` utilities to control the bounding box of an element’s background.

.bg-clip-border

.bg-clip-padding

.bg-clip-content

```html
<div class="bg-clip-border p-6 bg-indigo-600 border-4 border-indigo-300 border-dashed"></div>
<div class="bg-clip-padding p-6 bg-indigo-600 border-4 border-indigo-300 border-dashed"></div>
<div class="bg-clip-content p-6 bg-indigo-600 border-4 border-indigo-300 border-dashed"></div>
```

## Cropping to text

Use `bg-clip-text` to crop an element’s background to match the shape of the text. Useful for effects where you want a background image to be visible through the text.

Hello world

```html
<div class="text-5xl font-extrabold ...">
  <span class="bg-clip-text text-transparent bg-gradient-to-r from-green-400 to-blue-500">
    Hello world
  </span>
</div>
```

## Responsive

To control the bounding box of an element’s background at a specific breakpoint, add a `{screen}:` prefix to any existing background clip utility. For example, adding the class `md:bg-clip-padding` to an element would apply the `bg-clip-padding` utility at medium screen sizes and above.

```html
<div class="bg-clip-border md:bg-clip-padding">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for background clip utilities.

You can control which variants are generated for the background clip utilities by modifying the `backgroundClip` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundClip: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background clip utilities in your project, you can disable them entirely by setting the `backgroundClip` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundClip: false,
    }
  }
```

[←Background Attachment](https://tailwindcss.com/docs/background-attachment)[Background Color
  ](https://tailwindcss.com/docs/background-color)



---



# Background Color

Utilities for controlling an element's background color.

## Default class reference

| Class          | Properties                                                   | Preview |
| -------------- | ------------------------------------------------------------ | ------- |
| bg-transparent | background-color: transparent;                               |         |
| bg-current     | background-color: currentColor;                              |         |
| bg-black       | --tw-bg-opacity: 1; background-color: rgba(0, 0, 0, var(--tw-bg-opacity)); |         |
| bg-white       | --tw-bg-opacity: 1; background-color: rgba(255, 255, 255, var(--tw-bg-opacity)); |         |
| bg-gray-50     | --tw-bg-opacity: 1; background-color: rgba(249, 250, 251, var(--tw-bg-opacity)); |         |
| bg-gray-100    | --tw-bg-opacity: 1; background-color: rgba(243, 244, 246, var(--tw-bg-opacity)); |         |
| bg-gray-200    | --tw-bg-opacity: 1; background-color: rgba(229, 231, 235, var(--tw-bg-opacity)); |         |
| bg-gray-300    | --tw-bg-opacity: 1; background-color: rgba(209, 213, 219, var(--tw-bg-opacity)); |         |
| bg-gray-400    | --tw-bg-opacity: 1; background-color: rgba(156, 163, 175, var(--tw-bg-opacity)); |         |
| bg-gray-500    | --tw-bg-opacity: 1; background-color: rgba(107, 114, 128, var(--tw-bg-opacity)); |         |
| bg-gray-600    | --tw-bg-opacity: 1; background-color: rgba(75, 85, 99, var(--tw-bg-opacity)); |         |
| bg-gray-700    | --tw-bg-opacity: 1; background-color: rgba(55, 65, 81, var(--tw-bg-opacity)); |         |
| bg-gray-800    | --tw-bg-opacity: 1; background-color: rgba(31, 41, 55, var(--tw-bg-opacity)); |         |
| bg-gray-900    | --tw-bg-opacity: 1; background-color: rgba(17, 24, 39, var(--tw-bg-opacity)); |         |
| bg-red-50      | --tw-bg-opacity: 1; background-color: rgba(254, 242, 242, var(--tw-bg-opacity)); |         |
| bg-red-100     | --tw-bg-opacity: 1; background-color: rgba(254, 226, 226, var(--tw-bg-opacity)); |         |
| bg-red-200     | --tw-bg-opacity: 1; background-color: rgba(254, 202, 202, var(--tw-bg-opacity)); |         |
| bg-red-300     | --tw-bg-opacity: 1; background-color: rgba(252, 165, 165, var(--tw-bg-opacity)); |         |
| bg-red-400     | --tw-bg-opacity: 1; background-color: rgba(248, 113, 113, var(--tw-bg-opacity)); |         |
| bg-red-500     | --tw-bg-opacity: 1; background-color: rgba(239, 68, 68, var(--tw-bg-opacity)); |         |
| bg-red-600     | --tw-bg-opacity: 1; background-color: rgba(220, 38, 38, var(--tw-bg-opacity)); |         |
| bg-red-700     | --tw-bg-opacity: 1; background-color: rgba(185, 28, 28, var(--tw-bg-opacity)); |         |
| bg-red-800     | --tw-bg-opacity: 1; background-color: rgba(153, 27, 27, var(--tw-bg-opacity)); |         |
| bg-red-900     | --tw-bg-opacity: 1; background-color: rgba(127, 29, 29, var(--tw-bg-opacity)); |         |
| bg-yellow-50   | --tw-bg-opacity: 1; background-color: rgba(255, 251, 235, var(--tw-bg-opacity)); |         |
| bg-yellow-100  | --tw-bg-opacity: 1; background-color: rgba(254, 243, 199, var(--tw-bg-opacity)); |         |
| bg-yellow-200  | --tw-bg-opacity: 1; background-color: rgba(253, 230, 138, var(--tw-bg-opacity)); |         |
| bg-yellow-300  | --tw-bg-opacity: 1; background-color: rgba(252, 211, 77, var(--tw-bg-opacity)); |         |
| bg-yellow-400  | --tw-bg-opacity: 1; background-color: rgba(251, 191, 36, var(--tw-bg-opacity)); |         |
| bg-yellow-500  | --tw-bg-opacity: 1; background-color: rgba(245, 158, 11, var(--tw-bg-opacity)); |         |
| bg-yellow-600  | --tw-bg-opacity: 1; background-color: rgba(217, 119, 6, var(--tw-bg-opacity)); |         |
| bg-yellow-700  | --tw-bg-opacity: 1; background-color: rgba(180, 83, 9, var(--tw-bg-opacity)); |         |
| bg-yellow-800  | --tw-bg-opacity: 1; background-color: rgba(146, 64, 14, var(--tw-bg-opacity)); |         |
| bg-yellow-900  | --tw-bg-opacity: 1; background-color: rgba(120, 53, 15, var(--tw-bg-opacity)); |         |
| bg-green-50    | --tw-bg-opacity: 1; background-color: rgba(236, 253, 245, var(--tw-bg-opacity)); |         |
| bg-green-100   | --tw-bg-opacity: 1; background-color: rgba(209, 250, 229, var(--tw-bg-opacity)); |         |
| bg-green-200   | --tw-bg-opacity: 1; background-color: rgba(167, 243, 208, var(--tw-bg-opacity)); |         |
| bg-green-300   | --tw-bg-opacity: 1; background-color: rgba(110, 231, 183, var(--tw-bg-opacity)); |         |
| bg-green-400   | --tw-bg-opacity: 1; background-color: rgba(52, 211, 153, var(--tw-bg-opacity)); |         |
| bg-green-500   | --tw-bg-opacity: 1; background-color: rgba(16, 185, 129, var(--tw-bg-opacity)); |         |
| bg-green-600   | --tw-bg-opacity: 1; background-color: rgba(5, 150, 105, var(--tw-bg-opacity)); |         |
| bg-green-700   | --tw-bg-opacity: 1; background-color: rgba(4, 120, 87, var(--tw-bg-opacity)); |         |
| bg-green-800   | --tw-bg-opacity: 1; background-color: rgba(6, 95, 70, var(--tw-bg-opacity)); |         |
| bg-green-900   | --tw-bg-opacity: 1; background-color: rgba(6, 78, 59, var(--tw-bg-opacity)); |         |
| bg-blue-50     | --tw-bg-opacity: 1; background-color: rgba(239, 246, 255, var(--tw-bg-opacity)); |         |
| bg-blue-100    | --tw-bg-opacity: 1; background-color: rgba(219, 234, 254, var(--tw-bg-opacity)); |         |
| bg-blue-200    | --tw-bg-opacity: 1; background-color: rgba(191, 219, 254, var(--tw-bg-opacity)); |         |
| bg-blue-300    | --tw-bg-opacity: 1; background-color: rgba(147, 197, 253, var(--tw-bg-opacity)); |         |
| bg-blue-400    | --tw-bg-opacity: 1; background-color: rgba(96, 165, 250, var(--tw-bg-opacity)); |         |
| bg-blue-500    | --tw-bg-opacity: 1; background-color: rgba(59, 130, 246, var(--tw-bg-opacity)); |         |
| bg-blue-600    | --tw-bg-opacity: 1; background-color: rgba(37, 99, 235, var(--tw-bg-opacity)); |         |
| bg-blue-700    | --tw-bg-opacity: 1; background-color: rgba(29, 78, 216, var(--tw-bg-opacity)); |         |
| bg-blue-800    | --tw-bg-opacity: 1; background-color: rgba(30, 64, 175, var(--tw-bg-opacity)); |         |
| bg-blue-900    | --tw-bg-opacity: 1; background-color: rgba(30, 58, 138, var(--tw-bg-opacity)); |         |
| bg-indigo-50   | --tw-bg-opacity: 1; background-color: rgba(238, 242, 255, var(--tw-bg-opacity)); |         |
| bg-indigo-100  | --tw-bg-opacity: 1; background-color: rgba(224, 231, 255, var(--tw-bg-opacity)); |         |
| bg-indigo-200  | --tw-bg-opacity: 1; background-color: rgba(199, 210, 254, var(--tw-bg-opacity)); |         |
| bg-indigo-300  | --tw-bg-opacity: 1; background-color: rgba(165, 180, 252, var(--tw-bg-opacity)); |         |
| bg-indigo-400  | --tw-bg-opacity: 1; background-color: rgba(129, 140, 248, var(--tw-bg-opacity)); |         |
| bg-indigo-500  | --tw-bg-opacity: 1; background-color: rgba(99, 102, 241, var(--tw-bg-opacity)); |         |
| bg-indigo-600  | --tw-bg-opacity: 1; background-color: rgba(79, 70, 229, var(--tw-bg-opacity)); |         |
| bg-indigo-700  | --tw-bg-opacity: 1; background-color: rgba(67, 56, 202, var(--tw-bg-opacity)); |         |
| bg-indigo-800  | --tw-bg-opacity: 1; background-color: rgba(55, 48, 163, var(--tw-bg-opacity)); |         |
| bg-indigo-900  | --tw-bg-opacity: 1; background-color: rgba(49, 46, 129, var(--tw-bg-opacity)); |         |
| bg-purple-50   | --tw-bg-opacity: 1; background-color: rgba(245, 243, 255, var(--tw-bg-opacity)); |         |
| bg-purple-100  | --tw-bg-opacity: 1; background-color: rgba(237, 233, 254, var(--tw-bg-opacity)); |         |
| bg-purple-200  | --tw-bg-opacity: 1; background-color: rgba(221, 214, 254, var(--tw-bg-opacity)); |         |
| bg-purple-300  | --tw-bg-opacity: 1; background-color: rgba(196, 181, 253, var(--tw-bg-opacity)); |         |
| bg-purple-400  | --tw-bg-opacity: 1; background-color: rgba(167, 139, 250, var(--tw-bg-opacity)); |         |
| bg-purple-500  | --tw-bg-opacity: 1; background-color: rgba(139, 92, 246, var(--tw-bg-opacity)); |         |
| bg-purple-600  | --tw-bg-opacity: 1; background-color: rgba(124, 58, 237, var(--tw-bg-opacity)); |         |
| bg-purple-700  | --tw-bg-opacity: 1; background-color: rgba(109, 40, 217, var(--tw-bg-opacity)); |         |
| bg-purple-800  | --tw-bg-opacity: 1; background-color: rgba(91, 33, 182, var(--tw-bg-opacity)); |         |
| bg-purple-900  | --tw-bg-opacity: 1; background-color: rgba(76, 29, 149, var(--tw-bg-opacity)); |         |
| bg-pink-50     | --tw-bg-opacity: 1; background-color: rgba(253, 242, 248, var(--tw-bg-opacity)); |         |
| bg-pink-100    | --tw-bg-opacity: 1; background-color: rgba(252, 231, 243, var(--tw-bg-opacity)); |         |
| bg-pink-200    | --tw-bg-opacity: 1; background-color: rgba(251, 207, 232, var(--tw-bg-opacity)); |         |
| bg-pink-300    | --tw-bg-opacity: 1; background-color: rgba(249, 168, 212, var(--tw-bg-opacity)); |         |
| bg-pink-400    | --tw-bg-opacity: 1; background-color: rgba(244, 114, 182, var(--tw-bg-opacity)); |         |
| bg-pink-500    | --tw-bg-opacity: 1; background-color: rgba(236, 72, 153, var(--tw-bg-opacity)); |         |
| bg-pink-600    | --tw-bg-opacity: 1; background-color: rgba(219, 39, 119, var(--tw-bg-opacity)); |         |
| bg-pink-700    | --tw-bg-opacity: 1; background-color: rgba(190, 24, 93, var(--tw-bg-opacity)); |         |
| bg-pink-800    | --tw-bg-opacity: 1; background-color: rgba(157, 23, 77, var(--tw-bg-opacity)); |         |
| bg-pink-900    | --tw-bg-opacity: 1; background-color: rgba(131, 24, 67, var(--tw-bg-opacity)); |         |

## Usage

Control the background color of an element using the `bg-{color}` utilities.

Click me

```html
<button class="bg-green-500 ...">Button</button>
```

### Changing opacity

Control the opacity of an element’s background color using the `bg-opacity-{amount}` utilities.

100%

75%

50%

25%

0%

```html
<div class="bg-purple-600 bg-opacity-100 ..."></div>
<div class="bg-purple-600 bg-opacity-75 ..."></div>
<div class="bg-purple-600 bg-opacity-50 ..."></div>
<div class="bg-purple-600 bg-opacity-25 ..."></div>
<div class="bg-purple-600 bg-opacity-0 ..."></div>
```

Learn more in the [background opacity documentation](https://tailwindcss.com/docs/background-opacity).

## Responsive

To control the background color of an element at a specific breakpoint, add a `{screen}:` prefix to any existing background color utility. For example, use `md:bg-green-500` to apply the `bg-green-500` utility at only medium screen sizes and above.

```html
<button class="bg-blue-500 md:bg-green-500 ...">Button</button>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Hover

To control the background color of an element on hover, add the `hover:` prefix to any existing background color utility. For example, use `hover:bg-red-700` to apply the `bg-red-700` utility on hover.

Click me

```html
<button class="bg-red-500 hover:bg-red-700 ...">Button</button>
```

Hover utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `hover:` prefix.

```html
<button class="... md:bg-blue-500 md:hover:bg-blue-700 ...">Button</button>
```

## Focus

To control the background color of an element on focus, add the `focus:` prefix to any existing background color utility. For example, use `focus:bg-blue-500` to apply the `bg-blue-500` utility on focus.

```html
<input class="bg-gray-200 focus:bg-white ...">
```

Focus utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<input class="... md:bg-gray-200 md:focus:bg-white ...">
```

## Customizing

### Background Colors

By default, Tailwind makes the entire [default color palette](https://tailwindcss.com/docs/customizing-colors#default-color-palette) available as background colors.

You can [customize your color palette](https://tailwindcss.com/docs/colors#customizing) by editing the `theme.colors` variable in your `tailwind.config.js` file, or customize just your background colors using the `theme.backgroundColor` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      backgroundColor: theme => ({
-       ...theme('colors'),
+       'primary': '#3490dc',
+       'secondary': '#ffed4a',
+       'danger': '#e3342f',
      })
    }
  }
```

### Variants

By default, only responsive, dark mode *(if enabled)*, group-hover, focus-within, hover and focus variants are generated for background color utilities.

You can control which variants are generated for the background color utilities by modifying the `backgroundColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundColor: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background color utilities in your project, you can disable them entirely by setting the `backgroundColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundColor: false,
    }
  }
```

[←Background Clip](https://tailwindcss.com/docs/background-clip)[Background Opacity
  ](https://tailwindcss.com/docs/background-opacity)



---



# Background Opacity

Utilities for controlling the opacity of an element's background color.

## Default class reference

| Class          | Properties             |
| -------------- | ---------------------- |
| bg-opacity-0   | --tw-bg-opacity: 0;    |
| bg-opacity-5   | --tw-bg-opacity: 0.05; |
| bg-opacity-10  | --tw-bg-opacity: 0.1;  |
| bg-opacity-20  | --tw-bg-opacity: 0.2;  |
| bg-opacity-25  | --tw-bg-opacity: 0.25; |
| bg-opacity-30  | --tw-bg-opacity: 0.3;  |
| bg-opacity-40  | --tw-bg-opacity: 0.4;  |
| bg-opacity-50  | --tw-bg-opacity: 0.5;  |
| bg-opacity-60  | --tw-bg-opacity: 0.6;  |
| bg-opacity-70  | --tw-bg-opacity: 0.7;  |
| bg-opacity-75  | --tw-bg-opacity: 0.75; |
| bg-opacity-80  | --tw-bg-opacity: 0.8;  |
| bg-opacity-90  | --tw-bg-opacity: 0.9;  |
| bg-opacity-95  | --tw-bg-opacity: 0.95; |
| bg-opacity-100 | --tw-bg-opacity: 1;    |

## Usage

Control the opacity of an element’s background color using the `bg-opacity-{amount}` utilities.

100%

75%

50%

25%

0%

```html
<div class="bg-indigo-600 bg-opacity-100 ..."></div>
<div class="bg-indigo-600 bg-opacity-75 ..."></div>
<div class="bg-indigo-600 bg-opacity-50 ..."></div>
<div class="bg-indigo-600 bg-opacity-25 ..."></div>
<div class="bg-indigo-600 bg-opacity-0 ..."></div>
```

## Responsive

To control an element’s background color opacity at a specific breakpoint, add a `{screen}:` prefix to any existing background color opacity utility. For example, use `md:bg-opacity-50` to apply the `bg-opacity-50` utility at only medium screen sizes and above.

```html
<div class="bg-blue-500 bg-opacity-75 md:bg-opacity-50">
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
+         '15': '0.15',
+         '35': '0.35',
+         '65': '0.65',
        }
      }
    }
  }
```

If you want to customize only the background opacity utilities, use the `backgroundOpacity` section:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        backgroundOpacity: {
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

By default, only responsive, dark mode *(if enabled)*, group-hover, focus-within, hover and focus variants are generated for background opacity utilities.

You can control which variants are generated for the background opacity utilities by modifying the `backgroundOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundOpacity: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background opacity utilities in your project, you can disable them entirely by setting the `backgroundOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundOpacity: false,
    }
  }
```

[←Background Color](https://tailwindcss.com/docs/background-color)[Background Position
  ](https://tailwindcss.com/docs/background-position)



---



# Background Position

Utilities for controlling the position of an element's background image.

## Default class reference

| Class           | Properties                         |
| --------------- | ---------------------------------- |
| bg-bottom       | background-position: bottom;       |
| bg-center       | background-position: center;       |
| bg-left         | background-position: left;         |
| bg-left-bottom  | background-position: left bottom;  |
| bg-left-top     | background-position: left top;     |
| bg-right        | background-position: right;        |
| bg-right-bottom | background-position: right bottom; |
| bg-right-top    | background-position: right top;    |
| bg-top          | background-position: top;          |

## Usage

Use the `bg-{side}` utilities to control the position of an element’s background image.

.bg-left-top

.bg-top

.bg-right-top

.bg-left

.bg-center

.bg-right

.bg-left-bottom

.bg-bottom

.bg-right-bottom

```html
<div class="bg-no-repeat bg-left-top ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-top ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-right-top ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-left ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-center ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-right ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-left-bottom ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-bottom ..." style="background-image: url(...);"></div>
<div class="bg-no-repeat bg-right-bottom ..." style="background-image: url(...);"></div>
```

## Responsive

To control the position of an element’s background image at a specific breakpoint, add a `{screen}:` prefix to any existing background position utility. For example, adding the class `md:bg-top` to an element would apply the `bg-top` utility at medium screen sizes and above.

```html
<div class="bg-center md:bg-top ..." style="background-image: url(...)"></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Background Positions

By default, Tailwind provides nine `background-position` utilities. You change, add, or remove these by editing the `theme.backgroundPosition` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      backgroundPosition: {
        bottom: 'bottom',
+       'bottom-4': 'center bottom 1rem',
        center: 'center',
        left: 'left',
-       'left-bottom': 'left bottom',
-       'left-top': 'left top',
        right: 'right',
        'right-bottom': 'right bottom',
        'right-top': 'right top',
        top: 'top',
+       'top-4': 'center top 1rem',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for background position utilities.

You can control which variants are generated for the background position utilities by modifying the `backgroundPosition` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundPosition: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background position utilities in your project, you can disable them entirely by setting the `backgroundPosition` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundPosition: false,
    }
  }
```

[←Background Opacity](https://tailwindcss.com/docs/background-opacity)[Background Repeat
  ](https://tailwindcss.com/docs/background-repeat)



---



# Background Repeat

Utilities for controlling the repetition of an element's background image.

## Default class reference

| Class           | Properties                    |
| --------------- | ----------------------------- |
| bg-repeat       | background-repeat: repeat;    |
| bg-no-repeat    | background-repeat: no-repeat; |
| bg-repeat-x     | background-repeat: repeat-x;  |
| bg-repeat-y     | background-repeat: repeat-y;  |
| bg-repeat-round | background-repeat: round;     |
| bg-repeat-space | background-repeat: space;     |

## Repeat

Use `bg-repeat` to repeat the background image both vertically and horizontally.

```html
<div class="bg-repeat ..." style="background-image: url(...)"></div>
```

## No Repeat

Use `bg-no-repeat` when you don’t want to repeat the background image.

```html
<div class="bg-no-repeat bg-center ..." style="background-image: url(...)"></div>
```

## Repeat Horizontally

Use `bg-repeat-x` to repeat the background image only horizontally.

```html
<div class="bg-repeat-x bg-center ..." style="background-image: url(...)"></div>
```

## Repeat Vertically

Use `bg-repeat-y` to repeat the background image only vertically.

```html
<div class="bg-repeat-y bg-center ..." style="background-image: url(...)"></div>
```

## Responsive

To control the repetition of an element’s background image at a specific breakpoint, add a `{screen}:` prefix to any existing background repeat utility. For example, adding the class `md:bg-repeat-x` to an element would apply the `bg-repeat-x` utility at medium screen sizes and above.

```html
<div class="bg-repeat md:bg-repeat-x ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for background repeat utilities.

You can control which variants are generated for the background repeat utilities by modifying the `backgroundRepeat` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundRepeat: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background repeat utilities in your project, you can disable them entirely by setting the `backgroundRepeat` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundRepeat: false,
    }
  }
```

[←Background Position](https://tailwindcss.com/docs/background-position)[Background Size
  ](https://tailwindcss.com/docs/background-size)



---



# Background Size

Utilities for controlling the background size of an element's background image.

## Default class reference

| Class      | Properties                |
| ---------- | ------------------------- |
| bg-auto    | background-size: auto;    |
| bg-cover   | background-size: cover;   |
| bg-contain | background-size: contain; |

## Auto

Use `bg-auto` to display the background image at its default size.

```html
<div class="bg-auto bg-no-repeat bg-center ..." style="background-image: url(...)"></div>
```

## Cover

Use `bg-cover` to scale the background image until it fills the background layer.

```html
<div class="bg-cover bg-center ..." style="background-image: url(...)"></div>
```

## Contain

Use `bg-contain` to scale the background image to the outer edges without cropping or stretching.

```html
<div class="bg-contain bg-center ..." style="background-image: url(...)"></div>
```

## Responsive

To control the size of an element’s background image at a specific breakpoint, add a `{screen}:` prefix to any existing background size utility. For example, adding the class `md:bg-contain` to an element would apply the `bg-contain` utility at medium screen sizes and above.

```html
<div class="bg-auto md:bg-contain ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind provides utilities for `auto`, `cover`, and `contain` background sizes. You can change, add, or remove these by editing the `theme.backgroundSize` section of your config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      backgroundSize: {
        'auto': 'auto',
        'cover': 'cover',
        'contain': 'contain',
+       '50%': '50%',
+       '16': '4rem',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for background size utilities.

You can control which variants are generated for the background size utilities by modifying the `backgroundSize` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundSize: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background size utilities in your project, you can disable them entirely by setting the `backgroundSize` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundSize: false,
    }
  }
```

[←Background Repeat](https://tailwindcss.com/docs/background-repeat)[Background Image
  ](https://tailwindcss.com/docs/background-image)



---



# Background Image

Utilities for controlling an element's background image.

## Default class reference

| Class             | Properties                                                   |
| ----------------- | ------------------------------------------------------------ |
| bg-none           | background-image: none;                                      |
| bg-gradient-to-t  | background-image: linear-gradient(to top, var(--tw-gradient-stops)); |
| bg-gradient-to-tr | background-image: linear-gradient(to top right, var(--tw-gradient-stops)); |
| bg-gradient-to-r  | background-image: linear-gradient(to right, var(--tw-gradient-stops)); |
| bg-gradient-to-br | background-image: linear-gradient(to bottom right, var(--tw-gradient-stops)); |
| bg-gradient-to-b  | background-image: linear-gradient(to bottom, var(--tw-gradient-stops)); |
| bg-gradient-to-bl | background-image: linear-gradient(to bottom left, var(--tw-gradient-stops)); |
| bg-gradient-to-l  | background-image: linear-gradient(to left, var(--tw-gradient-stops)); |
| bg-gradient-to-tl | background-image: linear-gradient(to top left, var(--tw-gradient-stops)); |

## Linear gradients

To give an element a linear gradient background, use one of the `bg-gradient-{direction}` utilities, in combination with the [gradient color stop](https://tailwindcss.com/docs/gradient-color-stops) utilities.

```html
<div class="bg-gradient-to-r from-yellow-400 via-red-500 to-pink-500 ..."></div>
```

## Responsive

To control the background image of an element at a specific breakpoint, add a `{screen}:` prefix to any existing background image utility. For example, use `md:bg-gradient-to-r` to apply the `bg-gradient-to-r` utility at only medium screen sizes and above.

```html
<div class="bg-gradient-to-l md:bg-gradient-to-r ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Background Images

By default, Tailwind includes background image utilities for creating linear gradient backgrounds in eight directions.

You can add your own background images by editing the `theme.backgroundImage` section of your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        backgroundImage: theme => ({
+         'hero-pattern': "url('/img/hero-pattern.svg')",
+         'footer-texture': "url('/img/footer-texture.png')",
        })
      }
    }
  }
```

These don’t just have to be gradients — they can be any background images you need.

These classes will take the form `bg-{key}`, so `hero-pattern` will become `bg-hero-pattern` for example.

### Variants

By default, only responsive variants are generated for background image utilities.

You can control which variants are generated for the background image utilities by modifying the `backgroundImage` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backgroundImage: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the background image utilities in your project, you can disable them entirely by setting the `backgroundImage` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backgroundImage: false,
    }
  }
```

[←Background Size](https://tailwindcss.com/docs/background-size)[Gradient Color Stops
  ](https://tailwindcss.com/docs/gradient-color-stops)



---



# Gradient Color Stops

Utilities for controlling the color stops in background gradients.

## Default class reference

| Class            | Properties                                                   | Preview |
| ---------------- | ------------------------------------------------------------ | ------- |
| from-transparent | --tw-gradient-from: transparent; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(0, 0, 0, 0)); |         |
| from-current     | --tw-gradient-from: currentColor; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(255, 255, 255, 0)); |         |
| from-black       | --tw-gradient-from: #000; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(0, 0, 0, 0)); |         |
| from-white       | --tw-gradient-from: #fff; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(255, 255, 255, 0)); |         |
| from-gray-50     | --tw-gradient-from: #f9fafb; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(249, 250, 251, 0)); |         |
| from-gray-100    | --tw-gradient-from: #f3f4f6; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(243, 244, 246, 0)); |         |
| from-gray-200    | --tw-gradient-from: #e5e7eb; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(229, 231, 235, 0)); |         |
| from-gray-300    | --tw-gradient-from: #d1d5db; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(209, 213, 219, 0)); |         |
| from-gray-400    | --tw-gradient-from: #9ca3af; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(156, 163, 175, 0)); |         |
| from-gray-500    | --tw-gradient-from: #6b7280; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(107, 114, 128, 0)); |         |
| from-gray-600    | --tw-gradient-from: #4b5563; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(75, 85, 99, 0)); |         |
| from-gray-700    | --tw-gradient-from: #374151; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(55, 65, 81, 0)); |         |
| from-gray-800    | --tw-gradient-from: #1f2937; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(31, 41, 55, 0)); |         |
| from-gray-900    | --tw-gradient-from: #111827; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(17, 24, 39, 0)); |         |
| from-red-50      | --tw-gradient-from: #fef2f2; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(254, 242, 242, 0)); |         |
| from-red-100     | --tw-gradient-from: #fee2e2; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(254, 226, 226, 0)); |         |
| from-red-200     | --tw-gradient-from: #fecaca; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(254, 202, 202, 0)); |         |
| from-red-300     | --tw-gradient-from: #fca5a5; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(252, 165, 165, 0)); |         |
| from-red-400     | --tw-gradient-from: #f87171; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(248, 113, 113, 0)); |         |
| from-red-500     | --tw-gradient-from: #ef4444; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(239, 68, 68, 0)); |         |
| from-red-600     | --tw-gradient-from: #dc2626; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(220, 38, 38, 0)); |         |
| from-red-700     | --tw-gradient-from: #b91c1c; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(185, 28, 28, 0)); |         |
| from-red-800     | --tw-gradient-from: #991b1b; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(153, 27, 27, 0)); |         |
| from-red-900     | --tw-gradient-from: #7f1d1d; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(127, 29, 29, 0)); |         |
| from-yellow-50   | --tw-gradient-from: #fffbeb; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(255, 251, 235, 0)); |         |
| from-yellow-100  | --tw-gradient-from: #fef3c7; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(254, 243, 199, 0)); |         |
| from-yellow-200  | --tw-gradient-from: #fde68a; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(253, 230, 138, 0)); |         |
| from-yellow-300  | --tw-gradient-from: #fcd34d; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(252, 211, 77, 0)); |         |
| from-yellow-400  | --tw-gradient-from: #fbbf24; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(251, 191, 36, 0)); |         |
| from-yellow-500  | --tw-gradient-from: #f59e0b; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(245, 158, 11, 0)); |         |
| from-yellow-600  | --tw-gradient-from: #d97706; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(217, 119, 6, 0)); |         |
| from-yellow-700  | --tw-gradient-from: #b45309; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(180, 83, 9, 0)); |         |
| from-yellow-800  | --tw-gradient-from: #92400e; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(146, 64, 14, 0)); |         |
| from-yellow-900  | --tw-gradient-from: #78350f; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(120, 53, 15, 0)); |         |
| from-green-50    | --tw-gradient-from: #ecfdf5; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(236, 253, 245, 0)); |         |
| from-green-100   | --tw-gradient-from: #d1fae5; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(209, 250, 229, 0)); |         |
| from-green-200   | --tw-gradient-from: #a7f3d0; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(167, 243, 208, 0)); |         |
| from-green-300   | --tw-gradient-from: #6ee7b7; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(110, 231, 183, 0)); |         |
| from-green-400   | --tw-gradient-from: #34d399; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(52, 211, 153, 0)); |         |
| from-green-500   | --tw-gradient-from: #10b981; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(16, 185, 129, 0)); |         |
| from-green-600   | --tw-gradient-from: #059669; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(5, 150, 105, 0)); |         |
| from-green-700   | --tw-gradient-from: #047857; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(4, 120, 87, 0)); |         |
| from-green-800   | --tw-gradient-from: #065f46; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(6, 95, 70, 0)); |         |
| from-green-900   | --tw-gradient-from: #064e3b; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(6, 78, 59, 0)); |         |
| from-blue-50     | --tw-gradient-from: #eff6ff; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(239, 246, 255, 0)); |         |
| from-blue-100    | --tw-gradient-from: #dbeafe; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(219, 234, 254, 0)); |         |
| from-blue-200    | --tw-gradient-from: #bfdbfe; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(191, 219, 254, 0)); |         |
| from-blue-300    | --tw-gradient-from: #93c5fd; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(147, 197, 253, 0)); |         |
| from-blue-400    | --tw-gradient-from: #60a5fa; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(96, 165, 250, 0)); |         |
| from-blue-500    | --tw-gradient-from: #3b82f6; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(59, 130, 246, 0)); |         |
| from-blue-600    | --tw-gradient-from: #2563eb; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(37, 99, 235, 0)); |         |
| from-blue-700    | --tw-gradient-from: #1d4ed8; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(29, 78, 216, 0)); |         |
| from-blue-800    | --tw-gradient-from: #1e40af; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(30, 64, 175, 0)); |         |
| from-blue-900    | --tw-gradient-from: #1e3a8a; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(30, 58, 138, 0)); |         |
| from-indigo-50   | --tw-gradient-from: #eef2ff; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(238, 242, 255, 0)); |         |
| from-indigo-100  | --tw-gradient-from: #e0e7ff; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(224, 231, 255, 0)); |         |
| from-indigo-200  | --tw-gradient-from: #c7d2fe; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(199, 210, 254, 0)); |         |
| from-indigo-300  | --tw-gradient-from: #a5b4fc; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(165, 180, 252, 0)); |         |
| from-indigo-400  | --tw-gradient-from: #818cf8; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(129, 140, 248, 0)); |         |
| from-indigo-500  | --tw-gradient-from: #6366f1; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(99, 102, 241, 0)); |         |
| from-indigo-600  | --tw-gradient-from: #4f46e5; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(79, 70, 229, 0)); |         |
| from-indigo-700  | --tw-gradient-from: #4338ca; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(67, 56, 202, 0)); |         |
| from-indigo-800  | --tw-gradient-from: #3730a3; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(55, 48, 163, 0)); |         |
| from-indigo-900  | --tw-gradient-from: #312e81; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(49, 46, 129, 0)); |         |
| from-purple-50   | --tw-gradient-from: #f5f3ff; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(245, 243, 255, 0)); |         |
| from-purple-100  | --tw-gradient-from: #ede9fe; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(237, 233, 254, 0)); |         |
| from-purple-200  | --tw-gradient-from: #ddd6fe; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(221, 214, 254, 0)); |         |
| from-purple-300  | --tw-gradient-from: #c4b5fd; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(196, 181, 253, 0)); |         |
| from-purple-400  | --tw-gradient-from: #a78bfa; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(167, 139, 250, 0)); |         |
| from-purple-500  | --tw-gradient-from: #8b5cf6; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(139, 92, 246, 0)); |         |
| from-purple-600  | --tw-gradient-from: #7c3aed; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(124, 58, 237, 0)); |         |
| from-purple-700  | --tw-gradient-from: #6d28d9; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(109, 40, 217, 0)); |         |
| from-purple-800  | --tw-gradient-from: #5b21b6; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(91, 33, 182, 0)); |         |
| from-purple-900  | --tw-gradient-from: #4c1d95; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(76, 29, 149, 0)); |         |
| from-pink-50     | --tw-gradient-from: #fdf2f8; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(253, 242, 248, 0)); |         |
| from-pink-100    | --tw-gradient-from: #fce7f3; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(252, 231, 243, 0)); |         |
| from-pink-200    | --tw-gradient-from: #fbcfe8; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(251, 207, 232, 0)); |         |
| from-pink-300    | --tw-gradient-from: #f9a8d4; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(249, 168, 212, 0)); |         |
| from-pink-400    | --tw-gradient-from: #f472b6; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(244, 114, 182, 0)); |         |
| from-pink-500    | --tw-gradient-from: #ec4899; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(236, 72, 153, 0)); |         |
| from-pink-600    | --tw-gradient-from: #db2777; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(219, 39, 119, 0)); |         |
| from-pink-700    | --tw-gradient-from: #be185d; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(190, 24, 93, 0)); |         |
| from-pink-800    | --tw-gradient-from: #9d174d; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(157, 23, 77, 0)); |         |
| from-pink-900    | --tw-gradient-from: #831843; --tw-gradient-stops: var(--tw-gradient-from), var(--tw-gradient-to, rgba(131, 24, 67, 0)); |         |
| via-transparent  | --tw-gradient-stops: var(--tw-gradient-from), transparent, var(--tw-gradient-to, rgba(0, 0, 0, 0)); |         |
| via-current      | --tw-gradient-stops: var(--tw-gradient-from), currentColor, var(--tw-gradient-to, rgba(255, 255, 255, 0)); |         |
| via-black        | --tw-gradient-stops: var(--tw-gradient-from), #000, var(--tw-gradient-to, rgba(0, 0, 0, 0)); |         |
| via-white        | --tw-gradient-stops: var(--tw-gradient-from), #fff, var(--tw-gradient-to, rgba(255, 255, 255, 0)); |         |
| via-gray-50      | --tw-gradient-stops: var(--tw-gradient-from), #f9fafb, var(--tw-gradient-to, rgba(249, 250, 251, 0)); |         |
| via-gray-100     | --tw-gradient-stops: var(--tw-gradient-from), #f3f4f6, var(--tw-gradient-to, rgba(243, 244, 246, 0)); |         |
| via-gray-200     | --tw-gradient-stops: var(--tw-gradient-from), #e5e7eb, var(--tw-gradient-to, rgba(229, 231, 235, 0)); |         |
| via-gray-300     | --tw-gradient-stops: var(--tw-gradient-from), #d1d5db, var(--tw-gradient-to, rgba(209, 213, 219, 0)); |         |
| via-gray-400     | --tw-gradient-stops: var(--tw-gradient-from), #9ca3af, var(--tw-gradient-to, rgba(156, 163, 175, 0)); |         |
| via-gray-500     | --tw-gradient-stops: var(--tw-gradient-from), #6b7280, var(--tw-gradient-to, rgba(107, 114, 128, 0)); |         |
| via-gray-600     | --tw-gradient-stops: var(--tw-gradient-from), #4b5563, var(--tw-gradient-to, rgba(75, 85, 99, 0)); |         |
| via-gray-700     | --tw-gradient-stops: var(--tw-gradient-from), #374151, var(--tw-gradient-to, rgba(55, 65, 81, 0)); |         |
| via-gray-800     | --tw-gradient-stops: var(--tw-gradient-from), #1f2937, var(--tw-gradient-to, rgba(31, 41, 55, 0)); |         |
| via-gray-900     | --tw-gradient-stops: var(--tw-gradient-from), #111827, var(--tw-gradient-to, rgba(17, 24, 39, 0)); |         |
| via-red-50       | --tw-gradient-stops: var(--tw-gradient-from), #fef2f2, var(--tw-gradient-to, rgba(254, 242, 242, 0)); |         |
| via-red-100      | --tw-gradient-stops: var(--tw-gradient-from), #fee2e2, var(--tw-gradient-to, rgba(254, 226, 226, 0)); |         |
| via-red-200      | --tw-gradient-stops: var(--tw-gradient-from), #fecaca, var(--tw-gradient-to, rgba(254, 202, 202, 0)); |         |
| via-red-300      | --tw-gradient-stops: var(--tw-gradient-from), #fca5a5, var(--tw-gradient-to, rgba(252, 165, 165, 0)); |         |
| via-red-400      | --tw-gradient-stops: var(--tw-gradient-from), #f87171, var(--tw-gradient-to, rgba(248, 113, 113, 0)); |         |
| via-red-500      | --tw-gradient-stops: var(--tw-gradient-from), #ef4444, var(--tw-gradient-to, rgba(239, 68, 68, 0)); |         |
| via-red-600      | --tw-gradient-stops: var(--tw-gradient-from), #dc2626, var(--tw-gradient-to, rgba(220, 38, 38, 0)); |         |
| via-red-700      | --tw-gradient-stops: var(--tw-gradient-from), #b91c1c, var(--tw-gradient-to, rgba(185, 28, 28, 0)); |         |
| via-red-800      | --tw-gradient-stops: var(--tw-gradient-from), #991b1b, var(--tw-gradient-to, rgba(153, 27, 27, 0)); |         |
| via-red-900      | --tw-gradient-stops: var(--tw-gradient-from), #7f1d1d, var(--tw-gradient-to, rgba(127, 29, 29, 0)); |         |
| via-yellow-50    | --tw-gradient-stops: var(--tw-gradient-from), #fffbeb, var(--tw-gradient-to, rgba(255, 251, 235, 0)); |         |
| via-yellow-100   | --tw-gradient-stops: var(--tw-gradient-from), #fef3c7, var(--tw-gradient-to, rgba(254, 243, 199, 0)); |         |
| via-yellow-200   | --tw-gradient-stops: var(--tw-gradient-from), #fde68a, var(--tw-gradient-to, rgba(253, 230, 138, 0)); |         |
| via-yellow-300   | --tw-gradient-stops: var(--tw-gradient-from), #fcd34d, var(--tw-gradient-to, rgba(252, 211, 77, 0)); |         |
| via-yellow-400   | --tw-gradient-stops: var(--tw-gradient-from), #fbbf24, var(--tw-gradient-to, rgba(251, 191, 36, 0)); |         |
| via-yellow-500   | --tw-gradient-stops: var(--tw-gradient-from), #f59e0b, var(--tw-gradient-to, rgba(245, 158, 11, 0)); |         |
| via-yellow-600   | --tw-gradient-stops: var(--tw-gradient-from), #d97706, var(--tw-gradient-to, rgba(217, 119, 6, 0)); |         |
| via-yellow-700   | --tw-gradient-stops: var(--tw-gradient-from), #b45309, var(--tw-gradient-to, rgba(180, 83, 9, 0)); |         |
| via-yellow-800   | --tw-gradient-stops: var(--tw-gradient-from), #92400e, var(--tw-gradient-to, rgba(146, 64, 14, 0)); |         |
| via-yellow-900   | --tw-gradient-stops: var(--tw-gradient-from), #78350f, var(--tw-gradient-to, rgba(120, 53, 15, 0)); |         |
| via-green-50     | --tw-gradient-stops: var(--tw-gradient-from), #ecfdf5, var(--tw-gradient-to, rgba(236, 253, 245, 0)); |         |
| via-green-100    | --tw-gradient-stops: var(--tw-gradient-from), #d1fae5, var(--tw-gradient-to, rgba(209, 250, 229, 0)); |         |
| via-green-200    | --tw-gradient-stops: var(--tw-gradient-from), #a7f3d0, var(--tw-gradient-to, rgba(167, 243, 208, 0)); |         |
| via-green-300    | --tw-gradient-stops: var(--tw-gradient-from), #6ee7b7, var(--tw-gradient-to, rgba(110, 231, 183, 0)); |         |
| via-green-400    | --tw-gradient-stops: var(--tw-gradient-from), #34d399, var(--tw-gradient-to, rgba(52, 211, 153, 0)); |         |
| via-green-500    | --tw-gradient-stops: var(--tw-gradient-from), #10b981, var(--tw-gradient-to, rgba(16, 185, 129, 0)); |         |
| via-green-600    | --tw-gradient-stops: var(--tw-gradient-from), #059669, var(--tw-gradient-to, rgba(5, 150, 105, 0)); |         |
| via-green-700    | --tw-gradient-stops: var(--tw-gradient-from), #047857, var(--tw-gradient-to, rgba(4, 120, 87, 0)); |         |
| via-green-800    | --tw-gradient-stops: var(--tw-gradient-from), #065f46, var(--tw-gradient-to, rgba(6, 95, 70, 0)); |         |
| via-green-900    | --tw-gradient-stops: var(--tw-gradient-from), #064e3b, var(--tw-gradient-to, rgba(6, 78, 59, 0)); |         |
| via-blue-50      | --tw-gradient-stops: var(--tw-gradient-from), #eff6ff, var(--tw-gradient-to, rgba(239, 246, 255, 0)); |         |
| via-blue-100     | --tw-gradient-stops: var(--tw-gradient-from), #dbeafe, var(--tw-gradient-to, rgba(219, 234, 254, 0)); |         |
| via-blue-200     | --tw-gradient-stops: var(--tw-gradient-from), #bfdbfe, var(--tw-gradient-to, rgba(191, 219, 254, 0)); |         |
| via-blue-300     | --tw-gradient-stops: var(--tw-gradient-from), #93c5fd, var(--tw-gradient-to, rgba(147, 197, 253, 0)); |         |
| via-blue-400     | --tw-gradient-stops: var(--tw-gradient-from), #60a5fa, var(--tw-gradient-to, rgba(96, 165, 250, 0)); |         |
| via-blue-500     | --tw-gradient-stops: var(--tw-gradient-from), #3b82f6, var(--tw-gradient-to, rgba(59, 130, 246, 0)); |         |
| via-blue-600     | --tw-gradient-stops: var(--tw-gradient-from), #2563eb, var(--tw-gradient-to, rgba(37, 99, 235, 0)); |         |
| via-blue-700     | --tw-gradient-stops: var(--tw-gradient-from), #1d4ed8, var(--tw-gradient-to, rgba(29, 78, 216, 0)); |         |
| via-blue-800     | --tw-gradient-stops: var(--tw-gradient-from), #1e40af, var(--tw-gradient-to, rgba(30, 64, 175, 0)); |         |
| via-blue-900     | --tw-gradient-stops: var(--tw-gradient-from), #1e3a8a, var(--tw-gradient-to, rgba(30, 58, 138, 0)); |         |
| via-indigo-50    | --tw-gradient-stops: var(--tw-gradient-from), #eef2ff, var(--tw-gradient-to, rgba(238, 242, 255, 0)); |         |
| via-indigo-100   | --tw-gradient-stops: var(--tw-gradient-from), #e0e7ff, var(--tw-gradient-to, rgba(224, 231, 255, 0)); |         |
| via-indigo-200   | --tw-gradient-stops: var(--tw-gradient-from), #c7d2fe, var(--tw-gradient-to, rgba(199, 210, 254, 0)); |         |
| via-indigo-300   | --tw-gradient-stops: var(--tw-gradient-from), #a5b4fc, var(--tw-gradient-to, rgba(165, 180, 252, 0)); |         |
| via-indigo-400   | --tw-gradient-stops: var(--tw-gradient-from), #818cf8, var(--tw-gradient-to, rgba(129, 140, 248, 0)); |         |
| via-indigo-500   | --tw-gradient-stops: var(--tw-gradient-from), #6366f1, var(--tw-gradient-to, rgba(99, 102, 241, 0)); |         |
| via-indigo-600   | --tw-gradient-stops: var(--tw-gradient-from), #4f46e5, var(--tw-gradient-to, rgba(79, 70, 229, 0)); |         |
| via-indigo-700   | --tw-gradient-stops: var(--tw-gradient-from), #4338ca, var(--tw-gradient-to, rgba(67, 56, 202, 0)); |         |
| via-indigo-800   | --tw-gradient-stops: var(--tw-gradient-from), #3730a3, var(--tw-gradient-to, rgba(55, 48, 163, 0)); |         |
| via-indigo-900   | --tw-gradient-stops: var(--tw-gradient-from), #312e81, var(--tw-gradient-to, rgba(49, 46, 129, 0)); |         |
| via-purple-50    | --tw-gradient-stops: var(--tw-gradient-from), #f5f3ff, var(--tw-gradient-to, rgba(245, 243, 255, 0)); |         |
| via-purple-100   | --tw-gradient-stops: var(--tw-gradient-from), #ede9fe, var(--tw-gradient-to, rgba(237, 233, 254, 0)); |         |
| via-purple-200   | --tw-gradient-stops: var(--tw-gradient-from), #ddd6fe, var(--tw-gradient-to, rgba(221, 214, 254, 0)); |         |
| via-purple-300   | --tw-gradient-stops: var(--tw-gradient-from), #c4b5fd, var(--tw-gradient-to, rgba(196, 181, 253, 0)); |         |
| via-purple-400   | --tw-gradient-stops: var(--tw-gradient-from), #a78bfa, var(--tw-gradient-to, rgba(167, 139, 250, 0)); |         |
| via-purple-500   | --tw-gradient-stops: var(--tw-gradient-from), #8b5cf6, var(--tw-gradient-to, rgba(139, 92, 246, 0)); |         |
| via-purple-600   | --tw-gradient-stops: var(--tw-gradient-from), #7c3aed, var(--tw-gradient-to, rgba(124, 58, 237, 0)); |         |
| via-purple-700   | --tw-gradient-stops: var(--tw-gradient-from), #6d28d9, var(--tw-gradient-to, rgba(109, 40, 217, 0)); |         |
| via-purple-800   | --tw-gradient-stops: var(--tw-gradient-from), #5b21b6, var(--tw-gradient-to, rgba(91, 33, 182, 0)); |         |
| via-purple-900   | --tw-gradient-stops: var(--tw-gradient-from), #4c1d95, var(--tw-gradient-to, rgba(76, 29, 149, 0)); |         |
| via-pink-50      | --tw-gradient-stops: var(--tw-gradient-from), #fdf2f8, var(--tw-gradient-to, rgba(253, 242, 248, 0)); |         |
| via-pink-100     | --tw-gradient-stops: var(--tw-gradient-from), #fce7f3, var(--tw-gradient-to, rgba(252, 231, 243, 0)); |         |
| via-pink-200     | --tw-gradient-stops: var(--tw-gradient-from), #fbcfe8, var(--tw-gradient-to, rgba(251, 207, 232, 0)); |         |
| via-pink-300     | --tw-gradient-stops: var(--tw-gradient-from), #f9a8d4, var(--tw-gradient-to, rgba(249, 168, 212, 0)); |         |
| via-pink-400     | --tw-gradient-stops: var(--tw-gradient-from), #f472b6, var(--tw-gradient-to, rgba(244, 114, 182, 0)); |         |
| via-pink-500     | --tw-gradient-stops: var(--tw-gradient-from), #ec4899, var(--tw-gradient-to, rgba(236, 72, 153, 0)); |         |
| via-pink-600     | --tw-gradient-stops: var(--tw-gradient-from), #db2777, var(--tw-gradient-to, rgba(219, 39, 119, 0)); |         |
| via-pink-700     | --tw-gradient-stops: var(--tw-gradient-from), #be185d, var(--tw-gradient-to, rgba(190, 24, 93, 0)); |         |
| via-pink-800     | --tw-gradient-stops: var(--tw-gradient-from), #9d174d, var(--tw-gradient-to, rgba(157, 23, 77, 0)); |         |
| via-pink-900     | --tw-gradient-stops: var(--tw-gradient-from), #831843, var(--tw-gradient-to, rgba(131, 24, 67, 0)); |         |
| to-transparent   | --tw-gradient-to: transparent;                               |         |
| to-current       | --tw-gradient-to: currentColor;                              |         |
| to-black         | --tw-gradient-to: #000;                                      |         |
| to-white         | --tw-gradient-to: #fff;                                      |         |
| to-gray-50       | --tw-gradient-to: #f9fafb;                                   |         |
| to-gray-100      | --tw-gradient-to: #f3f4f6;                                   |         |
| to-gray-200      | --tw-gradient-to: #e5e7eb;                                   |         |
| to-gray-300      | --tw-gradient-to: #d1d5db;                                   |         |
| to-gray-400      | --tw-gradient-to: #9ca3af;                                   |         |
| to-gray-500      | --tw-gradient-to: #6b7280;                                   |         |
| to-gray-600      | --tw-gradient-to: #4b5563;                                   |         |
| to-gray-700      | --tw-gradient-to: #374151;                                   |         |
| to-gray-800      | --tw-gradient-to: #1f2937;                                   |         |
| to-gray-900      | --tw-gradient-to: #111827;                                   |         |
| to-red-50        | --tw-gradient-to: #fef2f2;                                   |         |
| to-red-100       | --tw-gradient-to: #fee2e2;                                   |         |
| to-red-200       | --tw-gradient-to: #fecaca;                                   |         |
| to-red-300       | --tw-gradient-to: #fca5a5;                                   |         |
| to-red-400       | --tw-gradient-to: #f87171;                                   |         |
| to-red-500       | --tw-gradient-to: #ef4444;                                   |         |
| to-red-600       | --tw-gradient-to: #dc2626;                                   |         |
| to-red-700       | --tw-gradient-to: #b91c1c;                                   |         |
| to-red-800       | --tw-gradient-to: #991b1b;                                   |         |
| to-red-900       | --tw-gradient-to: #7f1d1d;                                   |         |
| to-yellow-50     | --tw-gradient-to: #fffbeb;                                   |         |
| to-yellow-100    | --tw-gradient-to: #fef3c7;                                   |         |
| to-yellow-200    | --tw-gradient-to: #fde68a;                                   |         |
| to-yellow-300    | --tw-gradient-to: #fcd34d;                                   |         |
| to-yellow-400    | --tw-gradient-to: #fbbf24;                                   |         |
| to-yellow-500    | --tw-gradient-to: #f59e0b;                                   |         |
| to-yellow-600    | --tw-gradient-to: #d97706;                                   |         |
| to-yellow-700    | --tw-gradient-to: #b45309;                                   |         |
| to-yellow-800    | --tw-gradient-to: #92400e;                                   |         |
| to-yellow-900    | --tw-gradient-to: #78350f;                                   |         |
| to-green-50      | --tw-gradient-to: #ecfdf5;                                   |         |
| to-green-100     | --tw-gradient-to: #d1fae5;                                   |         |
| to-green-200     | --tw-gradient-to: #a7f3d0;                                   |         |
| to-green-300     | --tw-gradient-to: #6ee7b7;                                   |         |
| to-green-400     | --tw-gradient-to: #34d399;                                   |         |
| to-green-500     | --tw-gradient-to: #10b981;                                   |         |
| to-green-600     | --tw-gradient-to: #059669;                                   |         |
| to-green-700     | --tw-gradient-to: #047857;                                   |         |
| to-green-800     | --tw-gradient-to: #065f46;                                   |         |
| to-green-900     | --tw-gradient-to: #064e3b;                                   |         |
| to-blue-50       | --tw-gradient-to: #eff6ff;                                   |         |
| to-blue-100      | --tw-gradient-to: #dbeafe;                                   |         |
| to-blue-200      | --tw-gradient-to: #bfdbfe;                                   |         |
| to-blue-300      | --tw-gradient-to: #93c5fd;                                   |         |
| to-blue-400      | --tw-gradient-to: #60a5fa;                                   |         |
| to-blue-500      | --tw-gradient-to: #3b82f6;                                   |         |
| to-blue-600      | --tw-gradient-to: #2563eb;                                   |         |
| to-blue-700      | --tw-gradient-to: #1d4ed8;                                   |         |
| to-blue-800      | --tw-gradient-to: #1e40af;                                   |         |
| to-blue-900      | --tw-gradient-to: #1e3a8a;                                   |         |
| to-indigo-50     | --tw-gradient-to: #eef2ff;                                   |         |
| to-indigo-100    | --tw-gradient-to: #e0e7ff;                                   |         |
| to-indigo-200    | --tw-gradient-to: #c7d2fe;                                   |         |
| to-indigo-300    | --tw-gradient-to: #a5b4fc;                                   |         |
| to-indigo-400    | --tw-gradient-to: #818cf8;                                   |         |
| to-indigo-500    | --tw-gradient-to: #6366f1;                                   |         |
| to-indigo-600    | --tw-gradient-to: #4f46e5;                                   |         |
| to-indigo-700    | --tw-gradient-to: #4338ca;                                   |         |
| to-indigo-800    | --tw-gradient-to: #3730a3;                                   |         |
| to-indigo-900    | --tw-gradient-to: #312e81;                                   |         |
| to-purple-50     | --tw-gradient-to: #f5f3ff;                                   |         |
| to-purple-100    | --tw-gradient-to: #ede9fe;                                   |         |
| to-purple-200    | --tw-gradient-to: #ddd6fe;                                   |         |
| to-purple-300    | --tw-gradient-to: #c4b5fd;                                   |         |
| to-purple-400    | --tw-gradient-to: #a78bfa;                                   |         |
| to-purple-500    | --tw-gradient-to: #8b5cf6;                                   |         |
| to-purple-600    | --tw-gradient-to: #7c3aed;                                   |         |
| to-purple-700    | --tw-gradient-to: #6d28d9;                                   |         |
| to-purple-800    | --tw-gradient-to: #5b21b6;                                   |         |
| to-purple-900    | --tw-gradient-to: #4c1d95;                                   |         |
| to-pink-50       | --tw-gradient-to: #fdf2f8;                                   |         |
| to-pink-100      | --tw-gradient-to: #fce7f3;                                   |         |
| to-pink-200      | --tw-gradient-to: #fbcfe8;                                   |         |
| to-pink-300      | --tw-gradient-to: #f9a8d4;                                   |         |
| to-pink-400      | --tw-gradient-to: #f472b6;                                   |         |
| to-pink-500      | --tw-gradient-to: #ec4899;                                   |         |
| to-pink-600      | --tw-gradient-to: #db2777;                                   |         |
| to-pink-700      | --tw-gradient-to: #be185d;                                   |         |
| to-pink-800      | --tw-gradient-to: #9d174d;                                   |         |
| to-pink-900      | --tw-gradient-to: #831843;                                   |         |

## Starting color

Set the starting color of a gradient using the `from-{color}` utilities.

```html
<div class="bg-gradient-to-r from-red-500 ..."></div>
```

## Ending color

Set the ending color of a gradient using the `to-{color}` utilities.

```html
<div class="bg-gradient-to-r from-green-400 to-blue-500 ..."></div>
```

Gradients to **do not** fade in from transparent by default. To fade in from transparent, reverse the gradient direction and use a `from-{color}` utility.

## Middle color

Add a middle color to a gradient using the `via-{color}` utilities.

```html
<div class="bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 ..."></div>
```

Gradients with a `from-{color}` and `via-{color}` will fade out to transparent by default if no `to-{color}` is present.

## Fading to transparent

Gradients fade out to transparent by default, without requiring you to add `to-transparent` explicitly. Tailwind intelligently calculates the *right* “transparent” value to use based on the starting color to avoid [a bug in Safari](https://bugs.webkit.org/show_bug.cgi?id=150940) that causes fading to simply the `transparent` keyword to fade through gray, which just looks awful.

**Don't add `to-transparent` explicitly**

```html
<div class="bg-gradient-to-r from-blue-500 to-transparent">
  <!-- ... -->
</div>
```

**Only specify a from color and fade to transparent automatically**

```html
<div class="bg-gradient-to-r from-blue-500">
  <!-- ... -->
</div>
```

## Responsive

To control the gradient color stops of an element at a specific breakpoint, add a `{screen}:` prefix to any existing gradient color stop utility. For example, use `md:from-green-500` to apply the `from-green-500` utility at only medium screen sizes and above.

```html
<div class="bg-gradient-to-r from-purple-400 md:from-yellow-500"></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Hover

To control the gradient color stops of an element on hover, add the `hover:` prefix to any existing gradient color stop utility. For example, use `hover:bg-blue-500` to apply the `bg-blue-500` utility on hover.

Hover me

```html
<button type="button" class="bg-gradient-to-r from-green-400 to-blue-500 hover:from-pink-500 hover:to-yellow-500 ...">
  Hover me
</button>
```

Hover utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<button class="... md:from-blue-500 md:hover:from-blue-700 ...">Button</button>
```

## Focus

To control the gradient color stops of an element on focus, add the `focus:` prefix to any existing gradient color stop utility. For example, use `focus:bg-blue-500` to apply the `bg-blue-500` utility on focus.

Focus me

```html
<button type="button" class="bg-gradient-to-r from-green-400 to-blue-500 focus:from-pink-500 focus:to-yellow-500">
  Focus me
</button>
```

Focus utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<button class="... md:from-blue-500 md:focus:from-blue-700 ...">Button</button>
```

## Customizing

### Background Colors

By default, Tailwind makes the entire [default color palette](https://tailwindcss.com/docs/customizing-colors#default-color-palette) available as gradient color stops.

You can [customize your color palette](https://tailwindcss.com/docs/colors#customizing) by editing the `theme.colors` variable in your `tailwind.config.js` file, or customize just your gradient color stop colors using the `theme.gradientColorStops` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      gradientColorStops: theme => ({
-       ...theme('colors'),
+       'primary': '#3490dc',
+       'secondary': '#ffed4a',
+       'danger': '#e3342f',
      })
    }
  }
```

### Variants

By default, only responsive, dark mode *(if enabled)*, hover and focus variants are generated for gradient color stops utilities.

You can control which variants are generated for the gradient color stops utilities by modifying the `gradientColorStops` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active and group-hover variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gradientColorStops: ['active', 'group-hover'],
      }
    }
  }
```

### Disabling

If you don't plan to use the gradient color stops utilities in your project, you can disable them entirely by setting the `gradientColorStops` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gradientColorStops: false,
    }
  }
```

[←Background Image](https://tailwindcss.com/docs/background-image)[Border Radius
  ](https://tailwindcss.com/docs/border-radius)