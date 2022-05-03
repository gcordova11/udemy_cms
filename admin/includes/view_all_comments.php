<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Author</th>
			<th>Comment</th>
			<th>Email</th>
			<th>Status</th>
			<th>In Response To</th>
			<th>Date</th>
			<th>Approve</th>
			<th>Unapprove</th>
			
		</tr>
	</thead>
	<tbody>
		<?php
		findAllComments();
		?>
	</tbody>
</table>

<?php

if (isset($_GET['delete'])) {
	$the_post_id = $_GET['delete'];

	$query = "DELETE FROM posts WHERE post_id = $the_post_id ";
	$delete_query = mysqli_query($connection, $query);
	header("Location: posts.php");
}
