<x-theme theme="adminkit" class="bootstrap">
	<x-main-content>
		<x-container>
			<!-- start page title -->
        	<x-row >
            	<x-col class="col-8">
                	<div class="page-title-box">                        
                    	<ol class="breadcrumb m-0">
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        	<li class="breadcrumb-item"><a href="javascript: void(0);">Button</a></li>
                        	<li class="breadcrumb-item active">Group</li>
                    	</ol>                        
                    
        				<div class="mb-3">
                        	<h1 class="h3 d-inline align-middle">Button Group</h1>
                            <p></p>
                    	</div>
                	</div>
            	</x-col>
        	</x-row>  
        	<!-- end page title -->

			<div class="row">
				<div class="col-12 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Basic</h5>
							<h6 class="card-subtitle text-muted">버튼 그룹 스타일입니다. 기본 그룹 묶음은 가로 방향 입니다.</h6>
						</div>
						<div class="card-body">
							<h6 class="card-subtitle mb-2 text-muted">기본스타일</h6>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" class="btn btn-primary">Left</button>
								<button type="button" class="btn btn-primary">Middle</button>
								<button type="button" class="btn btn-primary">Right</button>
							</div>

							<h6 class="card-subtitle mb-2 text-muted">링크</h6>
							<div class="btn-group">
								<a href="#" class="btn btn-primary active" aria-current="page">Active link</a>
								<a href="#" class="btn btn-primary">Link</a>
								<a href="#" class="btn btn-primary">Link</a>
							</div>






							


						</div>
					</div>
				</div>

				<div class="col-12 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">사이즈</h5>
							<h6 class="card-subtitle text-muted">버튼 그룹 스타일입니다. 기본 그룹 묶음은 가로 방향 입니다.</h6>
						</div>
						<div class="card-body">







							<h6 class="card-subtitle mb-2 text-muted">Horizontal button group</h6>

							<div class="btn-group btn-group-lg mb-3" role="group" aria-label="Large button group">
								<button type="button" class="btn btn-secondary">Left</button>
								<button type="button" class="btn btn-secondary">Middle</button>
								<button type="button" class="btn btn-secondary">Right</button>
							</div>
							<br>
							<div class="btn-group mb-3" role="group" aria-label="Default button group">
								<button type="button" class="btn btn-secondary">Left</button>
								<button type="button" class="btn btn-secondary">Middle</button>
								<button type="button" class="btn btn-secondary">Right</button>
							</div>
							<br>
							<div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
								<button type="button" class="btn btn-secondary">Left</button>
								<button type="button" class="btn btn-secondary">Middle</button>
								<button type="button" class="btn btn-secondary">Right</button>
							</div>

						</div>
					</div>
				</div>

				<div class="col-12 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Button toolbar</h5>
							<h6 class="card-subtitle text-muted">Button group components.</h6>
						</div>
						<div class="card-body">

				


							<h6 class="card-subtitle mb-2 text-muted">Button toolbar</h6>
							<div class="btn-toolbar mb-4" role="toolbar" aria-label="Toolbar with button groups">

								<div class="btn-group me-2" role="group" aria-label="First group">
									<button type="button" class="btn btn-secondary">1</button>
									<button type="button" class="btn btn-secondary">2</button>
									<button type="button" class="btn btn-secondary">3</button>
									<button type="button" class="btn btn-secondary">4</button>
								</div>
								<div class="btn-group me-2" role="group" aria-label="Second group">
									<button type="button" class="btn btn-secondary">5</button>
									<button type="button" class="btn btn-secondary">6</button>
									<button type="button" class="btn btn-secondary">7</button>
								</div>
								<div class="btn-group" role="group" aria-label="Third group">
									<button type="button" class="btn btn-secondary">8</button>
								</div>
								
							</div>


	


						</div>
					</div>
				</div>

				<div class="col-12 col-lg-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Vertical button group</h5>
							<h6 class="card-subtitle text-muted">Button group components.</h6>
						</div>
						<div class="card-body">

							<h6 class="card-subtitle mb-2 text-muted">Vertical button group</h6>
							<div class="btn-toolbar">
								<div class="btn-group-vertical me-2" role="group" aria-label="Vertical button group">
									<button type="button" class="btn btn-primary">Button</button>
									<button type="button" class="btn btn-primary">Button</button>
									<button type="button" class="btn btn-primary">Button</button>
								</div>
								<div class="btn-group-vertical me-2" role="group" aria-label="Vertical button group">
									<button type="button" class="btn btn-success">Button</button>
									<button type="button" class="btn btn-success">Button</button>
									<button type="button" class="btn btn-success">Button</button>
								</div>
								<div class="btn-group-vertical me-2" role="group" aria-label="Vertical button group">
									<button type="button" class="btn btn-warning">Button</button>
									<button type="button" class="btn btn-warning">Button</button>
									<button type="button" class="btn btn-warning">Button</button>
								</div>
								<div class="btn-group-vertical me-2" role="group" aria-label="Vertical button group">
									<button type="button" class="btn btn-danger">Button</button>
									<button type="button" class="btn btn-danger">Button</button>
									<button type="button" class="btn btn-danger">Button</button>
								</div>
							</div>


						</div>
					</div>
				</div>
			</div>

		</x-container>
	</x-main-content>
</x-theme>   