<x-theme>
    <style>
        .card_animation {
            display:flex;
        }
        .card_animation li {
            flex:1;
            height: 100vh;

            font-size: 3rem;
            text-align: center;
            line-height: 100vh;

            transition: 0.5s;
        }
        .card_animation li:not(:hover) {
            flex: 0.7;
        }
        .card_animation li:nth-child(1) {
            background-color: aqua;
        }
        .card_animation li:nth-child(2) {
            background-color: red;
        }
        .card_animation li:nth-child(3) {
            background-color: blue;
        }
        .card_animation li:nth-child(4) {
            background-color: green;
        }
        .card_animation li:hover {
            flex: 1.8;

            font-size: 5rem;
            color: white;text-shadow: 0 0 5px rega(0,0,0,0.5);
        }
        
    </style>
    <ul class="card_animation">
        <li>AAA</li>
        <li>BBB</li>
        <li>CCC</li>
        <li>DDD</li>
    </ul>
</x-theme>