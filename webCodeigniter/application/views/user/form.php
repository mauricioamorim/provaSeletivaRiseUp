<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1 class="h3 mb-2 text-gray-800"><?php echo $form_title; ?></h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 alert-dark">
        <h6 class="m-0 font-weight-bold text-dark"><?php echo $form_description; ?></h6>
    </div>
    <div class="card-body">
		<?php echo $result; ?>

		<form class="form-group-sm my-basic-form-ajax" method="post" data-action="<?php echo $form_action; ?>">
			<div class="form-group col-sm-5">
				<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
			</div>
			<div class="form-group col-sm-5">
				Active
				<?php echo form_dropdown('active', [0=>"No", 1=>"Yes"],  set_value('active'), 'class ="form-control selectpicker form-control-sm"'); ?>
				<div class="text-danger"></div>
			</div>
			<div class="form-group col-sm-5">
				Name
				<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo set_value('name'); ?>" />
				<div class="text-danger"><?php echo form_error('name'); ?></div>
			</div>
			<div class="form-group col-sm-5">
				Email
				<input type="email" class="form-control form-control-sm" name="email" id="email" value="<?php echo set_value('email'); ?>" />
				<div class="text-danger"><?php echo form_error('email'); ?></div>
			</div>
			<div class="form-group col-sm-5">
				<button type="submit" class="btn btn-theme btn-lg btn-block alert-primary">Send</button>
			</div>
		</form>
	</div>
</div>
