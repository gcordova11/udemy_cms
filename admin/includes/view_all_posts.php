<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Author</th>
			<th>Title</th>
			<th>Category</th>
			<th>Status</th>
			<th>Image</th>
			<th>Tags</th>
			<th>Comments</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		<?php
		findAllPosts();
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
