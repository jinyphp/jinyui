<style>
    .tree input[type='checkbox']{
        display: none;
    }
    .tree  input[type='checkbox'] + label + ul {
        display: none;
        padding: 0 1rem 0 ;
    }

    .tree  input[type='checkbox']:checked + label + ul {
        display: block;
    }

    .tree-icon {
        display: inline-block;
    }

    .tree-icon .tree-expend {
        display: none;
    }

    .tree  input[type='checkbox']:checked + label .tree-expend {
        display: inline-block;
    }

    .tree  input[type='checkbox']:checked + label .tree-close {
        display: none;
    }



</style>

<div class="tree">
    <input type="checkbox" id="123456789" >
    <label for="123456789" >
        <div class="tree-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block tree-close" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>

            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block tree-expend" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
            </svg>
        </div>
        메뉴클릭
    </label>    
    <ul>
        <li>AAA</li>
        <li>BBB</li>
        <li>CCC</li>
        <li>DDD</li>
        <li>EEE</li>
    </ul>
</div>

