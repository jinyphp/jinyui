---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind Configuration"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Configuration

A guide to configuring and customizing your Tailwind installation.

Because Tailwind is a framework for building bespoke user interfaces, it has been designed from the ground up with customization in mind.

By default, Tailwind will look for an optional `tailwind.config.js` file at the root of your project where you can define any customizations.

```js
// Example `tailwind.config.js` file
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      gray: colors.coolGray,
      blue: colors.lightBlue,
      red: colors.rose,
      pink: colors.fuchsia,
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  },
  variants: {
    extend: {
      borderColor: ['focus-visible'],
      opacity: ['disabled'],
    }
  }
}
```

Every section of the config file is optional, so you only have to specify what you’d like to change. Any missing sections will fall back to Tailwind’s [default configuration](https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/defaultConfig.stub.js).

## Creating your configuration file

Generate a Tailwind config file for your project using the Tailwind CLI utility included when you install the `tailwindcss` npm package:

```shell
npx tailwindcss init
```

This will create a minimal `tailwind.config.js` file at the root of your project:

```js
// tailwind.config.js
module.exports = {
  purge: [],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {},
  },
  variants: {
    extend: {},
  },
  plugins: [],
}
```

### Using a different file name

To use a name other than `tailwind.config.js`, pass it as an argument on the command-line:

```shell
npx tailwindcss init tailwindcss-config.js
```

If you use a custom file name, you will need to specify it when including Tailwind as a plugin in your PostCSS configuration as well:

```js
// postcss.config.js
module.exports = {
  plugins: {
    tailwindcss: { config: './tailwindcss-config.js' },
  },
}
```

### Generating a PostCSS configuration file

Use the `-p` flag if you’d like to also generate a basic `postcss.config.js` file alongside your `tailwind.config.js` file:

```shell
npx tailwindcss init -p
```

This will generate a `postcss.config.js` file in your project that looks like this:

```js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
}
```

### Scaffolding the entire default configuration

For most users we encourage you to keep your config file as minimal as possible, and only specify the things you want to customize.

If you’d rather scaffold a complete configuration file that includes all of Tailwind’s default configuration, use the `--full` option:

```shell
npx tailwindcss init --full
```

You’ll get a file that matches the [default configuration file](https://unpkg.com/browse/tailwindcss@latest/stubs/defaultConfig.stub.js) Tailwind uses internally.

## Theme

The `theme` section is where you define your color palette, fonts, type scale, border sizes, breakpoints — anything related to the visual design of your site.

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      gray: colors.coolGray,
      blue: colors.lightBlue,
      red: colors.rose,
      pink: colors.fuchsia,
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  }
}
```

Learn more about the default theme and how to customize it in the [theme configuration guide](https://tailwindcss.com/docs/theme).

## Variants

The `variants` section lets you control which [variants](https://tailwindcss.com/docs/hover-focus-and-other-states) are generated for each core utility plugin.

```js
// tailwind.config.js
module.exports = {
  variants: {
    fill: [],
    extend: {
      borderColor: ['focus-visible'],
      opacity: ['disabled'],
    }
  },
}
```

Learn more in the [variants configuration guide](https://tailwindcss.com/docs/configuring-variants).

## Plugins

The `plugins` section allows you to register plugins with Tailwind that can be used to generate extra utilities, components, base styles, or custom variants.

```js
// tailwind.config.js
module.exports = {
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
    require('@tailwindcss/typography'),
    require('tailwindcss-children'),
  ],
}
```

Learn more about writing your own plugins in the [plugin authoring guide](https://tailwindcss.com/docs/plugins).

## Presets

The `presets` section allows you to specify your own custom base configuration instead of using Tailwind’s default base configuration.

```js
// tailwind.config.js
module.exports = {
  presets: [
    require('@acmecorp/base-tailwind-config')
  ],

  // Project-specific customizations
  theme: {
    //...
  },
  // ...
}
```

Learn more about presets in the [presets documentation](https://tailwindcss.com/docs/presets).

## Prefix

The `prefix` option allows you to add a custom prefix to all of Tailwind’s generated utility classes. This can be really useful when layering Tailwind on top of existing CSS where there might be naming conflicts.

For example, you could add a `tw-` prefix by setting the `prefix` option like so:

```js
// tailwind.config.js
module.exports = {
  prefix: 'tw-',
}
```

Now every class will be generated with the configured prefix:

```css
.tw-text-left {
  text-align: left;
}
.tw-text-center {
  text-align: center;
}
.tw-text-right {
  text-align: right;
}
/* etc. */
```

It’s important to understand that this prefix is added *after* any variant prefixes. That means that classes with responsive or state prefixes like `sm:` or `hover:` will still have the responsive or state prefix *first*, with your custom prefix appearing after the colon:

```html
<div class="tw-text-lg md:tw-text-xl tw-bg-red-500 hover:tw-bg-blue-500">
  <!-- -->
</div>
```

Prefixes are only added to classes generated by Tailwind; **no prefix will be added to your own custom classes.**

That means if you add your own responsive utility like this:

```css
@variants hover {
  .bg-brand-gradient { /* ... */ }
}
```

…the generated responsive classes will not have your configured prefix:

```css
.bg-brand-gradient { /* ... */ }
.hover\:bg-brand-gradient:hover { /* ... */ }
```

If you’d like to prefix your own utilities as well, just add the prefix to the class definition:

```css
@variants hover {
  .tw-bg-brand-gradient { /* ... */ }
}
```

## Important

The `important` option lets you control whether or not Tailwind’s utilities should be marked with `!important`. This can be really useful when using Tailwind with existing CSS that has high specificity selectors.

To generate utilities as `!important`, set the `important` key in your configuration options to `true`:

```js
// tailwind.config.js
module.exports = {
  important: true,
}
```

Now all of Tailwind’s utility classes will be generated as `!important`:

```css
.leading-none {
  line-height: 1 !important;
}
.leading-tight {
  line-height: 1.25 !important;
}
.leading-snug {
  line-height: 1.375 !important;
}
/* etc. */
```

Note that any of your own custom utilities **will not** automatically be marked as `!important` by enabling this option.

If you’d like to make your own utilities `!important`, just add `!important` to the end of each declaration yourself:

```css
@responsive {
  .bg-brand-gradient {
    background-image: linear-gradient(#3490dc, #6574cd) !important;
  }
}
```

### Selector strategy

Setting `important` to `true` can introduce some issues when incorporating third-party JS libraries that add inline styles to your elements. In those cases, Tailwind’s `!important` utilities defeat the inline styles, which can break your intended design.

To get around this, you can set `important` to an ID selector like `#app` instead:

```js
// tailwind.config.js
module.exports = {
  important: '#app',
}
```

This configuration will prefix all of your utilities with the given selector, effectively increasing their specificity without actually making them `!important`.

After you specify the `important` selector, you’ll need to ensure that the root element of your site matches it. Using the example above, we would need to set our root element’s `id` attribute to `app` in order for styles to work properly.

After your configuration is all set up and your root element matches the selector in your Tailwind config, all of Tailwind’s utilities will have a high enough specificity to defeat other classes used in your project, **without** interfering with inline styles:

```html
<html>
<!-- ... -->
<style>
  .high-specificity .nested .selector {
    color: blue;
  }
</style>
<body id="app">
  <div class="high-specificity">
    <div class="nested">
      <!-- Will be red-500 -->
      <div class="selector text-red-500"><!-- ... --></div>
    </div>
  </div>

  <!-- Will be #bada55 -->
  <div class="text-red-500" style="color: #bada55;"><!-- ... --></div>
</body>
</html>
```

## Separator

The `separator` option lets you customize what character or string should be used to separate variant prefixes (screen sizes, `hover`, `focus`, etc.) from utility names (`text-center`, `items-end`, etc.).

We use a colon by default (`:`), but it can be useful to change this if you’re using a templating language like [Pug](https://pugjs.org/) that doesn’t support special characters in class names.

```js
// tailwind.config.js
module.exports = {
  separator: '_',
}
```

## Variant Order

If you are using the `extend` feature to enable extra variants, those variants are automatically sorted to respect a sensible default variant order.

You can customize this if necessary under the `variantOrder` key:

```js
// tailwind.config.js
module.exports = {
  // ...
  variantOrder: [
    'first',
    'last',
    'odd',
    'even',
    'visited',
    'checked',
    'group-hover',
    'group-focus',
    'focus-within',
    'hover',
    'focus',
    'focus-visible',
    'active',
    'disabled',
  ]
}
```

## Core Plugins

The `corePlugins` section lets you completely disable classes that Tailwind would normally generate by default if you don’t need them for your project.

If you don’t provide any `corePlugins` configuration, all core plugins will be enabled by default:

```js
// tailwind.config.js
module.exports = {
  // ...
}
```

If you’d like to disable specific core plugins, provide an object for `corePlugins` that sets those plugins to `false`:

```js
// tailwind.config.js
module.exports = {
  corePlugins: {
    float: false,
    objectFit: false,
    objectPosition: false,
  }
}
```

If you’d like to safelist which core plugins should be enabled, provide an array that includes a list of the core plugins you’d like to use:

```js
// tailwind.config.js
module.exports = {
  corePlugins: [
    'margin',
    'padding',
    'backgroundColor',
    // ...
  ]
}
```

If you’d like to disable all of Tailwind’s core plugins and simply use Tailwind as a tool for processing your own custom plugins, provide an empty array:

```js
// tailwind.config.js
module.exports = {
  corePlugins: []
}
```

Here’s a list of every core plugin for reference:

| Core Plugin                | Description                                                  |
| -------------------------- | ------------------------------------------------------------ |
| `preflight`                | Tailwind's base/reset styles                                 |
| `container`                | The `container` component                                    |
| `accessibility`            | The `sr-only` and `not-sr-only` utilities                    |
| `alignContent`             | The `align-content` utilities like `content-end`             |
| `alignItems`               | The `align-items` utilities like `items-center`              |
| `alignSelf`                | The `align-self` utilities like `self-end`                   |
| `animation`                | The `animation` utilities like `animate-none`                |
| `appearance`               | The `appearance` utilities like `appearance-none`            |
| `backdropBlur`             | The `backdrop-blur` utilities like `backdrop-blur-md`        |
| `backdropBrightness`       | The `backdrop-brightness` utilities like `backdrop-brightness-100` |
| `backdropContrast`         | The `backdrop-contrast` utilities like `backdrop-contrast-100` |
| `backdropFilter`           | The `backdrop-filter` utilities like `backdrop-filter`       |
| `backdropGrayscale`        | The `backdrop-grayscale` utilities like `backdrop-grayscale-0` |
| `backdropHueRotate`        | The `backdrop-hue-rotate` utilities like `backdrop-hue-rotate-180` |
| `backdropInvert`           | The `backdrop-invert` utilities like `backdrop-invert-0`     |
| `backdropOpacity`          | The `backdrop-opacity` utilities like `backdrop-opacity-50`  |
| `backdropSaturate`         | The `backdrop-saturate` utilities like `backdrop-saturate-100` |
| `backdropSepia`            | The `backdrop-sepia` utilities like `backdrop-sepia-0`       |
| `backgroundAttachment`     | The `background-attachment` utilities like `bg-local`        |
| `backgroundBlendMode`      | The `background-blend-mode` utilities like `bg-blend-color-burn` |
| `backgroundClip`           | The `background-clip` utilities like `bg-clip-padding`       |
| `backgroundColor`          | The `background-color` utilities like `bg-green-700`         |
| `backgroundImage`          | The `background-image` utilities like `bg-gradient-to-br`    |
| `backgroundOpacity`        | The `background-color` opacity utilities like `bg-opacity-25` |
| `backgroundPosition`       | The `background-position` utilities like `bg-left-top`       |
| `backgroundRepeat`         | The `background-repeat` utilities like `bg-repeat-x`         |
| `backgroundSize`           | The `background-size` utilities like `bg-cover`              |
| `blur`                     | The `blur` utilities like `blur-md`                          |
| `borderCollapse`           | The `border-collapse` utilities like `border-collapse`       |
| `borderColor`              | The `border-color` utilities like `border-green-700`         |
| `borderOpacity`            | The `border-color` opacity utilities like `border-opacity-25` |
| `borderRadius`             | The `border-radius` utilities like `rounded-l-3xl`           |
| `borderStyle`              | The `border-style` utilities like `border-dotted`            |
| `borderWidth`              | The `border-width` utilities like `border-l-2`               |
| `boxDecorationBreak`       | The `box-decoration-break` utilities like `decoration-slice` |
| `boxShadow`                | The `box-shadow` utilities like `shadow-lg`                  |
| `boxSizing`                | The `box-sizing` utilities like `box-border`                 |
| `brightness`               | The `brightness` utilities like `brightness-100`             |
| `clear`                    | The `clear` utilities like `clear-right`                     |
| `contrast`                 | The `contrast` utilities like `contrast-100`                 |
| `cursor`                   | The `cursor` utilities like `cursor-wait`                    |
| `display`                  | The `display` utilities like `table-column-group`            |
| `divideColor`              | The between elements `border-color` utilities like `divide-gray-500` |
| `divideOpacity`            | The `divide-opacity` utilities like `divide-opacity-50`      |
| `divideStyle`              | The `divide-style` utilities like `divide-dotted`            |
| `divideWidth`              | The between elements `border-width` utilities like `divide-x-2` |
| `dropShadow`               | The `drop-shadow` utilities like `drop-shadow-lg`            |
| `fill`                     | The `fill` utilities like `fill-current`                     |
| `filter`                   | The `filter` utilities like `filter`                         |
| `flex`                     | The `flex` utilities like `flex-auto`                        |
| `flexDirection`            | The `flex-direction` utilities like `flex-row-reverse`       |
| `flexGrow`                 | The `flex-grow` utilities like `flex-grow-0`                 |
| `flexShrink`               | The `flex-shrink` utilities like `flex-shrink-0`             |
| `flexWrap`                 | The `flex-wrap` utilities like `flex-wrap-reverse`           |
| `float`                    | The `float` utilities like `float-left`                      |
| `fontFamily`               | The `font-family` utilities like `font-serif`                |
| `fontSize`                 | The `font-size` utilities like `text-3xl`                    |
| `fontSmoothing`            | The `font-smoothing` utilities like `antialiased`            |
| `fontStyle`                | The `font-style` utilities like `italic`                     |
| `fontVariantNumeric`       | The `font-variant-numeric` utilities like `lining-nums`      |
| `fontWeight`               | The `font-weight` utilities like `font-medium`               |
| `gap`                      | The `gap` utilities like `gap-x-28`                          |
| `gradientColorStops`       | The `gradient-color-stops` utilities like `via-green-700`    |
| `grayscale`                | The `grayscale` utilities like `grayscale-0`                 |
| `gridAutoColumns`          | The `grid-auto-columns` utilities like `auto-cols-min`       |
| `gridAutoFlow`             | The `grid-auto-flow` utilities like `grid-flow-col`          |
| `gridAutoRows`             | The `grid-auto-rows` utilities like `auto-rows-min`          |
| `gridColumn`               | The `grid-column` utilities like `col-span-6`                |
| `gridColumnEnd`            | The `grid-column-end` utilities like `col-end-7`             |
| `gridColumnStart`          | The `grid-column-start` utilities like `col-start-7`         |
| `gridRow`                  | The `grid-row` utilities like `row-span-3`                   |
| `gridRowEnd`               | The `grid-row-end` utilities like `row-end-4`                |
| `gridRowStart`             | The `grid-row-start` utilities like `row-start-4`            |
| `gridTemplateColumns`      | The `grid-template-columns` utilities like `grid-cols-7`     |
| `gridTemplateRows`         | The `grid-template-rows` utilities like `grid-rows-4`        |
| `height`                   | The `height` utilities like `h-64`                           |
| `hueRotate`                | The `hue-rotate` utilities like `hue-rotate-180`             |
| `inset`                    | The `inset` utilities like `bottom-10`                       |
| `invert`                   | The `invert` utilities like `invert-0`                       |
| `isolation`                | The `isolation` utilities like `isolate`                     |
| `justifyContent`           | The `justify-content` utilities like `justify-center`        |
| `justifyItems`             | The `justify-items` utilities like `justify-items-end`       |
| `justifySelf`              | The `justify-self` utilities like `justify-self-end`         |
| `letterSpacing`            | The `letter-spacing` utilities like `tracking-normal`        |
| `lineHeight`               | The `line-height` utilities like `leading-9`                 |
| `listStylePosition`        | The `list-style-position` utilities like `list-inside`       |
| `listStyleType`            | The `list-style-type` utilities like `list-disc`             |
| `margin`                   | The `margin` utilities like `ml-8`                           |
| `maxHeight`                | The `max-height` utilities like `max-h-32`                   |
| `maxWidth`                 | The `max-width` utilities like `max-w-5xl`                   |
| `minHeight`                | The `min-height` utilities like `min-h-full`                 |
| `minWidth`                 | The `min-width` utilities like `min-w-full`                  |
| `mixBlendMode`             | The `mix-blend-mode` utilities like `mix-blend-color-burn`   |
| `objectFit`                | The `object-fit` utilities like `object-fill`                |
| `objectPosition`           | The `object-position` utilities like `object-left-top`       |
| `opacity`                  | The `opacity` utilities like `opacity-50`                    |
| `order`                    | The `order` utilities like `order-8`                         |
| `outline`                  | The `outline` utilities like `outline-white`                 |
| `overflow`                 | The `overflow` utilities like `overflow-y-auto`              |
| `overscrollBehavior`       | The `overscroll-behavior` utilities like `overscroll-y-contain` |
| `padding`                  | The `padding` utilities like `pr-4`                          |
| `placeContent`             | The `place-content` utilities like `place-content-between`   |
| `placeholderColor`         | The placeholder `color` utilities like `placeholder-red-600` |
| `placeholderOpacity`       | The placeholder `color` opacity utilities like `placeholder-opacity-25` |
| `placeItems`               | The `place-items` utilities like `place-items-end`           |
| `placeSelf`                | The `place-self` utilities like `place-self-end`             |
| `pointerEvents`            | The `pointer-events` utilities like `pointer-events-none`    |
| `position`                 | The `position` utilities like `absolute`                     |
| `resize`                   | The `resize` utilities like `resize-y`                       |
| `ringColor`                | The `ring-color` utilities like `ring-green-700`             |
| `ringOffsetColor`          | The `ring-offset-color` utilities like `ring-offset-green-700` |
| `ringOffsetWidth`          | The `ring-offset-width` utilities like `ring-offset-2`       |
| `ringOpacity`              | The `ring-opacity` utilities like `ring-opacity-50`          |
| `ringWidth`                | The `ring-width` utilities like `ring-2`                     |
| `rotate`                   | The `rotate` utilities like `rotate-180`                     |
| `saturate`                 | The `saturate` utilities like `saturate-100`                 |
| `scale`                    | The `scale` utilities like `scale-x-95`                      |
| `sepia`                    | The `sepia` utilities like `sepia-0`                         |
| `skew`                     | The `skew` utilities like `-skew-x-1`                        |
| `space`                    | The "space-between" utilities like `space-x-4`               |
| `stroke`                   | The `stroke` utilities like `stroke-current`                 |
| `strokeWidth`              | The `stroke-width` utilities like `stroke-1`                 |
| `tableLayout`              | The `table-layout` utilities like `table-auto`               |
| `textAlign`                | The `text-align` utilities like `text-center`                |
| `textColor`                | The `text-color` utilities like `text-green-700`             |
| `textDecoration`           | The `text-decoration` utilities like `line-through`          |
| `textOpacity`              | The `text-opacity` utilities like `text-opacity-50`          |
| `textOverflow`             | The `text-overflow` utilities like `overflow-ellipsis`       |
| `textTransform`            | The `text-transform` utilities like `lowercase`              |
| `transform`                | The `transform` utility (for enabling transform features)    |
| `transformOrigin`          | The `transform-origin` utilities like `origin-bottom-right`  |
| `transitionDelay`          | The `transition-delay` utilities like `delay-200`            |
| `transitionDuration`       | The `transition-duration` utilities like `duration-200`      |
| `transitionProperty`       | The `transition-property` utilities like `transition-colors` |
| `transitionTimingFunction` | The `transition-timing-function` utilities like `ease-in`    |
| `translate`                | The `translate` utilities like `-translate-x-full`           |
| `userSelect`               | The `user-select` utilities like `select-text`               |
| `verticalAlign`            | The `vertical-align` utilities like `align-middle`           |
| `visibility`               | The `visibility` utilities like `visible`                    |
| `whitespace`               | The `whitespace` utilities like `whitespace-pre`             |
| `width`                    | The `width` utilities like `w-0.5`                           |
| `wordBreak`                | The `word-break` utilities like `break-words`                |
| `zIndex`                   | The `z-index` utilities like `z-30`                          |

## Referencing in JavaScript

It can often be useful to reference your configuration values in your own client-side JavaScript — for example to access some of your theme values when dynamically applying inline styles in a React or Vue component.

To make this easy, Tailwind provides a `resolveConfig` helper you can use to generate a fully merged version of your configuration object:

```js
import resolveConfig from 'tailwindcss/resolveConfig'
import tailwindConfig from './tailwind.config.js'

const fullConfig = resolveConfig(tailwindConfig)

fullConfig.theme.width[4]
// => '1rem'

fullConfig.theme.screens.md
// => '768px'

fullConfig.theme.boxShadow['2xl']
// => '0 25px 50px -12px rgba(0, 0, 0, 0.25)'
```

Note that this will transitively pull in a lot of our build-time dependencies, resulting in bigger bundle client-side size. To avoid this, we recommend using a tool like [babel-plugin-preval](https://github.com/kentcdodds/babel-plugin-preval) to generate a static version of your configuration at build-time.

[←Functions & Directives](https://tailwindcss.com/docs/functions-and-directives)[Just-in-Time Mode
  ](https://tailwindcss.com/docs/just-in-time-mode)



---



# Just-in-Time Mode

- Tailwind CSS version

  v2.1+

A faster, more powerful, on-demand engine for Tailwind CSS v2.1+.

## Overview



**This feature is currently in preview.** Preview features are not covered by semantic versioning and some details may change as we continue to refine them.

Tailwind CSS v2.1 introduces a new just-in-time compiler for Tailwind CSS that generates your styles on-demand as you author your templates instead of generating everything in advance at initial build time.

<iframe class="absolute inset-0 h-full w-full" src="https://www.youtube.com/embed/3O_3X7InOw8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen="" style="box-sizing: border-box; border: 0px solid rgb(229, 231, 235); --tw-shadow:0 0 transparent; --tw-ring-inset:var(--tw-empty, ); --tw-ring-offset-width:0px; --tw-ring-offset-color:#fff; --tw-ring-color:rgba(59,130,246,0.5); --tw-ring-offset-shadow:0 0 transparent; --tw-ring-shadow:0 0 transparent; display: block; vertical-align: middle; position: absolute; inset: 0px; height: 450px; width: 800px;"></iframe>

This comes with a lot of advantages:

- **Lightning fast build times**. Tailwind can take 3–8s to initially compile using our CLI, and upwards of 30–45s in webpack projects because webpack struggles with large CSS files. This library can compile even the biggest projects in about 800ms *(with incremental rebuilds as fast as 3ms)*, no matter what build tool you’re using.
- **Every variant is enabled out of the box**. Variants like `focus-visible`, `active`, `disabled`, and others are not normally enabled by default due to file-size considerations. Since this library generates styles on demand, you can use any variant you want, whenever you want. You can even stack them like `sm:hover:active:disabled:opacity-75`. Never configure your variants again.
- **Generate arbitrary styles without writing custom CSS.** Ever needed some ultra-specific value that wasn’t part of your design system, like `top: -113px` for a quirky background image? Since styles are generated on demand, you can just generate a utility for this as needed using square bracket notation like `top-[-113px]`. Works with variants too, like `md:top-[-113px]`.
- **Your CSS is identical in development and production**. Since styles are generated as they are needed, you don’t need to purge unused styles for production, which means you see the exact same CSS in all environments. Never worry about accidentally purging an important style in production again.
- **Better browser performance in development**. Since development builds are as small as production builds, the browser doesn’t have to parse and manage multiple megabytes of pre-generated CSS. In projects with heavily extended configurations this makes dev tools a lot more responsive.

To see it in action, [watch our announcement video](https://www.youtube.com/watch?v=3O_3X7InOw8).

## Enabling JIT mode

To enable just-in-time mode, set the `mode` option to `'jit'` in your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
+   mode: 'jit',
    purge: [
      // ...
    ],
    theme: {
      // ...
    }
    // ...
  }
```

Since JIT mode generates your CSS on-demand by scanning your template files, it’s crucial that you configure the `purge` option in your `tailwind.config.js` file with all of your template paths, otherwise your CSS will be empty:

```diff-js
  // tailwind.config.js
  module.exports = {
    mode: 'jit',
+   // These paths are just examples, customize them to match your project structure
+   purge: [
+     './public/**/*.html',
+     './src/**/*.{js,jsx,ts,tsx,vue}',
+   ],
    theme: {
      // ...
    }
    // ...
  }
```

Now when you start your development server or build runner, Tailwind will generate your styles on-demand instead of generating everything in advance.

## Watch mode and one-off builds

Behind the scenes, the JIT engine uses its own file-watching system to watch your templates for changes as efficiently as possible.

By default, Tailwind will start a long-running watch process if `NODE_ENV=development`, and it will run in one-off mode if `NODE_ENV=production`.

```js
// package.json
{
  // ...
  scripts: {
    // Will start a long-running watch process
    "dev": "NODE_ENV=development postcss tailwind.css -o ./dist/tailwind.css -w"
    // Will perform a one-off build
    "build": "NODE_ENV=production postcss tailwind.css -o ./dist/tailwind.css"
  },
  // ...
}
```

If it appears like your one-off build process is hanging, it’s almost certainly because `NODE_ENV=development` in your build script. To fix this, you can either set `NODE_ENV=production`, or explicitly tell Tailwind not to start a watcher by setting `TAILWIND_MODE=build` as part of your script.

```js
// package.json
{
  // ...
  scripts: {
    // Will start a long-running watch process
    "dev": "TAILWIND_MODE=watch NODE_ENV=development postcss tailwind.css -o ./dist/tailwind.css -w"
    // Will perform a one-off development build
    "build:dev": "TAILWIND_MODE=build NODE_ENV=development postcss tailwind.css -o ./dist/tailwind.css"
    // Will perform a one-off production build
    "build:prod": "TAILWIND_MODE=build NODE_ENV=production postcss tailwind.css -o ./dist/tailwind.css"
  },
  // ...
}
```

## New features

### All variants are enabled

Since styles are generated on-demand, there’s no need to configure which variants are available for each core plugin.

```html
<input class="disabled:opacity-75">
```

You can use variants like `focus-visible`, `active`, `disabled`, `even`, and more in combination with any utility, without making any changes to your `tailwind.config.js` file.

### Stackable variants

All variants can be combined together to easily target very specific situations without writing custom CSS.

```html
<button class="md:dark:disabled:focus:hover:bg-gray-400">
```

### Arbitrary value support

Many utilities support arbitrary values using a new square bracket notation to indicate that you’re “breaking out” of your design system.

```html
<!-- Sizes and positioning -->
<img class="absolute w-[762px] h-[918px] top-[-325px] right-[62px] md:top-[-400px] md:right-[80px]" src="/crazy-background-image.png">

<!-- Colors -->
<button class="bg-[#1da1f1]">Share on Twitter</button>

<!-- Complex grids -->
<div class="grid-cols-[1fr,700px,2fr]">
  <!-- ... -->
</div>
```

This is very useful for building pixel-perfect designs where there are a few elements that need hyper-specific styles, like a carefully positioned background image on a marketing site.

We’ll likely add some form of “strict mode” in the future for power-hungry team leads who don’t trust their colleagues to use this feature responsibly.

#### Dynamic values

Note that you still need to [write purgeable HTML](https://tailwindcss.com/docs/optimizing-for-production#writing-purgeable-html) when using arbitrary values, and your classes need to exist as complete strings for Tailwind to detect them correctly.

**Don't use string concatenation to create class names**

```jsx
<div className={`mt-[${size === 'lg' ? '22px' : '17px' }]`}></div>
```

**Do dynamically select a complete class name**

```jsx
<div className={ size === 'lg' ? 'mt-[22px]' : 'mt-[17px]' }></div>
```

Tailwind doesn’t include any sort of client-side runtime, so class names need to be statically extractable at build-time, and can’t depend on any sort of arbitrary dynamic values that change on the client. Use inline styles for these situations, or combine Tailwind with a CSS-in-JS library like [Emotion](https://emotion.sh/docs/introduction) if it makes sense for your project.

**Arbitrary values cannot be computed from dynamic values**

```html
<div class="bg-[{{ userThemeColor }}]"></div>
```

**Use inline styles for truly dynamic or user-defined values**

```html
<div style="background-color: {{ userThemeColor }}"></div>
```

#### Values with spaces

It’s also important to note that CSS classes cannot contain spaces, which means you can’t use arbitrary values like `calc(100px - 4rem)` or `1fr 700px 2fr` as-is. To use arbitrary values like this in your class names, you need to remove the spaces in things like `calc` calls, and replace the spaces with commas in lists like `1fr 700px 2fr`. Tailwind will automatically re-introduce the spaces for you in `calc` calls and replace the commas with spaces in lists when generating the corresponding CSS.

**Don't use spaces in arbitrary values**

```html
<div class="h-[calc(1000px - 4rem)">...</div>
<div class="grid-cols-[1fr 700px 2fr]">...</div>
```

**Remove spaces or replace with commas as appropriate**

```html
<div class="h-[calc(1000px-4rem)]">...</div>
<div class="grid-cols-[1fr,700px,2fr]">...</div>
```

### Built-in important modifier

You can make any utility important by adding a `!` character to the beginning:

```html
<p class="font-bold !font-medium">
  This will be medium even though bold comes later in the CSS.
</p>
```

The `!` always goes at the beginning of the utility name, after any variants, but before any prefix:

```html
<div class="sm:hover:!tw-font-bold">
```

This can be useful in rare situations where you need to increase specificity because you’re at war with some styles you don’t control.

## Known limitations

This new engine is very close to feature parity with `tailwindcss` currently and for most projects I bet you’ll find it works exactly as you’d expect.

There are a few items still on our todo list though that we are actively working on:

- Advanced PurgeCSS options like `safelist` aren’t supported yet since we aren’t actually using PurgeCSS. We’ll add a way to safelist classes for sure though. For now, a `safelist.txt` file somewhere in your project with all the classes you want to safelist will work fine.
- You can only `@apply` classes that are part of core, generated by plugins, or defined within a `@layer` rule. You can’t `@apply` arbitrary CSS classes that aren’t defined within a `@layer` rule.

We are also ironing out some compatibility issues with certain build tools like Parcel and Snowpack, which you can follow in our [issue tracker](https://github.com/tailwindlabs/tailwindcss/issues).

If you run into any other issues or find any bugs, please [open an issue](https://github.com/tailwindlabs/tailwindcss/issues/new/choose) so we can fix it.

[←Configuration](https://tailwindcss.com/docs/configuration)[Theme
  ](https://tailwindcss.com/docs/theme)



---



# Theme Configuration

Customizing the default theme for your project.

The `theme` section of your `tailwind.config.js` file is where you define your project’s color palette, type scale, fonts, breakpoints, border radius values, and more.

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px',
    },
    colors: {
      gray: colors.coolGray,
      blue: colors.lightBlue,
      red: colors.rose,
      pink: colors.fuchsia,
    },
    fontFamily: {
      sans: ['Graphik', 'sans-serif'],
      serif: ['Merriweather', 'serif'],
    },
    extend: {
      spacing: {
        '128': '32rem',
        '144': '36rem',
      },
      borderRadius: {
        '4xl': '2rem',
      }
    }
  }
}
```

We provide a sensible [default theme](https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/defaultConfig.stub.js#L7) with a very generous set of values to get you started, but don’t be afraid to change it or extend; you’re encouraged to customize it as much as you need to fit the goals of your design.

------

## Theme structure

The `theme` object contains keys for `screens`, `colors`, and `spacing`, as well as a key for each customizable [core plugin](https://tailwindcss.com/docs/configuration#core-plugins).

See the [theme configuration reference](https://tailwindcss.com/docs/theme#configuration-reference) or the [default theme](https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/defaultConfig.stub.js#L7) for a complete list of theme options.

### Screens

The `screens` key allows you to customize the responsive breakpoints in your project.

```js
// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '2xl': '1536px',
    }
  }
}
```

To learn more, see the [breakpoint customization documentation](https://tailwindcss.com/docs/breakpoints).

### Colors

The `colors` key allows you to customize the global color palette for your project.

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      transparent: 'transparent',
      black: '#000',
      white: '#fff',
      gray: {
        100: '#f7fafc',
        // ...
        900: '#1a202c',
      },

      // ...
    }
  }
}
```

By default, these colors are inherited by all color-related core plugins, like `backgroundColor`, `borderColor`, `textColor`, and others.

To learn more, see the [color customization documentation](https://tailwindcss.com/docs/colors).

### Spacing

The `spacing` key allows you to customize the global spacing and sizing scale for your project.

```js
// tailwind.config.js
module.exports = {
  theme: {
    spacing: {
      px: '1px',
      0: '0',
      0.5: '0.125rem',
      1: '0.25rem',
      1.5: '0.375rem',
      2: '0.5rem',
      2.5: '0.625rem',
      3: '0.75rem',
      3.5: '0.875rem',
      4: '1rem',
      5: '1.25rem',
      6: '1.5rem',
      7: '1.75rem',
      8: '2rem',
      9: '2.25rem',
      10: '2.5rem',
      11: '2.75rem',
      12: '3rem',
      14: '3.5rem',
      16: '4rem',
      20: '5rem',
      24: '6rem',
      28: '7rem',
      32: '8rem',
      36: '9rem',
      40: '10rem',
      44: '11rem',
      48: '12rem',
      52: '13rem',
      56: '14rem',
      60: '15rem',
      64: '16rem',
      72: '18rem',
      80: '20rem',
      96: '24rem',
    },
  }
}
```

By default, these values are inherited by the `padding`, `margin`, `width`, `height`, `maxHeight`, `gap`, `inset`, `space`, and `translate` core plugins.

To learn more, see the [spacing customization documentation](https://tailwindcss.com/docs/customizing-spacing).

### Core plugins

The rest of the `theme` section is used to configure which values are available for each individual core plugin.

For example, the `borderRadius` key lets you customize which border radius utilities will be generated:

```js
module.exports = {
  theme: {
    borderRadius: {
      'none': '0',
      'sm': '.125rem',
      DEFAULT: '.25rem',
      'lg': '.5rem',
      'full': '9999px',
    },
  }
}
```

The keys determine the suffix for the generated classes, and the values determine the value of the actual CSS declaration.

The example `borderRadius` configuration above would generate the following CSS classes:

```css
.rounded-none { border-radius: 0 }
.rounded-sm   { border-radius: .125rem }
.rounded      { border-radius: .25rem }
.rounded-lg   { border-radius: .5rem }
.rounded-full { border-radius: 9999px }
```

You’ll notice that using a key of `DEFAULT` in the theme configuration created the class `rounded` with no suffix. This is a common convention in Tailwind and is supported by all core plugins.

To learn more about customizing a specific core plugin, visit the documentation for that plugin.

For a complete reference of available theme properties and their default values, [see the default theme configuration](https://github.com/tailwindlabs/tailwindcss/blob/v1/stubs/defaultConfig.stub.js#L5).

## Customizing the default theme

Out of the box, your project will automatically inherit the values from [the default theme configuration](https://github.com/tailwindlabs/tailwindcss/blob/v1/stubs/defaultConfig.stub.js#L5). If you would like to customize the default theme, you have a few different options depending on your goals.

### Extending the default theme

If you’d like to preserve the default values for a theme option but also add new values, add your extensions under the `extend` key in the `theme` section of your configuration file.

For example, if you wanted to add an extra breakpoint but preserve the existing ones, you could extend the `screens` property:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      // Adds a new breakpoint in addition to the default breakpoints
      screens: {
        '3xl': '1600px',
      }
    }
  }
}
```

### Overriding the default theme

To override an option in the default theme, add your overrides directly under the `theme` section of your `tailwind.config.js`:

```js
// tailwind.config.js
module.exports = {
  theme: {
    // Replaces all of the default `opacity` values
    opacity: {
      '0': '0',
      '20': '0.2',
      '40': '0.4',
      '60': '0.6',
      '80': '0.8',
      '100': '1',
    }
  }
}
```

This will completely replace Tailwind’s default configuration for that key, so in the example above none of the default opacity utilities would be generated.

Any keys you **do not** provide will be inherited from the default theme, so in the above example, the default theme configuration for things like colors, spacing, border-radius, background-position, etc. would be preserved.

You can of course both override some parts of the default theme and extend other parts of the default theme within the same configuration:

```js
// tailwind.config.js
module.exports = {
  theme: {
    opacity: {
      '0': '0',
      '20': '0.2',
      '40': '0.4',
      '60': '0.6',
      '80': '0.8',
      '100': '1',
    },
    extend: {
      screens: {
        '3xl': '1600px',
      }
    }
  }
}
```

### Referencing other values

If you need to reference another value in your theme, you can do so by providing a closure instead of a static value. The closure will receive a `theme()` function that you can use to look up other values in your theme using dot notation.

For example, you could generate `fill` utilities for every color in your color palette by referencing `theme('colors')` in your `fill` configuration:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      // ...
    },
    fill: theme => theme('colors')
  }
}
```

The `theme()` function attempts to find the value you are looking for from the fully merged theme object, so it can reference your own customizations as well as the default theme values. It also works recursively, so as long as there is a static value at the end of the chain it will be able to resolve the value you are looking for.

Note that you can only use this kind of closure with top-level theme keys, not the keys inside of each section.

**You can't use functions for individual values**

```js
// tailwind.config.js
module.exports = {
  theme: {
    fill: {
      gray: theme => theme('colors.gray')
    }
  }
}
```

**Use functions for top-level theme keys**

```js
// tailwind.config.js
module.exports = {
  theme: {
    fill: theme => ({
      gray: theme('colors.gray')
    })
  }
}
```

### Referencing the default theme

If you’d like to reference a value in the default theme for any reason, you can import it from `tailwindcss/defaultTheme`.

One example of where this is useful is if you’d like to add a font family to one of Tailwind’s default font stacks:

```js
// tailwind.config.js
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: [
          'Lato',
          ...defaultTheme.fontFamily.sans,
        ]
      }
    }
  }
}
```

### Disabling an entire core plugin

If you don’t want to generate any classes for a certain core plugin, it’s better to set that plugin to false in your `corePlugins` configuration than to provide an empty object for that key in your `theme` configuration.

**Don't assign an empty object in your theme configuration**

```js
// tailwind.config.js
module.exports = {
  theme: {
    opacity: {},
  }
}
```

**Do disable the plugin in your corePlugins configuration**

```js
// tailwind.config.js
module.exports = {
  corePlugins: {
    opacity: false,
  }
}
```

The end result is the same, but since many core plugins expose no configuration they can only be disabled using `corePlugins` anyways, so it’s better to be consistent.

### Adding your own keys

There are a number of situations where it can be useful to add your own keys to the `theme` object.

One example of this is adding new keys to create a single source of truth for values that are common between multiple core plugins. For example, you could extract a shared `positions` object that could be referenced by both the `backgroundPosition` and `objectPosition` plugins:

```js
// tailwind.config.js
module.exports = {
  theme: {
    positions: {
      bottom: 'bottom',
      center: 'center',
      left: 'left',
      'left-bottom': 'left bottom',
      'left-top': 'left top',
      right: 'right',
      'right-bottom': 'right bottom',
      'right-top': 'right top',
      top: 'top',
    },
    backgroundPosition: theme => theme('positions'),
    objectPosition: theme => theme('positions'),
  }
}
```

Another example is adding a new key to reference inside a custom plugin. For example, if you’ve written a `filters` plugin for your project, you might add a `filters` key to your `theme` object that the plugin references:

```js
// tailwind.config.js
module.exports = {
  theme: {
    filters: {
      none: 'none',
      grayscale: 'grayscale(1)',
      invert: 'invert(1)',
      sepia: 'sepia(1)',
    }
  },
  plugins: [
    require('./plugins/filters')
  ],
}
```

Since the entire `theme` object is available in your CSS using the [theme function](https://tailwindcss.com/docs/functions-and-directives#theme), you might also add a key just to be able to reference it in your CSS.

## Configuration reference

Except for `screens`, `colors`, and `spacing`, all of the keys in the `theme` object map to one of Tailwind’s [core plugins](https://tailwindcss.com/docs/configuration#core-plugins). Since many plugins are responsible for CSS properties that only accept a static set of values (like `float` for example), note that not every plugin has a corresponding key in the `theme` object.

All of these keys are also available under the `theme.extend` key to enable [extending the default theme](https://tailwindcss.com/docs/theme#extending-the-default-theme).

| Key                        | Description                                                  |
| -------------------------- | ------------------------------------------------------------ |
| `screens`                  | Your project's responsive breakpoints                        |
| `colors`                   | Your project's color palette                                 |
| `spacing`                  | Your project's spacing scale                                 |
| `animation`                | Values for the `animation` property                          |
| `backdropBlur`             | Values for the `backdrop-blur` property                      |
| `backdropBrightness`       | Values for the `backdrop-brightness` property                |
| `backdropContrast`         | Values for the `backdrop-contrast` property                  |
| `backdropGrayscale`        | Values for the `backdrop-grayscale` property                 |
| `backdropHueRotate`        | Values for the `backdrop-hue-rotate` property                |
| `backdropInvert`           | Values for the `backdrop-invert` property                    |
| `backdropOpacity`          | Values for the `backdrop-opacity` property                   |
| `backdropSaturate`         | Values for the `backdrop-saturate` property                  |
| `backdropSepia`            | Values for the `backdrop-sepia` property                     |
| `backgroundColor`          | Values for the `background-color` property                   |
| `backgroundImage`          | Values for the `background-image` property                   |
| `backgroundOpacity`        | Values for the `background-opacity` property                 |
| `backgroundPosition`       | Values for the `background-position` property                |
| `backgroundSize`           | Values for the `background-size` property                    |
| `blur`                     | Values for the `blur` property                               |
| `brightness`               | Values for the `brightness` property                         |
| `borderColor`              | Values for the `border-color` property                       |
| `borderOpacity`            | Values for the `border-opacity` property                     |
| `borderRadius`             | Values for the `border-radius` property                      |
| `borderWidth`              | Values for the `border-width` property                       |
| `boxShadow`                | Values for the `box-shadow` property                         |
| `contrast`                 | Values for the `contrast` property                           |
| `container`                | Configuration for the `container` plugin                     |
| `cursor`                   | Values for the `cursor` property                             |
| `divideColor`              | Values for the `divide-color` property                       |
| `divideOpacity`            | Values for the `divide-opacity` property                     |
| `divideWidth`              | Values for the `divide-width` property                       |
| `dropShadow`               | Values for the `drop-shadow` property                        |
| `fill`                     | Values for the `fill` property                               |
| `grayscale`                | Values for the `grayscale` property                          |
| `hueRotate`                | Values for the `hue-rotate` property                         |
| `invert`                   | Values for the `invert` property                             |
| `flex`                     | Values for the `flex` property                               |
| `flexGrow`                 | Values for the `flex-grow` property                          |
| `flexShrink`               | Values for the `flex-shrink` property                        |
| `fontFamily`               | Values for the `font-family` property                        |
| `fontSize`                 | Values for the `font-size` property                          |
| `fontWeight`               | Values for the `font-weight` property                        |
| `gap`                      | Values for the `gap` property                                |
| `gradientColorStops`       | Values for the `gradient-color-stops` property               |
| `gridAutoColumns`          | Values for the `grid-auto-columns` property                  |
| `gridAutoRows`             | Values for the `grid-auto-rows` property                     |
| `gridColumn`               | Values for the `grid-column` property                        |
| `gridColumnEnd`            | Values for the `grid-column-end` property                    |
| `gridColumnStart`          | Values for the `grid-column-start` property                  |
| `gridRow`                  | Values for the `grid-row` property                           |
| `gridRowStart`             | Values for the `grid-row-start` property                     |
| `gridRowEnd`               | Values for the `grid-row-end` property                       |
| `gridTemplateColumns`      | Values for the `grid-template-columns` property              |
| `gridTemplateRows`         | Values for the `grid-template-rows` property                 |
| `height`                   | Values for the `height` property                             |
| `inset`                    | Values for the `top`, `right`, `bottom`, and `left` properties |
| `keyframes`                | Values for the `keyframes` property                          |
| `letterSpacing`            | Values for the `letter-spacing` property                     |
| `lineHeight`               | Values for the `line-height` property                        |
| `listStyleType`            | Values for the `list-style-type` property                    |
| `margin`                   | Values for the `margin` property                             |
| `maxHeight`                | Values for the `max-height` property                         |
| `maxWidth`                 | Values for the `max-width` property                          |
| `minHeight`                | Values for the `min-height` property                         |
| `minWidth`                 | Values for the `min-width` property                          |
| `objectPosition`           | Values for the `object-position` property                    |
| `opacity`                  | Values for the `opacity` property                            |
| `order`                    | Values for the `order` property                              |
| `outline`                  | Values for the `outline` property                            |
| `padding`                  | Values for the `padding` property                            |
| `placeholderColor`         | Values for the `placeholderColor` plugin                     |
| `placeholderOpacity`       | Values for the `placeholderOpacity` plugin                   |
| `ringColor`                | Values for the `ring-color` property                         |
| `ringOffsetColor`          | Values for the `ring-offset-color` property                  |
| `ringOffsetWidth`          | Values for the `ring-offset-width` property                  |
| `ringOpacity`              | Values for the `ring-opacity` property                       |
| `ringWidth`                | Values for the `ring-width` property                         |
| `rotate`                   | Values for the `rotate` plugin                               |
| `saturate`                 | Values for the `saturate` property                           |
| `scale`                    | Values for the `scale` plugin                                |
| `sepia`                    | Values for the `sepia` property                              |
| `skew`                     | Values for the `skew` plugin                                 |
| `space`                    | Values for the `space` plugin                                |
| `stroke`                   | Values for the `stroke` property                             |
| `strokeWidth`              | Values for the `stroke-width` property                       |
| `textColor`                | Values for the `text-color` property                         |
| `textOpacity`              | Values for the `textOpacity` plugin                          |
| `transformOrigin`          | Values for the `transform-origin` property                   |
| `transitionDelay`          | Values for the `transition-delay` property                   |
| `transitionDuration`       | Values for the `transition-duration` property                |
| `transitionProperty`       | Values for the `transition-property` property                |
| `transitionTimingFunction` | Values for the `transition-timing-function` property         |
| `translate`                | Values for the `translate` plugin                            |
| `width`                    | Values for the `width` property                              |
| `zIndex`                   | Values for the `z-index` property                            |

[←Just-in-Time Mode](https://tailwindcss.com/docs/just-in-time-mode)[Breakpoints
  ](https://tailwindcss.com/docs/breakpoints)



---



# Breakpoints

Customizing the default breakpoints for your project.

## Basic customization

You define your project’s breakpoints in the `theme.screens` section of your `tailwind.config.js` file. The keys are your screen names (used as the prefix for the responsive utility variants Tailwind generates, like `md:text-center`), and the values are the `min-width` where that breakpoint should start.

The default breakpoints are inspired by common device resolutions:

```js
// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'sm': '640px',
      // => @media (min-width: 640px) { ... }

      'md': '768px',
      // => @media (min-width: 768px) { ... }

      'lg': '1024px',
      // => @media (min-width: 1024px) { ... }

      'xl': '1280px',
      // => @media (min-width: 1280px) { ... }

      '2xl': '1536px',
      // => @media (min-width: 1536px) { ... }
    }
  }
}
```

Feel free to have as few or as many screens as you want, naming them in whatever way you’d prefer for your project.

For example, you could use device names instead of sizes:

```js
// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'tablet': '640px',
      // => @media (min-width: 640px) { ... }

      'laptop': '1024px',
      // => @media (min-width: 1024px) { ... }

      'desktop': '1280px',
      // => @media (min-width: 1280px) { ... }
    },
  }
}
```

These screen names will be reflected in your utilities, so your `text-center` utilities would now look like this:

```css
.text-center { text-align: center }

@media (min-width: 640px) {
  .tablet\:text-center { text-align: center }
}

@media (min-width: 1024px) {
  .laptop\:text-center { text-align: center }
}

@media (min-width: 1280px) {
  .desktop\:text-center { text-align: center }
}
```

## Extending the default breakpoints

The easiest way to add an additional larger breakpoint is using the `extend` key:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      screens: {
        '3xl': '1600px',
      },
    },
  },
  variants: {},
  plugins: [],
}
```

If you want to add an additional small breakpoint, you can’t use `extend` because the small breakpoint would be added to the end of the breakpoint list, and breakpoints need to be sorted from smallest to largest in order to work as expected with a min-width breakpoint system.

Instead, override the entire `screens` key, re-specifying the default breakpoints:

```js
// tailwind.config.js
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    screens: {
      'xs': '475px',
      ...defaultTheme.screens,
    },
  },
  variants: {},
  plugins: [],
}
```

## Max-width breakpoints

If you want to work with max-width breakpoints instead of min-width, you can specify your screens as objects with a `max` key:

```js
// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      '2xl': {'max': '1535px'},
      // => @media (max-width: 1535px) { ... }

      'xl': {'max': '1279px'},
      // => @media (max-width: 1279px) { ... }

      'lg': {'max': '1023px'},
      // => @media (max-width: 1023px) { ... }

      'md': {'max': '767px'},
      // => @media (max-width: 767px) { ... }

      'sm': {'max': '639px'},
      // => @media (max-width: 639px) { ... }
    }
  }
}
```

Make sure to list them in reverse order as compared to min-width breakpoints so that they override each other as expected.

You can even create breakpoints with both `min-width` and `max-width` definitions if necessary, for example:

```js
// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'sm': {'min': '640px', 'max': '767px'},
      'md': {'min': '768px', 'max': '1023px'},
      'lg': {'min': '1024px', 'max': '1279px'},
      'xl': {'min': '1280px', 'max': '1535px'},
      '2xl': {'min': '1536px'},
    },
  }
}
```

## Multi-range breakpoints

Sometimes it can be useful to have a single breakpoint definition apply in multiple ranges.

For example, say you have a sidebar and want your breakpoints to be based on the content-area width rather than the entire viewport. You can simulate this having one of your breakpoints fall back to a smaller breakpoint when the sidebar becomes visible and shrinks the content area:

```js
// tailwind.config.js
module.exports = {
  theme: {
    screens: {
      'sm': '500px',
      'md': [
        // Sidebar appears at 768px, so revert to `sm:` styles between 768px
        // and 868px, after which the main content area is wide enough again to
        // apply the `md:` styles.
        {'min': '668px', 'max': '767px'},
        {'min': '868px'}
      ],
      'lg': '1100px',
      'xl': '1400px',
    }
  }
}
```

## Custom media queries

If you need to provide a completely custom media query for a breakpoint, you can do so using an object with a `raw` key:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      screens: {
        'portrait': {'raw': '(orientation: portrait)'},
        // => @media (orientation: portrait) { ... }
      }
    }
  }
}
```

### Styling for print

The `raw` option can be particularly useful if you need to apply different styles specifically for print.

All you need to do is add a `print` screen under `theme.extend.screens`:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      screens: {
        'print': {'raw': 'print'},
        // => @media print { ... }
      }
    }
  }
}
```

Then you can use classes like `print:text-black` to specify styles that should only be applied when someone tries to print the page you’re working on:

```html
<div class="text-gray-700 print:text-black">
  <!-- ... -->
</div>
```

[←Theme](https://tailwindcss.com/docs/theme)[Colors
  ](https://tailwindcss.com/docs/customizing-colors)



---



# Customizing Colors

Customizing the default color palette for your project.

## Overview

Tailwind includes an expertly-crafted default color palette out-of-the-box that is a great starting point if you don’t have your own specific branding in mind.

Gray

```
colors.coolGray
```

50

\#F9FAFB

100

\#F3F4F6

200

\#E5E7EB

300

\#D1D5DB

400

\#9CA3AF

500

\#6B7280

600

\#4B5563

700

\#374151

800

\#1F2937

900

\#111827

Red

```
colors.red
```

50

\#FEF2F2

100

\#FEE2E2

200

\#FECACA

300

\#FCA5A5

400

\#F87171

500

\#EF4444

600

\#DC2626

700

\#B91C1C

800

\#991B1B

900

\#7F1D1D

Yellow

```
colors.amber
```

50

\#FFFBEB

100

\#FEF3C7

200

\#FDE68A

300

\#FCD34D

400

\#FBBF24

500

\#F59E0B

600

\#D97706

700

\#B45309

800

\#92400E

900

\#78350F

Green

```
colors.emerald
```

50

\#ECFDF5

100

\#D1FAE5

200

\#A7F3D0

300

\#6EE7B7

400

\#34D399

500

\#10B981

600

\#059669

700

\#047857

800

\#065F46

900

\#064E3B

Blue

```
colors.blue
```

50

\#EFF6FF

100

\#DBEAFE

200

\#BFDBFE

300

\#93C5FD

400

\#60A5FA

500

\#3B82F6

600

\#2563EB

700

\#1D4ED8

800

\#1E40AF

900

\#1E3A8A

Indigo

```
colors.indigo
```

50

\#EEF2FF

100

\#E0E7FF

200

\#C7D2FE

300

\#A5B4FC

400

\#818CF8

500

\#6366F1

600

\#4F46E5

700

\#4338CA

800

\#3730A3

900

\#312E81

Purple

```
colors.violet
```

50

\#F5F3FF

100

\#EDE9FE

200

\#DDD6FE

300

\#C4B5FD

400

\#A78BFA

500

\#8B5CF6

600

\#7C3AED

700

\#6D28D9

800

\#5B21B6

900

\#4C1D95

Pink

```
colors.pink
```

50

\#FDF2F8

100

\#FCE7F3

200

\#FBCFE8

300

\#F9A8D4

400

\#F472B6

500

\#EC4899

600

\#DB2777

700

\#BE185D

800

\#9D174D

900

\#831843

But when you do need to customize your palette, you can configure your colors under the `colors` key in the `theme` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      // Configure your color palette here
    }
  }
}
```

When it comes to building a custom color palette, you can either [curate your colors](https://tailwindcss.com/docs/customizing-colors#curating-colors) from our extensive included color palette, or [configure your own custom colors](https://tailwindcss.com/docs/customizing-colors#custom-colors) by adding your specific color values directly.

------

## Curating colors

If you don’t have a set of completely custom colors in mind for your project, you can curate your colors from our complete color palette by importing `'tailwindcss/colors'` into your config file and choosing the colors you like.

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.trueGray,
      indigo: colors.indigo,
      red: colors.rose,
      yellow: colors.amber,
    }
  }
}
```

Don’t forget to include `transparent` and `current` if you’d like those available in your project.

Although each color has a specific name, you’re encouraged to alias them however you like in your own projects. We even do this in the default configuration, aliasing `coolGray` to `gray`, `violet` to `purple`, `amber` to `yellow`, and `emerald` to `green`.

See our [complete color palette reference](https://tailwindcss.com/docs/customizing-colors#color-palette-reference) to see the colors that are available to choose from by default.

------

## Custom colors

You can build a completely custom palette by adding your own color values from scratch:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      blue: {
        light: '#85d7ff',
        DEFAULT: '#1fb6ff',
        dark: '#009eeb',
      },
      pink: {
        light: '#ff7ce5',
        DEFAULT: '#ff49db',
        dark: '#ff16d1',
      },
      gray: {
        darkest: '#1f2d3d',
        dark: '#3c4858',
        DEFAULT: '#c0ccda',
        light: '#e0e6ed',
        lightest: '#f9fafc',
      }
    }
  }
}
```

By default, these colors are automatically shared by all color-driven utilities, like `textColor`, `backgroundColor`, `borderColor`, and more.

------

## Color object syntax

You can see above that we’ve defined our colors using a nested object notation where the nested keys are added to the base color name as modifiers:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      indigo: {
        light: '#b3bcf5',
        DEFAULT: '#5c6ac4',
        dark: '#202e78',
      }
    }
  }
}
```

The different segments of the color name are combined to form class names like `bg-indigo-light`.

Like many other places in Tailwind, the `DEFAULT` key is special and means “no modifier”, so this configuration would generate classes like `text-indigo` and `bg-indigo`, not `text-indigo-DEFAULT` or `bg-indigo-DEFAULT`.

You can also define your colors as simple strings instead of objects:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      'indigo-lighter': '#b3bcf5',
      'indigo': '#5c6ac4',
      'indigo-dark': '#202e78',
    }
  }
}
```

Note that when accessing colors using the `theme()` function you need to use the same notation you used to define them.

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      indigo: {
        // theme('colors.indigo.light')
        light: '#b3bcf5',

        // theme('colors.indigo.DEFAULT')
        DEFAULT: '#5c6ac4',
      },

      // theme('colors.indigo-dark')
      'indigo-dark': '#202e78',
    }
  }
}
```

------

## Extending the defaults

As described in the [theme documentation](https://tailwindcss.com/docs/theme#extending-the-default-theme), if you’d like to extend the default color palette rather than override it, you can do so using the `theme.extend.colors` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        'regal-blue': '#243c5a',
      }
    }
  }
}
```

This will generate classes like `bg-regal-blue` in addition to all of Tailwind’s default colors.

These extensions are merged deeply, so if you’d like to add an additional shade to one of Tailwind’s default colors, you can do so like this:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        blue: {
          450: '#5F99F7'
        },
      }
    }
  }
}
```

This will add classes like `bg-blue-450` without losing existing classes like `bg-blue-400` or `bg-blue-500`.

------

## Disabling a default color

If you’d like to disable a default color because you aren’t using it in your project, the easiest approach is to just build a new color palette that doesn’t include the color you’d like to disable.

For example, this `tailwind.config.js` file excludes teal, orange, and pink, but includes the rest of the default colors:

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      gray: colors.coolGray,
      red: colors.red,
      yellow: colors.amber,
      blue: colors.blue
    }
  }
}
```

Alternatively, you could leave the color palette untouched and rely on [tree-shaking unused styles](https://tailwindcss.com/docs/optimizing-for-production) to remove the colors you’re not using.

------

## Naming your colors

Tailwind uses literal color names *(like red, green, etc.)* and a numeric scale *(where 50 is light and 900 is dark)* by default. This ends up being fairly practical for most projects, but there are good reasons to use other naming conventions as well.

For example, if you’re working on a project that needs to support multiple themes, it might make sense to use more abstract names like `primary` and `secondary`:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      primary: '#5c6ac4',
      secondary: '#ecc94b',
      // ...
    }
  }
}
```

You can configure those colors explicitly like we have above, or you can pull in colors from our complete color palette and alias them:

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      primary: colors.indigo,
      secondary: colors.yellow,
      neutral: colors.gray,
    }
  }
}
```

You could even define these colors using CSS custom properties (variables) to make it easy to switch themes on the client:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      primary: 'var(--color-primary)',
      secondary: 'var(--color-secondary)',
      // ...
    }
  }
}
/* In your CSS */
:root {
  --color-primary: #5c6ac4;
  --color-secondary: #ecc94b;
  /* ... */
}

@tailwind base;
@tailwind components;
@tailwind utilities;
```

*Note that colors defined using custom properties will not work with color opacity utilities like `bg-opacity-50` without additional configuration. See [this example repository](https://github.com/adamwathan/tailwind-css-variable-text-opacity-demo) for more information on how to make this work.*

------

## Generating colors

A common question we get is “how do I generate the 50–900 shades of my own custom colors?“.

Bad news, color is complicated and despite trying dozens of different tools, we’ve yet to find one that does a good job generating these sorts of color palettes. We picked all of Tailwind’s default colors by hand, meticulously balancing them by eye and testing them in real designs to make sure we were happy with them.

------

## Color palette reference

This is a list of all of the colors available when you import `tailwindcss/colors` into your `tailwind.config.js` file.

```js
// tailwind.config.js
const colors = require('tailwindcss/colors')

module.exports = {
  theme: {
    colors: {
      // Build your palette here
      transparent: 'transparent',
      current: 'currentColor',
      gray: colors.trueGray,
      red: colors.red,
      blue: colors.lightBlue,
      yellow: colors.amber,
    }
  }
}
```

Although each color has a specific name, you’re encouraged to alias them however you like in your own projects.

Blue Gray

```
colors.blueGray
```

50

\#F8FAFC

100

\#F1F5F9

200

\#E2E8F0

300

\#CBD5E1

400

\#94A3B8

500

\#64748B

600

\#475569

700

\#334155

800

\#1E293B

900

\#0F172A

Cool Gray

```
colors.coolGray
```

50

\#F9FAFB

100

\#F3F4F6

200

\#E5E7EB

300

\#D1D5DB

400

\#9CA3AF

500

\#6B7280

600

\#4B5563

700

\#374151

800

\#1F2937

900

\#111827

Gray

```
colors.gray
```

50

\#FAFAFA

100

\#F4F4F5

200

\#E4E4E7

300

\#D4D4D8

400

\#A1A1AA

500

\#71717A

600

\#52525B

700

\#3F3F46

800

\#27272A

900

\#18181B

True Gray

```
colors.trueGray
```

50

\#FAFAFA

100

\#F5F5F5

200

\#E5E5E5

300

\#D4D4D4

400

\#A3A3A3

500

\#737373

600

\#525252

700

\#404040

800

\#262626

900

\#171717

Warm Gray

```
colors.warmGray
```

50

\#FAFAF9

100

\#F5F5F4

200

\#E7E5E4

300

\#D6D3D1

400

\#A8A29E

500

\#78716C

600

\#57534E

700

\#44403C

800

\#292524

900

\#1C1917

Red

```
colors.red
```

50

\#FEF2F2

100

\#FEE2E2

200

\#FECACA

300

\#FCA5A5

400

\#F87171

500

\#EF4444

600

\#DC2626

700

\#B91C1C

800

\#991B1B

900

\#7F1D1D

Orange

```
colors.orange
```

50

\#FFF7ED

100

\#FFEDD5

200

\#FED7AA

300

\#FDBA74

400

\#FB923C

500

\#F97316

600

\#EA580C

700

\#C2410C

800

\#9A3412

900

\#7C2D12

Amber

```
colors.amber
```

50

\#FFFBEB

100

\#FEF3C7

200

\#FDE68A

300

\#FCD34D

400

\#FBBF24

500

\#F59E0B

600

\#D97706

700

\#B45309

800

\#92400E

900

\#78350F

Yellow

```
colors.yellow
```

50

\#FEFCE8

100

\#FEF9C3

200

\#FEF08A

300

\#FDE047

400

\#FACC15

500

\#EAB308

600

\#CA8A04

700

\#A16207

800

\#854D0E

900

\#713F12

Lime

```
colors.lime
```

50

\#F7FEE7

100

\#ECFCCB

200

\#D9F99D

300

\#BEF264

400

\#A3E635

500

\#84CC16

600

\#65A30D

700

\#4D7C0F

800

\#3F6212

900

\#365314

Green

```
colors.green
```

50

\#F0FDF4

100

\#DCFCE7

200

\#BBF7D0

300

\#86EFAC

400

\#4ADE80

500

\#22C55E

600

\#16A34A

700

\#15803D

800

\#166534

900

\#14532D

Emerald

```
colors.emerald
```

50

\#ECFDF5

100

\#D1FAE5

200

\#A7F3D0

300

\#6EE7B7

400

\#34D399

500

\#10B981

600

\#059669

700

\#047857

800

\#065F46

900

\#064E3B

Teal

```
colors.teal
```

50

\#F0FDFA

100

\#CCFBF1

200

\#99F6E4

300

\#5EEAD4

400

\#2DD4BF

500

\#14B8A6

600

\#0D9488

700

\#0F766E

800

\#115E59

900

\#134E4A

Cyan

```
colors.cyan
```

50

\#ECFEFF

100

\#CFFAFE

200

\#A5F3FC

300

\#67E8F9

400

\#22D3EE

500

\#06B6D4

600

\#0891B2

700

\#0E7490

800

\#155E75

900

\#164E63

Light Blue

```
colors.lightBlue
```

50

\#F0F9FF

100

\#E0F2FE

200

\#BAE6FD

300

\#7DD3FC

400

\#38BDF8

500

\#0EA5E9

600

\#0284C7

700

\#0369A1

800

\#075985

900

\#0C4A6E

Blue

```
colors.blue
```

50

\#EFF6FF

100

\#DBEAFE

200

\#BFDBFE

300

\#93C5FD

400

\#60A5FA

500

\#3B82F6

600

\#2563EB

700

\#1D4ED8

800

\#1E40AF

900

\#1E3A8A

Indigo

```
colors.indigo
```

50

\#EEF2FF

100

\#E0E7FF

200

\#C7D2FE

300

\#A5B4FC

400

\#818CF8

500

\#6366F1

600

\#4F46E5

700

\#4338CA

800

\#3730A3

900

\#312E81

Violet

```
colors.violet
```

50

\#F5F3FF

100

\#EDE9FE

200

\#DDD6FE

300

\#C4B5FD

400

\#A78BFA

500

\#8B5CF6

600

\#7C3AED

700

\#6D28D9

800

\#5B21B6

900

\#4C1D95

Purple

```
colors.purple
```

50

\#FAF5FF

100

\#F3E8FF

200

\#E9D5FF

300

\#D8B4FE

400

\#C084FC

500

\#A855F7

600

\#9333EA

700

\#7E22CE

800

\#6B21A8

900

\#581C87

Fuchsia

```
colors.fuchsia
```

50

\#FDF4FF

100

\#FAE8FF

200

\#F5D0FE

300

\#F0ABFC

400

\#E879F9

500

\#D946EF

600

\#C026D3

700

\#A21CAF

800

\#86198F

900

\#701A75

Pink

```
colors.pink
```

50

\#FDF2F8

100

\#FCE7F3

200

\#FBCFE8

300

\#F9A8D4

400

\#F472B6

500

\#EC4899

600

\#DB2777

700

\#BE185D

800

\#9D174D

900

\#831843

Rose

```
colors.rose
```

50

\#FFF1F2

100

\#FFE4E6

200

\#FECDD3

300

\#FDA4AF

400

\#FB7185

500

\#F43F5E

600

\#E11D48

700

\#BE123C

800

\#9F1239

900

\#881337

[←Breakpoints](https://tailwindcss.com/docs/breakpoints)[Spacing
  ](https://tailwindcss.com/docs/customizing-spacing)



---



# Customizing Spacing

Customizing the default spacing and sizing scale for your project.

Use the `spacing` key in the `theme` section of your `tailwind.config.js` file to customize Tailwind’s [default spacing/sizing scale](https://tailwindcss.com/docs/customizing-spacing#default-spacing-scale).

```js
// tailwind.config.js
module.exports = {
  theme: {
    spacing: {
      '1': '8px',
      '2': '12px',
      '3': '16px',
      '4': '24px',
      '5': '32px',
      '6': '48px',
    }
  }
}
```

By default the spacing scale is inherited by the `padding`, `margin`, `width`, `height`, `maxHeight`, `gap`, `inset`, `space`, and `translate` core plugins.

------

## Extending the default spacing scale

As described in the [theme documentation](https://tailwindcss.com/docs/theme#extending-the-default-theme), if you’d like to extend the default spacing scale, you can do so using the `theme.extend.spacing` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      spacing: {
        '13': '3.25rem',
        '15': '3.75rem',
        '128': '32rem',
        '144': '36rem',
      }
    }
  }
}
```

This will generate classes like `p-13`, `m-15`, and `h-128` in addition to all of Tailwind’s default spacing/sizing utilities.

------

## Overriding the default spacing scale

As described in the [theme documentation](https://tailwindcss.com/docs/theme#overriding-the-default-theme), if you’d like to override the default spacing scale, you can do so using the `theme.spacing` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  theme: {
    spacing: {
      sm: '8px',
      md: '12px',
      lg: '16px',
      xl: '24px',
    }
  }
}
```

This will disable Tailwind’s default spacing scale and generate classes like `p-sm`, `m-md`, `w-lg`, and `h-xl` instead.

------

## Default spacing scale

By default, Tailwind includes a generous and comprehensive numeric spacing scale. The values are proportional, so `16` is twice as much spacing as `8` for example. One spacing unit is equal to `0.25rem`, which translates to `4px` by default in common browsers.

| Name | Size     | Pixels | Preview |
| ---- | -------- | ------ | ------- |
| 0    | 0px      | 0px    |         |
| px   | 1px      | 1px    |         |
| 0.5  | 0.125rem | 2px    |         |
| 1    | 0.25rem  | 4px    |         |
| 1.5  | 0.375rem | 6px    |         |
| 2    | 0.5rem   | 8px    |         |
| 2.5  | 0.625rem | 10px   |         |
| 3    | 0.75rem  | 12px   |         |
| 3.5  | 0.875rem | 14px   |         |
| 4    | 1rem     | 16px   |         |
| 5    | 1.25rem  | 20px   |         |
| 6    | 1.5rem   | 24px   |         |
| 7    | 1.75rem  | 28px   |         |
| 8    | 2rem     | 32px   |         |
| 9    | 2.25rem  | 36px   |         |
| 10   | 2.5rem   | 40px   |         |
| 11   | 2.75rem  | 44px   |         |
| 12   | 3rem     | 48px   |         |
| 14   | 3.5rem   | 56px   |         |
| 16   | 4rem     | 64px   |         |
| 20   | 5rem     | 80px   |         |
| 24   | 6rem     | 96px   |         |
| 28   | 7rem     | 112px  |         |
| 32   | 8rem     | 128px  |         |
| 36   | 9rem     | 144px  |         |
| 40   | 10rem    | 160px  |         |
| 44   | 11rem    | 176px  |         |
| 48   | 12rem    | 192px  |         |
| 52   | 13rem    | 208px  |         |
| 56   | 14rem    | 224px  |         |
| 60   | 15rem    | 240px  |         |
| 64   | 16rem    | 256px  |         |
| 72   | 18rem    | 288px  |         |
| 80   | 20rem    | 320px  |         |
| 96   | 24rem    | 384px  |         |

[←Colors](https://tailwindcss.com/docs/customizing-colors)[Variants
  ](https://tailwindcss.com/docs/configuring-variants)



---



# Customizing Spacing

Customizing the default spacing and sizing scale for your project.

Use the `spacing` key in the `theme` section of your `tailwind.config.js` file to customize Tailwind’s [default spacing/sizing scale](https://tailwindcss.com/docs/customizing-spacing#default-spacing-scale).

```js
// tailwind.config.js
module.exports = {
  theme: {
    spacing: {
      '1': '8px',
      '2': '12px',
      '3': '16px',
      '4': '24px',
      '5': '32px',
      '6': '48px',
    }
  }
}
```

By default the spacing scale is inherited by the `padding`, `margin`, `width`, `height`, `maxHeight`, `gap`, `inset`, `space`, and `translate` core plugins.

------

## Extending the default spacing scale

As described in the [theme documentation](https://tailwindcss.com/docs/theme#extending-the-default-theme), if you’d like to extend the default spacing scale, you can do so using the `theme.extend.spacing` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      spacing: {
        '13': '3.25rem',
        '15': '3.75rem',
        '128': '32rem',
        '144': '36rem',
      }
    }
  }
}
```

This will generate classes like `p-13`, `m-15`, and `h-128` in addition to all of Tailwind’s default spacing/sizing utilities.

------

## Overriding the default spacing scale

As described in the [theme documentation](https://tailwindcss.com/docs/theme#overriding-the-default-theme), if you’d like to override the default spacing scale, you can do so using the `theme.spacing` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  theme: {
    spacing: {
      sm: '8px',
      md: '12px',
      lg: '16px',
      xl: '24px',
    }
  }
}
```

This will disable Tailwind’s default spacing scale and generate classes like `p-sm`, `m-md`, `w-lg`, and `h-xl` instead.

------

## Default spacing scale

By default, Tailwind includes a generous and comprehensive numeric spacing scale. The values are proportional, so `16` is twice as much spacing as `8` for example. One spacing unit is equal to `0.25rem`, which translates to `4px` by default in common browsers.

| Name | Size     | Pixels | Preview |
| ---- | -------- | ------ | ------- |
| 0    | 0px      | 0px    |         |
| px   | 1px      | 1px    |         |
| 0.5  | 0.125rem | 2px    |         |
| 1    | 0.25rem  | 4px    |         |
| 1.5  | 0.375rem | 6px    |         |
| 2    | 0.5rem   | 8px    |         |
| 2.5  | 0.625rem | 10px   |         |
| 3    | 0.75rem  | 12px   |         |
| 3.5  | 0.875rem | 14px   |         |
| 4    | 1rem     | 16px   |         |
| 5    | 1.25rem  | 20px   |         |
| 6    | 1.5rem   | 24px   |         |
| 7    | 1.75rem  | 28px   |         |
| 8    | 2rem     | 32px   |         |
| 9    | 2.25rem  | 36px   |         |
| 10   | 2.5rem   | 40px   |         |
| 11   | 2.75rem  | 44px   |         |
| 12   | 3rem     | 48px   |         |
| 14   | 3.5rem   | 56px   |         |
| 16   | 4rem     | 64px   |         |
| 20   | 5rem     | 80px   |         |
| 24   | 6rem     | 96px   |         |
| 28   | 7rem     | 112px  |         |
| 32   | 8rem     | 128px  |         |
| 36   | 9rem     | 144px  |         |
| 40   | 10rem    | 160px  |         |
| 44   | 11rem    | 176px  |         |
| 48   | 12rem    | 192px  |         |
| 52   | 13rem    | 208px  |         |
| 56   | 14rem    | 224px  |         |
| 60   | 15rem    | 240px  |         |
| 64   | 16rem    | 256px  |         |
| 72   | 18rem    | 288px  |         |
| 80   | 20rem    | 320px  |         |
| 96   | 24rem    | 384px  |         |

[←Colors](https://tailwindcss.com/docs/customizing-colors)[Variants
  ](https://tailwindcss.com/docs/configuring-variants)



---



# Plugins

Extending Tailwind with reusable third-party plugins.

## Overview

Plugins let you register new styles for Tailwind to inject into the user’s stylesheet using JavaScript instead of CSS.

To get started with your first plugin, import Tailwind’s `plugin` function from `tailwindcss/plugin`. Then inside your `plugins` array, and call it with an anonymous function as the first argument.

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities, addComponents, e, prefix, config }) {
      // Add your custom styles here
    }),
  ]
}
```

Plugin functions receive a single object argument that can be [destructured](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment) into several helper functions:

- `addUtilities()`, for registering new utility styles
- `addComponents()`, for registering new component styles
- `addBase()`, for registering new base styles
- `addVariant()`, for registering custom variants
- `e()`, for escaping strings meant to be used in class names
- `prefix()`, for manually applying the user’s configured prefix to parts of a selector
- `theme()`, for looking up values in the user’s theme configuration
- `variants()`, for looking up values in the user’s variants configuration
- `config()`, for looking up values in the user’s Tailwind configuration
- `postcss`, for doing low-level manipulation with [PostCSS](https://api.postcss.org/postcss.html) directly

------

## Official plugins

We’ve developed a handful of official plugins for popular features that for one reason or another don’t belong in core yet.

Plugins can be added to your project by installing them via npm, then adding them to your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  // ...
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio'),
  ]
}
```

### Typography

The `@tailwindcss/typography` plugin adds a set of `prose` classes that can be used to quickly add sensible typographic styles to content blocks that come from sources like markdown or a CMS database.

```html
<article class="prose lg:prose-xl">
  <h1>Garlic bread with cheese: What the science tells us</h1>
  <p>
    For years parents have espoused the health benefits of eating garlic bread with cheese to their
    children, with the food earning such an iconic status in our culture that kids will often dress
    up as warm, cheesy loaf for Halloween.
  </p>
  <p>
    But a recent study shows that the celebrated appetizer may be linked to a series of rabies cases
    springing up around the country.
  </p>
  <!-- ... -->
</article>
```

[Learn more about the typography plugin →](https://github.com/tailwindlabs/tailwindcss-typography)

### Forms

The `@tailwindcss/forms` plugin adds an opinionated form reset layer that makes it easier to style form elements with utility classes.

```html
<!-- You can actually customize padding on a select element: -->
<select class="px-4 py-3 rounded-full">
  <!-- ... -->
</select>

<!-- Or change a checkbox color using text color utilities: -->
<input type="checkbox" class="rounded text-pink-500" />
```

[Learn more about the forms plugin →](https://github.com/tailwindlabs/tailwindcss-forms)

### Line-clamp

The `@tailwindcss/line-clamp` plugin adds `line-clamp-{lines}` classes you can use to truncate text to a fixed number of lines.

```html
<p class="line-clamp-3 md:line-clamp-none">
  Et molestiae hic earum repellat aliquid est doloribus delectus. Enim illum odio porro ut omnis
  dolor debitis natus. Voluptas possimus deserunt sit delectus est saepe nihil. Qui voluptate
  possimus et quia. Eligendi voluptas voluptas dolor cum. Rerum est quos quos id ut molestiae fugit.
</p>
```

[Learn more about the line-clamp plugin →](https://github.com/tailwindlabs/tailwindcss-line-clamp)

### Aspect ratio

The `@tailwindcss/aspect-ratio` plugin adds `aspect-w-{n}` and `aspect-h-{n}` classes that can be combined to give an element a fixed aspect ratio.

```html
<div class="aspect-w-16 aspect-h-9">
  <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
```

[Learn more about the aspect ratio plugin →](https://github.com/tailwindlabs/tailwindcss-aspect-ratio)

------

## Adding utilities

The `addUtilities` function allows you to register new styles in Tailwind’s `utilities` layer.

Plugin utilities are output in the order they are registered, *after* built-in utilities, so if a plugin targets any of the same properties as a built-in utility, the plugin utility will take precedence.

To add new utilities from a plugin, call `addUtilities`, passing in your styles using [CSS-in-JS syntax](https://tailwindcss.com/docs/plugins#css-in-js-syntax):

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        '.skew-10deg': {
          transform: 'skewY(-10deg)',
        },
        '.skew-15deg': {
          transform: 'skewY(-15deg)',
        },
      }

      addUtilities(newUtilities)
    })
  ]
}
```

### Prefix and important preferences

By default, plugin utilities automatically respect the user’s [`prefix`](https://tailwindcss.com/docs/configuration#prefix) and [`important`](https://tailwindcss.com/docs/configuration#important) preferences.

That means that given this Tailwind configuration:

```js
// tailwind.config.js
module.exports = {
  prefix: 'tw-',
  important: true,
  // ...
}
```

…the example plugin above would generate the following CSS:

```css
.tw-skew-10deg {
  transform: skewY(-10deg) !important;
}
.tw-skew-15deg {
  transform: skewY(-15deg) !important;
}
```

If necessary, you can opt out of this behavior by passing an options object as a second parameter to `addUtilities`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, {
        respectPrefix: false,
        respectImportant: false,
      })
    })
  ]
}
```

### Variants

To generate responsive, hover, focus, active, or other variants of your styles, specify the variants you’d like to generate using the `variants` option:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, {
        variants: ['responsive', 'hover'],
      })
    })
  ]
}
```

If you only need to specify variants and don’t need to opt-out of the default prefix or important options, you can also pass the array of variants as the second parameter directly:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    })
  ]
}
```

If you’d like the user to provide the variants themselves under the `variants` section in their `tailwind.config.js` file, you can use the `variants()` function to get the variants they have configured:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  variants: {
    customPlugin: ['responsive', 'hover'],
  },
  plugins: [
    plugin(function({ addUtilities, variants }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, variants('customPlugin'))
    })
  ]
}
```

------

## Adding components

The `addComponents` function allows you to register new styles in Tailwind’s `components` layer.

Use it to add more opinionated, complex classes like buttons, form controls, alerts, etc; the sort of pre-built components you often see in other frameworks that you might need to override with utility classes.

To add new component styles from a plugin, call `addComponents`, passing in your styles using [CSS-in-JS syntax](https://tailwindcss.com/docs/plugins#css-in-js-syntax):

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const buttons = {
        '.btn': {
          padding: '.5rem 1rem',
          borderRadius: '.25rem',
          fontWeight: '600',
        },
        '.btn-blue': {
          backgroundColor: '#3490dc',
          color: '#fff',
          '&:hover': {
            backgroundColor: '#2779bd'
          },
        },
        '.btn-red': {
          backgroundColor: '#e3342f',
          color: '#fff',
          '&:hover': {
            backgroundColor: '#cc1f1a'
          },
        },
      }

      addComponents(buttons)
    })
  ]
}
```

### Prefix and important preferences

By default, component classes automatically respect the user’s `prefix` preference, but **they are not affected** by the user’s `important` preference.

That means that given this Tailwind configuration:

```js
// tailwind.config.js
module.exports = {
  prefix: 'tw-',
  important: true,
  // ...
}
```

…the example plugin above would generate the following CSS:

```css
.tw-btn {
  padding: .5rem 1rem;
  border-radius: .25rem;
  font-weight: 600;
}
.tw-btn-blue {
  background-color: #3490dc;
  color: #fff;
}
.tw-btn-blue:hover {
  background-color: #2779bd;
}
.tw-btn-blue {
  background-color: #e3342f;
  color: #fff;
}
.tw-btn-blue:hover {
  background-color: #cc1f1a;
}
```

Although there’s rarely a good reason to make component declarations important, if you really need to do it you can always add `!important` manually:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const buttons = {
        '.btn': {
          padding: '.5rem 1rem !important',
          borderRadius: '.25rem !important',
          fontWeight: '600 !important',
        },
        // ...
      }

      addComponents(buttons)
    })
  ]
}
```

All classes in a selector will be prefixed by default, so if you add a more complex style like:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  prefix: 'tw-',
  plugins: [
    plugin(function({ addComponents }) {
      const components = {
        // ...
        '.navbar-inverse a.nav-link': {
            color: '#fff',
        }
      }

      addComponents(components)
    })
  ]
}
```

…the following CSS would be generated:

```css
.tw-navbar-inverse a.tw-nav-link {
    color: #fff;
}
```

To opt out of prefixing, pass an options object as a second parameter to `addComponents`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  prefix: 'tw-',
  plugins: [
    plugin(function({ addComponents }) {
      const components = {
        // ...
      }

      addComponents(components, {
        respectPrefix: false
      })
    })
  ]
}
```

### Variants

To generate responsive, hover, focus, active, or other variants of your components, specify the variants you’d like to generate using the `variants` option:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const newComponents = {
        // ...
      }

      addComponents(newComponents, {
        variants: ['responsive', 'hover'],
      })
    })
  ]
}
```

If you only need to specify variants and don’t need to opt-out of the default prefix or important options, you can also pass the array of variants as the second parameter directly:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const newComponents = {
        // ...
      }

      addComponents(newComponents, ['responsive', 'hover'])
    })
  ]
}
```

If you’d like the user to provide the variants themselves under the `variants` section in their `tailwind.config.js` file, you can use the `variants()` function to get the variants they have configured:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  variants: {
    customPlugin: ['responsive', 'hover'],
  },
  plugins: [
    plugin(function({ addComponents, variants }) {
      const newComponents = {
        // ...
      }

      addComponents(newComponents, variants('customPlugin'))
    })
  ]
}
```

------

## Adding base styles

The `addBase` function allows you to register new styles in Tailwind’s `base` layer.

Use it to add things like base typography styles, opinionated global resets, or `@font-face` rules.

To add new base styles from a plugin, call `addBase`, passing in your styles using [CSS-in-JS syntax](https://tailwindcss.com/docs/plugins#css-in-js-syntax):

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addBase, theme }) {
      addBase({
        'h1': { fontSize: theme('fontSize.2xl') },
        'h2': { fontSize: theme('fontSize.xl') },
        'h3': { fontSize: theme('fontSize.lg') },
      })
    })
  ]
}
```

Since base styles are meant to target bare selectors like `div`, `h1`, etc., they do not respect the user’s `prefix` or `important` configuration.

------

## Escaping class names

If your plugin generates classes that contain user-provided strings, you can use the `e` function to escape those class names to make sure non-standard characters are handled properly automatically.

For example, this plugin generates a set of `.rotate-{angle}` utilities where `{angle}` is a user provided string. The `e` function is used to escape the concatenated class name to make sure classes like `.rotate-1/4` work as expected:

```js
// tailwind.config.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = {
  theme: {
    rotate: {
      '1/4': '90deg',
      '1/2': '180deg',
      '3/4': '270deg',
    }
  },
  plugins: [
    plugin(function({ addUtilities, theme, e }) {
      const rotateUtilities = _.map(theme('rotate'), (value, key) => {
        return {
          [`.${e(`rotate-${key}`)}`]: {
            transform: `rotate(${value})`
          }
        }
      })

      addUtilities(rotateUtilities)
    })
  ]
}
```

This plugin would generate the following CSS:

```css
.rotate-1\/4 {
  transform: rotate(90deg);
}
.rotate-1\/2 {
  transform: rotate(180deg);
}
.rotate-3\/4 {
  transform: rotate(270deg);
}
```

Be careful to only escape content you actually want to escape; don’t pass the leading `.` in a class name or the `:` at the beginning pseudo-classes like `:hover` or `:focus` or those characters will be escaped.

Additionally, because CSS has rules about the characters a class name can *start* with (a class can’t start with a number, but it can contain one), it’s a good idea to escape your complete class name (not just the user-provided portion) or you may end up with unnecessary escape sequences:

```js
// Will unnecessarily escape `1`
`.rotate-${e('1/4')}`
// => '.rotate-\31 \/4'

// Won't escape `1` because it's not the first character
`.${e('rotate-1/4')}`
// => '.rotate-1\/4'
```

------

## Manually prefixing selectors

If you’re writing something complex where you only want to prefix certain classes, you can use the `prefix` function to have fine-grained control of when the user’s configured prefix is applied.

For example, if you’re creating a plugin to be reused across a set of internal projects that includes existing classes in its selectors, you might only want to prefix the new classes:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  prefix: 'tw-',
  plugins: [
    plugin(function({ addComponents, prefix }) {
      addComponents({
        [`.existing-class > ${prefix('.new-class')}`]: {
          backgroundColor: '#fff',
        }
      })
    })
  ]
}
```

This would generate the following CSS:

```css
.existing-class > .tw-new-class {
  background-color: #fff;
}
```

The `prefix` function will prefix all classes in a selector and ignore non-classes, so it’s totally safe to pass complex selectors like this one:

```js
prefix('.btn-blue .w-1\/4 > h1.text-xl + a .bar')
// => '.tw-btn-blue .tw-w-1\/4 > h1.tw-text-xl + a .tw-bar'
```

------

## Referencing the user's config

The `config`, `theme`, and `variants` functions allow you to ask for a value from the user’s Tailwind configuration using dot notation, providing a default value if that path doesn’t exist.

For example, this simplified version of the built-in [container](https://tailwindcss.com/docs/container) plugin uses the `theme` function to get the user’s configured breakpoints:

```js
// tailwind.config.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents, theme }) {
      const screens = theme('screens', {})

      const mediaQueries = _.map(screens, width => {
        return {
          [`@media (min-width: ${width})`]: {
            '.container': {
              'max-width': width,
            },
          },
        }
      })

      addComponents([
        { '.container': { width: '100%' } },
        ...mediaQueries,
      ])
    })
  ]
}
```

If you’d like to reference the user’s `variants` configuration, it’s recommended that you use the `variants()` function instead of the config function.

**Don't use the config function to look up variants**

```js
addUtilities(newUtilities, config('variants.customPlugin'))
```

**Use the variants function instead**

```js
addUtilities(newUtilities, variants('customPlugin'))
```

Since `variants` could simply be a global list of variants to configure for every plugin in the whole project, using the `variants()` function lets you easily respect the user’s configuration without reimplementing that logic yourself.

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  variants: ['responsive', 'hover', 'focus'],
  plugins: [
    plugin(function ({ config, variants }) {
      config('variants.customPlugin')
      // => undefined

      variants('customPlugin')
      // => ['responsive', 'hover', 'focus']
    })
  ]
}
```

------

## Exposing options

It often makes sense for a plugin to expose its own options that the user can configure to customize the plugin’s behavior.

The best way to accomplish this is to claim your own key in the user’s `theme` and `variants` configuration and ask them to provide any options there so you can access them with the `theme` and `variants` functions.

For example, here’s a plugin *(extracted to its own module)* for creating simple gradient utilities that accepts the gradients and variants to generate as options:

```js
// ./plugins/gradients.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = plugin(function({ addUtilities, e, theme, variants }) {
  const gradients = theme('gradients', {})
  const gradientVariants = variants('gradients', [])

  const utilities = _.map(gradients, ([start, end], name) => ({
    [`.${e(`bg-gradient-${name}`)}`]: {
      backgroundImage: `linear-gradient(to right, ${start}, ${end})`
    }
  }))

  addUtilities(utilities, gradientVariants)
})
```

To use it, you’d `require` it in your plugins list, specifying your configuration under the `gradients` key in both `theme` and `variants`:

```js
// tailwind.config.js
module.exports = {
  theme: {
    gradients: theme => ({
      'blue-green': [theme('colors.blue.500'), theme('colors.green.500')],
      'purple-blue': [theme('colors.purple.500'), theme('colors.blue.500')],
      // ...
    })
  },
  variants: {
    gradients: ['responsive', 'hover'],
  },
  plugins: [
    require('./plugins/gradients')
  ],
}
```

### Providing default options

To provide default `theme` and `variants` options for your plugin, pass a second argument to Tailwind’s `plugin` function that includes your defaults:

```js
// ./plugins/gradients.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = plugin(function({ addUtilities, e, theme, variants }) {
  // ...
}, {
  theme: {
    gradients: theme => ({
      'blue-green': [theme('colors.blue.500'), theme('colors.green.500')],
      'purple-blue': [theme('colors.purple.500'), theme('colors.blue.500')],
      // ...
    })
  },
  variants: {
    gradients: ['responsive', 'hover'],
  }
})
```

This object is just another [Tailwind configuration object](https://tailwindcss.com/docs/configuration) and has all of the same properties and features as the config object you’re used to working with in `tailwind.config.js`.

By providing your defaults this way, end users will be able to [override](https://tailwindcss.com/docs/theme#overriding-the-default-theme) and [extend](https://tailwindcss.com/docs/theme#extending-the-default-theme) your defaults the same way they can with Tailwind’s built-in styles.

### Exposing advanced configuration options

Sometimes it makes sense for a plugin to be configurable in a way that doesn’t really belong under `theme` or `variants`, like perhaps you want users to be able to customize the class name your plugin uses.

For cases like this, you can use `plugin.withOptions` to define a plugin that can be invoked with a configuration object. This API is similar to the regular `plugin` API, except each argument should be a function that receives the user’s `options` and returns the value that you would have normally passed in using the regular API:

```js
// ./plugins/gradients.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = plugin.withOptions(function (options) {
  return function({ addUtilities, e, theme, variants }) {
    const classPrefix = options.classPrefix ?? 'bg-gradient'
    const gradients = theme('gradients', {})
    const gradientVariants = variants('gradients', [])

    const utilities = _.map(gradients, ([start, end], name) => ({
      [`.${e(`${classPrefix}-${name}`)}`]: {
        backgroundImage: `linear-gradient(to right, ${start}, ${end})`
      }
    }))

    addUtilities(utilities, gradientVariants)
  })
}, function (options) {
  return {
    theme: {
      gradients: theme => ({
        'blue-green': [theme('colors.blue.500'), theme('colors.green.500')],
        'purple-blue': [theme('colors.purple.500'), theme('colors.blue.500')],
        // ...
      })
    },
    variants: {
      gradients: ['responsive', 'hover'],
    }
  }
})
```

The user would invoke your plugin passing along their options when registering it in their `plugins` configuration:

```js
// tailwind.config.js
module.exports = {
  theme: {
    // ...
  },
  variants: {
    // ...
  },
  plugins: [
    require('./plugins/gradients')({
      classPrefix: 'bg-grad'
    })
  ],
}
```

The user can also register plugins created this way normally without invoking them if they don’t need to pass in any custom options:

```js
// tailwind.config.js
module.exports = {
  theme: {
    // ...
  },
  variants: {
    // ...
  },
  plugins: [
    require('./plugins/gradients')
  ],
}
```

------

## CSS-in-JS syntax

Each of `addUtilities`, `addComponents`, and `addBase` expect CSS rules written as JavaScript objects. Tailwind uses the same sort of syntax you might recognize from CSS-in-JS libraries like [Emotion](https://emotion.sh/docs/object-styles), and is powered by [postcss-js](https://github.com/postcss/postcss-js) under the hood.

Consider this simple CSS rule:

```css
.card {
  background-color: #fff;
  border-radius: .25rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
```

Translating this to a CSS-in-JS object would look like this:

```js
addComponents({
  '.card': {
    'background-color': '#fff',
    'border-radius': '.25rem',
    'box-shadow': '0 2px 4px rgba(0,0,0,0.2)',
  }
})
```

For convenience, property names can also be written in camelCase and will be automatically translated to dash-case:

```js
addComponents({
  '.card': {
    backgroundColor: '#fff',
    borderRadius: '.25rem',
    boxShadow: '0 2px 4px rgba(0,0,0,0.2)',
  }
})
```

Nesting is also supported (powered by [postcss-nested](https://github.com/postcss/postcss-nested)), using the same syntax you might be familiar with from Sass or Less:

```js
addComponents({
  '.card': {
    backgroundColor: '#fff',
    borderRadius: '.25rem',
    boxShadow: '0 2px 4px rgba(0,0,0,0.2)',
    '&:hover': {
      boxShadow: '0 10px 15px rgba(0,0,0,0.2)',
    },
    '@media (min-width: 500px)': {
      borderRadius: '.5rem',
    }
  }
})
```

Multiple rules can be defined in the same object:

```js
addComponents({
  '.btn': {
    padding: '.5rem 1rem',
    borderRadius: '.25rem',
    fontWeight: '600',
  },
  '.btn-blue': {
    backgroundColor: '#3490dc',
    color: '#fff',
    '&:hover': {
      backgroundColor: '#2779bd'
    },
  },
  '.btn-red': {
    backgroundColor: '#e3342f',
    color: '#fff',
    '&:hover': {
      backgroundColor: '#cc1f1a'
    },
  },
})
```

…or as an array of objects in case you need to repeat the same key:

```js
addComponents([
  {
    '@media (min-width: 500px)': {
      // ...
    }
  },
  {
    '@media (min-width: 500px)': {
      // ...
    }
  },
  {
    '@media (min-width: 500px)': {
      // ...
    }
  },
])
```

------

## Adding variants

The `addVariant` function allows you to register your own custom [variants](https://tailwindcss.com/docs/hover-focus-and-other-states) that can be used just like the built-in hover, focus, active, etc. variants.

To add a new variant, call the `addVariant` function, passing in the name of your custom variant, and a callback that modifies the affected CSS rules as needed.

```js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant, e }) {
      addVariant('disabled', ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`disabled${separator}${className}`)}:disabled`
        })
      })
    })
  ]
}
```

The callback receives an object that can be destructured into the following parts:

- `modifySelectors`, a helper function to simplify adding basic variants
- `separator`, the user’s configured [separator string](https://tailwindcss.com/docs/configuration#separator)
- `container`, a [PostCSS Container](http://api.postcss.org/Container.html) containing all of the rules the variant is being applied to, for creating complex variants

### Basic variants

If you want to add a simple variant that only needs to change the selector, use the `modifySelectors` helper.

The `modifySelectors` helper accepts a function that receives an object that can be destructured into the following parts:

- `selector`, the complete unmodified selector for the current rule
- `className`, the class name of the current rule *with the leading dot removed*

The function you pass to `modifySelectors` should simply return the modified selector.

For example, a `first-child` variant plugin could be written like this:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant, e }) {
      addVariant('first-child', ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`first-child${separator}${className}`)}:first-child`
        })
      })
    })
  ]
}
```

### Complex variants

If you need to do anything beyond simply modifying selectors (like changing the actual rule declarations, or wrapping the rules in another at-rule), you’ll need to use the `container` instance.

Using the `container` instance, you can traverse all of the rules within a given module or `@variants` block and manipulate them however you like using the standard PostCSS API.

For example, this plugin creates an `important` version of each affected utility by prepending the class with an exclamation mark and modifying each declaration to be `important`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant }) {
      addVariant('important', ({ container }) => {
        container.walkRules(rule => {
          rule.selector = `.\\!${rule.selector.slice(1)}`
          rule.walkDecls(decl => {
            decl.important = true
          })
        })
      })
    })
  ]
}
```

This plugin takes all of the rules inside the container, wraps them in a `@supports (display: grid)` at-rule, and prefixes each rule with `supports-grid`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant, e, postcss }) {
      addVariant('supports-grid', ({ container, separator }) => {
        const supportsRule = postcss.atRule({ name: 'supports', params: '(display: grid)' })
        supportsRule.append(container.nodes)
        container.append(supportsRule)
        supportsRule.walkRules(rule => {
          rule.selector = `.${e(`supports-grid${separator}${rule.selector.slice(1)}`)}`
        })
      })
    })
  ]
}
```

To learn more about working with PostCSS directly, check out the [PostCSS API documentation](http://api.postcss.org/Container.html).

### Using custom variants

Using custom variants is no different than using Tailwind’s built-in variants.

To use custom variants with Tailwind’s core plugins, add them to the `variants` section of your config file:

```js
// tailwind.config.js
modules.exports = {
  variants: {
    borderWidths: ['responsive', 'hover', 'focus', 'first-child', 'disabled'],
  }
}
```

To use custom variants with custom utilities in your own CSS, use the [variants at-rule](https://tailwindcss.com/docs/functions-and-directives#variants):

```css
@variants hover, first-child {
  .bg-cover-image {
    background-image: url('/path/to/image.jpg');
  }
}
```

[←Variants](https://tailwindcss.com/docs/configuring-variants)[Presets
  ](https://tailwindcss.com/docs/presets)



---



# Plugins

Extending Tailwind with reusable third-party plugins.

## Overview

Plugins let you register new styles for Tailwind to inject into the user’s stylesheet using JavaScript instead of CSS.

To get started with your first plugin, import Tailwind’s `plugin` function from `tailwindcss/plugin`. Then inside your `plugins` array, and call it with an anonymous function as the first argument.

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities, addComponents, e, prefix, config }) {
      // Add your custom styles here
    }),
  ]
}
```

Plugin functions receive a single object argument that can be [destructured](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/Destructuring_assignment) into several helper functions:

- `addUtilities()`, for registering new utility styles
- `addComponents()`, for registering new component styles
- `addBase()`, for registering new base styles
- `addVariant()`, for registering custom variants
- `e()`, for escaping strings meant to be used in class names
- `prefix()`, for manually applying the user’s configured prefix to parts of a selector
- `theme()`, for looking up values in the user’s theme configuration
- `variants()`, for looking up values in the user’s variants configuration
- `config()`, for looking up values in the user’s Tailwind configuration
- `postcss`, for doing low-level manipulation with [PostCSS](https://api.postcss.org/postcss.html) directly

------

## Official plugins

We’ve developed a handful of official plugins for popular features that for one reason or another don’t belong in core yet.

Plugins can be added to your project by installing them via npm, then adding them to your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  // ...
  plugins: [
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/line-clamp'),
    require('@tailwindcss/aspect-ratio'),
  ]
}
```

### Typography

The `@tailwindcss/typography` plugin adds a set of `prose` classes that can be used to quickly add sensible typographic styles to content blocks that come from sources like markdown or a CMS database.

```html
<article class="prose lg:prose-xl">
  <h1>Garlic bread with cheese: What the science tells us</h1>
  <p>
    For years parents have espoused the health benefits of eating garlic bread with cheese to their
    children, with the food earning such an iconic status in our culture that kids will often dress
    up as warm, cheesy loaf for Halloween.
  </p>
  <p>
    But a recent study shows that the celebrated appetizer may be linked to a series of rabies cases
    springing up around the country.
  </p>
  <!-- ... -->
</article>
```

[Learn more about the typography plugin →](https://github.com/tailwindlabs/tailwindcss-typography)

### Forms

The `@tailwindcss/forms` plugin adds an opinionated form reset layer that makes it easier to style form elements with utility classes.

```html
<!-- You can actually customize padding on a select element: -->
<select class="px-4 py-3 rounded-full">
  <!-- ... -->
</select>

<!-- Or change a checkbox color using text color utilities: -->
<input type="checkbox" class="rounded text-pink-500" />
```

[Learn more about the forms plugin →](https://github.com/tailwindlabs/tailwindcss-forms)

### Line-clamp

The `@tailwindcss/line-clamp` plugin adds `line-clamp-{lines}` classes you can use to truncate text to a fixed number of lines.

```html
<p class="line-clamp-3 md:line-clamp-none">
  Et molestiae hic earum repellat aliquid est doloribus delectus. Enim illum odio porro ut omnis
  dolor debitis natus. Voluptas possimus deserunt sit delectus est saepe nihil. Qui voluptate
  possimus et quia. Eligendi voluptas voluptas dolor cum. Rerum est quos quos id ut molestiae fugit.
</p>
```

[Learn more about the line-clamp plugin →](https://github.com/tailwindlabs/tailwindcss-line-clamp)

### Aspect ratio

The `@tailwindcss/aspect-ratio` plugin adds `aspect-w-{n}` and `aspect-h-{n}` classes that can be combined to give an element a fixed aspect ratio.

```html
<div class="aspect-w-16 aspect-h-9">
  <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
```

[Learn more about the aspect ratio plugin →](https://github.com/tailwindlabs/tailwindcss-aspect-ratio)

------

## Adding utilities

The `addUtilities` function allows you to register new styles in Tailwind’s `utilities` layer.

Plugin utilities are output in the order they are registered, *after* built-in utilities, so if a plugin targets any of the same properties as a built-in utility, the plugin utility will take precedence.

To add new utilities from a plugin, call `addUtilities`, passing in your styles using [CSS-in-JS syntax](https://tailwindcss.com/docs/plugins#css-in-js-syntax):

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        '.skew-10deg': {
          transform: 'skewY(-10deg)',
        },
        '.skew-15deg': {
          transform: 'skewY(-15deg)',
        },
      }

      addUtilities(newUtilities)
    })
  ]
}
```

### Prefix and important preferences

By default, plugin utilities automatically respect the user’s [`prefix`](https://tailwindcss.com/docs/configuration#prefix) and [`important`](https://tailwindcss.com/docs/configuration#important) preferences.

That means that given this Tailwind configuration:

```js
// tailwind.config.js
module.exports = {
  prefix: 'tw-',
  important: true,
  // ...
}
```

…the example plugin above would generate the following CSS:

```css
.tw-skew-10deg {
  transform: skewY(-10deg) !important;
}
.tw-skew-15deg {
  transform: skewY(-15deg) !important;
}
```

If necessary, you can opt out of this behavior by passing an options object as a second parameter to `addUtilities`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, {
        respectPrefix: false,
        respectImportant: false,
      })
    })
  ]
}
```

### Variants

To generate responsive, hover, focus, active, or other variants of your styles, specify the variants you’d like to generate using the `variants` option:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, {
        variants: ['responsive', 'hover'],
      })
    })
  ]
}
```

If you only need to specify variants and don’t need to opt-out of the default prefix or important options, you can also pass the array of variants as the second parameter directly:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    })
  ]
}
```

If you’d like the user to provide the variants themselves under the `variants` section in their `tailwind.config.js` file, you can use the `variants()` function to get the variants they have configured:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  variants: {
    customPlugin: ['responsive', 'hover'],
  },
  plugins: [
    plugin(function({ addUtilities, variants }) {
      const newUtilities = {
        // ...
      }

      addUtilities(newUtilities, variants('customPlugin'))
    })
  ]
}
```

------

## Adding components

The `addComponents` function allows you to register new styles in Tailwind’s `components` layer.

Use it to add more opinionated, complex classes like buttons, form controls, alerts, etc; the sort of pre-built components you often see in other frameworks that you might need to override with utility classes.

To add new component styles from a plugin, call `addComponents`, passing in your styles using [CSS-in-JS syntax](https://tailwindcss.com/docs/plugins#css-in-js-syntax):

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const buttons = {
        '.btn': {
          padding: '.5rem 1rem',
          borderRadius: '.25rem',
          fontWeight: '600',
        },
        '.btn-blue': {
          backgroundColor: '#3490dc',
          color: '#fff',
          '&:hover': {
            backgroundColor: '#2779bd'
          },
        },
        '.btn-red': {
          backgroundColor: '#e3342f',
          color: '#fff',
          '&:hover': {
            backgroundColor: '#cc1f1a'
          },
        },
      }

      addComponents(buttons)
    })
  ]
}
```

### Prefix and important preferences

By default, component classes automatically respect the user’s `prefix` preference, but **they are not affected** by the user’s `important` preference.

That means that given this Tailwind configuration:

```js
// tailwind.config.js
module.exports = {
  prefix: 'tw-',
  important: true,
  // ...
}
```

…the example plugin above would generate the following CSS:

```css
.tw-btn {
  padding: .5rem 1rem;
  border-radius: .25rem;
  font-weight: 600;
}
.tw-btn-blue {
  background-color: #3490dc;
  color: #fff;
}
.tw-btn-blue:hover {
  background-color: #2779bd;
}
.tw-btn-blue {
  background-color: #e3342f;
  color: #fff;
}
.tw-btn-blue:hover {
  background-color: #cc1f1a;
}
```

Although there’s rarely a good reason to make component declarations important, if you really need to do it you can always add `!important` manually:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const buttons = {
        '.btn': {
          padding: '.5rem 1rem !important',
          borderRadius: '.25rem !important',
          fontWeight: '600 !important',
        },
        // ...
      }

      addComponents(buttons)
    })
  ]
}
```

All classes in a selector will be prefixed by default, so if you add a more complex style like:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  prefix: 'tw-',
  plugins: [
    plugin(function({ addComponents }) {
      const components = {
        // ...
        '.navbar-inverse a.nav-link': {
            color: '#fff',
        }
      }

      addComponents(components)
    })
  ]
}
```

…the following CSS would be generated:

```css
.tw-navbar-inverse a.tw-nav-link {
    color: #fff;
}
```

To opt out of prefixing, pass an options object as a second parameter to `addComponents`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  prefix: 'tw-',
  plugins: [
    plugin(function({ addComponents }) {
      const components = {
        // ...
      }

      addComponents(components, {
        respectPrefix: false
      })
    })
  ]
}
```

### Variants

To generate responsive, hover, focus, active, or other variants of your components, specify the variants you’d like to generate using the `variants` option:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const newComponents = {
        // ...
      }

      addComponents(newComponents, {
        variants: ['responsive', 'hover'],
      })
    })
  ]
}
```

If you only need to specify variants and don’t need to opt-out of the default prefix or important options, you can also pass the array of variants as the second parameter directly:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents }) {
      const newComponents = {
        // ...
      }

      addComponents(newComponents, ['responsive', 'hover'])
    })
  ]
}
```

If you’d like the user to provide the variants themselves under the `variants` section in their `tailwind.config.js` file, you can use the `variants()` function to get the variants they have configured:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  variants: {
    customPlugin: ['responsive', 'hover'],
  },
  plugins: [
    plugin(function({ addComponents, variants }) {
      const newComponents = {
        // ...
      }

      addComponents(newComponents, variants('customPlugin'))
    })
  ]
}
```

------

## Adding base styles

The `addBase` function allows you to register new styles in Tailwind’s `base` layer.

Use it to add things like base typography styles, opinionated global resets, or `@font-face` rules.

To add new base styles from a plugin, call `addBase`, passing in your styles using [CSS-in-JS syntax](https://tailwindcss.com/docs/plugins#css-in-js-syntax):

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addBase, theme }) {
      addBase({
        'h1': { fontSize: theme('fontSize.2xl') },
        'h2': { fontSize: theme('fontSize.xl') },
        'h3': { fontSize: theme('fontSize.lg') },
      })
    })
  ]
}
```

Since base styles are meant to target bare selectors like `div`, `h1`, etc., they do not respect the user’s `prefix` or `important` configuration.

------

## Escaping class names

If your plugin generates classes that contain user-provided strings, you can use the `e` function to escape those class names to make sure non-standard characters are handled properly automatically.

For example, this plugin generates a set of `.rotate-{angle}` utilities where `{angle}` is a user provided string. The `e` function is used to escape the concatenated class name to make sure classes like `.rotate-1/4` work as expected:

```js
// tailwind.config.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = {
  theme: {
    rotate: {
      '1/4': '90deg',
      '1/2': '180deg',
      '3/4': '270deg',
    }
  },
  plugins: [
    plugin(function({ addUtilities, theme, e }) {
      const rotateUtilities = _.map(theme('rotate'), (value, key) => {
        return {
          [`.${e(`rotate-${key}`)}`]: {
            transform: `rotate(${value})`
          }
        }
      })

      addUtilities(rotateUtilities)
    })
  ]
}
```

This plugin would generate the following CSS:

```css
.rotate-1\/4 {
  transform: rotate(90deg);
}
.rotate-1\/2 {
  transform: rotate(180deg);
}
.rotate-3\/4 {
  transform: rotate(270deg);
}
```

Be careful to only escape content you actually want to escape; don’t pass the leading `.` in a class name or the `:` at the beginning pseudo-classes like `:hover` or `:focus` or those characters will be escaped.

Additionally, because CSS has rules about the characters a class name can *start* with (a class can’t start with a number, but it can contain one), it’s a good idea to escape your complete class name (not just the user-provided portion) or you may end up with unnecessary escape sequences:

```js
// Will unnecessarily escape `1`
`.rotate-${e('1/4')}`
// => '.rotate-\31 \/4'

// Won't escape `1` because it's not the first character
`.${e('rotate-1/4')}`
// => '.rotate-1\/4'
```

------

## Manually prefixing selectors

If you’re writing something complex where you only want to prefix certain classes, you can use the `prefix` function to have fine-grained control of when the user’s configured prefix is applied.

For example, if you’re creating a plugin to be reused across a set of internal projects that includes existing classes in its selectors, you might only want to prefix the new classes:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  prefix: 'tw-',
  plugins: [
    plugin(function({ addComponents, prefix }) {
      addComponents({
        [`.existing-class > ${prefix('.new-class')}`]: {
          backgroundColor: '#fff',
        }
      })
    })
  ]
}
```

This would generate the following CSS:

```css
.existing-class > .tw-new-class {
  background-color: #fff;
}
```

The `prefix` function will prefix all classes in a selector and ignore non-classes, so it’s totally safe to pass complex selectors like this one:

```js
prefix('.btn-blue .w-1\/4 > h1.text-xl + a .bar')
// => '.tw-btn-blue .tw-w-1\/4 > h1.tw-text-xl + a .tw-bar'
```

------

## Referencing the user's config

The `config`, `theme`, and `variants` functions allow you to ask for a value from the user’s Tailwind configuration using dot notation, providing a default value if that path doesn’t exist.

For example, this simplified version of the built-in [container](https://tailwindcss.com/docs/container) plugin uses the `theme` function to get the user’s configured breakpoints:

```js
// tailwind.config.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents, theme }) {
      const screens = theme('screens', {})

      const mediaQueries = _.map(screens, width => {
        return {
          [`@media (min-width: ${width})`]: {
            '.container': {
              'max-width': width,
            },
          },
        }
      })

      addComponents([
        { '.container': { width: '100%' } },
        ...mediaQueries,
      ])
    })
  ]
}
```

If you’d like to reference the user’s `variants` configuration, it’s recommended that you use the `variants()` function instead of the config function.

**Don't use the config function to look up variants**

```js
addUtilities(newUtilities, config('variants.customPlugin'))
```

**Use the variants function instead**

```js
addUtilities(newUtilities, variants('customPlugin'))
```

Since `variants` could simply be a global list of variants to configure for every plugin in the whole project, using the `variants()` function lets you easily respect the user’s configuration without reimplementing that logic yourself.

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  variants: ['responsive', 'hover', 'focus'],
  plugins: [
    plugin(function ({ config, variants }) {
      config('variants.customPlugin')
      // => undefined

      variants('customPlugin')
      // => ['responsive', 'hover', 'focus']
    })
  ]
}
```

------

## Exposing options

It often makes sense for a plugin to expose its own options that the user can configure to customize the plugin’s behavior.

The best way to accomplish this is to claim your own key in the user’s `theme` and `variants` configuration and ask them to provide any options there so you can access them with the `theme` and `variants` functions.

For example, here’s a plugin *(extracted to its own module)* for creating simple gradient utilities that accepts the gradients and variants to generate as options:

```js
// ./plugins/gradients.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = plugin(function({ addUtilities, e, theme, variants }) {
  const gradients = theme('gradients', {})
  const gradientVariants = variants('gradients', [])

  const utilities = _.map(gradients, ([start, end], name) => ({
    [`.${e(`bg-gradient-${name}`)}`]: {
      backgroundImage: `linear-gradient(to right, ${start}, ${end})`
    }
  }))

  addUtilities(utilities, gradientVariants)
})
```

To use it, you’d `require` it in your plugins list, specifying your configuration under the `gradients` key in both `theme` and `variants`:

```js
// tailwind.config.js
module.exports = {
  theme: {
    gradients: theme => ({
      'blue-green': [theme('colors.blue.500'), theme('colors.green.500')],
      'purple-blue': [theme('colors.purple.500'), theme('colors.blue.500')],
      // ...
    })
  },
  variants: {
    gradients: ['responsive', 'hover'],
  },
  plugins: [
    require('./plugins/gradients')
  ],
}
```

### Providing default options

To provide default `theme` and `variants` options for your plugin, pass a second argument to Tailwind’s `plugin` function that includes your defaults:

```js
// ./plugins/gradients.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = plugin(function({ addUtilities, e, theme, variants }) {
  // ...
}, {
  theme: {
    gradients: theme => ({
      'blue-green': [theme('colors.blue.500'), theme('colors.green.500')],
      'purple-blue': [theme('colors.purple.500'), theme('colors.blue.500')],
      // ...
    })
  },
  variants: {
    gradients: ['responsive', 'hover'],
  }
})
```

This object is just another [Tailwind configuration object](https://tailwindcss.com/docs/configuration) and has all of the same properties and features as the config object you’re used to working with in `tailwind.config.js`.

By providing your defaults this way, end users will be able to [override](https://tailwindcss.com/docs/theme#overriding-the-default-theme) and [extend](https://tailwindcss.com/docs/theme#extending-the-default-theme) your defaults the same way they can with Tailwind’s built-in styles.

### Exposing advanced configuration options

Sometimes it makes sense for a plugin to be configurable in a way that doesn’t really belong under `theme` or `variants`, like perhaps you want users to be able to customize the class name your plugin uses.

For cases like this, you can use `plugin.withOptions` to define a plugin that can be invoked with a configuration object. This API is similar to the regular `plugin` API, except each argument should be a function that receives the user’s `options` and returns the value that you would have normally passed in using the regular API:

```js
// ./plugins/gradients.js
const _ = require('lodash')
const plugin = require('tailwindcss/plugin')

module.exports = plugin.withOptions(function (options) {
  return function({ addUtilities, e, theme, variants }) {
    const classPrefix = options.classPrefix ?? 'bg-gradient'
    const gradients = theme('gradients', {})
    const gradientVariants = variants('gradients', [])

    const utilities = _.map(gradients, ([start, end], name) => ({
      [`.${e(`${classPrefix}-${name}`)}`]: {
        backgroundImage: `linear-gradient(to right, ${start}, ${end})`
      }
    }))

    addUtilities(utilities, gradientVariants)
  })
}, function (options) {
  return {
    theme: {
      gradients: theme => ({
        'blue-green': [theme('colors.blue.500'), theme('colors.green.500')],
        'purple-blue': [theme('colors.purple.500'), theme('colors.blue.500')],
        // ...
      })
    },
    variants: {
      gradients: ['responsive', 'hover'],
    }
  }
})
```

The user would invoke your plugin passing along their options when registering it in their `plugins` configuration:

```js
// tailwind.config.js
module.exports = {
  theme: {
    // ...
  },
  variants: {
    // ...
  },
  plugins: [
    require('./plugins/gradients')({
      classPrefix: 'bg-grad'
    })
  ],
}
```

The user can also register plugins created this way normally without invoking them if they don’t need to pass in any custom options:

```js
// tailwind.config.js
module.exports = {
  theme: {
    // ...
  },
  variants: {
    // ...
  },
  plugins: [
    require('./plugins/gradients')
  ],
}
```

------

## CSS-in-JS syntax

Each of `addUtilities`, `addComponents`, and `addBase` expect CSS rules written as JavaScript objects. Tailwind uses the same sort of syntax you might recognize from CSS-in-JS libraries like [Emotion](https://emotion.sh/docs/object-styles), and is powered by [postcss-js](https://github.com/postcss/postcss-js) under the hood.

Consider this simple CSS rule:

```css
.card {
  background-color: #fff;
  border-radius: .25rem;
  box-shadow: 0 2px 4px rgba(0,0,0,0.2);
}
```

Translating this to a CSS-in-JS object would look like this:

```js
addComponents({
  '.card': {
    'background-color': '#fff',
    'border-radius': '.25rem',
    'box-shadow': '0 2px 4px rgba(0,0,0,0.2)',
  }
})
```

For convenience, property names can also be written in camelCase and will be automatically translated to dash-case:

```js
addComponents({
  '.card': {
    backgroundColor: '#fff',
    borderRadius: '.25rem',
    boxShadow: '0 2px 4px rgba(0,0,0,0.2)',
  }
})
```

Nesting is also supported (powered by [postcss-nested](https://github.com/postcss/postcss-nested)), using the same syntax you might be familiar with from Sass or Less:

```js
addComponents({
  '.card': {
    backgroundColor: '#fff',
    borderRadius: '.25rem',
    boxShadow: '0 2px 4px rgba(0,0,0,0.2)',
    '&:hover': {
      boxShadow: '0 10px 15px rgba(0,0,0,0.2)',
    },
    '@media (min-width: 500px)': {
      borderRadius: '.5rem',
    }
  }
})
```

Multiple rules can be defined in the same object:

```js
addComponents({
  '.btn': {
    padding: '.5rem 1rem',
    borderRadius: '.25rem',
    fontWeight: '600',
  },
  '.btn-blue': {
    backgroundColor: '#3490dc',
    color: '#fff',
    '&:hover': {
      backgroundColor: '#2779bd'
    },
  },
  '.btn-red': {
    backgroundColor: '#e3342f',
    color: '#fff',
    '&:hover': {
      backgroundColor: '#cc1f1a'
    },
  },
})
```

…or as an array of objects in case you need to repeat the same key:

```js
addComponents([
  {
    '@media (min-width: 500px)': {
      // ...
    }
  },
  {
    '@media (min-width: 500px)': {
      // ...
    }
  },
  {
    '@media (min-width: 500px)': {
      // ...
    }
  },
])
```

------

## Adding variants

The `addVariant` function allows you to register your own custom [variants](https://tailwindcss.com/docs/hover-focus-and-other-states) that can be used just like the built-in hover, focus, active, etc. variants.

To add a new variant, call the `addVariant` function, passing in the name of your custom variant, and a callback that modifies the affected CSS rules as needed.

```js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant, e }) {
      addVariant('disabled', ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`disabled${separator}${className}`)}:disabled`
        })
      })
    })
  ]
}
```

The callback receives an object that can be destructured into the following parts:

- `modifySelectors`, a helper function to simplify adding basic variants
- `separator`, the user’s configured [separator string](https://tailwindcss.com/docs/configuration#separator)
- `container`, a [PostCSS Container](http://api.postcss.org/Container.html) containing all of the rules the variant is being applied to, for creating complex variants

### Basic variants

If you want to add a simple variant that only needs to change the selector, use the `modifySelectors` helper.

The `modifySelectors` helper accepts a function that receives an object that can be destructured into the following parts:

- `selector`, the complete unmodified selector for the current rule
- `className`, the class name of the current rule *with the leading dot removed*

The function you pass to `modifySelectors` should simply return the modified selector.

For example, a `first-child` variant plugin could be written like this:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant, e }) {
      addVariant('first-child', ({ modifySelectors, separator }) => {
        modifySelectors(({ className }) => {
          return `.${e(`first-child${separator}${className}`)}:first-child`
        })
      })
    })
  ]
}
```

### Complex variants

If you need to do anything beyond simply modifying selectors (like changing the actual rule declarations, or wrapping the rules in another at-rule), you’ll need to use the `container` instance.

Using the `container` instance, you can traverse all of the rules within a given module or `@variants` block and manipulate them however you like using the standard PostCSS API.

For example, this plugin creates an `important` version of each affected utility by prepending the class with an exclamation mark and modifying each declaration to be `important`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant }) {
      addVariant('important', ({ container }) => {
        container.walkRules(rule => {
          rule.selector = `.\\!${rule.selector.slice(1)}`
          rule.walkDecls(decl => {
            decl.important = true
          })
        })
      })
    })
  ]
}
```

This plugin takes all of the rules inside the container, wraps them in a `@supports (display: grid)` at-rule, and prefixes each rule with `supports-grid`:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addVariant, e, postcss }) {
      addVariant('supports-grid', ({ container, separator }) => {
        const supportsRule = postcss.atRule({ name: 'supports', params: '(display: grid)' })
        supportsRule.append(container.nodes)
        container.append(supportsRule)
        supportsRule.walkRules(rule => {
          rule.selector = `.${e(`supports-grid${separator}${rule.selector.slice(1)}`)}`
        })
      })
    })
  ]
}
```

To learn more about working with PostCSS directly, check out the [PostCSS API documentation](http://api.postcss.org/Container.html).

### Using custom variants

Using custom variants is no different than using Tailwind’s built-in variants.

To use custom variants with Tailwind’s core plugins, add them to the `variants` section of your config file:

```js
// tailwind.config.js
modules.exports = {
  variants: {
    borderWidths: ['responsive', 'hover', 'focus', 'first-child', 'disabled'],
  }
}
```

To use custom variants with custom utilities in your own CSS, use the [variants at-rule](https://tailwindcss.com/docs/functions-and-directives#variants):

```css
@variants hover, first-child {
  .bg-cover-image {
    background-image: url('/path/to/image.jpg');
  }
}
```

[←Variants](https://tailwindcss.com/docs/configuring-variants)[Presets
  ](https://tailwindcss.com/docs/presets)