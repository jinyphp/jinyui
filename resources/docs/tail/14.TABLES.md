---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# Border Collapse

Utilities for controlling whether table borders should collapse or be separated.

## Default class reference

| Class           | Properties                 |
| --------------- | -------------------------- |
| border-collapse | border-collapse: collapse; |
| border-separate | border-collapse: separate; |

## Separate

Use `border-separate` to force each cell to display its own separate borders.

| State    | City         |
| :------- | :----------- |
| Indiana  | Indianapolis |
| Ohio     | Columbus     |
| Michigan | Detroit      |

```html
<table class="border-separate border border-green-800 ...">
  <thead>
    <tr>
      <th class="border border-green-600 ...">State</th>
      <th class="border border-green-600 ...">City</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="border border-green-600 ...">Indiana</td>
      <td class="border border-green-600 ...">Indianapolis</td>
    </tr>
    <tr>
      <td class="border border-green-600 ...">Ohio</td>
      <td class="border border-green-600 ...">Columbus</td>
    </tr>
    <tr>
      <td class="border border-green-600 ...">Michigan</td>
      <td class="border border-green-600 ...">Detroit</td>
    </tr>
  </tbody>
</table>
```

## Collapse

Use `border-collapse` to combine adjacent cell borders into a single border when possible. Note that this includes collapsing borders on the top-level `<table>` tag.

| State    | City         |
| :------- | :----------- |
| Indiana  | Indianapolis |
| Ohio     | Columbus     |
| Michigan | Detroit      |

```html
<table class="border-collapse border border-green-800 ...">
  <thead>
    <tr>
      <th class="border border-green-600 ...">State</th>
      <th class="border border-green-600 ...">City</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="border border-green-600 ...">Indiana</td>
      <td class="border border-green-600 ...">Indianapolis</td>
    </tr>
    <tr>
      <td class="border border-green-600 ...">Ohio</td>
      <td class="border border-green-600 ...">Columbus</td>
    </tr>
    <tr>
      <td class="border border-green-600 ...">Michigan</td>
      <td class="border border-green-600 ...">Detroit</td>
    </tr>
  </tbody>
</table>
```

## Customizing

### Variants

By default, only responsive variants are generated for border collapse utilities.

You can control which variants are generated for the border collapse utilities by modifying the `borderCollapse` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       borderCollapse: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the border collapse utilities in your project, you can disable them entirely by setting the `borderCollapse` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     borderCollapse: false,
    }
  }
```





---



# Table Layout

Utilities for controlling the table layout algorithm.

## Default class reference

| Class       | Properties           |
| ----------- | -------------------- |
| table-auto  | table-layout: auto;  |
| table-fixed | table-layout: fixed; |

## Auto

Use `table-auto` to allow the table to automatically size columns to fit the contents of the cell.

| Title                                                        | Author | Views |
| ------------------------------------------------------------ | ------ | ----- |
| Intro to CSS                                                 | Adam   | 858   |
| A Long and Winding Tour of the History of UI Frameworks and Tools and the Impact on Design | Adam   | 112   |
| Intro to JavaScript                                          | Chris  | 1,280 |

```html
<table class="table-auto">
  <thead>
    <tr>
      <th>Title</th>
      <th>Author</th>
      <th>Views</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Intro to CSS</td>
      <td>Adam</td>
      <td>858</td>
    </tr>
    <tr class="bg-emerald-200">
      <td>A Long and Winding Tour of the History of UI Frameworks and Tools and the Impact on Design</td>
      <td>Adam</td>
      <td>112</td>
    </tr>
    <tr>
      <td>Intro to JavaScript</td>
      <td>Chris</td>
      <td>1,280</td>
    </tr>
  </tbody>
</table>
```

## Fixed

Use `table-fixed` to allow the table to ignore the content and use fixed widths for columns. The width of the first row will set the column widths for the whole table.

You can manually set the widths for some columns and the rest of the available width will be divided evenly amongst the columns without explicit width.

| Title                                                        | Author | Views |
| ------------------------------------------------------------ | ------ | ----- |
| Intro to CSS                                                 | Adam   | 858   |
| A Long and Winding Tour of the History of UI Frameworks and Tools and the Impact on Design | Adam   | 112   |
| Intro to JavaScript                                          | Chris  | 1,280 |

```html
<table class="table-fixed">
  <thead>
    <tr>
      <th class="w-1/2 ...">Title</th>
      <th class="w-1/4 ...">Author</th>
      <th class="w-1/4 ...">Views</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Intro to CSS</td>
      <td>Adam</td>
      <td>858</td>
    </tr>
    <tr class="bg-blue-200">
      <td>A Long and Winding Tour of the History of UI Frameworks and Tools and the Impact on Design</td>
      <td>Adam</td>
      <td>112</td>
    </tr>
    <tr>
      <td>Intro to JavaScript</td>
      <td>Chris</td>
      <td>1,280</td>
    </tr>
  </tbody>
</table>
```

## Customizing

### Variants

By default, only responsive variants are generated for table layout utilities.

You can control which variants are generated for the table layout utilities by modifying the `tableLayout` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       tableLayout: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the table layout utilities in your project, you can disable them entirely by setting the `tableLayout` property to `false` in the `corePlugins` section of your config file:

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     tableLayout: false,
    }
  }
```



