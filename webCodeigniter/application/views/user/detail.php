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

		<form class="form-group-sm my-basic-form-ajax" method="post" data-action="#">
			<div class="form-group col-sm-5">
				<input type="hidden" name="id" id="id" value="<?php echo $id ?>" />
			</div>
			<div class="form-group col-sm-5">
				Active
				<p><?php echo (set_value('active')==0)?"No":"Yes"; ?> </p>
				<div class="text-danger"></div>
			</div>
			<div class="form-group col-sm-5">
				Name
				<p><?php echo set_value('name'); ?> </p>
				<div class="text-danger"><?php echo form_error('name'); ?></div>
			</div>
			<div class="form-group col-sm-5">
				Email
				<p><?php echo set_value('email'); ?> </p>
				<div class="text-danger"><?php echo form_error('email'); ?></div>
			</div>
			<div class="form-group col-sm-5">
				Created at
				<p><?php echo set_value('created_at'); ?> </p>
				<div class="text-danger"><?php echo form_error('created_at'); ?></div>
			</div>
			<div class="form-group col-sm-5">
				Updated at
				<p><?php echo set_value('updated_at'); ?> </p>
				<div class="text-danger"><?php echo form_error('updated_at'); ?></div>
			</div>
			<div class="form-group col-sm-5">
				<a href="<?php echo $form_action; ?>" type="buton" class="btn btn-theme btn-lg btn-block alert-primary">Edit</a>
			</div>
		</form>
	</div>
</div>
