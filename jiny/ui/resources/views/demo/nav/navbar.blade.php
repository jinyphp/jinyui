<x-theme theme="adminkit" class="bootstrap">

	<x-main-content>
        <x-container>
            <!-- start page title -->
            <x-row>
                <x-col-12>
                    <div class="page-title-box">                        
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Component</a></li>
                            <li class="breadcrumb-item active">Nav</li>
                        </ol>                        
                        
						<div class="mb-3">
                            <h1 class="h3 d-inline align-middle">Nav bar</h1>
                        </div>
						<p></p>
                    </div>
                </x-col-12>
            </x-row>  
            <!-- end page title -->

			<x-row>
				<x-col-12>
					<x-card>
						<x-card-header>
							<h5 class="card-title">NavBar Light</h5>
							<h6 class="card-subtitle text-muted"></h6>
						</x-card-header>
						<x-card-body>
							@include("jinyui::demo.nav.navbar.light")
						</x-card-body>
					</x-card>
				</x-col-12>
			</x-row>

		</x-container>
	</x-main-content>
</x-theme>   