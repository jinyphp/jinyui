<div {{ $attributes }}>
    @livewire('menu-tree',['menu'=>$jsondata, 'content'=>$slot->toHtml()]) 
</div>
