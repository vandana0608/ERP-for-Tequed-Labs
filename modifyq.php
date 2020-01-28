<html>
<head>
<title>VIVA PHARMACY</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div id="main" align = "center">
<div id="login" align = "center">
<h2> Modify Medicine Details</h2>
<hr/>
<form action="" method="post">
<label>Medicine ID :</label>
<input type="text" name="medid" id="medid" required="required" placeholder="Please Enter ID"/><br /><br />
<label>Medicine Quantity :</label>
<input type="number" name="medqty" id="medqty" min="1" required="required" placeholder="Please Enter Quantity"/><br/><br />
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

$sql = "UPDATE medicinelist set medicine_quantity='".$_POST["medqty"]."' where medicine_id='".$_POST["medid"]."'";


if ($conn->query($sql) === TRUE) {
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