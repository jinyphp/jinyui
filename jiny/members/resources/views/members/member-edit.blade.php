
    <h5 class="card-title">기본정보</h5>
    <h6 class="card-subtitle text-muted">사이트 접속에 필요한 회원 정보를 입력합니다.</h6>

    <x-form-hor>
        <x-form-label>가입경로(regref)</x-form-label>
        <x-form-item>
            {!! xInputText('regref')->setWidth("small")->setAttribute("wire:model.defer","_data.refref") !!}
            
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>이메일(email)</x-form-label>
        <x-form-item>
            {!! xInputEmail('email')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>비밀번호(password)</x-form-label>
        <x-form-item>
            {!! xInputPassword('password')->setWidth("small") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>이름(last name):</x-form-label>
        <x-form-item>
            {!! xInputText('lastname')->setWidth("standard")->setAttribute("wire:model.defer","_data.lastname") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>성(first name)</x-form-label>
        <x-form-item>
            {!! xInputText('firstname')->setWidth("standard")->setAttribute("wire:model.defer","_data.firstname") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>성별</x-form-label>
        <x-form-item>
            {!! xRadioGroup()
                ->addRadio(
                    xRadio("sex", "man"), 
                    "남성")
                ->addRadio(
                    xRadio("sex", "woman"), 
                    "여성")
                ->addRadio(
                    xRadio("sex", "company"), 
                    "법인")
                ->setInline()
            !!}
        </x-form-item>
    </x-form-hor>




    <x-form-hor>
        <x-form-label>전화번호</x-form-label>
        <x-form-item>
            {!! xInputText('phone')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>도시</x-form-label>
        <x-form-item>
            {!! xInputText('city')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>주(state)</x-form-label>
        <x-form-item>
            {!! xInputText('state')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>우편번호</x-form-label>
        <x-form-item>
            {!! xInputText('post')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>주소</x-form-label>
        <x-form-item>
            {!! xInputText('address')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <h5 class="card-title">회원 승인</h5>
    <h6 class="card-subtitle text-muted"></h6>

    <x-form-hor>
        <x-form-label>승인</x-form-label>
        <x-form-item>
            {!! xCheckbox("auth") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>국가</x-form-label>
        <x-form-item>
            {!! xInputText('country')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>언어</x-form-label>
        <x-form-item>
            {!! xInputText('language')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>이머니</x-form-label>
        <x-form-item>
            {!! xInputText('emoney')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>포인트</x-form-label>
        <x-form-item>
            {!! xInputText('point')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>구매 할인율</x-form-label>
        <x-form-item>
            {!! xInputText('discount')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>가입일자</x-form-label>
        <x-form-item>
            {!! xInputText('regdate')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>마지막 접속일</x-form-label>
        <x-form-item>
            {!! xInputText('lastlog')->setWidth("standard") !!}
        </x-form-item>
    </x-form-hor>

    <x-form-hor>
        <x-form-label>

        </x-form-label>
        <x-form-item>
            
        </x-form-item>
    </x-form-hor>