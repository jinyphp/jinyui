# table 생성
지니UI는 데이터 기반으로 자동으로 테이블을 생성할 수 있는 `<x-table>`을 지원합니다.

## 테이블 해더

```php
<x-table-head class="table-light">
    <tr>
        <th style="width: 20px;">
            <x-table-check-all></x-table-check-all>
        </th>
        <th>테이블명</th>                                        
    </tr>
</x-table-head>
```

```php
<x-table-head class="table-light">
    <x-slot name="json">
        [{"title":"테이블명"}]
    </x-slot>
</x-table-head>
```

## body 생성
`<x-table-body>`는 테이블의 `<tbody>`테그와 데이터를 생성관리 합니다.
`<x-table-body>`의 본문은 블래이드 템플릿을 결합하여 작성이 가능합니다.

```php
<x-table-body>
    @foreach ($rows as $i => $row)
        <tr>
            <td style="width: 20px;">
                <x-table-check :i="$i"></x-table-check>
            </td>

            @foreach ($row as $item)
                <td>{{$item}}</td>
            @endforeach
        </tr>
    @endforeach
</x-table-body>
```

각각의 row를 선택할 수 있는 체크 박스도 삽입할 수 있습니다.
`<x-table-check>` 테그는 항목을 선택할 수 있는 체크박스를 생성합니다.

다른 방법으로는 PHP 코드에서 완성된 객체DOM을 생성 받는 방법입니다.

```php
{!! \Jiny\UI\Table::instance()->check()->dataBody($rows) !!}
```
이러면 템플릿 엔진에서 복잡한 블레이드 문법 로직을 작성할 필요가 없습니다. 
또한 블레이드 foreach 동작보다 더 빠르게 PHP 프레임워크 레벨 안에서 코드가 생성이 됩니다.

```php
<x-table-body :rows="$rows">
</x-table-body>
```

```php
<x-table-body>
    <x-slot name="json">
    json데이터
    </x-slot>
</x-table-body>
```