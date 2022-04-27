<?php
include "includes/admin_header.php";
include "functions.php";
ob_start();
?>

<div id="wrapper">



	<!-- Navigation -->
	<?php include "includes/admin_navigation.php"; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">
						Welcome To Admin
						<small>Author</small>
					</h1>
				</div>
			</div>

			<div class="col-xs-g">
				<?php
				insertCategories();
				?>

				<form action="" method="post">
					<div class="form-group">
						<label for="cat_title">Add Category</label>
						<input class="form-control" type="text" name="cat_title">

					</div>
					<div class="form-group">
						<input class="btn btn-primary" type="submit" name="submit" value="Add Category">

					</div>

				</form>

				<?php
				// UPDATE AND INCLUDE
				if (isset($_GET['edit'])) {
					$cat_id = $_GET['edit'];
					include "includes/update_categories.php";
				}
				?>

			</div>

			<div class="col-xs-6">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>ID</th>
							<th>Category Title</th>
						</tr>
					</thead>
					<tbody>
						<?php
						// Find all categories query
						findAllCategories();
						//DELETE QUERY
						deleteCategories();
						?>

					</tbody>
				</table>
			</div>



			<!-- /.row -->


			<!-- /.container-fluid -->

		</div>
		<!-- /#page-wrapper -->

		<?php include "includes/admin_footer.php"; ?>