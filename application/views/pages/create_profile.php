<!DOCTYPE html>
<html lang="en">

<head>
    <title>Melody Net</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/img/icons/favicon.ico'; ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/vendor/bootstrap/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/fonts/font-awesome-4.7.0/css/font-awesome.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/fonts/Linearicons-Free-v1.0.0/icon-font.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/css/util.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/css/main.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>">

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

    <style>
        /* Profile Picture */
        .avatar1 {
            vertical-align: middle;
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-attachment: fixed;background-position: center;background-image: url('https://images.all-free-download.com/images/graphiclarge/vector_musical_background_241338.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <p style="color:white;" class="text-center lead">Create your</p>
                <p class="glow">Melody Net</p>
                <p style="color:white;" class="text-center lead">Profile</p>
                </span>

                <?php
                if ($this->session->flashdata('success_message')) { ?>
                    <script>
                        swal({
                            title: "Success",
                            text: "<?php echo $this->session->flashdata('success_message'); ?>",
                            timer: 2200,
                            showConfirmButton: false,
                            type: 'success',
                            allowOutsideClick: true,
                        });
                    </script>
                <?php
                } else if ($this->session->flashdata('error_message')) { ?>
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
                } else if ($this->session->flashdata('profile_error_message')) { ?>
                    <script>
                        swal({
                            title: "Error",
                            text: "<?php echo $this->session->flashdata('profile_error_message'); ?>",
                            timer: 2200,
                            showConfirmButton: false,
                            type: 'error',
                            allowOutsideClick: true,
                        });
                    </script>
                <?php } else if ($this->session->flashdata('profile_creation_failed_message')) { ?>
                    <script>
                        swal({
                            title: "Error",
                            text: "<?php echo $this->session->flashdata('profile_creation_failed_message'); ?>",
                            timer: 2000,
                            showConfirmButton: false,
                            type: 'error',
                            allowOutsideClick: true,
                        });
                    </script>
                <?php } ?>

                <?php echo form_open_multipart('profile/create'); ?>

                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input type="text" name="person_name" class="input100 text-white" placeholder="Enter your name" required>
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <br><br>

                <p class="text-center"><img src="<?php echo base_url() . 'assets/img/users/user.png'; ?>" class="avatar1 img-responsive" id="output" width="200" /></p>

                <div class="wrap-input100 validate-input" data-validate="Enter username">
                    <input type="url" name="url" id="inputURL" class="input100 text-white" placeholder="Profile image url ex: https://example.com" pattern=".+\.jpg|.+\.png|.+\.gif" title="Enter an url ending from jpg/ png/ gif" oninput="loadFile2(event)">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>

                <br><br>
                <p class="text-center text-white">OR</p>

                <br>
                <p class="text-center text-white">Select an image for the profile picture</p>
                <div class="form-group text-center">
                    <input id="imageFile" type="file" name="userfile" class="text-center btn btn-info validate-input" size="20" accept="image/*">
                </div>

                <br><br>

                <div class="form-group">
                    <p class="text-white text-center">Select your favourite music genres</p>
                    <select name="genres[]" class="form-control" id="exampleSelect2" multiple required>
                        <?php
                        foreach ($genres as $genre)
                            echo '<option name="' . $genre->genre_id . '">' . $genre->name . '</option>';
                        ?>
                    </select>
                </div>

                <br>

                <div class="container-login100-form-btn m-t-32">
                    <button name="create_profile" type="submit" class="login100-form-btn">
                        Create Profile
                    </button>
                </div>

                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url() . 'assets/Login_v16/vendor/jquery/jquery-3.2.1.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/Login_v16/vendor/bootstrap/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url() . 'assets/Login_v16/js/main.js'; ?>"></script>

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        var loadFile2 = function(event) {
            var image = document.getElementById('inputURL').value;
            // if((document.getElementById('inputURL') === NULL))
            //     document.getElementById("output").innerHTML = '<img src="assets/img/users/user.png" alt="Image"/>';
            // else
            document.getElementById("output").innerHTML = '<img src="' + document.getElementById('inputURL').value + '" alt="Profile Picture" />';
        };


        document.getElementById("inputURL").addEventListener("input", validateInput);

        function validateInput() {
            if (document.getElementById('inputURL').value !== "")
                document.getElementById("imageFile").disabled = true;
            else
                document.getElementById("imageFile").disabled = false;
        }


        /* Disable the image upload button, if the user has entered a url for the profile picture */ 
        document.getElementById('imageFile').onchange = function() {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);

            if (this.value !== null || this.value !== "")
                document.getElementById('inputURL').disabled = true;
            else
                document.getElementById('inputURL').disabled = false;

            document.getElementById("output").innerHTML = '<img src="' + document.getElementById('imageFile').value + '" class="img-responsive" alt="Profile Picture" />';
        };
    </script>

</body>
</html>