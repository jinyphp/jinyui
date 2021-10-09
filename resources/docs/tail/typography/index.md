---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Font Family

Utilities for controlling the font family of an element.

## Default class reference

| Class      | Properties                                                   |
| ---------- | ------------------------------------------------------------ |
| font-sans  | font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"; |
| font-serif | font-family: ui-serif, Georgia, Cambria, "Times New Roman", Times, serif; |
| font-mono  | font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace; |

## Sans-serif

Use `font-sans` to apply a web safe sans-serif font family:

The quick brown fox jumps over the lazy dog.

```html
<p class="font-sans ...">
  The quick brown fox jumps over the lazy dog.
</p>
```

## Serif

Use `font-serif` to apply a web safe serif font family:

The quick brown fox jumps over the lazy dog.

```html
<p class="font-serif ...">
  The quick brown fox jumps over the lazy dog.
</p>
```

## Monospaced

Use `font-mono` to apply a web safe monospaced font family:

The quick brown fox jumps over the lazy dog.

```html
<p class="font-mono ...">
  The quick brown fox jumps over the lazy dog.
</p>
```

## Responsive

To control the font family of an element at a specific breakpoint, add a `{screen}:` prefix to any existing font family utility class. For example, use `md:font-serif` to apply the `font-serif` utility at only medium screen sizes and above.

```html
<p class="font-sans md:font-serif">
  <!-- ... -->
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Font Families

By default, Tailwind provides three font family utilities: a cross-browser sans-serif stack, a cross-browser serif stack, and a cross-browser monospaced stack. You can change, add, or remove these by editing the `theme.fontFamily` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      fontFamily: {
-       'sans': ['ui-sans-serif', 'system-ui', ...],
-       'serif': ['ui-serif', 'Georgia', ...],
-       'mono': ['ui-monospace', 'SFMono-Regular', ...],
+       'display': ['Oswald', ...],
+       'body': ['Open Sans', ...],
      }
    }
  }
```

Font families can be specified as an array or as a simple comma-delimited string:

```js
{
  // Array format:
  'sans': ['Helvetica', 'Arial', 'sans-serif'],

  // Comma-delimited format:
  'sans': 'Helvetica, Arial, sans-serif',
}
```

Note that **Tailwind does not automatically escape font names** for you. If you’re using a font that contains an invalid identifier, wrap it in quotes or escape the invalid characters.

```js
{
  // Won't work:
  'sans': ['Exo 2', ...],

  // Add quotes:
  'sans': ['"Exo 2"', ...],

  // ...or escape the space:
  'sans': ['Exo\\ 2', ...],
}
```

### Variants

By default, only responsive variants are generated for font family utilities.

You can control which variants are generated for the font family utilities by modifying the `fontFamily` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fontFamily: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the font family utilities in your project, you can disable them entirely by setting the `fontFamily` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fontFamily: false,
    }
  }
```



---



# Font Size

Utilities for controlling the font size of an element.

## Default class reference

| Class     | Properties                                 |
| --------- | ------------------------------------------ |
| text-xs   | font-size: 0.75rem; line-height: 1rem;     |
| text-sm   | font-size: 0.875rem; line-height: 1.25rem; |
| text-base | font-size: 1rem; line-height: 1.5rem;      |
| text-lg   | font-size: 1.125rem; line-height: 1.75rem; |
| text-xl   | font-size: 1.25rem; line-height: 1.75rem;  |
| text-2xl  | font-size: 1.5rem; line-height: 2rem;      |
| text-3xl  | font-size: 1.875rem; line-height: 2.25rem; |
| text-4xl  | font-size: 2.25rem; line-height: 2.5rem;   |
| text-5xl  | font-size: 3rem; line-height: 1;           |
| text-6xl  | font-size: 3.75rem; line-height: 1;        |
| text-7xl  | font-size: 4.5rem; line-height: 1;         |
| text-8xl  | font-size: 6rem; line-height: 1;           |
| text-9xl  | font-size: 8rem; line-height: 1;           |

## Usage

Control the font size of an element using the `text-{size}` utilities.



```html
<p class="text-xs ...">The quick brown fox ...</p>
<p class="text-sm ...">The quick brown fox ...</p>
<p class="text-base ...">The quick brown fox ...</p>
<p class="text-lg ...">The quick brown fox ...</p>
<p class="text-xl ...">The quick brown fox ...</p>
<p class="text-2xl ...">The quick brown fox ...</p>
<p class="text-3xl ...">The quick brown fox ...</p>
<p class="text-4xl ...">The quick brown fox ...</p>
<p class="text-5xl ...">The quick brown fox ...</p>
<p class="text-6xl ...">The quick brown fox ...</p>
<p class="text-7xl ...">The quick brown fox ...</p>
<p class="text-8xl ...">The quick brown fox ...</p>
<p class="text-9xl ...">The quick brown fox ...</p>
```

## Responsive

To control the font size of an element at a specific breakpoint, add a `{screen}:` prefix to any existing font size utility. For example, use `md:text-lg` to apply the `text-lg` utility at only medium screen sizes and above.

```html
<p class="text-base md:text-lg ...">The quick brown fox jumped over the lazy dog.</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Font Sizes

By default, Tailwind provides 10 `font-size` utilities. You change, add, or remove these by editing the `theme.fontSize` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      fontSize: {
-       'xs': '.75rem',
-       'sm': '.875rem',
+       'tiny': '.875rem',
        'base': '1rem',
        'lg': '1.125rem',
        'xl': '1.25rem',
        '2xl': '1.5rem',
-       '3xl': '1.875rem',
-       '4xl': '2.25rem',
        '5xl': '3rem',
        '6xl': '4rem',
+       '7xl': '5rem',
      }
    }
  }
```

### Providing a default line-height

You can provide a default line-height for each of your font-sizes using a tuple of the form `[fontSize, lineHeight]` in your `tailwind.config.js` file.

```js
// tailwind.config.js
module.exports = {
  theme: {
    fontSize: {
      sm: ['14px', '20px'],
      base: ['16px', '24px'],
      lg: ['20px', '28px'],
      xl: ['24px', '32px'],
    }
  }
}
```

We already provide default line heights for each `.text-{size}` class.

### Providing a default letter-spacing

If you also want to provide a default letter-spacing value for a font size, you can do so using a tuple of the form `[fontSize, { letterSpacing, lineHeight }]` in your `tailwind.config.js` file.

```js
// tailwind.config.js
module.exports = {
  theme: {
    fontSize: {
      '2xl': ['24px', {
        letterSpacing: '-0.01em',
      }],
      // Or with a default line-height as well
      '3xl': ['32px', {
        letterSpacing: '-0.02em',
        lineHeight: '40px',
      }],
    }
  }
}
```

### Variants

By default, only responsive variants are generated for text sizing utilities.

You can control which variants are generated for the text sizing utilities by modifying the `fontSize` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fontSize: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text sizing utilities in your project, you can disable them entirely by setting the `fontSize` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fontSize: false,
    }
  }
```



---



# Font Smoothing

Utilities for controlling the font smoothing of an element.

## Default class reference

| Class                | Properties                                                   |
| -------------------- | ------------------------------------------------------------ |
| antialiased          | -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; |
| subpixel-antialiased | -webkit-font-smoothing: auto; -moz-osx-font-smoothing: auto; |

## Subpixel Antialiasing

Use the `subpixel-antialiased` utility to render text using subpixel antialiasing.

The quick brown fox jumped over the lazy dog.

```html
<p class="subpixel-antialiased ...">The quick brown fox ...</p>
```

## Grayscale Antialiasing

Use the `antialiased` utility to render text using grayscale antialiasing.

The quick brown fox jumped over the lazy dog.

```html
<p class="antialiased ...">The quick brown fox ...</p>
```

## Responsive

To control the font smoothing of an element at a specific breakpoint, add a `{screen}:` prefix to any existing font smoothing utility. For example, use `md:antialiased` to apply the `antialiased` utility at only medium screen sizes and above.

```html
<p class="antialiased sm:subpixel-antialiased md:antialiased ...">
  The quick brown fox jumped over the lazy dog.
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for font smoothing utilities.

You can control which variants are generated for the font smoothing utilities by modifying the `fontSmoothing` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fontSmoothing: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the font smoothing utilities in your project, you can disable them entirely by setting the `fontSmoothing` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fontSmoothing: false,
    }
  }
```



---



# Font Style

Utilities for controlling the style of text.

## Default class reference

| Class      | Properties          |
| ---------- | ------------------- |
| italic     | font-style: italic; |
| not-italic | font-style: normal; |

## Italics

Use the `italic` utility to make text italic.

The quick brown fox jumped over the lazy dog.

```html
<p class="italic ...">The quick brown fox ...</p>
```

## Undo Italics

Use the `not-italic` utility to display text normally. This is typically used to reset italic text at different breakpoints.

The quick brown fox jumped over the lazy dog.

```html
<p class="not-italic ...">The quick brown fox ...</p>
```

## Responsive

To control the font style of an element at a specific breakpoint, add a `{screen}:` prefix to any existing font style utility. For example, use `md:not-italic` to apply the `not-italic` utility at only medium screen sizes and above.

```html
<p class="italic md:not-italic ...">
  The quick brown fox jumped over the lazy dog.
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for font style utilities.

You can control which variants are generated for the font style utilities by modifying the `fontStyle` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fontStyle: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the font style utilities in your project, you can disable them entirely by setting the `fontStyle` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fontStyle: false,
    }
  }
```



---



# Font Weight

Utilities for controlling the font weight of an element.

## Default class reference

| Class           | Properties        |
| --------------- | ----------------- |
| font-thin       | font-weight: 100; |
| font-extralight | font-weight: 200; |
| font-light      | font-weight: 300; |
| font-normal     | font-weight: 400; |
| font-medium     | font-weight: 500; |
| font-semibold   | font-weight: 600; |
| font-bold       | font-weight: 700; |
| font-extrabold  | font-weight: 800; |
| font-black      | font-weight: 900; |

## Usage

Control the font weight of an element using the `font-{weight}` utilities.



```html
<p class="font-thin ...">The quick brown fox ...</p>
<p class="font-extralight ...">The quick brown fox ...</p>
<p class="font-light ...">The quick brown fox ...</p>
<p class="font-normal ...">The quick brown fox ...</p>
<p class="font-medium ...">The quick brown fox ...</p>
<p class="font-semibold ...">The quick brown fox ...</p>
<p class="font-bold ...">The quick brown fox ...</p>
<p class="font-extrabold ...">The quick brown fox ...</p>
<p class="font-black ...">The quick brown fox ...</p>
```

## Responsive

To control the font weight of an element at a specific breakpoint, add a `{screen}:` prefix to any existing font weight utility. For example, use `md:font-bold` to apply the `font-bold` utility at only medium screen sizes and above.

```html
<p class="font-normal md:font-bold ...">The quick brown fox jumped over the lazy dog.</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Font Weights

By default, Tailwind provides 10 `font-weight` utilities. You change, add, or remove these by editing the `theme.fontWeight` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      fontWeight: {
-       hairline: 100,
+       'extra-light': 100,
-       thin: 200,
        light: 300,
        normal: 400,
        medium: 500,
-       semibold: 600,
        bold: 700,
-       extrabold: 800,
+       'extra-bold': 800,
        black: 900,
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for font weight utilities.

You can control which variants are generated for the font weight utilities by modifying the `fontWeight` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fontWeight: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the font weight utilities in your project, you can disable them entirely by setting the `fontWeight` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fontWeight: false,
    }
  }
```



---



# Font Variant Numeric

Utilities for controlling the variant of numbers.

## Default class reference

| Class              | Properties                                |
| ------------------ | ----------------------------------------- |
| normal-nums        | font-variant-numeric: normal;             |
| ordinal            | font-variant-numeric: ordinal;            |
| slashed-zero       | font-variant-numeric: slashed-zero;       |
| lining-nums        | font-variant-numeric: lining-nums;        |
| oldstyle-nums      | font-variant-numeric: oldstyle-nums;      |
| proportional-nums  | font-variant-numeric: proportional-nums;  |
| tabular-nums       | font-variant-numeric: tabular-nums;       |
| diagonal-fractions | font-variant-numeric: diagonal-fractions; |
| stacked-fractions  | font-variant-numeric: stacked-fractions;  |

## Usage

Use the `font-variant-numeric` utilities to enable additional glyphs for numbers, fractions, and ordinal markers *(in fonts that support them)*.

These utilities are composable so you can enable multiple `font-variant-numeric` features by combining multiple classes in your HTML:

```html
<p class="ordinal slashed-zero tabular-nums ...">1234567890</p>
```

Note that many fonts don’t support these features *(stacked fractions support for example is especially rare)*, so some of these utilities may have no effect depending on the font family you are using.

### Ordinal

Use the `ordinal` utility to enable special glyphs for the ordinal markers.

1st

```html
<p class="ordinal ...">1st</p>
```

### Slashed Zero

Use the `slashed-zero` utility to force a 0 with a slash; this is useful when a clear distinction between O and 0 is needed.

0

```html
<p class="slashed-zero ...">0</p>
```

### Lining figures

Use the `lining-nums` utility to use the numeric glyphs that are all aligned by their baseline. This corresponds to the `lnum` OpenType feature. This is the default for most fonts.

1234567890

```html
<p class="lining-nums ...">1234567890</p>
```

### Oldstyle figures

Use the `oldstyle-nums` utility to use numeric glyphs where some numbers have descenders. This corresponds to the `onum` OpenType feature.

1234567890

```html
<p class="oldstyle-nums ...">1234567890</p>
```

### Proportional figures

Use the `proportional-nums` utility to use numeric glyphs that have proportional widths (rather than uniform/tabular). This corresponds to the `pnum` OpenType feature.

12121

90909

```html
<p class="proportional-nums ...">12121</p>
<p class="proportional-nums ...">90909</p>
```

### Tabular figures

Use the `tabular-nums` utility to use numeric glyphs that have uniform/tabular widths (rather than proportional). This corresponds to the `tnum` OpenType feature.

12121

90909

```html
<p class="tabular-nums ...">12121</p>
<p class="tabular-nums ...">90909</p>
```

### Diagonal fractions

Use the `diagonal-fractions` utility to replace numbers separated by a slash with common diagonal fractions. This corresponds to the `frac` OpenType feature.

1/2 3/4 5/6

```html
<p class="diagonal-fractions ...">1/2 3/4 5/6</p>
```

### Stacked fractions

Use the `stacked-fractions` utility to replace numbers separated by a slash with common stacked fractions. This corresponds to the `frac` OpenType feature. Very few fonts seem to support this feature — we’ve used Ubuntu Mono here.

1/2 3/4 5/6

```html
<p class="stacked-fractions ...">1/2 3/4 5/6</p>
```

### Resetting numeric font variants

Use the `normal-nums` propery to reset numeric font variants. This is usually useful for resetting a font feature at a particular breakpoint:

```html
<p class="slashed-zero tabular-nums md:normal-nums ...">12345</p>
```

## Responsive

To control `font-variant-numeric` property of an element at a specific breakpoint, add a `{screen}:` prefix to any existing `font-variant-numeric` utility. For example, use `md:tabular-nums` to apply the `tabular-nums` utility at only medium screen sizes and above.

```html
<div class="proportional-nums md:tabular-nums">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for font variant numeric utilities.

You can control which variants are generated for the font variant numeric utilities by modifying the `fontVariantNumeric` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       fontVariantNumeric: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the font variant numeric utilities in your project, you can disable them entirely by setting the `fontVariantNumeric` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     fontVariantNumeric: false,
    }
  }
```



---



# Letter Spacing

Utilities for controlling the tracking (letter spacing) of an element.

## Default class reference

| Class            | Properties                |
| ---------------- | ------------------------- |
| tracking-tighter | letter-spacing: -0.05em;  |
| tracking-tight   | letter-spacing: -0.025em; |
| tracking-normal  | letter-spacing: 0em;      |
| tracking-wide    | letter-spacing: 0.025em;  |
| tracking-wider   | letter-spacing: 0.05em;   |
| tracking-widest  | letter-spacing: 0.1em;    |

## Usage

Control the letter spacing of an element using the `tracking-{size}` utilities.

.tracking-tighter

The quick brown fox jumped over the lazy dog.

.tracking-tight

The quick brown fox jumped over the lazy dog.

.tracking-normal

The quick brown fox jumped over the lazy dog.

.tracking-wide

The quick brown fox jumped over the lazy dog.

.tracking-wider

The quick brown fox jumped over the lazy dog.

.tracking-widest

The quick brown fox jumped over the lazy dog.

```html
<p class="tracking-tighter ...">The quick brown fox ...</p>
<p class="tracking-tight ...">The quick brown fox ...</p>
<p class="tracking-normal ...">The quick brown fox ...</p>
<p class="tracking-wide ...">The quick brown fox ...</p>
<p class="tracking-wider ...">The quick brown fox ...</p>
<p class="tracking-widest ...">The quick brown fox ...</p>
```

## Responsive

To control the letter spacing of an element at a specific breakpoint, add a `{screen}:` prefix to any existing letter spacing utility. For example, use `md:tracking-wide` to apply the `tracking-wide` utility at only medium screen sizes and above.

```html
<p class="tracking-tight md:tracking-wide ...">The quick brown fox jumped over the lazy dog.</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Letter Spacings

By default, Tailwind provides six tracking utilities. You can change, add, or remove these by editing the `theme.letterSpacing` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      letterSpacing: {
+       tightest: '-.075em',
        tighter: '-.05em',
-       tight: '-.025em',
        normal: '0',
-       wide: '.025em',
        wider: '.05em',
-       widest: '.1em',
+       widest: '.25em',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for tracking utilities.

You can control which variants are generated for the tracking utilities by modifying the `letterSpacing` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       letterSpacing: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the tracking utilities in your project, you can disable them entirely by setting the `letterSpacing` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     letterSpacing: false,
    }
  }
```



---



# Line Height

Utilities for controlling the leading (line height) of an element.

## Default class reference

| Class           | Properties            |
| --------------- | --------------------- |
| leading-3       | line-height: .75rem;  |
| leading-4       | line-height: 1rem;    |
| leading-5       | line-height: 1.25rem; |
| leading-6       | line-height: 1.5rem;  |
| leading-7       | line-height: 1.75rem; |
| leading-8       | line-height: 2rem;    |
| leading-9       | line-height: 2.25rem; |
| leading-10      | line-height: 2.5rem;  |
| leading-none    | line-height: 1;       |
| leading-tight   | line-height: 1.25;    |
| leading-snug    | line-height: 1.375;   |
| leading-normal  | line-height: 1.5;     |
| leading-relaxed | line-height: 1.625;   |
| leading-loose   | line-height: 2;       |

## Relative line-heights

Use the `leading-none`, `leading-tight`, `leading-snug`, `leading-normal`, `leading-relaxed`, and `leading-loose` utilities to give an element a relative line-height based on its current font-size.

.leading-none

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-tight

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-snug

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-normal

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-relaxed

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-loose

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

```html
<p class="leading-none ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-tight ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-snug ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-normal ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-relaxed ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-loose ...">Lorem ipsum dolor sit amet ...</p>
```

## Fixed line-heights

Use the `leading-{size}` utilities to give an element a fixed line-height, irrespective of the current font-size. These are useful when you need very precise control over an element’s final size.

.leading-3

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-4

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-5

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-6

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-7

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-8

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-9

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

.leading-10

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, quia temporibus eveniet a libero incidunt suscipit laborum, rerum accusantium modi quidem, ipsam illum quis sed voluptatum quae eum fugit earum.

```html
<p class="leading-3 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-4 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-5 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-6 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-7 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-8 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-9 ...">Lorem ipsum dolor sit amet ...</p>
<p class="leading-10 ...">Lorem ipsum dolor sit amet ...</p>
```

## Responsive

To control the line height of an element at a specific breakpoint, add a `{screen}:` prefix to any existing line height utility. For example, use `md:leading-loose` to apply the `leading-loose` utility at only medium screen sizes and above.

```html
<p class="leading-none md:leading-loose ...">Lorem ipsum dolor sit amet ...</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

It’s important to note that by default, Tailwind’s [font-size](https://tailwindcss.com/docs/font-size) utilities each set their own default line-height. This means that any time you use a responsive font-size utility like `sm:text-xl`, any explicit line-height you have set for a smaller breakpoint will be overridden.

```html
<!-- The `leading-loose` class will be overridden at the `md` breakpoint -->
<p class="text-lg leading-loose md:text-xl">
  Lorem ipsum dolor sit amet ...
</p>
```

If you want to override the default line-height after setting a breakpoint-specific font-size, make sure to set a breakpoint-specific line-height as well:

```html
<!-- The `leading-loose` class will be overridden at the `md` breakpoint -->
<p class="text-lg leading-loose md:text-xl md:leading-loose">
  Lorem ipsum dolor sit amet ...
</p>
```

Using the same line-height across different font sizes is generally not going to give you good typographic results. Line-height should typically get smaller as font-size increases, so the default behavior here usually saves you a ton of work. If you find yourself fighting it, you can always [customize your font-size scale](https://tailwindcss.com/docs/font-size#customizing) to not include default line-heights.

## Customizing

By default, Tailwind provides six relative and eight fixed `line-height` utilities. You change, add, or remove these by customizing the `lineHeight` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        lineHeight: {
+         'extra-loose': '2.5',
+         '12': '3rem',
        }
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for line height utilities.

You can control which variants are generated for the line height utilities by modifying the `lineHeight` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       lineHeight: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the line height utilities in your project, you can disable them entirely by setting the `lineHeight` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     lineHeight: false,
    }
  }
```



---



# List Style Type

Utilities for controlling the bullet/number style of a list.

## Default class reference

| Class        | Properties                |
| ------------ | ------------------------- |
| list-none    | list-style-type: none;    |
| list-disc    | list-style-type: disc;    |
| list-decimal | list-style-type: decimal; |

## Usage

To create bulleted or numeric lists, use the `list-disc` and `list-decimal` utilities.

.list-disc

- Lorem ipsum dolor sit amet, consectetur adipisicing elit
- Assumenda, quia temporibus eveniet a libero incidunt suscipit
- Quidem, ipsam illum quis sed voluptatum quae eum fugit earum

.list-decimal

1. Lorem ipsum dolor sit amet, consectetur adipisicing elit
2. Assumenda, quia temporibus eveniet a libero incidunt suscipit
3. Quidem, ipsam illum quis sed voluptatum quae eum fugit earum

.list-none (default)

- Lorem ipsum dolor sit amet, consectetur adipisicing elit
- Assumenda, quia temporibus eveniet a libero incidunt suscipit
- Quidem, ipsam illum quis sed voluptatum quae eum fugit earum



```html
<ul class="list-disc">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  ...
</ul>

<ol class="list-decimal">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  ...
</ol>

<ul>
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  ...
</ul>
```

## Responsive

To control the list style type of a list element at a specific breakpoint, add a `{screen}:` prefix to any existing list utility. For example, use `.md:list-disc` to apply the `list-disc` utility at only medium screen sizes and above.

```html
<ul class="list-none md:list-disc">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  <li>Assumenda, quia temporibus eveniet a libero incidunt suscipit</li>
  <li>Quidem, ipsam illum quis sed voluptatum quae eum fugit earum</li>
</ul>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind provides three utilities for the most common list style types. You change, add, or remove these by editing the `theme.listStyleType` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      listStyleType: {
        none: 'none',
-       disc: 'disc',
-       decimal: 'decimal',
+       square: 'square',
+       roman: 'upper-roman',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for list style type utilities.

You can control which variants are generated for the list style type utilities by modifying the `listStyleType` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       listStyleType: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the list style type utilities in your project, you can disable them entirely by setting the `listStyleType` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     listStyleType: false,
    }
  }
```



---



# List Style Position

Utilities for controlling the position of bullets/numbers in lists.

## Default class reference

| Class        | Properties                    |
| ------------ | ----------------------------- |
| list-inside  | list-style-position: inside;  |
| list-outside | list-style-position: outside; |

## Usage

Control the position of the markers in a list using the `list-inside` and `list-outside` utilities.

.list-inside

- Lorem ipsum dolor sit amet, consectetur adipisicing elit
- Assumenda, quia temporibus eveniet a libero incidunt suscipit
- Quidem, ipsam illum quis sed voluptatum quae eum fugit earum



.list-outside

- Lorem ipsum dolor sit amet, consectetur adipisicing elit
- Assumenda, quia temporibus eveniet a libero incidunt suscipit
- Quidem, ipsam illum quis sed voluptatum quae eum fugit earum

```html
<ul class="list-inside bg-rose-200 ...">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  ...
</ul>

<ul class="list-outside bg-rose-200 ...">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  ...
</ul>
```

## Responsive

To control the list style position of a list element at a specific breakpoint, add a `{screen}:` prefix to any existing list utility. For example, use `.md:list-inside` to apply the `list-inside` utility at only medium screen sizes and above.

```html
<ul class="list-outside md:list-inside">
  <li>Lorem ipsum dolor sit amet, consectetur adipisicing elit</li>
  <!-- ... -->
</ul>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for list style position utilities.

You can control which variants are generated for the list style position utilities by modifying the `listStylePosition` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       listStylePosition: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the list style position utilities in your project, you can disable them entirely by setting the `listStylePosition` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     listStylePosition: false,
    }
  }
```



---



# Placeholder Color

Utilities for controlling the color of placeholder text.

## Default class reference

| Class                                | Properties                                                   | Preview |
| ------------------------------------ | ------------------------------------------------------------ | ------- |
| placeholder-transparent::placeholder | color: transparent;                                          | Aa      |
| placeholder-current::placeholder     | color: currentColor;                                         | Aa      |
| placeholder-black::placeholder       | --tw-placeholder-opacity: 1; color: rgba(0, 0, 0, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-white::placeholder       | --tw-placeholder-opacity: 1; color: rgba(255, 255, 255, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-50::placeholder     | --tw-placeholder-opacity: 1; color: rgba(249, 250, 251, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-100::placeholder    | --tw-placeholder-opacity: 1; color: rgba(243, 244, 246, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-200::placeholder    | --tw-placeholder-opacity: 1; color: rgba(229, 231, 235, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-300::placeholder    | --tw-placeholder-opacity: 1; color: rgba(209, 213, 219, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-400::placeholder    | --tw-placeholder-opacity: 1; color: rgba(156, 163, 175, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-500::placeholder    | --tw-placeholder-opacity: 1; color: rgba(107, 114, 128, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-600::placeholder    | --tw-placeholder-opacity: 1; color: rgba(75, 85, 99, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-700::placeholder    | --tw-placeholder-opacity: 1; color: rgba(55, 65, 81, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-800::placeholder    | --tw-placeholder-opacity: 1; color: rgba(31, 41, 55, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-gray-900::placeholder    | --tw-placeholder-opacity: 1; color: rgba(17, 24, 39, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-50::placeholder      | --tw-placeholder-opacity: 1; color: rgba(254, 242, 242, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-100::placeholder     | --tw-placeholder-opacity: 1; color: rgba(254, 226, 226, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-200::placeholder     | --tw-placeholder-opacity: 1; color: rgba(254, 202, 202, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-300::placeholder     | --tw-placeholder-opacity: 1; color: rgba(252, 165, 165, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-400::placeholder     | --tw-placeholder-opacity: 1; color: rgba(248, 113, 113, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-500::placeholder     | --tw-placeholder-opacity: 1; color: rgba(239, 68, 68, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-600::placeholder     | --tw-placeholder-opacity: 1; color: rgba(220, 38, 38, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-700::placeholder     | --tw-placeholder-opacity: 1; color: rgba(185, 28, 28, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-800::placeholder     | --tw-placeholder-opacity: 1; color: rgba(153, 27, 27, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-red-900::placeholder     | --tw-placeholder-opacity: 1; color: rgba(127, 29, 29, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-50::placeholder   | --tw-placeholder-opacity: 1; color: rgba(255, 251, 235, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-100::placeholder  | --tw-placeholder-opacity: 1; color: rgba(254, 243, 199, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-200::placeholder  | --tw-placeholder-opacity: 1; color: rgba(253, 230, 138, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-300::placeholder  | --tw-placeholder-opacity: 1; color: rgba(252, 211, 77, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-400::placeholder  | --tw-placeholder-opacity: 1; color: rgba(251, 191, 36, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-500::placeholder  | --tw-placeholder-opacity: 1; color: rgba(245, 158, 11, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-600::placeholder  | --tw-placeholder-opacity: 1; color: rgba(217, 119, 6, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-700::placeholder  | --tw-placeholder-opacity: 1; color: rgba(180, 83, 9, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-800::placeholder  | --tw-placeholder-opacity: 1; color: rgba(146, 64, 14, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-yellow-900::placeholder  | --tw-placeholder-opacity: 1; color: rgba(120, 53, 15, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-50::placeholder    | --tw-placeholder-opacity: 1; color: rgba(236, 253, 245, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-100::placeholder   | --tw-placeholder-opacity: 1; color: rgba(209, 250, 229, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-200::placeholder   | --tw-placeholder-opacity: 1; color: rgba(167, 243, 208, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-300::placeholder   | --tw-placeholder-opacity: 1; color: rgba(110, 231, 183, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-400::placeholder   | --tw-placeholder-opacity: 1; color: rgba(52, 211, 153, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-500::placeholder   | --tw-placeholder-opacity: 1; color: rgba(16, 185, 129, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-600::placeholder   | --tw-placeholder-opacity: 1; color: rgba(5, 150, 105, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-700::placeholder   | --tw-placeholder-opacity: 1; color: rgba(4, 120, 87, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-800::placeholder   | --tw-placeholder-opacity: 1; color: rgba(6, 95, 70, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-green-900::placeholder   | --tw-placeholder-opacity: 1; color: rgba(6, 78, 59, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-50::placeholder     | --tw-placeholder-opacity: 1; color: rgba(239, 246, 255, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-100::placeholder    | --tw-placeholder-opacity: 1; color: rgba(219, 234, 254, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-200::placeholder    | --tw-placeholder-opacity: 1; color: rgba(191, 219, 254, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-300::placeholder    | --tw-placeholder-opacity: 1; color: rgba(147, 197, 253, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-400::placeholder    | --tw-placeholder-opacity: 1; color: rgba(96, 165, 250, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-500::placeholder    | --tw-placeholder-opacity: 1; color: rgba(59, 130, 246, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-600::placeholder    | --tw-placeholder-opacity: 1; color: rgba(37, 99, 235, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-700::placeholder    | --tw-placeholder-opacity: 1; color: rgba(29, 78, 216, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-800::placeholder    | --tw-placeholder-opacity: 1; color: rgba(30, 64, 175, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-blue-900::placeholder    | --tw-placeholder-opacity: 1; color: rgba(30, 58, 138, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-50::placeholder   | --tw-placeholder-opacity: 1; color: rgba(238, 242, 255, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-100::placeholder  | --tw-placeholder-opacity: 1; color: rgba(224, 231, 255, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-200::placeholder  | --tw-placeholder-opacity: 1; color: rgba(199, 210, 254, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-300::placeholder  | --tw-placeholder-opacity: 1; color: rgba(165, 180, 252, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-400::placeholder  | --tw-placeholder-opacity: 1; color: rgba(129, 140, 248, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-500::placeholder  | --tw-placeholder-opacity: 1; color: rgba(99, 102, 241, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-600::placeholder  | --tw-placeholder-opacity: 1; color: rgba(79, 70, 229, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-700::placeholder  | --tw-placeholder-opacity: 1; color: rgba(67, 56, 202, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-800::placeholder  | --tw-placeholder-opacity: 1; color: rgba(55, 48, 163, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-indigo-900::placeholder  | --tw-placeholder-opacity: 1; color: rgba(49, 46, 129, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-50::placeholder   | --tw-placeholder-opacity: 1; color: rgba(245, 243, 255, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-100::placeholder  | --tw-placeholder-opacity: 1; color: rgba(237, 233, 254, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-200::placeholder  | --tw-placeholder-opacity: 1; color: rgba(221, 214, 254, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-300::placeholder  | --tw-placeholder-opacity: 1; color: rgba(196, 181, 253, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-400::placeholder  | --tw-placeholder-opacity: 1; color: rgba(167, 139, 250, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-500::placeholder  | --tw-placeholder-opacity: 1; color: rgba(139, 92, 246, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-600::placeholder  | --tw-placeholder-opacity: 1; color: rgba(124, 58, 237, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-700::placeholder  | --tw-placeholder-opacity: 1; color: rgba(109, 40, 217, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-800::placeholder  | --tw-placeholder-opacity: 1; color: rgba(91, 33, 182, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-purple-900::placeholder  | --tw-placeholder-opacity: 1; color: rgba(76, 29, 149, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-50::placeholder     | --tw-placeholder-opacity: 1; color: rgba(253, 242, 248, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-100::placeholder    | --tw-placeholder-opacity: 1; color: rgba(252, 231, 243, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-200::placeholder    | --tw-placeholder-opacity: 1; color: rgba(251, 207, 232, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-300::placeholder    | --tw-placeholder-opacity: 1; color: rgba(249, 168, 212, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-400::placeholder    | --tw-placeholder-opacity: 1; color: rgba(244, 114, 182, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-500::placeholder    | --tw-placeholder-opacity: 1; color: rgba(236, 72, 153, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-600::placeholder    | --tw-placeholder-opacity: 1; color: rgba(219, 39, 119, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-700::placeholder    | --tw-placeholder-opacity: 1; color: rgba(190, 24, 93, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-800::placeholder    | --tw-placeholder-opacity: 1; color: rgba(157, 23, 77, var(--tw-placeholder-opacity)); | Aa      |
| placeholder-pink-900::placeholder    | --tw-placeholder-opacity: 1; color: rgba(131, 24, 67, var(--tw-placeholder-opacity)); | Aa      |

## Usage

Control the placeholder color of an element using the `placeholder-{color}` utilities.

```html
<input class="placeholder-gray-500 ..." placeholder="jane@example.com">
<input class="placeholder-red-300 ..." placeholder="jane@example.com">
```

### Changing opacity

Control the opacity of an element’s placeholder color using the `placeholder-opacity-{amount}` utilities.

```html
<input class="placeholder-gray-500 placeholder-opacity-100 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-75 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-50 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-25 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-0 ..." placeholder="jane@example.com">
```

Learn more in the [placeholder opacity documentation](https://tailwindcss.com/docs/placeholder-opacity).

## Responsive

To control the text color of an input placeholder at a specific breakpoint, add a `{screen}:` prefix to any existing text color utility. For example, use `md:placeholder-green-500` to apply the `placeholder-green-500` utility at only medium screen sizes and above.

```html
<input class="placeholder-gray-500 md:placeholder-green-500" placeholder="jane@example.com">
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Focus

To control the placeholder color of an element on focus, add the `focus:` prefix to any existing placeholder color utility. For example, use `focus:placeholder-blue-600` to apply the `placeholder-blue-600` utility on focus.

```html
<input class="placeholder-gray-600 focus:placeholder-gray-400 ..." placeholder="jane@example.com">
```

Focus utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<input class="... md:placeholder-gray-900 md:focus:placeholder-red-600 ...">
```

## Customizing

### Placeholder Colors

By default, Tailwind makes the entire [default color palette](https://tailwindcss.com/docs/customizing-colors#default-color-palette) available as placeholder colors.

You can [customize your color palette](https://tailwindcss.com/docs/colors#customizing) by editing `theme.colors` in your `tailwind.config.js` file, or customize just your placeholder colors in the `theme.textColor` section.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
-     placeholderColor: theme => theme('colors'),
+     placeholderColor: {
+       'primary': '#3490dc',
+       'secondary': '#ffed4a',
+       'danger': '#e3342f',
+     }
    }
  }
```

### Variants

By default, only responsive, dark mode *(if enabled)* and focus variants are generated for placeholder color utilities.

You can control which variants are generated for the placeholder color utilities by modifying the `placeholderColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       placeholderColor: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the placeholder color utilities in your project, you can disable them entirely by setting the `placeholderColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     placeholderColor: false,
    }
  }
```



---



# Placeholder Opacity

Utilities for controlling the opacity of an element's placeholder color.

## Default class reference

| Class                   | Properties                      |
| ----------------------- | ------------------------------- |
| placeholder-opacity-0   | --tw-placeholder-opacity: 0;    |
| placeholder-opacity-5   | --tw-placeholder-opacity: 0.05; |
| placeholder-opacity-10  | --tw-placeholder-opacity: 0.1;  |
| placeholder-opacity-20  | --tw-placeholder-opacity: 0.2;  |
| placeholder-opacity-25  | --tw-placeholder-opacity: 0.25; |
| placeholder-opacity-30  | --tw-placeholder-opacity: 0.3;  |
| placeholder-opacity-40  | --tw-placeholder-opacity: 0.4;  |
| placeholder-opacity-50  | --tw-placeholder-opacity: 0.5;  |
| placeholder-opacity-60  | --tw-placeholder-opacity: 0.6;  |
| placeholder-opacity-70  | --tw-placeholder-opacity: 0.7;  |
| placeholder-opacity-75  | --tw-placeholder-opacity: 0.75; |
| placeholder-opacity-80  | --tw-placeholder-opacity: 0.8;  |
| placeholder-opacity-90  | --tw-placeholder-opacity: 0.9;  |
| placeholder-opacity-95  | --tw-placeholder-opacity: 0.95; |
| placeholder-opacity-100 | --tw-placeholder-opacity: 1;    |

## Usage

Control the opacity of an element’s placeholder color using the `placeholder-opacity-{amount}` utilities.

```html
<input class="placeholder-gray-500 placeholder-opacity-100 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-75 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-50 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-25 ..." placeholder="jane@example.com">
<input class="placeholder-gray-500 placeholder-opacity-0 ..." placeholder="jane@example.com">
```

## Responsive

To control an element’s placeholder color opacity at a specific breakpoint, add a `{screen}:` prefix to any existing placeholder color opacity utility. For example, use `md:placeholder-opacity-50` to apply the `placeholder-opacity-50` utility at only medium screen sizes and above.

```html
<input class="placeholder-gray-500 placeholder-opacity-75 md:placeholder-opacity-50 ..." placeholder="jane@example.com">
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

If you want to customize only the placeholder opacity utilities, use the `placeholderOpacity` section:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        placeholderOpacity: {
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

By default, only responsive, dark mode *(if enabled)* and focus variants are generated for placeholder opacity utilities.

You can control which variants are generated for the placeholder opacity utilities by modifying the `placeholderOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       placeholderOpacity: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the placeholder opacity utilities in your project, you can disable them entirely by setting the `placeholderOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     placeholderOpacity: false,
    }
  }
```



---



# Text Alignment

Utilities for controlling the alignment of text.

## Default class reference

| Class        | Properties           |
| ------------ | -------------------- |
| text-left    | text-align: left;    |
| text-center  | text-align: center;  |
| text-right   | text-align: right;   |
| text-justify | text-align: justify; |

## Usage

Control the text alignment of an element using the `.text-left`, `.text-center`, `.text-right`, and `.text-justify` utilities.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis fugit, enim molestiae praesentium eveniet, recusandae et error beatae facilis ex harum consequuntur, quia pariatur non. Doloribus illo, ullam blanditiis ab.

```html
<p class="text-left ...">Lorem ipsum dolor sit amet ...</p>
```

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis fugit, enim molestiae praesentium eveniet, recusandae et error beatae facilis ex harum consequuntur, quia pariatur non. Doloribus illo, ullam blanditiis ab.

```html
<p class="text-center ...">Lorem ipsum dolor sit amet ...</p>
```

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis fugit, enim molestiae praesentium eveniet, recusandae et error beatae facilis ex harum consequuntur, quia pariatur non. Doloribus illo, ullam blanditiis ab.

```html
<p class="text-right ...">Lorem ipsum dolor sit amet ...</p>
```

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis fugit, enim molestiae praesentium eveniet, recusandae et error beatae facilis ex harum consequuntur, quia pariatur non. Doloribus illo, ullam blanditiis ab.

```html
<p class="text-justify ...">Lorem ipsum dolor sit amet ...</p>
```

## Responsive

To control the text alignment of an element at a specific breakpoint, add a `{screen}:` prefix to any existing text alignment utility. For example, use `md:text-center` to apply the `text-center` utility at only medium screen sizes and above.

```html
<p class="text-left md:text-center ...">Lorem ipsum dolor sit amet ...</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for text alignment utilities.

You can control which variants are generated for the text alignment utilities by modifying the `textAlign` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       textAlign: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text alignment utilities in your project, you can disable them entirely by setting the `textAlign` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     textAlign: false,
    }
  }
```

[←Placeholder Opacity](https://tailwindcss.com/docs/placeholder-opacity)[Text Color
  ](https://tailwindcss.com/docs/text-color)



---



# Text Color

Utilities for controlling the text color of an element.

## Default class reference

| Class            | Properties                                                   | Preview |
| ---------------- | ------------------------------------------------------------ | ------- |
| text-transparent | color: transparent;                                          | Aa      |
| text-current     | color: currentColor;                                         | Aa      |
| text-black       | --tw-text-opacity: 1; color: rgba(0, 0, 0, var(--tw-text-opacity)); | Aa      |
| text-white       | --tw-text-opacity: 1; color: rgba(255, 255, 255, var(--tw-text-opacity)); | Aa      |
| text-gray-50     | --tw-text-opacity: 1; color: rgba(249, 250, 251, var(--tw-text-opacity)); | Aa      |
| text-gray-100    | --tw-text-opacity: 1; color: rgba(243, 244, 246, var(--tw-text-opacity)); | Aa      |
| text-gray-200    | --tw-text-opacity: 1; color: rgba(229, 231, 235, var(--tw-text-opacity)); | Aa      |
| text-gray-300    | --tw-text-opacity: 1; color: rgba(209, 213, 219, var(--tw-text-opacity)); | Aa      |
| text-gray-400    | --tw-text-opacity: 1; color: rgba(156, 163, 175, var(--tw-text-opacity)); | Aa      |
| text-gray-500    | --tw-text-opacity: 1; color: rgba(107, 114, 128, var(--tw-text-opacity)); | Aa      |
| text-gray-600    | --tw-text-opacity: 1; color: rgba(75, 85, 99, var(--tw-text-opacity)); | Aa      |
| text-gray-700    | --tw-text-opacity: 1; color: rgba(55, 65, 81, var(--tw-text-opacity)); | Aa      |
| text-gray-800    | --tw-text-opacity: 1; color: rgba(31, 41, 55, var(--tw-text-opacity)); | Aa      |
| text-gray-900    | --tw-text-opacity: 1; color: rgba(17, 24, 39, var(--tw-text-opacity)); | Aa      |
| text-red-50      | --tw-text-opacity: 1; color: rgba(254, 242, 242, var(--tw-text-opacity)); | Aa      |
| text-red-100     | --tw-text-opacity: 1; color: rgba(254, 226, 226, var(--tw-text-opacity)); | Aa      |
| text-red-200     | --tw-text-opacity: 1; color: rgba(254, 202, 202, var(--tw-text-opacity)); | Aa      |
| text-red-300     | --tw-text-opacity: 1; color: rgba(252, 165, 165, var(--tw-text-opacity)); | Aa      |
| text-red-400     | --tw-text-opacity: 1; color: rgba(248, 113, 113, var(--tw-text-opacity)); | Aa      |
| text-red-500     | --tw-text-opacity: 1; color: rgba(239, 68, 68, var(--tw-text-opacity)); | Aa      |
| text-red-600     | --tw-text-opacity: 1; color: rgba(220, 38, 38, var(--tw-text-opacity)); | Aa      |
| text-red-700     | --tw-text-opacity: 1; color: rgba(185, 28, 28, var(--tw-text-opacity)); | Aa      |
| text-red-800     | --tw-text-opacity: 1; color: rgba(153, 27, 27, var(--tw-text-opacity)); | Aa      |
| text-red-900     | --tw-text-opacity: 1; color: rgba(127, 29, 29, var(--tw-text-opacity)); | Aa      |
| text-yellow-50   | --tw-text-opacity: 1; color: rgba(255, 251, 235, var(--tw-text-opacity)); | Aa      |
| text-yellow-100  | --tw-text-opacity: 1; color: rgba(254, 243, 199, var(--tw-text-opacity)); | Aa      |
| text-yellow-200  | --tw-text-opacity: 1; color: rgba(253, 230, 138, var(--tw-text-opacity)); | Aa      |
| text-yellow-300  | --tw-text-opacity: 1; color: rgba(252, 211, 77, var(--tw-text-opacity)); | Aa      |
| text-yellow-400  | --tw-text-opacity: 1; color: rgba(251, 191, 36, var(--tw-text-opacity)); | Aa      |
| text-yellow-500  | --tw-text-opacity: 1; color: rgba(245, 158, 11, var(--tw-text-opacity)); | Aa      |
| text-yellow-600  | --tw-text-opacity: 1; color: rgba(217, 119, 6, var(--tw-text-opacity)); | Aa      |
| text-yellow-700  | --tw-text-opacity: 1; color: rgba(180, 83, 9, var(--tw-text-opacity)); | Aa      |
| text-yellow-800  | --tw-text-opacity: 1; color: rgba(146, 64, 14, var(--tw-text-opacity)); | Aa      |
| text-yellow-900  | --tw-text-opacity: 1; color: rgba(120, 53, 15, var(--tw-text-opacity)); | Aa      |
| text-green-50    | --tw-text-opacity: 1; color: rgba(236, 253, 245, var(--tw-text-opacity)); | Aa      |
| text-green-100   | --tw-text-opacity: 1; color: rgba(209, 250, 229, var(--tw-text-opacity)); | Aa      |
| text-green-200   | --tw-text-opacity: 1; color: rgba(167, 243, 208, var(--tw-text-opacity)); | Aa      |
| text-green-300   | --tw-text-opacity: 1; color: rgba(110, 231, 183, var(--tw-text-opacity)); | Aa      |
| text-green-400   | --tw-text-opacity: 1; color: rgba(52, 211, 153, var(--tw-text-opacity)); | Aa      |
| text-green-500   | --tw-text-opacity: 1; color: rgba(16, 185, 129, var(--tw-text-opacity)); | Aa      |
| text-green-600   | --tw-text-opacity: 1; color: rgba(5, 150, 105, var(--tw-text-opacity)); | Aa      |
| text-green-700   | --tw-text-opacity: 1; color: rgba(4, 120, 87, var(--tw-text-opacity)); | Aa      |
| text-green-800   | --tw-text-opacity: 1; color: rgba(6, 95, 70, var(--tw-text-opacity)); | Aa      |
| text-green-900   | --tw-text-opacity: 1; color: rgba(6, 78, 59, var(--tw-text-opacity)); | Aa      |
| text-blue-50     | --tw-text-opacity: 1; color: rgba(239, 246, 255, var(--tw-text-opacity)); | Aa      |
| text-blue-100    | --tw-text-opacity: 1; color: rgba(219, 234, 254, var(--tw-text-opacity)); | Aa      |
| text-blue-200    | --tw-text-opacity: 1; color: rgba(191, 219, 254, var(--tw-text-opacity)); | Aa      |
| text-blue-300    | --tw-text-opacity: 1; color: rgba(147, 197, 253, var(--tw-text-opacity)); | Aa      |
| text-blue-400    | --tw-text-opacity: 1; color: rgba(96, 165, 250, var(--tw-text-opacity)); | Aa      |
| text-blue-500    | --tw-text-opacity: 1; color: rgba(59, 130, 246, var(--tw-text-opacity)); | Aa      |
| text-blue-600    | --tw-text-opacity: 1; color: rgba(37, 99, 235, var(--tw-text-opacity)); | Aa      |
| text-blue-700    | --tw-text-opacity: 1; color: rgba(29, 78, 216, var(--tw-text-opacity)); | Aa      |
| text-blue-800    | --tw-text-opacity: 1; color: rgba(30, 64, 175, var(--tw-text-opacity)); | Aa      |
| text-blue-900    | --tw-text-opacity: 1; color: rgba(30, 58, 138, var(--tw-text-opacity)); | Aa      |
| text-indigo-50   | --tw-text-opacity: 1; color: rgba(238, 242, 255, var(--tw-text-opacity)); | Aa      |
| text-indigo-100  | --tw-text-opacity: 1; color: rgba(224, 231, 255, var(--tw-text-opacity)); | Aa      |
| text-indigo-200  | --tw-text-opacity: 1; color: rgba(199, 210, 254, var(--tw-text-opacity)); | Aa      |
| text-indigo-300  | --tw-text-opacity: 1; color: rgba(165, 180, 252, var(--tw-text-opacity)); | Aa      |
| text-indigo-400  | --tw-text-opacity: 1; color: rgba(129, 140, 248, var(--tw-text-opacity)); | Aa      |
| text-indigo-500  | --tw-text-opacity: 1; color: rgba(99, 102, 241, var(--tw-text-opacity)); | Aa      |
| text-indigo-600  | --tw-text-opacity: 1; color: rgba(79, 70, 229, var(--tw-text-opacity)); | Aa      |
| text-indigo-700  | --tw-text-opacity: 1; color: rgba(67, 56, 202, var(--tw-text-opacity)); | Aa      |
| text-indigo-800  | --tw-text-opacity: 1; color: rgba(55, 48, 163, var(--tw-text-opacity)); | Aa      |
| text-indigo-900  | --tw-text-opacity: 1; color: rgba(49, 46, 129, var(--tw-text-opacity)); | Aa      |
| text-purple-50   | --tw-text-opacity: 1; color: rgba(245, 243, 255, var(--tw-text-opacity)); | Aa      |
| text-purple-100  | --tw-text-opacity: 1; color: rgba(237, 233, 254, var(--tw-text-opacity)); | Aa      |
| text-purple-200  | --tw-text-opacity: 1; color: rgba(221, 214, 254, var(--tw-text-opacity)); | Aa      |
| text-purple-300  | --tw-text-opacity: 1; color: rgba(196, 181, 253, var(--tw-text-opacity)); | Aa      |
| text-purple-400  | --tw-text-opacity: 1; color: rgba(167, 139, 250, var(--tw-text-opacity)); | Aa      |
| text-purple-500  | --tw-text-opacity: 1; color: rgba(139, 92, 246, var(--tw-text-opacity)); | Aa      |
| text-purple-600  | --tw-text-opacity: 1; color: rgba(124, 58, 237, var(--tw-text-opacity)); | Aa      |
| text-purple-700  | --tw-text-opacity: 1; color: rgba(109, 40, 217, var(--tw-text-opacity)); | Aa      |
| text-purple-800  | --tw-text-opacity: 1; color: rgba(91, 33, 182, var(--tw-text-opacity)); | Aa      |
| text-purple-900  | --tw-text-opacity: 1; color: rgba(76, 29, 149, var(--tw-text-opacity)); | Aa      |
| text-pink-50     | --tw-text-opacity: 1; color: rgba(253, 242, 248, var(--tw-text-opacity)); | Aa      |
| text-pink-100    | --tw-text-opacity: 1; color: rgba(252, 231, 243, var(--tw-text-opacity)); | Aa      |
| text-pink-200    | --tw-text-opacity: 1; color: rgba(251, 207, 232, var(--tw-text-opacity)); | Aa      |
| text-pink-300    | --tw-text-opacity: 1; color: rgba(249, 168, 212, var(--tw-text-opacity)); | Aa      |
| text-pink-400    | --tw-text-opacity: 1; color: rgba(244, 114, 182, var(--tw-text-opacity)); | Aa      |
| text-pink-500    | --tw-text-opacity: 1; color: rgba(236, 72, 153, var(--tw-text-opacity)); | Aa      |
| text-pink-600    | --tw-text-opacity: 1; color: rgba(219, 39, 119, var(--tw-text-opacity)); | Aa      |
| text-pink-700    | --tw-text-opacity: 1; color: rgba(190, 24, 93, var(--tw-text-opacity)); | Aa      |
| text-pink-800    | --tw-text-opacity: 1; color: rgba(157, 23, 77, var(--tw-text-opacity)); | Aa      |
| text-pink-900    | --tw-text-opacity: 1; color: rgba(131, 24, 67, var(--tw-text-opacity)); | Aa      |

## Usage

Control the text color of an element using the `text-{color}` utilities.

The quick brown fox jumped over the lazy dog.

```html
<p class="text-purple-600 ..."></p>
```

### Changing opacity

Control the opacity of an element’s text color using the `text-opacity-{amount}` utilities.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

```html
<p class="text-purple-700 text-opacity-100 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-75 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-50 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-25 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-0 ...">The quick brown fox ...</p>
```

Learn more in the [text opacity documentation](https://tailwindcss.com/docs/text-opacity).

## Responsive

To control the text color of an element at a specific breakpoint, add a `{screen}:` prefix to any existing text color utility. For example, use `md:text-green-600` to apply the `text-green-600` utility at only medium screen sizes and above.

```html
<p class="text-blue-600 md:text-green-600 ...">
  The quick brown fox...
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Hover

To control the text color of an element on hover, add the `hover:` prefix to any existing text color utility. For example, use `hover:text-blue-600` to apply the `text-blue-600` utility on hover.

Hover me

```html
<button class="text-white hover:text-red-500 ...">
  Hover me
</button>
```

Hover utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `hover:` prefix.

```html
<button class="... md:text-blue-500 md:hover:text-blue-600 ...">Button</button>
```

## Focus

To control the text color of an element on focus, add the `focus:` prefix to any existing text color utility. For example, use `focus:text-blue-600` to apply the `text-blue-600` utility on focus.

```html
<input class="text-green-900 focus:text-red-600 ...">
```

Focus utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<input class="... md:text-gray-900 md:focus:text-red-600 ...">
```

## Customizing

### Text Colors

By default, Tailwind makes the entire [default color palette](https://tailwindcss.com/docs/customizing-colors#default-color-palette) available as text colors.

You can [customize your color palette](https://tailwindcss.com/docs/colors#customizing) by editing `theme.colors` in your `tailwind.config.js` file, or customize just your text colors in the `theme.textColor` section.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
-     textColor: theme => theme('colors'),
+     textColor: {
+       'primary': '#3490dc',
+       'secondary': '#ffed4a',
+       'danger': '#e3342f',
+     }
    }
  }
```

### Variants

By default, only responsive, dark mode *(if enabled)*, group-hover, focus-within, hover and focus variants are generated for text color utilities.

You can control which variants are generated for the text color utilities by modifying the `textColor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       textColor: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text color utilities in your project, you can disable them entirely by setting the `textColor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     textColor: false,
    }
  }
```

[←Text Align](https://tailwindcss.com/docs/text-align)[Text Opacity
  ](https://tailwindcss.com/docs/text-opacity)



---



# Text Opacity

Utilities for controlling the opacity of an element's text color.

## Default class reference

| Class            | Properties               |
| ---------------- | ------------------------ |
| text-opacity-0   | --tw-text-opacity: 0;    |
| text-opacity-5   | --tw-text-opacity: 0.05; |
| text-opacity-10  | --tw-text-opacity: 0.1;  |
| text-opacity-20  | --tw-text-opacity: 0.2;  |
| text-opacity-25  | --tw-text-opacity: 0.25; |
| text-opacity-30  | --tw-text-opacity: 0.3;  |
| text-opacity-40  | --tw-text-opacity: 0.4;  |
| text-opacity-50  | --tw-text-opacity: 0.5;  |
| text-opacity-60  | --tw-text-opacity: 0.6;  |
| text-opacity-70  | --tw-text-opacity: 0.7;  |
| text-opacity-75  | --tw-text-opacity: 0.75; |
| text-opacity-80  | --tw-text-opacity: 0.8;  |
| text-opacity-90  | --tw-text-opacity: 0.9;  |
| text-opacity-95  | --tw-text-opacity: 0.95; |
| text-opacity-100 | --tw-text-opacity: 1;    |

## Usage

Control the opacity of an element’s text color using the `text-opacity-{amount}` utilities.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

The quick brown fox jumped over the lazy dog.

```html
<p class="text-purple-700 text-opacity-100 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-75 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-50 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-25 ...">The quick brown fox ...</p>
<p class="text-purple-700 text-opacity-0 ...">The quick brown fox ...</p>
```

Note that because these utilities are implemented using CSS custom properties, a `.text-{color}` utility must be present on the same element for them to work.

**Don't try to use text opacity utilities on an inherited text color**

```html
<div class="text-black">
  <div class="text-opacity-50">...</div>
</div>
```

**Do make sure to add a text color utility to the same element explicitly**

```html
<div class="text-black">
  <div class="text-black text-opacity-50">...</div>
</div>
```

## Responsive

To control an element’s text color opacity at a specific breakpoint, add a `{screen}:` prefix to any existing text color opacity utility. For example, use `md:text-opacity-50` to apply the `text-opacity-50` utility at only medium screen sizes and above.

```html
<div class="text-blue-500 text-opacity-75 md:text-opacity-50">
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

If you want to customize only the text opacity utilities, use the `textOpacity` section:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        textOpacity: {
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

By default, only responsive, dark mode *(if enabled)*, group-hover, focus-within, hover and focus variants are generated for text opacity utilities.

You can control which variants are generated for the text opacity utilities by modifying the `textOpacity` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       textOpacity: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text opacity utilities in your project, you can disable them entirely by setting the `textOpacity` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     textOpacity: false,
    }
  }
```

[←Text Color](https://tailwindcss.com/docs/text-color)[Text Decoration
  ](https://tailwindcss.com/docs/text-decoration)



---



# Text Decoration

Utilities for controlling the decoration of text.

## Default class reference

| Class        | Properties                     |
| ------------ | ------------------------------ |
| underline    | text-decoration: underline;    |
| line-through | text-decoration: line-through; |
| no-underline | text-decoration: none;         |

## Underline

Use the `underline` utility to underline text.

The quick brown fox jumped over the lazy dog.

```html
<p class="underline ...">The quick brown fox ...</p>
```

## Line Through

Use the `line-through` utility to strike out text.

The quick brown fox jumped over the lazy dog.

```html
<p class="line-through ...">The quick brown fox ...</p>
```

## No Underline

Use the `no-underline` utility to remove underline or line-through styling.

[Link with no underline](https://tailwindcss.com/docs/text-decoration#)

```html
<a href="#" class="no-underline ...">Link with no underline</a>
```

## Responsive

To control the text decoration of an element at a specific breakpoint, add a `{screen}:` prefix to any existing text decoration utility. For example, use `md:underline` to apply the `underline` utility at only medium screen sizes and above.

```html
<p class="no-underline md:underline ...">
  The quick brown fox jumped over the lazy dog.
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Hover

To control the text decoration of an element on hover, add the `hover:` prefix to any existing text decoration utility. For example, use `hover:underline` to apply the `underline` utility on hover.

[Link](https://tailwindcss.com/docs/text-decoration#hover)

```html
<a href="#" class="no-underline hover:underline ...">Link</a>
```

Hover utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `hover:` prefix.

```html
<a href="#" class="... md:no-underline md:hover:underline ...">Link</a>	
```

## Focus

To control the text decoration of an element on focus, add the `focus:` prefix to any existing text decoration utility. For example, use `focus:underline` to apply the `underline` utility on focus.

```html
<input class="focus:underline ..." value="Focus me">
```

Focus utilities can also be combined with responsive utilities by adding the responsive `{screen}:` prefix *before* the `focus:` prefix.

```html
<input class="md:focus:underline ..." value="Focus me">	
```

## Customizing

### Variants

By default, only responsive, group-hover, focus-within, hover and focus variants are generated for text decoration utilities.

You can control which variants are generated for the text decoration utilities by modifying the `textDecoration` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       textDecoration: ['active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text decoration utilities in your project, you can disable them entirely by setting the `textDecoration` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     textDecoration: false,
    }
  }
```

[←Text Opacity](https://tailwindcss.com/docs/text-opacity)[Text Transform
  ](https://tailwindcss.com/docs/text-transform)



---



# Text Transform

Utilities for controlling the transformation of text.

## Default class reference

| Class       | Properties                  |
| ----------- | --------------------------- |
| uppercase   | text-transform: uppercase;  |
| lowercase   | text-transform: lowercase;  |
| capitalize  | text-transform: capitalize; |
| normal-case | text-transform: none;       |

## Normal Case

Use the `normal-case` utility to preserve the original casing. This is typically used to reset capitalization at different breakpoints.

The quick brown fox jumped over the lazy dog.

```html
<p class="normal-case ...">The quick brown fox ...</p>
```

## Uppercase

Use the `uppercase` utility to uppercase text.

THE QUICK BROWN FOX JUMPED OVER THE LAZY DOG.

```html
<p class="uppercase ...">The quick brown fox ...</p>
```

## Lowercase

Use the `lowercase` utility to lowercase text.

the quick brown fox jumped over the lazy dog.

```html
<p class="lowercase ...">The quick brown fox ...</p>
```

## Capitalize

Use the `capitalize` utility to capitalize text.

The Quick Brown Fox Jumped Over The Lazy Dog.

```html
<p class="capitalize ...">The quick brown fox ...</p>
```

## Responsive

To control the text transformation of an element at a specific breakpoint, add a `{screen}:` prefix to any existing text transformation utility. For example, use `md:uppercase` to apply the `uppercase` utility at only medium screen sizes and above.

```html
<p class="capitalize md:uppercase ...">
  The quick brown fox jumped over the lazy dog.
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for text transformation utilities.

You can control which variants are generated for the text transformation utilities by modifying the `textTransform` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       textTransform: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text transformation utilities in your project, you can disable them entirely by setting the `textTransform` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     textTransform: false,
    }
  }
```

[←Text Decoration](https://tailwindcss.com/docs/text-decoration)[Text Overflow
  ](https://tailwindcss.com/docs/text-overflow)



---



# Text Overflow

Utilities for controlling text overflow in an element.

## Default class reference

| Class             | Properties                                                   |
| ----------------- | ------------------------------------------------------------ |
| truncate          | overflow: hidden; text-overflow: ellipsis; white-space: nowrap; |
| overflow-ellipsis | text-overflow: ellipsis;                                     |
| overflow-clip     | text-overflow: clip;                                         |

## Truncate

Use `truncate` to truncate overflowing text with an ellipsis (`…`) if needed.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiisitaquequodpraesentiumexplicaboincidunt? Dolores beatae nam at sed dolorum ratione dolorem nisi velit cum.

```html
<p class="truncate ...">...</p>
```

## Overflow Ellipsis

Use `overflow-ellipsis` to truncate overflowing text with an ellipsis (`…`) if needed.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiisitaquequodpraesentiumexplicaboincidunt? Dolores beatae nam at sed dolorum ratione dolorem nisi velit cum.

```html
<p class="overflow-ellipsis overflow-hidden ...">...</p>
```

## Overflow Clip

Use `overflow-clip` to truncate the text at the limit of the content area.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiisitaquequodpraesentiumexplicaboincidunt? Dolores beatae nam at sed dolorum ratione dolorem nisi velit cum.

```html
<p class="overflow-clip overflow-hidden ...">...</p>
```

## Responsive

To control the text overflow in an element only at a specific breakpoint, add a `{screen}:` prefix to any existing text overflow utility. For example, adding the class `md:overflow-clip` to an element would apply the `overflow-clip` utility at medium screen sizes and above.

```html
<p class="truncate md:overflow-clip ...">
  <!-- ... -->
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for text overflow utilities.

You can control which variants are generated for the text overflow utilities by modifying the `textOverflow` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       textOverflow: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the text overflow utilities in your project, you can disable them entirely by setting the `textOverflow` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     textOverflow: false,
    }
  }
```

[←Text Transform](https://tailwindcss.com/docs/text-transform)[Vertical Align
  ](https://tailwindcss.com/docs/vertical-align)



---



# Vertical Alignment

Utilities for controlling the vertical alignment of an inline or table-cell box.

## Default class reference

| Class             | Properties                   |
| ----------------- | ---------------------------- |
| align-baseline    | vertical-align: baseline;    |
| align-top         | vertical-align: top;         |
| align-middle      | vertical-align: middle;      |
| align-bottom      | vertical-align: bottom;      |
| align-text-top    | vertical-align: text-top;    |
| align-text-bottom | vertical-align: text-bottom; |

## Baseline

Use `align-baseline` to align the baseline of an element with the baseline of its parent.

 The quick brown fox jumped over the lazy dog.

```html
<span class="inline-block align-baseline ...">...</span>
```

## Top

Use `align-top` to align the top of an element and its descendants with the top of the entire line.

 The quick brown fox jumped over the lazy dog.

```html
<span class="inline-block align-top ...">...</span>
```

## Middle

Use `align-middle` to align the middle of an element with the baseline plus half the x-height of the parent.

 The quick brown fox jumped over the lazy dog.

```html
<span class="inline-block align-middle ...">...</span>
```

## Bottom

Use `align-bottom` to align the bottom of an element and its descendants with the bottom of the entire line.

 The quick brown fox jumped over the lazy dog.

```html
<span class="inline-block align-bottom ...">...</span>
```

## Text Top

Use `align-text-top` to align the top of an element with the top of the parent element’s font.

 The quick brown fox jumped over the lazy dog.

```html
<span class="inline-block align-text-top ...">...</span>
```

## Text Bottom

Use `align-text-bottom` to align the bottom of an element with the bottom of the parent element’s font.

 The quick brown fox jumped over the lazy dog.

```html
<span class="inline-block align-text-bottom ...">...</span>
```

## Responsive

To control the vertical alignment only at a specific breakpoint, add a `{screen}:` prefix to any existing vertical align utility. For example, adding the class `md:align-top` to an element would apply the `align-top` utility at medium screen sizes and above.

```html
<div class="relative">
  <span class="align-middle md:align-top ...">...</span>
  <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for vertical-alignment utilities.

You can control which variants are generated for the vertical-alignment utilities by modifying the `verticalAlign` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       verticalAlign: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the vertical-alignment utilities in your project, you can disable them entirely by setting the `verticalAlign` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     verticalAlign: false,
    }
  }
```

[←Text Overflow](https://tailwindcss.com/docs/text-overflow)[Whitespace
  ](https://tailwindcss.com/docs/whitespace)



---



# Whitespace

Utilities for controlling an element's white-space property.

## Default class reference

| Class               | Properties             |
| ------------------- | ---------------------- |
| whitespace-normal   | white-space: normal;   |
| whitespace-nowrap   | white-space: nowrap;   |
| whitespace-pre      | white-space: pre;      |
| whitespace-pre-line | white-space: pre-line; |
| whitespace-pre-wrap | white-space: pre-wrap; |

## Normal

Use `whitespace-normal` to cause text to wrap normally within an element. Newlines and spaces will be collapsed.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure, eum natus enim maxime laudantium quibusdam illo nihil, reprehenderit saepe quam aliquid odio accusamus.

```html
<div class="w-3/4 ...">
  <div class="whitespace-normal ...">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,
      eum natus enim maxime
      laudantium quibusdam illo nihil,

  reprehenderit saepe quam aliquid odio accusamus.</div>
</div>
```

## No Wrap

Use `whitespace-nowrap` to prevent text from wrapping within an element. Newlines and spaces will be collapsed.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure, eum natus enim maxime laudantium quibusdam illo nihil, reprehenderit saepe quam aliquid odio accusamus.

```html
<div class="w-3/4 overflow-x-auto ...">
  <div class="whitespace-nowrap ...">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,
      eum natus enim maxime
      laudantium quibusdam illo nihil,

  reprehenderit saepe quam aliquid odio accusamus.</div>
</div>
```

## Pre

Use `whitespace-pre` to preserve newlines and spaces within an element. Text will not be wrapped.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,      eum natus enim maxime      laudantium quibusdam illo nihil,   reprehenderit saepe quam aliquid odio accusamus.

```html
<div class="w-3/4 overflow-x-auto ...">
  <div class="whitespace-pre ...">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,
      eum natus enim maxime
      laudantium quibusdam illo nihil,

  reprehenderit saepe quam aliquid odio accusamus.</div>
</div>
```

## Pre Line

Use `whitespace-pre-line` to preserve newlines but not spaces within an element. Text will be wrapped normally.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure, eum natus enim maxime laudantium quibusdam illo nihil, reprehenderit saepe quam aliquid odio accusamus.

```html
<div class="w-3/4 ...">
  <div class="whitespace-pre-line ...">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,
      eum natus enim maxime
      laudantium quibusdam illo nihil,

  reprehenderit saepe quam aliquid odio accusamus.</div>
</div>
```

## Pre Wrap

Use `whitespace-pre-wrap` to preserve newlines and spaces within an element. Text will be wrapped normally.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,      eum natus enim maxime      laudantium quibusdam illo nihil,   reprehenderit saepe quam aliquid odio accusamus.

```html
<div class="w-3/4 ...">
  <div class="whitespace-pre-wrap ...">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis quidem itaque beatae, rem tenetur quia iure,
      eum natus enim maxime
      laudantium quibusdam illo nihil,

  reprehenderit saepe quam aliquid odio accusamus.</div>
</div>
```

## Responsive

To control the whitespace property of an element only at a specific breakpoint, add a `{screen}:` prefix to any existing whitespace utility. For example, adding the class `md:whitespace-pre` to an element would apply the `whitespace-pre` utility at medium screen sizes and above.

```html
<div class="whitespace-normal md:whitespace-pre ...">
<!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for whitespace utilities.

You can control which variants are generated for the whitespace utilities by modifying the `whitespace` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       whitespace: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the whitespace utilities in your project, you can disable them entirely by setting the `whitespace` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     whitespace: false,
    }
  }
```

[←Vertical Align](https://tailwindcss.com/docs/vertical-align)[Word Break
  ](https://tailwindcss.com/docs/word-break)



---



# Word Break

Utilities for controlling word breaks in an element.

## Default class reference

| Class        | Properties                                 |
| ------------ | ------------------------------------------ |
| break-normal | overflow-wrap: normal; word-break: normal; |
| break-words  | overflow-wrap: break-word;                 |
| break-all    | word-break: break-all;                     |

## Normal

Use `break-normal` to only add line breaks at normal word break points.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiisitaquequodpraesentiumexplicaboincidunt? Dolores beatae nam at sed dolorum ratione dolorem nisi velit cum.

```html
<p class="break-normal ...">...</p>
```

## Break Words

Use `break-words` to add line breaks mid-word if needed.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiisitaquequodpraesentiumexplicaboincidunt? Dolores beatae nam at sed dolorum ratione dolorem nisi velit cum.

```html
<p class="break-words ...">...</p>
```

## Break All

Use `break-all` to add line breaks whenever necessary, without trying to preserve whole words.

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiisitaquequodpraesentiumexplicaboincidunt? Dolores beatae nam at sed dolorum ratione dolorem nisi velit cum.

```html
<p class="break-all ...">...</p>
```

## Responsive

To control the word breaks in an element only at a specific breakpoint, add a `{screen}:` prefix to any existing word break utility. For example, adding the class `md:break-all` to an element would apply the `break-all` utility at medium screen sizes and above.

```html
<p class="break-normal md:break-all ...">
  <!-- ... -->
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for word break utilities.

You can control which variants are generated for the word break utilities by modifying the `wordBreak` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       wordBreak: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the word break utilities in your project, you can disable them entirely by setting the `wordBreak` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     wordBreak: false,
    }
  }
```

[←Whitespace](https://tailwindcss.com/docs/whitespace)[Background Attachment
  ](https://tailwindcss.com/docs/background-attachment)



































