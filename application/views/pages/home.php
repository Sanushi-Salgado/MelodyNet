<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Melody Net</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/img/icons/favicon.ico'; ?>" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/vendor/bootstrap/css/bootstrap.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/fonts/font-awesome-4.7.0/css/font-awesome.min.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/css/util.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/Login_v16/css/main.css'; ?>">
</head>

<body>

	<!-- Top Navigation -->
	<nav class="navbar navbar-expand-lg navbar-info fixed-top py-3" id="mainNav">
		<div class="container">
			<p class="navbar-brand js-scroll-trigger" href="#page-top">Melody Net</p>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav ml-auto my-2 my-lg-0">
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#about">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#services">Services</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Page Content -->
	<div class="limiter">
		<div class="container-login100" style="background-attachment: fixed;background-position: center;background-image: url('https://images.all-free-download.com/images/graphiclarge/vector_musical_background_241338.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					<p class="glow">Melody Net</p>
				</span>
				<span>
					<div class="container-login100-form-btn m-t-32">
						<a href="<?php echo base_url() . 'index.php/login'; ?>">
							<button name="sign_in" type="submit" class="login100-form-btn">Sign In</button>
						</a>
					</div>
					<div class="container-login100-form-btn m-t-32">
						<a href="<?php echo base_url() . 'index.php/register'; ?>">
							<button name="sign_up" type="submit" class="login100-form-btn">Sign Up</button>
						</a>
					</div>
				</span>
			</div>
		</div>
	</div>
	
</body>
</html>