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

  <title>NetTech</title>

	  <link rel="stylesheet" href="assets/demo.css">
    <link rel="stylesheet" href="assets/form-basic.css">

</head>

<body>
	<?php
	if (isset($_POST["scih"])) {
	    $scih = $_POST['scih'];
	    $scab = $_POST['scab'];

	    //echo "Order: ". $_POST['birthday']. "<br />"; //Result Check

	    //DB Connectivity & Insert Query
	    include("connection.php");

 			$sql = "UPDATE tbl_cash set scih = $scih, scab = $scab";

	    if ($con->query($sql) === true) {
	        //echo "New record created successfully"; echo "<br />";
	        echo "<div class=\"container\">
					<div class=\"alert alert-success alert-dismissible\">
    			<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>
    			<strong>Success!</strong> Cash Table Updated Successfully !!
  				</div>
					<meta http-equiv=\"refresh\" content=\"0;url=form-search.php \" >
	        </div>";

	    } else {
	        echo "Error: " . $sql . "<br>" . $con->error;
	    }
	    $con->close();

  }
  include("headrow.php");
	?>

	    <ul>
	        <li><a href="index.php">New Client</a></li>
	        <!-- <li><a href="./banking/personal.php">Self Banking</a></li> -->
	        <li><a href="form-search.php">Search</a></li>
					<li><a href="trans.php">Transactions</a></li>
	    </ul>


	    <div class="main-content">

	        <!-- You only need this form and the form-basic.css -->

	        <form action = "<?php $_PHP_SELF ?>" method = "POST" class="form-basic" method="post" action="#">


	            <div class="form-title-row">
	                <h1>Cash Table Update</h1>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>Cash In Hand</span>
	                    <input type="text" name="scih" required />
	                </label>
	            </div>

	            <div class="form-row">
	                <label>
	                    <span>Account Balance</span>
	                    <input maxlength="11" type="text" name="scab" required />
	                </label>
	            </div>


	                <button type="submit" id='float1' style="margin: 30px 10px; display: inline; width: 25%; margin-left: 80px;">Submit</button>



	        </form>

	  </div>

</body>

</html>
