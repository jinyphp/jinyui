# select

## PHP 코드로 작성하기

```php
{!! xSelect()
    ->setWidth("standard")
    ->addOption("Red",'red') !!}
```

배열을 이용하여 여러개의 값을 동시에 선언하기

```php
{!! xSelect()->setWidth("standard")
    ->addOptions([
        [
            'title'=>"Red",
            'value'=>'red'
        ],
        [
            'title'=>"Blue",
            'value'=>'blue'
        ]
    ]) !!}
```

## DB 테이블 컬럼을 이용하여 설정하기

```php
{!! xSelect()->setWidth("standard")
    ->addTable("admin_roles", 'title')
    ->setSelected('사용자') !!}
```