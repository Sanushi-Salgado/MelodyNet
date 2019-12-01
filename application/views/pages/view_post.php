<!-- Top Navigation -->
<?php include_once(APPPATH .  'views/templates/top_navigation.php'); ?>

<!-- Page Content -->
<div class="container col-md-5 mb-5 mt-5 pt-3">
    <a style="text-decoration:none;" href="<?php echo site_url('/friends/view/' . $post[0]->author_id); ?>">
        <?php
        $date = new DateTime();
        $user_timezone = new DateTimeZone('Asia/Kolkata');
        $date->setTimestamp($post[0]->created_date);
        $date->setTimezone($user_timezone);
        echo $post[0]->author_name .  " " .  '</a><small class="text-muted">' . $date->format('F j, Y,  g:i a') . "</small><br>"; ?>
    </a>

    <?php echo "<p class='lead'>" . $post[0]->content . "</p><br>"; ?>

    <?php
    $pic = $post[0]->image;
   
    if ((strpos($pic, "http://") === 0) || (strpos($pic, "https://") === 0))
        echo '<img class="mt-5 avatar1 img-responsive" src="' . $pic .  '" alt="user profile picture">';
    else if( !empty($pic) &&  $pic !== NULL)
        echo '<img class="w-100 img-responsive" src="' . base_url('/assets/img/posts/' . $pic) . '" alt="post image">';
    ?>


</div>