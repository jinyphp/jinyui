---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Appearance

Utilities for suppressing native form control styling.

## Default class reference

| Class           | Properties        |
| --------------- | ----------------- |
| appearance-none | appearance: none; |

## Usage

Use `appearance-none` to reset any browser specific styling on an element. This utility is often used when creating [custom form components](https://tailwindcss.com/docs/examples/forms).

Default browser styles applied

Default styles removed

```html
<select>
  <option>Yes</option>
  <option>No</option>
  <option>Maybe</option>
</select>

<select class="appearance-none">
  <option>Yes</option>
  <option>No</option>
  <option>Maybe</option>
</select>
```

## Customizing

### Variants

By default, only responsive variants are generated for appearance utilities.

You can control which variants are generated for the appearance utilities by modifying the `appearance` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       appearance: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the appearance utilities in your project, you can disable them entirely by setting the `appearance` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     appearance: false,
    }
  }
```

[←Skew](https://tailwindcss.com/docs/skew)[Cursor
  ](https://tailwindcss.com/docs/cursor)



---



# Cursor

Utilities for controlling the cursor style when hovering over an element.

## Default class reference

| Class              | Properties           |
| ------------------ | -------------------- |
| cursor-auto        | cursor: auto;        |
| cursor-default     | cursor: default;     |
| cursor-pointer     | cursor: pointer;     |
| cursor-wait        | cursor: wait;        |
| cursor-text        | cursor: text;        |
| cursor-move        | cursor: move;        |
| cursor-help        | cursor: help;        |
| cursor-not-allowed | cursor: not-allowed; |

## Auto

Use `cursor-auto` to allow the browser to change the cursor based on the current content (e.g. automatically change to `text` cursor when hovering over text).

Hover over this text

```html
<div class="cursor-auto ...">
  Hover over this text
</div>
```

## Default

Use `cursor-default` to change the mouse cursor to always use the platform-dependent default cursor (usually an arrow).

Hover over this text

```html
<div class="cursor-default ...">
  Hover over this text
</div>
```

## Pointer

Use `cursor-pointer` to change the mouse cursor to indicate an interactive element (usually a pointing hand).

Hover me

```html
<div class="cursor-pointer ...">
  Hover me
</div>
```

## Wait

Use `cursor-wait` to change the mouse cursor to indicate something is happening in the background (usually an hourglass or watch).

Hover me

```html
<div class="cursor-wait ...">
  Hover me
</div>
```

## Text

Use `cursor-text` to change the mouse cursor to indicate the text can be selected (usually an I-beam shape).

Hover me

```html
<div class="cursor-text ...">
  Hover me
</div>
```

## Move

Use `cursor-move` to change the mouse cursor to indicate something that can be moved.

Hover me

```html
<div class="cursor-move ...">
  Hover me
</div>
```

## Not Allowed

Use `cursor-not-allowed` to change the mouse cursor to indicate something can not be interacted with or clicked.

Hover me

```html
<div class="cursor-not-allowed ...">
  Hover me
</div>
```

## Customizing

### Cursors

By default, Tailwind provides six `cursor` utilities. You change, add, or remove these by editing the `theme.cursor` section of your Tailwind config.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      cursor: {
        auto: 'auto',
        default: 'default',
        pointer: 'pointer',
-       wait: 'wait',
        text: 'text',
-       move: 'move',
        'not-allowed': 'not-allowed',
+       crosshair: 'crosshair',
+       'zoom-in': 'zoom-in',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for cursor utilities.

You can control which variants are generated for the cursor utilities by modifying the `cursor` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       cursor: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the cursor utilities in your project, you can disable them entirely by setting the `cursor` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     cursor: false,
    }
  }
```

[←Appearance](https://tailwindcss.com/docs/appearance)[Outline
  ](https://tailwindcss.com/docs/outline)



---



# Outline

Utilities for controlling an element's outline.

## Default class reference

| Class         | Properties                                           |
| ------------- | ---------------------------------------------------- |
| outline-none  | outline: 2px solid transparent; outline-offset: 2px; |
| outline-white | outline: 2px dotted white; outline-offset: 2px;      |
| outline-black | outline: 2px dotted black; outline-offset: 2px;      |

## Remove outlines

Use `outline-none` to hide the default browser outline on focused elements.

It is highly recommended to apply your own focus styling for accessibility when using this utility.

```html
<input type="text"
  placeholder="Default focus style"
  class="..." />

<input type="text"
  placeholder="Custom focus style"
  class="focus:outline-none focus:ring focus:border-blue-300 ..." />
```

The `outline-none` utility is implemented using a transparent outline under the hood to ensure elements are still visibly focused to [Windows high contrast mode](https://blogs.windows.com/msedgedev/2020/09/17/styling-for-windows-high-contrast-with-new-standards-for-forced-colors/) users.

## Dotted outlines

Use the `outline-white` and `outline-black` utilities to add a 2px dotted border around an element with a 2px offset. These are useful as an accessible general purpose custom focus style if you don’t want to design your own.

Button A

Button B

```html
<button class="focus:outline-black ...">Button A</button>
<button class="focus:outline-white ...">Button B</button>
```

## Customizing

### Outlines

By default, Tailwind provides three outline utilities. You can customize these by editing the `theme.outline` section of your `tailwind.config.js` file.

```js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        outline: {
          blue: '2px solid #0000ff',
        }
      }
    }
  }
```

You can also provide an `outline-offset` value for any custom outline utilities using a tuple of the form `[outline, outlineOffset]`:

```js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        outline: {
          blue: ['2px solid #0000ff', '1px'],
        }
      }
    }
  }
```

### Variants

By default, only responsive, focus-within and focus variants are generated for outline utilities.

You can control which variants are generated for the outline utilities by modifying the `outline` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       outline: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the outline utilities in your project, you can disable them entirely by setting the `outline` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     outline: false,
    }
  }
```

[←Cursor](https://tailwindcss.com/docs/cursor)[Pointer Events
  ](https://tailwindcss.com/docs/pointer-events)



---



# Pointer Events

Utilities for controlling whether an element responds to pointer events.

## Default class reference

| Class               | Properties            |
| ------------------- | --------------------- |
| pointer-events-none | pointer-events: none; |
| pointer-events-auto | pointer-events: auto; |

## Usage

Use `pointer-events-auto` to revert to the default browser behavior for pointer events (like `:hover` and `click`).

Use `pointer-events-none` to make an element ignore pointer events. The pointer events will still trigger on child elements and pass-through to elements that are “beneath” the target.

Try clicking the caret icon to open the dropdown

pointer-events-auto (event captured)



pointer-events-none (event passes through)



```html
<div class="relative">
  <select class="...">
    <option>Indiana</option>
    <option>Michigan</option>
    <option>Ohio</option>
  </select>
  <div class="pointer-events-auto ...">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
  </div>
</div>

<div class="relative">
  <select class="...">
    <option>Indiana</option>
    <option>Michigan</option>
    <option>Ohio</option>
  </select>
  <div class="pointer-events-none ...">
    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path></svg>
  </div>
</div>
```

## Customizing

### Variants

By default, only responsive variants are generated for pointer event utilities.

You can control which variants are generated for the pointer event utilities by modifying the `pointerEvents` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       pointerEvents: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the pointer event utilities in your project, you can disable them entirely by setting the `pointerEvents` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     pointerEvents: false,
    }
  }
```

[←Outline](https://tailwindcss.com/docs/outline)[Resize
  ](https://tailwindcss.com/docs/resize)



---



# Resize

Utilities for controlling how an element can be resized.

## Default class reference

| Class       | Properties          |
| ----------- | ------------------- |
| resize-none | resize: none;       |
| resize-y    | resize: vertical;   |
| resize-x    | resize: horizontal; |
| resize      | resize: both;       |

## Resize in all directions

Use `resize` to make an element horizontally and vertically resizable.

```html
<textarea class="resize border rounded-md"></textarea>
```

## Resize vertically

Use `resize-y` to make an element vertically resizable.

```html
<textarea class="resize-y border rounded-md"></textarea>
```

## Resize horizontally

Use `resize-x` to make an element horizontally resizable.

```html
<textarea class="resize-x border rounded-md"></textarea>
```

## Prevent resizing

Use `resize-none` to prevent an element from being resizable.

```html
<textarea class="resize-none border rounded-md"></textarea>
```

## Customizing

### Variants

By default, only responsive variants are generated for resizing utilities.

You can control which variants are generated for the resizing utilities by modifying the `resize` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       resize: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the resizing utilities in your project, you can disable them entirely by setting the `resize` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     resize: false,
    }
  }
```

[←Pointer Events](https://tailwindcss.com/docs/pointer-events)[User Select
  ](https://tailwindcss.com/docs/user-select)



---



# User Select

Utilities for controlling whether the user can select text in an element.

## Default class reference

| Class       | Properties         |
| ----------- | ------------------ |
| select-none | user-select: none; |
| select-text | user-select: text; |
| select-all  | user-select: all;  |
| select-auto | user-select: auto; |

## Disable selecting text

Use `select-none` to prevent selecting text in an element and its children.

This text is not selectable

```html
<div class="select-none ...">
  This text is not selectable
</div>
```

## Allow selecting text

Use `select-text` to allow selecting text in an element and its children.

This text is selectable

```html
<div class="select-text ...">
  This text is selectable
</div>
```

## Select all text in one click

Use `select-all` to automatically select all the text in an element when a user clicks.

Click anywhere in this text to select it all

```html
<div class="select-all ...">
  Click anywhere in this text to select it all
</div>
```

## Auto

Use `select-auto` to use the default browser behavior for selecting text. Useful for undoing other classes like `.select-none` at different breakpoints.

This text is selectable

```html
<div class="select-auto ...">
  This text is selectable
</div>
```

## Customizing

### Variants

By default, only responsive variants are generated for user-select utilities.

You can control which variants are generated for the user-select utilities by modifying the `userSelect` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       userSelect: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the user-select utilities in your project, you can disable them entirely by setting the `userSelect` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     userSelect: false,
    }
  }
```

[←Resize](https://tailwindcss.com/docs/resize)[Fill
  ](https://tailwindcss.com/docs/fill)



---





