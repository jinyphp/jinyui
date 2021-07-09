오토로그인 : {{$autologin}} <br>

{{ CCheckBox('autologin')->setChecked(true) }}
체크2
{!! 
    CCheckBox('autologin')->setChecked(true)
    ->setWireModel("autologin") !!}