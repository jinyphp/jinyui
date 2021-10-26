# flex 박스

`지니ui`는 보다 쉽게 flex 레이아웃을 구성할 수  있는 컴포넌트 테그를 제공합니다.



## x-flex-row

가로 배치형의 flex 박스를 생성합니다.

* x-flex-row
* x-flex-col
* x-flex-between
* x-flex-end



### x-flow-item

플랙스 박스에 아이템을 추가 합니다. 기본 속성값으로 `flex-grow`가 되어 있습니다.





## x-box

`x-box`는 사각형의 박스를 출력합니다.

```html
<div {{$attributes->merge(['class' => 'p-2'])}}>
    {{$slot}}
</div>
```



## x-block









## x-divide

분환된 요소를 생성합니다.



## x-divide-item



```php
<x-box>
    <x-divide class="divide-gray-300">
        <x-divide-item>
            aaa

        </x-divide-item>
        <x-divide-item>
            bbb

        </x-divide-item>
    </x-divide>
</x-box>
```









# Button

* x-button
* x-button-outlone
* x-button-square



