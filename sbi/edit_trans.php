<?php
include("sessions.php");
?>	
<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="icon" type="image/x-icon" href="images/logo.png" />
	<!-- Below two scripts are for alert bar with close button -->
	
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<title>NetTech</title>

	<link rel="stylesheet" href="assets/demo.css">
  <link rel="stylesheet" href="assets/form-basic.css">

	<script>
		function myFunction() {
			alert("Kindly Conform Details Before Update");
			}
	</script>
</head>

<body>
	<?php
	if (isset($_POST["update"])) {
	    //echo "Order: ". $_POST['birthday']. "<br />"; //Result Check
			$tid = $_POST['update'];
			//echo $tid;
			$oap = $_POST['oap'];
			$opn= $_POST['opn'];
			$amt= $_POST['amt'];
			$refno= $_POST['refno'];

			include("connection.php");
			date_default_timezone_set("Asia/Kolkata");
			$stamp=date("Y-m-d H:i:s");
			$sql = "UPDATE tbl_sbitrans set oap = '$oap', opn = '$opn', amt = '$amt', refno = '$refno', updstamp = '$stamp' where tid = '$tid' ";
			//echo $sql;

			if ($con->query($sql) === true) {
	        //echo "New record created successfully"; echo "<br />";
	        echo "<div class=\"container\">
					<div class=\"alert alert-success alert-dismissible\">
    			<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    			<strong>Success!</strong> Transaction Updated Successfully !!
  				</div>
					<meta http-equiv=\"refresh\" content=\"5;url=form-search.php \" >
	        </div>";

	    } else {
	        echo "Error: " . $sql . "<br>" . $con->error;
	    }
	    $con->close();

		}


	?>
	<?php
	include("headrow.php");
	?>

	    <ul>
	        <li><a href="index.html" class="active">New Client</a></li>
	        <!-- <li><a href="./banking/personal.php">Self Banking</a></li> -->
	        <li><a href="form-search.php">Search</a></li>
					<li><a href="trans.php">Transactions</a></li>
					<li><a href="report.php">Reports</a></li>
	    </ul>


	    <div class="main-content">

	        <!-- You only need this form and the form-basic.css -->
					<form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post" action="#">
					<?php
					if (isset($_POST["tid"]))
					{
						$tid = $_POST['tid'];
						//echo $cid;
						include("connection.php");
						$sql="SELECT * FROM tbl_sbitrans WHERE tid = '".$tid."'";
						$res=$con->query($sql);
						$nrows=$res->num_rows;
						$get_column=$res->fetch_assoc();
					}
					?>

						<div class="form-title-row">
								<h1>Update Transaction Entry</h1>
						</div>

						<div class="form-row">
								<label>
										<span>OAP</span>
										<select name="oap">
												<option value="<?php echo $get_column['oap']; ?>"><?php echo $get_column['oap']; ?> </option>
												<option value="No">No</option>
												<option value="Yes">Yes</option>
										</select>
								</label>
						</div>

						<div class="form-row">
								<label>
										<span>Operation</span>
										<select name="opn">
												<option value="<?php echo $get_column['opn']; ?>"><?php echo $get_column['opn']; ?> </option>
												<option value="Deposit">Deposit</option>
												<option value="Withdrawal">Withdrawal</option>
										</select>
								</label>
						</div>

						<div class="form-row">
								<label>
										<span>Amount</span>
										<input type="text" name="amt" value="<?php echo $get_column['amt'] ?>" required />
								</label>
						</div>

						<div class="form-row">
								<label>
										<span>RefNO</span>
										<input type="text" name="refno" value="<?php echo $get_column['refno'] ?>" required />
								</label>
						</div>


							<div class="form-row">
									<input type='hidden' name='update' value="<?php echo $get_column['tid']; ?>" />
									<button type="submit" onclick='myFunction()' >Update</button>
							</div>

					</form>

	  </div>

</body>

</html>
