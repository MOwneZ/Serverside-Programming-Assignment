<?php
session_start();
if (isset($_GET["msg"]) && $_GET["msg"] == 'logout')
{
	session_unset();
}
require_once 'myFunctions.php';
require_once 'displayFunctions.php';
require_once 'i18n_bengali.php';
include_once 'MYSQLDB.php';
require 'db.php';
?>
<HTML>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>
		<?=I18n::checkText( "Home")?>
	</title>
</head>

<body class="w-75" style="margin:0 auto;background-image: url(img/Bengal-BG.png);background-repeat: no-repeat;background-position: center;background-size: cover;">
	<header>
		<nav class="navbar navbar-light d=flex flex-row justify-content-between" style="background-color:#FF7F50;">
			<div class='d-flex flex-row'>
				<a class="navbar-brand" href="#">
					<img src="img/bengal.jpg" width="30" height="30" class="d-inline-block align-top" alt="">
					<?=I18n::checkText( "Bengali for the Hardy")?>
				</a>
				<ul class="nav">
					<li class="nav-item">
						<a class="btn nav-link active text-dark mr-1" href="BengaliHome.php" style='background-color:#FF9933;'>
							<?=I18n::checkText( "Home")?>
						</a>
					</li>
					<li class="nav-item">
						<a class="btn nav-link text-dark mr-1" href="posts.php" style='background-color:#FF9933;'>
							<?=I18n::checkText( "Posts")?>
						</a>
					</li>
					<li class="nav-item">
						<a class="btn nav-link text-dark mr-1" href="userProfile.php" style='background-color:#FF9933;'>
							<?=I18n::checkText( "Profile")?>
						</a>
					</li>
				</ul>
			</div>
			<div class='d-flex flex-row'>
				<?php
				if ( isset ($_SESSION[ 'theAccountID']))
				{ 
					$userName=retrieveUserName($db, $_SESSION[ 'theAccountID']);
					echo "<a href='BengaliHome.php?msg=logout'><button type='button' class='btn mr-1' style='background-color:#FF9933;'>$userName - Logout</button></a>";
					echo "<a href='createPost.php'><button type='button' class='btn mr-1' style='background-color:#FF9933;'>Create Post!</button></a>";
				}
				else
				{ 
					echo "<a href='BengaliLogin.php'><button type='button' class='btn mr-1' style='background-color:#FF9933;'>Login/Signup!</button></a>";
				}
				?>
				<a class="navbar-brand" href="#">
					<img src="img/language.png" width="80" height="30" class="d-inline-block align-top" alt="">
				</a>
			</div>
		</nav>
	</header>
<main>
<div class="d-flex flex-column justify-content-center mt-5">
<h1 class="display-5 text-center">Welcome to Bengali language learning site!</h1>
<div class="w-50 border border-dark mb-2" style="margin:0 auto;background-color:#CDCDCD">
<h5 class="p-2">This is a website</h5>
</div>
</div>
</main>
</body>

</HTML>