{{--
<div {{ $attributes }}>
    @livewire('menu-tree',['menu'=>$jsondata, 'content'=>$slot->toHtml(), 'filename'=>$filename]) 
    {{$slot}}
</div>
--}}

{!! $builder() !!}
