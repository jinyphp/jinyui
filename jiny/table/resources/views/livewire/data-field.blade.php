<div>
    <x-button primary small wire:click="displayField">컬럼수정</x-button>

    {{-- 모달창 --}}
    <x-jinyui-modal-list maxWidth="5xl" zindex="10" wire:model="modalFieldVisible">

        <x-slot name="title">
            <svg class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
            </svg>
            필드설정
        </x-slot>
        <x-slot name="close">
            <button wire:click="$toggle('modalFieldVisible')">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </x-slot>

        <x-slot name="content">

            <table class="datatable table">
                <thead>
                    <tr>
                        <th>번호</th>
                        <th>활성화</th>
                        <th>타이틀</th>
                        <th>컬럼명</th>
                        <th>정렬</th>
                        <th>편집</th>
                        <th>조건필터</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody drag-root="reorder" >
                    @if (is_array($conf))
                        @foreach ($conf as $key => $arr)
                        <tr drag-item="{{$arr['pos']}}" draggable="true" wire:key="{{$arr['pos']}}">
                            <td >{{$key+1}}</td>
                            <td>
                                @if ($arr['list'])
                                    <input type="checkbox" wire:model="conf.{{$key}}.list" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}.list" value="false">
                                @endif
                                
                            </td>
                            <td>
                                {{-- 컬럼 타이틀--}}
                                <input type="text" wire:model="conf.{{$key}}.title" class="px-2 py-1 text-xs">                                
                            </td>
                            <td>
                                <input type="text" wire:model="conf.{{$key}}._code"
                                class="px-2 py-1 text-xs">
                            </td>
                            {{--
                            <td>
                                @if ($arr['sort'])
                                    <input type="checkbox" wire:model="conf.{{$key}}.sort" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}.sort" value="false">
                                @endif
                                
                            </td>
                            --}}
                            {{--
                            <td>
                                @if ($arr['edit'])
                                    <input type="checkbox" wire:model="conf.{{$key}}.edit" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}.edit" value="false">
                                @endif
                                
                            </td>
                            --}}
                            {{--
                            <td>
                                @if ($arr['filter'])
                                    <input type="checkbox" wire:model="conf.{{$key}}.filter" value="true" checked>
                                @else
                                    <input type="checkbox" wire:model="conf.{{$key}}.filter" value="false">
                                @endif
                                
                            </td>
                            --}}
                            <td>
                                <button class="text-red-700 px-2"
                                    wire:click.prevent="removeField({{$key}})">
                                    <svg class="h-6 w-6 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>                                
                            </td>
                        </tr>    
                        @endforeach
                    @endif
                    
                </tbody>
            </table>


            
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-row justify-between">
                <x-button class="ml-2 btn-blue" wire:click="newField" wire:loading.attr="disabled">
                    <svg class="h-4 w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    {{ __('필드추가') }}
                </x-jet-danger-button>

                <x-button class="ml-2 btn-blue" wire:click="save" wire:loading.attr="disabled">
                    {{ __('적용') }}
                </x-jet-danger-button>
            </div>           
        </x-slot>
        
    </x-jinyui-modal-list>

</div>

<script>
        
    let root = document.querySelector('[drag-root]');
    let prevY;
    root.querySelectorAll('[drag-item]').forEach(el => {
        // console.log(el)
        el.addEventListener('dragstart', e => {
            //console.log('start');
            e.target.classList.add('bg-blue-100');
            e.target.setAttribute('dragging', true); // 드래그 플레그 설정
            prevY = e.pageY;
            //console.log("START=" + prevY);
        });

        el.addEventListener('drop', e => {
            //console.log('drop');
            
            let draggingEl = root.querySelector('[dragging]');
            draggingEl.classList.remove('bg-blue-100');
            //console.log(draggingEl )
            
            console.log("DRAG=" + e.pageY);
            if (prevY < e.pageY) {
                //console.log("아래방향 이동");
                e.target.parentElement.after(draggingEl);

            } else {
                //console.log("위방향 이동");
                e.target.parentElement.before(draggingEl);
            }

            // 선택 노랑색 제거
            e.target.parentElement.classList.remove('bg-yellow-100');
            
            // 라이브와이어 갱신
       
            let component = Livewire.find(
                e.target.closest('[wire\\:id]').getAttribute('wire:id')
            );
            let orderIds = Array.from(root.querySelectorAll('[drag-item]'))
                .map(itemEl => 
                    itemEl.getAttribute('drag-item')
                );
            //console.log(orderIds);
            let method = root.getAttribute('drag-root');
            component.call(method,orderIds);
          

            
        });

        el.addEventListener('dragover', e => {
            e.preventDefault(); // drop 기능과 방해
        });

        el.addEventListener('dragenter', e => {
            e.target.parentElement.classList.add('bg-yellow-100');
            //console.log("enter = " + e.target);
            e.preventDefault(); // drop 기능과 방해
        });

        el.addEventListener('dragleave', e => {
            e.target.parentElement.classList.remove('bg-yellow-100');
            //console.log("leave = " + e.target);
        });

        el.addEventListener('dragend', e => {
            e.target.removeAttribute('dragging'); // 드래그 플레그 삭제
        });

    })
</script>

