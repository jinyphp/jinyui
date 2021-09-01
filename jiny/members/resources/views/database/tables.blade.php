<x-theme theme="jinyerp" class="bootstrap">
    <x-main-content>
		<x-container>
            <!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Database</a></li>
                        	<li class="breadcrumb-item active">Tables</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">DB Tables</h1>
                            <p>
                               
                            </p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

			<div class="relative">
                <div class="absolute bottom-4 right-0">
                    <div class="btn-group">
                        <a href="#" class="btn btn-secondary">메뉴얼</a>
                        <a href="#" class="btn btn-primary">추가</a>
                    </div>
                </div>
            </div>

            <x-row>
                <x-col-12>
                    <x-card>
                    
                        <div class="table-responsive" >
                            <x-table check class="mb-0">
                            
                                <x-table-head class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <x-table-check-all/>
                                        </th>
                                        <th>스키마</th> 
                                        <th>테이블명</th>
                                        <th>필드정보</th>                                    
                                    </tr>
                                </x-table-head>

                                <x-table-body>
                                    @foreach ($rows as $i => $row)
                                        <tr>
                                            <td style="width: 20px;">
                                                <x-table-check :i="$i"/>
                                            </td>
                                
                                            @foreach ($row as $schema =>$item)
                                                <td>{{$schema}}</td>
                                                <td>{{$item}}</td>
                                                <td><a href="{{route('tables.show', $item)}}">{{$item}}</a></td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </x-table-body>

                            </x-table>
                        </div>

                    </x-card>
                </x-col-12>
            </x-row>
            

            
		</x-container>
	</x-main-content>
</x-theme>