---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Transition Property

Utilities for controlling which CSS properties transition.

## Default class reference

| Class                | Properties                                                   |
| -------------------- | ------------------------------------------------------------ |
| transition-none      | transition-property: none;                                   |
| transition-all       | transition-property: all; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; |
| transition           | transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; |
| transition-colors    | transition-property: background-color, border-color, color, fill, stroke; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; |
| transition-opacity   | transition-property: opacity; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; |
| transition-shadow    | transition-property: box-shadow; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; |
| transition-transform | transition-property: transform; transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); transition-duration: 150ms; |

## Usage

Use the `transition-{properties}` utilities to specify which properties should transition when they change.

Hover me

```html
<button class="transition duration-500 ease-in-out bg-blue-600 hover:bg-red-600 transform hover:-translate-y-1 hover:scale-110 ...">
  Hover me
</button>
```

## Prefers-reduced-motion

You can conditionally apply animations and transitions using the `motion-safe` and `motion-reduce` variants:

```html
<button class="transition transform hover:-translate-y-1 motion-reduce:transition-none motion-reduce:transform-none ...">
  Hover me
</button>
```

**These variants are not enabled by default**, but you can enable them in the `variants` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  // ...
  variants: {
    transitionProperty: ['responsive', 'motion-safe', 'motion-reduce']
  }
}
```

Learn more in the [variants documentation](https://tailwindcss.com/docs/hover-focus-and-other-states#motion-safe).

## Responsive

To change which properties of an element transition at a specific breakpoint, add a `{screen}:` prefix to any existing transition-property utility. For example, use `md:transition-colors` to apply the `transition-colors` utility at only medium screen sizes and above.

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Property values

By default, Tailwind provides transition-property utilities for seven common property combinations. You change, add, or remove these by customizing the `transitionProperty` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        transitionProperty: {
+         'height': 'height',
+         'spacing': 'margin, padding',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for transition-property utilities.

You can control which variants are generated for the transition-property utilities by modifying the `transitionProperty` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       transitionProperty: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the transition-property utilities in your project, you can disable them entirely by setting the `transitionProperty` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     transitionProperty: false,
    }
  }
```

[←Table Layout](https://tailwindcss.com/docs/table-layout)[Transition Duration
  ](https://tailwindcss.com/docs/transition-duration)



---



# Transition Duration

Utilities for controlling the duration of CSS transitions.

## Default class reference

| Class         | Properties                   |
| ------------- | ---------------------------- |
| duration-75   | transition-duration: 75ms;   |
| duration-100  | transition-duration: 100ms;  |
| duration-150  | transition-duration: 150ms;  |
| duration-200  | transition-duration: 200ms;  |
| duration-300  | transition-duration: 300ms;  |
| duration-500  | transition-duration: 500ms;  |
| duration-700  | transition-duration: 700ms;  |
| duration-1000 | transition-duration: 1000ms; |

## Usage

Use the `duration-{amount}` utilities to control an element’s transition-duration.

Hover meHover meHover me

```html
<button class="transition duration-150 ease-in-out ...">Hover me</button>
<button class="transition duration-300 ease-in-out ...">Hover me</button>
<button class="transition duration-700 ease-in-out ...">Hover me</button>
```

## Responsive

To control an element’s transition-duration at a specific breakpoint, add a `{screen}:` prefix to any existing transition-duration utility. For example, use `md:duration-500` to apply the `duration-500` utility at only medium screen sizes and above.

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Duration values

By default, Tailwind provides eight general purpose transition-duration utilities. You change, add, or remove these by customizing the `transitionDuration` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        transitionDuration: {
+         '0': '0ms',
+         '2000': '2000ms',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for transition-duration utilities.

You can control which variants are generated for the transition-duration utilities by modifying the `transitionDuration` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       transitionDuration: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the transition-duration utilities in your project, you can disable them entirely by setting the `transitionDuration` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     transitionDuration: false,
    }
  }
```

[←Transition Property](https://tailwindcss.com/docs/transition-property)[Transition Timing Function
  ](https://tailwindcss.com/docs/transition-timing-function)



---



# Transition Timing Function

Utilities for controlling the easing of CSS transitions.

## Default class reference

| Class       | Properties                                                |
| ----------- | --------------------------------------------------------- |
| ease-linear | transition-timing-function: linear;                       |
| ease-in     | transition-timing-function: cubic-bezier(0.4, 0, 1, 1);   |
| ease-out    | transition-timing-function: cubic-bezier(0, 0, 0.2, 1);   |
| ease-in-out | transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1); |

## Usage

Use the `ease-{timing}` utilities to control an element’s easing curve.

Hover meHover meHover me

```html
<button class="transition ease-in duration-700 ...">Hover me</button>
<button class="transition ease-out duration-700 ...">Hover me</button>
<button class="transition ease-in-out duration-700 ...">Hover me</button>
```

## Responsive

To control an element’s transition-timing-function at a specific breakpoint, add a `{screen}:` prefix to any existing transition-timing-function utility. For example, use `md:ease-in-out` to apply the `ease-in-out` utility at only medium screen sizes and above.

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Timing values

By default, Tailwind provides four general purpose transition-timing-function utilities. You change, add, or remove these by customizing the `transitionTimingFunction` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        transitionTimingFunction: {
+         'in-expo': 'cubic-bezier(0.95, 0.05, 0.795, 0.035)',
+         'out-expo': 'cubic-bezier(0.19, 1, 0.22, 1)',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for transition-timing-function utilities.

You can control which variants are generated for the transition-timing-function utilities by modifying the `transitionTimingFunction` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       transitionTimingFunction: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the transition-timing-function utilities in your project, you can disable them entirely by setting the `transitionTimingFunction` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     transitionTimingFunction: false,
    }
  }
```

[←Transition Duration](https://tailwindcss.com/docs/transition-duration)[Transition Delay
  ](https://tailwindcss.com/docs/transition-delay)



---

# Transition Delay

Utilities for controlling the delay of CSS transitions.

## Default class reference

| Class      | Properties                |
| ---------- | ------------------------- |
| delay-75   | transition-delay: 75ms;   |
| delay-100  | transition-delay: 100ms;  |
| delay-150  | transition-delay: 150ms;  |
| delay-200  | transition-delay: 200ms;  |
| delay-300  | transition-delay: 300ms;  |
| delay-500  | transition-delay: 500ms;  |
| delay-700  | transition-delay: 700ms;  |
| delay-1000 | transition-delay: 1000ms; |

## Usage

Use the `delay-{amount}` utilities to control an element’s transition-delay.

Hover meHover meHover me

```html
<button class="transition delay-150 duration-300 ease-in-out ...">Hover me</button>
<button class="transition delay-300 duration-300 ease-in-out ...">Hover me</button>
<button class="transition delay-700 duration-300 ease-in-out ...">Hover me</button>
```

## Responsive

To control an element’s transition-delay at a specific breakpoint, add a `{screen}:` prefix to any existing transition-delay utility. For example, use `md:delay-500` to apply the `delay-500` utility at only medium screen sizes and above.

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Delay values

By default, Tailwind provides eight general purpose transition-delay utilities. You change, add, or remove these by customizing the `transitionDelay` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        transitionDelay: {
+         '0': '0ms',
+         '2000': '2000ms',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for transition-delay utilities.

You can control which variants are generated for the transition-delay utilities by modifying the `transitionDelay` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       transitionDelay: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the transition-delay utilities in your project, you can disable them entirely by setting the `transitionDelay` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     transitionDelay: false,
    }
  }
```

[←Transition Timing Function](https://tailwindcss.com/docs/transition-timing-function)[Animation
  ](https://tailwindcss.com/docs/animation)



---



# Animation

Utilities for animating elements with CSS animations.

## Default class reference

| Class          | Properties                                                   |
| -------------- | ------------------------------------------------------------ |
| animate-none   | animation: none;                                             |
| animate-spin   | animation: spin 1s linear infinite; @keyframes spin {  from {    transform: rotate(0deg);  }  to {    transform: rotate(360deg);  } } |
| animate-ping   | animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite; @keyframes ping {  75%, 100% {    transform: scale(2);    opacity: 0;  } } |
| animate-pulse  | animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite; @keyframes pulse {  0%, 100% {    opacity: 1;  }  50% {    opacity: .5;  } } |
| animate-bounce | animation: bounce 1s infinite; @keyframes bounce {  0%, 100% {    transform: translateY(-25%);    animationTimingFunction: cubic-bezier(0.8, 0, 1, 1);  }  50% {    transform: translateY(0);    animationTimingFunction: cubic-bezier(0, 0, 0.2, 1);  } } |

## Spin

Add the `animate-spin` utility to add a linear spin animation to elements like loading indicators.

Processing

```html
<button type="button" class="bg-rose-600 ..." disabled>
  <svg class="animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
    <!-- ... -->
  </svg>
  Processing
</button>
```

## Ping

Add the `animate-ping` utility to make an element scale and fade like a radar ping or ripple of water — useful for things like notification badges.

Transactions

```html
<span class="flex h-3 w-3">
  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-purple-400 opacity-75"></span>
  <span class="relative inline-flex rounded-full h-3 w-3 bg-purple-500"></span>
</span>
```

## Pulse

Add the `animate-pulse` utility to make an element gently fade in and out — useful for things like skeleton loaders.

```html
<div class="border border-light-blue-300 shadow rounded-md p-4 max-w-sm w-full mx-auto">
  <div class="animate-pulse flex space-x-4">
    <div class="rounded-full bg-light-blue-400 h-12 w-12"></div>
    <div class="flex-1 space-y-4 py-1">
      <div class="h-4 bg-light-blue-400 rounded w-3/4"></div>
      <div class="space-y-2">
        <div class="h-4 bg-light-blue-400 rounded"></div>
        <div class="h-4 bg-light-blue-400 rounded w-5/6"></div>
      </div>
    </div>
  </div>
</div>
```

## Bounce

Add the `animate-bounce` utility to make an element bounce up and down — useful for things like “scroll down” indicators.



```html
<svg class="animate-bounce w-6 h-6 ...">
  <!-- ... -->
</svg>
```

## Prefers-reduced-motion

You can conditionally apply animations and transitions using the `motion-safe` and `motion-reduce` variants:

```html
<button type="button" class="bg-indigo-600 ..." disabled>
  <svg class="motion-safe:animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
    <!-- ... -->
  </svg>
  Processing
</button>
```

**These variants are not enabled by default**, but you can enable them in the `variants` section of your `tailwind.config.js` file:

```js
// tailwind.config.js
module.exports = {
  // ...
  variants: {
    animation: ['responsive', 'motion-safe', 'motion-reduce']
  }
}
```

Learn more in the [state variants documentation](https://tailwindcss.com/docs/hover-focus-and-other-states#motion-safe).

## Responsive

To change or disable an animation at a specific breakpoint, add a `{screen}:` prefix to any existing animation utility. For example, use `md:animate-none` to apply the `animate-none` utility at only medium screen sizes and above.

```html
<div class="animate-spin md:animate-none ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

Animations by their very nature tend to be highly project-specific. **The animations we include by default are best thought of as helpful examples**, and you’re encouraged to customize your animations to better suit your needs.

By default, Tailwind provides utilities for four different example animations, as well as the `animate-none` utility. You change, add, or remove these by customizing the `animation` section of your theme configuration.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        animation: {
+         'spin-slow': 'spin 3s linear infinite',
        }
      }
    }
  }
```

To add new animation `@keyframes`, use the `keyframes` section of your theme configuration:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        keyframes: {
+         wiggle: {
+           '0%, 100%': { transform: 'rotate(-3deg)' },
+           '50%': { transform: 'rotate(3deg)' },
+         }
        }
      }
    }
  }
```

You can then reference these keyframes by name in the `animation` section of your theme configuration:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        animation: {
+         wiggle: 'wiggle 1s ease-in-out infinite',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for animation utilities.

You can control which variants are generated for the animation utilities by modifying the `animation` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       animation: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the animation utilities in your project, you can disable them entirely by setting the `animation` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     animation: false,
    }
  }
```

[←Transition Delay](https://tailwindcss.com/docs/transition-delay)[Transform
  ](https://tailwindcss.com/docs/transform)



