<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
						<div class="col-sm-4">
							<a href="#">	
								<div class="card bg-warning">
										<div class="card-body">
											<h5 class="main-page-card-h5">Total Categories <i class="fa fa-tags"></i> <span class="badge badge-danger pull-right" style="font-size: 20px;">{{ $categoryCount}}</span></h5>
										</div>
								</div>
							</a>
							</div>
							<div class="col-sm-4">
							<a href="#">	
								<div class="card bg-warning">
										<div class="card-body">
											<h5 class="main-page-card-h5">Total Brands <i class="fa fa-shopping-bag"></i> <span class="badge badge-danger pull-right" style="font-size: 20px;">{{ $brandCount}}</span></h5>
										</div>
								</div>
							</a>
							</div>
							<div class="col-sm-4">
							<a href="#">	
								<div class="card bg-warning">
										<div class="card-body">
											<h5 class="main-page-card-h5">Total products <i class="fa fa-database"></i> <span class="badge badge-danger pull-right" style="font-size: 20px;">{{ $brandCount}}</span></h5>
										</div>
								</div>
							</a>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		{{-- cahrts below --}}
		<div class="row">
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						
						<h5>Monthly Sale</h5>
							{!! $chartjs->render() !!}
					

					</div>
				</div>
			</div>

			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						
						<h5>Weekly Sale</h5>
							{!! $chartjs->render() !!}
					

					</div>
				</div>
			</div>

		</div>

	</div>
</div>
      