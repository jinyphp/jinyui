<li {{ $attributes->merge(['class' => 'sidebar-item submenu ']) }} x-data="{ open: false }">
    <div @click="open = ! open">
        <a class="sidebar-link submenu" :class="{collapsed : open===false}" >
        @if (isset($title))        
            {{$title}}
        @endif
        </a> 

    </div>
    <ul class="sidebar-dropdown list-unstyled"  x-show="open">
        {{$slot}}
    </ul>   
</li>

