<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Vehicle Type</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url('vehicle-types');?>">Vehicle types</a>
						</li>
						<li class="breadcrumb-item active">create new vehicle type</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						<form class="user" id="validate" method="post" novalidate="novalidate"
							action="<?php echo base_url('vehicle-type');?>">
							<div class="form-group">
								<label htmlFor="vehicletype">vehicle type</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('vehicletype')): echo "is-invalid"; endif;?>"
									id="vehicletype" name="vehicletype" required pattern="^[A-Za-z0-9 ]{2,50}$"
									placeholder="Enter vehicletype" autofocus=""
									value="<?php echo set_value('vehicletype');?>" />
								<span class="is-invalid"><?php echo form_error('vehicletype');?></span>
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
			vehicletype: {
				required: true,
				pattern: /^[A-Za-z0-9 ]{2,50}$/
			},
		},
		messages: {
			vehicletype: {
				required: "The vehicle type field is required",
				pattern: "Provide a valid vehicle type"
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
