<style>
    .wrapper {
        display:grid;
        grid-template-areas:
            'header header header'
            'menu main top'
            'menu main aside'
            'menu main bottom'
            'footer footer footer';
            grid-gap:10px;
            grid-template-columns: 300px 1fr 300px;
            grid-template-rows: 100px 150px 1fr 150px 100px;
    }

    .header {
        grid-area: header;
    }
    .menu {
        grid-area: menu;
    }
    .main {
        grid-area: main;
    }
    .top {
        grid-area: top;
    }
    .aside {
        grid-area: aside;
    }
    .bottom {
        grid-area: bottom;
    }
    .footer {
        grid-area: footer;
    }

</style>
<x-jiny-theme>
    {{-- grrid layout--}}
    <div class="header bg-blue-700">header</div>
    <div class="menu bg-blue-400">menu</div>
    <div class="main bg-blue-200">main</div>
    <div class="top bg-blue-100">top</div>
    <div class="aside bg-blue-300">aside</div>
    <div class="buttom bg-blue-600">bottom</div>
    <div class="footer bg-blue-700">footer</div>
</x-jiny-theme>