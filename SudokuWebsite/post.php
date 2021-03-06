<?php
session_start();
require_once 'myFunctions.php';
require_once 'displayFunctions.php';
require_once 'i18n_sudoku.php';
require_once 'verification.php';
require_once 'Retriever.php';
include_once 'MYSQLDB.php';
require 'db.php';
$postID = $_GET['msg'];
if (checkPostExists($db, $postID))
{
	header('Location: posts.php');
}
$userName = "";
if ( isset ( $_SESSION['theAccountID'] ) ) 
{
$userName = Retriever::retrieveUserName($db, $_SESSION['theAccountID']);
}
if (isset($_POST['commentID']))
{
	$commentID = $_POST['commentID'];
	deleteComment($db, $commentID);
	header("Location: post.php?msg=$postID");
}
if (isset($_POST['commentContent']))
{
	$commentContent = $_POST['commentContent'];
	addComment($db, $postID, $commentContent, $userName);
}
if ( isset($_POST['dislike']))
{
	dislikePost($db, $postID, $userName);
}
if ( isset($_POST['like']))
{
	likePost($db, $postID, $userName);
}
if ( isset ($_POST['feedback']))
{
	$feedback = $_POST['feedback'];
	removeFeedback($db, $feedback, $postID, $userName);
}
if ( isset($_POST['newPostContent']))
{
	$newPostContent = $_POST['newPostContent'];
	editBlogPost($db, $newPostContent, $userName, $postID);
}
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
		<?=I18n::checkText( "Browsing Post")?>
	</title>
</head>

<body class="w-75" style="margin:0 auto; background-image: url('img/sudoku-bg1.jpg')">
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand border border-dark" href="#">
				<img src="img/logo.png" class="d-inline-block align-top img-fluid" alt="">
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item"> <a class="nav-link" href="sudokuHome.php"><h3><?=I18n::checkText("Home")?></h3><span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item"> <a class="nav-link" href="posts.php"><h3><?=I18n::checkText("Posts")?></h3></a>
					</li>
					<li class="nav-item"> <a class="nav-link" href="userProfile.php"><h3><?=I18n::checkText("Profile")?></h3></a>
					</li>
				</ul>
			</div>
			<div>
				<?php if ( isset ($_SESSION[ 'theAccountID']))
						{
							$userName=Retriever::retrieveUserName($db, $_SESSION[ 'theAccountID']);
							echo "<a href='sudokuHome.php?msg=logout'><button type='button' class='btn btn-secondary btn-lg'>$userName - logout</button></a>";
							echo "<a href='createPost.php'><button type='button' class='btn btn-secondary btn-lg m-1'>Create Post!</button></a>";
						} 
						else
						{ 
							echo "<a href='sudokuLogin.php'><button type='button' class='btn btn-secondary btn-lg m-1'>Login/Signup</button></a>";
						} ?>
			</div>
		</nav>
	</header>
<main>
<?php
if ( isset ( $_POST['edit']))
{
	echo getEditablePost($db, $postID, $userName);
}
else 
{ 
	echo getSinglePost($db, $postID, $userName);
}
?>
</main>
</body>
</HTML>