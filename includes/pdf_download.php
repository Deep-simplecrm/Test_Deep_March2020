<?php
	session_start();
 require_once '../vendor/autoload.php';
 include "db.php";
 $username = $_SESSION['username'];
 $query = "SELECT * FROM users WHERE username = '{$username}' AND deleted = 0";
 $result = mysqli_query($conn, $query);

 if(!$result){
 	die("Query Failed : " . mysqli_error($conn));
 }

 while ($row = mysqli_fetch_assoc($result)) {
 	$username = $row['username'];
 	$first_name = $row['first_name'];
 	$last_name = $row['last_name'];
 	$email = $row['email'];
 	$gender = $row['gender'];
 	$address = $row['address'];
 	$profile_photo = $row['profile_photo'];
 	$signature = $row['signature'];

 }

$mpdf = new \Mpdf\Mpdf();
// $mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/upload']);

$html_content = ' <div>
							<p> Username : '.$username.' </p>
							<p> First Name : '.$first_name.'</p>
							<p> Lats Name : '.$last_name.'</p>
							<p> Email : '.$email.'</p>
							<p> Gender : '.$gender.'</p>
							<p> Address : '.$address.'</p>
							<p> Profile pic : <img class="img-thumbnail" width="100" src="../uploads/'.$profile_photo.'" alt="'.$profile_photo.'" ></p>
							<p> Sign pic : <img  class="img-thumbnail" width="100" src="../uploads/'.$signature.'" alt="'.$signature.'" ></p>
							</div>';

$mpdf->WriteHTML($html_content);
$mpdf->Output();


?>

