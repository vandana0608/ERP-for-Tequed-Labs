
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
if($_SERVER["REQUEST_METHOD"]=="POST"){      //check for type of connection
    $data = json_decode(data);
}
for item in $data['items']:
    $medqty = "SELECT medicine_quantity from medicinelist where medicine_id=item['medicine_id']";
    $updatemedqty = $medqty - int(item['quantity']);
    $sql = "UPDATE medicinelist set medicine_quantity='".$updatemedqty."' where medicine_id='".$_POST["medid"]."'";


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