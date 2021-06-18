<style>
.popup {
    width: 500px; height:500px; box-shadow: 2px 2px 10px rgba(0,0,0,0.5);
    border-radius: 5px;
}
</style>
<div>
    <x-slot name="title"></x-slot>
    <x-slot name="control"></x-slot>

    {{-- Stop trying to control. --}}
    <a href="" class="btn btn-blue">팝업열기</a>

    <div class="popup">
        <a href="#a">닫기</a>
    </div>
</div>
