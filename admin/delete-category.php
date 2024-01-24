<?php
require 'config/database.php';

if(isset($_GET['id']))
{
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  // update category_id of posts that belog to this category to id of uncategorized category
  //For later

$update_query = "UPDATE posts set category_id=7 where category_id = $id";
$update_result = mysqli_query($connection, $update_query);


if(!mysqli_errno($connection)){
//delete category
$query = "DELETE FROM categories WHERE id=$id LIMIT 1";
$result = mysqli_query($connection, $query);
$_SESSION['delete-category-success'] = "Category deleted sucessfully";

}
}
header('location: ' . ROOT_URL . 'admin/manage-categories.php');
?>