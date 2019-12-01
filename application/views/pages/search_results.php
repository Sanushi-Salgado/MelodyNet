<!-- Top Navigation -->
<?php include_once(APPPATH .  'views/templates/top_navigation.php'); ?>


<!-- Header -->
<div class="header text-center">
    <?php
    $img = $user_details[0]->profile_picture;
    if (empty($img) || $img == NULL) {
        echo '<img  class="mt-5 avatar1 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
    } else if ((strpos($img, "http://") === 0) || (strpos($img, "https://") === 0)) {
        echo '<img class="mt-5 avatar1 img-responsive" src="' . $img .  '" alt="user profile picture">';
    } else {
        $img_path = base_url('/assets/img/users/' . $img);
        ?>
        <img class="mt-5 avatar1 img-responsive" src="<?php echo $img_path; ?>" alt="user profile picture">
    <?php
    } ?>
    <h3 style="color:white;" class="glow text-center"> <?php echo $user_details[0]->name; ?> </h3>
</div>


<!-- Page Content -->
<div id="content">
    <div class="container m-5">
        <?php
        if (!empty($message))
            echo '<h1 class="text-center">' . $message . '</h1>';
        else if (!empty($incorrect_user_search_message))
            echo '<h1 class="text-center">' . $incorrect_user_search_message . '</h1>';
        else {
            $index = 0;
            while ($index < count($friends)) { ?>
                <!-- Clicking on a user’s name should display that user’s public home page. -->
                <?php
                        if ($index % 2 === 0)
                            echo '<div class="float-left text-center w-50 p-5">';
                        else
                            echo '<div class="float-right text-center w-50 p-5">';

                        echo '<div class="centered">'; ?>

                <a style="text-decoration:none;color:white;" href="<?php echo site_url('/friends/view/' . $friends[$index]['user_id']); ?>">
                    <h3><?php echo ucwords($friends[$index]['name']); ?></h3>
                </a>

                <?php

                        $path = '/assets/img/users/' . $friends[$index]['profile_picture'];
                        if (((strpos($friends[$index]['profile_picture'], "http://")) === 0) || ((strpos($friends[$index]['profile_picture'], "https://")) === 0))
                            echo '<img class="avatar1 img-responsive" alt="user profile picture" src="' .  $friends[$index]["profile_picture"] . '">';
                        else if (empty($friends[$index]['profile_picture']) || $friends[$index]['profile_picture'] == NULL)
                            // Display a default picture if the user has not added a profile picture 
                            echo '<img class="avatar1 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
                        else if (!empty($friends[$index]['profile_picture']))
                            echo '<img class="avatar1 img-responsive" src="' . base_url($path) . '" alt="user profile picture">';

                        ?>
                <br>

                <!-- users should see a button they can click to ‘follow’ that user (if they already follow 
                    that person, the ‘follow’ button should not be displayed. Clicking on a user’s name 
                    should display that user’s public home page.-->
                <?php echo form_open('friends/follow'); ?>
                <input type="hidden" name="following_user_id" value="<?php echo $friends[$index]['user_id']; ?>">

                <?php if ($friends[$index]['is_following'] === false) { ?>
                    <button id="follow" name="follow" type="submit" class="btn btn-sm"><i class="fa fa-user-plus fa-lg mr-2"></i>Follow</button>
                <?php } else if ($friends[$index]['is_following'] === true) { ?>
                    <button id="unfollow" name="unfollow" type="submit" class="btn btn-sm"><i class="fa fa-user-times fa-lg mr-2"></i>Unfollow</button>
                <?php } ?>

                </form>
    </div>
</div>

<?php
        $index++;
    }
}
?>

</div>
</div>
</div>

<br><br>

<!-- Footer -->
<?php // include_once(APPPATH . 'views/templates/footer.php'); 
?>