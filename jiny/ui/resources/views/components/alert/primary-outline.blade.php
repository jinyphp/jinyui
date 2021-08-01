<x-jinyui::alert.default class="alert-primary alert-outline-coloured ">
    @if (isset($icon))
        <div class="alert-icon">
            {{$icon}}
        </div>
    @endif

    <div class="alert-message">
        {{$slot}}
    </div>
</x-jinyui::alert.default>