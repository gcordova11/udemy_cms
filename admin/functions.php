<?php


function confirmQuery($result)
{
	global $connection;
	if (!$result) {

		die("QUERY FAILED" . mysqli_error($connection));
	}
}


function insertCategories()
{
	global $connection;
	if (isset($_POST['submit'])) {

		$cat_title = $_POST['cat_title'];

		if ($cat_title == "" || empty($cat_title)) {

			echo "This field should not be empty";
		} else {

			$query = "INSERT INTO categories (cat_title) ";
			$query .= "VALUES ('{$cat_title}') ";

			$create_category_query = mysqli_query($connection, $query);

			if (!$create_category_query) {

				die('QUERY' . mysqli_error($connection));
			}
		}
	}
}

function findAllCategories()
{
	global $connection;
	$query = "SELECT * FROM categories";
	$select_categories = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($select_categories)) {
		$cat_title = $row['cat_title'];
		$cat_id = $row['cat_id'];
		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a href='categories.php?delete={$cat_id}'>DELETE</a></td>";
		echo "<td><a href='categories.php?edit={$cat_id}'>EDIT</a></td>";
		echo "</tr>";
	}
}

function deleteCategories()
{
	global $connection;
	if (isset($_GET['delete'])) {
		$get_cat_id = $_GET['delete'];
		$query = "DELETE FROM categories WHERE cat_id = {$get_cat_id} ";
		$delete_query = mysqli_query($connection, $query);
		header("Location: categories.php");
	}
}

function findAllPosts()
{
	global $connection;
	$query = "SELECT * FROM posts";
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

		echo "<tr>";
		echo "<td>{$post_id}</td>";
		echo "<td>{$post_author}</td>";
		echo "<td>{$post_title}</td>";
		
		$query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
		$select_categories_id = mysqli_query($connection, $query);
		while ($row = mysqli_fetch_assoc($select_categories_id)) {
			$cat_title = $row['cat_title'];
			$cat_id = $row['cat_id'];
			echo "<td>{$cat_title}</td>";
		}

		echo "<td>{$post_status}</td>";
		echo "<td><img width='100' src='../images/{$post_image}'></td>";
		echo "<td>{$post_tag}</td>";
		echo "<td>{$post_comment_count}</td>";
		echo "<td>{$post_date}</td>";
		echo "<td><a href ='posts.php?source=edit_post&p_id={$post_id}'>EDIT</a></td>";
		echo "<td><a href ='posts.php?delete={$post_id}'>DELETE</a></td>";
		echo "</tr>";
	}
}
