<x-jinyui-theme theme="adminkit" class="bootstrap">

    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">breadcrumb</h1>

		<x-row>
			<x-col-6>
				<x-card>
					<x-card-header>
						<h5 class="card-title">bootstrap code</h5>
                        <h6 class="card-subtitle text-muted">다은은 부트스트랩의 기본 html 코드를 이용한 breadcrumb 구현입니다.</h6>
					</x-card-header>
					<x-card-body>
						<nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Home</li>
                            </ol>
                        </nav>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Library</li>
                            </ol>
                        </nav>

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Library</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data</li>
                            </ol>
                        </nav>
					</x-card-body>
				</x-card>
			</x-col-6>

			<x-col-6>
				<x-card>
					<x-card-header>
						<h5 class="card-title">jinyui</h5>
                        <h6 class="card-subtitle text-muted">jinyui 컴포넌트 테그를 이용하여 생성한 breadcrumb 입니다.</h6>
					</x-card-header>
					<x-card-body>
						<x-jinyui::nav.breadcrumb>
							<li class="breadcrumb-item active" aria-current="page">Home</li>
						</x-jinyui::nav.breadcrumb>

						<x-breadcrumb>
							<x-breadcrumb-item>
								<a href="#">Home</a>
							</x-breadcrumb-item>
							<x-breadcrumb-item class="active" aria-current="page">
								<a href="#">Home</a>
							</x-breadcrumb-item>
						</x-breadcrumb>

					</x-card-body>
				</x-card>
			</x-col-6>

			
		</x-row>



    </div>




</x-jinyui-theme>
