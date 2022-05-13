<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">User</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url('users');?>">Users</a>
						</li>
						<li class="breadcrumb-item active"><?php echo $users['firstname'];?></li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						<form class="user" id="validate" method="post" novalidate="novalidate"
							action="<?php echo base_url("user/".$users['user_id']);?>">
                            <input type="hidden" name="id" value="<?php echo $users['user_id'];?>" />
							<div class="form-group">
								<label htmlFor="firstname">First name</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('firstname')): echo "is-invalid"; endif;?>"
									id="firstname" name="firstname" required pattern="^[A-Za-z0-9 ]{2,50}$"
									placeholder="Enter firstname" autofocus=""
									value="<?php echo $users['firstname'];?>" />
								<span class="is-invalid"><?php echo form_error('firstname');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="lastname">Last name</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('lastname')): echo "is-invalid"; endif;?>"
									id="lastname" name="lastname" required placeholder="Enter lastname"
									value="<?php echo $users['lastname'];?>" />
								<span class="is-invalid"><?php echo form_error('lastname');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="email">Email</label>
								<input type="email"
									class="form-control form-control-user <?php if(form_error('email')): echo "is-invalid"; endif;?>"
									id="email" name="email" required placeholder="Enter email address"
									value="<?php echo $users['email'];?>" />
								<span class="is-invalid"><?php echo form_error('email');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="department">Department</label>
								<select class="form-control" name="department_id" id="department_id" required>
									<option value="<?php echo $users['department_id'];?>"><?php echo $users['department'];?></option>
									<?php foreach($departments as $row):?>
									<option value="<?php echo $row['id']?>"><?php echo $row['department'];?>
									</option>
									<?php endforeach ;?>
								</select>
								<span class="is-invalid"><?php echo form_error('vehicle_id');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="phone">Phone</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('phone')): echo "is-invalid"; endif;?>"
									id="phone" name="phone" required placeholder="Enter phone"
									value="<?php echo $users['phone'];?>" />
								<span class="is-invalid"><?php echo form_error('phone');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="password">Password</label>
								<input type="password"
									class="form-control form-control-user <?php if(form_error('password')): echo "is-invalid"; endif;?>"
									id="password" name="password" required placeholder="Enter password"
									value="<?php echo $users['password'];?>" />
								<span class="is-invalid"><?php echo form_error('password');?></span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-teal btn-sm">
									update
								</button>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<script src="<?php echo base_url("assets/backend/plugins/jquery/jquery.min.js");?>"></script>
<script src="<?php echo base_url("assets/backend/plugins/jquery/jquery.validate.min.js");?>"></script>
<script src="<?php echo base_url("assets/backend/plugins/jquery/additional-methods.min.js");?>"></script>
<script>
	$('#validate').validate({
		rules: {
			firstname: {
				required: true,
				pattern: /^[A-Za-z0-9 ]{2,50}$/
			},
			lastname: {
				required: true,
				pattern: /^[A-Za-z0-9 ]{2,50}$/
			},
			email: {
				required: true,
				email: true
			},
			department_id: {
				required: true,
			},
			password: {
				required: true,
			},
			phone: {
				required: true,
				pattern: /^(?:256|\+256|(0)?7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/
			},

		},
		messages: {
			firstname: {
				required: "The first name field is required",
				pattern: "Provide a valid first name"
			},
			lastname: {
				required: "The last name field is required",
				pattern: "Provide a valid last name"
			},
			email: {
				required: "The email field is required",
				email: "Provide a valid email"
			},
			department_id: {
				required: "The  department field is required",
			},
			password: {
				required: "The password field is required",
			},
			phone: {
				required: "The phone number field is required",
				pattern: "Provide a valid phone number"
			},
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.form-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
		}
	});
</script>
