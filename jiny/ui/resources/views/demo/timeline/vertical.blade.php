@push('style')
<style>
.wrapper {
    background-color: #009578;
}

.timeline {
    margin: 0 auto;
    max-width: 750px;
    padding: 25px;
    display: grid;
    color: #ffffff;

    grid-template-columns: 1fr 3px 1fr;


}
.timeline__component {
    margin: 0 20px 20px 20px;
}
.timeline__date--right {
    text-align: right;
}
.timeline__middle {
    position:relative;
    background-color: white;
}
.timeline__point {
    background:white;

    position: absolute;
    top: 0;
    left:50%;
    width:15px;
    height:15px;    
    transform: translateX(-50%);
    border-radius: 50%


}
.timeline__component--bg {
    padding: 1.5em;
    background-color: gray;
    box-shadow: 0 0 5px rgba(0,0,0,0.2);
    border-radius: 10px;
}
.timeline_title {
    margin:0;
    font-size:1.15em;
    font-weight: bold;
}
.timeline_patagraph {
    line-height: 1.5;
}
.timeline__point--bottom {
    top:initial;
    bottom: 0;
}
</style>
@endpush

<x-jiny-theme>
    
    <h3>TimeLine : virtical</h3>
    <div class="timeline">

        <div class="timeline__component">
            <div class="timeline__date timeline__date--right">
                2021년 7월 15일
            </div>
        </div>

        <div class="timeline__middle">
            <div class="timeline__point"></div>
        </div>

        <div class="timeline__component timeline__component--bg">
         
            <h2 class="timeline_title">타이틀</h2>
            <p class="timeline_patagraph">fdasdjlkasldflk</p>
        </div>

        
        <div class="timeline__component">
            <div class="timeline__date timeline__date--right">
                2021년 7월 15일
            </div>
        </div>

        <div class="timeline__middle">
            <div class="timeline__point"></div>
            <div class="timeline__point timeline__point--bottom"></div>
        </div>

        <div class="timeline__component timeline__component--bg">
         
            <h2 class="timeline_title">타이틀</h2>
            <p class="timeline_patagraph">fdasdjlkasldflk</p>
        </div>



    </div>

</x-jiny-theme>


