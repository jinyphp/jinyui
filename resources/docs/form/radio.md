# radio 출력
지니UI는 라디오버튼을 출력하기 위한 xRadio() 헬퍼를 제공합니다.

```php
!! xRadio(이름, 값) !!}
```

## 라디오 라벨

```php
<label class="form-check form-check-inline">
    {!! xRadio("sex", "man") !!}
    
    <span class="form-check-label">
        1
    </span>
 </label>
```

## 라디오 그룹
xRadioGroup() 헬퍼함수를 제공합니다.

```php
{!! xRadioGroup()
    ->addRadio(
        xRadio("radios-example", "option1"), 
        "Option one is this and that—be sure to include why it's great")   
    ->addRadio(
        xRadio("radios-example", "option2")->setChecked(), 
        "Option two can be something else and selecting it will deselect option one")
    ->addRadio(
        xRadio("radios-example", "option3")->setDisable(), 
        "Option three is disabled")
!!}
```

## 가로 배치 출력

```php
{!! xRadioGroup("inline")
    ->addRadio(
        xRadio("customRadio1", "option1"), 
        "Toggle this custom radio")   
    ->addRadio(
        xRadio("customRadio1", "option2")->setChecked(), 
        "Or toggle this other custom radio")                               
!!}
```

## 색상적용
라디오 선택시 색상을 설정할 수 있습니다.
색상은 라디오 선택의 라벨에 지정을 하기 때문에 xRadioLabel() 헬퍼를 사용합니다.

```php
 {!! xRadioLabel(xRadio("customRadiocolor2", "option1")->setChecked(), "Success Radio")
    ->addClass("form-radio-success")
    ->addClass("mb-2") !!}
```