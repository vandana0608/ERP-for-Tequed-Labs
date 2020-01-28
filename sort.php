<?php
// Below is optional, remove if you have already connected to your database.
$mysqli = mysqli_connect('localhost', 'root', '', 'login');

// For extra protection these are the columns of which the user can sort by (in your database table).
$columns = array('medicine_name', 'medicine_id', 'medicine_cost', 'medicine_quantity');

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
				<div class="dropdown">
    				<button class="w3-bar-item w3-button w3-padding-large dropbtn">MODIFY
      				<i class="fa fa-caret-down"></i>
    				</button>
    				<div class="dropdown-content">
      					<a href="modifyc.php">BY COST</a>
      					<a href="modifyq.php">BY QUANTITY</a>
    				</div>
				</div>
				<!-- <a href="modifyq.php" class="w3-bar-item w3-button w3-padding-large">MODIFY (by quantity) </a>
				<a href="modifyc.php" class="w3-bar-item w3-button w3-padding-large">MODIFY (by cost) </a> -->
				<a href="delete.php" class="w3-bar-item w3-button w3-padding-large">DELETE</a>
				<a href="generate_pdf.php" class="w3-bar-item w3-button w3-padding-large">GENERATE PDF</a>
            </div>
			<br>
            <div class="w3-container w3-content w3-center w3-padding-4" style="max-width:800px" id="band">
                <h2 class="w3-wide">VIVA PHARMACY</h2>
                <p class="w3-opacity"><i>Always there to care</i></p>
            </div>
			<br>
            <?php
                include "search.html";
                echo '<br> <br>';
            ?>
			<table align = "center">
				<tr>
                    <th><a href="sort.php?column=medicine_id&order=<?php echo $asc_or_desc; ?>">Medicine ID<i class="fas fa-sort<?php echo $column == 'medicine_id' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="sort.php?column=medicine_name&order=<?php echo $asc_or_desc; ?>">Medicine Name<i class="fas fa-sort<?php echo $column == 'medicine_name' ? '-' . $up_or_down : ''; ?>"></i></a></th>
					<th><a href="sort.php?column=medicine_quantity&order=<?php echo $asc_or_desc; ?>">Medicine Quantity<i class="fas fa-sort<?php echo $column == 'medicine_cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th><a href="sort.php?column=medicine_cost&order=<?php echo $asc_or_desc; ?>">Medicine Cost<i class="fas fa-sort<?php echo $column == 'medicine_cost' ? '-' . $up_or_down : ''; ?>"></i></a></th>
                    <th>Quantity</th>
                    <th>Cart</th>
				</tr>
				<?php while ($row = $result->fetch_assoc()): ?>
				<tr>
					<td<?php echo $column == 'medicine_id' ? $add_class : ''; ?>><?php echo $row['medicine_id']; ?></td>
					<td<?php echo $column == 'medicine_name' ? $add_class : ''; ?>><?php echo $row['medicine_name']; ?></td>
					<td id="quantity" <?php echo $column == 'medicine_quantity' ? $add_class : ''; ?>><?php echo $row['medicine_quantity']; ?></td>
                    <td<?php echo $column == 'medicine_cost' ? $add_class : ''; ?>><?php echo "$" .$row['medicine_cost']; ?></td>
                    <td> <input type="number" name="quantity" min="1" value="" id="newQuantity" onkeyup="updateMedQuantity('<?php echo $row['medicine_id'] ?>','<?php echo $row['medicine_quantity'] ?>')"> </td>
                    <td> <button type = "button" id = "cartbutton" onclick = "addToCart('<?php echo $row['medicine_id'] ?>','<?php echo $row['medicine_quantity'] ?>')">Buy</button> </td>
				</tr>
				<?php endwhile; ?>
			</table>
			<div class="container" style="padding-top:50px" align = "center">
				<button onclick="generateBill()" class="w3-button w3-black w3-margin-bottom">
    			Generate Bill
				</button>
			</div>
			<script
  			src="https://code.jquery.com/jquery-3.4.1.min.js"
  			integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  			crossorigin="anonymous"></script>
			<script>
    		var cart = [];
            function addToCart(medicine_id, stock) {
        		let item = cart.find(c => c.medicine_id === medicine_id);
        		if (item) return alert('Item already in cart');
    
        		const quantity = document.getElementById(`newQuantity`).value;

        		if(quantity == 0) return alert('Quantity cannot be zero');
    
        		if (stock - quantity < 0) return alert('Quantity is more than the stock');
    
        		cart.push({ medicine_id: medicine_id, quantity: quantity });
        
        		alert('Added to cart')
    		}
			function updateMedQuantity(medicine_id, stock) {
        		const newQuantity = document.getElementById(`newQuantity`).value;
    
        		if (stock - newQuantity < 0)
            		return alert('Quantity is more than the stock');
    
        		document.getElementById(`quantity`).innerHTML =
            	stock - newQuantity;
    		}
			function generateBill() {
        		if (cart.length === 0) return alert('Cart is empty');

        		let items = cart;
        		var csrf_token = $('[name=csrfmiddlewaretoken]').val();
        		$.ajax(
            	{
                	url: 'update.php',
                	method: 'POST', 
                	headers : {"Content-type": "application/json", "X-CSRFToken": csrf_token}, 
                	data: JSON.stringify({items: items})
            	}
        		)
        		.done(response => {
            	document.open();
            	document.write(response);
            	document.close();
        		})
        		.fail(error => {console.log(error)});
    			}
        	</script>
        </body>
	</html>
	<?php
	$result->free();
}
?>