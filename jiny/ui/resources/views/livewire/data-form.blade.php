<div>
    <form>
    <div>
        <div class="flex flex-row justify-between items-center px-4 py-2 border-b">
            <div class="text-lg">
                {{ $table }} 등록
            </div>
            <div>
                <button wire:click="$emit('dialogClose')">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    
        
        <x-tree-explore>

        </x-tree-explore>


        <x-jiny-collapse>
            <x-slot name="title">
                클릭하세요.
            </x-slot>
            컨덴츠 내용
        </x-jiny-collapse>


        <x-jiny-scroll-bar scrollwidth="5" class=" bg-white h-48">
            스크롤 내용
            
        </x-jiny-scroll-bar>




        {{-- 폼요소 출력--}}
        <div class="bg-white p-4">
            <table>
                <tbody>
                    @foreach ($conf as $key => $item)
                    <tr>
                        <td>
                            <x-forms.label>
                                {{$item['_title']}}
                            </x-forms.label>
                        </td>
                        <td>
                            <x-forms.text wire:model="data.{{$item['_code']}}"></x-forms.text>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



        

    
            <div class="px-4 py-2 bg-gray-100 text-right">
                @if ($mode == "new")
                    <x-button-outline wire:click="$emit('dialogClose')" wire:loading.attr="disabled">
                        {{ __('취소') }}
                    </x-jet-secondary-button>

                @else
                    <x-button-outline wire:click="delete" wire:loading.attr="disabled">
                        {{ __('삭제') }}
                    </x-jet-secondary-button>
                @endif

                @if ($_id)
                    <x-button class="ml-2 btn-blue" wire:click="update" wire:loading.attr="disabled">
                        {{ __('수정') }}
                    </x-jet-danger-button>
                    
                @else
                    <x-button class="ml-2 btn-blue" wire:click="insert" wire:loading.attr="disabled">
                        {{ __('등록') }}
                    </x-jet-danger-button>
                @endif
            </div>
        
    </div>
    </form>
</div>

