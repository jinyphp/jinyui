---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# form

## 폼 레이아웃
지니ui는 폼의 항목의 레이아웃 배치를 쉽게 처리하기 위해서 2개의 테그를 제공합니다.
* x-jinyui-form-row
* x-jinyui-form-hor

폼 레이아웃을 사용하면 지정한 항목들을 유연하게 배치를 할 수 있다는 장점이 있습니다.

### form-row
`x-jinyui-form-row`은 폼요소의 항목들을 한줄단위로 배치를 합니다.

```php
<x-jinyui-form-row>
    <x-jinyui-form-label>
        Email address
    </x-jinyui-form-label>
    <x-jinyui-form-item>
        <input type="email" class="form-control" placeholder="Email">
    </x-jinyui-form-item>
</x-jinyui-form-row>
```



