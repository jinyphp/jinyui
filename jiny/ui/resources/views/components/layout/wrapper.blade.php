
<div {{ $attributes->merge(['class' => 'wrapper layout']) }} style="height:inherit">
    {{$slot}}
</div>


{{--
    \Jiny\UI\Document::instance()->dom
    ->addClass("wrapper")
    ->addClass("layout")
    ->addStyle("height:inherit")
    ->addItem($slot)
--}}