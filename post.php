<?php include './partials/header.php';
//fetch post from database if id is set

if(isset($_GET['id']))
{
  $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);
  $query = "SELECT * from posts where id=$id";
  $result = mysqli_query($connection, $query);
  $post  =  mysqli_fetch_assoc($result);
}

?>

    <!-- End of Nav -->
<section class="singlepost">
  <div class="container singlepost__container">
    <h2><?=$post['title']?></h2>
    <!-- <div class="post__author">
      <div class="post__author-avatar">
        <img src="./images/avatar2.jpg">
      </div>
    
      <div class="post__author-info">
        <h5>By: Jane Doe</h5>
        <small>June 10, 2022 - 07:23</small>
      </div>
    </div> -->
    <div class="post__author">
              <?php 
//fetch author from users table using author_id

$author_id = $post['author_id'];
$author_query = "SELECT * FROM users where id=$author_id";
$author_result = mysqli_query($connection,$author_query);
$author = mysqli_fetch_assoc($author_result);
?>

                <div class="post__author-avatar">
                  <img src="./images/<?=$author['avatar']?>">
                </div>
                <div class="post__author-info">
                  <h5>By: <?= "{$author['firstname']} {$author['lastname']}"?></h5>
                  <small><?=date("M d, Y - H:i ", strtotime($post['date_time']))?></small>
                </div>
              </div>
    <div class="singlepost__thumbnail">
      <img src="./images/<?= $post['thumbnail']?>" alt="">
    </div>
    <p>
    <?= $post['body']?>
    </p>
    
  </div>
</section>
    
    <!-- End OF SINGLE POST -->

    
<!------------------ End Of Posts ----------------------->


    <!-- End of CATEGORY BUTTONS -->

    <?php include './partials/footer.php' ?>
