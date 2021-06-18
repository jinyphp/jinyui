<table {{ $attributes->merge(['class' => 'min-w-full divide-y divide-gray-200']) }}>
    <thead class="bg-gray-50">
        <tr>
            <th class="px-4 py-2 w-4 
                    text-left text-xs font-medium text-gray-500 
                    uppercase tracking-wider">
                <input type="checkbox">
            </th>
            @if (isset($title))            
                @foreach ($title as $item)
                    <th class="px-4 py-2 
                            text-left text-xs font-medium text-gray-500 
                            uppercase tracking-wider">
                        {{$item}}
                    </th>        
                @endforeach
            @endif
        </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">        
        @if (isset($rows))
            @foreach ($rows as $item)
                <tr>
                    <td class="px-4 py-2 w-4 whitespace-nowrap">
                        <input type=checkbox>
                    </td>

                    <td class="px-4 py-2 whitespace-nowrap">{{$item->code}}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{$item->title}}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{$item->target}}</td>
                    <td class="px-4 py-2 whitespace-nowrap">{{$item->uri}}</td>
                </tr>
            @endforeach
        @endif 
    </tbody>
</table>

