<x-jinyui::alert.default class="alert-secondary alert-outline">
    @if (isset($icon))
        <div class="alert-icon">
            {{$icon}}
        </div>
    @endif

    <div class="alert-message">
        {{$slot}}
    </div>
</x-jinyui::alert.default>