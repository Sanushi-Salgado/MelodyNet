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

	<!-- Sweetalert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
	<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>
</head>

<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('https://images.all-free-download.com/images/graphiclarge/vector_musical_background_241338.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<p style="color:white;" class="text-center lead">Join</p>
				<p class="glow">Melody Net</p>
				<p style="color:white;" class="text-center lead">Today</p>

				<?php
				if ($this->session->flashdata('message')) { ?>
					<div class="alert alert-error" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<p class="text-danger"><strong>Error!</strong> <?php echo $this->session->flashdata('message') . '</p>'; ?>
					</div>
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
				<?php } else if ($this->session->flashdata('success_message')) { ?>
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
				<?php
				}

				echo form_open('register');
				?>


				<div class="wrap-input100 validate-input" data-validate="Enter username">
					<input class="input100" type="text" name="username" placeholder="User name" pattern=".{6,12}" required title="Username should contain at least 6 characters">
					<span class="focus-input100" data-placeholder="&#xe82a;"></span>
				</div>

				<div class="wrap-input100 validate-input" data-validate="Enter password">
					<input class="input100" type="password" name="password" placeholder="Password" pattern=".{6,12}" required title="Password should contain at least 6 characters">
					<span class="focus-input100" data-placeholder="&#xe80f;"></span>
				</div>

				<div class="container-login100-form-btn m-t-32">
					<button name="sign_up" type="submit" class="login100-form-btn">
						Sign Up
					</button>
				</div>

				</form>
			</div>
		</div>
	</div>

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