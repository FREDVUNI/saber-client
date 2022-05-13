<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Vehicle type</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url('vehicle-types');?>">Vehicle types</a>
						</li>
						<li class="breadcrumb-item active"><?php echo $vehicle['vehicle'];?></li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						<form class="user" id="validate" method="post" novalidate="novalidate"
							action="<?php echo base_url("vehicle/".$vehicle['vehicle_id']);?>">
                            <input type="hidden" name="id" value="<?php echo $vehicle['vehicle_id'];?>" />
							<div class="form-group">
								<label htmlFor="vehicle">Vehicle</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('vehicle')): echo "is-invalid"; endif;?>"
									id="vehicle" name="vehicle" required pattern="^[A-Za-z0-9 ]{2,50}$"
									placeholder="Enter vehicle" autofocus=""
									value="<?php echo $vehicle['vehicle'];?>" />
								<span class="is-invalid"><?php echo form_error('vehicle');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="vehicletype">Vehicle type</label>
								<select class="form-control" name="vehicletype_id" id="vehicletype_id" required>
									<option value="<?php echo $vehicle['vehicletype_id']?>"><?php echo $vehicle['vehicletype'];?></option>
									<?php foreach($vehicletype as $row):?>
									<option value="<?php echo $row['vehicletype_id']?>">
										<?php echo $row['vehicletype'];?>
									</option>
									<?php endforeach ;?>
								</select>
								<span class="is-invalid"><?php echo form_error('vehicletype_id');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="license_plate">Number Plate</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('license_plate')): echo "is-invalid"; endif;?>"
									id="license_plate" name="license_plate" required placeholder="Enter license plate"
									value="<?php echo $vehicle['license_plate']?>" />
								<span class="is-invalid"><?php echo form_error('license_plate');?></span>
							</div>
							<div class="form-group">
								<img src="<?php echo base_url($vehicle['image']);?>"
									alt="vehicle"
									class="" id="vehicleImg" width="200" height="210">
								<input type="file" id="image" name="userfile" style="display: none;"
									accept=".jpg,.jpeg,.png,.gif" required />
								<div class="col-md-12 text-center">
									<div class="row ml-3">
										<div class="mt-2">
											<a href="javascript:vehicleImg()">change image</a>
											<a class="text-danger ml-3" href="javascript:DeleteImage()">Remove</a>
										</div>
									</div>
								</div>
								<span class="text-danger ml-4" id="imageerror"></span>
								<span class="is-invalid"><?php echo form_error('image');?></span>
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
	function vehicleImg() {
		$('#image').click();
	}
	$('#image').change(function () {
		var imgLivePath = this.value;
		var img_extions = imgLivePath.substring(imgLivePath.lastIndexOf('.') + 1).toLowerCase();
		if (img_extions == "gif" || img_extions == "png" || img_extions == "jpg" || img_extions == "jpeg")
			readURL(this);
		else
			$('#imageerror').text('Please select a valid image file.')
	});

	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.readAsDataURL(input.files[0]);
			reader.onload = function (e) {
				$('#vehicleImg').attr('src', e.target.result);
				$('#imageerror').text('')
			};
		}
	}

	function DeleteImage() {
		$('#vehicleImg').attr('src', '<?php echo $vehicle['image'];?>');
		$('#imageerror').text('')
	}
</script>
<script>
	$('#validate').validate({
		rules: {
			vehicle: {
				required: true,
				pattern: /^[A-Za-z0-9 ]{2,50}$/
			},
			license_plate: {
				required: true,
				pattern: /^[A-Za-z0-9 ]{2,8}$/
			},
			vehicletype_id: {
				required: true,
			},

		},
		messages: {
			vehicle: {
				required: "The vehicle field is required",
				pattern: "Provide a valid vehicle"
			},
			license_plate: {
				required: "The number plate field is required",
				pattern: "Provide a valid number plate"
			},
			vehicletype_id: {
				required: "The  vehicle type field is required",
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
