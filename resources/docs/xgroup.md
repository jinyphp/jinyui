---
theme: "adminkit"
layout: "markdown"
title: "xGroup"
breadcrumb:
    - "Docs"
---

# xGroup()
`xGroup()`헬퍼함수는 여러개의 아이템을 묽어 출력하는 테그를 생성합니다.

## 사용방법
다음과 같이 xlink를 여러개의 요소들을 하나로 묽어 출력합니다. `xLinks()`는 xLink를 배로로 묽은 값이 반환됩니다. 

```php
{!! xGroup()
    ->setItems(
        xLinks([
            ['item'=>"password", 'url'=>"password"],
            ['item'=>"Privacy and safety", 'url'=>"#2"],
            ['item'=>"Email notifications", 'url'=>"#3"]                            
        ])
    )
!!}
```

xGroup은 기본적으로 `div`테그로 감싸져 있습니다.
만일 다른 테그를 사용하고 자 하는 경우 `->setTagName()`을 사용합니다.

```php
->setTagName('ul');
```

## 버튼 그룹
그룹의 아이템을 버튼 형태로 묽어 처리합니다.

### setButton()
xGroup을 버튼형태로 묽어 처리합니다. 부트스트랩의 `btn-group` 클래스 속성이 주어지게 됩니다.

```php
->setButton()
```

적용예제
```php
{!! xGroup()
    ->setButton()
    ->addItem( xButton("Left")->setColor('primary') )
    ->addItem( xButton("Middle")->setColor('primary') )
    ->addItem( xButton("Right")->setColor('primary') )
    ->setAriaLabel("Basic example")
!!}
```

그룹의 버튼배치를 세로로 하고자 하는 경우에는 인자값으로 `vertical`을 지정합니다.
```php
->setButton('vertical')
```

적용예제
```php
{!! xGroup()
    ->setButton()->setButtonSize('large')
    ->addItem( xButton("Left")->setColor('secondary') )
    ->addItem( xButton("Middle")->setColor('secondary') )
    ->addItem( xButton("Right")->setColor('secondary') )
    ->setAriaLabel("Large button group")
!!}
```

버튼 그룹이 출력되기 위해서는 등록된 아이템이 버튼모양의 클래스를 탑제하고 있어야 합니다.

#### 시만텍테그
xGroup의 버튼을 시만텍 테그를 이용하여 사용가능합니다.

```php
<x-button-group>
내용...
</x-button-group>
```

### 버튼 그룹 사이즈
버튼 그룹의 사이즈를 변경합니다. 
large | small 값을 사용합니다.
```php
setButtonSize($size);
```

## 객체변환
xGroup의 설정값 또는 아이템을 그대로 유지한체로 다른 객체 형태로 변환하여 처리를 계속 이어갈 수 있습니다.


### List()
`list()` 메소드는 xGroup 객체의 상태를 유지한체로 List객체로 변환할 수 있습니다. 
이후 사용가능한 객체는 xList객체의 메소드만 가능하게 됩니다.

그룹으로 묽인 요소들을 ul 또는 div 테그로 감싸서 List 형태로 출력합니다.

```php
{!! xGroup()
    ->setItems(
        xLinks([
            ['item'=>"password", 'url'=>"password"],
            ['item'=>"Privacy and safety", 'url'=>"#2"],
            ['item'=>"Email notifications", 'url'=>"#3"]                            
        ])
    )
    ->list()
    ->setActive(2) !!}
```

xGroup의 list 메소드를 출력하면, List로 변환된 객체가 반환 됩니다.


### tab모드 활성화
반환된 리스트를 텝모드로 활성화 할때는 `tabEnable()`를 사용합니다.

```php
{!! xGroup()
    ->setItems(
        xLinks([
            ['item'=>"password", 'url'=>"#password"],
            ['item'=>"Privacy and safety", 'url'=>"#2"],
            ['item'=>"Email notifications", 'url'=>"#3"]                            
        ])
    )
    ->list()
    ->setActive(2)
    ->tabEnable() !!}
```