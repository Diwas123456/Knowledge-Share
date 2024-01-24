<?php
include './partials/header.php';
//fetch featured post from database
$featured_query = "SELECT * from posts where is_featured = 1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);

//fetch 9 posts from posts table

$query = "SELECT * from posts order by date_time DESC limit 9";
$posts = mysqli_query($connection, $query);
?>

    <!-- End of Nav -->
<?php if(mysqli_num_rows($featured_result)==1) :?>
    <section class="featured">
<div class="container featured__container">
  <div class="post__thumbnail">
    <img src="./images/<?=$featured['thumbnail']?>" alt="">
  </div>
  <div class="post_info">
    <?php
    //fetch data from categories table using category_id of post
    $category_id = $featured['category_id'];
    $category_query = "SELECT * from categories where id=$category_id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
    $category_title = $category['title'];
    ?>
    <a href="<?=ROOT_URL?>category-posts.php?id=<?=$category['id']?>" class="category__button"><?=$category_title?></a>
    <h2 class="post__title"><a href="<?= ROOT_URL?>post.php?id=<?= $featured['id']?>"><?= $featured['title']?></a></h2>
<p class="post__body">
  <?= substr($featured['body'], 0, 300) ?>...
</p>
<div class="post__author">
<?php 
//fetch author from users table using author_id

$author_id = $featured['author_id'];
$author_query = "SELECT * FROM users where id=$author_id";
$author_result = mysqli_query($connection,$author_query);
$author = mysqli_fetch_assoc($author_result);
?>

  <div class="post__author-avatar">
    <img src="./images/<?=$author['avatar']?>">
  </div>

  <div class="post__author-info">
    <h5>By: <?= "{$author['firstname']} {$author['lastname']}"?></h5>
    <small><?=date("M d, Y - H:i ", strtotime($featured['date_time']))?></small>
  </div>
</div>
  </div>
</div>

    </section>
<?php endif ?>
    <!-- End Of featured -->

    <section class="posts <?= $featured ? '' : 'section__extra-margin'?>">
      <div class="container posts__container">
        <?php while($post = mysqli_fetch_assoc($posts)) :?>
        <article class="post">
          <div class="post__thumbnail">
            <img src="./images/<?=$post['thumbnail']?>" alt="">
          </div>

          <div class="post__info">
          <?php
    //fetch data from categories table using category_id of post
    $category_id = $post['category_id'];
    $category_query = "SELECT * from categories where id=$category_id";
    $category_result = mysqli_query($connection, $category_query);
    $category = mysqli_fetch_assoc($category_result);
    $category_title = $category['title'];
    ?>
            <a href="<?= ROOT_URL?>category-posts.php?id=<?=$post['category_id']?>" class="category__button">
              <?= $category_title ?>
            </a>
            <h3 class="post__title"><a href="<?= ROOT_URL?>post.php?id=<?=$post['id']?>"><?= $post['title']?></a></h3>
              <p class="post__body">
              <?= substr($post['body'], 0, 150) ?>...
              </p>
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
          </div>
        </article>
<?php endwhile ?>
      </div>
    </section>
<!------------------ End Of Posts ----------------------->

<section class="category__buttons">
  <div class="container category__buttons-container">
    <?php $all_categories = "SELECT * from categories";
    $all_categories = mysqli_query($connection, $all_categories );
    ?>
    <?php while($category = mysqli_fetch_assoc($all_categories)) :?>
    <a href="<?= ROOT_URL ?>category-posts.php?id=<?=$category['id']?>" class="category__button"><?= $category['title']?></a>
    <?php endwhile ?>
    </div>
</section>
    <!-- End of cTEGORY BUTTONS -->

    <?php 
    include './partials/footer.php';
    ?>
   
