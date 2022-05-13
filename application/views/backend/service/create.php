<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Service</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="<?php echo base_url('service-list');?>">Service</a>
						</li>
						<li class="breadcrumb-item active">create new service</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						<form class="user" id="validate" method="post" novalidate="novalidate"
							action="<?php echo base_url('service');?>" enctype="multipart/form-data">
							<div class="form-group">
								<label htmlFor="vehicle">Vehicle</label>
								<select class="form-control" name="vehicle_id" id="vehicle_id" required>
									<option value="">choose vehicle</option>
									<?php foreach($vehicles as $row):?>
									<option value="<?php echo $row['vehicle_id']?>">
										<?php echo $row['vehicle'];?>
									</option>
									<?php endforeach ;?>
								</select>  
								<span class="is-invalid"><?php echo form_error('vehicle_id');?></span>
							</div>
							<div class="form-group">
								<label htmlFor="service">Service task</label>
								<input type="text"
									class="form-control form-control-user <?php if(form_error('service')): echo "is-invalid"; endif;?>"
									id="service" name="service" required placeholder="Enter service task"
									value="<?php echo set_value('service');?>" />
								<span class="is-invalid"><?php echo form_error('service');?></span>
							</div>
                            <div class="form-group">
                            	<label htmlFor="amount">Amount</label>
                            	<input type="text"
                            		class="form-control form-control-user <?php if(form_error('amount')): echo "is-invalid"; endif;?>"
                            		id="amount" name="amount" required placeholder="Enter amount"
                            		value="<?php echo set_value('amount');?>" />
                            	<span class="is-invalid"><?php echo form_error('amount');?></span>
                            </div>
                            <div class="form-group">
                            	<label htmlFor="vendor">Vendor</label>
                            	<select class="form-control" name="vendor_id" id="vendor_id" required>
                            		<option value="">choose vendor</option>
                            		<?php foreach($vendors as $row):?>
                            		<option value="<?php echo $row['vendor_id']?>">
                            			<?php echo $row['vendor'];?>
                            		</option>
                            		<?php endforeach ;?>
                            	</select>
                            	<span class="is-invalid"><?php echo form_error('vehicle_id');?></span>
                            </div>
                            <div class="form-group">
                            	<label htmlFor="comment">Comment</label>
                            	<input type="text"
                            		class="form-control form-control-user <?php if(form_error('comment')): echo "is-invalid"; endif;?>"
                            		id="comment" name="comment" required placeholder="Enter comment"
                            		value="<?php echo set_value('comment');?>" />
                            	<span class="is-invalid"><?php echo form_error('comment');?></span>
                            </div>
							<div class="form-group">
								<img src="<?php echo base_url('assets/uploads/receipts/noimage.png');?>" alt="receipt"
									class="" id="receiptImg" width="200" height="210">
								<input type="file" id="image" name="userfile" style="display: none;"
									accept=".jpg,.jpeg,.png,.gif" required />
								<div class="col-md-12 text-center">
									<div class="row ml-3">
										<div class="mt-2">
											<a href="javascript:receiptImg()">upload receipt</a>
											<a class="text-danger ml-1" href="javascript:DeleteImage()">remove</a>
										</div>
									</div>
								</div>
								<span class="text-danger ml-4" id="imageerror"></span>
								<span class="is-invalid"><?php echo form_error('image');?></span>
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
	function receiptImg() {
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
				$('#receiptImg').attr('src', e.target.result);
				$('#imageerror').text('')
			};
		}
	}

	function DeleteImage() {
		$('#receiptImg').attr('src', '<?php echo base_url('assets/uploads/receipts/noimage.png');?>');
		$('#imageerror').text('')
	}
</script>
<script>
	$('#validate').validate({
		rules: {
			vehicle_id: {
				required: true,
			},
			service: {
				required: true,
			},
			amount: {
				required: true,
			},
            vendor_id: {
                required: true,
            },
            comment: {
                required: true,
            },

		},
		messages: {
			vehicle_id: {
				required: "The vehicle field is required",
			},
			service: {
			    required: "The service field is required",
			},
            amount: {
                required: "The amount field is required",
            },
            vendor_id: {
                required: "The vendor field is required",
            },
            comment: {
                required: "The comment field is required",
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
