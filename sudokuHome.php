<?php
session_start();
if (isset($_GET["msg"]) && $_GET["msg"] == 'logout')
{
	session_unset();
}
require_once 'myFunctions.php';
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
  <title>Home</title>
</head>
<body class="w-75" style="margin:0 auto; background-image: url('img/sudoku-bg1.jpg')">
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand border border-dark" href="#">
    <img src="img/logo.png" class="d-inline-block align-top img-fluid" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="sudokuHome.php"><h3>Home </h3><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><h3>Posts</h3></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="userProfile.php"><h3>Profile</h3></a>
      </li>
    </ul>
  </div>
  <?php
  if ( isset ($_SESSION['theAccountID']))
	{
		$userName = retrieveUserName($db, $_SESSION['theAccountID']);
		echo "<a href='sudokuHome.php?msg=logout'><button type='button' class='btn btn-secondary btn-lg'>$userName - Logout</button></a>";
	}
	else 
	{
		echo "<a href='sudokuLogin.php'><button type='button' class='btn btn-secondary btn-lg'>Login/Signup!</button></a>";
	}
  ?> 
</nav>
</header>
<main>
<h1 class="display-5 text-center text-danger mt-3 mb-3">Most Recent Posts</h1>
<div class="overflow-auto bg-secondary justify-content-center" style="height: 75vh;overflow-y: scroll;width: 75%;margin: 0 auto;">
<div class="card" style="width: 18rem;margin: 2rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Random Text</p>
  </div>
</div>
<div class="card" style="width: 18rem;margin: 2rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Random Text</p>
  </div>
</div>
<div class="card" style="width: 18rem;margin: 2rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Random Text</p>
  </div>
</div>
<div class="card" style="width: 18rem;margin: 2rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Random Text</p>
  </div>
</div>
</div>
</main>
</body>

</HTML>