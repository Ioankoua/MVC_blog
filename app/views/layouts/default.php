<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="../public/css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<script src="../public/js/jquery-3.3.1.min.js"></script>
	<script src="../public/js/receivedApi.js"></script>
	<script src="../public/js/form.js"></script>
</head>
<body>

	<div class="myheader">
		<div class="my_meny"> 
		<a class="nav-link active fs-4" style="margin-left: 2vw; margin-top: 1vh;" href="/">All Posts</a>

		<?php if (isset($_SESSION['auth'])): ?>
			<a class="nav-link active fs-4" style="margin-top: 1vh;" href="/account/myposts">My Posts</a>
			<a class="nav-link active fs-4" style="margin-top: 1vh;" href="/account/addpost">Add Post</a>
		<?php endif ?>

		<?php if (isset($_SESSION['auth'])): ?>
			<a class="nav-link active fs-4"  style="margin-left: 65vw; margin-top: 1vh;" href="/exit">Exit</a>
		<?php else: ?>
			<a class="nav-link active fs-4"  style="margin-left: 75vw; margin-top: 1vh;" href="/register">Register</a>
			<a class="nav-link active fs-4" style="margin-top: 1vh;" href="/enter">Enter</a>
		<?php endif ?>
		</div>
	</div>


	<div class="mydefault_content">

	<?php echo $content;?>

	
	
	</div>
</body>
</html>