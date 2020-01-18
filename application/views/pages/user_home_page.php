<!-- Top Navigation -->
<?php include_once(APPPATH .  'views/templates/top_navigation.php'); ?>


<!-- Header -->
<div class="header text-center">
    <?php
    $img = $user_details[0]->profile_picture;
    if (empty($img) || $img == NULL)
        echo '<img  class="mt-5 avatar1 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
    else if ((strpos($img, "http://") === 0) || (strpos($img, "https://") === 0))
        echo '<img class="mt-5 avatar1 img-responsive" src="' . $img .  '" alt="user profile picture">';
    else {
        $img_path = base_url('/assets/img/users/' . $img);
        ?>
        <img class="mt-5 avatar1 img-responsive" src="<?php echo $img_path; ?>" alt="user profile picture">
    <?php
    }
    echo '<h3 style="color:white;" class="glow text-center">' . $user_details[0]->name . '</h3>';
    ?>
    <!-- Display the number of followers & following people of a particular user  -->
    <h3 style="color:white;" class="lead text-center">
        <?php echo $no_of_followers = ($no_of_followers === 1) ? $no_of_followers . " follower &nbsp;&nbsp; | &nbsp;&nbsp; " : $no_of_followers .   " followers &nbsp;&nbsp; | &nbsp;&nbsp; ";
        echo $no_of_following_people . " following" ?>
    </h3>
</div>


<!-- Page Content -->
<div id="content">
    <div class="container m-1">
        <div class="container mt-3 col-md-4 float-left">
            <div class="text-white bg-info p-3" style="max-width: 20rem;">
                <p class="text-center font-weight-bold">Favourite Music Genres
                    <ul>
                        <?php
                        // Display the user's favourite genres 
                        foreach ($favourite_genres as $favourite_genre)
                            echo '<p class="text-center m-2 p-2 glow fa fa-music fa-x navbar-brand font-weight-bold"></p>' . ucwords($favourite_genre) . '<br>';
                        ?>
                    </ul>
            </div>
        </div>


        <button title="Create new post" id="newPostBtn" class="btn btn-primary btn-md m-3">
            <a style="text-decoration:none;color:white" href="<?php echo site_url('/posts/create'); ?>">
                <i class="fa fa-plus fa-lg m-2"></i>
                Create Post
            </a>
        </button>


        <!-- If there is flash data then display the flash data -->
        <?php if ($this->session->flashdata('success_message')) { ?>
            <script>
                /* Display a success alert using sweetalert */
                swal({
                    title: "Success",
                    text: "<?php echo $this->session->flashdata('success_message'); ?>",
                    timer: 2000,
                    showConfirmButton: false,
                    type: 'success',
                    allowOutsideClick: true,
                });
            </script>

        <?php } else if ($this->session->flashdata('error_message')) { ?>
            <script>
                /* Display an error alert using sweetalert */
                swal({
                    title: "Error",
                    text: "<?php echo $this->session->flashdata('error_message'); ?>",
                    timer: 2000,
                    showConfirmButton: false,
                    type: 'error',
                    allowOutsideClick: true,
                });
            </script>
        <?php } ?>


        <!--Display all posts -->
        <?php
        /* if (count($all_posts))
                echo '<h1 class="text-center pt-5">No posts found in your timeline</h1>';
            else { */
        if (!empty($no_posts_message)) {
            echo '<h1 class="text-center mt-5">' . $no_posts_message . '</h1>';
        } else {
            foreach ($all_posts as $post) {
                // foreach ($user as $post) {
                ?>
                <div style="overflow:hidden;" class="text-justify container col-md-8 float-right">
                    <div class="row m-3">
                        <div class="container p-3 w-100 h-50" style="border-radius: 10px; border: 2px solid;border-color: #ccc;background-color: #ddd;">
                            <!-- <a class="btn btn-primary" href="#"><span class="glyphicon glyphicon-user"></span></a> -->
                            <?php

                                    $img = $post->post_author_profile_pic;
                                    if (empty($img) || $img == NULL) {
                                        echo '<img class="avatar2 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
                                    } else if ((strpos($img, "http://") === 0) || (strpos($img, "https://") === 0)) {
                                        echo '<img class="avatar2 img-responsive" src="' . $img .  '" alt="user profile picture">';
                                    } else {
                                        $img_path = base_url('/assets/img/users/' . $img);
                                        echo '<img class="avatar2 img-responsive" src="' . $img_path .  '" alt="user profile picture">';
                                    }
                                    ?>


                            <a style="text-decoration:none;" href="<?php echo site_url('/friends/view/' . $post->author_id); ?>">
                                <?php

                                        $date = new DateTime();
                                        $user_timezone = new DateTimeZone('Asia/Kolkata');
                                        $date->setTimestamp($post->created_date);
                                        $date->setTimezone($user_timezone);
                                        //Display the post created date
                                        echo $post->author_name .  " " .  '</a><small class="text-muted">' .  $date->format('F j, Y,  g:i a') . "</small>";
                                        ?>


                                <!-- Display the update & delete post buttons only for the user's posts -->
                                <?php
                                        //check if the currently logged in user's name is eqaul to the post author's name
                                        if ($post->author_name === $user_details[0]->name) { ?>
                                    <div class="dropdown float-right  pr-5 pt-3">
                                        <span class="text-muted fa fa-ellipsis-h"></span>
                                        <div class="dropdown-content">
                                            <small><a class="text-muted" href="#"><span class="fa fa-pencil"> Edit post</a></small>
                                            <small><a class="text-muted" href="<?php echo base_url(). 'index.php/posts/delete/' . $post->post_id; ?>"> <span class="fa fa-trash"> Delete post</a></small>
                                        </div>
                                    </div>

                                <?php }   ?>


                                <?php
                                        echo '<p class="lead">' . word_limiter($post->content, 60) . '</p>';
                                        $pic = $post->image;
                                        if (!empty($pic))
                                            echo '<p class="text-center"><img class="img-responsive"  src="' .  base_url() . 'assets/img/posts/' . $post->image . '"></p>';
                                        ?>

                                <br><a class="btn btn-primary" href="<?php echo base_url() . 'index.php/posts/view/' . $post->post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                                <hr>
                                <p class="text-center">
                                    <a style="text-decoration:none;" class="mx-5" href="#"><span class="fa fa-thumbs-up"></span> Like</a>
                                    <a style="text-decoration:none;" class="mx-5" href="#"><span class="fa fa-comment"></span> Comment</a>
                                    <a style="text-decoration:none;" class="mx-4" href="#"><span class="fa fa-share-alt"></span> Share</a>
                                </p>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>
    </div>
</div>

<!-- Footer -->
<?php // include_once(APPPATH . 'views/templates/footer.php'); 
?>