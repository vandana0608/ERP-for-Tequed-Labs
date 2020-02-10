<html>
<head>
<title>TEQUED LABS</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<style>
    body {
        background-image: url("https://terillium.com/wp-content/uploads/2018/07/HomePage-background.jpg");
      color: white;
    }
</style>

<div id="main" align = "center">
<div id="login" align = "center">
<h2 style="color:black">Student Details</h2>
<hr/>
<form action="" method="post">
<label>Name :</label>
<input type="text" name="sname" id="sname" required="required" placeholder="Please Enter Name"/><br /><br />
<label>College :</label>
<input type="text" name="college" id="college" required="required" placeholder="Please Enter College"/><br/><br />
<label>Year of Study :</label>
<input type="number" name="yearofstudy" id="yearofstudy" min="1" max="6" required="required" placeholder="Please Enter Year Of Study"/><br/><br />
<label>Branch :</label>
<input type="text" name="branch" id="branch" required="required" placeholder="Please Enter Branch"/><br/><br />
<label>Course Opted :</label>
<input type="text" name="course" id="course" required="required" placeholder="Please Enter Course"/><br/><br />
<label>Trainer :</label>
<input type="text" name="trainer" id="trainer" required="required" placeholder="Please Enter Trainer"/><br/><br />
<label>Total Fees :</label>
<input type="number" name="totalfees" id="totalfees" min="100" required="required" placeholder="Please Enter Cost"/><br/><br />
<input type="submit" value=" Submit " name="submit"/><br />
</form>
</div>

</div>
<?php
if(isset($_POST["submit"])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loginerp";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO studentdetails (name, college, yearofstudy, branch, courseopted, trainer, totalfees)
VALUES ('".$_POST["sname"]."','".$_POST["college"]."','".$_POST["yearofstudy"]."','".$_POST["branch"]."','".$_POST["course"]."','".$_POST["trainer"]."','".$_POST["totalfees"]."')";

if ($conn->query($sql) === TRUE) {
// echo "<script type= 'text/javascript'>alert('New record created successfully');</script>";
header("Location: sort.php");
exit;
} else {
echo "<script type= 'text/javascript'>alert('Error: " . $sql . "<br>" . $conn->error."');</script>";
}

$conn->close();
}
?>
</body>
</html>