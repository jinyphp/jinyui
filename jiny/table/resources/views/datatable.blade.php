<x-app>
   
    <div class="text-xl bg-white px-4 py-2">
        {{$title}}
    </div>
    <div class="p-2">

        @livewire('data-list',[
            'title' => $title,
            'table' => $table,
            'forms'=>$forms,
            'filter_forms' => $filter_forms
        ])

    </div>


    <div>
        @livewire('data-field')
    </div>

    
</x-app>
