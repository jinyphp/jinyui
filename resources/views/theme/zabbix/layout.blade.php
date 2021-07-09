{{-- zabbix style layout --}}
<div class="flex flex-row" style="height:inherit">
    <x-jiny-sidebar>
        @include2('.sidebar')
    </x-jiny-sidebar>
    <div class="flex-grow">
        {{$slot}}
    </div>
</div>