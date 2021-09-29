---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind Flex Direction"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Flex Direction

Utilities for controlling the direction of flex items.

## Default class reference

| Class            | Properties                      |
| ---------------- | ------------------------------- |
| flex-row         | flex-direction: row;            |
| flex-row-reverse | flex-direction: row-reverse;    |
| flex-col         | flex-direction: column;         |
| flex-col-reverse | flex-direction: column-reverse; |

## Row

Use `flex-row` to position flex items horizontally in the same direction as text:

1

2

3

```html
<div class="flex flex-row ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Row reversed

Use `flex-row-reverse` to position flex items horizontally in the opposite direction:

1

2

3

```html
<div class="flex flex-row-reverse ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Column

Use `flex-col` to position flex items vertically:

1

2

3

```html
<div class="flex flex-col ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Column reversed

Use `flex-col-reverse` to position flex items vertically in the opposite direction:

1

2

3

```html
<div class="flex flex-col-reverse ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To apply a flex direction utility only at a specific breakpoint, add a `{screen}:` prefix to the existing class name. For example, adding the class `md:flex-row` to an element would apply the `flex-row` utility at medium screen sizes and above.

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

```html
  <div class="flex flex-col md:flex-row ...">
    <!-- ... -->
  </div>
```

## Customizing

### Variants

By default, only responsive variants are generated for flex-direction utilities.

You can control which variants are generated for the flex-direction utilities by modifying the `flexDirection` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       flexDirection: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the flex-direction utilities in your project, you can disable them entirely by setting the `flexDirection` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     flexDirection: false,
    }
  }
```

[←Z-Index](https://tailwindcss.com/docs/z-index)[Flex Wrap
  ](https://tailwindcss.com/docs/flex-wrap)



---



# Flex Wrap

Utilities for controlling how flex items wrap.

## Default class reference

| Class             | Properties               |
| ----------------- | ------------------------ |
| flex-wrap         | flex-wrap: wrap;         |
| flex-wrap-reverse | flex-wrap: wrap-reverse; |
| flex-nowrap       | flex-wrap: nowrap;       |

## Don't wrap

Use `flex-nowrap` to prevent flex items from wrapping, causing inflexible items to overflow the container if necessary:

1

2

3

```html
<div class="flex flex-nowrap">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Wrap normally

Use `flex-wrap` to allow flex items to wrap:

1

2

3

```html
<div class="flex flex-wrap">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Wrap reversed

Use `flex-wrap-reverse` to wrap flex items in the reverse direction:

1

2

3

```html
<div class="flex flex-wrap-reverse">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To control how flex items wrap at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:flex-wrap-reverse` to apply the `flex-wrap-reverse` utility at only medium screen sizes and above.

```html
<div class="flex flex-wrap md:flex-wrap-reverse ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for flex-wrap utilities.

You can control which variants are generated for the flex-wrap utilities by modifying the `flexWrap` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       flexWrap: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the flex-wrap utilities in your project, you can disable them entirely by setting the `flexWrap` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     flexWrap: false,
    }
  }
```

[←Flex Direction](https://tailwindcss.com/docs/flex-direction)[Flex
  ](https://tailwindcss.com/docs/flex)



---

# Flex

Utilities for controlling how flex items both grow and shrink.

## Default class reference

| Class        | Properties      |
| ------------ | --------------- |
| flex-1       | flex: 1 1 0%;   |
| flex-auto    | flex: 1 1 auto; |
| flex-initial | flex: 0 1 auto; |
| flex-none    | flex: none;     |

## Initial

Use `flex-initial` to allow a flex item to shrink but not grow, taking into account its initial size:

Items don't grow when there's extra space

Short

Medium length

Items shrink if possible when needed

Short

Medium length

Lorem ipsum dolor sit amet, consectetur adipisicing elit. Qui ad labore ipsam, aut rem quo repellat esse tempore id, quidem

```html
<div class="flex">
  <div class="flex-initial ...">
    <!-- Won't grow, but will shrink if needed -->
  </div>
  <div class="flex-initial ...">
    <!-- Won't grow, but will shrink if needed -->
  </div>
  <div class="flex-initial ...">
    <!-- Won't grow, but will shrink if needed -->
  </div>
</div>
```

## Flex 1

Use `flex-1` to allow a flex item to grow and shrink as needed, ignoring its initial size:

Default behavior

Short

Medium length

Significantly larger amount of content

With `.flex-1`

Short

Medium length

Significantly larger amount of content

```html
<div class="flex">
  <div class="flex-1 ...">
    <!-- Will grow and shrink as needed without taking initial size into account -->
  </div>
  <div class="flex-1 ...">
    <!-- Will grow and shrink as needed without taking initial size into account -->
  </div>
  <div class="flex-1 ...">
    <!-- Will grow and shrink as needed without taking initial size into account -->
  </div>
</div>
```

## Auto

Use `flex-auto` to allow a flex item to grow and shrink, taking into account its initial size:

Default behavior

Short

Medium length

Significantly larger amount of content

With `.flex-auto`

Short

Medium length

Significantly larger amount of content

```html
<div class="flex ...">
  <div class="flex-auto ...">
    <!-- Will grow and shrink as needed taking initial size into account -->
  </div>
  <div class="flex-auto ...">
    <!-- Will grow and shrink as needed taking initial size into account -->
  </div>
  <div class="flex-auto ...">
    <!-- Will grow and shrink as needed taking initial size into account -->
  </div>
</div>
```

## None

Use `flex-none` to prevent a flex item from growing or shrinking:

Item that can grow or shrink if needed

Item that cannot grow or shrink

Item that can grow or shrink if needed

```html
<div class="flex ...">
  <div class="flex-1 ...">
    <!-- Will grow and shrink as needed -->
  </div>
  <div class="flex-none ...">
    <!-- Will not grow or shrink -->
  </div>
  <div class="flex-1 ...">
    <!-- Will grow and shrink as needed -->
  </div>
</div>
```

## Responsive

To control how a flex item both grows and shrinks at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:flex-1` to apply the `flex-1` utility at only medium screen sizes and above.

```html
<div class="flex ...">
  <!-- ... -->
  <div class="flex-none md:flex-1 ...">
    Responsive flex item
  </div>
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Flex Values

By default, Tailwind provides four `flex` utilities. You change, add, or remove these by editing the `theme.flex` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      flex: {
        '1': '1 1 0%',
        auto: '1 1 auto',
-       initial: '0 1 auto',
+       inherit: 'inherit',
        none: 'none',
+       '2': '2 2 0%',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for flex utilities.

You can control which variants are generated for the flex utilities by modifying the `flex` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       flex: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the flex utilities in your project, you can disable them entirely by setting the `flex` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     flex: false,
    }
  }
```

[←Flex Wrap](https://tailwindcss.com/docs/flex-wrap)[Flex Grow
  ](https://tailwindcss.com/docs/flex-grow)



---



# Flex Grow

Utilities for controlling how flex items grow.

## Default class reference

| Class       | Properties    |
| ----------- | ------------- |
| flex-grow-0 | flex-grow: 0; |
| flex-grow   | flex-grow: 1; |

## Grow

Use `flex-grow` to allow a flex item to grow to fill any available space:









```html
<div class="flex ...">
  <div class="flex-none w-16 h-16 ...">
    <!-- This item will not grow -->
  </div>
  <div class="flex-grow h-16 ...">
    <!-- This item will grow -->
  </div>
  <div class="flex-none w-16 h-16 ...">
    <!-- This item will not grow -->
  </div>
</div>
```

## Don't grow

Use `flex-grow-0` to prevent a flex item from growing:









```html
<div class="flex ...">
  <div class="flex-grow h-16 ...">
    <!-- This item will grow -->
  </div>
  <div class="flex-grow-0 h-16 ...">
    <!-- This item will not grow -->
  </div>
  <div class="flex-grow h-16 ...">
    <!-- This item will grow -->
  </div>
</div>
```

## Responsive

To control how a flex item grows at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:flex-grow-0` to apply the `flex-grow-0` utility at only medium screen sizes and above.

```html
<div class="flex ...">
  <!-- ... -->
  <div class="flex-grow md:flex-grow-0 ...">
    Responsive flex item
  </div>
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Grow Values

By default, Tailwind provides two `flex-grow` utilities. You change, add, or remove these by editing the `theme.flexGrow` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      flexGrow: {
        '0': 0,
-       DEFAULT: 1,
+       DEFAULT: 2,
+       '1': 1,
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for flex grow utilities.

You can control which variants are generated for the flex grow utilities by modifying the `flexGrow` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       flexGrow: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the flex grow utilities in your project, you can disable them entirely by setting the `flexGrow` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     flexGrow: false,
    }
  }
```

[←Flex](https://tailwindcss.com/docs/flex)[Flex Shrink
  ](https://tailwindcss.com/docs/flex-shrink)



---

# Flex Shrink

Utilities for controlling how flex items shrink.

## Default class reference

| Class         | Properties      |
| ------------- | --------------- |
| flex-shrink-0 | flex-shrink: 0; |
| flex-shrink   | flex-shrink: 1; |

## Shrink

Use `flex-shrink` to allow a flex item to shrink if needed:









```html
<div class="flex ...">
  <div class="flex-grow w-16 h-16 ...">
    <!-- This item will grow or shrink as needed -->
  </div>
  <div class="flex-shrink w-64 h-16 ...">
    <!-- This item will shrink -->
  </div>
  <div class="flex-grow w-16 h-16 ...">
    <!-- This item will grow or shrink as needed -->
  </div>
</div>
```

## Don't shrink

Use `flex-shrink-0` to prevent a flex item from shrinking:









```html
<div class="flex ...">
  <div class="flex-1 h-16 ...">
    <!-- This item will grow or shrink as needed -->
  </div>
  <div class="flex-shrink-0 h-16 w-32 ...">
    <!-- This item will not shrink below its initial size-->
  </div>
  <div class="flex-1 h-16 ...">
    <!-- This item will grow or shrink as needed -->
  </div>
</div>
```

## Responsive

To control how a flex item shrinks at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:flex-shrink-0` to apply the `flex-shrink-0` utility at only medium screen sizes and above.

```html
<div class="flex ...">
  <!-- ... -->
  <div class="flex-shrink md:flex-shrink-0 ...">
    Responsive flex item
  </div>
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Shrink Values

By default, Tailwind provides two `flex-shrink` utilities. You change, add, or remove these by editing the `theme.flexShrink` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      flexShrink: {
        '0': 0,
-       DEFAULT: 1,
+       DEFAULT: 2,
+       '1': 1,
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for flex shrink utilities.

You can control which variants are generated for the flex shrink utilities by modifying the `flexShrink` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       flexShrink: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the flex shrink utilities in your project, you can disable them entirely by setting the `flexShrink` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     flexShrink: false,
    }
  }
```

[←Flex Grow](https://tailwindcss.com/docs/flex-grow)[Order
  ](https://tailwindcss.com/docs/order)



---

# Order

Utilities for controlling the order of flex and grid items.

## Default class reference

| Class       | Properties    |
| ----------- | ------------- |
| order-1     | order: 1;     |
| order-2     | order: 2;     |
| order-3     | order: 3;     |
| order-4     | order: 4;     |
| order-5     | order: 5;     |
| order-6     | order: 6;     |
| order-7     | order: 7;     |
| order-8     | order: 8;     |
| order-9     | order: 9;     |
| order-10    | order: 10;    |
| order-11    | order: 11;    |
| order-12    | order: 12;    |
| order-first | order: -9999; |
| order-last  | order: 9999;  |
| order-none  | order: 0;     |

## Usage

Use `order-{order}` to render flex and grid items in a different order than they appear in the DOM.

1

2

3

```html
<div class="flex justify-between ...">
  <div class="order-last">1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To apply an order utility only at a specific breakpoint, add a `{screen}:` prefix to the existing class name. For example, adding the class `md:order-last` to an element would apply the `order-last` utility at medium screen sizes and above.

```html
<div class="flex">
  <div>1</div>
  <div class="order-first md:order-last">2</div>
  <div>3</div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind provides utilities for `order-first`, `order-last`, `order-none`, and an `order-{number}` utility for the numbers 1 through 12. You change, add, or remove these by editing the `theme.order` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      order: {
        first: '-9999',
        last: '9999',
-       none: '0',
+       normal: '0',
        '1': '1',
        '2': '2',
        '3': '3',
        '4': '4',
        '5': '5',
        '6': '6',
-       '7': '7',
-       '8': '8',
-       '9': '9',
-       '10': '10',
-       '11': '11',
-       '12': '12',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for order utilities.

You can control which variants are generated for the order utilities by modifying the `order` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       order: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the order utilities in your project, you can disable them entirely by setting the `order` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     order: false,
    }
  }
```

[←Flex Shrink](https://tailwindcss.com/docs/flex-shrink)[Grid Template Columns
  ](https://tailwindcss.com/docs/grid-template-columns)



---

# Grid Template Columns

Utilities for specifying the columns in a grid layout.

## Default class reference

| Class          | Properties                                         |
| -------------- | -------------------------------------------------- |
| grid-cols-1    | grid-template-columns: repeat(1, minmax(0, 1fr));  |
| grid-cols-2    | grid-template-columns: repeat(2, minmax(0, 1fr));  |
| grid-cols-3    | grid-template-columns: repeat(3, minmax(0, 1fr));  |
| grid-cols-4    | grid-template-columns: repeat(4, minmax(0, 1fr));  |
| grid-cols-5    | grid-template-columns: repeat(5, minmax(0, 1fr));  |
| grid-cols-6    | grid-template-columns: repeat(6, minmax(0, 1fr));  |
| grid-cols-7    | grid-template-columns: repeat(7, minmax(0, 1fr));  |
| grid-cols-8    | grid-template-columns: repeat(8, minmax(0, 1fr));  |
| grid-cols-9    | grid-template-columns: repeat(9, minmax(0, 1fr));  |
| grid-cols-10   | grid-template-columns: repeat(10, minmax(0, 1fr)); |
| grid-cols-11   | grid-template-columns: repeat(11, minmax(0, 1fr)); |
| grid-cols-12   | grid-template-columns: repeat(12, minmax(0, 1fr)); |
| grid-cols-none | grid-template-columns: none;                       |

## Usage

Use the `grid-cols-{n}` utilities to create grids with *n* equally sized columns.

1

2

3

4

5

6

7

8

9

```html
<div class="grid grid-cols-3 gap-4">
  <div>1</div>
  <!-- ... -->
  <div>9</div>
</div>
```

## Responsive

To control the columns of a grid at a specific breakpoint, add a `{screen}:` prefix to any existing grid-template-columns utility. For example, use `md:grid-cols-6` to apply the `grid-cols-6` utility at only medium screen sizes and above.

```html
<div class="grid grid-cols-1 md:grid-cols-6">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind includes grid-template-column utilities for creating basic grids with up to 12 equal width columns. You change, add, or remove these by customizing the `gridTemplateColumns` section of your Tailwind theme config.

You have direct access to the `grid-template-columns` CSS property here so you can make your custom column values as generic or as complicated and site-specific as you like.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridTemplateColumns: {
          // Simple 16 column grid
+         '16': 'repeat(16, minmax(0, 1fr))',

          // Complex site-specific column configuration
+         'footer': '200px minmax(900px, 1fr) 100px',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grid-template-columns utilities.

You can control which variants are generated for the grid-template-columns utilities by modifying the `gridTemplateColumns` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gridTemplateColumns: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the grid-template-columns utilities in your project, you can disable them entirely by setting the `gridTemplateColumns` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridTemplateColumns: false,
    }
  }
```

[←Order](https://tailwindcss.com/docs/order)[Grid Column Start / End
  ](https://tailwindcss.com/docs/grid-column)



---

# Grid Column Start / End

Utilities for controlling how elements are sized and placed across grid columns.

## Default class reference

| Class          | Properties                      |
| -------------- | ------------------------------- |
| col-auto       | grid-column: auto;              |
| col-span-1     | grid-column: span 1 / span 1;   |
| col-span-2     | grid-column: span 2 / span 2;   |
| col-span-3     | grid-column: span 3 / span 3;   |
| col-span-4     | grid-column: span 4 / span 4;   |
| col-span-5     | grid-column: span 5 / span 5;   |
| col-span-6     | grid-column: span 6 / span 6;   |
| col-span-7     | grid-column: span 7 / span 7;   |
| col-span-8     | grid-column: span 8 / span 8;   |
| col-span-9     | grid-column: span 9 / span 9;   |
| col-span-10    | grid-column: span 10 / span 10; |
| col-span-11    | grid-column: span 11 / span 11; |
| col-span-12    | grid-column: span 12 / span 12; |
| col-span-full  | grid-column: 1 / -1;            |
| col-start-1    | grid-column-start: 1;           |
| col-start-2    | grid-column-start: 2;           |
| col-start-3    | grid-column-start: 3;           |
| col-start-4    | grid-column-start: 4;           |
| col-start-5    | grid-column-start: 5;           |
| col-start-6    | grid-column-start: 6;           |
| col-start-7    | grid-column-start: 7;           |
| col-start-8    | grid-column-start: 8;           |
| col-start-9    | grid-column-start: 9;           |
| col-start-10   | grid-column-start: 10;          |
| col-start-11   | grid-column-start: 11;          |
| col-start-12   | grid-column-start: 12;          |
| col-start-13   | grid-column-start: 13;          |
| col-start-auto | grid-column-start: auto;        |
| col-end-1      | grid-column-end: 1;             |
| col-end-2      | grid-column-end: 2;             |
| col-end-3      | grid-column-end: 3;             |
| col-end-4      | grid-column-end: 4;             |
| col-end-5      | grid-column-end: 5;             |
| col-end-6      | grid-column-end: 6;             |
| col-end-7      | grid-column-end: 7;             |
| col-end-8      | grid-column-end: 8;             |
| col-end-9      | grid-column-end: 9;             |
| col-end-10     | grid-column-end: 10;            |
| col-end-11     | grid-column-end: 11;            |
| col-end-12     | grid-column-end: 12;            |
| col-end-13     | grid-column-end: 13;            |
| col-end-auto   | grid-column-end: auto;          |

## Spanning columns

Use the `col-span-{n}` utilities to make an element span *n* columns.

1

2

3

4

5

6

7

```html
<div class="grid grid-cols-3 gap-4">
  <div class="...">1</div>
  <div class="...">2</div>
  <div class="...">3</div>
  <div class="col-span-2 ...">4</div>
  <div class="...">5</div>
  <div class="...">6</div>
  <div class="col-span-2 ...">7</div>
</div>
```

## Starting and ending lines

Use the `col-start-{n}` and `col-end-{n}` utilities to make an element start or end at the *nth* grid line. These can also be combined with the `col-span-{n}` utilities to span a specific number of columns.

Note that CSS grid lines start at 1, not 0, so a full-width element in a 6-column grid would start at line 1 and end at line 7.

1

2

3

4

```html
<div class="grid grid-cols-6 gap-4">
  <div class="col-start-2 col-span-4 ...">1</div>
  <div class="col-start-1 col-end-3 ...">2</div>
  <div class="col-end-7 col-span-2 ...">3</div>
  <div class="col-start-1 col-end-7 ...">4</div>
</div>
```

## Responsive

To control the column placement of an element at a specific breakpoint, add a `{screen}:` prefix to any existing grid-column utility. For example, use `md:col-span-6` to apply the `col-span-6` utility at only medium screen sizes and above.

```html
  <div class="col-span-2 md:col-span-6"></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind includes grid-column utilities for working with grids with up to 12 columns. You change, add, or remove these by customizing the `gridColumn`, `gridColumnStart`, and `gridColumnEnd` sections of your Tailwind theme config.

For creating more `col-{value}` utilities that control the `grid-column` shorthand property directly, customize the `gridColumn` section of your Tailwind theme config:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridColumn: {
+         'span-16': 'span 16 / span 16',
        }
      }
    }
  }
```

We use this internally for our `col-span-{n}` utilities. Note that since this configures the `grid-column` shorthand property directly, we include the word `span` directly in the value name, it’s *not* baked into the class name automatically. That means you are free to add entries that do whatever you want here — they don’t just have to be `span` utilities.

To add new `col-start-{n}` utilities, use the `gridColumnStart` section of your Tailwind theme config:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridColumnStart: {
+         '13': '13',
+         '14': '14',
+         '15': '15',
+         '16': '16',
+         '17': '17',
        }
      }
    }
  }
```

To add new `col-end-{n}` utilities, use the `gridColumnEnd` section of your Tailwind theme config:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridColumnEnd: {
+         '13': '13',
+         '14': '14',
+         '15': '15',
+         '16': '16',
+         '17': '17',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grid-column utilities.

You can control which variants are generated for the grid-column utilities by modifying the `gridColumn`, `gridColumnStart`, and `gridColumnEnd` properties in the `variants` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    variants: {
      // ...
+     gridColumn: ['responsive', 'hover'],
+     gridColumnStart: ['responsive', 'hover'],
+     gridColumnEnd: ['responsive', 'hover'],
    }
  }
```

Learn more about configuring variants in the [configuring variants documentation](https://tailwindcss.com/docs/configuring-variants).

### Disabling

If you don't plan to use the grid-column utilities in your project, you can disable them entirely by setting the `gridColumn`, `gridColumnStart` and `gridColumnEnd` properties to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridColumn: false,
+     gridColumnStart: false,
+     gridColumnEnd: false,
    }
  }
```

[←Grid Template Columns](https://tailwindcss.com/docs/grid-template-columns)[Grid Template Rows
  ](https://tailwindcss.com/docs/grid-template-rows)



---

# Grid Template Rows

Utilities for specifying the rows in a grid layout.

## Default class reference

| Class          | Properties                                     |
| -------------- | ---------------------------------------------- |
| grid-rows-1    | grid-template-rows: repeat(1, minmax(0, 1fr)); |
| grid-rows-2    | grid-template-rows: repeat(2, minmax(0, 1fr)); |
| grid-rows-3    | grid-template-rows: repeat(3, minmax(0, 1fr)); |
| grid-rows-4    | grid-template-rows: repeat(4, minmax(0, 1fr)); |
| grid-rows-5    | grid-template-rows: repeat(5, minmax(0, 1fr)); |
| grid-rows-6    | grid-template-rows: repeat(6, minmax(0, 1fr)); |
| grid-rows-none | grid-template-rows: none;                      |

## Usage

Use the `grid-rows-{n}` utilities to create grids with *n* equally sized rows.

1

2

3

4

5

6

7

8

9

```html
<div class="h-64 grid grid-rows-3 grid-flow-col gap-4">
  <div>1</div>
  <!-- ... -->
  <div>9</div>
</div>
```

## Responsive

To control the rows of a grid at a specific breakpoint, add a `{screen}:` prefix to any existing grid-template-rows utility. For example, use `md:grid-rows-6` to apply the `grid-rows-6` utility at only medium screen sizes and above.

```html
<div class="grid grid-rows-2 md:grid-rows-6 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind includes grid-template-row utilities for creating basic grids with up to 6 equal width rows. You change, add, or remove these by customizing the `gridTemplateRows` section of your Tailwind theme config.

You have direct access to the `grid-template-rows` CSS property here so you can make your custom rows values as generic or as complicated and site-specific as you like.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridTemplateRows: {
          // Simple 8 row grid
+         '8': 'repeat(8, minmax(0, 1fr))',

          // Complex site-specific row configuration
+         'layout': '200px minmax(900px, 1fr) 100px',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grid-template-rows utilities.

You can control which variants are generated for the grid-template-rows utilities by modifying the `gridTemplateRows` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gridTemplateRows: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the grid-template-rows utilities in your project, you can disable them entirely by setting the `gridTemplateRows` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridTemplateRows: false,
    }
  }
```

[←Grid Column Start / End](https://tailwindcss.com/docs/grid-column)[Grid Row Start / End
  ](https://tailwindcss.com/docs/grid-row)



---



# Grid Row Start / End

Utilities for controlling how elements are sized and placed across grid rows.

## Default class reference

| Class          | Properties                 |
| -------------- | -------------------------- |
| row-auto       | grid-row: auto;            |
| row-span-1     | grid-row: span 1 / span 1; |
| row-span-2     | grid-row: span 2 / span 2; |
| row-span-3     | grid-row: span 3 / span 3; |
| row-span-4     | grid-row: span 4 / span 4; |
| row-span-5     | grid-row: span 5 / span 5; |
| row-span-6     | grid-row: span 6 / span 6; |
| row-span-full  | grid-row: 1 / -1;          |
| row-start-1    | grid-row-start: 1;         |
| row-start-2    | grid-row-start: 2;         |
| row-start-3    | grid-row-start: 3;         |
| row-start-4    | grid-row-start: 4;         |
| row-start-5    | grid-row-start: 5;         |
| row-start-6    | grid-row-start: 6;         |
| row-start-7    | grid-row-start: 7;         |
| row-start-auto | grid-row-start: auto;      |
| row-end-1      | grid-row-end: 1;           |
| row-end-2      | grid-row-end: 2;           |
| row-end-3      | grid-row-end: 3;           |
| row-end-4      | grid-row-end: 4;           |
| row-end-5      | grid-row-end: 5;           |
| row-end-6      | grid-row-end: 6;           |
| row-end-7      | grid-row-end: 7;           |
| row-end-auto   | grid-row-end: auto;        |

## Spanning rows

Use the `row-span-{n}` utilities to make an element span *n* rows.

1

2

3

```html
<div class="grid grid-rows-3 grid-flow-col gap-4">
  <div class="row-span-3 ...">1</div>
  <div class="col-span-2 ...">2</div>
  <div class="row-span-2 col-span-2 ...">3</div>
</div>
```

## Starting and ending lines

Use the `row-start-{n}` and `row-end-{n}` utilities to make an element start or end at the *nth* grid line. These can also be combined with the `row-span-{n}` utilities to span a specific number of rows.

Note that CSS grid lines start at 1, not 0, so a full-height element in a 3-row grid would start at line 1 and end at line 4.

1

2

3

```html
<div class="grid grid-rows-3 grid-flow-col gap-4">
  <div class="row-start-2 row-span-2 ...">1</div>
  <div class="row-end-3 row-span-2 ...">2</div>
  <div class="row-start-1 row-end-4 ...">3</div>
</div>
```

## Responsive

To control the row placement of an element at a specific breakpoint, add a `{screen}:` prefix to any existing grid-row utility. For example, use `md:row-span-3` to apply the `row-span-3` utility at only medium screen sizes and above.

```html
<div class="grid grid-rows-3 ...">
  <div class="row-span-3 md:row-span-3 ..."></div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind includes grid-row utilities for working with grids with up to 6 explicit rows. You change, add, or remove these by customizing the `gridRow`, `gridRowStart`, and `gridRowEnd` sections of your Tailwind theme config.

For creating more `row-{value}` utilities that control the `grid-row` shorthand property directly, customize the `gridRow` section of your Tailwind theme config:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridRow: {
+         'span-16': 'span 16 / span 16',
        }
      }
    }
  }
```

We use this internally for our `row-span-{n}` utilities. Note that since this configures the `grid-row` shorthand property directly, we include the word `span` directly in the value name, it’s *not* baked into the class name automatically. That means you are free to add entries that do whatever you want here — they don’t just have to be `span` utilities.

To add new `row-start-{n}` utilities, use the `gridRowStart` section of your Tailwind theme config:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridRowStart: {
+         '8': '8',
+         '9': '9',
+         '10': '10',
+         '11': '11',
+         '12': '12',
+         '13': '13',
        }
      }
    }
  }
```

To add new `row-end-{n}` utilities, use the `gridRowEnd` section of your Tailwind theme config:

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridRowEnd: {
+         '8': '8',
+         '9': '9',
+         '10': '10',
+         '11': '11',
+         '12': '12',
+         '13': '13',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grid-row utilities.

You can control which variants are generated for the grid-row utilities by modifying the `gridRow`, `gridRowStart`, and `gridRowEnd` properties in the `variants` section of your `tailwind.config.js` file.

```diff-js
  // tailwind.config.js
  module.exports = {
    variants: {
      // ...
+     gridRow: ['responsive', 'hover'],
+     gridRowStart: ['responsive', 'hover'],
+     gridRowEnd: ['responsive', 'hover'],
    }
  }
```

Learn more about configuring variants in the [configuring variants documentation](https://tailwindcss.com/docs/configuring-variants).

### Disabling

If you don't plan to use the grid-row utilities in your project, you can disable them entirely by setting the `gridRow`, `gridRowStart` and `gridRowEnd` properties to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridRow: false,
+     gridRowStart: false,
+     gridRowEnd: false,
    }
  }
```

[←Grid Template Rows](https://tailwindcss.com/docs/grid-template-rows)[Grid Auto Flow
  ](https://tailwindcss.com/docs/grid-auto-flow)



---

# Grid Auto Flow

Utilities for controlling how elements in a grid are auto-placed.

## Default class reference

| Class               | Properties                    |
| ------------------- | ----------------------------- |
| grid-flow-row       | grid-auto-flow: row;          |
| grid-flow-col       | grid-auto-flow: column;       |
| grid-flow-row-dense | grid-auto-flow: row dense;    |
| grid-flow-col-dense | grid-auto-flow: column dense; |

## Usage

Use the `grid-flow-{keyword}` utilities to control how the auto-placement algorithm works for a grid layout.

1

2

3

4

5

6

7

8

9

```html
<div class="grid grid-flow-col grid-cols-3 grid-rows-3 gap-4">
  <div>1</div>
  <!-- ... -->
  <div>9</div>
</div>
```

## Responsive

To control the grid-auto-flow property at a specific breakpoint, add a `{screen}:` prefix to any existing grid-auto-flow utility. For example, use `md:grid-flow-col` to apply the `grid-flow-col` utility at only medium screen sizes and above.

```html
<div class="grid md:grid-flow-col ...">
  <div>1</div>
  <!-- ... -->
  <div>9</div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for grid-auto-flow utilities.

You can control which variants are generated for the grid-auto-flow utilities by modifying the `gridAutoFlow` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gridAutoFlow: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the grid-auto-flow utilities in your project, you can disable them entirely by setting the `gridAutoFlow` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridAutoFlow: false,
    }
  }
```

[←Grid Row Start / End](https://tailwindcss.com/docs/grid-row)[Grid Auto Columns
  ](https://tailwindcss.com/docs/grid-auto-columns)



---



# Grid Auto Columns

Utilities for controlling the size of implicitly-created grid columns.

## Default class reference

| Class          | Properties                         |
| -------------- | ---------------------------------- |
| auto-cols-auto | grid-auto-columns: auto;           |
| auto-cols-min  | grid-auto-columns: min-content;    |
| auto-cols-max  | grid-auto-columns: max-content;    |
| auto-cols-fr   | grid-auto-columns: minmax(0, 1fr); |

## Usage

Use the `auto-cols-{size}` utilities to control the size implicitly-created grid columns.

```html
<div class="grid grid-flow-col auto-cols-max">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To control the grid-auto-columns property at a specific breakpoint, add a `{screen}:` prefix to any existing grid-auto-columns utility. For example, use `md:auto-cols-min` to apply the `auto-cols-min` utility at only medium screen sizes and above.

```html
<div class="grid grid-flow-col auto-cols-max md:auto-cols-min">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind includes four general purpose grid-auto-columns utilities. You can customize these in the `theme.gridAutoColumns` section of your `tailwind.config.js` file.

```js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridAutoColumns: {
          '2fr': 'minmax(0, 2fr)',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grid-auto-columns utilities.

You can control which variants are generated for the grid-auto-columns utilities by modifying the `gridAutoColumns` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gridAutoColumns: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the grid-auto-columns utilities in your project, you can disable them entirely by setting the `gridAutoColumns` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridAutoColumns: false,
    }
  }
```

[←Grid Auto Flow](https://tailwindcss.com/docs/grid-auto-flow)[Grid Auto Rows
  ](https://tailwindcss.com/docs/grid-auto-rows)



---



# Grid Auto Rows

Utilities for controlling the size of implicitly-created grid rows.

## Default class reference

| Class          | Properties                      |
| -------------- | ------------------------------- |
| auto-rows-auto | grid-auto-rows: auto;           |
| auto-rows-min  | grid-auto-rows: min-content;    |
| auto-rows-max  | grid-auto-rows: max-content;    |
| auto-rows-fr   | grid-auto-rows: minmax(0, 1fr); |

## Usage

Use the `auto-rows-{size}` utilities to control the size implicitly-created grid rows.

```html
<div class="grid grid-flow-row auto-rows-max">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To control the grid-auto-rows property at a specific breakpoint, add a `{screen}:` prefix to any existing grid-auto-rows utility. For example, use `md:auto-rows-min` to apply the `auto-rows-min` utility at only medium screen sizes and above.

```html
<div class="grid grid-flow-row auto-rows-max md:auto-rows-min">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

By default, Tailwind includes four general purpose grid-auto-rows utilities. You can customize these in the `theme.gridAutoRows` section of your `tailwind.config.js` file.

```js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gridAutoRows: {
          '2fr': 'minmax(0, 2fr)',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for grid-auto-rows utilities.

You can control which variants are generated for the grid-auto-rows utilities by modifying the `gridAutoRows` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gridAutoRows: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the grid-auto-rows utilities in your project, you can disable them entirely by setting the `gridAutoRows` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gridAutoRows: false,
    }
  }
```

[←Grid Auto Columns](https://tailwindcss.com/docs/grid-auto-columns)[Gap
  ](https://tailwindcss.com/docs/gap)



---

# Gap

Utilities for controlling gutters between grid and flexbox items.

## Default class reference

| Class     | Properties            |
| --------- | --------------------- |
| gap-0     | gap: 0px;             |
| gap-x-0   | column-gap: 0px;      |
| gap-y-0   | row-gap: 0px;         |
| gap-px    | gap: 1px;             |
| gap-x-px  | column-gap: 1px;      |
| gap-y-px  | row-gap: 1px;         |
| gap-0.5   | gap: 0.125rem;        |
| gap-x-0.5 | column-gap: 0.125rem; |
| gap-y-0.5 | row-gap: 0.125rem;    |
| gap-1     | gap: 0.25rem;         |
| gap-x-1   | column-gap: 0.25rem;  |
| gap-y-1   | row-gap: 0.25rem;     |
| gap-1.5   | gap: 0.375rem;        |
| gap-x-1.5 | column-gap: 0.375rem; |
| gap-y-1.5 | row-gap: 0.375rem;    |
| gap-2     | gap: 0.5rem;          |
| gap-x-2   | column-gap: 0.5rem;   |
| gap-y-2   | row-gap: 0.5rem;      |
| gap-2.5   | gap: 0.625rem;        |
| gap-x-2.5 | column-gap: 0.625rem; |
| gap-y-2.5 | row-gap: 0.625rem;    |
| gap-3     | gap: 0.75rem;         |
| gap-x-3   | column-gap: 0.75rem;  |
| gap-y-3   | row-gap: 0.75rem;     |
| gap-3.5   | gap: 0.875rem;        |
| gap-x-3.5 | column-gap: 0.875rem; |
| gap-y-3.5 | row-gap: 0.875rem;    |
| gap-4     | gap: 1rem;            |
| gap-x-4   | column-gap: 1rem;     |
| gap-y-4   | row-gap: 1rem;        |
| gap-5     | gap: 1.25rem;         |
| gap-x-5   | column-gap: 1.25rem;  |
| gap-y-5   | row-gap: 1.25rem;     |
| gap-6     | gap: 1.5rem;          |
| gap-x-6   | column-gap: 1.5rem;   |
| gap-y-6   | row-gap: 1.5rem;      |
| gap-7     | gap: 1.75rem;         |
| gap-x-7   | column-gap: 1.75rem;  |
| gap-y-7   | row-gap: 1.75rem;     |
| gap-8     | gap: 2rem;            |
| gap-x-8   | column-gap: 2rem;     |
| gap-y-8   | row-gap: 2rem;        |
| gap-9     | gap: 2.25rem;         |
| gap-x-9   | column-gap: 2.25rem;  |
| gap-y-9   | row-gap: 2.25rem;     |
| gap-10    | gap: 2.5rem;          |
| gap-x-10  | column-gap: 2.5rem;   |
| gap-y-10  | row-gap: 2.5rem;      |
| gap-11    | gap: 2.75rem;         |
| gap-x-11  | column-gap: 2.75rem;  |
| gap-y-11  | row-gap: 2.75rem;     |
| gap-12    | gap: 3rem;            |
| gap-x-12  | column-gap: 3rem;     |
| gap-y-12  | row-gap: 3rem;        |
| gap-14    | gap: 3.5rem;          |
| gap-x-14  | column-gap: 3.5rem;   |
| gap-y-14  | row-gap: 3.5rem;      |
| gap-16    | gap: 4rem;            |
| gap-x-16  | column-gap: 4rem;     |
| gap-y-16  | row-gap: 4rem;        |
| gap-20    | gap: 5rem;            |
| gap-x-20  | column-gap: 5rem;     |
| gap-y-20  | row-gap: 5rem;        |
| gap-24    | gap: 6rem;            |
| gap-x-24  | column-gap: 6rem;     |
| gap-y-24  | row-gap: 6rem;        |
| gap-28    | gap: 7rem;            |
| gap-x-28  | column-gap: 7rem;     |
| gap-y-28  | row-gap: 7rem;        |
| gap-32    | gap: 8rem;            |
| gap-x-32  | column-gap: 8rem;     |
| gap-y-32  | row-gap: 8rem;        |
| gap-36    | gap: 9rem;            |
| gap-x-36  | column-gap: 9rem;     |
| gap-y-36  | row-gap: 9rem;        |
| gap-40    | gap: 10rem;           |
| gap-x-40  | column-gap: 10rem;    |
| gap-y-40  | row-gap: 10rem;       |
| gap-44    | gap: 11rem;           |
| gap-x-44  | column-gap: 11rem;    |
| gap-y-44  | row-gap: 11rem;       |
| gap-48    | gap: 12rem;           |
| gap-x-48  | column-gap: 12rem;    |
| gap-y-48  | row-gap: 12rem;       |
| gap-52    | gap: 13rem;           |
| gap-x-52  | column-gap: 13rem;    |
| gap-y-52  | row-gap: 13rem;       |
| gap-56    | gap: 14rem;           |
| gap-x-56  | column-gap: 14rem;    |
| gap-y-56  | row-gap: 14rem;       |
| gap-60    | gap: 15rem;           |
| gap-x-60  | column-gap: 15rem;    |
| gap-y-60  | row-gap: 15rem;       |
| gap-64    | gap: 16rem;           |
| gap-x-64  | column-gap: 16rem;    |
| gap-y-64  | row-gap: 16rem;       |
| gap-72    | gap: 18rem;           |
| gap-x-72  | column-gap: 18rem;    |
| gap-y-72  | row-gap: 18rem;       |
| gap-80    | gap: 20rem;           |
| gap-x-80  | column-gap: 20rem;    |
| gap-y-80  | row-gap: 20rem;       |
| gap-96    | gap: 24rem;           |
| gap-x-96  | column-gap: 24rem;    |
| gap-y-96  | row-gap: 24rem;       |

## Usage

Use `gap-{size}` to change the gap between both rows and columns in grid and flexbox layouts.

```html
<div class="grid gap-4 grid-cols-2">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
</div>
```

### Changing row and column gaps independently

Use `gap-x-{size}` and `gap-y-{size}` to change the gap between rows and columns independently.

```html
<div class="grid gap-x-8 gap-y-4 grid-cols-3">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

------

## Responsive

To control the gap at a specific breakpoint, add a `{screen}:` prefix to any existing gap utility. For example, use `md:gap-6` to apply the `gap-6` utility at only medium screen sizes and above.

```html
<div class="grid gap-4 md:gap-6 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

------

## Customizing

By default, Tailwind’s gap scale matches your configured [spacing scale](https://tailwindcss.com/docs/customizing-spacing).

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

To customize the gap scale separately, use the `gap` section of your Tailwind theme config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        gap: {
+         '11': '2.75rem',
+         '13': '3.25rem',
        }
      }
    }
  }
```

Learn more about customizing the default theme in the [theme customization documentation](https://tailwindcss.com/docs/theme#customizing-the-default-theme).

### Variants

By default, only responsive variants are generated for gap utilities.

You can control which variants are generated for the gap utilities by modifying the `gap` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       gap: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the gap utilities in your project, you can disable them entirely by setting the `gap` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     gap: false,
    }
  }
```

[←Grid Auto Rows](https://tailwindcss.com/docs/grid-auto-rows)[Justify Content
  ](https://tailwindcss.com/docs/justify-content)



---



# Justify Content

Utilities for controlling how flex and grid items are positioned along a container's main axis.

## Default class reference

| Class           | Properties                      |
| --------------- | ------------------------------- |
| justify-start   | justify-content: flex-start;    |
| justify-end     | justify-content: flex-end;      |
| justify-center  | justify-content: center;        |
| justify-between | justify-content: space-between; |
| justify-around  | justify-content: space-around;  |
| justify-evenly  | justify-content: space-evenly;  |

## Start

Use `justify-start` to justify items against the start of the container’s main axis:

1

2

3

```html
<div class="flex justify-start ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Center

Use `justify-center` to justify items along the center of the container’s main axis:

1

2

3

```html
<div class="flex justify-center ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## End

Use `justify-end` to justify items against the end of the container’s main axis:

1

2

3

```html
<div class="flex justify-end ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Space between

Use `justify-between` to justify items along the container’s main axis such that there is an equal amount of space between each item:

1

2

3

```html
<div class="flex justify-between ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Space around

Use `justify-around` to justify items along the container’s main axis such that there is an equal amount of space on each side of each item:

1

2

3

```html
<div class="flex justify-around ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Space evenly

Use `justify-evenly` to justify items along the container’s main axis such that there is an equal amount of space around each item, but also accounting for the doubling of space you would normally see between each item when using `justify-around`:

1

2

3

```html
<div class="flex justify-evenly ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Responsive

To justify flex items at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:justify-between` to apply the `justify-between` utility at only medium screen sizes and above.

```html
<div class="justify-start md:justify-between ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for justify-content utilities.

You can control which variants are generated for the justify-content utilities by modifying the `justifyContent` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       justifyContent: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the justify-content utilities in your project, you can disable them entirely by setting the `justifyContent` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     justifyContent: false,
    }
  }
```

[←Gap](https://tailwindcss.com/docs/gap)[Justify Items
  ](https://tailwindcss.com/docs/justify-items)



---

# Justify Items

Utilities for controlling how grid items are aligned along their inline axis.

## Default class reference

| Class                 | Properties              |
| --------------------- | ----------------------- |
| justify-items-start   | justify-items: start;   |
| justify-items-end     | justify-items: end;     |
| justify-items-center  | justify-items: center;  |
| justify-items-stretch | justify-items: stretch; |

## Start

Use `justify-items-start` to justify grid items against the start of their inline axis:

1

2

3

4

5

6

```html
<div class="grid justify-items-start ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## End

Use `justify-items-end` to justify grid items against the end of their inline axis:

1

2

3

4

5

6

```html
<div class="grid justify-items-end ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Center

Use `justify-items-center` to justify grid items along their inline axis:

1

2

3

4

5

6

```html
<div class="grid justify-items-center ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Stretch

Use `justify-items-stretch` to stretch items along their inline axis:

1

2

3

4

5

6

```html
<div class="grid justify-items-stretch ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Responsive

To justify flex items at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:justify-items-center` to apply the `justify-items-center` utility at only medium screen sizes and above.

```html
<div class="justify-items-start md:justify-items-center">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for justify-items utilities.

You can control which variants are generated for the justify-items utilities by modifying the `justifyItems` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       justifyItems: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the justify-items utilities in your project, you can disable them entirely by setting the `justifyItems` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     justifyItems: false,
    }
  }
```

[←Justify Content](https://tailwindcss.com/docs/justify-content)[Justify Self
  ](https://tailwindcss.com/docs/justify-self)



---

# Justify Self

Utilities for controlling how an individual grid item is aligned along its inline axis.

## Default class reference

| Class                | Properties             |
| -------------------- | ---------------------- |
| justify-self-auto    | justify-self: auto;    |
| justify-self-start   | justify-self: start;   |
| justify-self-end     | justify-self: end;     |
| justify-self-center  | justify-self: center;  |
| justify-self-stretch | justify-self: stretch; |

## Auto

Use `justify-self-auto` to align an item based on the value of the grid’s `justify-items` property:

1

```html
<div class="grid justify-items-stretch ...">
  <!-- ... -->
  <div class="justify-self-auto ...">1</div>
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
</div>
```

## Start

Use `justify-self-start` to align a grid item to the start its inline axis:

1

```html
<div class="grid justify-items-stretch ...">
  <!-- ... -->
  <div class="justify-self-start ...">1</div>
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
</div>
```

## Center

Use `justify-self-center` to align a grid item along the center its inline axis:

1

```html
<div class="grid justify-items-stretch ...">
  <!-- ... -->
  <div class="justify-self-center ...">1</div>
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
</div>
```

## End

Use `justify-self-end` to align a grid item to the end its inline axis:

1

```html
<div class="grid justify-items-stretch ...">
  <!-- ... -->
  <div class="justify-self-end ...">1</div>
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
</div>
```

## Stretch

Use `justify-self-stretch` to stretch a grid item to fill the grid area on its inline axis:

1

```html
<div class="grid justify-items-start ...">
  <!-- ... -->
  <div class="justify-self-stretch ...">1</div>
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
  <!-- ... -->
</div>
```

## Responsive

To control the alignment of a grid item inside its grid area at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:justify-self-end` to apply the `justify-self-end` utility at only medium screen sizes and above.

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for justify-self utilities.

You can control which variants are generated for the justify-self utilities by modifying the `justifySelf` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       justifySelf: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the justify-self utilities in your project, you can disable them entirely by setting the `justifySelf` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     justifySelf: false,
    }
  }
```

[←Justify Items](https://tailwindcss.com/docs/justify-items)[Align Content
  ](https://tailwindcss.com/docs/align-content)



---



# Align Content

Utilities for controlling how rows are positioned in multi-row flex and grid containers.

## Default class reference

| Class           | Properties                    |
| --------------- | ----------------------------- |
| content-center  | align-content: center;        |
| content-start   | align-content: flex-start;    |
| content-end     | align-content: flex-end;      |
| content-between | align-content: space-between; |
| content-around  | align-content: space-around;  |
| content-evenly  | align-content: space-evenly;  |

## Start

Use `content-start` to pack rows in a container against the start of the cross axis:

1

2

3

4

5

```html
<div class="h-48 flex flex-wrap content-start ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
</div>
```

## Center

Use `content-center` to pack rows in a container in the center of the cross axis:

1

2

3

4

5

```html
<div class="h-48 flex flex-wrap content-center ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
</div>
```

## End

Use `content-end` to pack rows in a container against the end of the cross axis:

1

2

3

4

5

```html
<div class="h-48 flex flex-wrap content-end ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
</div>
```

## Space between

Use `content-between` to distribute rows in a container such that there is an equal amount of space between each line:

1

2

3

4

5

```html
<div class="h-48 flex flex-wrap content-between ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
</div>
```

## Space around

Use `content-around` to distribute rows in a container such that there is an equal amount of space around each line:

1

2

3

4

5

```html
<div class="h-48 flex flex-wrap content-around ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
</div>
```

## Space evenly

Use `content-evenly` to distribute rows in a container such that there is an equal amount of space around each item, but also accounting for the doubling of space you would normally see between each item when using `content-around`:

1

2

3

4

5

```html
<div class="h-48 flex flex-wrap content-evenly ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
</div>
```

## Responsive

To control the alignment of flex content at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:content-around` to apply the `content-around` utility at only medium screen sizes and above.

```html
<div class="content-start md:content-around ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for align-content utilities.

You can control which variants are generated for the align-content utilities by modifying the `alignContent` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       alignContent: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the align-content utilities in your project, you can disable them entirely by setting the `alignContent` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     alignContent: false,
    }
  }
```

[←Justify Self](https://tailwindcss.com/docs/justify-self)[Align Items
  ](https://tailwindcss.com/docs/align-items)



---



# Align Items

Utilities for controlling how flex and grid items are positioned along a container's cross axis.

## Default class reference

| Class          | Properties               |
| -------------- | ------------------------ |
| items-start    | align-items: flex-start; |
| items-end      | align-items: flex-end;   |
| items-center   | align-items: center;     |
| items-baseline | align-items: baseline;   |
| items-stretch  | align-items: stretch;    |

## Stretch

Use `items-stretch` to stretch items to fill the container’s cross axis:

1

2

3

```html
<div class="flex items-stretch ...">
  <div class="py-4">1</div>
  <div class="py-12">2</div>
  <div class="py-8">3</div>
</div>
```

## Start

Use `items-start` to align items to the start of the container’s cross axis:

1

2

3

```html
<div class="flex items-start ...">
  <div class="h-12">1</div>
  <div class="h-24">2</div>
  <div class="h-16">3</div>
</div>
```

## Center

Use `items-center` to align items along the center of the container’s cross axis:

1

2

3

```html
<div class="flex items-center ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## End

Use `items-end` to align items to the end of the container’s cross axis:

1

2

3

```html
<div class="flex items-end ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
</div>
```

## Baseline

Use `items-baseline` to align items along the container’s cross axis such that all of their baselines align:

1

2

3

```html
<div class="flex items-baseline ...">
  <div class="pt-4 pb-6 ...">1</div>
  <div class="pt-6 pb-10 ...">2</div>
  <div class="pt-8 pb-4 ...">3</div>
</div>
```

## Responsive

To control the alignment of flex items at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:items-center` to apply the `items-center` utility at only medium screen sizes and above.

```html
<div class="items-stretch md:items-center ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for align-items utilities.

You can control which variants are generated for the align-items utilities by modifying the `alignItems` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       alignItems: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the align-items utilities in your project, you can disable them entirely by setting the `alignItems` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     alignItems: false,
    }
  }
```

[←Align Content](https://tailwindcss.com/docs/align-content)[Align Self
  ](https://tailwindcss.com/docs/align-self)



---

# Align Self

Utilities for controlling how an individual flex or grid item is positioned along its container's cross axis.

## Default class reference

| Class        | Properties              |
| ------------ | ----------------------- |
| self-auto    | align-self: auto;       |
| self-start   | align-self: flex-start; |
| self-end     | align-self: flex-end;   |
| self-center  | align-self: center;     |
| self-stretch | align-self: stretch;    |

## Auto

Use `self-auto` to align an item based on the value of the container’s `align-items` property:

1

2

3

```html
<div class="flex items-stretch ...">
  <div>1</div>
  <div class="self-auto ...">2</div>
  <div>3</div>
</div>
```

## Start

Use `self-start` to align an item to the start of the container’s cross axis, despite the container’s `align-items` value:

1

2

3

```html
<div class="flex items-stretch ...">
  <div>1</div>
  <div class="self-start ...">2</div>
  <div>3</div>
</div>
```

## Center

Use `self-center` to align an item along the center of the container’s cross axis, despite the container’s `align-items` value:

1

2

3

```html
<div class="flex items-stretch ...">
  <div>1</div>
  <div class="self-center ...">2</div>
  <div>3</div>
</div>
```

## End

Use `self-end` to align an item to the end of the container’s cross axis, despite the container’s `align-items` value:

1

2

3

```html
<div class="flex items-stretch ...">
  <div>1</div>
  <div class="self-end ...">2</div>
  <div>3</div>
</div>
```

## Stretch

Use `self-stretch` to stretch an item to fill the container’s cross axis, despite the container’s `align-items` value:

1

2

3

```html
<div class="flex items-stretch ...">
  <div>1</div>
  <div class="self-stretch ...">2</div>
  <div>3</div>
</div>
```

## Responsive

To control the alignment of a flex item at a specific breakpoint, add a `{screen}:` prefix to any existing utility class. For example, use `md:self-end` to apply the `self-end` utility at only medium screen sizes and above.

```html
<div class="items-stretch ...">
  <div class="self-auto md:self-end ...">
    <!-- ... -->
  </div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for align-self utilities.

You can control which variants are generated for the align-self utilities by modifying the `alignSelf` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       alignSelf: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the align-self utilities in your project, you can disable them entirely by setting the `alignSelf` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     alignSelf: false,
    }
  }
```

[←Align Items](https://tailwindcss.com/docs/align-items)[Place Content
  ](https://tailwindcss.com/docs/place-content)



---



# Place Content

Utilities for controlling how content is justified and aligned at the same time.

## Default class reference

| Class                 | Properties                    |
| --------------------- | ----------------------------- |
| place-content-center  | place-content: center;        |
| place-content-start   | place-content: start;         |
| place-content-end     | place-content: end;           |
| place-content-between | place-content: space-between; |
| place-content-around  | place-content: space-around;  |
| place-content-evenly  | place-content: space-evenly;  |
| place-content-stretch | place-content: stretch;       |

## Center

Use `place-content-center` to pack items in the center of the block axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-center h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Start

Use `place-content-start` to pack items against the start of the block axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-start h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## End

Use `place-content-end` to to pack items against the end of the block axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-end h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Space between

Use `place-content-between` to distribute grid items along the block axis so that that there is an equal amount of space between each row on the block axis.

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-between h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Space around

Use `place-content-around` distribute grid items such that there is an equal amount of space around each row on the block axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-around h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Space evenly

Use `place-content-evenly` to distribute grid items such that they are evenly spaced on the block axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-evenly h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Stretch

Use `place-content-stretch` to stretch grid items along their grid areas on the block axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-content-stretch h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Responsive

To place content at a specific breakpoint, add a `{screen}:` prefix to any existing `place-content` utility. For example, use `md:place-content-center` to apply the `place-content-center` utility at only medium screen sizes and above.

```html
<div class="place-content-start md:place-content-center">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for place-content utilities.

You can control which variants are generated for the place-content utilities by modifying the `placeContent` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       placeContent: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the place-content utilities in your project, you can disable them entirely by setting the `placeContent` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     placeContent: false,
    }
  }
```

[←Align Self](https://tailwindcss.com/docs/align-self)[Place Items
  ](https://tailwindcss.com/docs/place-items)



---

# Place Items

Utilities for controlling how items are justified and aligned at the same time.

## Default class reference

| Class               | Properties            |
| ------------------- | --------------------- |
| place-items-start   | place-items: start;   |
| place-items-end     | place-items: end;     |
| place-items-center  | place-items: center;  |
| place-items-stretch | place-items: stretch; |

## Start

Use `place-items-start` to place grid items on the start of their grid areas on both axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-items-start h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## End

Use `place-items-end` to place grid items on the end of their grid areas on both axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-items-end h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Center

Use `place-items-center` to place grid items on the center of their grid areas on both axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-items-center h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Stretch

Use `place-items-stretch` to stretch items along their grid areas on both axis:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 place-items-stretch h-48 ...">
  <div>1</div>
  <div>2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Responsive

To place items at a specific breakpoint, add a `{screen}:` prefix to any existing `place-items` utility. For example, use `md:place-items-center` to apply the `place-items-center` utility at only medium screen sizes and above.

```html
<div class="place-items-start md:place-items-center">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for place-items utilities.

You can control which variants are generated for the place-items utilities by modifying the `placeItems` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       placeItems: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the place-items utilities in your project, you can disable them entirely by setting the `placeItems` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     placeItems: false,
    }
  }
```

[←Place Content](https://tailwindcss.com/docs/place-content)[Place Self
  ](https://tailwindcss.com/docs/place-self)



---

# Place Self

Utilities for controlling how an individual item is justified and aligned at the same time.

## Default class reference

| Class              | Properties           |
| ------------------ | -------------------- |
| place-self-auto    | place-self: auto;    |
| place-self-start   | place-self: start;   |
| place-self-end     | place-self: end;     |
| place-self-center  | place-self: center;  |
| place-self-stretch | place-self: stretch; |

## Auto

Use `place-self-auto` to align an item based on the value of the container’s `place-items` property:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 ...">
  <div>1</div>
  <div class="place-self-auto ...">2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Start

Use `place-self-start` to align an item to the start on both axes:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 ...">
  <div>1</div>
  <div class="place-self-start ...">2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Center

Use `place-self-center` to align an item at the center on both axes:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 ...">
  <div>1</div>
  <div class="place-self-center ...">2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## End

Use `place-self-end` to align an item to the end on both axes:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 ...">
  <div>1</div>
  <div class="place-self-end ...">2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Stretch

Use `place-self-stretch` to stretch an item on both axes:

1

2

3

4

5

6

```html
<div class="grid grid-cols-3 gap-2 ...">
  <div>1</div>
  <div class="place-self-stretch ...">2</div>
  <div>3</div>
  <div>4</div>
  <div>5</div>
  <div>6</div>
</div>
```

## Responsive

To place an item at a specific breakpoint, add a `{screen}:` prefix to any existing `place-self` utility. For example, use `md:place-self-end` to apply the `place-self-end` utility at only medium screen sizes and above.

```html
<div class="place-self-start md:place-self-end">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

## Customizing

### Variants

By default, only responsive variants are generated for place-self utilities.

You can control which variants are generated for the place-self utilities by modifying the `placeSelf` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       placeSelf: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the place-self utilities in your project, you can disable them entirely by setting the `placeSelf` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     placeSelf: false,
    }
  }
```

[←Place Items](https://tailwindcss.com/docs/place-items)[Padding
  ](https://tailwindcss.com/docs/padding)