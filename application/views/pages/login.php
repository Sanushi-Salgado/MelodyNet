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

	<script src="<?php echo base_url() . 'assets/Login_v16/vendor/jquery/jquery-3.2.1.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/Login_v16/vendor/bootstrap/js/bootstrap.min.js'; ?>"></script>
	<script src="<?php echo base_url() . 'assets/Login_v16/js/main.js'; ?>"></script>
</head>

<body>
	<div class="limiter">
		<div class="container-login100" style="background-attachment: fixed;background-position: center;background-image: url('https://images.all-free-download.com/images/graphiclarge/vector_musical_background_241338.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<p style="color:white;" class="text-center lead">See what's happening on</p>
				<p class="glow">Melody Net</p>

				<?php echo form_open('login'); ?>

				<?php if ($this->session->flashdata('message')) { ?>
					<div class="alert alert-error" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p class="text-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('message') . '</p>'; ?>
					</div>
				<?php } ?>


				<div class="wrap-input100 validate-input" data-validate="Enter username">
					<input class="input100" type="text" name="username" placeholder="User name" required>
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>

				<?php if ($this->session->flashdata('incorrect_password_message')) { ?>
					<div class="alert alert-error" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p class="text-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('incorrect_password_message') . '</p>'; ?>
					</div>
				<?php } ?>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<input class="input100" type="password" name="password" placeholder="Password" required>
					<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>

				<div class="container-login100-form-btn m-t-32">
					<button name="sign_in" type="submit" class="login100-form-btn">
						Sign In
					</button>
				</div>

				<br>
				<p class="text-center">
					<a style="color:white;text-decoration:none;" href="">Forgot password? . </a>
					<a style="color:white;text-decoration:none;" href="<?php echo base_url() . 'index.php/register'; ?>"> Sign up for Melody Net</a>
				</p>

				</form>
			</div>
		</div>
	</div>

	<div id="dropDownSelect1"></div>

	<script>
		//Close the pop up message automatically
		window.setTimeout(function() {
			$(".alert").fadeTo(500, 0).slideUp(500, function() {
				$(this).remove();
			});
		}, 2000);
	</script>

</body>
</html>