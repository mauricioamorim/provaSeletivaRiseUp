<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple User CRUD - Rise Up</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url("") ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url("") ?>assets/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Rise Up Front-End </div>
      <div class="list-group list-group-flush">
        <a href="<?php echo base_url("") ?>" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="<?php echo base_url("user") ?>" class="list-group-item list-group-item-action bg-light">List</a>
        <a href="<?php echo base_url("user/create") ?>" class="list-group-item list-group-item-action bg-light">Create</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </nav>

      <div class="container-fluid">

				<?php echo $content ?>

			</div>
			
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo base_url("") ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url("") ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
		$( document ).ready(function() {
			$("#menu-toggle").click(function(e) {
				e.preventDefault();
				$("#wrapper").toggleClass("toggled");
			});

			//para deletar qulquer linha na view list ( exceto arquivos que foram uplodados )
			$('.delete').on('click',function(){
					$(".delete-confirm").attr("value", $(this).attr("value"));
			});
			$('.delete-confirm').on('click',function(){
					var action = $(".delete-confirm").attr("value");
					window.location.href = action;
			});
	 });
  </script>

</body>

</html>
