---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Collapse
`collapse`는 특정 아이템 클릭시 숨겨져 있는 내용을 확장하는 ui기술입니다.
지니ui는 `<x-jiny-collapse>` 컴포넌트 테그를 이용하여 쉽게 구현을 할 수 있습니다.

## 사용방법
라라벨 블레이브 문서에서 다음과 같이 코드를 작성합니다.

```php
<x-jiny-collapse>
    <x-slot name="title">
        클릭하세요.
    </x-slot>

    컨덴츠 내용
</x-jiny-collapse>
```

collapse의 내부 요소는 크게 2개로 구분됩니다. 먼저 클릭이 되는 요소와 보여지는 요소 입니다.
클릭이 되어야 하는 요소는 x-slot 기능을 통하여 title 이라는 값으로 전달 합니다.
즉, `클릭하세요` 라는 부분에 html 요소를 생성하여 삽입하면 됩니다.

실제 출력되는 내용은 `<x-jiny-collapse>` 테그 안에 내용을 넣어 주시면 됩니다.

만일, title 내용이 간단할 경우 다음과 같이 축약하여 코드를 작성할 수 있습니다.
```php
<x-jiny-collapse title="클릭하세요.">
    컨덴츠 내용
</x-jiny-collapse>
```

> 컴포넌트 활용에 대한 보다 자세한 방법은 라라벨 공식 문서를 참조하세요.


## 주의
만일 collapse의 타이틀을 지정하지 않으면 컨덴츠의 내용만 출력됩니다.
