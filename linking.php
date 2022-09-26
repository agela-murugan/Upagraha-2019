<?php 
$name=$_POST['name'];
$clg_name=$_POST['clg_name'];
$gender = $_POST['gender'];
$email=$_POST['email'];
$mobile_no=$_POST['mobile_no'];
$year=$_POST['year'];
$dept=$_POST['dept'];
$city=$_POST['city'];
$state=$_POST['state'];
$events=$_POST['events'];
 
 if(!empty($name)|| !empty($clg_name) || !empty($gender) || !empty($email)|| !empty($mobile_no)|| !empty($year)|| !empty($city)|| !empty($state)|| !empty($dept)|| !empty($mobile_no)|| !empty($events)){
	$host = "182.50.135.84";
    $dbUsername = "raksha";
    $dbPassword = "sairam";
    $dbname = "raksha123";
    //create connection
    $conn = new mysqli("182.50.135.84","raksha" , "sairam","raksha123" );
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into register (name, clg_name, gender, email, city, state,year,dept,mobile_no,events) values(?, ?, ?, ?, ?, ?,?,?,?,?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssssssis", $name, $clg_name, $gender, $email, $city, $state,$year,$dept,$mobile_no,$events);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
