<style>
.row-selected {
    background-color: #fcf7c2;
}
</style>
<div>
    {!! $tableBuild($slot, $attributes) !!}

    {{-- 라이브와이어 테이블 출력--}}
    {{--
    @livewire('datatable',['ui'=>$ui, 'rules'=>$rules])
    --}}

</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // 선택, 해제
        var selected = 0;
        var rowCheck = document.querySelectorAll('table tbody .rowCheckbox');
        var allCheck = document.querySelector("table thead [type='checkbox']");
        
        allCheck.addEventListener("click",function(e){
            checkAll(e.target.checked);
            if(e.target.checked) {
                selected = rowCheck.length;
            } else {
                selected = 0;
            }
        });
        
        rowCheck.forEach(el=> {
            el.addEventListener("click",function(e){
                let Tr = el.parentElement.parentElement.parentElement;
                if(e.target.checked) {
                    Tr.classList.add('row-selected');
                    selected++;
                } else {
                    Tr.classList.remove('row-selected');
                    selected--;
                }

                if (selected == rowCheck.length) {
                    allCheck.checked = true;
                } else {
                    allCheck.checked = false;
                }
            });
        });

        function checkAll(status) {
            rowCheck.forEach(el=> {
                el.checked = status;

                let Tr = el.parentElement.parentElement.parentElement;
                if (status) {
                    Tr.classList.add('row-selected');
                } else {
                    Tr.classList.remove('row-selected');
                }
            });
        }

    });

</script>