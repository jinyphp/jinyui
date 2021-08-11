<x-theme>
	<x-main class="p-4">
		<x-main-content class="bg-white p-4">
			
		</x-main-content>
	</x-main>
</x-theme>

<div>
    <header class="header-title">
        <nav class="sidebar-nav-toggle" role="navigation" aria-label="Sidebar control">
            <button type="button"
                id="sidebar-button-toggle" class="button-toggle" title="Show sidebar">Show sidebar</button>
        </nav>
        <div>
            <h1 id="page-title-general">메뉴 설정</h1>
        </div>
        <div class="header-controls">
            <nav aria-label="Content controls">
                <ul>
                    <li><button type="button" data-url="templates.php?form=create">Create template</button></li>
                    <li><button type="button" id="form" name="form"
                            onclick="redirect(&quot;conf.import.php?rules_preset=template&quot;)">Import</button>
                    </li>
                    <li><button type="button" wire:click.prevent="addItem">추가</button></li>
                </ul>
            </nav>
        </div>
    </header>


    <main>
    {{-- SiteAdmin MenuBuilder --}}



<div class="filter-space ui-tabs ui-corner-all ui-widget ui-widget-content ui-tabs-collapsible"
    style="user-select: auto;" aria-label="Filter">

    <ul class="filter-btn-container ui-tabs-nav ui-corner-all ui-helper-reset ui-helper-clearfix ui-widget-header"
        role="tablist" style="user-select: auto;">
        <li role="tab" tabindex="0"
            class="ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active"
            aria-controls="tab_0" aria-labelledby="ui-id-1" aria-selected="true" aria-expanded="true"
            style="user-select: auto;">

            <a class="filter-trigger ui-tabs-anchor" href="#tab_0" role="presentation"
                tabindex="-1" id="ui-id-1" style="user-select: auto;">Filter</a>
        </li>
    </ul>



    <form>
        <div class="filter-container ui-tabs-panel ui-corner-bottom ui-widget-content" id="tab_0"
            aria-labelledby="ui-id-1" role="tabpanel" aria-hidden="false" style="user-select: auto;">

            <div class="table filter-forms" style="user-select: auto;">
                <div class="row" style="user-select: auto;">
                    <div class="cell" style="user-select: auto;">

필터검색영역
<x-select/>
<input type='hidden' name='ajaxkey' value='$ajaxkey'>
            <input type='hidden' name='limit' value='$limit'>
            <input type='hidden' name='searchkey' value='$search'>
            <input type='hidden' name='list_num' value='$list_num'>
            <input type='hidden' name='menu_code' value='$menu_code'>

                    </div>
                </div>

            </div>

            <div class="filter-forms" style="user-select: auto;">
                <button type="submit" style="user-select: auto;">Apply</button>
                <button type="button" class="btn-alt" style="user-select: auto;">Reset</button>
            </div>
        </div>
    </form>
</div>







    <a href="site_menu_setting.php">메뉴코드</a> : {menu_code}
    {setting}

    {menu_list}
        <!-- Two columns -->
        <div class="flex mb-1">
            <div class="w-1/2">
                <label for="listnum">목록:</label>
                <select name="" id="listnum" style="width:100px">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
            <div class="w-1/2">
                <div class="flex justify-end">
                    <button type="button" class="h-1 m-1">abcd</button>
                    <div class="m-1">
                        <button type="button">추가</button>
                    </div>
                    <div class="m-1">
                        <button type="button">삭제</button>
                    </div>
                </div>
            </div>
        </div>



        {{-- 테이블 --}}
        <table class="list-table">
            <thead>
                <tr>
                    <th class="cell-width">
                        <input type="checkbox" id="all_items" class="checkbox-radio" wire:model="selectAll">
                        <label for="all_items"><span></span></label>
                    </th>
                    <th>ID</th>
                    <th><a href="#">Name<span class="arrow-up"></span></a></th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        <th class="cell-width">
                            <input type="checkbox" id="all_items" class="checkbox-radio" wire:model="selectAll">
                            <label for="all_items"><span></span></label>
                        </th>
                        <td>{{$item->title}}</td>
                        <td>{{$item->level}}</td>
                        <td>{{$item->pos}}</td>
                    </tr>
                @endforeach


            </tbody>
        </table>


        <div class="table-paging">
        </div>


    </main>
</div>
