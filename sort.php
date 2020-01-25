<?php
// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'login');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('medicine_name', 'medicine_id', 'medicine_cost');

// Only get the column if it exists in the above columns array, if it doesn't exist the database table will be sorted by the first item in the columns array.
$column = isset($_GET['column']) && in_array($_GET['column'], $columns) ? $_GET['column'] : $columns[0];

// Get the sort order for the column, ascending or descending, default is ascending.
$sort_order = isset($_GET['order']) && strtolower($_GET['order']) == 'desc' ? 'DESC' : 'ASC';

// Get the result...
if ($result = $mysqli->query('SELECT * FROM medicinelist ORDER BY ' .  $column . ' ' . $sort_order)) {
	// Some variables we need for the table.
	$up_or_down = str_replace(array('ASC','DESC'), array('up','down'), $sort_order); 
	$asc_or_desc = $sort_order == 'ASC' ? 'desc' : 'asc';
	$add_class = ' class="highlight"';
	?>
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
            <title> Viva pharmacy</title>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
            <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<style>
            body {
            font-family: 'Lato', sans-serif;
            background-image: url("https://drexel.edu/~/media/Images/medicine/backgrounds/backgroundAbstractMolecules/mobile.ashx");
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
                </div>
            </div>
            <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
                <h2 class="w3-wide">VIVA PHARMACY</h2>
                <p class="w3-opacity"><i>Always there to care</i></p>
            </div>
            <?php
                include "search.html";
                echo '<br> <br>';
            ?>
			<table align = "center">
				<tr>
                    <th><a href="sort.php?column=medicine_id&order=<?php echo $asc_or_desc; ?>">Medicine ID<i class="fas fa-sort<?php echo $column == 'medicine_id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="sort.php?column=medicine_name&order=<?php echo $asc_or_desc; ?>">Medicine Name<i class="fas fa-sort<?php echo $column == 'medicine_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="sort.php?column=medicine_cost&order=<?php echo $asc_or_desc; ?>">Medicine Cost<i class="fas fa-sort<?php echo $column == 'medicine_cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th>Quantity</th>
                    <th>Cart</th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'medicine_id' ? $add_class : ''; ?>><?php echo $row['medicine_id']; ?></td>
					<td<?php echo $column == 'medicine_name' ? $add_class : ''; ?>><?php echo $row['medicine_name']; ?></td>
                    <td<?php echo $column == 'medicine_cost' ? $add_class : ''; ?>><?php echo $row['medicine_cost']; ?></td>
                    <td> <input type="number" name="quantity" min="1"> </td>
                    <td> <button type = "button" id = "cartbutton" onclick = "addtocart()">Buy</button> </td>
				</tr>
				<?php endwhile; ?>
			</table>
        </body>
        <script>
            function addtocart() {
                alert("Added to cart");
            }
        </script>
	</html>
	<?php
	$result->free();
}
?>