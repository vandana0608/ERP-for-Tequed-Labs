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
    <title>VIVA PHARMACY</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<style>
            body {
            font-family: 'Lato', sans-serif;
            background-image: url("https://drexel.edu/~/media/Images/medicine/backgrounds/backgroundAbstractMolecules/mobile.ashx");
            }
            .dropdown {
  			float: left;
  			overflow: hidden;
			}
			.dropdown .dropbtn {
			font-size: 16px;
			border: none;
			outline: none;
			color: white;
			padding: 14px 16px;
			background-color: inherit;
			font-family: inherit; /* Important for vertical align on mobile phones */
			margin: 0; /* Important for vertical align on mobile phones */
			}
			/* Add a red background color to navbar links on hover */
			.navbar a:hover, .dropdown:hover .dropbtn {
			background-color: red;
			}
			/* Dropdown content (hidden by default) */
			.dropdown-content {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
			}
			/* Links inside the dropdown */
			.dropdown-content a {
			float: none;
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
			}
			/* Add a grey background color to dropdown links on hover */
			.dropdown-content a:hover {
			background-color: #ddd;
			}
			/* Show the dropdown menu on hover */
			.dropdown:hover .dropdown-content {
			display: block;
            }
            table {
				border-collapse: collapse;
				width: 500px;
			}
			th {
				background-color: #54585d;
				border: 1px solid #54585d;
			}
			th:hover {
				background-color: #64686e;
			}
			th a {
				display: block;
				text-decoration:none;
				padding: 10px;
				color: #ffffff;
				font-weight: bold;
				font-size: 13px;
			}
			th a i {
				margin-left: 5px;
				color: rgba(255,255,255,0.4);
			}
			td {
				padding: 10px;
				color: #636363;
				border: 1px solid #dddfe1;
			}
			tr {
				background-color: #ffffff;
			}
			tr .highlight {
				background-color: #f9fafb;
			}
            </style>
</head>
<body>
            <div class="w3-top">
                <div class="w3-bar w3-black w3-card">
                    <a
                    class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right"
                    href="javascript:void(0)"
                    onclick="myFunction()"
                    title="Toggle Navigation Menu"
                    ><i class="fa fa-bars"></i
                ></a>
				<a href="sort.php" class="w3-bar-item w3-button w3-padding-large" style="float: right;">BACK</a>
            </div>
			<br>
            <div class="w3-container w3-content w3-center w3-padding-4" style="max-width:800px" id="band">
                <h2 class="w3-wide">VIVA PHARMACY</h2>
                <p class="w3-opacity"><i>Always there to care</i></p>
            </div>
            <br> <br>

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
             
            while($results = mysqli_fetch_array($raw_results)){ ?>
            <!-- // $results = mysql_fetch_array($raw_results) puts data from database into array, while it's valid it does the loop -->
                <table align = "center">
                    <tr>
                        <th>Medicine ID </th>
                        <th>Medicine Name </th>
                        <th>Medicine Quantity </th>
                        <th>Medicine Cost </th>
                    </tr>
                    <br>
                    <tr>
                        <td> <?php echo $results['medicine_id']; ?> </td>
                        <td> <?php echo $results['medicine_name']; ?> </td>
                        <td> <?php echo $results['medicine_quantity']; ?> </td>
                        <td> <?php echo $results['medicine_cost']; ?> </td>
                    </tr>
                </table>
                <!-- echo "<p><h3>".$results['medicine_name']."</h3></p>";
                echo "<p><h3>".$results['medicine_name']."</h3></p>";
                // posts results gotten from database(title and text) you can also show id ($results['id']) -->
            <?php }
             
        }
    }
    else{ // if there is no matching rows do following
            echo "No results";
    } ?>
</body>
</html>