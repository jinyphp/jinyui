{{-- 데이터 테이블 --}}
<div x-data="datatables()">
    
    {{-- 테이블--}}
    <table {{ $attributes->merge(['class' => 'datatable']) }}>
        {{-- 해더타이틀 --}}
        <thead>
            <tr>
                <th class="check">
                    <input type="checkbox" id="all_checks" name="all_checks" value="1"
                                class="checkbox-radio" 
                                @click="selectAllCheckbox($event);">
                    <label for="all_checks">
                        <span></span>
                    </label>
                </th>
                @if (isset($title))            
                    @foreach ($title as $item)
                        <th class="">
                            {{$item}}
                        </th>        
                    @endforeach
                @endif
            </tr>
        </thead>
    
        {{-- 데이터 목록 --}}
        <tbody>
            @if ($rows->count())
                @foreach ($rows as $item)
                    <tr>
                        <td class="check">
                            <input type="checkbox" id="ids_{{$item->id}}" name="ids" 
                                {{--wire:model="selected"--}} 
                                value="{{$item->id}}"
                                    class="checkbox-radio rowCheckbox"
                                    @click="selectCheckbox($event, {{$item->id}})">
                            <label for="ids_{{$item->id}}">
                                <span></span>
                            </label>
                        </td>
    
                        <td class="">{{$item->code}}</td>
                        <td class=""><a wire:click="edit({{$item->id}})">{{$item->title}}</a></td>
                        <td class="">{{$item->target}}</td>
                        <td class="">{{$item->uri}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="{{ count($title) + 1 }}">no data</td>
                </tr>
            @endif 
        </tbody>
    
    </table>

    {{-- 페이지네이션 --}}
    <div class="bg-white px-2 py-3">
        <div >
            {{ $rows->links('components.pagination') }}
        </div>

        <x-flex-row class="justify-between">
            <div>
                @if (isset($delButton))
                    <div class="mr-3">
                        {{$delButton}}
                    </div>
                @endif
            </div>

            <div>    
                @if (isset($addButton))
                    <div class="ml-3">
                        {{$addButton}}
                    </div>
                @endif
            </div>            
        </x-flex>
    </div>
    

</div>

{{-- 스크립트(Alpin.js) --}}
<script>

    function datatables() {
        // let delBtn = document.querySelector('#btn-delete');
        // delBtn.setAttribute('disabled',null);

        return {
            selectedRows: [],

            selectCheckbox(event, id) {
                

                // 선택아이템 체크
                let rows = this.selectedRows;
                if (rows.includes(id)) {
                    let index = rows.indexOf(id);
                    rows.splice(index, 1);
                } else {
                    rows.push(id);
                }

                

                let checknum = document.querySelector('#selected_count');
                if(checknum) {
                    checknum.textContent = rows.length + " selected";
                }

                // 선택삭제
                
                let delBtn = document.querySelector('#btn-delete');
                if ( rows.length > 0 ) {
                    delBtn.removeAttribute('disabled');
                } else {
                    delBtn.setAttribute('disabled',null);
                }
                

                // 전체선택 여부 확인
                let columns = document.querySelectorAll('.rowCheckbox');
                let allcheck = document.querySelector('#all_checks');
                if(columns.length == rows.length) {
                    allcheck.checked = true;
                } else {
                    allcheck.checked = false;
                }

                

                // 활성화 체크
                let tr = event.target.parentElement.parentElement; // td->tr 선택
                if(event.target.checked) {
                    tr.classList.add('row-selected');
                } else {
                    tr.classList.remove('row-selected');
                }

            },

            selectAllCheckbox($event) {
                let columns = document.querySelectorAll('.rowCheckbox');
                let tr;
                this.selectedRows = [];

                // 선택삭제
                let delBtn = document.querySelector('#btn-delete');

                if ($event.target.checked == true) {
                    // 전체선택
                    columns.forEach(column => {
                        column.parentElement.parentElement.classList.add('row-selected');                    
                        column.checked = true;
                        this.selectedRows.push(parseInt(column.name));
                    });

                    
                    delBtn.removeAttribute('disabled');

                } else {
                    // 전체해제
                    columns.forEach(column => {
                        column.parentElement.parentElement.classList.remove('row-selected'); 
                        column.checked = false
                    });
                    this.selectedRows = [];

                    delBtn.setAttribute('disabled',null);
                }
            }

        }
    }
</script>