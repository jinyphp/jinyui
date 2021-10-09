---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Filter

- Tailwind CSS version

  v2.1+

Utilities for enabling and disabling filters on an element.

## Default class reference

| Class       | Properties                                                   |
| ----------- | ------------------------------------------------------------ |
| filter      | filter: var(--tw-blur) var(--tw-brightness) var(--tw-contrast) var(--tw-grayscale) var(--tw-hue-rotate) var(--tw-invert) var(--tw-saturate) var(--tw-sepia) var(--tw-drop-shadow); |
| filter-none | filter: none;                                                |

## Usage

Use the `filter` utility to enable filters (in combination with other filter utilities like `blur` or `grayscale`), and the `filter-none` utility to remove filters.

```html
<div class="filter grayscale blur-md contrast-200 ...">
  <!-- ... -->
</div>
```

## Responsive

To control filters at a specific breakpoint, add a `{screen}:` prefix to any existing filter utility. For example, use `md:filter-none` to apply the `filter-none` utility at only medium screen sizes and above.

```html
<div class="filter blur-lg md:filter-none ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for filter utilities.

You can control which variants are generated for the filter utilities by modifying the `filter` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       filter: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the filter utilities in your project, you can disable them entirely by setting the `filter` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     filter: false,
    }
  }
```

[←Background Blend Mode](https://tailwindcss.com/docs/background-blend-mode)[Blur
  ](https://tailwindcss.com/docs/blur)



---



# Blur

- Tailwind CSS version

  v2.1+

Utilities for applying blur filters to an element.

## Default class reference

| Class    | Properties             |
| -------- | ---------------------- |
| blur-0   | --tw-blur: blur(0);    |
| blur-sm  | --tw-blur: blur(4px);  |
| blur     | --tw-blur: blur(8px);  |
| blur-md  | --tw-blur: blur(12px); |
| blur-lg  | --tw-blur: blur(16px); |
| blur-xl  | --tw-blur: blur(24px); |
| blur-2xl | --tw-blur: blur(40px); |
| blur-3xl | --tw-blur: blur(64px); |

## Usage

Use the `blur-{amount?}` utilities alongside the `filter` utility to blur an element.

```html
<div class="filter blur-lg ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s blur at a specific breakpoint, add a `{screen}:` prefix to any existing blur utility. For example, use `md:blur-lg` to apply the `blur-lg` utility at only medium screen sizes and above.

```html
<div class="filter blur-sm md:blur-lg ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `blur` utilities are generated using the `blur` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       blur: {
+         xs: '2px',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for blur utilities.

You can control which variants are generated for the blur utilities by modifying the `blur` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       blur: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the blur utilities in your project, you can disable them entirely by setting the `blur` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     blur: false,
    }
  }
```

[←Filter](https://tailwindcss.com/docs/filter)[Brightness
  ](https://tailwindcss.com/docs/brightness)



---



# Brightness

- Tailwind CSS version

  v2.1+

Utilities for applying brightness filters to an element.

## Default class reference

| Class          | Properties                         |
| -------------- | ---------------------------------- |
| brightness-0   | --tw-brightness: brightness(0);    |
| brightness-50  | --tw-brightness: brightness(.5);   |
| brightness-75  | --tw-brightness: brightness(.75);  |
| brightness-90  | --tw-brightness: brightness(.9);   |
| brightness-95  | --tw-brightness: brightness(.95);  |
| brightness-100 | --tw-brightness: brightness(1);    |
| brightness-105 | --tw-brightness: brightness(1.05); |
| brightness-110 | --tw-brightness: brightness(1.1);  |
| brightness-125 | --tw-brightness: brightness(1.25); |
| brightness-150 | --tw-brightness: brightness(1.5);  |
| brightness-200 | --tw-brightness: brightness(2);    |

## Usage

Use the `brightness-{amount?}` utilities alongside the `filter` utility to control an element’s brightness.

```html
<div class="filter brightness-125 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s brightness at a specific breakpoint, add a `{screen}:` prefix to any existing brightness utility. For example, use `md:brightness-150` to apply the `brightness-150` utility at only medium screen sizes and above.

```html
<div class="filter brightness-110 md:brightness-150 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `brightness` utilities are generated using the `brightness` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       brightness: {
+         25: '.25',
+         175: '1.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for brightness utilities.

You can control which variants are generated for the brightness utilities by modifying the `brightness` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       brightness: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the brightness utilities in your project, you can disable them entirely by setting the `brightness` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     brightness: false,
    }
  }
```

[←Blur](https://tailwindcss.com/docs/blur)[Contrast
  ](https://tailwindcss.com/docs/contrast)



---



# Contrast

- Tailwind CSS version

  v2.1+

Utilities for applying contrast filters to an element.

## Default class reference

| Class        | Properties                     |
| ------------ | ------------------------------ |
| contrast-0   | --tw-contrast: contrast(0);    |
| contrast-50  | --tw-contrast: contrast(.5);   |
| contrast-75  | --tw-contrast: contrast(.75);  |
| contrast-100 | --tw-contrast: contrast(1);    |
| contrast-125 | --tw-contrast: contrast(1.25); |
| contrast-150 | --tw-contrast: contrast(1.5);  |
| contrast-200 | --tw-contrast: contrast(2);    |

## Usage

Use the `contrast-{amount?}` utilities alongside the `filter` utility to control an element’s contrast.

```html
<div class="filter contrast-125 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s contrast at a specific breakpoint, add a `{screen}:` prefix to any existing contrast utility. For example, use `md:contrast-150` to apply the `contrast-150` utility at only medium screen sizes and above.

```html
<div class="filter contrast-110 md:contrast-150 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `contrast` utilities are generated using the `contrast` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       contrast: {
+         25: '.25',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for contrast utilities.

You can control which variants are generated for the contrast utilities by modifying the `contrast` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       contrast: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the contrast utilities in your project, you can disable them entirely by setting the `contrast` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     contrast: false,
    }
  }
```

[←Brightness](https://tailwindcss.com/docs/brightness)[Drop Shadow
  ](https://tailwindcss.com/docs/drop-shadow)



---



# Drop Shadow

Utilities for applying drop-shadow filters to an element.

## Default class reference

| Class            | Properties                                                   |
| ---------------- | ------------------------------------------------------------ |
| drop-shadow-sm   | --tw-drop-shadow: drop-shadow(0 1px 1px rgba(0,0,0,0.05));   |
| drop-shadow      | --tw-drop-shadow: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1)) drop-shadow(0 1px 1px rgba(0, 0, 0, 0.06)); |
| drop-shadow-md   | --tw-drop-shadow: drop-shadow(0 4px 3px rgba(0, 0, 0, 0.07)) drop-shadow(0 2px 2px rgba(0, 0, 0, 0.06)); |
| drop-shadow-lg   | --tw-drop-shadow: drop-shadow(0 10px 8px rgba(0, 0, 0, 0.04)) drop-shadow(0 4px 3px rgba(0, 0, 0, 0.1)); |
| drop-shadow-xl   | --tw-drop-shadow: drop-shadow(0 20px 13px rgba(0, 0, 0, 0.03)) drop-shadow(0 8px 5px rgba(0, 0, 0, 0.08)); |
| drop-shadow-2xl  | --tw-drop-shadow: drop-shadow(0 25px 25px rgba(0, 0, 0, 0.15)); |
| drop-shadow-none | --tw-drop-shadow: drop-shadow(0 0 #0000);                    |

## Usage

Use the `drop-shadow-{amount}` utilities alongside the `filter` utility to add a drop shadow to an element.

```html
<div class="filter drop-shadow-lg ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s drop shadow at a specific breakpoint, add a `{screen}:` prefix to any existing drop-shadow utility. For example, use `md:drop-shadow-xl` to apply the `drop-shadow-xl` utility at only medium screen sizes and above.

```html
<div class="filter drop-shadow-md md:drop-shadow-xl ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `drop-shadow` utilities are generated using the `dropShadow` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       dropShadow: {
+         '3xl': '0 35px 35px rgba(0, 0, 0, 0.25)',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for drop-shadow utilities.

You can control which variants are generated for the drop-shadow utilities by modifying the `dropShadow` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       dropShadow: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the drop-shadow utilities in your project, you can disable them entirely by setting the `dropShadow` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     dropShadow: false,
    }
  }
```

[←Contrast](https://tailwindcss.com/docs/contrast)[Grayscale
  ](https://tailwindcss.com/docs/grayscale)



---



# Grayscale

- Tailwind CSS version

  v2.1+

Utilities for applying grayscale filters to an element.

## Default class reference

| Class       | Properties                    |
| ----------- | ----------------------------- |
| grayscale-0 | --tw-grayscale: grayscale(0); |
| grayscale   | --tw-grayscale: grayscale(1); |

## Usage

Use the `grayscale` and `grayscale-0` utilities alongside the `filter` utility to whether an element should be rendered as grayscale or in full color.

```html
<div class="filter grayscale ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s grayscale filter at a specific breakpoint, add a `{screen}:` prefix to any existing grayscale utility. For example, use `md:grayscale-0` to apply the `grayscale-0` utility at only medium screen sizes and above.

```html
<div class="filter grayscale md:grayscale-0 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `grayscale` utilities are generated using the `grayscale` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       grayscale: {
+         50: '50%',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grayscale utilities.

You can control which variants are generated for the grayscale utilities by modifying the `grayscale` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       grayscale: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the grayscale utilities in your project, you can disable them entirely by setting the `grayscale` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     grayscale: false,
    }
  }
```

[←Drop Shadow](https://tailwindcss.com/docs/drop-shadow)[Hue Rotate
  ](https://tailwindcss.com/docs/hue-rotate)



---



# Hue Rotate

- Tailwind CSS version

  v2.1+

Utilities for applying hue-rotate filters to an element.

## Default class reference

| Class           | Properties                            |
| --------------- | ------------------------------------- |
| -hue-rotate-180 | --tw-hue-rotate: hue-rotate(-180deg); |
| -hue-rotate-90  | --tw-hue-rotate: hue-rotate(-90deg);  |
| -hue-rotate-60  | --tw-hue-rotate: hue-rotate(-60deg);  |
| -hue-rotate-30  | --tw-hue-rotate: hue-rotate(-30deg);  |
| -hue-rotate-15  | --tw-hue-rotate: hue-rotate(-15deg);  |
| hue-rotate-0    | --tw-hue-rotate: hue-rotate(0deg);    |
| hue-rotate-15   | --tw-hue-rotate: hue-rotate(15deg);   |
| hue-rotate-30   | --tw-hue-rotate: hue-rotate(30deg);   |
| hue-rotate-60   | --tw-hue-rotate: hue-rotate(60deg);   |
| hue-rotate-90   | --tw-hue-rotate: hue-rotate(90deg);   |
| hue-rotate-180  | --tw-hue-rotate: hue-rotate(180deg);  |

## Usage

Use the `hue-rotate-{amount}` utilities alongside the `filter` utility to blur an element.

```html
<div class="filter hue-rotate-15 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s hue rotation at a specific breakpoint, add a `{screen}:` prefix to any existing hue-rotate utility. For example, use `md:hue-rotate-60` to apply the `hue-rotate-60` utility at only medium screen sizes and above.

```html
<div class="filter hue-rotate-15 md:hue-rotate-60 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `hue-rotate` utilities are generated using the `hueRotate` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       hueRotate: {
+         '-270': '-270deg',
+         270: '270deg',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for hue-rotate utilities.

You can control which variants are generated for the hue-rotate utilities by modifying the `hueRotate` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       hueRotate: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the hue-rotate utilities in your project, you can disable them entirely by setting the `hueRotate` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     hueRotate: false,
    }
  }
```

[←Grayscale](https://tailwindcss.com/docs/grayscale)[Invert
  ](https://tailwindcss.com/docs/invert)



---



# Invert

- Tailwind CSS version

  v2.1+

Utilities for applying invert filters to an element.

## Default class reference

| Class    | Properties              |
| -------- | ----------------------- |
| invert-0 | --tw-invert: invert(0); |
| invert   | --tw-invert: invert(1); |

## Usage

Use the `invert` and `invert-0` utilities alongside the `filter` utility to whether an element should be rendered with inverted colors or normally.

```html
<div class="filter invert ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s invert filter at a specific breakpoint, add a `{screen}:` prefix to any existing invert utility. For example, use `md:invert-0` to apply the `invert-0` utility at only medium screen sizes and above.

```html
<div class="filter invert md:invert-0 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `invert` utilities are generated using the `invert` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       invert: {
+         25: '.25',
+         50: '.5',
+         75: '.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for invert utilities.

You can control which variants are generated for the invert utilities by modifying the `invert` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       invert: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the invert utilities in your project, you can disable them entirely by setting the `invert` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     invert: false,
    }
  }
```

[←Hue Rotate](https://tailwindcss.com/docs/hue-rotate)[Saturate
  ](https://tailwindcss.com/docs/saturate)



---



# Saturate

- Tailwind CSS version

  v2.1+

Utilities for applying saturation filters to an element.

## Default class reference

| Class        | Properties                    |
| ------------ | ----------------------------- |
| saturate-0   | --tw-saturate: saturate(0);   |
| saturate-50  | --tw-saturate: saturate(.5);  |
| saturate-100 | --tw-saturate: saturate(1);   |
| saturate-150 | --tw-saturate: saturate(1.5); |
| saturate-200 | --tw-saturate: saturate(2);   |

## Usage

Use the `saturate-{amount}` utilities alongside the `filter` utility to control an element’s saturation.

```html
<div class="filter saturate-125 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s saturation at a specific breakpoint, add a `{screen}:` prefix to any existing saturate utility. For example, use `md:saturate-150` to apply the `saturate-150` utility at only medium screen sizes and above.

```html
<div class="filter saturate-110 md:saturate-150 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `saturate` utilities are generated using the `saturate` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       saturate: {
+         25: '.25',
+         75: '.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for saturate utilities.

You can control which variants are generated for the saturate utilities by modifying the `saturate` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       saturate: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the saturate utilities in your project, you can disable them entirely by setting the `saturate` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     saturate: false,
    }
  }
```

[←Invert](https://tailwindcss.com/docs/invert)[Sepia
  ](https://tailwindcss.com/docs/sepia)



---



# Sepia

- Tailwind CSS version

  v2.1+

Utilities for applying sepia filters to an element.

## Default class reference

| Class   | Properties            |
| ------- | --------------------- |
| sepia-0 | --tw-sepia: sepia(0); |
| sepia   | --tw-sepia: sepia(1); |

## Usage

Use the `sepia` and `sepia-0` utilities alongside the `filter` utility to whether an element should be rendered as sepia or in full color.

```html
<div class="filter sepia ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s sepia filter at a specific breakpoint, add a `{screen}:` prefix to any existing sepia utility. For example, use `md:sepia-0` to apply the `sepia-0` utility at only medium screen sizes and above.

```html
<div class="filter sepia md:sepia-0 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `sepia` utilities are generated using the `sepia` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       sepia: {
+         25: '.25',
+         75: '.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for sepia utilities.

You can control which variants are generated for the sepia utilities by modifying the `sepia` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       sepia: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the sepia utilities in your project, you can disable them entirely by setting the `sepia` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     sepia: false,
    }
  }
```

[←Saturate](https://tailwindcss.com/docs/saturate)[Backdrop Filter
  ](https://tailwindcss.com/docs/backdrop-filter)



---



# Backdrop Filter

- Tailwind CSS version

  v2.1+

Utilities for enabling and disabling backdrop filters on an element.

## Default class reference

| Class                | Properties                                                   |
| -------------------- | ------------------------------------------------------------ |
| backdrop-filter      | backdrop-filter: var(--tw-backdrop-blur) var(--tw-backdrop-brightness) var(--tw-backdrop-contrast) var(--tw-backdrop-grayscale) var(--tw-backdrop-hue-rotate) var(--tw-backdrop-invert) var(--tw-backdrop-opacity) var(--tw-backdrop-saturate) var(--tw-backdrop-sepia); |
| backdrop-filter-none | backdrop-filter: none;                                       |

## Usage

Use the `backdrop-filter` utility to enable backdrop filters (in combination with other backdrop filter utilities like `backdrop-blur` or `backdrop-grayscale`), and the `backdrop-filter-none` utility to remove filters.

```html
<div class="backdrop-filter backdrop-grayscale backdrop-blur-md backdrop-contrast-200 ...">
  <!-- ... -->
</div>
```

## Responsive

To control backdrop filters at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop filter utility. For example, use `md:backdrop-filter-none` to apply the `backdrop-filter-none` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-blur-lg md:backdrop-filter-none ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for backdrop-filter utilities.

You can control which variants are generated for the backdrop-filter utilities by modifying the `backdropFilter` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropFilter: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop-filter utilities in your project, you can disable them entirely by setting the `backdropFilter` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropFilter: false,
    }
  }
```

[←Sepia](https://tailwindcss.com/docs/sepia)[Backdrop Blur
  ](https://tailwindcss.com/docs/backdrop-blur)



---



# Backdrop Blur

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop blur filters to an element.

## Default class reference

| Class             | Properties                      |
| ----------------- | ------------------------------- |
| backdrop-blur-0   | --tw-backdrop-blur: blur(0);    |
| backdrop-blur-sm  | --tw-backdrop-blur: blur(4px);  |
| backdrop-blur     | --tw-backdrop-blur: blur(8px);  |
| backdrop-blur-md  | --tw-backdrop-blur: blur(12px); |
| backdrop-blur-lg  | --tw-backdrop-blur: blur(16px); |
| backdrop-blur-xl  | --tw-backdrop-blur: blur(24px); |
| backdrop-blur-2xl | --tw-backdrop-blur: blur(40px); |
| backdrop-blur-3xl | --tw-backdrop-blur: blur(64px); |

## Usage

Use the `backdrop-blur-{amount?}` utilities alongside the `backdrop-filter` utility to control an element’s backdrop blur.

```html
<div class="backdrop-filter backdrop-blur-lg ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop blur at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop blur utility. For example, use `md:backdrop-blur-lg` to apply the `backdrop-blur-lg` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-blur-sm md:backdrop-blur-lg ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-blur` utilities are generated using the `backdropBlur` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropBlur: {
+         xs: '2px',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop blur utilities.

You can control which variants are generated for the backdrop blur utilities by modifying the `backdropBlur` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropBlur: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop blur utilities in your project, you can disable them entirely by setting the `backdropBlur` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropBlur: false,
    }
  }
```

[←Backdrop Filter](https://tailwindcss.com/docs/backdrop-filter)[Backdrop Brightness
  ](https://tailwindcss.com/docs/backdrop-brightness)



---



# Backdrop Brightness

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop brightness filters to an element.

## Default class reference

| Class                   | Properties                                  |
| ----------------------- | ------------------------------------------- |
| backdrop-brightness-0   | --tw-backdrop-brightness: brightness(0);    |
| backdrop-brightness-50  | --tw-backdrop-brightness: brightness(.5);   |
| backdrop-brightness-75  | --tw-backdrop-brightness: brightness(.75);  |
| backdrop-brightness-90  | --tw-backdrop-brightness: brightness(.9);   |
| backdrop-brightness-95  | --tw-backdrop-brightness: brightness(.95);  |
| backdrop-brightness-100 | --tw-backdrop-brightness: brightness(1);    |
| backdrop-brightness-105 | --tw-backdrop-brightness: brightness(1.05); |
| backdrop-brightness-110 | --tw-backdrop-brightness: brightness(1.1);  |
| backdrop-brightness-125 | --tw-backdrop-brightness: brightness(1.25); |
| backdrop-brightness-150 | --tw-backdrop-brightness: brightness(1.5);  |
| backdrop-brightness-200 | --tw-backdrop-brightness: brightness(2);    |

## Usage

Use the `backdrop-brightness-{amount?}` utilities alongside the `backdrop-filter` utility to control an element’s backdrop brightness.

```html
<div class="backdrop-filter backdrop-brightness-125 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop brightness at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop brightness utility. For example, use `md:backdrop-brightness-150` to apply the `backdrop-brightness-150` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-brightness-110 md:backdrop-brightness-150 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-brightness` utilities are generated using the `backdropBrightness` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropBrightness: {
+         25: '.25',
+         175: '1.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop brightness utilities.

You can control which variants are generated for the backdrop brightness utilities by modifying the `backdropBrightness` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropBrightness: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop brightness utilities in your project, you can disable them entirely by setting the `backdropBrightness` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropBrightness: false,
    }
  }
```

[←Backdrop Blur](https://tailwindcss.com/docs/backdrop-blur)[Backdrop Contrast
  ](https://tailwindcss.com/docs/backdrop-contrast)



---



# Backdrop Contrast

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop contrast filters to an element.

## Default class reference

| Class                 | Properties                              |
| --------------------- | --------------------------------------- |
| backdrop-contrast-0   | --tw-backdrop-contrast: contrast(0);    |
| backdrop-contrast-50  | --tw-backdrop-contrast: contrast(.5);   |
| backdrop-contrast-75  | --tw-backdrop-contrast: contrast(.75);  |
| backdrop-contrast-100 | --tw-backdrop-contrast: contrast(1);    |
| backdrop-contrast-125 | --tw-backdrop-contrast: contrast(1.25); |
| backdrop-contrast-150 | --tw-backdrop-contrast: contrast(1.5);  |
| backdrop-contrast-200 | --tw-backdrop-contrast: contrast(2);    |

## Usage

Use the `backdrop-contrast-{amount?}` utilities alongside the `backdrop-filter` utility to control an element’s backdrop contrast.

```html
<div class="backdrop-filter backdrop-contrast-125 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop contrast at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop contrast utility. For example, use `md:backdrop-contrast-150` to apply the `backdrop-contrast-150` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-contrast-110 md:backdrop-contrast-150 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-contrast` utilities are generated using the `backdropContrast` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropContrast: {
+         25: '.25',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Backdrop Contrast Scale

You can customize the values for the `backdrop-contrast` filter in your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      backdropContrast: {
        0: '0',
+       25: '.25',
        50: '.5',
        75: '.75',
        100: '1',
        125: '1.25',
        150: '1.5',
        200: '2',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for backdrop contrast utilities.

You can control which variants are generated for the backdrop contrast utilities by modifying the `backdropContrast` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropContrast: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop contrast utilities in your project, you can disable them entirely by setting the `backdropContrast` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropContrast: false,
    }
  }
```

[←Backdrop Brightness](https://tailwindcss.com/docs/backdrop-brightness)[Backdrop Grayscale
  ](https://tailwindcss.com/docs/backdrop-grayscale)



---



# Backdrop Grayscale

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop grayscale filters to an element.

## Default class reference

| Class                | Properties                             |
| -------------------- | -------------------------------------- |
| backdrop-grayscale-0 | --tw-backdrop-grayscale: grayscale(0); |
| backdrop-grayscale   | --tw-backdrop-grayscale: grayscale(1); |

## Usage

Use the `backdrop-grayscale` and `backdrop-grayscale-0` utilities alongside the `backdrop-filter` utility to whether an element’s backdrop should be rendered as grayscale or in full color.

```html
<div class="backdrop-filter backdrop-grayscale ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop grayscale filter at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop grayscale utility. For example, use `md:backdrop-grayscale-0` to apply the `backdrop-grayscale-0` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-grayscale md:backdrop-grayscale-0 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-grayscale` utilities are generated using the `backdropGrayscale` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropGrayscale: {
+         50: '.5',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop grayscale utilities.

You can control which variants are generated for the backdrop grayscale utilities by modifying the `backdropGrayscale` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropGrayscale: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop grayscale utilities in your project, you can disable them entirely by setting the `backdropGrayscale` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropGrayscale: false,
    }
  }
```

[←Backdrop Contrast](https://tailwindcss.com/docs/backdrop-contrast)[Backdrop Hue Rotate
  ](https://tailwindcss.com/docs/backdrop-hue-rotate)



---



# Backdrop Hue Rotate

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop hue-rotate filters to an element.

## Default class reference

| Class                    | Properties                                     |
| ------------------------ | ---------------------------------------------- |
| -backdrop-hue-rotate-180 | --tw-backdrop-hue-rotate: hue-rotate(-180deg); |
| -backdrop-hue-rotate-90  | --tw-backdrop-hue-rotate: hue-rotate(-90deg);  |
| -backdrop-hue-rotate-60  | --tw-backdrop-hue-rotate: hue-rotate(-60deg);  |
| -backdrop-hue-rotate-30  | --tw-backdrop-hue-rotate: hue-rotate(-30deg);  |
| -backdrop-hue-rotate-15  | --tw-backdrop-hue-rotate: hue-rotate(-15deg);  |
| backdrop-hue-rotate-0    | --tw-backdrop-hue-rotate: hue-rotate(0deg);    |
| backdrop-hue-rotate-15   | --tw-backdrop-hue-rotate: hue-rotate(15deg);   |
| backdrop-hue-rotate-30   | --tw-backdrop-hue-rotate: hue-rotate(30deg);   |
| backdrop-hue-rotate-60   | --tw-backdrop-hue-rotate: hue-rotate(60deg);   |
| backdrop-hue-rotate-90   | --tw-backdrop-hue-rotate: hue-rotate(90deg);   |
| backdrop-hue-rotate-180  | --tw-backdrop-hue-rotate: hue-rotate(180deg);  |

## Usage

Use the `backdrop-hue-rotate-{amount}` utilities alongside the `backdrop-filter` utility to blur an element.

```html
<div class="backdrop-filter backdrop-hue-rotate-15 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop hue rotation at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop hue-rotate utility. For example, use `md:backdrop-hue-rotate-60` to apply the `backdrop-hue-rotate-60` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-hue-rotate-15 md:backdrop-hue-rotate-60 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-hue-rotate` utilities are generated using the `backdropHueRotate` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropHueRotate: {
+         '-270': '-270deg',
+         270: '270deg',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop hue-rotate utilities.

You can control which variants are generated for the backdrop hue-rotate utilities by modifying the `backdropHueRotate` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropHueRotate: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop hue-rotate utilities in your project, you can disable them entirely by setting the `backdropHueRotate` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropHueRotate: false,
    }
  }
```

[←Backdrop Grayscale](https://tailwindcss.com/docs/backdrop-grayscale)[Backdrop Invert
  ](https://tailwindcss.com/docs/backdrop-invert)



---



# Backdrop Invert

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop invert filters to an element.

## Default class reference

| Class             | Properties                       |
| ----------------- | -------------------------------- |
| backdrop-invert-0 | --tw-backdrop-invert: invert(0); |
| backdrop-invert   | --tw-backdrop-invert: invert(1); |

## Usage

Use the `backdrop-invert` and `backdrop-invert-0` utilities alongside the `backdrop-filter` utility to whether an element should be rendered with inverted backdrop colors or normally.

```html
<div class="backdrop-filter backdrop-invert ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop invert filter at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop invert utility. For example, use `md:backdrop-invert-0` to apply the `backdrop-invert-0` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-invert md:backdrop-invert-0 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-invert` utilities are generated using the `backdropInvert` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropInvert: {
+         25: '.25',
+         75: '.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop invert utilities.

You can control which variants are generated for the backdrop invert utilities by modifying the `backdropInvert` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropInvert: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop invert utilities in your project, you can disable them entirely by setting the `backdropInvert` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropInvert: false,
    }
  }
```

[←Backdrop Hue Rotate](https://tailwindcss.com/docs/backdrop-hue-rotate)[Backdrop Opacity
  ](https://tailwindcss.com/docs/backdrop-opacity)



---



# Backdrop Opacity

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop opacity filters to an element.

## Default class reference

| Class                | Properties                            |
| -------------------- | ------------------------------------- |
| backdrop-opacity-0   | --tw-backdrop-opacity: opacity(0);    |
| backdrop-opacity-5   | --tw-backdrop-opacity: opacity(0.05); |
| backdrop-opacity-10  | --tw-backdrop-opacity: opacity(0.1);  |
| backdrop-opacity-20  | --tw-backdrop-opacity: opacity(0.2);  |
| backdrop-opacity-25  | --tw-backdrop-opacity: opacity(0.25); |
| backdrop-opacity-30  | --tw-backdrop-opacity: opacity(0.3);  |
| backdrop-opacity-40  | --tw-backdrop-opacity: opacity(0.4);  |
| backdrop-opacity-50  | --tw-backdrop-opacity: opacity(0.5);  |
| backdrop-opacity-60  | --tw-backdrop-opacity: opacity(0.6);  |
| backdrop-opacity-70  | --tw-backdrop-opacity: opacity(0.7);  |
| backdrop-opacity-75  | --tw-backdrop-opacity: opacity(0.75); |
| backdrop-opacity-80  | --tw-backdrop-opacity: opacity(0.8);  |
| backdrop-opacity-90  | --tw-backdrop-opacity: opacity(0.9);  |
| backdrop-opacity-95  | --tw-backdrop-opacity: opacity(0.95); |
| backdrop-opacity-100 | --tw-backdrop-opacity: opacity(1);    |

## Usage

Use the `backdrop-opacity-{amount}` utilities alongside the `backdrop-filter` utility to control the opacity of other backdrop filters applied to an element.

```html
<div class="backdrop-filter backdrop-opacity-80 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop opacity at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop opacity utility. For example, use `md:backdrop-opacity-lg` to apply the `backdrop-opacity-lg` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-opacity-sm md:backdrop-opacity-lg ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-opacity` utilities are generated using the `backdropOpacity` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropOpacity: {
+         15: '.15',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop opacity utilities.

You can control which variants are generated for the backdrop opacity utilities by modifying the `backdropOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropOpacity: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop opacity utilities in your project, you can disable them entirely by setting the `backdropOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropOpacity: false,
    }
  }
```

[←Backdrop Invert](https://tailwindcss.com/docs/backdrop-invert)[Backdrop Saturate
  ](https://tailwindcss.com/docs/backdrop-saturate)



---



# Backdrop Saturate

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop saturation filters to an element.

## Default class reference

| Class                 | Properties                             |
| --------------------- | -------------------------------------- |
| backdrop-saturate-0   | --tw-backdrop-saturate: saturate(0);   |
| backdrop-saturate-50  | --tw-backdrop-saturate: saturate(.5);  |
| backdrop-saturate-100 | --tw-backdrop-saturate: saturate(1);   |
| backdrop-saturate-150 | --tw-backdrop-saturate: saturate(1.5); |
| backdrop-saturate-200 | --tw-backdrop-saturate: saturate(2);   |

## Usage

Use the `saturate-{amount}` utilities alongside the `backdrop-filter` utility to control an element’s backdrop saturation.

```html
<div class="backdrop-filter backdrop-saturate-125 ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backrop saturation at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop saturate utility. For example, use `md:backdrop-saturate-150` to apply the `backdrop-saturate-150` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-saturate-110 md:backdrop-saturate-150 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-saturate` utilities are generated using the `backdropSaturate` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropSaturate: {
+         25: '.25',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop saturate utilities.

You can control which variants are generated for the backdrop saturate utilities by modifying the `backdropSaturate` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropSaturate: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop saturate utilities in your project, you can disable them entirely by setting the `backdropSaturate` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropSaturate: false,
    }
  }
```

[←Backdrop Opacity](https://tailwindcss.com/docs/backdrop-opacity)[Backdrop Sepia
  ](https://tailwindcss.com/docs/backdrop-sepia)



---



# Backdrop Sepia

- Tailwind CSS version

  v2.1+

Utilities for applying backdrop sepia filters to an element.

## Default class reference

| Class            | Properties                     |
| ---------------- | ------------------------------ |
| backdrop-sepia-0 | --tw-backdrop-sepia: sepia(0); |
| backdrop-sepia   | --tw-backdrop-sepia: sepia(1); |

## Usage

Use the `backdrop-sepia` and `backdrop-sepia-0` utilities alongside the `backdrop-filter` utility to whether an element’s backdrop should be rendered as sepia or in full color.

```html
<div class="backdrop-filter backdrop-sepia ...">
  <!-- ... -->
</div>
```

## Responsive

To control an element’s backdrop sepia filter at a specific breakpoint, add a `{screen}:` prefix to any existing backdrop sepia utility. For example, use `md:backdrop-sepia-0` to apply the `backdrop-sepia-0` utility at only medium screen sizes and above.

```html
<div class="backdrop-filter backdrop-sepia md:backdrop-sepia-0 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

You can customize which `backdrop-sepia` utilities are generated using the `backdropSepia` key in the `theme` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
+     extend: {
+       backdropSepia: {
+         25: '.25',
+         75: '.75',
+       }
+     }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for backdrop sepia utilities.

You can control which variants are generated for the backdrop sepia utilities by modifying the `backdropSepia` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       backdropSepia: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the backdrop sepia utilities in your project, you can disable them entirely by setting the `backdropSepia` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     backdropSepia: false,
    }
  }
```

[←Backdrop Saturate](https://tailwindcss.com/docs/backdrop-saturate)[Border Collapse
  ](https://tailwindcss.com/docs/border-collapse)