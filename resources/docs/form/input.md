# xInput
지니UI는 form input 요소들을 생성하여 문서에 삽입할 수 있는 코드를 제공합니다.

`xInput()` 함수는 form input 테그를 생성합니다. xInput은 3개의 인자를 전달 받습니다.
타입, 이름, 값 입니다. 그외의 속성 설정은 메서드체인으로 연결하여 설정할 수 있습니다.

```php
{!! xInput('text','name')->setWidth("small") !!}
```

## 가로폭 설정
setWidth 체인은 폼입력 요소의 가로폭을 설정합니다.

* TINY = 75px
* SMALL = 150px
* MEDIUM = 270px
* STANDARD = 453px
* BIG = 540;
* full = 100%
* half = 50%
* quater = 25%


## 크기 설정
setSize 체인은 폼입력의 크기를 설정합니다.

* lg : form-control-lg 클래스를 추가합니다.
* sm : form-control-sm 클래스를 추가합니다.


## 단축함수

xInputText()
xInputEmail()
xInputPassword()



