<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Database</a></li>
                        	<li class="breadcrumb-item active">Tables</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">{{$table}} 필드</h1>
                            <p>
                            
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

			<div class="relative">
                <div class="absolute bottom-4 right-0">
                    <div class="btn-group">
                        <a href="#" class="btn btn-secondary">메뉴얼</a>
                        <a href="#" class="btn btn-primary">목록</a>
                    </div>
                </div>
            </div>

            <x-row>
                <x-col-12>
                    <x-card>
                        <form id="form" action="{{route('admin-db-desc.update', $table)}}" method="post">
                            @csrf
                            <input type="hidden" name="table" value="{{$table}}">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_field" value="{{$row['Field']}}">

                            <x-form-hor>
                                <x-form-label>필드명</x-form-label>
                                <x-form-item>
                                    @if (isset($row))
                                        <input type="text" name="field_name" value="{{$row['Field']}}">
                                    @else
                                        <input type="text" name="field_name">
                                    @endif                                    
                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label>타입</x-form-label>
                                <x-form-item>
                                    {{--
                                    @if (isset($row))
                                        <input type="text" name="field_type" value="{{$row['Type']}}">
                                    @else
                                        <input type="text" name="field_type">
                                    @endif
                                    --}}
                                    <select name="field_type" >
                                        <option value="string">String</option>
                                        <option value="integer">Integer</option>
                                        <option value="bigInteger">BigInteger</option>
                                    </select> 

                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label>Null</x-form-label>
                                <x-form-item>
                                    @if (isset($row))
                                        <input type="text" name="field_null" value="{{$row['Null']}}">
                                    @else
                                        <input type="text" name="field_null">
                                    @endif 
                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label>Key</x-form-label>
                                <x-form-item>
                                    @if (isset($row))
                                        <input type="text" name="field_key" value="{{$row['Key']}}">
                                    @else
                                        <input type="text" name="field_key">
                                    @endif 
                                </x-form-item>
                            </x-form-hor>

                            <x-form-hor>
                                <x-form-label>Key</x-form-label>
                                <x-form-item>
                                    @if (isset($row))
                                        <input type="text" name="field_default" value="{{$row['Default']}}">
                                    @else
                                        <input type="text" name="field_default">
                                    @endif 
                                </x-form-item>
                            </x-form-hor>

                            <button id="form-delete">삭제</button>
                            <button type="submit">수정</button>

                        </form>
                    </x-card>
                </x-col-12>
            </x-row>
            
		</x-container>
	</x-main-content>
</x-theme>

<script>
    window.addEventListener("load", function(){
        document.querySelector('#form-delete')
        .addEventListener('click',function(e){
            e.preventDefault();

            let form = document.querySelector('#form');
            let method = form.querySelector('input[name="_method"]');

            method.value = 'DELETE';
            console.log(method.value);
            console.log(form.action);
            form.submit();
        });
    });
</script>


{{-- 스크립트(Alpin.js) --}}
{{--
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
--}}

