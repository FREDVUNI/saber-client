<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Vehicles</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="dashboard">Home</a>
						</li>
						<li class="breadcrumb-item active">Vehicles</li>
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
				<?php echo $this->session->flashdata('message');?>
				<div class="card card-earnings">
					<div class="p-2 card">
						<div class="mb-3">
							<a href="<?php echo base_url('vehicle');?>">
								<button class="btn btn-teal btn-sm float-right">
									Add vehicle
								</button>
							</a>
						</div>
						<table id="example1" class="table table-bordered">
							<thead>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Vehicle</th>
									<th>Vehicle type</th>
									<th>Status</th>
									<th>License plate</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($vehicle as $key=>$row): ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><img src="<?php echo $row['image']; ?>" width="20px" height="20px"/></td>
									<td><?php echo word_limiter($row['vehicle'],3); ?></td>
									<td><?php echo word_limiter($row['vehicletype'],3); ?></td>
									<td><?php echo $row['status']; ?></td>
									<td><?php echo $row['license_plate']; ?></td>
									<td>
										<a class="btn btn-light btn-sm" href="<?php echo 'vehicle/'.$row['vehicle_id']; ?>">
											<i class="fa fa-pencil-alt"></i>
										</a>
										<button class="btn btn-light btn-sm" data-toggle="modal"
											data-target="#delete<?php print $row['vehicle_id']; ?>">
											<i class="fa fa-trash"></i>
										</button>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Image</th>
									<th>Vehicle</th>
									<th>Vehicle type</th>
									<th>Status</th>
									<th>License plate</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php foreach($vehicle as $key=>$row): ?>
<div class="modal" id="delete<?php echo $row['vehicle_id'];?>">
	<div class="modal-dialog modal-confirm" role="document">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="fa fa-exclamation"></i>
				</div>
				<h4 class="modal-title w-100">Are you sure?</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>
					Do you really want to delete the vehicle
					<strong><?php echo $row['vehicle']; ?> </strong>?
					<br>
					This process cannot be undone.
				</p>
			</div>
			<div class="modal-footer justify-content-center mb-3">
				<?php echo form_open_multipart('vehicle/'.$row['vehicle_id'].'/delete');?>
				<input type="hidden" name="id" value="<?php echo $row['vehicle_id'];?>">
				<input type="hidden" name="old_image" value="<?php echo $row['image'];?>">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>
<?php endforeach;?>
