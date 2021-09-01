<input type="radio" id="tabview-{{$name}}" name="mytabs"
    @if (isset($selected))
        checked="checked"
    @endif
>
<label for="tabview-{{$name}}">{{$name}}</label>

<div class="tab">
    {{$slot}}
</div>
