<?php
if (isset($_GET['p_id'])) {
	$p_id = $_GET['p_id'];
}

$query = "SELECT * FROM posts WHERE post_id = $p_id ";
$select_posts = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_posts)) {
	$post_author = $row['post_author'];
	$post_id = $row['post_id'];
	$post_category_id = $row['post_category_id'];
	$post_title = $row['post_title'];
	$post_date = $row['post_date'];
	$post_image = $row['post_image'];
	$post_tag = $row['post_tag'];
	$post_comment_count = $row['post_comment_count'];
	$post_status = $row['post_status'];
	$post_content = $row['post_content'];
}

if (isset($_POST['update_post'])) {
	$post_author = $_POST['post_author'];
	$post_category_id = $_POST['post_category'];
	$post_title = $_POST['post_title'];
	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];
	$post_tag = $_POST['post_tag'];
	$post_status = $_POST['post_status'];
	$post_content = $_POST['post_content'];
	move_uploaded_file($post_image_temp, "../images/$post_image");

	if (empty($post_image)) {

		$query = "SELECT * FROM posts WHERE post_id = $p_id ";
		$select_image = mysqli_query($connection, $query);

		while ($row = mysqli_fetch_array($select_image)) {

			$post_image = $row['post_image'];
		}
	}

	$query = "UPDATE posts SET ";
	$query .= "post_title = '$post_title', ";
	$query .= "post_category_id = '$post_category_id', ";
	$query .= "post_date = now(), ";
	$query .= "post_author = '$post_author', ";
	$query .= "post_status = '$post_status', ";
	$query .= "post_tag = '$post_tag', ";
	$query .= "post_content = '$post_content', ";
	$query .= "post_image = '$post_image' ";
	$query .= "WHERE post_id = '$p_id' ";

	$update_post = mysqli_query($connection, $query);
	confirmQuery($update_post);
}


?>





<form action="" method="post" enctype="multipart/form-data">

	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="post_title" value="<?php echo $post_title; ?>">
	</div>

	<div class="form-group">
		<select name="post_category" id="">
			<?php
			$query = "SELECT * FROM categories";
			$select_categories_id = mysqli_query($connection, $query);
			confirmQuery($select_categories_id);
			while ($row = mysqli_fetch_assoc($select_categories_id)) {
				$cat_title = $row['cat_title'];
				$cat_id = $row['cat_id'];
				echo "<option value='$cat_id'>$cat_title</option>";
			}

			?>
		</select>

	</div>

	<div class="form-group">
		<label for="author">Post Author</label>
		<input type="text" class="form-control" name="post_author" value="<?php echo $post_author; ?>">
	</div>

	<div class="form-group">
		<label for="post_status">Post Status</label>
		<input type="text" class="form-control" name="post_status" value="<?php echo $post_status; ?>">
	</div>

	<div class="form-group">
		<img width="100" src="../images/<?php echo $post_image; ?>" alt="">
		<input type="file" class="form-control" name="image">

	</div>

	<div class="form-group">
		<label for="post_tag">Post Tags</label>
		<input type="text" class="form-control" name="post_tag" value="<?php echo $post_tag; ?>">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="update_post" value="Update Post">
	</div>



</form>