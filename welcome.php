<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
    
<?php 
$con=mysqli_connect("localhost","root","","login");     //connect through DB through APache server (website,username,password,DB name)
if(mysqli_connect_errno()){                            //to check if the connection to server is done
    echo "Falied to connect". mysqli_connect_error();
}
if($_SERVER["REQUEST_METHOD"]=="POST"){      //check for type of connection
    $username=mysqli_real_escape_string($con,$_POST['username']);    //to retrive data from database
    $pass=mysqli_real_escape_string($con,$_POST['pass']);
}

    $sql = "SELECT username FROM userdetails WHERE username = '$username' and pass = '$pass';";
      $result = mysqli_query($con,$sql);
      $row = NULL;
      //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];

      $count = mysqli_num_rows($result);
if($count == 1){      //exact match to the number of rows with the same name with different passwords
    $_SESSION['login_user']=$username;
    header("location: main.html");
}
else{?>
   <!-- echo"<center><h3 style='color:red';>Your login name or password is incorrect"; -->
  <script>  alert("Invalid Username & password.");
            window.location = "login.html";
  </script>

<?php
}
?>

</body>
</html>
