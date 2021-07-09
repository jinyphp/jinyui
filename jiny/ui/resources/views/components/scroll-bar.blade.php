@props(['scrollwidth' => 5 ])
<style>
    /*스크롤바 디자인*/
    .scroll {
        overflow: hidden;
    }

    .scroll:hover {
        /* overflow-y:scroll; */
        overflow: auto;
    }

    .scroll::-webkit-scrollbar {
        width:  0px;
        background-color: rgba(172, 187, 194, 0.55);
    }
    .scroll::-webkit-scrollbar-thumb {
        /*
        background-color: rgba(135, 135, 135, 0.85);
        border: 1px solid rgba(122, 122, 122, 0.85);
        border-radius: 10%;
        */
    }

    .active.scroll::-webkit-scrollbar {
        width:  {{$scrollwidth}}px;
        background-color: rgba(172, 187, 194, 0.55);
    }
    .active.scroll::-webkit-scrollbar-thumb {
        background-color: rgba(135, 135, 135, 0.85);
        border: 1px solid rgba(122, 122, 122, 0.85);
        border-radius: 10%;
    }
</style>
<div {{ $attributes->merge(['class' => 'scroll x-scroll']) }} >
    {{$slot}}

    @foreach (range(1,100) as $item)
    {{ $item }} <br>
    @endforeach

</div>
<script>
    window.addEventListener("load", function(e){
        const scroll = document.querySelector(".x-scroll");
        var timer = null;
        scroll.addEventListener("scroll", function(e){
            // 타이머를 이용하여 스크롤 종료시간 측정
            if(timer !== null) {
                clearTimeout(timer); 
                //console.log("scrolling...");
                e.target.classList.add("active");
            }
            timer = setTimeout(function() {
                //console.log("scrol stop >>");
                e.target.classList.remove("active");
            }, 700);

        });
    });
</script>
