<li {{ $attributes->merge(['class' => 'sidebar-item submenu ']) }} x-data="{ open: false }">
    <div @click="open = ! open">
        <span class="align-middle">
            @if (isset($title))
                {{$title}}
            @endif            
        </span>
    </div>
    <ul x-show="open">
        {{$slot}}
    </ul>   
</li>

