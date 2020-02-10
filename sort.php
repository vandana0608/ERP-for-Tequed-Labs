<?php
// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'loginerp');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('name', 'college', 'yearofstudy', 'branch', 'courseopted', 'trainer', 'totalfees');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $mysqli->query('SELECT * FROM studentdetails ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
            <title>TEQUED LABS</title>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<style>
            body {
            font-family: 'Lato', sans-serif;
            background-image: url("https://terillium.com/wp-content/uploads/2018/07/HomePage-background.jpg");
      color: white;
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
				<a href="main.html" class="w3-bar-item w3-button w3-padding-large">HOME</a>
				<a href="add.php" class="w3-bar-item w3-button w3-padding-large">ADD</a>
				<a href="generate_pdf.php" class="w3-bar-item w3-button w3-padding-large">GENERATE PDF</a>
            </div>
			<br>
            <div class="w3-container w3-content w3-center w3-padding-4" style="max-width:800px" id="band">
                <h2 class="w3-wide">TEQUED LABS ERP SYSTEM</h2>
            </div>
			<br> <br>
			<br> <br>
			<table align = "center">
				<tr>
                    <th><a href="sort.php?column=name&order=<?php echo $asc_or_desc; ?>">Name<i class="fas fa-sort<?php echo $column == 'name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="sort.php?column=college&order=<?php echo $asc_or_desc; ?>">College<i class="fas fa-sort<?php echo $column == 'college' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="sort.php?column=yearofstudy&order=<?php echo $asc_or_desc; ?>">Year of Study<i class="fas fa-sort<?php echo $column == 'yearofstudy' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th>Branch</th>
					<th><a href="sort.php?column=courseopted&order=<?php echo $asc_or_desc; ?>">Course Opted<i class="fas fa-sort<?php echo $column == 'courseopted' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="sort.php?column=trainer&order=<?php echo $asc_or_desc; ?>">Trainer<i class="fas fa-sort<?php echo $column == 'trainer' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th>Total Fees</th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'name' ? $add_class : ''; ?>><?php echo $row['name']; ?></td>
					<td<?php echo $column == 'college' ? $add_class : ''; ?>><?php echo $row['college']; ?></td>
					<td<?php echo $column == 'yearofstudy' ? $add_class : ''; ?>><?php echo $row['yearofstudy']; ?></td>
					<td<?php echo $column == 'branch' ? $add_class : ''; ?>><?php echo $row['branch']; ?></td>
					<td<?php echo $column == 'courseopted' ? $add_class : ''; ?>><?php echo $row['courseopted']; ?></td>
					<td<?php echo $column == 'trainer' ? $add_class : ''; ?>><?php echo $row['trainer']; ?></td>
                    <td<?php echo $column == 'totalfees' ? $add_class : ''; ?>><?php echo "Rs." .$row['totalfees']; ?></td>
					
				</tr>
				<?php endwhile; ?>
			</table>
        </body>
	</html>
	<?php
	$result->free();
}
?>