<div class="p-8">
    <ul drag-root="reorder" 
        class="overflow-hidden rounded shadow divide-y">
        @foreach ($things as $item)
            <li drag-item="{{$item['id']}}" draggable="true" wire:key="{{$item['id']}}"
            class="border bg-white p-4"> 
                {{$item['title']}}
            </li>
        @endforeach
    </ul>

    

</div>

<script>
        
    let root = document.querySelector('[drag-root]');
    root.querySelectorAll('[drag-item]').forEach(el => {
        // console.log(el)
        el.addEventListener('dragstart', e => {
            //console.log('start');
            e.target.classList.add('bg-blue-100');
            e.target.setAttribute('dragging', true); // 드래그 플레그 설정
        });

        el.addEventListener('drop', e => {
            //console.log('drop');
            let draggingEl = root.querySelector('[dragging]');
            e.target.after(draggingEl);

            // 라이브와이어 갱신
            let component = Livewire.find(
                e.target.closest('[wire\\:id]').getAttribute('wire:id')
            );
            let orderIds = Array.from(root.querySelectorAll('[drag-item]'))
                .map(itemEl => 
                    itemEl.getAttribute('drag-item')
                );
            //console.log(orderIds);
            let method = root.getAttribute('drag-root');
            component.call(method,orderIds);

            e.target.classList.remove('bg-blue-100');
        });

        el.addEventListener('dragover', e => {
            e.preventDefault(); // drop 기능과 방해
            //console.log('over');
        });

        el.addEventListener('dragenter', e => {
            e.target.classList.add('bg-yellow-100');
            e.preventDefault(); // drop 기능과 방해
            //console.log('enter');
        });

        el.addEventListener('dragleave', e => {
            e.target.classList.remove('bg-yellow-100');
            //console.log('leave');
        });

        el.addEventListener('dragend', e => {
            //console.log('end');
            e.target.removeAttribute('dragging'); // 드래그 플레그 삭제
        });

    })
</script>

