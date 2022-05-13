<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Vendor</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url('vendors');?>">Vendor</a>
						</li>
						<li class="breadcrumb-item active">create new vendor</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						<form class="user" id="validate" method="post" novalidate="novalidate"
							action="<?php echo base_url('vendor');?>">
							<div class="form-group">
								<label htmlFor="vendor">vendor</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('vendor')): echo "is-invalid"; endif;?>"
									id="vendor" name="vendor" required placeholder="Enter vendor"
									value="<?php echo set_value('vendor');?>" />
								<span class="is-invalid"><?php echo form_error('vendor');?></span>
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
								<label htmlFor="email">Email</label>
								<input type="email"
									class="form-control form-control-user <?php if(form_error('email')): echo "is-invalid"; endif;?>"
									id="email" name="email" required placeholder="Enter email address"
									value="<?php echo set_value('email');?>" />
								<span class="is-invalid"><?php echo form_error('email');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="website">Website</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('website')): echo "is-invalid"; endif;?>"
									id="website" name="website" required placeholder="Enter website"
									value="<?php echo set_value('website');?>" />
								<span class="text-danger"><?php echo form_error('website');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="contactPerson">Contact person</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('contactPerson')): echo "is-invalid"; endif;?>"
									id="contactPerson" name="contactPerson" required placeholder="Enter contactPerson"
									value="<?php echo set_value('contactPerson');?>" />
								<span class="is-invalid"><?php echo form_error('contactPerson');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="location">Location</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('location')): echo "is-invalid"; endif;?>"
									id="location" name="location" required placeholder="Enter location"
									value="<?php echo set_value('location');?>" />
								<span class="is-invalid"><?php echo form_error('location');?></span>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-teal btn-sm">
									create
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
			phone: {
				required: true,
				pattern: /^(?:256|\+256|(0)?7(?:(?:[0127589][0-9])|(?:0[0-8])|(4[0-1]))[0-9]{6})$/
			},
			location: {
				required: true,
			},
			website: {
				required: true,
			},
			vendor: {
				required: true,
			},
			contactPerson: {
				required: true,
			},
			email: {
				required: true,
			},

		},
		messages: {
			phone: {
				required: "The phone number field is required",
				pattern: "Provide a valid phone number"
			},
			vendor: {
				required: "The vendor field is required",
			},
			location: {
				required: "The location field is required",
			},
			email: {
				required: "The email field is required",
				email: "The email is invalid"
			},
			contactPerson: {
				required: "The contact Person field is required",
			},
			website: {
				required: "The website field is required",
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
