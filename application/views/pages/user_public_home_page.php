<!-- Top Navigation -->
<?php include_once(APPPATH .  'views/templates/top_navigation.php'); ?>


<!-- Header -->
<div class="header text-center">
    <?php
    $img = $user_data[0]->profile_picture;
    if (empty($img) || $img == NULL)
        echo '<img  class="mt-5 avatar1 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
    else if ((strpos($img, "http://") === 0) || (strpos($img, "https://") === 0))
        echo '<img class="mt-5 avatar1 img-responsive" src="' . $img .  '" alt="user profile picture">';
    else {
        $img_path = base_url('/assets/img/users/' . $img);
        ?>
        <img class="mt-5 avatar1 img-responsive" src="<?php echo $img_path; ?>" alt="user profile picture">
    <?php
    } ?>
    <h3 style="color:white;" class="glow text-center"> <?php echo ucwords($user_data[0]->name); ?> </h3>

    <!-- Display the number of followers & following people of a particular user  -->
    <h3 style="color:white;" class="lead text-center">
        <?php echo $no_of_followers = ($no_of_followers === 1) ? $no_of_followers . " follower &nbsp;&nbsp; | &nbsp;&nbsp; " : $no_of_followers .   " followers &nbsp;&nbsp; | &nbsp;&nbsp; ";
        echo $no_of_following_people . " following" ?>
    </h3>
</div>


<!-- Display user profile information -->
<div class="container m-1">
    <div class="container mt-3 col-md-4 float-left">
        <div class="text-white bg-info p-3" style="max-width: 20rem;">
            <p class="text-center font-weight-bold">Favourite Music Genres
                <ul>
                    <!-- Display the favourite genres of user -->
                    <?php
                    foreach ($favourite_genres as $favourite_genre)
                        echo '<p class="text-center m-2 p-2 glow fa fa-music fa-x navbar-brand font-weight-bold"></p>' . ucwords($favourite_genre) . '<br>';
                    ?>
                </ul>
        </div>
    </div>


    <!--Display all posts -->
    <?php
    if (count($all_posts)) {
        foreach ($all_posts as $post) {
            ?>
            <div class="container col-md-8 float-right">
                <div class="row m-3">
                    <div class="container p-3 w-100 h-50" style="border-radius: 10px; border: 2px solid;border-color: #ccc;background-color: #ddd;">
                        <?php
                                $img = $post->post_author_profile_pic;
                                if (empty($img) || $img == NULL)
                                    echo '<img class="avatar2 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
                                else if ((strpos($img, "http://") === 0) || (strpos($img, "https://") === 0))
                                    echo '<img class="avatar2 img-responsive" src="' . $img .  '" alt="user profile picture">';
                                else {
                                    $img_path = base_url('/assets/img/users/' . $img);
                                    echo '<img class="avatar2 img-responsive" src="' . $img_path .  '" alt="user profile picture">';
                                }
                                ?>

                        <a style="text-decoration:none;" href="#">
                            <?php
                                    $date = new DateTime();
                                    $user_timezone = new DateTimeZone('Asia/Kolkata');
                                    $date->setTimestamp($post->created_date);
                                    $date->setTimezone($user_timezone);

                                    echo $post->author_name .  " " .  '</a><small class="text-muted">' . $date->format('F j, Y,  g:i a') . "</small><br>"; ?>
                        </a>

                        <?php
                                echo '<p class="lead">' . word_limiter($post->content, 60) . '</p><br>';
                                $pic = $post->image;
                                if (!empty($pic))
                                    echo '<p class="text-center"><img class="img-responsive" style="width-500;height-80" src="' .  base_url() . 'assets/img/posts/' . $post->image . '"></p>';
                                ?>
                        <a class="btn btn-primary" href="<?php echo site_url('/posts/view/' . $post->post_id); ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    </div>
                </div>
            </div>

    <?php }
    } else
        echo '<h1 class="text-center pt-5">No posts in timeline</h1>'; ?>
</div>
</div>

<!-- Footer -->
<?php //  include_once(APPPATH . 'views/templates/footer.php'); 
?>