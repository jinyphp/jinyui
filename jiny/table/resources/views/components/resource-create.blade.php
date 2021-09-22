<x-link 
    href="{{ route(currentRouteName().'.create', [1]) }}" 
    class="btn btn-primary">
    {{$slot}}
</x-link>