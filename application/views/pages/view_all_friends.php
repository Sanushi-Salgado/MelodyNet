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
    } ?>

    <h3 style="color:white;" class="glow text-center"> <?php echo $user_details[0]->name; ?></h3>
    <h3 style="color:white;" class="lead text-center">
        <?php echo $friend_count = ($total_no_of_friends === 1) ? $total_no_of_friends . " friend" : $total_no_of_friends . " friends"; ?>
    </h3>

</div>


<!-- Page Content -->
<div id="content">
    <div class="container m-5">
        <!-- If there is flash data then display the flash data -->
        <?php if ($this->session->flashdata('success_message')) { ?>
            <script>
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
                swal({
                    title: "Error",
                    text: "<?php echo $this->session->flashdata('error_message'); ?>",
                    timer: 2000,
                    showConfirmButton: false,
                    type: 'error',
                    allowOutsideClick: true,
                });
            </script>
            <?php
            }

            if (empty($all_friends)) {
                echo '<h1 class="text-center">Currently you have no friends in your profile!</h1>';
            } else {
                $index = 0;
                while ($index < count($all_friends)) { ?>
                <!-- Clicking on a user’s name should display that user’s public home page. -->
                <?php
                        if ($index % 2 === 0)
                            echo '<div class="float-left text-center w-50 p-5">';
                        else
                            echo '<div class="float-right text-center w-50 p-5">';

                        echo '<div class="centered">';

                        $path = '/assets/img/users/' . $all_friends[$index]['profile_picture'];
                        if (((strpos($all_friends[$index]['profile_picture'], "http://")) === 0) || ((strpos($all_friends[$index]['profile_picture'], "https://")) === 0)) {
                            echo '<img class="avatar1 img-responsive" alt="user profile picture" src="' .  $all_friends[$index]["profile_picture"] . '">';
                        } else if (empty($all_friends[$index]['profile_picture']) || $all_friends[$index]['profile_picture'] == NULL) {
                            // Display a default picture if the user has not added a profile picture 
                            echo '<img class="avatar1 img-responsive" src="' . base_url('/assets/img/users/user.png') . '" alt="user profile picture">';
                        } else if (!empty($all_friends[$index]['profile_picture'])) {
                            echo '<img class="avatar1 img-responsive" src="' . base_url($path) . '" alt="user profile picture">';
                        }

                        ?>
                <br><a style="text-decoration:none;color:white;" href="<?php echo site_url('/friends/view/' . $all_friends[$index]['user_id']); ?>">
                    <h3><?php echo ucwords($all_friends[$index]['name']); ?></h3>
                </a>
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

<?php // include_once(APPPATH . 'views/templates/footer.php'); 
?>