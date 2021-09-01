---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# card box
카드 박스는 컨덴츠의 내용을 묽어 화면에 출력할 수 있는 UI스킨입니다.

## x-jinyui-card 테크
`x-jinyui-card`테그는 부트스트랩의 card 박스를 출력합니다.

```php
<x-jinyui-card>
내용...
</x-jinyui-card>
```

카드박스의 내부는 크게 상단,본문, 하단으로 나누어져 있습니다.
이와 관련된 테그를 이용하여 내용을 구분출력 할 수 있습니다.

## header 

```php
<x-jinyui::card.header>
    <h5 class='card-title mb-0'>Card with links</h5>
</x-jinyui::card.header>
```
상단영역의 내용을 작성합니다.
이렇게 작성된 내용은 card에 바로 반영이 되지 않고, 임시 저장영역에 기록됩니다.
최종적으로 x-jinyui-card 테그가 실행이 완료될때 임시 영역에서 읽어서 내용이 처리됩니다.

## body

```php
<x-jinyui::card.body>
    내용...
</x-jinyui::card.body>
```

## list
본분의 내용을 리스트 형태로 출력할 수 있습니다.

```php
<x-jinyui::card.list>
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </x-jinyui::card.list>
```

## footer

```php
<x-jinyui::card.footer>

</x-jinyui::card.footer>
```