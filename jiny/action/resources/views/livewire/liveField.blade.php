<div>
    <x-table class="table-bordered">
        <x-thead>
            <tr>
                <th style="width: 20px;">
                    {!! xTableCheckAll() !!}
                </th>
                
                <th style="width: 50px;">Id</th>
                <th>타이틀</th>
                <th style="width: 100px;">List 출력</th>
                <th style="width: 100px;">List_type</th>
                <th style="width: 100px;">Form 입력</th>
                <th style="width: 100px;">Form_type</th>
                <th>설명</th>
                
            </tr>
        </x-thead>
    
        <x-tbody>
            @foreach ($rows as $row)
                <tr>
                    <td style="width: 20px;">
                        {!! xTableCheckRow($row->id) !!}
                    </td>
                    <td style="width: 50px;">{{$row->id}}</td>
                    <td>
                        <a href="{{route($rules['routename'].'.edit',[ $nested, $row->id ])}}">
                        {{$row->title}}</a>
                    </td>
                    <td style="width: 100px;">{{$row->list}}</td>
                    <td style="width: 100px;">{{$row->list_type}}</td>
                    <td style="width: 100px;">{{$row->form}}</td>
                    <td style="width: 100px;">{{$row->input}}</td>
                    <td>{{$row->description}}</td>
                </tr>
            @endforeach
        </x-tbody>
    </x-table>

</div>


