---
theme: "adminkit"
layout: "markdown"
title: "xLink"
breadcrumb:
    - "Docs"
---

# XLink
XLink는 Html의 `a`테그를 생성하는 함수 입니다.

```php
xLink($item, $url);
```

url 경로를 가지는 item의 링크 객체를 반환합니다.

## 여러개의 링크

여러개의 링크를 생성할때에는 `xLinks()` 함수를 사용할 수 있습니다.
이때에는 인자값이 배열로 작성됩니다.

```php
{!! xLinks([
    ['item'=>"password", 'url'=>"#1"],
    ['item'=>"Privacy and safety", 'url'=>"#2"],
    ['item'=>"Email notifications", 'url'=>"#3"]                            
]) !!}
```

### links 단체속성 지정
객체를 반환하는 `xLink`와는 달리 XLinks는 xLink를 담고 있는 배열을 가지고 있습니다.
각각의 배열에 담겨있는 xLink에 단체 속성을 부여할 수 있습니다.

```php
{!! xLinks([
    ['item'=>"password", 'url'=>"#1"],
    ['item'=>"Privacy and safety", 'url'=>"#2"],
    ['item'=>"Email notifications", 'url'=>"#3"]                            
])->addClass("list-group-item") !!}
```

## 리스트 적용하기
links를 리스트 그룹으로 묽을 수 있습니다.

```php
{!! xGroup()
    ->setItems(
        xLinks([
            ['item'=>"password", 'url'=>"#1"],
            ['item'=>"Privacy and safety", 'url'=>"#2"],
            ['item'=>"Email notifications", 'url'=>"#3"]                            
        ])
    )
    ->setTypeList()
    ->setActive(2) !!}
```
이때 `xGroup()` 함수를 같이 사용합니다.


## 속성 변경하기

### 버튼
텍스트 타입의 링크를 버튼형태로 변경을 할 수 있습니다.
이 메소드는 부트스트랩 CSS를 클래스를 자동으로 추가해 줍니다.

```php
->setButton($color, $outline=null)
```

적용사례
```php
<div class="btn-group">
    {!! xLink("Active link", '#')->setButton('primary')
        ->setActive()->setAriaCurrent("page") !!}
    {!! xLink("link", '#')->setButton('primary') !!}
    {!! xLink("link", '#')->setButton('primary') !!}
</div>
```



### setActive()
active 클래스를 추가합니다.



