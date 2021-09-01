<!-- 데이터 테이블 -->

        <x-card>
            {{-- admin
            @livewire('tabledata-field', ['rules' => $rules])
            --}}



            <x-data-table>
                <x-table check class="mb-0">
                    <x-table-head class="table-light">
                        <tr class="relative">
                            <th style="width: 20px;">
                                <x-table-check-all/>
                            </th>
                            
                            @foreach ($rules['fields'] as $item)
                                {{-- $datahead($item) --}}
                                {!! $table->header($item) !!}
                            @endforeach
                        </tr>
                    </x-table-head>

                    <x-table-body>
                        @if (!empty($rows))
                            @foreach ($rows as $i => $row)
                                <tr>
                                    <td style="width: 20px;">
                                        @if (isset($row['id']))
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input rowCheckbox" id="ids_{{ $row['id'] }}" name="ids" 
                                                        wire:model.defer="selected" value="{{ $row['id'] }}">
                                                <label class="form-check-label" for="ids_{{ $row['id'] }}">&nbsp;</label>
                                            </div>                                       
                                        @endif
                                    </td>
                                    
                                    @foreach ($rules['fields'] as $item)

                                        {{-- $datacell($item,$row) --}}
                                        {!! $table->tbodyCell($item, $row) !!}
                                    @endforeach
                                </tr>
                            @endforeach
                            
                        @else
                            <tr>
                                @php
                                    $colspan = 1;
                                    foreach ($rules['fields'] as $item) {
                                        if (isset($item['list']) && $item['list']) {
                                            $colspan++;
                                        }
                                    }
                                @endphp

                                <td colspan="{{ $colspan }}" class="text-center">데이터가 없습니다. 추가를 클릭하여 새로운 데이터를 삽입하세요.</td>
                            </tr>
                        @endif
                    
                    </x-table-body>
                </x-table>
            </x-datatable>

            <x-card-footer>
                {!! $pagination !!}					
            </x-card-footer>

        </x-card>
