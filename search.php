<?php
      $con=mysqli_connect("localhost","root","","login");     //connect through DB through APache server (website,username,password,DB name)
      if(mysqli_connect_errno()){                            //to check if the connection to server is done
          echo "Falied to connect". mysqli_connect_error();
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php
    $query = $_GET['query']; 
    // gets value sent over search form
    $min_length = 1;
    // if query length is more or equal minimum length then
    if(strlen($query) >= $min_length){
        $query = htmlspecialchars($query); 
        // changes characters used in html to their equivalents, for example: < to &gt;
         
        $query = mysqli_real_escape_string($con,$query);
        // makes sure nobody uses SQL injection
         
        $raw_results = mysqli_query($con,"SELECT * FROM medicinelist
            WHERE (`medicine_name` LIKE '%".$query."%')");
             
        // * means that it selects all fields, you can also write: `id`, `title`, `text`
        // articles is the name of our table
         
        // '%$query%' is what we're looking for, % means anything, for example if $query is Hello
        // it will match "hello", "Hello man", "gogohello", if you want exact match use `title`='$query'
        // or if you want to match just full word so "gogohello" is out use '% $query %' ...OR ... '$query %' ... OR ... '% $query'
         
        if(mysqli_num_rows($raw_results) > 0){ // if one or more rows are returned do following
             
            while($results = mysqli_fetch_array($raw_results)){
            // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop
             
                echo "<p><h3>".$results['medicine_name']."</h3></p>";
                // posts results gotten from database(title and text) you can also show id ($results['id'])
            }
             
        }
    }
    else{ // if there is no matching rows do following
            echo "No results";
    }
?>
</body>
</html>