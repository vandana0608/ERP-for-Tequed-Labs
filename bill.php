<?php
session_start();
$connect = mysqli_connect("localhost", "root", "", "login");

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'			=>	$_GET["id"],
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
                'item_quantity'		=>	$_POST["quantity"],
                'med_qty'		    =>	$_POST["medicine_qty"],
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'			=>	$_GET["id"],
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="bill.php"</script>';
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>VIVA PHARMACY</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-image: url("https://drexel.edu/~/media/Images/medicine/backgrounds/backgroundAbstractMolecules/mobile.ashx");
            }
    </style>
		<div class="container">
			<br />
			<h3 align="center">Billing Counter</h3><br />
			<br />
			<?php
				$query = "SELECT * FROM medicinelist ORDER BY medicine_id ASC";
				$result = mysqli_query($connect, $query);
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
				?>
			<div class="col-md-4">
            <br>
				<form method="post" action="bill.php?action=add&id=<?php echo $row["medicine_id"]; ?>">
					<div style="border:3px solid black; background-color:whitesmoke; border-radius:5px; padding:16px;" align="center">

						<h4 class="text-info">Medicine Name : <?php echo $row["medicine_name"]; ?></h4>

						<h4 class="text-danger">Medicine Cost per unit : $ <?php echo $row["medicine_cost"]; ?></h4>

						<input type="number" name="quantity" value="1" min="1" class="form-control" />

						<input type="hidden" name="hidden_name" value="<?php echo $row["medicine_name"]; ?>" />

						<input type="hidden" name="hidden_price" value="<?php echo $row["medicine_cost"]; ?>" />

						<input type="submit" name="add_to_cart" style="margin-top:5px; color:white; background-color: black;" class="btn btn-success" value="Add to Cart" />

					</div>
				</form>
			</div>
			<?php
					}
				}
			?>
			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered" style ="background-color: black; color:white;">
					<tr>
						<th width="40%">Medicine Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>$ <?php echo $values["item_price"]; ?></td>
						<td>$ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="bill.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger"> Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<div class="container" style="padding-top:50px" align = "center">
                		<form>
				        	<button formaction="placeorder.php" class="w3-button w3-black w3-margin-bottom">
    			            	Place Order
				        	</button>
                		</form>
			    	</div>
					<?php
					}
					?>
						
				</table>
			</div>
		</div>
	</div>
	<br />
	</body>
</html>