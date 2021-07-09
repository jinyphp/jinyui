<style>
    .select-box {
        display:flex;
        width:300px;
        flex-direction: column;
    }

    .selected {
        margin: 0;
        padding: 4px 5px;
        vertical-align: middle;
        min-height: 24px;

        background-color: #ffffff;
        border: 1px solid #acbbc2;
        box-sizing: border-box;
        color: #1f2c33;

        position:relative;                
        font-size: 1em;
        outline: 0;
        transition: border-color .2s ease-out, box-shadow .2s ease-out;

        cursor: pointer;
        order:0;
    }

    .select-box .option-container {
        position: absolute;

        width: inherit;
        z-index: 10;
        margin-top: 25px;

        background-color: #ffffff;
        border: 1px solid #acbbc2;
        box-sizing: border-box;
        color: #1f2c33;

        transition: all 0.4s;

        /*
        background: #2f3640;
        color:#f5f6fa;
        
        
        border-radius: 8px;
        overflow: hidden;
        */
        
        /*option 항목 숨김*/                
        max-height: 0;
        opacity: 0;
        
        order:1; /*flex 순번변경*/
    }

    .select-check {
        background-color:#333333;
        color: white;

    }

    .select-box .option-container .option
    {
        /*중간선을 체크를 방지하기 위해서 margin, padding을 0으로 설정*/
        margin: 0;
        padding: 0;
    }

    /*자식 선택자 item*/
    .option > div {
        padding: 4px 5px;
        vertical-align: middle;
        min-height: 24px;

        cursor: pointer;
    }

    .select-box .option-container .option:hover {
        background-color: #e8f5ff;
    }

    .selected:after {
        content:'\25BC';
        position:absolute;
        top:auto;
        right: 13px;
        color: #1f2c33;
        background: #ffffff;
        cursor:pointer;
        pointer-events:none;
        transition: all .4s;
    }

    .select-box .option-container.active + .selected:after {
        transform: rotateX(180deg);
    }
    
    .select-box .option-container.active {
        max-height: 150px;
        opacity: 1;
        overflow-y: scroll;
    }
    
    /*스크롤바 디자인*/
    .select-box .option-container::-webkit-scrollbar {
        /*
        width: 8px;
        background: #0d141f;
        border-radius: 0 8px 8px 0;
        */
        width: 9px;
        background-color: rgba(172, 187, 194, 0.55);
    }
    .select-box .option-container::-webkit-scrollbar-thumb {
        background-color: rgba(135, 135, 135, 0.85);
        border: 1px solid rgba(122, 122, 122, 0.85);
    }
    
</style>

<div class="select-box" 
    x-data="selectBox()"
    x-init="init()"
    wire:ignore >
    
    <div class="selected" @click="open">
        @if (isset($placeholder))
            {{$placeholder}}
        @endif
    </div>
    <div class="option-container" @click="select($event)">
        {{$slot}}
    </div>            
</div>

<script>
/*
    Alpine JS SelectBox
*/
function selectBox() {
    return {
        isOpen:false, 
        selectedElement:null,
        optionElement:null,
        selectValue: @entangle($attributes->wire('model')),
        init(){
            this.selectedElement = document.querySelector('.select-box .selected');
            this.optionElement = document.querySelector('.select-box .option-container');

            if(this.selectValue) {
                let sel = this.optionElement.querySelector('[data-value=' + this.selectValue + ']');
                // console.log(sel);
                // 초기값 복사
                this.selectedElement.innerHTML = sel.innerHTML;
                sel.classList.add('select-check');
            }

        },
        select(event){
            // 옵션값 복사
            let val;
            if(val = event.target.dataset.value) {
                this.selectedElement.dataset.value = event.target.dataset.value;
                this.selectValue = event.target.dataset.value;
            } else {
                this.selectedElement.dataset.value = null;
                this.selectValue = null;
            }            

            // 선택내용 복사
            this.selectedElement.innerHTML = event.target.innerHTML;

            this.highlight(this.selectValue);
            this.open(); // 드롭목록 토클
        },
        open(){   
            // 드롭목록 토클                
            this.optionElement.classList.toggle('active');               
        },
        highlight(value){
            let options = this.optionElement.querySelectorAll('.option > div');
            options.forEach(el=>{
                if(el.dataset.value && el.dataset.value == value ) {
                    el.classList.add('select-check');
                }
                else {
                    el.classList.remove('select-check');
                }               
            });
        }
    };
}

</script>