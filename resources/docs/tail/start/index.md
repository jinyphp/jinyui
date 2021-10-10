---
theme: "docs.tail"
layout: "markdown"
title: "Tailwind Installation"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Installation

Learn how to get Tailwind CSS up and running in your project.

## Integration guides

Installing Tailwind CSS can be a slightly different process depending on what other frameworks/tools you’re using, so we’ve put together a bunch of guides that cover popular setups.

[Next.js](https://tailwindcss.com/docs/guides/nextjs)[Vue 3 (Vite)](https://tailwindcss.com/docs/guides/vue-3-vite)[Laravel](https://tailwindcss.com/docs/guides/laravel)[Nuxt.js](https://tailwindcss.com/docs/guides/nuxtjs)[Create React App](https://tailwindcss.com/docs/guides/create-react-app)[Gatsby](https://tailwindcss.com/docs/guides/gatsby)

Don’t see your favorite tool in the list? We’re always working on new guides, but in the mean time you can follow the instructions for [installing Tailwind CSS as a PostCSS plugin](https://tailwindcss.com/docs/installation#installing-tailwind-css-as-a-post-css-plugin) instead to get set up in no time.

------

## Installing Tailwind CSS as a PostCSS plugin

*Tailwind CSS requires Node.js 12.13.0 or higher.*

For most real-world projects, we recommend installing Tailwind as a PostCSS plugin. Most modern frameworks use PostCSS under the hood already, and there’s a good chance you’ve used or are currently using other PostCSS plugins like [autoprefixer](https://github.com/postcss/autoprefixer).

If you’ve never heard of PostCSS or are wondering how it’s different from tools like Sass, read our guide on [using PostCSS as your preprocessor](https://tailwindcss.com/docs/using-with-preprocessors#using-post-css-as-your-preprocessor) for an introduction.

If this is a bit over your head and you’d like to try Tailwind without configuring PostCSS, read our instructions on [using Tailwind without PostCSS](https://tailwindcss.com/docs/installation#using-tailwind-without-post-css) instead.

### Install Tailwind via npm

For most projects (and to take advantage of Tailwind’s customization features), you’ll want to install Tailwind and its peer-dependencies via npm.

```shell
npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
```

Since Tailwind [does not automatically add vendor prefixes](https://tailwindcss.com/docs/browser-support#vendor-prefixes) to the CSS it generates, we recommend installing [autoprefixer](https://github.com/postcss/autoprefixer) to handle this for you like we’ve shown in the snippet above.

If you’re integrating Tailwind with a tool that relies on an older version of PostCSS, you may see an error like this:

```shell
Error: PostCSS plugin tailwindcss requires PostCSS 8.
```

In this case, you should [install the PostCSS 7 compatibility build](https://tailwindcss.com/docs/installation#post-css-7-compatibility-build) instead.

### Add Tailwind as a PostCSS plugin

Add `tailwindcss` and `autoprefixer` to your PostCSS configuration. Most of the time this is a `postcss.config.js` file at the root of your project, but it could also be a `.postcssrc` file, or `postcss` key in your `package.json` file.

```js
// postcss.config.js
module.exports = {
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  }
}
```

If you aren’t sure where PostCSS plugins are configured for the tools you’re using, you’ll want to refer to the documentation for those tools to learn where this should go. A search for “configure postcss {my tool}” will get you the answer pretty fast, too.

If you’re using any other PostCSS plugins, you should read our documentation on [using PostCSS as your preprocessor](https://tailwindcss.com/docs/using-with-preprocessors) for more details about the best way to order them with Tailwind.

### Create your configuration file

If you’d like to customize your Tailwind installation, generate a config file for your project using the Tailwind CLI utility included when you install the `tailwindcss` npm package:

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
  variants: {},
  plugins: [],
}
```

Learn more about configuring Tailwind in the [configuration documentation](https://tailwindcss.com/docs/configuration).

### Include Tailwind in your CSS

Create a CSS file if you don’t already have one, and use the `@tailwind` directive to inject Tailwind’s `base`, `components`, and `utilities` styles:

```css
/* ./your-css-folder/styles.css */
@tailwind base;
@tailwind components;
@tailwind utilities;
```

Tailwind will swap these directives out at build-time with all of the styles it generates based on your configured design system.

If you’re using `postcss-import` (or a tool that uses it under the hood, such as [Webpacker](https://github.com/rails/webpacker) for Rails), use our imports instead of the `@tailwind` directive to avoid issues when importing any of your own additional files:

```css
@import "tailwindcss/base";
@import "tailwindcss/components";
@import "tailwindcss/utilities";
```

If you’re working in a JavaScript framework like React or Vue that supports directly importing CSS files into your JS, you can also skip creating a CSS file altogether and import `tailwindcss/tailwind.css` instead which has all of these directives already in place:

```js
// app.js
import "tailwindcss/tailwind.css"
```

### Building your CSS

How you actually build your project will depend on the tools that you’re using. Your framework may include a command like `npm run dev` to start a development server that compiles your CSS in the background, you may be running `webpack` yourself, or maybe you’re using `postcss-cli` and running a command like `postcss styles.css -o compiled.css`.

If you’re already familiar with PostCSS you probably know what you need to do, if not refer to the documentation for the tool you are using.

When building for production, be sure to configure the `purge` option to remove any unused classes for the smallest file size:

```diff-js
  // tailwind.config.js
  module.exports = {
+   purge: [
+     './src/**/*.html',
+     './src/**/*.js',
+   ],
    darkMode: false, // or 'media' or 'class'
    theme: {
      extend: {},
    },
    variants: {},
    plugins: [],
  }
```

Read our separate guide on [optimizing for production](https://tailwindcss.com/docs/optimizing-for-production) to learn more about tree-shaking unused styles for best performance.

If you’re integrating Tailwind with a tool that relies on an older version of PostCSS, you may see an error like this when trying to build your CSS:

```shell
Error: PostCSS plugin tailwindcss requires PostCSS 8.
```

In this case, you should [switch to our PostCSS 7 compatibility build](https://tailwindcss.com/docs/installation#post-css-7-compatibility-build) instead.

------

## Using Tailwind without PostCSS

*Tailwind CSS requires Node.js 12.13.0 or higher.*

For simple projects or just giving Tailwind a spin, you can use the Tailwind CLI tool to generate your CSS without configuring PostCSS or even installing Tailwind as a dependency if you don’t want to.

Use `npx` which is a tool that is automatically installed alongside `npm` to generate a fully compiled Tailwind CSS file:

```shell
npx tailwindcss-cli@latest build -o tailwind.css
```

This will create a file called `tailwind.css` generated based on Tailwind’s [default configuration](https://unpkg.com/browse/tailwindcss@^2/stubs/defaultConfig.stub.js), and automatically add any necessary vendor prefixes using [autoprefixer](https://github.com/postcss/autoprefixer).

Now you can pull this file into your HTML just like any other stylesheet:

```html
<!doctype html>
<html>
<head>
  <!-- ... -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="/tailwind.css" rel="stylesheet">
</head>
<body>
  <!-- ... -->
</body>
</html>
```

### Using a custom CSS file

If you’d like to process any custom CSS alongside the default styles Tailwind generates, create a CSS file wherever you normally would and use the `@tailwind` directive to include Tailwind’s `base`, `components`, and `utilities` styles:

```css
/* ./src/tailwind.css */
@tailwind base;
@tailwind components;

.btn {
  @apply px-4 py-2 bg-blue-600 text-white rounded;
}

@tailwind utilities;
```

Then include the path to that file when building your CSS with `npx tailwindcss build`:

```shell
npx tailwindcss-cli@latest build ./src/tailwind.css -o ./dist/tailwind.css
```

Read about [adding base styles](https://tailwindcss.com/docs/adding-base-styles), [extracting components](https://tailwindcss.com/docs/extracting-components), and [adding new utilities](https://tailwindcss.com/docs/adding-new-utilities) to learn more about adding custom CSS on top of Tailwind.

### Customizing your configuration

If you’d like to customize what Tailwind generates, create a `tailwind.config.js` file using the Tailwind CLI tool:

```shell
npx tailwindcss-cli@latest init
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
  variants: {},
  plugins: [],
}
```

This file will automatically be read when building your CSS with `npx tailwindcss build`:

```shell
npx tailwindcss-cli@latest build ./src/tailwind.css -o ./dist/tailwind.css
```

If you’d like to keep your config file in a different location or give it a different name, pass the config file path using the `-c` option when building your CSS:

```shell
npx tailwindcss-cli@latest build ./src/tailwind.css -c ./.config/tailwind.config.js -o ./dist/tailwind.css
```

Learn more about configuring Tailwind in the [configuration documentation](https://tailwindcss.com/docs/configuration).

### Disabling Autoprefixer

By default, the Tailwind CLI tool will run your CSS through [Autoprefixer](https://github.com/postcss/autoprefixer) to add any necessary vendor prefixes. If you already have Autoprefixer set up in your build pipeline somewhere further down the chain, you can disable it in the Tailwind CLI tool using the `--no-autoprefixer` flag to avoid running it twice:

```shell
npx tailwindcss-cli@latest build --no-autoprefixer -o tailwind.css
```

### Building for production

When building for production, set `NODE_ENV=production` on the command line when building your CSS:

```shell
NODE_ENV=production npx tailwindcss-cli@latest build ./src/tailwind.css -o ./dist/tailwind.css
```

This will make sure Tailwind removes any unused CSS for best performance. Read our separate guide on [optimizing for production](https://tailwindcss.com/docs/optimizing-for-production) to learn more.

------

## Using Tailwind via CDN

Before using the CDN build, please note that many of the features that make Tailwind CSS great are not available without incorporating Tailwind into your build process.

- You can't customize Tailwind's default theme
- You can't use any [directives](https://tailwindcss.com/docs/functions-and-directives) like `@apply`, `@variants`, etc.
- You can't enable additional variants like [`group-focus`](https://tailwindcss.com/docs/hover-focus-and-other-states#group-focus)
- You can't install third-party plugins
- You can't tree-shake unused styles

To get the most out of Tailwind, you really should [install it as a PostCSS plugin](https://tailwindcss.com/docs/installation#installing-tailwind-css-as-a-post-css-plugin).

To pull in Tailwind for quick demos or just giving the framework a spin, grab the latest default configuration build via CDN:

```html
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
```

Note that while the CDN build is large *(71.3kB compressed, 2872.2kB raw)*, **it's not representative of the sizes you see when including Tailwind as part of your build process**.

Sites that follow our [best practices](https://tailwindcss.com/docs/optimizing-for-production) are almost always under 10kb compressed.

------

## HTML starter template

For Tailwind’s styles to work as expected, you’ll want to use the HTML5 doctype and include the responsive viewport meta tag to properly handle responsive styles on all devices.

```html
<!doctype html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="/path/to/tailwind.css" rel="stylesheet">
  <!-- ... -->
</head>
<body>
  <!-- ... -->
</body>
</html>
```

Many front-end frameworks like Next.js, vue-cli and others do all this for you behind the scenes automatically, so depending on what you’re building you might not need to set this up.

------

## PostCSS 7 compatibility build

As of v2.0, Tailwind CSS depends on PostCSS 8. Because PostCSS 8 is only a few months old, many other tools in the ecosystem haven’t updated yet, which means you might see an error like this in your terminal after installing Tailwind and trying to compile your CSS:

```shell
Error: PostCSS plugin tailwindcss requires PostCSS 8.
```

To help bridge the gap until everyone has updated, we also publish a PostCSS 7 compatibility build as `@tailwindcss/postcss7-compat` on npm.

If you run into the error mentioned above, uninstall Tailwind and re-install using the compatibility build instead:

```shell
npm uninstall tailwindcss postcss autoprefixer
npm install -D tailwindcss@npm:@tailwindcss/postcss7-compat postcss@^7 autoprefixer@^9
```

The compatibility build is identical to the main build in every way, so you aren’t missing out on any features or anything like that.

Once the rest of your tools have added support for PostCSS 8, you can move off of the compatibility build by re-installing Tailwind and its peer-dependencies using the `latest` tag:

```shell
npm uninstall tailwindcss
npm install -D tailwindcss@latest postcss@latest autoprefixer@latest
```



---



# Upgrade Guide

Upgrading from Tailwind CSS v1.x to v2.0.

Tailwind CSS v2.0 is the first new major version since v1.0 was released in May 2019, and as such it includes a handful of small breaking changes.

We don’t take breaking changes lightly and have worked hard to make sure the upgrade path is as simple as possible. For most projects, upgrading should take less than 30 minutes.

If your project uses the `@tailwindcss/ui` plugin, be sure to read the [Tailwind UI for Tailwind CSS v2.0 upgrade guide](https://tailwindui.com/changes-for-v2) as well.

------

## Install Tailwind CSS v2.0 and PostCSS 8

Tailwind CSS v2.0 has been updated for the latest PostCSS release which requires installing `postcss` and `autoprefixer` as peer dependencies alongside Tailwind itself.

Update Tailwind and install PostCSS and autoprefixer using npm:

```shell
npm install tailwindcss@latest postcss@latest autoprefixer@latest
```

If you run into issues, you may need to use our [PostCSS 7 compatibility build](https://tailwindcss.com/docs/installation#post-css-7-compatibility-build) instead.

## Support for IE 11 has been dropped

Prior to v2.0, we tried our best to make sure features we included in Tailwind worked in IE 11 whenever possible. This added considerable maintenance burden as well as increased build sizes (even when purging unused styles), so we have decided to drop support for IE 11 as of v2.0.

If you need to support IE 11, we recommend continuing to use Tailwind CSS v1.9 until you no longer need to support IE.

## Upgrade to Node.js 12.13 or higher

Tailwind CSS v2.0 no longer supports Node.js 8 or 10. To build your CSS you’ll need to ensure you are running Node.js 12.13.0 or higher in both your local and CI environments.

## Update typography and forms plugins

If you are using `@tailwindcss/typography`, you’ll want to [upgrade to v0.3.0](https://github.com/tailwindlabs/tailwindcss-typography/releases/tag/v0.3.0) which adds Tailwind CSS v2.0 support.

If you are using `@tailwindcss/custom-forms`, you will want to migrate to `@tailwindcss/forms` which replaces it. Learn more about the new forms plugin in [the release notes](https://blog.tailwindcss.com/tailwindcss-v2#utility-friendly-form-styles).

The `@tailwindcss/custom-forms` plugin is not compatible with Tailwind CSS v2.0.

## Remove future and experimental configuration options

As of v2.0 there are no `future` or `experimental` options available, so you can remove any configuration like this from your `tailwind.config.js` file:

```diff-js
  module.exports = {
-   future: {
-     defaultLineHeights: true,
-     purgeLayersByDefault: true,
-     removeDeprecatedGapUtilities: true,
-   },
-   experimental: {
-       additionalBreakpoint: true,
-       extendedFontSizeScale: true,
-       extendedSpacingScale: true,
-   },
    // ...
  }
```

We will continue to use the `experimental` option in the future for new feature ideas but the `future` option will probably not be used.

## Update renamed utility classes

A small number of utilities have been renamed in v2.0:

| Old name             | New name            |
| -------------------- | ------------------- |
| `whitespace-no-wrap` | `whitespace-nowrap` |
| `flex-no-wrap`       | `flex-nowrap`       |
| `col-gap-{n}`        | `gap-x-{n}`         |
| `row-gap-{n}`        | `gap-y-{n}`         |

You should be able to globally find and replace these classes throughout your entire project very safely, as they are very distinct strings.

Updating `whitespace-no-wrap` and `flex-no-wrap` is just a direct replacement, and for the gap utilities we recommend replacing `col-gap-` with `gap-x-` and `row-gap-` with `gap-y-` to handle all sizes at once.

## Enable hover and focus for fontWeight if needed

The `hover` and `focus` variants have been disabled for the `fontWeight` plugin by default, as changing font-weight like this tends to cause layout jank so it’s uncommon to actually do it anyways.

If you need these in your project, re-enable them in your `tailwind.config.js` file:

```diff-js
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
+       fontWeight: ['hover', 'focus']
      }
    }
  }
```

## Replace clearfix with flow-root

The `clearfix` class has been removed since `flow-root` is a simpler solution to the same problem in modern browsers.

```diff-html
- <div class="clearfix">
+ <div class="flow-root">
    <img class="float-left" src="..." alt="..." />
    <p>Lorem ipsum...</p>
  </div>
```

## Update font-weight class names for 100 and 200 weights

The class names for the `100` and `200` font weights have changed in Tailwind CSS v2.0:

| Font weight | Old name        | New name          |
| ----------- | --------------- | ----------------- |
| 100         | `font-hairline` | `font-thin`       |
| 200         | `font-thin`     | `font-extralight` |

Since `font-thin` appears in both v1 and v2 for different weights, we recommend updating your classes in the following order:

1. Globally find and replace `font-thin` with `font-extralight`
2. Globally find and replace `font-hairline` with `font-thin`

## Replace shadow-outline and shadow-xs with ring utilities

Tailwind CSS v2.0 introduces a new set of `ring` utilities that let you add outline shadows/focus rings in a way that automatically composes with Tailwind’s other box-shadow utilities.

These are a much better and more powerful alternative to the `shadow-outline` and `shadow-xs` classes, so we’ve removed those classes.

Replace `shadow-outline` with `ring`:

```diff-html
- <div class="... focus:shadow-outline">
+ <div class="... focus:ring">
```

Replace `shadow-xs` with `ring-1 ring-black ring-opacity-5`:

```diff-html
- <div class="... shadow-xs">
+ <div class="... ring-1 ring-black ring-opacity-5">
```

Alternatively, you can also add `shadow-outline` and `shadow-xs` back to your config file and leave your HTML untouched:

```js
module.exports = {
  theme: {
    extend: {
      boxShadow: {
        xs: '0 0 0 1px rgba(0, 0, 0, 0.05)',
        outline: '0 0 0 3px rgba(66, 153, 225, 0.5)',
      }
    }
  }
}
```

## Configure your breakpoints explicitly

Tailwind CSS v2.0 adds a new `2xl` breakpoint which will affect any situations where you’ve used the `container` class. If this impacts you, remove the `2xl` breakpoint by overriding `screens` with your existing breakpoints:

```diff-js
// tailwind.config.js
module.exports = {
  purge: [
  // ...
  ],
  theme: {
+    screens: {
+      sm: '640px',
+      md: '768px',
+      lg: '1024px',
+      xl: '1280px',
+    }
    // ...
   },
  variants: {
    // ...
  }
}
```

## Configure your color palette explicitly

**If you are already using a custom color palette, no changes are required and you can safely skip this step.**

The default color palette has changed considerably in Tailwind CSS v2.0 and is not designed to be a drop-in replacement for the color palette that was included in v1.

If you’re using the default color palette, you should configure it explicitly to override the new default palette with the colors your site is already using.

Here is an example `tailwind.config.js` file that includes the default colors from v1:

```js
// tailwind.config.js
module.exports = {
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',

      black: '#000',
      white: '#fff',

      gray: {
        100: '#f7fafc',
        200: '#edf2f7',
        300: '#e2e8f0',
        400: '#cbd5e0',
        500: '#a0aec0',
        600: '#718096',
        700: '#4a5568',
        800: '#2d3748',
        900: '#1a202c',
      },
      red: {
        100: '#fff5f5',
        200: '#fed7d7',
        300: '#feb2b2',
        400: '#fc8181',
        500: '#f56565',
        600: '#e53e3e',
        700: '#c53030',
        800: '#9b2c2c',
        900: '#742a2a',
      },
      orange: {
        100: '#fffaf0',
        200: '#feebc8',
        300: '#fbd38d',
        400: '#f6ad55',
        500: '#ed8936',
        600: '#dd6b20',
        700: '#c05621',
        800: '#9c4221',
        900: '#7b341e',
      },
      yellow: {
        100: '#fffff0',
        200: '#fefcbf',
        300: '#faf089',
        400: '#f6e05e',
        500: '#ecc94b',
        600: '#d69e2e',
        700: '#b7791f',
        800: '#975a16',
        900: '#744210',
      },
      green: {
        100: '#f0fff4',
        200: '#c6f6d5',
        300: '#9ae6b4',
        400: '#68d391',
        500: '#48bb78',
        600: '#38a169',
        700: '#2f855a',
        800: '#276749',
        900: '#22543d',
      },
      teal: {
        100: '#e6fffa',
        200: '#b2f5ea',
        300: '#81e6d9',
        400: '#4fd1c5',
        500: '#38b2ac',
        600: '#319795',
        700: '#2c7a7b',
        800: '#285e61',
        900: '#234e52',
      },
      blue: {
        100: '#ebf8ff',
        200: '#bee3f8',
        300: '#90cdf4',
        400: '#63b3ed',
        500: '#4299e1',
        600: '#3182ce',
        700: '#2b6cb0',
        800: '#2c5282',
        900: '#2a4365',
      },
      indigo: {
        100: '#ebf4ff',
        200: '#c3dafe',
        300: '#a3bffa',
        400: '#7f9cf5',
        500: '#667eea',
        600: '#5a67d8',
        700: '#4c51bf',
        800: '#434190',
        900: '#3c366b',
      },
      purple: {
        100: '#faf5ff',
        200: '#e9d8fd',
        300: '#d6bcfa',
        400: '#b794f4',
        500: '#9f7aea',
        600: '#805ad5',
        700: '#6b46c1',
        800: '#553c9a',
        900: '#44337a',
      },
      pink: {
        100: '#fff5f7',
        200: '#fed7e2',
        300: '#fbb6ce',
        400: '#f687b3',
        500: '#ed64a6',
        600: '#d53f8c',
        700: '#b83280',
        800: '#97266d',
        900: '#702459',
      },
    }
  }
}
```

**We do not recommend updating existing sites to use the new default color palette.** The numbers are not meant to be transferrable, so for example `bg-red-600` in v2 is not just a “better” version of `bg-red-600` from v1 — it has different contrast characteristics. If you are happy with how your site looks, there is no reason to spend hours of your life updating your HTML. The old colors are great too!

## Configure your font-size scale explicitly

**If you are already using a custom typography scale, no changes are required and you can safely skip this step.**

In v2.0, each font-size utility includes a sensible size-specific line-height by default, so for example `text-sm` automatically sets a line-height of `1.25rem`.

This will change how your site looks anywhere where you haven’t explicitly added a `leading` utility alongside a font-size utility.

The fastest way to get past this is to explicitly configure your font-size scale to use the scale from v1:

```js
// tailwind.config.js
module.exports = {
  theme: {
    fontSize: {
      xs: '0.75rem',
      sm: '0.875rem',
      base: '1rem',
      lg: '1.125rem',
      xl: '1.25rem',
      '2xl': '1.5rem',
      '3xl': '1.875rem',
      '4xl': '2.25rem',
      '5xl': '3rem',
      '6xl': '4rem',
    },
  }
}
```

Alternatively, you can go through your HTML and explicitly add a `leading` utility anywhere where you were depending on an inherited line-height:

```diff-html
- <p class="text-lg">...</p>
+ <p class="text-lg leading-normal">...</p>
```

## Update default theme keys to DEFAULT

In Tailwind CSS v1.x, the `default` keyword in various `theme` sections of the `tailwind.config.js` section sometimes meant “don’t add a suffix to the class name”.

For example, this configuration:

```js
// tailwind.config.js
module.exports = {
  theme: {
    borderRadius: {
      none: '0',
      sm: '0.125rem',
      default: '0.25rem',
      md: '0.375rem',
      lg: '0.5rem',
    },
  }
}
```

…would generated a `rounded` class with a `border-radius` of `0.25rem`, *not* a `rounded-default` class.

In Tailwind CSS v2.0, we’ve updated all special usage of `default` to uppercase `DEFAULT` instead:

```js
// tailwind.config.js
module.exports = {
  theme: {
    borderRadius: {
      none: '0',
      sm: '0.125rem',
      DEFAULT: '0.25rem',
      md: '0.375rem',
      lg: '0.5rem',
    },
  }
}
```

Lowercase `default` will be treated like any other string, so a `default` value under `borderRadius` *will* generate a `rounded-default` class in Tailwind CSS v.2.0.

You should update all usage of `default` in your config file to `DEFAULT`, *except* where you actually want to generate a `{utility}-default` class, like for `cursor-default`.

Reference [the complete default configuration](https://github.com/tailwindlabs/tailwindcss/blob/master/stubs/defaultConfig.stub.js) to see where we now use `DEFAULT` and where we still use `default` if you are unclear about what changes you need to make to your own configuration.

## Move deliberately shallow extend to top-level

In Tailwind CSS v1.0, theme changes under `extend` were merged shallowly. So this configuration would override *all* of the purple colors:

```js
// tailwind.config.js
module.exports = {
  theme: {
    extend: {
      colors: {
        purple: {
          light: '#E9D8FD',
          medium: '#9F7AEA',
          dark: '#553C9A',
        }
      }
    }
  }
}
```

In v2.0, these are merged deeply, so the above configuration would still generate the default `purple-100` to `purple-900` shades in addition to the custom `purple-light`, `purple-medium`, and `purple-dark` shades.

For the most part this is just helpful, but if you were depending on the shallow merging you will want to move your customizations to the top-level, and manually merge in the other top-level colors:

```js
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    colors: {
      ...defaultTheme.colors,
      purple: {
        light: '#E9D8FD',
        medium: '#9F7AEA',
        dark: '#553C9A',
      }
    }
  }
}
```

You probably won’t have to do this.

## Update @apply statements that rely on class order

The `@apply` feature has gotten a lot more powerful in v2.0, but a few behaviors needed to change to make that possible.

Previously, classes were applied in the order they appeared in your CSS:

```css
/* Input */
.my-class {
  @apply pt-5 p-4;
}

/* Output */
.my-class {
  padding-top: 1.25rem;
  padding: 1rem;
}
```

Now, classes are applied in the order they appear in the original CSS:

```css
/* Input */
.my-class {
  @apply pt-5 p-4;
}

/* Output */
.my-class {
  padding: 1rem;
  padding-top: 1.25rem;
}
```

This is to make sure the behavior matches the behavior you’d get in HTML:

```html
<!-- Here `pt-5` still takes precedence even though it appears first. -->
<div class="pt-5 p-4">...</div>
```

If you were depending on the old behavior, you may see some differences in how your site is rendered. To get around this, use multiple `@apply` declarations:

```css
.my-class {
  @apply pt-5;
  @apply p-4;
}
```

This is unlikely to affect almost anyone who wasn’t going out their way to do something weird.

## Add your configured prefix to any @apply statements

In Tailwind CSS v1.0, you could `@apply` unprefixed utilities even if you had configured a prefix.

This is no longer supported in v2.0, so if you have a prefix (like `tw-`) configured for your site, you’ll need to make sure you include that whenever you use `@apply`:

```css
.my-class {
  @apply tw-p-4 tw-bg-red-500;
}
```

## Remove leading dot from @apply statements

We used to support writing `@apply` statements with an optional leading `.` character:

```css
.my-class {
  @apply .p-4 .bg-red-500;
}
```

We don’t support this anymore, so update any `@apply` statements and remove the dot:

```css
.my-class {
  @apply p-4 bg-red-500;
}
```

The following regex can be useful to find and remove the leading dots in your `@apply` statements:

```regex
(?<=@apply.*)\.
```

## Enable any truncate variants under textOverflow

The `truncate` utility is now part of the `textOverflow` core plugin, so if you had enabled any extra variants (like `group-hover`) for the `wordBreak` plugin in order to use them with the `truncate` class, you’ll want to enable them for `textOverflow` now as well or instead:

```diff-js
  // tailwind.config.js
  module.exports = {
    variants: {
      wordBreak: ['responsive', 'group-hover'],
+     textOverflow: ['responsive', 'group-hover'],
    }
  }
```

## The scrolling-touch and scrolling-auto utilities have been removed

Since iOS 13 stopped supporting the `-webkit-overflow-scrolling` property, we’ve removed these two utilities from v2.0.

If you still need them because you are building something for older iOS versions, you can add them yourself as custom utilities:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer utilities {
  @responsive {
    .scrolling-touch {
      -webkit-overflow-scrolling: touch;
    }
    .scrolling-auto {
      -webkit-overflow-scrolling: auto;
    }
  }
}
```

## Update theme function references that read from arrays

The `theme` function (in CSS, the `tailwind.config.js` file, and in the plugin API) is more intelligent in v2.0 and no longer requires you to manually join arrays or access the first index explicitly.

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  theme: {
    fontSize: {
      // ...
      xl: ['20px', { lineHeight: '28px' }]
    }
  },
  plugins: [
    plugin(({ addBase, theme }) => {
      addBase({
        h1: {
          // Before
          fontSize: theme('fontSize.xl')[0],
          fontFamily: theme('fontFamily.sans').join(','),

          // Now
          fontSize: theme('fontSize.xl'),
          fontFamily: theme('fontFamily.sans'),
        }
      })
    })
  ]
}
```

If for whatever reason you want to access the raw data structure, you can use the `config` function instead.

## Add hidden to any template tags within space or divide elements

We used to have a special rule for ignoring `template` elements when using the `space-x/y` and `divide-x/y` utilities, mostly to make life easier for Alpine.js users.

We’ve updated how this works to no longer special case `template` elements and instead just explicitly ignore any element that has a `hidden` attribute.

To update your code for this change, just add `hidden` to your `template` tags:

```diff-html
  <div class="space-y-4">
-   <template x-for="item in items">
+   <template x-for="item in items" hidden>
      <!-- ... -->
    </template>
  </div>
```

## Update purge options to match PurgeCSS 3.0

Internally we’ve upgraded to [PurgeCSS 3.0](https://github.com/FullHuman/purgecss/releases/tag/v3.0.0), so any raw options you were passing into PurgeCSS through the `options` key need to be updated to match the options exposed in PurgeCSS 3.0.

For example, if you were using `whitelist`, you’ll want to update this to `safelist`:

```diff-js
  // tailwind.config.js
  module.exports = {
    purge: {
      content: [
        // ...
      ],
      options: {
-       whitelist: ['my-class']
+       safelist: ['my-class']
      }
    }
  }
```

If you weren’t using the `options` key, you don’t need to do anything.

## Disable preserveHtmlElements if using a custom PurgeCSS extractor

In v1.0, Tailwind ignored the `preserveHtmlElements` option if you were using a custom extractor. This option is now properly respected in v2.0, so if you want to disable it you’ll need to do so explicitly:

```diff-js
  // tailwind.config.js
  module.exports = {
    purge: {
      content: [
        // ...
      ],
+     preserveHtmlElements: false,
      options: {
        defaultExtractor: () => {
          // ...
        }
      }
    }
  }
```

## Prefix any keyframe references if needed

If you’ve configured a prefix in your `tailwind.config.js` file, Tailwind v2.0 will automatically apply that prefix to any keyframes declarations in your `theme`.

If you are referencing any configured keyframes in custom CSS, you’ll want to make sure you add your prefix:

```diff-css
  .my-class {
-   animation: spin 1s infinite;
+   animation: tw-spin 1s infinite;
  }
```

This only matters if you’ve configured a prefix *and* you’re referencing configured keyframes in custom CSS files. If this affects more than two people on the entire planet I will be absolutely amazed.

[←Release Notes](https://github.com/tailwindlabs/tailwindcss/releases)[Editor Support
  ](https://tailwindcss.com/docs/editor-support)



---



# Editor Support

Plugins and configuration settings that can improve the developer experience when working with Tailwind CSS.

## Syntax support

Tailwind CSS uses a lot of custom CSS at-rules like `@tailwind`, `@apply`, and `@screen`, and in many editors this can trigger warnings or errors where these rules aren’t recognized.

The solution to this is almost always to install a plugin for your editor/IDE for PostCSS language support instead of regular CSS. For example, VS Code has a [PostCSS Language Support](https://marketplace.visualstudio.com/items?itemName=csstools.postcss) plugin you can use that works great with Tailwind CSS.

In some cases, you may need to disable native CSS linting/validations if your editor is very strict about the syntax it expects in your CSS files.

## IntelliSense for VS Code

The official [Tailwind CSS IntelliSense](https://marketplace.visualstudio.com/items?itemName=bradlc.vscode-tailwindcss) extension for Visual Studio Code enhances the Tailwind development experience by providing users with advanced features such as autocomplete, syntax highlighting, and linting.

![img](https://tailwindcss.com/_next/static/media/intellisense.0bd2cbf8c277e6c1330e345ab3cd7684.png)

- **Autocomplete**. Intelligent suggestions for class names, as well as [CSS functions and directives](https://tailwindcss.com/docs/functions-and-directives).
- **Linting**. Highlights errors and potential bugs in both your CSS and your markup.
- **Hover Previews**. See the complete CSS for a Tailwind class name by hovering over it.
- **Syntax Highlighting**. Provides syntax definitions so that Tailwind features are highlighted correctly.

Check out the project [on GitHub](https://github.com/tailwindcss/intellisense) to learn more, or [add it to Visual Studio Code](vscode:extension/bradlc.vscode-tailwindcss) to get started now.

## JetBrains IDEs

JetBrains IDEs like WebStorm, PhpStorm, and others include support for intelligent Tailwind CSS completions in your HTML and when using `@apply`.

[Learn more about Tailwind CSS support in JetBrains IDEs →](https://www.jetbrains.com/help/webstorm/tailwind-css.html)

[←Upgrade Guide](https://tailwindcss.com/docs/upgrading-to-v2)[Using with Preprocessors
  ](https://tailwindcss.com/docs/using-with-preprocessors)



---



# Using with Preprocessors

A guide to using Tailwind with common CSS preprocessors like Sass, Less, and Stylus.

Since Tailwind is a PostCSS plugin, there’s nothing stopping you from using it with Sass, Less, Stylus, or other preprocessors, just like you can with other PostCSS plugins like [Autoprefixer](https://github.com/postcss/autoprefixer).

It’s important to note that **you don’t need to use a preprocessor with Tailwind** — you typically write very little CSS on a Tailwind project anyways so using a preprocessor just isn’t as beneficial as it would be in a project where you write a lot of custom CSS.

This guide only exists as a reference for people who need to or would like to integrate Tailwind with a preprocessor for one reason or another.

------

## Using PostCSS as your preprocessor

If you’re using Tailwind for a brand new project and don’t need to integrate it with any existing Sass/Less/Stylus stylesheets, you should highly consider relying on other PostCSS plugins to add the preprocessor features you use instead of using a separate preprocessor.

This has a few benefits:

- **Your builds will be faster**. Since your CSS doesn’t have to be parsed and processed by multiple tools, your CSS will compile much quicker using only PostCSS.
- **No quirks or workarounds.** Because Tailwind adds some new non-standard keywords to CSS (like `@tailwind`, `@apply`, `theme()`, etc.), you often have to write your CSS in annoying, unintuitive ways to get a preprocessor to give you the expected output. Working exclusively with PostCSS avoids this.

For a fairly comprehensive list of available PostCSS plugins see the [PostCSS GitHub repository](https://github.com/postcss/postcss/blob/master/docs/plugins.md), but here are a few important ones we use on our own projects and can recommend.

### Build-time imports

One of the most useful features preprocessors offer is the ability to organize your CSS into multiple files and combine them at build time by processing `@import` statements in advance, instead of in the browser.

The canonical plugin for handling this with PostCSS is [postcss-import](https://github.com/postcss/postcss-import).

To use it, install the plugin via npm:

```shell
# npm
npm install postcss-import

# yarn
yarn add postcss-import
```

Then add it as the very first plugin in your PostCSS configuration:

```js
// postcss.config.js
module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
  ]
}
```

One important thing to note about `postcss-import` is that it strictly adheres to the CSS spec and disallows `@import` statements anywhere except at the very top of a file.

**Won't work, `@import` statements must come first**

```css
/* components.css */

.btn {
  @apply px-4 py-2 rounded font-semibold bg-gray-200 text-black;
}

/* Will not work */
@import "./components/card";
```

The easiest solution to this problem is to never mix regular CSS and imports in the same file. Instead, create one main entry-point file for your imports, and keep all of your actual CSS in separate files.

**Use separate files for imports and actual CSS**

```css
/* components.css */
@import "./components/buttons.css";
@import "./components/card.css";
/* components/buttons.css */
.btn {
  @apply px-4 py-2 rounded font-semibold bg-gray-200 text-black;
}
/* components/card.css */
.card {
  @apply p-4 bg-white shadow rounded;
}
```

The place you are most likely to run into this situation is in your main CSS file that includes your `@tailwind` declarations.

**Won't work, `@import` statements must come first**

```css
@tailwind base;
@import "./custom-base-styles.css";

@tailwind components;
@import "./custom-components.css";

@tailwind utilities;
@import "./custom-utilities.css";
```

You can solve this by creating separate files for each `@tailwind` declaration, and then importing those files in your main stylesheet. To make this easy, we provide separate files for each `@tailwind` declaration out of the box that you can import directly from `node_modules`.

The `postcss-import` plugin is smart enough to look for files in the `node_modules` folder automatically, so you don’t need to provide the entire path — `"tailwindcss/base"` for example is enough.

**Import our provided CSS files**

```css
@import "tailwindcss/base";
@import "./custom-base-styles.css";

@import "tailwindcss/components";
@import "./custom-components.css";

@import "tailwindcss/utilities";
@import "./custom-utilities.css";
```

### Nesting

To add support for nested declarations, you have two options:

- [postcss-nested](https://github.com/postcss/postcss-nested), which uses a syntax much like Sass.
- [postcss-nesting](https://github.com/jonathantneal/postcss-nesting), which follows the [CSS Nesting](https://drafts.csswg.org/css-nesting-1/) specification that will hopefully be available directly in the browser in the future.

To use either of these plugins, install them via npm:

```shell
# npm
npm install postcss-nested  # or postcss-nesting

# yarn
yarn add postcss-nested  # or postcss-nesting
```

Then add them to your PostCSS configuration, somewhere after Tailwind itself but before Autoprefixer:

```js
// postcss.config.js
module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'), // or require('postcss-nesting')
    require('autoprefixer'),
  ]
}
```

### Variables

These days CSS variables (officially known as custom properties) have really good [browser support](https://caniuse.com/#search=css custom properties), so you may not actually need a plugin for variables at all.

However if you need to support IE11, you can use the [postcss-custom-properties](https://github.com/postcss/postcss-custom-properties) plugin to automatically create fallbacks for your variables.

To use it, install it via npm:

```shell
# npm
npm install postcss-custom-properties

# yarn
yarn add postcss-custom-properties
```

Then add it to your PostCSS configuration, somewhere after Tailwind itself but before Autoprefixer:

```js
// postcss.config.js
module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-nested'),
    require('postcss-custom-properties'),
    require('autoprefixer'),
  ]
}
```

### Future CSS features

You can add support for dozens of upcoming CSS features to your project using the [postcss-preset-env](https://github.com/csstools/postcss-preset-env) plugin.

To use it, install it via npm:

```shell
# npm
npm install postcss-preset-env

# yarn
yarn add postcss-preset-env
```

Then add it to your PostCSS configuration somewhere after Tailwind itself:

```js
// postcss.config.js
module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('postcss-preset-env')({ stage: 1 }),
  ]
}
```

**It’s important to note that CSS variables, nesting, and autoprefixer are included out-of-the-box**, so if you’re using `postcss-preset-env`, you don’t need to add separate plugins for those features.

------

## Using Sass, Less, or Stylus

To use Tailwind with a preprocessing tool like Sass, Less, or Stylus, you’ll need to add an additional build step to your project that lets you run your preprocessed CSS through PostCSS. If you’re using Autoprefixer in your project, you already have something like this set up.

The exact instructions will be different depending on which build tool you are using, so see our [installation documentation](https://tailwindcss.com/docs/installation#3-process-your-css-with-tailwind) to learn more about integrating Tailwind into your existing build process.

The most important thing to understand about using Tailwind with a preprocessor is that **preprocessors like Sass, Less, and Stylus run separately, before Tailwind**. This means that you can’t feed output from Tailwind’s `theme()` function into a Sass color function for example, because the `theme()` function isn’t actually evaluated until your Sass has been compiled to CSS and fed into PostCSS.

**Won't work, Sass is processed first**

```css
.alert {
  background-color: darken(theme('colors.red.500'), 10%);
}
```

For the most cohesive development experience, it’s recommended that you [use PostCSS exclusively](https://tailwindcss.com/docs/using-with-preprocessors#using-post-css-as-your-preprocessor).

Aside from that, each preprocessor has its own quirk or two when used with Tailwind, which are outlined with workarounds below.

### Sass

When using Tailwind with Sass, using `!important` with `@apply` requires you to use interpolation to compile properly.

**Won't work, Sass complains about !important**

```css
.alert {
  @apply bg-red-500 !important;
}
```

**Use interpolation as a workaround**

```css
.alert {
  @apply bg-red-500 #{!important};
}
```

### Less

When using Tailwind with Less, you cannot nest Tailwind’s `@screen` directive.

**Won't work, Less doesn't realise it's a media query**

```css
.card {
  @apply rounded-none;

  @screen sm {
    @apply rounded-lg;
  }
}
```

Instead, use a regular media query along with the `theme()` function to reference your screen sizes, or simply don’t nest your `@screen` directives.

**Use a regular media query and theme()**

```css
.card {
  @apply rounded-none;

  @media (min-width: theme('screens.sm')) {
    @apply rounded-lg;
  }
}
```

**Use the @screen directive at the top-level**

```css
.card {
  @apply rounded-none;
}
@screen sm {
  .card {
    @apply rounded-lg;
  }
}
```

### Stylus

When using Tailwind with Stylus, you can’t use Tailwind’s `@apply` feature without wrapping the entire CSS rule in `@css` so that Stylus treats it as literal CSS:

**Won't work, Stylus complains about @apply**

```css
.card {
  @apply rounded-lg bg-white p-4
}
```

**Use @css to avoid processing as Stylus**

```css
@css {
  .card {
    @apply rounded-lg bg-white p-4
  }
}
```

This comes with a significant cost however, which is that **you cannot use any Stylus features inside a `@css` block**.

Another option is to use the `theme()` function instead of `@apply`, and write out the actual CSS properties in long form:

**Use theme() instead of @apply**

```css
.card {
  border-radius: theme('borderRadius.lg');
  background-color: theme('colors.white');
  padding: theme('spacing.4');
}
```

In addition to this, Stylus doesn’t support nesting the `@screen` directive (just like Less).

**Won't work, Stylus doesn't realise it's a media query**

```css
.card {
  border-radius: 0;

  @screen sm {
    border-radius: theme('borderRadius.lg');
  }
}
```

Instead, use a regular media query along with the `theme()` function to reference your screen sizes, or simply don’t nest your `@screen` directives.

**Use a regular media query and theme()**

```css
.card {
  border-radius: 0;

  @media (min-width: theme('screens.sm')) {
    border-radius: theme('borderRadius.lg');
  }
}
```

**Use the @screen directive at the top-level**

```css
.card {
  border-radius: 0;
}
@screen sm {
  .card {
    border-radius: theme('borderRadius.lg');
  }
}
```

[←Editor Support](https://tailwindcss.com/docs/editor-support)[Optimizing for Production
  ](https://tailwindcss.com/docs/optimizing-for-production)



---



# Optimizing for Production

Removing unused CSS from your production builds for maximum performance.

## Overview

Using the default configuration, the development build of Tailwind CSS is 3566.2kB uncompressed, 289.2kB minified and compressed with [Gzip](https://www.gnu.org/software/gzip/), and 71.3kB when compressed with [Brotli](https://github.com/google/brotli).

| Uncompressed | Minified | Gzip    | Brotli |
| ------------ | -------- | ------- | ------ |
| 3566.2kB     | 2872.2kB | 289.2kB | 71.3kB |

This might sound enormous but **the development build is large by design**.

To make the development experience as productive as possible, Tailwind generates thousands of utility classes for you, most of which you probably won’t actually use.

Think of Tailwind like a giant box of LEGO — you dump it all out on the floor and build what you want to build, then when you’re done you put all the pieces you didn’t use back into the box.

For example, Tailwind generates margin utilities for every size in your spacing scale, for every side of an element you might want to apply margin to, at every breakpoint you are using in your project. This leads to hundreds of different combinations that are all important to have available, but not all likely to be needed.

**When building for production, you should always use Tailwind’s `purge` option to tree-shake unused styles and optimize your final build size.** When removing unused styles with Tailwind, it’s very hard to end up with more than 10kb of compressed CSS.

## Writing purgeable HTML

Before getting started with the `purge` feature, it’s important to understand how it works and build the correct mental model to make sure you never accidentally remove important styles when building for production.

[PurgeCSS](https://purgecss.com/) *(the library we use under the hood)* is intentionally very naive in the way it looks for classes in your HTML. It doesn’t try to parse your HTML and look for class attributes or dynamically execute your JavaScript — it simply looks for any strings in the entire file that match this regular expression:

```js
/[^<>"'`\s]*[^<>"'`\s:]/g
```

This basically matches any string separated by spaces, quotes or angle brackets, including HTML tags, attributes, classes, and even the actual written content in your markup.

![Woman paying for a purchase](https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80)

MARKETING

[Finding customers for your new business](https://tailwindcss.com/docs/optimizing-for-production#)

Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.

```html
<div class="md:flex">
  <div class="md:flex-shrink-0">
    <img class="rounded-lg md:w-56" src="/img/shopping.jpg" alt="Woman paying for a purchase">
  </div>
  <div class="mt-4 md:mt-0 md:ml-6">
    <div class="uppercase tracking-wide text-sm text-indigo-600 font-bold">
      Marketing
    </div>
    <a href="/get-started" class="block mt-1 text-lg leading-tight font-semibold text-gray-900 hover:underline">
      Finding customers for your new business
    </a>
    <p class="mt-2 text-gray-600">
      Getting a new business off the ground is a lot of hard work.
      Here are five ideas you can use to find your first customers.
    </p>
  </div>
</div>
```

That means that **it is important to avoid dynamically creating class strings in your templates with string concatenation**, otherwise PurgeCSS won’t know to preserve those classes.

**Don't use string concatenation to create class names**

```html
<div class="text-{{  error  ?  'red'  :  'green'  }}-600"></div>
```

**Do dynamically select a complete class name**

```html
<div class="{{  error  ?  'text-red-600'  :  'text-green-600'  }}"></div>
```

As long as a class name appears in your template *in its entirety*, PurgeCSS will not remove it.

## Removing unused CSS

### Basic usage

To get started, provide an array of paths to all of your template files using the `purge` option:

```js
// tailwind.config.js
module.exports = {
  purge: [
    './src/**/*.html',
    './src/**/*.vue',
    './src/**/*.jsx',
  ],
  theme: {},
  variants: {},
  plugins: [],
}
```

**This list should include \*any\* files in your project that reference any of your styles by name.** For example, if you have a JS file in your project that dynamically toggles some classes in your HTML, you should make sure to include that file in this list.

Now whenever you compile your CSS with `NODE_ENV` set to `production`, Tailwind will automatically purge unused styles from your CSS.

### Enabling manually

If you want to manually control whether unused styles should be removed (instead of depending implicitly on the environment variable), you can use an object syntax and provide the `enabled` option, specifying your templates using the `content` option:

```js
// tailwind.config.js
module.exports = {
  purge: {
    enabled: true,
    content: ['./src/**/*.html'],
  },
  // ...
}
```

We recommend only removing unused styles in production, as removing them in development means you need to recompile any time you change your templates and compiling with PurgeCSS enabled is much slower.

### Preserving HTML elements

By default, Tailwind will preserve all basic HTML element styles in your CSS, like styles for the `html`, `body`, `p`, `h1`, etc. tags. This is to minimize accidentally over-purging in cases where you are using markdown source files for example (where there is no actual `h1` tag present), or using a framework that hides the document shell (containing the `html` and `body` tags) somewhere in a vendor directory (like Next.js does).

If you want to disable this behavior, you can set `preserveHtmlElements` to false:

```js
// tailwind.config.js
module.exports = {
  purge: {
    preserveHtmlElements: false,
    content: ['./src/**/*.html'],
  },
  // ...
}
```

We generally do not recommend this and believe that the risks outweigh the benefits, but we’re not the cops, do whatever you want.

### Purging specific layers

By default, Tailwind will purge all styles in the `base`, `components`, and `utilities` layers. If you’d like to change this, use the `layers` option to manually specify the layers you’d like to purge:

```js
// tailwind.config.js
module.exports = {
  purge: {
    layers: ['components', 'utilities'],
    content: ['./src/**/*.html'],
  },
  // ...
}
```

### Removing all unused styles

By default, Tailwind will only remove unused classes that it generates itself, or has been explicitly wrapped in a `@layer` directive. It will *not* remove unused styles from third-party CSS you pull in to your project, like a datepicker library you pull in for example.

```css
/* These styles will all be purged */
@tailwind base;
@tailwind components;
@tailwind utilities;

/* These styles will be purged */
@layer components {
  .btn { /* ... */ }
}

/* These styles will not be purged */
.flatpickr-innerContainer { /* ... */ }
.flatpickr-weekdayContainer { /* ... */ }
.flatpickr-weekday { /* ... */ }
```

This is to avoid accidentally removing styles that you might need but are not directly referenced in your templates, like classes that are only referenced deep in your `node_modules` folder that are part of some other dependency.

If you really want to remove *all* unused styles, set `mode: 'all'` and `preserveHtmlElements: false` and **be very careful** to provide the paths to *all* files that might reference any classes or HTML elements:

```js
// tailwind.config.js
module.exports = {
  purge: {
    mode: 'all',
    preserveHtmlElements: false,
    content: [
      './src/**/*.js',
      './node_modules/flatpickr/**/*.js',
    ],
  },
  // ...
}
```

**We do not recommend this**, and generally find you get 99% of the file size benefits by sticking with the more conservative default approach.

### Removing unused keyframes

PurgeCSS does not remove unused `@keyframes` rules by default, so you may notice some animation related styles left over in your stylesheet even if you aren’t using them. You can remove these using PurgeCSS’s `keyframes` option under `options`:

```js
// tailwind.config.js
module.exports = {
  purge: {
    content: ['./src/**/*.html'],
    options: {
      keyframes: true,
    },
  },
  // ...
}
```

### PurgeCSS options

If you need to pass any other options directly to PurgeCSS, you can do so using `options`:

```js
// tailwind.config.js
module.exports = {
  purge: {
    content: ['./src/**/*.html'],

    // These options are passed through directly to PurgeCSS
    options: {
      safelist: ['bg-red-500', 'px-4'],
      blocklist: [/^debug-/],
      keyframes: true,
      fontFace: true,
    },
  },
  // ...
}
```

A list of available options can be found in the [PurgeCSS documentation](https://purgecss.com/configuration.html#options).

------

## Alternate approaches

If you can’t use PurgeCSS for one reason or another, you can also reduce Tailwind’s footprint by removing unused values from [your configuration file](https://tailwindcss.com/docs/configuration).

The default theme provides a very generous set of colors, breakpoints, sizes, margins, etc. to make sure that when you pull Tailwind down to prototype something, create a CodePen demo, or just try out the workflow, the experience is as enjoyable and fluid as possible.

We don’t want you to have to go and write new CSS because we didn’t provide enough padding helpers out of the box, or because you wanted to use an orange color scheme for your demo and we only gave you blue.

This comes with a trade-off though: the default build is significantly heavier than it would be on a project with a purpose-built configuration file.

Here are a few strategies you can use to keep your generated CSS small and performant.

### Limiting your color palette

The default theme includes a whopping [84 colors](https://tailwindcss.com/docs/customizing-colors) used for backgrounds, borders, text, and placeholders, all of which also have `hover:` and `focus:` variants, as well as responsive variants at the six default screen sizes.

By default, there are *thousands* of classes generated to accommodate these colors, and it makes up close to half of the final build size.

Very few projects actually need this many colors, and removing colors you don’t need can have a huge impact on the overall file size.

Here’s how using a smaller color palette affects the final size:

| Colors         | Original | Minified | Gzip    | Brotli |
| -------------- | -------- | -------- | ------- | ------ |
| 84 *(default)* | 3566.2kB | 2872.2kB | 289.2kB | 71.3kB |
| 50             | 2726.9kB | 2167.5kB | 231.9kB | 57.2kB |
| 25             | 2098.6kB | 1639.0kB | 189.9kB | 47.1kB |

### Removing unused breakpoints

Since almost every Tailwind utility is copied for every screen size, using fewer screen sizes can have a huge impact on the overall file size as well.

Here’s how defining fewer screens affects the output:

| Breakpoints   | Original | Minified | Gzip    | Brotli |
| ------------- | -------- | -------- | ------- | ------ |
| 5 *(default)* | 3566.2kB | 2872.2kB | 289.2kB | 71.3kB |
| 3             | 2343.9kB | 1894.0kB | 192.8kB | 60.9kB |
| 2             | 1742.7kB | 1414.7kB | 145.0kB | 55.3kB |
| 1             | 1141.7kB | 935.6kB  | 96.8kB  | 50.7kB |

If you only need 3 screen sizes and 35 colors, you're down to 44.3kB compressed without changing anything else.

### Disabling unused core plugins and variants

If you don’t expect to need a certain utility plugin in your project at all, you can disable it completely by setting it to `false` in the `corePlugins` section of your config file:

```js
// tailwind.config.js
module.exports = {
  // ...
  corePlugins: {
    float: false
  }
}
```

If you only need a handful of utilities, you can pass an array to `corePlugins` with the utility plugins you want to keep.

```js
// tailwind.config.js
module.exports = {
  // ...
  corePlugins: [
    'margin',
    'padding'
  ]
}
```

The above would disable all utilities except margin and padding.

If you need a utility but don’t need the responsive versions, set its variants to an empty array to generate 83% fewer classes:

```js
module.exports = {
  // ...
  variants: {
    appearance: []
  }
}
```

These are mostly small wins compared to limiting your color palette or using fewer breakpoints, but they can still add up.

[←Using with Preprocessors](https://tailwindcss.com/docs/using-with-preprocessors)[Browser Support
  ](https://tailwindcss.com/docs/browser-support)



---



# Browser Support

Understanding which browsers Tailwind supports and how to manage vendor prefixes.

As of v2.0, Tailwind CSS is designed for and tested on the latest stable versions of Chrome, Firefox, Edge, and Safari. Tailwind CSS v2.0 does not support any version of IE, including IE 11.

If you need to support IE 11, we recommend using Tailwind CSS v1.9, which is still an excellent and very productive framework.

Certain features such as `focus-visible` are included but not supported natively by all modern browsers. We’ve included information about recommended polyfills for those features directly alongside the documentation for the features themselves.

## Vendor Prefixes

If you’re compiling your CSS using the `tailwindcss` CLI tool, vendor prefixes will be added automatically.

If not, we recommend that you use [Autoprefixer](https://github.com/postcss/autoprefixer).

To use it, install it via npm:

```shell
# Using npm
npm install autoprefixer

# Using Yarn
yarn add autoprefixer
```

Then add it to the very end of your plugin list in your PostCSS configuration:

```js
module.exports = {
  plugins: [
    require('tailwindcss'),
    require('autoprefixer'),
  ]
}
```

[←Optimizing for Production](https://tailwindcss.com/docs/optimizing-for-production)[Utility-First
  ](https://tailwindcss.com/docs/utility-first)