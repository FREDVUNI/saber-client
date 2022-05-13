<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Dashboard</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="/">Home</a>
						</li>
						<li class="breadcrumb-item active">Dashboard</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="row font-1">
					<div class="col-lg-4">
						<div class="card card-body flex-row align-items-center">
							<h5 class="m-0"><i class="material-icons align-middle text-muted md-18"></i><i
									class="nav-icon fas fa-male fa-2x"></i> Drivers</h5>
							<h4 class="font-primary ml-auto"><?php echo $drivers;?></h4>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card card-body flex-row align-items-center">
							<h5 class="m-0"><i class="material-icons align-middle text-muted md-18"></i><i
									class="nav-icon fas fa-users fa-2x"></i> users</h5>
							<h4 class="font-primary ml-auto"><?php echo $users;?></h4>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="card card-body flex-row align-items-center">
							<h5 class="m-0"><i class="material-icons align-middle text-muted md-18"></i><i
									class="nav-icon fas fa-people-carry fa-2x"></i> Departments</h5>
							<h4 class="font-primary ml-auto"><?php echo $departments;?></h4>
						</div>
					</div>
				</div>
				<div class="card card-earnings">
					<div class="card-group">
						<div class="card">
							<div class="card-body feather-icon-block text-center">
								<i class="nav-icon fas fa-car fa-2x"></i>
								<div>
									<span>Vehicles</span>
								</div>
								<h4 class="font-primary mb-0"><span class="counter"><?php echo $vehicles;?></span></h4>
							</div>
						</div>
						<div class="card">
							<div class="card-body feather-icon-block text-center">
								<i class="nav-icon fas fa-car fa-2x"></i>
								<div>
									<span>Booked</span>
								</div>
								<h4 class="font-primary mb-0"><span class="counter"><?php echo $booked;?></span></h4>
							</div>
						</div>
						<div class="card">
							<div class="card-body feather-icon-block text-center">
								<i class="nav-icon fas fa-car fa-2x"></i>
								<div>
									<span>Available</span>
								</div>
								<h4 class="font-primary mb-0"><span class="counter"><?php echo $available;?></span></h4>
							</div>
						</div>
					</div>
					<div class="p-2 card">
						<section class="col-lg-12 connectedSortable">
							<div class="p-2 bg-primarys">
								<div id="morris-area-chart" style="width: 100%; height: 250px;"></div>
							</div>
						</section>
					</div>   
				</div>
			</section>
		</div>
	</div>
</div>
