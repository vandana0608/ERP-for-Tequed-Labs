<html>
<head>
<title>VIVA PHARMACY</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="main" align = "center">
<div id="login" align = "center">
<h2>Medicine Details</h2>
<hr/>
<form action="" method="post">
<label>Medicine ID :</label>
<input type="text" name="medid" id="medid" required="required" placeholder="Please Enter ID"/><br /><br />
<label>Medicine Name :</label>
<input type="text" name="medname" id="medname" required="required" placeholder="Please Enter Name"/><br/><br />
<label>Medicine Cost :</label>
<input type="number" name="medcost" id="medcost" min="1" required="required" placeholder="Please Enter Cost"/><br/><br />
<input type="submit" value=" Submit " name="submit"/><br />
</form>
</div>

</div>
<?php
if(isset($_POST["submit"])){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "login";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO medicinelist (medicine_id, medicine_name, medicine_cost)
VALUES ('".$_POST["medid"]."','".$_POST["medname"]."','".$_POST["medcost"]."')";

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