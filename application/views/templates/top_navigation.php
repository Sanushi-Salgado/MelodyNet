<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Melody Net</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="<?php echo base_url() . 'assets/img/icons/favicon.ico'; ?>" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap2.min.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/style.css'; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/stylesheet.css'; ?>">
    <!-- Font awesome icons -->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/script.js'; ?>"></script>
    <script type=" text/javascript" src="<?php echo base_url() .  'assets/js/bootstrap3.min.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.3.1.min.js'; ?>"></script>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

    <style>
        /* Page Header */
        .header {
            padding: 40px;
            text-align: center;
            background-image: url('https://res.cloudinary.com/teepublic/image/private/s--ayPIFXeX--/t_Preview/b_rgb:191919,c_limit,f_jpg,h_630,q_90,w_630/v1519599950/production/designs/2395287_0.jpg');
        }


        /*dropdown menu of the ellipsis icon
        Reference - https://www.w3schools.com/howto/howto_css_dropdown.asp */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }


        /* Follow button */
        button#follow {
            background-color: midnightblue;
            color: white;
            border-radius: 30px;
            padding: 20px 40px;
            border: 1px solid #111;
        }

        button#follow:hover {
            background-color: #ffffff;
            color: #4c9ed9;
            border: 1px solid #111;
        }

        /* Unfollow button */
        button#unfollow {
            background-color: #ffffff;
            color: #4c9ed9;
            border-radius: 30px;
            padding: 20px 40px;
            border: 1px solid #111;
        }

        button#unfollow:hover {
            background-color: midnightblue;
            color: white;
            border: 1px solid #111;
        }
    </style>
</head>

<body>
    <div class="navbar fixed-header">
        <a class="fa fa-home fa-2x" href="<?php echo base_url() . 'index.php/user/home'; ?>" title="Home"><span class="sr-only">(current)</span></a>
        <a class="fa fa-users fa-2x" style="color:white" href="<?php echo base_url() . 'index.php/friends/view'; ?>" title="View all friends"></a>
        <a class="fa fa-sign-out fa-2x" style="color:white" href="<?php echo base_url() . 'index.php/Login_Controller/handleUserLogOut'; ?>" title="Sign Out"></a>

        <?php echo form_open('friends/search', ['method' => 'GET']); ?>
        <a style="color:white">
            <input title="Search" id="user_search" name="genre" type="text" placeholder="Search by genre">
            <input name="search" id="search_submit" type="submit">
        </a>
        </form>
    </div>