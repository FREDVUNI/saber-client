<div class="content-wrapper" style="min-height:540.031px">
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h4 class="m-0 text-muted">Departments</h4>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        	<a href="<?php echo base_url('departments');?>">Departments</a>
                        </li>
						<li class="breadcrumb-item active">create new department</li>
					</ol>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<section class="content">
				<div class="card card-earnings">
					<div class="p-2 card">
						 <form class="user" id="validate" method="post" novalidate="novalidate"
						 	action="<?php echo base_url('department');?>">
						 	<div class="form-group">
						 		<label htmlFor="department">Department</label>
						 		<input type="text"
						 			class="form-control form-control-user <?php if(form_error('department')): echo "is-invalid"; endif;?>"
						 			id="department" name="department" required pattern="^[A-Za-z0-9 ]{2,50}$" 
						 			placeholder="Enter department" autofocus="" value="<?php echo set_value('department');?>"/>
						 		<span class="is-invalid"><?php echo form_error('department');?></span>
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
			department: {
				required: true,
				pattern: /^[A-Za-z0-9 ]{2,50}$/
			},
		},
		messages: {
			department: {
				required: "The department field is required",
				pattern: "Provide a valid department"
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
