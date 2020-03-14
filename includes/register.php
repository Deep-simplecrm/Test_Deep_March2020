
<?php
    
        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if(isset($_POST['submit'])){

       $username = mysqli_real_escape_string($conn, $_POST['username']);
       $password = mysqli_real_escape_string($conn, $_POST['password']);
    
       $excel_file = $_FILES['excel_data']['name'];
       $excel_data_temp = $_FILES['excel_data']['tmp_name'];

       $profile_photo = $_FILES['profile_photo']['name'];
       $profile_photo_temp = $_FILES['profile_photo']['tmp_name'];

       $signature = $_FILES['signature']['name'];
       $signature_temp = $_FILES['signature']['tmp_name'];

       move_uploaded_file($excel_data_temp, "./uploads/$excel_file");
       move_uploaded_file($profile_photo_temp, "./uploads/$profile_photo");
       move_uploaded_file($signature_temp, "./uploads/$signature");    

        $spreadsheet = new Spreadsheet();

        $inputFileType = 'Xlsx';
        $inputFileName = './uploads/'.$excel_file;

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
        /**  Advise the Reader that we only want to load cell data  **/
        $reader->setReadDataOnly(true);

        $worksheetData = $reader->listWorksheetInfo($inputFileName);

        foreach ($worksheetData as $worksheet) {
            $sheetName = $worksheet['worksheetName'];

            //echo "<h4>$sheetName</h4>";
            /**  Load $inputFileName to a Spreadsheet Object  **/
            $reader->setLoadSheetsOnly($sheetName);
            $spreadsheet = $reader->load($inputFileName);

            $worksheet = $spreadsheet->getActiveSheet();
            //print_r($worksheet->toArray());

            $excel_data = $worksheet->toArray();
        }

        $first_name = mysqli_real_escape_string($conn, $excel_data[0][0]);
        $last_name = mysqli_real_escape_string($conn, $excel_data[0][1]);
        $gender = mysqli_real_escape_string($conn, $excel_data[0][2]);
        $email = mysqli_real_escape_string($conn, $excel_data[0][3]);
        $address = mysqli_real_escape_string($conn, $excel_data[0][4]);
        $mobile_number = mysqli_real_escape_string($conn, $excel_data[0][5]);

       $query = "INSERT INTO users (username, password, excel_file, profile_photo, signature, first_name, last_name, gender, email, address, mobile_no) VALUES ('{$username}', md5($password), '{$excel_file}', '{$profile_photo}', '{$signature}', '{$first_name}', '{$last_name}', '{$gender}', '{$email}', '{$address}', {$mobile_number})";

        $result = mysqli_query($conn, $query);

        if(!$result){

            die("Query Failed : " . mysqli_error($conn));
        }
    }

?>



<form method="POST" class="shadow card col-sm-4" action="" enctype="multipart/form-data">
<div class="col-sm-12"> 
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name='username' class="form-control" id="username" aria-describedby="emailHelp" placeholder="Enter Username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Excel File</label>
    <input type="file" name="excel_data" class="form-control-file" id="excel_data">
    <small id="emailHelp" class="form-text text-muted">Enter data in following format First Name, Last Name, Gender, Email, Address, Mobile Number.</small>
  </div>
  <div class="form-group">
    <label for="profile_photo">Profile Pic</label>
    <input type="file" name="profile_photo" class="form-control-file" id="profile_photo">
  </div>
  <div class="form-group">
    <label for="exampleFormControlFile1">Sign</label>
    <input type="file" name="signature" class="form-control-file" id="signature">
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  <a href="index.php?view=login" class="btn btn-primary"> Login </a>
</div>
</form>