<?php
	session_start();
	if(isset($_POST['login'])){

       $username = mysqli_real_escape_string($conn, $_POST['username']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);

		 $query = "SELECT * FROM users WHERE username = '{$username}' AND password = md5($password) AND deleted = 0";

		$result = mysqli_query($conn, $query);
		
		if(mysqli_num_rows($result)){
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;
			header('Location: index.php?view=download_file');
		}
    }

?>


<form method="POST" action="" enctype="multipart/form-data">
<div class="col-sm-4"> 
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name='username' class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
  </div>
   <button type="submit" name="login" class="btn btn-primary">Submit</button>
 <div>
 </form> 