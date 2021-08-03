{{--
<div class="modal fade" {{$attributes}} tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {{$slot}}
        </div>
    </div>
</div>
--}}
{!! BootModal()->build($slot, $attributes) !!}