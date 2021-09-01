<div {{ $attributes->merge(['class' => 'absolute ']) }} @click="show =!show">
    {{$slot}}
</div>