<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Drivers</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url('drivers');?>">Drivers</a>
						</li>
						<li class="breadcrumb-item active">create new driver</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						<form class="user" id="validate" method="post" novalidate="novalidate"
							action="<?php echo base_url('driver');?>">
							<div class="form-group">
								<label htmlFor="firstname">First name</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('firstname')): echo "is-invalid"; endif;?>"
									id="firstname" name="firstname" required pattern="^[A-Za-z0-9 ]{2,50}$"
									placeholder="Enter firstname" autofocus=""
									value="<?php echo set_value('firstname');?>" />
								<span class="is-invalid"><?php echo form_error('firstname');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="lastname">Last name</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('lastname')): echo "is-invalid"; endif;?>"
									id="lastname" name="lastname" required placeholder="Enter lastname"
									value="<?php echo set_value('lastname');?>" />
								<span class="is-invalid"><?php echo form_error('lastname');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="phone">Phone</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('phone')): echo "is-invalid"; endif;?>"
									id="phone" name="phone" required placeholder="Enter phone"
									value="<?php echo set_value('phone');?>" />
								<span class="is-invalid"><?php echo form_error('phone');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="vehicle">Vehicle</label>
								<select class="form-control" name="vehicle_id" id="vehicle_id" required>
									<option value="">choose vehicle</option>
									<?php foreach($vehicle as $row):?>
									<option value="<?php echo $row['vehicle_id']?>"><?php echo $row['vehicle'];?>
									</option>
									<?php endforeach ;?>
								</select>
								<span class="is-invalid"><?php echo form_error('vehicle_id');?></span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-teal btn-sm">
									Create
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
			phone: {
				required: true,
				pattern: /^(?:256|\+256|(0)?7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/
			},
			vehicle_id: {
				required: true,
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
			phone: {  
				required: "The phone number field is required",
				pattern: "Provide a valid phone number"
			},
			vehicle_id: {
				required: "The  vehicle field is required",
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
