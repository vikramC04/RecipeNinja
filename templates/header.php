<?php 
  session_start();
  $status = "";
  if(isset($_SESSION['status']) && $_SESSION['status'] == "Logged In") {
    $status = "user";
  } else {
    $status = "guest";
  }
?>
<head>
    <title> Recipe Ninja</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">
	  .brand{
	  	background: #2b6664 !important;
	  }
  	.brand-text{
  		color: #cbb09c !important;
  	}
  	form{
  		max-width: 460px;
  		margin: 20px auto;
  		padding: 20px;
  	}
  </style>
</head>
<body class="grey lighten-4">
	<nav class="white z-depth-0">
    <div class="container">
      <a href="./index.php" class="brand-logo brand-text">Recipe Ninja</a>
      <ul id="nav-mobile" class="right hide-on-small-and-down">
        <li><a href="./add.php" class="btn brand z-depth-0">Add a Recipe</a></li>
        <?php if($status == "user"): ?>
          <li><a href="./posts.php" class="btn brand z-depth-0">My Posts</a></li>
          <li><a href="./index.php?action=lgd" class="btn brand z-depth-0">Log Out</a></li>
        <?php else:  ?>
          <li><a href="./login.php?action=signup" class="btn brand z-depth-0">Sign Up</a></li>
          <li><a href="./login.php?action=login" class="btn brand z-depth-0">Log In</a></li>
        <?php endif;?>
      </ul>
    </div>
  </nav>