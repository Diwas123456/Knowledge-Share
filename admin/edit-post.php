<?php include 'partials/header.php';
//fetch categories from database
$category_query = "SELECT * from categories ";
$categories = mysqli_query($connection, $category_query);

// fetch post data from database if id is set

if(isset($_GET['id']))
{
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * FROM posts where id =$id";
  $result = mysqli_query($connection, $query);
  $post = mysqli_fetch_assoc($result);

} else
{
  header('location: ' . ROOT_URL . 'admin/');
  die();
}

?>

<section class="form__section">
  <div class="container form__section-container">
    <h2>Edit Post</h2>
    
    <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="post">
      <input type="text" name="title" placeholder="Title" value="<?= $post['title']?>" />
      <input type="hidden" name="id" value="<?= $post['id']?>" />
      <input type="hidden" name="previous_thumbnail_name" value="<?= $post['thumbnail']?>" />
      <select name="category">
        <?php while($category = mysqli_fetch_assoc($categories)) : ?>
        <option value="<?= $category['id'] ?>"><?= $category['title']?></option>
        <?php endwhile ?>
        
      </select>
      <textarea name="body" rows="10" placeholder="Body"><?=$post['body']?></textarea>
      <?php if(isset($_SESSION['user_is_admin'])) : ?>
      <div class="form__control inline">
        <input type="checkbox" id="is_featured" name="is_featured" value="1" checked>
        <label for="is_featured" >Featured</label>
       
        
      </div>
<?php endif?>
      <div class="form__control">
        
        <label for="thumbnail" >Change Thumbnail</label>
        <input type="file" name="thumbnail" id="thumbnail">
      </div>
      
      
      
      <button type="submit" name="submit" class="btn">Update Post</button>
      </form>
  </div>
</section>




<?php include '../partials/footer.php'?>