<x-jinyui-theme theme="adminkit" class="bootstrap">


    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Tables</h1>

        <div class="row">
            <div class="col-12 col-xl-6">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Basic Table</h5>
                        <h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.
                        </h6>
                    </div>
                    <x-jinyui::table.basic>
                        <x-jinyui::table.thead>

                        </x-jinyui::table.thead>
                        <x-jinyui::table.tbody>
                            
                        </x-jinyui::table.tbody>
                    </x-jinyui::table.basic>
                </x-jinyui-card>                       
            </div>

            <div class="col-12 col-xl-6">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Striped Rows</h5>
                        <h6 class="card-subtitle text-muted">Use <code>.table-striped</code> to add zebra-striping to any table row within the
                            <code>&lt;tbody&gt;</code>.</h6>
                    </div>
                    <x-jinyui::table.striped>
                        <x-jinyui::table.thead>
                        </x-jinyui::table.thead>
                        <x-jinyui::table.tbody>            
                        </x-jinyui::table.tbody>
                    </x-jinyui::table.striped>
                </x-jinyui-card>  
            </div>

            <div class="col-12 col-xl-6">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Condensed Table</h5>
                        <h6 class="card-subtitle text-muted">Add <code>.table-sm</code> to make tables more compact by cutting cell padding in half.
                        </h6>
                    </div>
                    <x-jinyui::table.condensed>
                        <x-jinyui::table.thead>
                        </x-jinyui::table.thead>
                        <x-jinyui::table.tbody>            
                        </x-jinyui::table.tbody>
                    </x-jinyui::table.condensed>
                </x-jinyui-card> 
            </div>

            <div class="col-12 col-xl-6">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Hoverable Rows</h5>
                        <h6 class="card-subtitle text-muted">Add <code>.table-hover</code> to enable a hover state on table rows within a
                            <code>&lt;tbody&gt;</code>.</h6>
                    </div>
                
                    
                    <x-jinyui::table.hoverable>
                        <x-jinyui::table.thead>
                        </x-jinyui::table.thead>
                        <x-jinyui::table.tbody>            
                        </x-jinyui::table.tbody>
                    </x-jinyui::table.hoverable>
                </x-jinyui-card> 
            </div>

            <div class="col-12 col-xl-6">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Bordered Table</h5>
                        <h6 class="card-subtitle text-muted">Add <code>.table-bordered</code> for borders on all sides of the table and cells.</h6>
                    </div>
                    <x-jinyui::table.bordered>
                        <x-jinyui::table.thead>
                        </x-jinyui::table.thead>
                        <x-jinyui::table.tbody>            
                        </x-jinyui::table.tbody>
                    </x-jinyui::table.bordered>
                </x-jinyui-card> 
            </div>

            <div class="col-12 col-xl-6">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Contextual Classes</h5>
                        <h6 class="card-subtitle text-muted">Use contextual classes to color table rows or individual cells.</h6>
                    </div>
                    <x-jinyui::table.contextual>
                        <x-jinyui::table.thead>
                        </x-jinyui::table.thead>
                        <x-jinyui::table.tbody>            
                        </x-jinyui::table.tbody>
                    </x-jinyui::table.contextual>
                </x-jinyui-card>                       
            </div>

            <div class="col-12">
                <x-jinyui-card>
                    <div class="card-header">
                        <h5 class="card-title">Always responsive</h5>
                        <h6 class="card-subtitle text-muted">Across every breakpoint, use <code>.table-responsive</code> for horizontally scrolling
                            tables.</h6>
                    </div>
                    <div class="table-responsive">
                        <x-jinyui::table.response>
                            <x-jinyui::table.thead>
                            </x-jinyui::table.thead>
                            <x-jinyui::table.tbody>            
                            </x-jinyui::table.tbody>
                        </x-jinyui::table.response>
                    </div>
                </x-jinyui-card> 
            </div>

        </div>

    </div>


</x-theme>   