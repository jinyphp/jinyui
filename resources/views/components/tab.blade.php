<div class="mytabs">
    {{$slot}}

    @if (isset($footer))
        <div class="tabview-footer">
            {{$footer}}
        </div>
    @endif
</div>

<style>
    .mytabs {
        display: flex;
        flex-wrap: wrap;
        background-color: #ffffff;
        border: 1px solid #dfe4e7;
        text-align: left;
        margin: 0 0 10px; /* 다음 요소와의 간격거리*/
    }

    .mytabs .tab {
        width: 100%;
        padding: 20px;
        background: #fff;
        order: -1;
        display: none;
        border-top: 1px solid #ebeef0;
    }

    .mytabs .tabview-footer {
        width: 100%;
        padding: 20px;
        background: #fff;
        order: 2;
    }

    .mytabs input[type="radio"] {
        display: none;
    }

    .mytabs input[type='radio']:checked + label + .tab {
        display: block;
    }

    .mytabs > label {
        height: 30px;
        line-height: 30px;
        padding: 2px 10px;
        order: -2;
    }

    .mytabs > label:hover {
        background-color: #e8f5ff;
    }

    .mytabs input[type="radio"]:checked + label {
        padding: 2px 10px 6px;
        background-color: transparent;
        color: #0275b8;
        text-decoration: none;
        cursor: default;
        border-bottom: 3px solid #0275b8;
    }
</style>

