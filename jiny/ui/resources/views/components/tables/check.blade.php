{{--
<div class="form-check">
    <input type="checkbox" class="form-check-input rowCheckbox" id="ids_{{$i}}" name="ids" 
        wire:model="selected" click="selectCheckbox($event, {{$i}})"
        value="{{$i}}">
    <label class="form-check-label" for="ids_{{$i}}">&nbsp;</label>
</div>
--}}

{!! \Jiny\UI\Table::instance()->rowCheck($i) !!}
