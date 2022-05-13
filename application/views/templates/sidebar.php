<aside class="main-sidebar sidebar-dark-primary">
	<div class="text-center">
		<a href="#" class="logo-image">
			<img src="<?php echo base_url('assets/backend/images/saba.png')?>" alt="Saber Logo" class="brand-image" />
		</a>
	</div>
	<div class="sidebar">
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?php echo base_url('assets/backend/images/user.jpg')?>" class="img-circle elevation-2 mt-2"
					alt="User" />
			</div>
			<div class="info">
				<a href="<?php echo base_url("profile"); ?>" class="d-block"><?php echo $user['username'];?></a>
				<a href="<?php echo base_url("profile"); ?>" class=""><?php echo $user['organisation'];?></a>
			</div>
		</div>
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<li class="nav-header">DASHBOARD</li>
				<li class="nav-item">
					<a href="<?php echo base_url("dashboard"); ?>"
						class="nav-link  <?php echo (current_url() == base_url("dashboard"))?"active":"";?>">
						<i class="nav-icon fas fa-tachometer-alt"></i>
						<p>
							Dashboard
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("bookings"); ?>"
						class="nav-link  <?php echo (current_url() == base_url("bookings"))?"active":"";?>">
						<i class="nav-icon fas fa-fw fa-folder"></i>
						<p>
							Bookings
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("drivers"); ?>"
						class="nav-link  <?php echo (current_url() == base_url("drivers"))?"active":"";?>">
						<i class="nav-icon fas fa-male"></i>
						<p>
							Drivers
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("vehicles"); ?>"
						class="nav-link <?php echo (current_url() == base_url("vehicles"))?"active":"";?>">
						<i class="nav-icon fas fa-car"></i>
						<p>
							Vehicles
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("vehicle-types"); ?>"
						class="nav-link  <?php echo (current_url() == base_url("vehicle-types"))?"active":"";?>">
						<i class="nav-icon fas fa-taxi"></i>
						<p>
							Vehicle types
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("users"); ?>"
						class="nav-link <?php echo (current_url() == base_url("users"))?"active":"";?>">
						<i class="nav-icon fas fa-users"></i>
						<p>
							Users
						</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link  <?php echo (current_url() == base_url("service-list"))?"active":"";?>">
						<i class="nav-icon fas fa-th"></i>
						<p>
							Services
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url("service-list"); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>service list</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("service-history"); ?>"
								class="nav-link <?php echo (current_url() == base_url("service-history"))?"active":"";?>">
								<i class="far fa-circle nav-icon"></i>
								<p>service history</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url("service-tasks"); ?>"
								class="nav-link <?php echo (current_url() == base_url("service-tasks"))?"active":"";?>">
								<i class="far fa-circle nav-icon"></i>
								<p>service tasks</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("departments"); ?>"
						class="nav-link <?php echo (current_url() == base_url("departments"))?"active":"";?>">
						<i class="nav-icon fas fa-people-carry"></i>
						<p>
							Departments
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("vendors"); ?>"
						class="nav-link <?php echo (current_url() == base_url("vendors"))?"active":"";?>">
						<i class="nav-icon fas fa-clipboard"></i>
						<p>vendors</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url("admins"); ?>"
						class="nav-link <?php echo (current_url() == base_url("admins"))?"active":"";?>">
						<i class="nav-icon fas fa-user"></i>
						<p>
							Admins
						</p>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</aside>
