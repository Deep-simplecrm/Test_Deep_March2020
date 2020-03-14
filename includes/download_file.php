<?php
session_start();
	if(!isset($_SESSION['username'])){
		header("Location: index.php ");
	}

?>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">

  <a class="navbar-brand" href="#">Logo</a>
  <div class="float-right">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="includes/pdf_download.php">Print PDF</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Print Word</a>
    </li>
  </ul>
</div>
<a href="includes/logout.php" class="float-right" > Logout </a>
</nav>