---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind Utility-First"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Utility-First

Building complex components from a constrained set of primitive utilities.

## Overview

Traditionally, whenever you need to style something on the web, you write CSS.

**Using a traditional approach where custom designs require custom CSS**



ChitChat

You have a new message!

```html
<div class="chat-notification">
  <div class="chat-notification-logo-wrapper">
    <img class="chat-notification-logo" src="/img/logo.svg" alt="ChitChat Logo">
  </div>
  <div class="chat-notification-content">
    <h4 class="chat-notification-title">ChitChat</h4>
    <p class="chat-notification-message">You have a new message!</p>
  </div>
</div>

<style>
  .chat-notification {
    display: flex;
    max-width: 24rem;
    margin: 0 auto;
    padding: 1.5rem;
    border-radius: 0.5rem;
    background-color: #fff;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  }
  .chat-notification-logo-wrapper {
    flex-shrink: 0;
  }
  .chat-notification-logo {
    height: 3rem;
    width: 3rem;
  }
  .chat-notification-content {
    margin-left: 1.5rem;
    padding-top: 0.25rem;
  }
  .chat-notification-title {
    color: #1a202c;
    font-size: 1.25rem;
    line-height: 1.25;
  }
  .chat-notification-message {
    color: #718096;
    font-size: 1rem;
    line-height: 1.5;
  }
</style>
```

With Tailwind, you style elements by applying pre-existing classes directly in your HTML.

**Using utility classes to build custom designs without writing CSS**



ChitChat

You have a new message!

```html
<div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
  <div class="flex-shrink-0">
    <img class="h-12 w-12" src="/img/logo.svg" alt="ChitChat Logo">
  </div>
  <div>
    <div class="text-xl font-medium text-black">ChitChat</div>
    <p class="text-gray-500">You have a new message!</p>
  </div>
</div>
```

In the example above, we’ve used:

- Tailwind’s [flexbox](https://tailwindcss.com/docs/display#flex) and [padding](https://tailwindcss.com/docs/padding) utilities (`flex`, `flex-shrink-0`, and `p-6`) to control the overall card layout
- The [max-width](https://tailwindcss.com/docs/max-width) and [margin](https://tailwindcss.com/docs/margin) utilities (`max-w-sm` and `mx-auto`) to constrain the card width and center it horizontally
- The [background color](https://tailwindcss.com/docs/background-color), [border radius](https://tailwindcss.com/docs/border-radius), and [box-shadow](https://tailwindcss.com/docs/box-shadow) utilities (`bg-white`, `rounded-xl`, and `shadow-md`) to style the card’s appearance
- The [width](https://tailwindcss.com/docs/width) and [height](https://tailwindcss.com/docs/height) utilities (`w-12` and `h-12`) to size the logo image
- The [space-between](https://tailwindcss.com/docs/space) utilities (`space-x-4`) to handle the spacing between the logo and the text
- The [font size](https://tailwindcss.com/docs/font-size), [text color](https://tailwindcss.com/docs/text-color), and [font-weight](https://tailwindcss.com/docs/font-weight) utilities (`text-xl`, `text-black`, `font-medium`, etc.) to style the card text

This approach allows us to implement a completely custom component design without writing a single line of custom CSS.

Now I know what you’re thinking, *“this is an atrocity, what a horrible mess!”* and you’re right, it’s kind of ugly. In fact it’s just about impossible to think this is a good idea the first time you see it — **you have to actually try it**.

But once you’ve actually built something this way, you’ll quickly notice some really important benefits:

- **You aren’t wasting energy inventing class names**. No more adding silly class names like `sidebar-inner-wrapper` just to be able to style something, and no more agonizing over the perfect abstract name for something that’s really just a flex container.
- **Your CSS stops growing**. Using a traditional approach, your CSS files get bigger every time you add a new feature. With utilities, everything is reusable so you rarely need to write new CSS.
- **Making changes feels safer**. CSS is global and you never know what you’re breaking when you make a change. Classes in your HTML are local, so you can change them without worrying about something else breaking.

When you realize how productive you can be working exclusively in HTML with predefined utility classes, working any other way will feel like torture.

------

## Why not just use inline styles?

A common reaction to this approach is wondering, “isn’t this just inline styles?” and in some ways it is — you’re applying styles directly to elements instead of assigning them a class name and then styling that class.

But using utility classes has a few important advantages over inline styles:

- **Designing with constraints**. Using inline styles, every value is a magic number. With utilities, you’re choosing styles from a predefined [design system](https://tailwindcss.com/docs/theme), which makes it much easier to build visually consistent UIs.
- **Responsive design**. You can’t use media queries in inline styles, but you can use Tailwind’s [responsive utilities](https://tailwindcss.com/docs/responsive-design) to build fully responsive interfaces easily.
- **Hover, focus, and other states**. Inline styles can’t target states like hover or focus, but Tailwind’s [state variants](https://tailwindcss.com/docs/hover-focus-and-other-states) make it easy to style those states with utility classes.

This component is fully responsive and includes a button with hover and focus styles, and is built entirely with utility classes:

![Woman's Face](https://tailwindcss.com/img/erin-lindford.jpg)

Erin Lindford

Product Engineer

Message

```html
<div class="py-8 px-8 max-w-sm mx-auto bg-white rounded-xl shadow-md space-y-2 sm:py-4 sm:flex sm:items-center sm:space-y-0 sm:space-x-6">
  <img class="block mx-auto h-24 rounded-full sm:mx-0 sm:flex-shrink-0" src="/img/erin-lindford.jpg" alt="Woman's Face">
  <div class="text-center space-y-2 sm:text-left">
    <div class="space-y-0.5">
      <p class="text-lg text-black font-semibold">
        Erin Lindford
      </p>
      <p class="text-gray-500 font-medium">
        Product Engineer
      </p>
    </div>
    <button class="px-4 py-1 text-sm text-purple-600 font-semibold rounded-full border border-purple-200 hover:text-white hover:bg-purple-600 hover:border-transparent focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-offset-2">Message</button>
  </div>
</div>
```

------

## Maintainability concerns

The biggest maintainability concern when using a utility-first approach is managing commonly repeated utility combinations.

This is easily solved by [extracting components](https://tailwindcss.com/docs/extracting-components), usually as template partials or components.

```html
<!-- PrimaryButton.vue -->
<template>
  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
    <slot/>
  </button>
</template>
```

You can also use Tailwind’s `@apply` feature to create CSS abstractions around common utility patterns.

Click me

```html
<!-- Using utilities -->
<button class="py-2 px-4 font-semibold rounded-lg shadow-md text-white bg-green-500 hover:bg-green-700">
  Click me
</button>

<!-- Extracting classes using @apply -->
<button class="btn btn-green">
  Button
</button>

<style>
  .btn {
    @apply py-2 px-4 font-semibold rounded-lg shadow-md;
  }
  .btn-green {
    @apply text-white bg-green-500 hover:bg-green-700;
  }
</style>
```

Aside from that, maintaining a utility-first CSS project turns out to be a lot easier than maintaining a large CSS codebase, simply because HTML is so much easier to maintain than CSS. Large companies like GitHub, Heroku, Kickstarter, Twitch, Segment, and more are using this approach with great success.

If you’d like to hear about others’ experiences with this approach, check out the following resources:

- [By The Numbers: A Year and a Half with Atomic CSS](https://medium.com/@johnpolacek/by-the-numbers-a-year-and-half-with-atomic-css-39d75b1263b4) by John Polacek
- [Building a Scalable CSS Architecture](https://blog.algolia.com/redesigning-our-docs-part-4-building-a-scalable-css-architecture/) by Sarah Dayan of Algolia
- [Diana Mounter on using utility classes at GitHub](http://www.fullstackradio.com/75), a podcast interview

For even more, check out [The Case for Atomic/Utility-First CSS](https://johnpolacek.github.io/the-case-for-atomic-css/), curated by [John Polacek](https://twitter.com/johnpolacek).

[←Browser Support](https://tailwindcss.com/docs/browser-support)[Responsive Design
  ](https://tailwindcss.com/docs/responsive-design)



---



# Responsive Design

Using responsive utility variants to build adaptive user interfaces.

## Overview

Every utility class in Tailwind can be applied conditionally at different breakpoints, which makes it a piece of cake to build complex responsive interfaces without ever leaving your HTML.

There are five breakpoints by default, inspired by common device resolutions:

| Breakpoint prefix | Minimum width | CSS                                  |
| ----------------- | ------------- | ------------------------------------ |
| `sm`              | 640px         | `@media (min-width: 640px) { ... }`  |
| `md`              | 768px         | `@media (min-width: 768px) { ... }`  |
| `lg`              | 1024px        | `@media (min-width: 1024px) { ... }` |
| `xl`              | 1280px        | `@media (min-width: 1280px) { ... }` |
| `2xl`             | 1536px        | `@media (min-width: 1536px) { ... }` |

To add a utility but only have it take effect at a certain breakpoint, all you need to do is prefix the utility with the breakpoint name, followed by the `:` character:

```html
<!-- Width of 16 by default, 32 on medium screens, and 48 on large screens -->
<img class="w-16 md:w-32 lg:w-48" src="...">
```

This works for **every utility class in the framework**, which means you can change literally anything at a given breakpoint — even things like letter spacing or cursor styles.

Here’s a simple example of a marketing page component that uses a stacked layout on small screens, and a side-by-side layout on larger screens *(resize your browser to see it in action)*:

![Man looking at item at a store](https://images.unsplash.com/photo-1515711660811-48832a4c6f69?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80)

CASE STUDY

[Finding customers for your new business](https://tailwindcss.com/docs/responsive-design#)

Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.

```html
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <div class="md:flex">
    <div class="md:flex-shrink-0">
      <img class="h-48 w-full object-cover md:h-full md:w-48" src="/img/store.jpg" alt="Man looking at item at a store">
    </div>
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Case study</div>
      <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Finding customers for your new business</a>
      <p class="mt-2 text-gray-500">Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.</p>
    </div>
  </div>
</div>
```

Here’s how the example above works:

- By default, the outer `div` is `display: block`, but by adding the `md:flex` utility, it becomes `display: flex` on medium screens and larger.
- When the parent is a flex container, we want to make sure the image never shrinks, so we’ve added `md:flex-shrink-0` to prevent shrinking on medium screens and larger. Technically we could have just used `flex-shrink-0` since it would do nothing on smaller screens, but since it only matters on `md` screens, it’s a good idea to make that clear in the class name.
- On small screens the image is automatically full width by default. On medium screens and up, we’ve constrained the width to a fixed size and ensured the image is full height using `md:h-full md:w-48`.

We’ve only used one breakpoint in this example, but you could easily customize this component at other sizes using the `sm`, `lg`, or `xl` responsive prefixes as well.

------

## Mobile First

By default, Tailwind uses a mobile first breakpoint system, similar to what you might be used to in other frameworks like Bootstrap.

What this means is that unprefixed utilities (like `uppercase`) take effect on all screen sizes, while prefixed utilities (like `md:uppercase`) only take effect at the specified breakpoint *and above*.

### Targeting mobile screens

Where this approach surprises people most often is that to style something for mobile, you need to use the unprefixed version of a utility, not the `sm:` prefixed version. Don’t think of `sm:` as meaning “on small screens”, think of it as “at the small *breakpoint*“.

**Don't use `sm:` to target mobile devices**

```html
<!-- This will only center text on screens 640px and wider, not on small screens -->
<div class="sm:text-center"></div>
```

**Use unprefixed utilities to target mobile, and override them at larger breakpoints**

```html
<!-- This will center text on mobile, and left align it on screens 640px and wider -->
<div class="text-center sm:text-left"></div>
```

For this reason, it’s often a good idea to implement the mobile layout for a design first, then layer on any changes that make sense for `sm` screens, followed by `md` screens, etc.

### Targeting a single breakpoint

Tailwind’s breakpoints only include a `min-width` and don’t include a `max-width`, which means any utilities you add at a smaller breakpoint will also be applied at larger breakpoints.

If you’d like to apply a utility at one breakpoint only, the solution is to *undo* that utility at larger sizes by adding another utility that counteracts it.

Here is an example where the background color is red at the `md` breakpoint, but teal at every other breakpoint:

```html
<div class="bg-teal-500 md:bg-red-500 lg:bg-teal-500">
  <!-- ... -->
</div>
```

Notice that **we did not** have to specify a background color for the `sm` breakpoint or the `xl` breakpoint — you only need to specify when a utility should *start* taking effect, not when it should stop.

------

## Customizing breakpoints

You can completely customize your breakpoints in your `tailwind.config.js` file:

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

Learn more in the [customizing breakpoints documentation](https://tailwindcss.com/docs/breakpoints).

[←Utility-First](https://tailwindcss.com/docs/utility-first)[Hover, Focus, & Other States
  ](https://tailwindcss.com/docs/hover-focus-and-other-states)



---



# Responsive Design

Using responsive utility variants to build adaptive user interfaces.

## Overview

Every utility class in Tailwind can be applied conditionally at different breakpoints, which makes it a piece of cake to build complex responsive interfaces without ever leaving your HTML.

There are five breakpoints by default, inspired by common device resolutions:

| Breakpoint prefix | Minimum width | CSS                                  |
| ----------------- | ------------- | ------------------------------------ |
| `sm`              | 640px         | `@media (min-width: 640px) { ... }`  |
| `md`              | 768px         | `@media (min-width: 768px) { ... }`  |
| `lg`              | 1024px        | `@media (min-width: 1024px) { ... }` |
| `xl`              | 1280px        | `@media (min-width: 1280px) { ... }` |
| `2xl`             | 1536px        | `@media (min-width: 1536px) { ... }` |

To add a utility but only have it take effect at a certain breakpoint, all you need to do is prefix the utility with the breakpoint name, followed by the `:` character:

```html
<!-- Width of 16 by default, 32 on medium screens, and 48 on large screens -->
<img class="w-16 md:w-32 lg:w-48" src="...">
```

This works for **every utility class in the framework**, which means you can change literally anything at a given breakpoint — even things like letter spacing or cursor styles.

Here’s a simple example of a marketing page component that uses a stacked layout on small screens, and a side-by-side layout on larger screens *(resize your browser to see it in action)*:

![Man looking at item at a store](https://images.unsplash.com/photo-1515711660811-48832a4c6f69?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80)

CASE STUDY

[Finding customers for your new business](https://tailwindcss.com/docs/responsive-design#)

Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.

```html
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <div class="md:flex">
    <div class="md:flex-shrink-0">
      <img class="h-48 w-full object-cover md:h-full md:w-48" src="/img/store.jpg" alt="Man looking at item at a store">
    </div>
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Case study</div>
      <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Finding customers for your new business</a>
      <p class="mt-2 text-gray-500">Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.</p>
    </div>
  </div>
</div>
```

Here’s how the example above works:

- By default, the outer `div` is `display: block`, but by adding the `md:flex` utility, it becomes `display: flex` on medium screens and larger.
- When the parent is a flex container, we want to make sure the image never shrinks, so we’ve added `md:flex-shrink-0` to prevent shrinking on medium screens and larger. Technically we could have just used `flex-shrink-0` since it would do nothing on smaller screens, but since it only matters on `md` screens, it’s a good idea to make that clear in the class name.
- On small screens the image is automatically full width by default. On medium screens and up, we’ve constrained the width to a fixed size and ensured the image is full height using `md:h-full md:w-48`.

We’ve only used one breakpoint in this example, but you could easily customize this component at other sizes using the `sm`, `lg`, or `xl` responsive prefixes as well.

------

## Mobile First

By default, Tailwind uses a mobile first breakpoint system, similar to what you might be used to in other frameworks like Bootstrap.

What this means is that unprefixed utilities (like `uppercase`) take effect on all screen sizes, while prefixed utilities (like `md:uppercase`) only take effect at the specified breakpoint *and above*.

### Targeting mobile screens

Where this approach surprises people most often is that to style something for mobile, you need to use the unprefixed version of a utility, not the `sm:` prefixed version. Don’t think of `sm:` as meaning “on small screens”, think of it as “at the small *breakpoint*“.

**Don't use `sm:` to target mobile devices**

```html
<!-- This will only center text on screens 640px and wider, not on small screens -->
<div class="sm:text-center"></div>
```

**Use unprefixed utilities to target mobile, and override them at larger breakpoints**

```html
<!-- This will center text on mobile, and left align it on screens 640px and wider -->
<div class="text-center sm:text-left"></div>
```

For this reason, it’s often a good idea to implement the mobile layout for a design first, then layer on any changes that make sense for `sm` screens, followed by `md` screens, etc.

### Targeting a single breakpoint

Tailwind’s breakpoints only include a `min-width` and don’t include a `max-width`, which means any utilities you add at a smaller breakpoint will also be applied at larger breakpoints.

If you’d like to apply a utility at one breakpoint only, the solution is to *undo* that utility at larger sizes by adding another utility that counteracts it.

Here is an example where the background color is red at the `md` breakpoint, but teal at every other breakpoint:

```html
<div class="bg-teal-500 md:bg-red-500 lg:bg-teal-500">
  <!-- ... -->
</div>
```

Notice that **we did not** have to specify a background color for the `sm` breakpoint or the `xl` breakpoint — you only need to specify when a utility should *start* taking effect, not when it should stop.

------

## Customizing breakpoints

You can completely customize your breakpoints in your `tailwind.config.js` file:

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

Learn more in the [customizing breakpoints documentation](https://tailwindcss.com/docs/breakpoints).

[←Utility-First](https://tailwindcss.com/docs/utility-first)[Hover, Focus, & Other States
  ](https://tailwindcss.com/docs/hover-focus-and-other-states)



---



# Dark Mode

Using Tailwind CSS to style your site in dark mode.

## Basic usage

Now that dark mode is a first-class feature of many operating systems, it’s becoming more and more common to design a dark version of your website to go along with the default design.

To make this as easy as possible, Tailwind includes a `dark` variant that lets you style your site differently when dark mode is enabled:

```html
<div class="bg-white dark:bg-gray-800">
  <h1 class="text-gray-900 dark:text-white">Dark mode is here!</h1>
  <p class="text-gray-600 dark:text-gray-300">
    Lorem ipsum...
  </p>
</div>
```

It’s important to note that because of file size considerations, **the dark mode variant is not enabled in Tailwind by default**.

To enable it, set the `darkMode` option in your `tailwind.config.js` file to `media`:

```js
// tailwind.config.js
module.exports = {
  darkMode: 'media',
  // ...
}
```

Now whenever dark mode is enabled on the user’s operating system, `dark:{class}` classes will take precedence over unprefixed classes. The `media` strategy uses the `prefers-color-scheme` media feature under the hood, but if you’d like to support toggling dark mode manually, you can also [use the ‘class’ strategy](https://tailwindcss.com/docs/dark-mode#toggling-dark-mode-manually) for more control.

By default, when `darkMode` is enabled `dark` variants are only generated for color-related classes, which includes text color, background color, border color, gradients, and placeholder color.

------

## Stacking with other variants

The `dark` variant can be combined with both [responsive](https://tailwindcss.com/docs/responsive-design) variants and [state variants](https://tailwindcss.com/docs/hover-focus-and-other-states) (like hover and focus):

```html
<button class="lg:dark:hover:bg-white ...">
  <!-- ... -->
</button>
```

The responsive variant needs to come first, then `dark`, then the state variant for this to work.

------

## Enabling for other utilities

To enable the `dark` variant for other utilities, add `dark` to the variants list for whatever utility you’d like to enable it for:

```js
// tailwind.config.js
module.exports = {
  // ...
  variants: {
    extend: {
      textOpacity: ['dark']
    }
  }
}
```

By default, the `dark` variant is enabled for `backgroundColor`, `borderColor`, `gradientColorStops`, `placeholderColor`, and `textColor`.

------

## Toggling dark mode manually

If you want to support toggling dark mode manually instead of relying on the operating system preference, use the `class` strategy instead of the `media` strategy:

```js
// tailwind.config.js
module.exports = {
  darkMode: 'class',
  // ...
}
```

Now instead of `dark:{class}` classes being applied based on `prefers-color-scheme`, they will be applied whenever `dark` class is present earlier in the HTML tree.

```html
<!-- Dark mode not enabled -->
<html>
<body>
  <!-- Will be white -->
  <div class="bg-white dark:bg-black">
    <!-- ... -->
  </div>
</body>
</html>

<!-- Dark mode enabled -->
<html class="dark">
<body>
  <!-- Will be black -->
  <div class="bg-white dark:bg-black">
    <!-- ... -->
  </div>
</body>
</html>
```

How you add the `dark` class to the `html` element is up to you, but a common approach is to use a bit of JS that reads a preference from somewhere (like `localStorage`) and updates the DOM accordingly.

Here’s a simple example of how you can support light mode, dark mode, as well as respecting the operating system preference:

```js
// On page load or when changing themes, best to add inline in `head` to avoid FOUC
if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
  document.documentElement.classList.add('dark')
} else {
  document.documentElement.classList.remove('dark')
}

// Whenever the user explicitly chooses light mode
localStorage.theme = 'light'

// Whenever the user explicitly chooses dark mode
localStorage.theme = 'dark'

// Whenever the user explicitly chooses to respect the OS preference
localStorage.removeItem('theme')
```

Again you can manage this however you like, even storing the preference server-side in a database and rendering the class on the server — it’s totally up to you.

### Specificity considerations

When using the `class` strategy, the specificity of dark mode utilities will be higher than regular utilities because the selector contains an extra class. This means that in certain situations the behavior of some combination of utilities can be slightly different in `class` mode than it is in `media` mode.

For example, consider this HTML:

```html
<div class="text-black text-opacity-50 dark:text-white">
  <!-- ... -->
</div>
```

When using the `media` strategy, `dark:text-white` has the same specificity as `text-black` and `text-opacity-50`. Because `text-opacity-50` is defined later in the generated CSS than `dark:text-white`, the white text will have 50% opacity.

When using the `class` strategy, `dark:text-white` has a *higher* specificity, so even though it is defined sooner, it will actually override `text-opacity-50` and reset the opacity back to 1. So when using the `class` strategy, you’ll need to re-specify the opacity in dark mode:

```html
<div class="text-black text-opacity-50 dark:text-white dark:text-opacity-50">
  <!-- ... -->
</div>
```

[←Hover, Focus, & Other States](https://tailwindcss.com/docs/hover-focus-and-other-states)[Adding Base Styles
  ](https://tailwindcss.com/docs/adding-base-styles)



---



# Adding Base Styles

Best practices for adding your own global base styles on top of Tailwind.

Base (or global) styles are the styles at the beginning of a stylesheet that set useful defaults for basic HTML elements like `<a>` tags, headings, etc. or apply opinionated resets like the popular [box-sizing reset](https://www.paulirish.com/2012/box-sizing-border-box-ftw/).

Tailwind includes a useful set of base styles out of the box that we call [Preflight](https://tailwindcss.com/docs/preflight), which is really just [modern-normalize](https://github.com/sindresorhus/modern-normalize) plus a thin layer of additional more opinionated styles.

Preflight is a great starting point for most projects, but if you’d ever like to add your own additional base styles, here are some recommendations for doing it idiomatically.

------

## Using classes in your HTML

If you just want to apply some global styling to the `html` or `body` elements, consider just adding existing classes to those elements in your HTML instead of writing new CSS:

```html
<!doctype html>
<html lang="en" class="text-gray-900 leading-tight">
  <!-- ... -->
  <body class="min-h-screen bg-gray-100">
    <!-- ... -->
  </body>
</html>
```

------

## Using CSS

If you want to apply some base styles to specific elements, the easiest way is to simply add them in your CSS.

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  h1 {
    @apply text-2xl;
  }
  h2 {
    @apply text-xl;
  }
}
```

By using the `@layer` directive, Tailwind will automatically move those styles to the same place as `@tailwind base` to avoid unintended specificity issues.

Using the `@layer` directive will also instruct Tailwind to consider those styles for purging when purging the `base` layer. Read our [documentation on optimizing for production](https://tailwindcss.com/docs/optimizing-for-production) for more details.

It’s a good idea to use [@apply](https://tailwindcss.com/docs/functions-and-directives#apply) or [theme()](https://tailwindcss.com/docs/functions-and-directives#theme) to define these styles to avoid accidentally deviating from your design system.

### @font-face rules

You can use the same approach to add your `@font-face` rules for any custom fonts you’re using:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  @font-face {
    font-family: Proxima Nova;
    font-weight: 400;
    src: url(/fonts/proxima-nova/400-regular.woff) format("woff");
  }
  @font-face {
    font-family: Proxima Nova;
    font-weight: 500;
    src: url(/fonts/proxima-nova/500-medium.woff) format("woff");
  }
}
```

------

## Using a plugin

You can also add base styles by [writing a plugin](https://tailwindcss.com/docs/plugins#adding-base-styles) and using the `addBase` function:

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

Any styles added using `addBase` will be inserted into the `base` layer alongside Tailwind’s other base styles.

[←Dark Mode](https://tailwindcss.com/docs/dark-mode)[Extracting Components
  ](https://tailwindcss.com/docs/extracting-components)



---



# Extracting Components

Dealing with duplication and keeping utility-first projects maintainable.

Tailwind encourages a [utility-first](https://tailwindcss.com/docs/utility-first) workflow, where designs are initially implemented using only utility classes to avoid premature abstraction.

![Man looking at item at a store](https://images.unsplash.com/photo-1515711660811-48832a4c6f69?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=448&q=80)

CASE STUDY

[Finding customers for your new business](https://tailwindcss.com/docs/extracting-components#)

Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.

```html
<div class="max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
  <div class="md:flex">
    <div class="md:flex-shrink-0">
      <img class="h-48 w-full object-cover md:w-48" src="/img/store.jpg" alt="Man looking at item at a store">
    </div>
    <div class="p-8">
      <div class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">Case study</div>
      <a href="#" class="block mt-1 text-lg leading-tight font-medium text-black hover:underline">Finding customers for your new business</a>
      <p class="mt-2 text-gray-500">Getting a new business off the ground is a lot of hard work. Here are five ideas you can use to find your first customers.</p>
    </div>
  </div>
</div>
```

But as a project grows, you’ll inevitably find yourself repeating common utility combinations to recreate the same component in many different places. This is most apparent with small components, like buttons, form elements, badges, etc.

Click me

```html
<!-- Repeating these classes for every button can be painful -->
<button class="py-2 px-4 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
  Click me
</button>
```

Keeping a long list of utility classes in sync across many component instances can quickly become a real maintenance burden, so when you start running into painful duplication like this, it’s a good idea to extract a component.

------

## Extracting template components

It’s very rare that all of the information needed to define a UI component can live entirely in CSS — there’s almost always some important corresponding HTML structure you need to use as well.

**Don't rely on CSS classes to extract complex components**

![Beach](https://images.unsplash.com/photo-1452784444945-3f422708fe5e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=512&q=80)

PRIVATE VILLA

[Relaxing All-Inclusive Resort in Cancun](https://tailwindcss.com/docs/extracting-components#)

$299 USD per night

```html
<style>
  .vacation-card { /* ... */ }
  .vacation-card-info { /* ... */ }
  .vacation-card-eyebrow { /* ... */ }
  .vacation-card-title { /* ... */ }
  .vacation-card-price { /* ... */ }
</style>

<!-- Even with custom CSS, you still need to duplicate this HTML structure -->
<div class="vacation-card">
  <img class="vacation-card-image" src="..." alt="Beach in Cancun">
  <div class="vacation-card-info">
    <div>
      <div class="vacation-card-eyebrow">Private Villa</div>
      <div class="vacation-card-title">
        <a href="/vacations/cancun">Relaxing All-Inclusive Resort in Cancun</a>
      </div>
      <div class="vacation-card-price">$299 USD per night</div>
    </div>
  </div>
</div>
```

For this reason, it’s often better to extract reusable pieces of your UI into *template partials* or *JavaScript components* instead of writing custom CSS classes.

By creating a single source of truth for a template, you can keep using utility classes without any of the maintenance burden created by duplicating the same classes in multiple places.

**Create a template partial or JavaScript component**

```html
<!-- In use -->
<VacationCard
  img="/img/cancun.jpg"
  imgAlt="Beach in Cancun"
  eyebrow="Private Villa"
  title="Relaxing All-Inclusive Resort in Cancun"
  pricing="$299 USD per night"
  url="/vacations/cancun"
/>

<!-- ./components/VacationCard.vue -->
<template>
  <div>
    <img class="rounded" :src="img" :alt="imgAlt">
    <div class="mt-2">
      <div>
        <div class="text-xs text-gray-600 uppercase font-bold">{{ eyebrow }}</div>
        <div class="font-bold text-gray-700 leading-snug">
          <a :href="url" class="hover:underline">{{ title }}</a>
        </div>
        <div class="mt-2 text-sm text-gray-600">{{ pricing }}</div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['img', 'imgAlt', 'eyebrow', 'title', 'pricing', 'url']
  }
</script>
```

The above example uses [Vue](https://vuejs.org/v2/guide/components.html), but the same approach can be used with [React components](https://reactjs.org/docs/components-and-props.html), [ERB partials](https://guides.rubyonrails.org/v5.2/layouts_and_rendering.html#using-partials), [Blade components](https://laravel.com/docs/5.8/blade#components-and-slots), [Twig includes](https://twig.symfony.com/doc/2.x/templates.html#including-other-templates), etc.

------

## Extracting component classes with @apply

For small components like buttons and form elements, creating a template partial or JavaScript component can often feel too heavy compared to a simple CSS class.

In these situations, you can use Tailwind’s `@apply` directive to easily extract common utility patterns to CSS component classes.

Here’s what a `btn-indigo` class might look like using `@apply` to compose it from existing utilities:

Click me

```html
<button class="btn-indigo">
  Click me
</button>

<style>
  .btn-indigo {
    @apply py-2 px-4 bg-indigo-500 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75;
  }
</style>
```

To avoid unintended specificity issues, we recommend wrapping your custom component styles with the `@layer components { ... }` directive to tell Tailwind what [layer](https://tailwindcss.com/docs/functions-and-directives#layer) those styles belong to:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer components {
  .btn-blue {
    @apply py-2 px-4 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75;
  }
}
```

Tailwind will automatically move those styles to the same place as `@tailwind components`, so you don’t have to worry about getting the order right in your source files.

Using the `@layer` directive will also instruct Tailwind to consider those styles for purging when purging the `components` layer. Read our [documentation on optimizing for production](https://tailwindcss.com/docs/optimizing-for-production) for more details.

### Writing a component plugin

In addition to writing component classes directly in your CSS files, you can also add component classes to Tailwind by writing your own plugin:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addComponents, theme }) {
      const buttons = {
        '.btn': {
          padding: `${theme('spacing.2')} ${theme('spacing.4')}`,
          borderRadius: theme('borderRadius.md'),
          fontWeight: theme('fontWeight.600'),
        },
        '.btn-indigo': {
          backgroundColor: theme('colors.indigo.500'),
          color: theme('colors.white'),
          '&:hover': {
            backgroundColor: theme('colors.indigo.600')
          },
        },
      }

      addComponents(buttons)
    })
  ]
}
```

This can be a good choice if you want to publish your Tailwind components as a library or make it easier to share components across multiple projects.

Learn more in the [component plugin documentation](https://tailwindcss.com/docs/plugins#adding-components).

[←Adding Base Styles](https://tailwindcss.com/docs/adding-base-styles)[Adding New Utilities→](https://tailwindcss.com/docs/adding-new-utilities)



---



# Adding New Utilities

Extending Tailwind with your own custom utility classes.

Although Tailwind provides a pretty comprehensive set of utility classes out of the box, you may run into situations where you need to add a few of your own.

Deciding on the best way to extend a framework can be paralyzing, so here are some best practices to help you add your own utilities in the most idiomatic way possible.

------

## Using CSS

The easiest way to add your own utilities to Tailwind is to simply add them to your CSS.

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer utilities {
  .scroll-snap-none {
    scroll-snap-type: none;
  }
  .scroll-snap-x {
    scroll-snap-type: x;
  }
  .scroll-snap-y {
    scroll-snap-type: y;
  }
}
```

By using the `@layer` directive, Tailwind will automatically move those styles to the same place as `@tailwind utilities` to avoid unintended specificity issues.

Using the `@layer` directive will also instruct Tailwind to consider those styles for purging when purging the `utilities` layer. Read our [documentation on optimizing for production](https://tailwindcss.com/docs/optimizing-for-production) for more details.

### Generating responsive variants

If you’d like to generate [responsive variants](https://tailwindcss.com/docs/responsive-design) of your own utilities based on the breakpoints defined in your `tailwind.config.js` file, wrap your utilities in the `@variants` directive and add `responsive` to the list of variants:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer utilities {
  @variants responsive {
    .scroll-snap-none {
      scroll-snap-type: none;
    }
    .scroll-snap-x {
      scroll-snap-type: x;
    }
    .scroll-snap-y {
      scroll-snap-type: y;
    }
  }
}
```

Tailwind will automatically generate prefixed versions of each custom utility that you can use to conditionally apply those styles at different breakpoints:

```html
<!-- Use `scroll-snap-type: none` by default, then use `scroll-snap-type: x` on medium screens and up -->
<div class="scroll-snap-none md:scroll-snap-x"></div>
```

Learn more about responsive utilities in the [responsive design documentation](https://tailwindcss.com/docs/responsive-design).

### Generating dark mode variants

If you’d like to generate [dark mode variants](https://tailwindcss.com/docs/dark-mode) of your own utilities, first make sure `darkMode` is set to either `media` or `class` in your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  darkMode: 'media'
  // ...
}
```

Next, wrap your utilities in the `@variants` directive and add `dark` to the list of variants:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer utilities {
  @variants dark {
    .filter-none {
      filter: none;
    }
    .filter-grayscale {
      filter: grayscale(100%);
    }
  }
}
```

Tailwind will automatically generate prefixed versions of each custom utility that you can use to conditionally apply those styles at different states:

```html
<div class="filter-grayscale dark:filter-none"></div>
```

Learn more about dark mode utilities in the [dark mode documentation](https://tailwindcss.com/docs/dark-mode).

### Generating state variants

If you’d like to create [state variants](https://tailwindcss.com/docs/hover-focus-and-other-states) for your own utilities, wrap your utilities in the `@variants` directive and list the variants you’d like to enable:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer utilities {
  @variants hover, focus {
    .filter-none {
      filter: none;
    }
    .filter-grayscale {
      filter: grayscale(100%);
    }
  }
}
```

Tailwind will automatically generate prefixed versions of each custom utility that you can use to conditionally apply those styles at different states:

```html
<div class="filter-grayscale hover:filter-none"></div>
```

State variants are generated in the same order you list them in the `@variants` directive, so if you’d like one variant to take precedence over another, make sure you list that one last:

```css
/* Focus will take precedence over hover */
@variants hover, focus {
  .filter-grayscale {
    filter: grayscale(100%);
  }
  /* ... */
}

/* Hover will take precedence over focus */
@variants focus, hover {
  .filter-grayscale {
    filter: grayscale(100%);
  }
  /* ... */
}
```

Learn more about state variants in the [state variants documentation](https://tailwindcss.com/docs/hover-focus-and-other-states).

------

## Using a plugin

In addition to adding new utility classes directly in your CSS files, you can also add utilities to Tailwind by writing your own plugin:

```js
// tailwind.config.js
const plugin = require('tailwindcss/plugin')

module.exports = {
  plugins: [
    plugin(function({ addUtilities }) {
      const newUtilities = {
        '.filter-none': {
          filter: 'none',
        },
        '.filter-grayscale': {
          filter: 'grayscale(100%)',
        },
      }

      addUtilities(newUtilities, ['responsive', 'hover'])
    })
  ]
}
```

This can be a good choice if you want to publish your custom utilities as a library or make it easier to share them across multiple projects.

Learn more in the [utility plugin documentation](https://tailwindcss.com/docs/plugins#adding-utilities).

[←Extracting Components](https://tailwindcss.com/docs/extracting-components)[Functions & Directives
  ](https://tailwindcss.com/docs/functions-and-directives)



---



# Functions & Directives

A reference for the custom functions and directives Tailwind exposes to your CSS.

## @tailwind

Use the `@tailwind` directive to insert Tailwind’s `base`, `components`, `utilities` and `screens` styles into your CSS.

```css
/**
 * This injects Tailwind's base styles and any base styles registered by
 * plugins.
 */
@tailwind base;

/**
 * This injects Tailwind's component classes and any component classes
 * registered by plugins.
 */
@tailwind components;

/**
 * This injects Tailwind's utility classes and any utility classes registered
 * by plugins.
 */
@tailwind utilities;

/**
 * Use this directive to control where Tailwind injects the responsive
 * variations of each utility.
 *
 * If omitted, Tailwind will append these classes to the very end of
 * your stylesheet by default.
 */
@tailwind screens;
```

------

## @apply

Use `@apply` to inline any existing utility classes into your own custom CSS.

This is useful when you find a common utility pattern in your HTML that you’d like to extract to a new component.

```css
.btn {
  @apply font-bold py-2 px-4 rounded;
}
.btn-blue {
  @apply bg-blue-500 hover:bg-blue-700 text-white;
}
```

Note that classes are applied based on their location in your original CSS, not based on the order you list them after the `@apply` directive. This is to ensure that the behavior you get when extracting a list of classes with `@apply` matches how those classes behave when listed directly in your HTML.

```css
/* Input */
.btn {
  @apply py-2 p-4;
}

/* Output */
.btn {
  padding: 1rem;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}
```

If you want fine-grained control over the order in which classes are applied, use multiple `@apply` statements:

```css
/* Input */
.btn {
  @apply py-2;
  @apply p-4;
}

/* Output */
.btn {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
  padding: 1rem;
}
```

You can also mix `@apply` declarations with normal CSS declarations:

```css
/* Input */
.btn {
  transform: translateY(-1px);
  @apply bg-black;
}

/* Output */
.btn {
  background-color: #000;
  transform: translateY(-1px);
}
```

Any rules inlined with `@apply` will have `!important` **removed** by default to avoid specificity issues:

```css
/* Input */
.foo {
  color: blue !important;
}

.bar {
  @apply foo;
}

/* Output */
.foo {
  color: blue !important;
}

.bar {
  color: blue;
}
```

If you’d like to `@apply` an existing class and make it `!important`, simply add `!important` to the end of the declaration:

```css
/* Input */
.btn {
  @apply font-bold py-2 px-4 rounded !important;
}

/* Output */
.btn {
  font-weight: 700 !important;
  padding-top: .5rem !important;
  padding-bottom: .5rem !important;
  padding-right: 1rem !important;
  padding-left: 1rem !important;
  border-radius: .25rem !important;
}
```

Note that if you’re using Sass/SCSS, you’ll need to use Sass’ interpolation feature to get this to work:

```css
.btn {
  @apply font-bold py-2 px-4 rounded #{!important};
}
```

------

## @layer

Use the `@layer` directive to tell Tailwind which “bucket” a set of custom styles belong to. Valid layers are a `base`, `components`, and `utilities`.

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

@layer base {
  h1 {
    @apply text-2xl;
  }
  h2 {
    @apply text-xl;
  }
}

@layer components {
  .btn-blue {
    @apply bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded;
  }
}

@layer utilities {
  @variants hover, focus {
    .filter-none {
      filter: none;
    }
    .filter-grayscale {
      filter: grayscale(100%);
    }
  }
}
```

Tailwind will automatically move any CSS within a `@layer` directive to the same place as the corresponding `@tailwind` rule, so you don’t have to worry as much about authoring your CSS in a specific order to avoid specificity issues.

Wrapping any custom CSS in a `@layer` directive also tells Tailwind to consider those styles for purging when purging that layer. Read our [documentation on optimizing for production](https://tailwindcss.com/docs/optimizing-for-production) for more details.

------

## @variants

You can generate `responsive`, `hover`, `focus`, `active`, and other [variants](https://tailwindcss.com/docs/hover-focus-and-other-states) of your own utilities by wrapping their definitions in the `@variants` directive.

```css
@variants focus, hover {
  .rotate-0 {
    transform: rotate(0deg);
  }
  .rotate-90 {
    transform: rotate(90deg);
  }
}
```

This will generate the following CSS:

```css
.rotate-0 {
  transform: rotate(0deg);
}
.rotate-90 {
  transform: rotate(90deg);
}

.focus\:rotate-0:focus {
  transform: rotate(0deg);
}
.focus\:rotate-90:focus {
  transform: rotate(90deg);
}

.hover\:rotate-0:hover {
  transform: rotate(0deg);
}
.hover\:rotate-90:hover {
  transform: rotate(90deg);
}
```

It’s important to note that **variants are generated in the order you specify them**.

So if you want focus utilities to take priority over hover utilities for example, make sure focus comes *after* hover in the list:

```css
/* Input */
@variants hover, focus {
  .banana {
    color: yellow;
  }
}

/* Output */
.banana {
  color: yellow;
}
.hover\:banana:hover {
  color: yellow;
}
.focus\:banana:focus {
  color: yellow;
}
```

The `@variants` at-rule supports all of the values that are supported in the `variants` section of your config file, as well as any [custom variants](https://tailwindcss.com/docs/plugins#adding-variants) added through plugins.

------

## @responsive

You can generate responsive variants of your own classes by wrapping their definitions in the `@responsive` directive:

```css
@responsive {
  .bg-gradient-brand {
    background-image: linear-gradient(blue, green);
  }
}
```

This is a shortcut for writing out `@variants responsive { ... }` which works as well.

Using the default breakpoints, this would generate these classes:

```css
.bg-gradient-brand {
  background-image: linear-gradient(blue, green);
}

/* ... */

@media (min-width: 640px) {
  .sm\:bg-gradient-brand {
    background-image: linear-gradient(blue, green);
  }
  /* ... */
}

@media  (min-width: 768px) {
  .md\:bg-gradient-brand {
    background-image: linear-gradient(blue, green);
  }
  /* ... */
}

@media (min-width: 1024px) {
  .lg\:bg-gradient-brand {
    background-image: linear-gradient(blue, green);
  }
  /* ... */
}

@media (min-width: 1280px) {
  .xl\:bg-gradient-brand {
    background-image: linear-gradient(blue, green);
  }
  /* ... */
}
```

The responsive variants will be added to Tailwind’s existing media queries at the end of your stylesheet. This makes sure that classes with a responsive prefix always defeat non-responsive classes that are targeting the same CSS property.

------

## @screen

The `@screen` directive allows you to create media queries that reference your breakpoints by name instead of duplicating their values in your own CSS.

For example, say you have a `sm` breakpoint at `640px` and you need to write some custom CSS that references this breakpoint.

Instead of writing a raw media query that duplicates that value like this:

```css
@media (min-width: 640px) {
  /* ... */
}
```

…you can use the `@screen` directive and reference the breakpoint by name:

```css
@screen sm {
  /* ... */
}
```

------

## theme()

Use the `theme()` function to access your Tailwind config values using dot notation.

This can be a useful alternative to `@apply` when you want to reference a value from your theme configuration for only part of a declaration:

```css
.content-area {
  height: calc(100vh - theme('spacing.12'));
}
```

If you need to access a value that contains a dot (like the `2.5` value in the spacing scale), you can use square bracket notation:

```css
.content-area {
  height: calc(100vh - theme('spacing[2.5]'));
}
```

Since Tailwind uses a [nested object syntax](https://tailwindcss.com/docs/colors#nested-object-syntax) to define its default color palette, make sure to use dot notation to access the nested colors.

**Don't use the dash syntax when accessing nested color values**

```css
.btn-blue {
  background-color: theme('colors.blue-500');
}
```

**Use dot notation to access nested color values**

```css
.btn-blue {
  background-color: theme('colors.blue.500');
}
```

[←Adding New Utilities](https://tailwindcss.com/docs/adding-new-utilities)[Configuration
  ](https://tailwindcss.com/docs/configuration)