<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title> Viva pharmacy</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="base.js">
    </script>
</head>

<body>

    <!-- Navbar -->
    <div class="w3-top">
        <div class="w3-bar w3-black w3-card">
          <a
            class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
            href="javascript:void(0)"
            onclick="myFunction()"
            title="Toggle Navigation Menu"
            ><i class="fa fa-bars"></i
          ></a>
      
          <a href="main.html" class="w3-bar-item w3-button w3-padding-large">HOME</a>
        </div>
    </div>
    <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
        <h2 class="w3-wide">VIVA PHARMACY</h2>
        <p class="w3-opacity"><i>Always there to care</i></p>
    </div>
    <?php
      $con=mysqli_connect("localhost","root","","login");     //connect through DB through APache server (website,username,password,DB name)
      if(mysqli_connect_errno()){                            //to check if the connection to server is done
          echo "Falied to connect". mysqli_connect_error();
      }
      $sql = "SELECT * FROM medicinelist;";
    //   echo '<input type="text" placeholder="Search.." class="center-block">';
      include "search.html";
      echo '<br> <br>';
      echo '<table border="1" cellspacing="1" cellpadding="1" align = "center" id = "tb2"> 
      <tr> 
          <td> <font face="Arial">Medicine ID</font> </td> 
          <td> <font face="Arial">Medicine Name</font> </td> 
          <td> <font face="Arial">Medicine Price</font> </td> 
          <td> <font face="Arial">Medicine Quantity</font> </td>
          <td> <font face="Arial">Add To Cart</font></td>
      </tr>';

 
if ($result = $con->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["medicine_id"];
        $field2name = $row["medicine_name"];
        $field3name = $row["medicine_cost"];
 
        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>$'.$field3name.'</td> 
                  <td> <input type="number" name="quantity" min="1"> </td>
                  <td> <button type = "button" id = "cartbutton" onclick = "addtocart()">Buy</button> </td>
              </tr>';
    }
    $result->free();
} 
?>
</body>
<script>
    function addtocart() {
        alert("Added to cart");
    }
</script>

</html>