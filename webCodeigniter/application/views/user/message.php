<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1 class="h3 mb-2 text-gray-800"><?php echo $form_title; ?></h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3 alert-dark">
        <h6 class="m-0 font-weight-bold text-dark"><?php echo $form_description; ?></h6>
    </div>
    <div class="card-body text-center">
		<?php echo $result; ?>
	</div>
</div>
