

        {{ 
            (new \Jiny\Html\Form\CSelectCustom('country', "ko") )
            ->addOption("korean","ko")
        }}


        {{
            (new \Jiny\Html\Form\CSelectCustom('country', "en") )
            ->addOption("korean","ko")
            ->addOption("english","en")
            ->addOption("franch","fr")
        }}
        

        <br><br>
        selectBox : {{$selectbox}} <br>
        <x-select-box wire:model="selectbox" placeholder="선택하세요">
            
            <div class="option">                    
                <div data-value="item1">AAA</div>
            </div>

            <div class="option">                    
                <div data-value="item2">BBB</div>
            </div>

            <div class="option">                    
                <div data-value="item3">CCC</div>
            </div>

            <div class="option">                    
                <div >DDD</div>
            </div>

            <div class="option">                    
                <div >EEE</div>
            </div>

            <div class="option">                    
                <div >FFF</div>
            </div>

            <div class="option">                    
                <div >GGG</div>
            </div>
        </x-select-box>
        


     
{{--
        <script>
            const selected = document.querySelector(".selected");
            const optionContainer = document.querySelector(".option-container");
            const optionList = document.querySelectorAll(".option");
    
            selected.addEventListener("click",()=>{
                optionContainer.classList.toggle("active"); 
            });
    
            optionList.forEach(el => {
                el.addEventListener("click",()=>{
                    selected.innerHTML = el.querySelector('label').innerHTML;
                    optionContainer.classList.remove("active"); 
                });
            });
        </script>
--}}

